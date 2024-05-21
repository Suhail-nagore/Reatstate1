<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Property</title>
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
    <h2 class="mt-5 mb-3">Add New Property</h2>

    <!-- Property Form -->
    <form action="submit-property.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Property Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <select class="form-control" id="type" name="type" required>
                <option value="Residential">Residential</option>
                <option value="Commercial">Commercial</option>
                <option value="Industrial">Industrial</option>
                <option value="Agriculture">Agriculture</option>
            </select>
        </div>
        <div class="form-group">
            <label for="latitude">Latitude:</label>
            <input type="text" class="form-control" id="latitude" name="latitude" required>
        </div>
        <div class="form-group">
            <label for="longitude">Longitude:</label>
            <input type="text" class="form-control" id="longitude" name="longitude" required>
        </div>
        <div class="form-group">
            <label for="specifications">Specifications:</label>
            <textarea class="form-control" id="specifications" name="specifications" rows="3" required></textarea>
            <small class="form-text text-muted">Enter specifications separated by commas (e.g., Size, Bedrooms, Bathrooms).</small>
        </div>
        <div class="form-group">
            <label for="amenities">Amenities:</label>
            <textarea class="form-control" id="amenities" name="amenities" rows="3" required></textarea>
            <small class="form-text text-muted">Enter amenities separated by commas (e.g., Pool, Gym, Parking).</small>
        </div>
        <div class="form-group">
            <label for="image1">Image 1:</label>
            <input type="file" class="form-control-file" id="image1" name="image1" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="image2">Image 2:</label>
            <input type="file" class="form-control-file" id="image2" name="image2" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="image3">Image 3:</label>
            <input type="file" class="form-control-file" id="image3" name="image3" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Property</button>
    </form>
</div>

</body>
</html>
