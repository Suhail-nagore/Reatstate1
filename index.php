<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Reat state</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Bootstrap JS (popper.js included) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- jQuery (required for Bootstrap JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <link rel="stylesheet" href="assets/css/news.css">
    <link rel="stylesheet" href="assets/css/style.css">


    <style>
        .trainer-item {
            border: 1px solid #eaeaea; /* Add border for styling */
            border-radius: 5px; /* Add border radius for styling */
        }

        .image-thumb {
            position: relative;
            overflow: hidden;
            border-top-left-radius: 5px; /* Add border radius for styling */
            border-top-right-radius: 5px; /* Add border radius for styling */
        }

        .image-thumb img {
            width: 100%; /* Ensure the image takes up the entire width of its container */
            height: 200px; /* Set a fixed height for the image */
            object-fit: cover; /* Maintain aspect ratio and cover whole container */
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
                        <li><a href="index.php" class="active">Home</a></li>
                        <li><a href="properties.php">Properties</a></li>
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

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="assets/images/video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>Say Hi! to your new Property in Gurgaon region</h6>
                <h2>Find the perfect <em>Real Estate</em></h2>
                <div class="main-button">
                    <a href="contact.html">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->


    <?php
    include 'db_connection.php';

    // Fetch the latest 8 news articles
    $sql = "SELECT * FROM news ORDER BY created_at DESC LIMIT 8";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <section class="section mt-5 mb-5" id="news">
        <h4 class="text-center">Latest News</h4>
        <div class="container">
            <br>
            <br>
            <div class="news-slider card">
            <?php foreach ($news as $item): ?>
            <div class="news-card shadow">
                <div class="row">

                
                    <div class="news-image col-lg-4 col-md-4 col-sm-6">
                        <img src="<?php echo htmlspecialchars($item['image_path']); ?>" alt="News Image">
                    </div>
                    <div class="news-content col-lg-8 col-md-8 col-sm-6">
                    <a href="news-details.php?id=<?php echo htmlspecialchars($item['id']); ?>"><h2 class="news-title"><?php echo htmlspecialchars($item['title']); ?></h2></a>
                        
                        <p class="news-date"><strong><time><?php echo htmlspecialchars($item['created_at']); ?></time></strong></p>
                        <p class="news-description"><time><?php echo htmlspecialchars($item['paragraph1']); ?></time></p>
                        
                    </div>
                    </div>
            </div>
            <?php endforeach; ?>
            </div>
            

        </div>
        <div class="text-center mt-5">

                <a href="news.php" class="btn btn-primary mt-10">See All</a>
            </div>

    </section>

   <!-- ***** Cars Starts ***** -->
   <section class="section mt-5 mb-5" id="trainers">
    <h4 class="text-center">Upcoming Projects in Gurgaon</h4>
    <div class="container">
        <br>
        <br>

        <div class="row" id="propertyContainer">
            <?php
            // Include database connection
            include 'db_connection.php';

            try {
                // Fetch properties in batches of 3
                $countSql = "SELECT COUNT(*) AS total FROM properties";
                $countStmt = $pdo->prepare($countSql);
                $countStmt->execute();
                $totalProperties = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
                $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
                $limit = 6;
                $sql = "SELECT p.id, p.name, p.type,p.location, MIN(pi.image_path) AS image_path 
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
                        // echo "<span>";
                        // echo "<del><sup>$</sup>80 000</del>  <sup>$</sup>70 000";
                        // echo "</span>";
                        echo "<h4>" . $row['name'] . "</h4>";
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
                // Handle database errors
                echo "Error: " . $e->getMessage();
            }
            ?>

        </div>

        <br>

        <!-- Load More Button -->
        <?php if ($totalProperties > 6): ?>
        <div class="text-center">

        <a href="properties.php" class="btn btn-primary">Load More</a>
        </div>
        <?php endif; ?>

    </div>
</section>
    <!-- ***** Cars Ends ***** -->

    <section class="section section-bg" id="schedule" style="background-image: url(assets/images/about-fullscreen-1-1920x700.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading dark-bg">
                        <h2>Read <em>About Us</em></h2>
                        <img src="assets/images/line-dec.png" alt="">
                        <p>Welcome to Gurgaon Properties, your trusted partner in finding the perfect property in Gurgaon. Experience exceptional service and expertise.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="cta-content text-center">
                        <p>Welcome to Gurgaon Properties, your trusted partner in navigating the dynamic real estate market of Gurgaon, India. With years of experience and a deep understanding of the local property landscape, we are committed to helping you find your dream home or the perfect investment opportunity. Our extensive portfolio includes a diverse range of residential, commercial, Industrial, and Agricultural properties, from luxurious apartments and villas to state-of-the-art office spaces and retail outlets. At Gurgaon Properties, we believe in providing personalized service tailored to meet your unique needs and preferences.</p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** Blog Start ***** -->
    <?php
include 'db_connection.php';

// Fetch the latest 3 blogs
$sql = "SELECT blogs.*, COUNT(comments.id) AS comment_count
        FROM blogs
        LEFT JOIN comments ON blogs.id = comments.blog_id
        GROUP BY blogs.id
        ORDER BY blogs.published_at DESC
        LIMIT 3";
$stmt = $pdo->query($sql);
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="section" id="our-classes" <?php if (count($blogs) === 0) echo 'style="display:none;"'; ?>>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-heading">
                    <h2>Read our <em>Blog</em></h2>
                    <img src="assets/images/line-dec.png" alt="">
                    <p>Discover the latest trends and insights in the real estate market with our blog. Stay informed on property investment tips, industry news, and expert advice tailored for Gurgaon, India.</p>
                </div>
            </div>
        </div>
        <div class="row" id="tabs">
            <div class="col-lg-4">
                <ul>
                    <?php foreach ($blogs as $index => $blog): ?>
                        <li><a href='#tabs-<?php echo $index + 1; ?>'><?php echo htmlspecialchars($blog['title']); ?></a></li>
                    <?php endforeach; ?>
                    <div class="main-rounded-button"><a href="blog.html">Read More</a></div>
                </ul>
            </div>
            <div class="col-lg-8">
                <section class='tabs-content'>
                    <?php foreach ($blogs as $index => $blog): ?>
                        <article id='tabs-<?php echo $index + 1; ?>'>
                            <img src="<?php echo htmlspecialchars($blog['image_path']); ?>" alt="" style="width:100%;">
                            <h4><?php echo htmlspecialchars($blog['title']); ?></h4>
                            <p><i class="fa fa-user"></i> John Doe &nbsp;|&nbsp; <i class="fa fa-calendar"></i> <?php echo date('d.m.Y H:i', strtotime($blog['published_at'])); ?> &nbsp;|&nbsp; <i class="fa fa-comments"></i> <?php echo $blog['comment_count']; ?> comments</p>
                            <p class="truncate-text"><?php echo htmlspecialchars($blog['paragraph1']); ?></p>
                            <div class="main-button">
                                <a href="blog-details.php?id=<?php echo $blog['id']; ?>">Continue Reading</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </section>
            </div>
        </div>
    </div>
</section>


    <!-- ***** Blog End ***** -->

    <!-- ***** Call to Action Start ***** -->
    <section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <h2>Send us a <em>message</em></h2>
                        <p>Have questions or need assistance? Our team is here to help. Send us a message, and we'll get back to you as soon as possible. We value your inquiries and are dedicated to providing excellent customer support.</p>
                        <div class="main-button">
                            <a href="contact.html">Contact us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Call to Action End ***** -->

    <!-- ***** Testimonials Item Start ***** -->
    <section class="section" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Read our <em>Testimonials</em></h2>
                        <img src="assets/images/line-dec.png" alt="waves">
                        <p>Read what our satisfied clients have to say about our services. Our commitment to excellence in real estate is reflected in their positive experiences and glowing testimonials. Your satisfaction is our priority.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="features-items">
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="assets/images/features-first-icon.png" alt="First One">
                            </div>
                            <div class="right-content">
                                <h4>Rishabh Aggrawal</h4>
                                <p><em>"Amazing service! Found my dream home in Gurgaon with their help. The team was incredibly supportive and knowledgeable throughout the entire process. Highly recommend them for anyone looking to buy property in the area. Their expertise made the experience seamless and enjoyable."</em></p>
                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="assets/images/features-first-icon.png" alt="second one">
                            </div>
                            <div class="right-content">
                                <h4>Himanshu Singh</h4>
                                <p><em>"Professional and reliable. They made the buying process smooth and stress-free. Every detail was handled with care, and their market insights were invaluable. We felt confident and well-informed at every step. Thank you for helping us find the perfect home!"</em></p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="features-items">
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="assets/images/features-first-icon.png" alt="fourth muscle">
                            </div>
                            <div class="right-content">
                                <h4>Aditya Gupta</h4>
                                <p><em>"Exceptional support and guidance throughout our home search. The team's dedication and personalized approach made all the difference. We felt understood and valued. Couldn't be happier with the service provided. Truly a top-notch real estate agency."</em></p>
                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="assets/images/features-first-icon.png" alt="training fifth">
                            </div>
                            <div class="right-content">
                                <h4>Sarthak Kumar</h4>
                                <p><em>"Fantastic experience! They truly understand the market and customer needs. The team's attention to detail and commitment to client satisfaction was evident from start to finish. We found our ideal property thanks to their efforts. Highly recommend them for anyone in the market for a new home."</em></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <br>

            <!-- <div class="main-button text-center">
                <a href="testimonials.html">Read More</a>
            </div> -->
        </div>
    </section>
    <!-- ***** Testimonials Item End ***** -->
    
    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        Copyright © 2020 Gurgaon Properties
                        
                    </p>
                    <p><a href="admin-login.php">Admin</a></p>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="assets/js/mixitup.js"></script> 
    <script src="assets/js/accordions.js"></script>
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

    <!-- slider javascript function for news slider  -->
<script>
            $(document).ready(function(){
                $('.news-slider').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 1000,
                    arrows: false,
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            });
</script>

    <!-- load more button function for the properties cards section  -->
<script>
            document.addEventListener('DOMContentLoaded', function () {
                const loadMoreBtn = document.getElementById('loadMoreBtn');
                const propertyContainer = document.getElementById('propertyContainer');
                let offset = <?php echo isset($_GET['offset']) ? (int)$_GET['offset'] : 0; ?>;
                const limit = 3;

                loadMoreBtn.addEventListener('click', function () {
                    // Update offset
                    offset += limit;

                    // Fetch more properties
                    fetch(`load-more.php?offset=${offset}`)
                        .then(response => response.text())
                        .then(data => {
                            // Append new properties to the container
                            propertyContainer.innerHTML += data;

                            // Hide Load More button if there are no more properties
                            if (data.trim() === '') {
                                loadMoreBtn.style.display = 'none';
                            }
                        })
                        .catch(error => console.error('Error fetching more properties:', error));
                });
            });
</script>

     <!--javascript function for truncate the text for the blog section  -->
<script>
    // Function to truncate text
    function truncateText() {
        var maxLength = 300; // Maximum length of text
        var elements = document.querySelectorAll('.truncate-text'); // Select all elements to truncate

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
    window.onload = truncateText;
</script>

     <!-- javascript function for truncate text for the news slider  -->
<script>
    // Function to truncate text
    function truncate() {
        var maxLength = 200; // Maximum length of text
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