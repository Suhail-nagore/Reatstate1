<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Properties</title>
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
    <h2 class="mt-5 mb-3">Manage Properties</h2>

    <!-- Button to Add New Property -->
    <a href="add-property.php" class="btn btn-primary mb-3">Add New Property</a>
    <a href="dashboard.php" class="btn btn-primary mb-3">Dashboard</a>

    <!-- Display Existing Properties -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fetch and Display Properties from Database -->
                <?php
                // Include database connection
                include 'db_connection.php';

                $serialNumber=1;

                // Fetch properties from the database
                $sql = "SELECT id, name FROM properties";
                $result = $pdo->query($sql);

                // Check if properties exist
                if ($result->rowCount() > 0) {
                    // Output data of each row
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $serialNumber . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>";
                        echo "<a href='property-details.php?id=" . $row["id"] . "' class='btn btn-info'>View Details</a>";
                        echo " <a href='edit-property.php?id=" . $row["id"] . "' class='btn btn-warning'>Edit</a>";
                        // Add delete button
                        echo " <a href='delete-property.php?id=" . $row["id"] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this property?\")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                        $serialNumber++;
                    }
                } else {
                    echo "<tr><td colspan='3'>No properties found.</td></tr>";
                }

                // Close database connection (not necessary for PDO)
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
