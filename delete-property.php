<?php
// Include database connection
include 'db_connection.php';

// Check if property ID is provided and it's a valid integer
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $propertyId = $_GET['id'];

    try {
        // Begin a transaction
        $pdo->beginTransaction();

        // Delete related data from property_amenities table
        $deleteAmenitiesSql = "DELETE FROM property_amenities WHERE property_id = ?";
        $deleteAmenitiesStmt = $pdo->prepare($deleteAmenitiesSql);
        $deleteAmenitiesStmt->execute([$propertyId]);

        // Delete related data from property_specifications table
        $deleteSpecsSql = "DELETE FROM property_specifications WHERE property_id = ?";
        $deleteSpecsStmt = $pdo->prepare($deleteSpecsSql);
        $deleteSpecsStmt->execute([$propertyId]);

        // Delete related data from property_images table and delete associated images
        $deleteImagesSql = "SELECT image_path FROM property_images WHERE property_id = ?";
        $deleteImagesStmt = $pdo->prepare($deleteImagesSql);
        $deleteImagesStmt->execute([$propertyId]);
        $imagesToDelete = $deleteImagesStmt->fetchAll(PDO::FETCH_COLUMN);

        // Delete images from the server's file system
        foreach ($imagesToDelete as $image) {
            if (file_exists($image)) {
                unlink($image);
            }
        }

        // Now delete records from property_images table
        $deleteImagesSql = "DELETE FROM property_images WHERE property_id = ?";
        $deleteImagesStmt = $pdo->prepare($deleteImagesSql);
        $deleteImagesStmt->execute([$propertyId]);

        // Delete property from properties table
        $deletePropertySql = "DELETE FROM properties WHERE id = ?";
        $deletePropertyStmt = $pdo->prepare($deletePropertySql);
        $deletePropertyStmt->execute([$propertyId]);

        // Commit the transaction
        $pdo->commit();

        // Redirect to the manage-properties page after deletion
        header("Location: manage-properties.php");
        exit();
    } catch (Exception $e) {
        // If an error occurs, rollback the transaction
        $pdo->rollBack();
        echo "Failed to delete property. Error: " . $e->getMessage();
    }
} else {
    // Invalid property ID provided
    echo "Invalid property ID.";
}
?>
