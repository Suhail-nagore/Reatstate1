<?php
// Include database connection
include 'db_connection.php';

// Get offset from the query string
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit = 3; // Number of properties to fetch

try {
    // Fetch properties in batches of 3 with the provided offset
    $sql = "SELECT p.id, p.name, MIN(pi.image_path) AS image_path 
            FROM properties p
            LEFT JOIN property_images pi ON p.id = pi.property_id
            GROUP BY p.id
            LIMIT $limit OFFSET $offset";
    $result = $pdo->query($sql);

    // Check if properties exist
    if ($result->rowCount() > 0) {
        // Output data of each row
        foreach ($result as $row) {
            echo "<div class='col-lg-4'>";
            echo "<div class='trainer-item'>";
            echo "<div class='image-thumb'>";
            // Check if image path is available
            if (!empty($row['image_path'])) {
                echo "<img src='" . $row['image_path'] . "' alt='Property Image'>";
            } else {
                // Default image if no image is available
                echo "<img src='default_image.jpg' alt='Property Image'>";
            }
            echo "</div>";
            echo "<div class='down-content'>";
            echo "<span>";
            echo "<del><sup>$</sup>80 000</del>  <sup>$</sup>70 000";
            echo "</span>";
            echo "<h4>" . $row['name'] . "</h4>";
            echo "<p>House &nbsp;/&nbsp; For Sale &nbsp;/&nbsp; 100 sq m &nbsp;/&nbsp; 2010</p>";
            echo "<ul class='social-icons'>";
            echo "<li><a href='property-details.php?id=" . $row['id'] . "'>+ View More</a></li>";
            echo "</ul>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        // No more properties to fetch
        echo "";
    }
} catch (PDOException $e) {
    // Handle database errors
    echo "Error: " . $e->getMessage();
}
?>
