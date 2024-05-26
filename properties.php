<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Gurgaon Properties</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        .trainer-item {
            border: 1px solid #eaeaea;
            border-radius: 5px;
        }

        .image-thumb {
            position: relative;
            overflow: hidden;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .image-thumb img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .down-content {
            padding: 20px;
        }

        .down-content h4 {
            margin-top: 0;
        }
    </style>
</head>

<body>
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky" style="background-color: rgba(0,0,0,0.5); height: 80px;">
        <div class="container">
            <div class="row align-items-center" style="height: 100%;">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ** Logo Start ** -->
                        <a href="index.php" class="logo" style="color: white; font-size: 24px;">Gurgaon<em> Properties</em></a>
                        <!-- ** Logo End ** -->
                        <!-- ** Menu Start ** -->
                        <ul class="nav" style="color: white; font-size: 18px;">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="properties.php" class="active">Properties</a></li>
                            <li><a href="about.html">About</a></li>
                            <li><a href="blog.php">Blogs</a></li>
                            <li><a href="contact.html" style="color: white;">Contact</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span style="color: white;">Menu</span>
                        </a>
                        <!-- ** Menu End ** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Call to Action Start ***** -->
    <section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2>Our <em>Properties</em></h2>
                        <p>Explore our curated selection of premium properties in Gurgaon. Each listing is handpicked to offer the best in luxury, comfort, and convenience, tailored to meet your unique needs.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Call to Action End ***** -->

    <!-- ***** Fleet Starts ***** -->
    <section class="section" id="trainers">
        <div class="container">
            <br>
            <br>

            <!-- Dropdown for property type filter -->
            <div class="row mb-3">
    <div class="col-lg-4 offset-lg-4">
        <form action="properties.php" method="get" id="filterForm">
            <div class="input-group">
                <select class="form-control" name="type" id="type">
                    <option value="all" <?php if (isset($_GET['type']) && $_GET['type'] == 'all') echo 'selected'; ?>>All</option>
                    <option value="Residential" <?php if (isset($_GET['type']) && $_GET['type'] == 'Residential') echo 'selected'; ?>>Residential</option>
                    <option value="Commercial" <?php if (isset($_GET['type']) && $_GET['type'] == 'Commercial') echo 'selected'; ?>>Commercial</option>
                    <option value="Industrial" <?php if (isset($_GET['type']) && $_GET['type'] == 'Industrial') echo 'selected'; ?>>Industrial</option>
                    <option value="Agricultural" <?php if (isset($_GET['type']) && $_GET['type'] == 'Agricultural') echo 'selected'; ?>>Agricultural</option>
                </select>
            </div>

            <div class="input-group mt-3">
                <select class="form-control" name="location" id="location">
                    <option value="all" <?php if (isset($_GET['location']) && $_GET['location'] == 'all') echo 'selected'; ?>>All Locations</option>
                    <?php
                    include 'db_connection.php';
                    // Fetch unique location values from the properties table in alphabetical order
                    $locationQuery = "SELECT DISTINCT location FROM properties ORDER BY location ASC";
                    $locationStmt = $pdo->prepare($locationQuery);
                    $locationStmt->execute();
                    $locations = $locationStmt->fetchAll(PDO::FETCH_COLUMN);

                    foreach ($locations as $location): ?>
                        <option value="<?php echo htmlspecialchars($location); ?>" <?php if (isset($_GET['location']) && $_GET['location'] == $location) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($location); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-group-append mt-3">
                <button class="btn btn-primary" type="submit">Filter Results</button>
            </div>
        </form>
    </div>
</div>


<div class="row" id="propertyContainer">
    <?php
    // Include database connection
    include 'db_connection.php';

    try {
        $typeFilter = isset($_GET['type']) ? $_GET['type'] : 'all';
        $locationFilter = isset($_GET['location']) ? $_GET['location'] : 'all';
        $limit = 12;
        $offset = 0;

        // Build the SQL query based on filters
        $sql = "SELECT p.id, p.name, p.type, p.location, MIN(pi.image_path) AS image_path 
                FROM properties p
                LEFT JOIN property_images pi ON p.id = pi.property_id 
                WHERE 1=1";

        $countSql = "SELECT COUNT(*) AS total FROM properties WHERE 1=1";

        if ($typeFilter != 'all') {
            $sql .= " AND p.type = :type";
            $countSql .= " AND type = :type";
        }

        if ($locationFilter != 'all') {
            $sql .= " AND p.location = :location";
            $countSql .= " AND location = :location";
        }

        $sql .= " GROUP BY p.id
                  LIMIT :limit OFFSET :offset";

        $stmt = $pdo->prepare($sql);
        $countStmt = $pdo->prepare($countSql);

        // Bind parameters
        if ($typeFilter != 'all') {
            $stmt->bindParam(':type', $typeFilter, PDO::PARAM_STR);
            $countStmt->bindParam(':type', $typeFilter, PDO::PARAM_STR);
        }

        if ($locationFilter != 'all') {
            $stmt->bindParam(':location', $locationFilter, PDO::PARAM_STR);
            $countStmt->bindParam(':location', $locationFilter, PDO::PARAM_STR);
        }

        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        $countStmt->execute();

        // Fetch total properties count
        $totalProperties = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Check if properties exist
        if ($stmt->rowCount() > 0) {
            // Output data of each row
            foreach ($stmt as $row) {
                echo "<div class='col-lg-4'>";
                echo "<div class='trainer-item'>";
                echo "<div class='image-thumb'>";
                if (!empty($row['image_path'])) {
                    echo "<img src='" . htmlspecialchars($row['image_path']) . "' alt='Property Image'>";
                } else {
                    echo "<img src='default_image.jpg' alt='Property Image'>";
                }
                echo "</div>";
                echo "<div class='down-content'>";
                echo "<h4>" . htmlspecialchars($row['name']) . "</h4>";
                echo "<p>" . htmlspecialchars($row['type']) . " &nbsp;/&nbsp; " . htmlspecialchars($row['location']) . "</p>";
                echo "<ul class='social-icons'>";
                echo "<li><a href='property-details.php?id=" . $row['id'] . "'>+ View More</a></li>";
                echo "</ul>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='col-lg-12'>";
            echo "<p>No properties found.</p>";
            echo "</div>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
</div>



            <br>

            <!-- Load More Button -->
            <?php if ($totalProperties > 12): ?>
                <div class="text-center">
                    <button id="loadMoreBtn" class="btn btn-primary">Load More</button>
                </div>
            <?php endif; ?>

        </div>
    </section>
    <!-- ***** Fleet Ends ***** -->

    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        Copyright © 2020 Gurgaon Properties
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/mixitup.js"></script>
    <script src="assets/js/accordions.js"></script>
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

    <!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        const propertyContainer = document.getElementById('propertyContainer');
        let offset = 12; // Initially, 12 properties are loaded
        const limit = 3;
        const type = document.getElementById('type').value;

        loadMoreBtn.addEventListener('click', function () {
            fetch(`load-more.php?offset=${offset}&type=${type}`)
                .then(response => response.text())
                .then(data => {
                    propertyContainer.innerHTML += data;
                    offset += limit;

                    if (data.trim() === '') {
                        loadMoreBtn.style.display = 'none';
                    }
                })
                .catch(error => console.error('Error fetching more properties:', error));
        });
    });
    </script> -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const propertyContainer = document.getElementById('propertyContainer');
    let offset = 12; // Initially, 12 properties are loaded
    const limit = 3;

    loadMoreBtn.addEventListener('click', function () {
        const type = document.getElementById('type').value;
        const location = document.getElementById('location').value;

        const query = new URLSearchParams({ offset, type, location });

        fetch(`load-more.php?${query.toString()}`)
            .then(response => response.text())
            .then(data => {
                propertyContainer.innerHTML += data;
                offset += limit;

                if (data.trim() === '') {
                    loadMoreBtn.style.display = 'none';
                }
            })
            .catch(error => console.error('Error fetching more properties:', error));
    });
});

    </script>
</body>

</html>
