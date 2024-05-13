<?php
// Include database connection
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $specifications = $_POST['specifications'];
    $amenities = $_POST['amenities'];

    // File upload handling for three images
    $targetDir = "uploads/";
    $image1 = $targetDir . basename($_FILES['image1']['name']);
    $image2 = $targetDir . basename($_FILES['image2']['name']);
    $image3 = $targetDir . basename($_FILES['image3']['name']);

    // Check if images are uploaded successfully
    if (move_uploaded_file($_FILES['image1']['tmp_name'], $image1) &&
        move_uploaded_file($_FILES['image2']['tmp_name'], $image2) &&
        move_uploaded_file($_FILES['image3']['tmp_name'], $image3)) {

        // Insert property details into properties table
        $sql = "INSERT INTO properties (name, description, latitude, longitude) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $description, $latitude, $longitude]);
        $propertyId = $pdo->lastInsertId();

        // Insert property specifications into property_specifications table
        $specsArray = explode(',', $specifications);
        foreach ($specsArray as $spec) {
            $sql = "INSERT INTO property_specifications (property_id, specification) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$propertyId, $spec]);
        }

        // Insert property amenities into property_amenities table
        $amenitiesArray = explode(',', $amenities);
        foreach ($amenitiesArray as $amenity) {
            $sql = "INSERT INTO property_amenities (property_id, amenity) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$propertyId, $amenity]);
        }

        // Insert property images into property_images table
        $sql = "INSERT INTO property_images (property_id, image_path) VALUES (?, ?), (?, ?), (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$propertyId, $image1, $propertyId, $image2, $propertyId, $image3]);

        header("Location: manage-properties.php");
        exit();
    } else {
        echo "Error uploading images.";
    }
}
?>
