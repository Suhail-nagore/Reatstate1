<?php
// Include database connection
include 'db_connection.php';

// Check if property ID is provided
if (isset($_GET['id'])) {
    // Retrieve property data from the database
    $propertyId = $_GET['id'];
    $sql = "SELECT * FROM properties WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $propertyId]);
    $property = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if property exists
    if ($property) {
        // Extract property data
        $name = $property['name'];
        $description = $property['description'];
        $latitude = $property['latitude'];
        $longitude = $property['longitude'];
        $type = $property['type']; // Fetch the property type

        // Fetch specifications for the property
        $sql = "SELECT specification FROM property_specifications WHERE property_id = :property_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['property_id' => $propertyId]);
        $specifications = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Fetch amenities for the property
        $sql = "SELECT amenity FROM property_amenities WHERE property_id = :property_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['property_id' => $propertyId]);
        $amenities = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Fetch images for the property
        $sql = "SELECT image_path FROM property_images WHERE property_id = :property_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['property_id' => $propertyId]);
        $images = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } else {
        // Property not found, redirect or display error message
        header('Location: manage-properties.php');
        exit;
    }
} else {
    // Property ID not provided, redirect or display error message
    header('Location: manage-properties.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom Styles */
        body {
            padding-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mt-5 mb-3">Edit Property</h2>

    <!-- Property Form -->
    <form action="update-property.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Property Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="5" required><?php echo isset($description) ? htmlspecialchars($description) : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label for="latitude">Latitude:</label>
            <input type="text" class="form-control" id="latitude" name="latitude" value="<?php echo isset($latitude) ? htmlspecialchars($latitude) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="longitude">Longitude:</label>
            <input type="text" class="form-control" id="longitude" name="longitude" value="<?php echo isset($longitude) ? htmlspecialchars($longitude) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="specifications">Specifications:</label>
            <textarea class="form-control" id="specifications" name="specifications" rows="3" required><?php echo isset($specifications) ? htmlspecialchars(implode(',', $specifications)) : ''; ?></textarea>
            <small class="form-text text-muted">Enter specifications separated by commas (e.g., Size, Bedrooms, Bathrooms).</small>
        </div>
        <div class="form-group">
            <label for="amenities">Amenities:</label>
            <textarea class="form-control" id="amenities" name="amenities" rows="3" required><?php echo isset($amenities) ? htmlspecialchars(implode(',', $amenities)) : ''; ?></textarea>
            <small class="form-text text-muted">Enter amenities separated by commas (e.g., Pool, Gym, Parking).</small>
        </div>
        <div class="form-group">
            <label for="type">Type of Property:</label>
            <select class="form-control" id="type" name="type" required>
                <option value="Residential" <?php echo isset($type) && $type == 'Residential' ? 'selected' : ''; ?>>Residential</option>
                <option value="Commercial" <?php echo isset($type) && $type == 'Commercial' ? 'selected' : ''; ?>>Commercial</option>
                <option value="Industrial" <?php echo isset($type) && $type == 'Industrial' ? 'selected' : ''; ?>>Industrial</option>
                <option value="Agriculture" <?php echo isset($type) && $type == 'Agriculture' ? 'selected' : ''; ?>>Agriculture</option>
            </select>
        </div>
        <!-- Display existing images -->
        <?php foreach ($images as $image) : ?>
            <div class="form-group">
                <img src="<?php echo htmlspecialchars($image); ?>" alt="Property Image" class="img-thumbnail">
            </div>
        <?php endforeach; ?>
        <!-- Allow to upload new images -->
        <div class="form-group">
            <label for="image1">New Image 1:</label>
            <input type="file" class="form-control-file" id="image1" name="image1" accept="image/*">
        </div>
        <div class="form-group">
            <label for="image2">New Image 2:</label>
            <input type="file" class="form-control-file" id="image2" name="image2" accept="image/*">
        </div>
        <div class="form-group">
            <label for="image3">New Image 3:</label>
            <input type="file" class="form-control-file" id="image3" name="image3" accept="image/*">
        </div>
        <!-- Hidden input field for property_id -->
        <input type="hidden" name="property_id" value="<?php echo isset($propertyId) ? htmlspecialchars($propertyId) : ''; ?>">

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

</body>
</html>
