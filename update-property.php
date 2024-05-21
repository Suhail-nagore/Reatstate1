<?php
// Include database connection
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $propertyId = $_POST['property_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $location = strtoupper($_POST['location']); // Convert location to uppercase
    $specifications = $_POST['specifications'];
    $amenities = $_POST['amenities'];
    $type = $_POST['type']; // Get the type of property

    // Update property details
    $updateSql = "UPDATE properties SET ";
    $updateParams = array();

    // Update name
    if (!empty($name)) {
        $updateSql .= "name = ?, ";
        $updateParams[] = $name;
    }

    // Update description
    if (!empty($description)) {
        $updateSql .= "description = ?, ";
        $updateParams[] = $description;
    }

    // Update latitude
    if (!empty($latitude)) {
        $updateSql .= "latitude = ?, ";
        $updateParams[] = $latitude;
    }

    // Update longitude
    if (!empty($longitude)) {
        $updateSql .= "longitude = ?, ";
        $updateParams[] = $longitude;
    }

    // Update location
    if (!empty($location)) {
        $updateSql .= "location = ?, ";
        $updateParams[] = $location;
    }

    // Update type
    if (!empty($type)) {
        $updateSql .= "type = ?, ";
        $updateParams[] = $type;
    }

    // Remove trailing comma and space
    $updateSql = rtrim($updateSql, ", ");

    // Add WHERE clause
    $updateSql .= " WHERE id = ?";
    $updateParams[] = $propertyId;

    // Execute the update query
    $stmt = $pdo->prepare($updateSql);
    $stmt->execute($updateParams);

    // Update property specifications
    if (!empty($specifications)) {
        // Delete existing specifications
        $deleteSpecsSql = "DELETE FROM property_specifications WHERE property_id = ?";
        $deleteSpecsStmt = $pdo->prepare($deleteSpecsSql);
        $deleteSpecsStmt->execute([$propertyId]);

        // Insert new specifications
        $specsArray = explode(',', $specifications);
        $insertSpecsSql = "INSERT INTO property_specifications (property_id, specification) VALUES (?, ?)";
        $insertSpecsStmt = $pdo->prepare($insertSpecsSql);
        foreach ($specsArray as $spec) {
            $insertSpecsStmt->execute([$propertyId, trim($spec)]);
        }
    }

    // Update property amenities
    if (!empty($amenities)) {
        // Delete existing amenities
        $deleteAmenitiesSql = "DELETE FROM property_amenities WHERE property_id = ?";
        $deleteAmenitiesStmt = $pdo->prepare($deleteAmenitiesSql);
        $deleteAmenitiesStmt->execute([$propertyId]);

        // Insert new amenities
        $amenitiesArray = explode(',', $amenities);
        $insertAmenitiesSql = "INSERT INTO property_amenities (property_id, amenity) VALUES (?, ?)";
        $insertAmenitiesStmt = $pdo->prepare($insertAmenitiesSql);
        foreach ($amenitiesArray as $amenity) {
            $insertAmenitiesStmt->execute([$propertyId, trim($amenity)]);
        }
    }

    // Handle image uploads
    $targetDir = "uploads/";
    $images = array();
    for ($i = 1; $i <= 3; $i++) {
        $imageName = 'image' . $i;
        if (!empty($_FILES[$imageName]['name'])) {
            $imagePath = $targetDir . basename($_FILES[$imageName]['name']);
            if (move_uploaded_file($_FILES[$imageName]['tmp_name'], $imagePath)) {
                $images[] = $imagePath;
            }
        }
    }

    // Update property images
    if (!empty($images)) {
        // Delete existing images (optional, if you want to replace existing images)
        $deleteImagesSql = "DELETE FROM property_images WHERE property_id = ?";
        $deleteImagesStmt = $pdo->prepare($deleteImagesSql);
        $deleteImagesStmt->execute([$propertyId]);

        // Insert new images
        $insertImagesSql = "INSERT INTO property_images (property_id, image_path) VALUES (?, ?)";
        $insertImagesStmt = $pdo->prepare($insertImagesSql);
        foreach ($images as $image) {
            $insertImagesStmt->execute([$propertyId, $image]);
        }
    }

    // Redirect to manage-properties.php
    header("Location: manage-properties.php");
    exit();
}
?>
