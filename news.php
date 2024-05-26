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
    <link rel="stylesheet" href="assets/css/news.css">
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
        .news-card{
            height:300px
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
                        <h2>Latest <em>NEWS</em></h2>
                        <p>This is the place where you stay updated with all Real Estate News of Gurgaon</p>
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
            <?php
            include 'db_connection.php';

            // Fetch the latest 8 news articles
            $sql = "SELECT * FROM news ORDER BY created_at DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <section class="section mt-5 mb-5" id="news">
                <h4 class="text-center">Latest News</h4>
                <div class="container">
                    <br>
                    <br>
                    <?php foreach ($news as $item): ?>
                    <div class="news-card shadow mt-2 mb-2">
                        <div class="row">

                        
                            <div class="news-image col-lg-4 col-md-4 col-sm-6">
                                <img src="<?php echo htmlspecialchars($item['image_path']); ?>" alt="News Image">
                            </div>
                            <div class="news-content col-lg-8 col-md-8 col-sm-6">
                            <a href="news-details.php?id=<?php echo htmlspecialchars($item['id']); ?>"><h2 class="news-title"><?php echo htmlspecialchars($item['title']); ?></h2></a>
                                
                                <p class="news-date"><strong><time><?php echo htmlspecialchars($item['created_at']); ?></time></strong></p>
                                <p class="news-description"><time><?php echo htmlspecialchars($item['paragraph1']); ?></time></p>
                                <a href="news-details.php?id=<?php echo htmlspecialchars($item['id']); ?>" class="btn btn-primary">Read More</a>
                            </div>
                            </div>
                    </div>
                    <?php endforeach; ?>
                    

                </div>
            </section>

            <br>

            <!-- Load More Button -->
                <div class="text-center">
                    <button id="loadMoreBtn" class="btn btn-primary">Load More</button>
                </div>
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

    <script>
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
    </script>
    <script>
    // Function to truncate text
    function truncate() {
        var maxLength = 300; // Maximum length of text
        var elements = document.querySelectorAll('.news-description'); // Select all elements to truncate

        elements.forEach(function (element) {
            var text = element.textContent.trim(); // Get the text content
            if (text.length > maxLength) {
                // Truncate text if it exceeds the maximum length
                var truncatedText = text.substr(0, maxLength);
                truncatedText = truncatedText.substr(0, Math.min(truncatedText.length, truncatedText.lastIndexOf(" "))); // Ensure text ends at a space
                truncatedText += '...'; // Add ellipsis
                element.textContent = truncatedText; // Set truncated text
            }
        });
    }

    // Call truncateText function when the page loads
    window.onload = truncate;
</script>
</body>

</html>
