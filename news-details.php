<?php
include 'db_connection.php';

// Get the news ID from the URL
$newsId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch the news details
$sql = "SELECT * FROM news WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $newsId]);
$news = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$news) {
    // News not found, handle the error as needed
    die('News not found');
}
?>
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
</head>
<body>
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
                            <li><a href="properties.php">Properties</a></li>
                            <li><a href="about.html">About</a></li>
                            <li><a href="blog.php" class="active">Blogs</a></li>

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
    <!-- Header and other sections as defined above -->
    <section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br><br>
                        <h2><?php echo htmlspecialchars($news['title']); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog details section -->
    <section class="section" id="our-classes">
        <div class="container">
            <br><br>
            <section class='tabs-content'>
                <article>
                    <h4><?php echo htmlspecialchars($news['title']); ?></h4>
                    <p><i class="fa fa-user"></i> Admin &nbsp;|&nbsp; <i class="fa fa-calendar"></i> <?php echo date('d.m.Y H:i', strtotime($news['created_at'])); ?> &nbsp;|&nbsp;</p>
                    <div><img src="<?php echo htmlspecialchars($news['image_path']); ?>" alt="" style="width: 100%;"></div>
                    <br>
                    <p><?php echo htmlspecialchars($news['paragraph1']); ?></p>
                    <p><?php echo htmlspecialchars($news['paragraph2']); ?></p>
                    <p><?php echo htmlspecialchars($news['paragraph3']); ?></p>
                    <ul class="social-icons">
                        <li>Share this:</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                    </ul>
                </article>
            </section>

            <br><br><br>

            <!-- Comments section -->
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © 2020 Gurgaon Properties</p>
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
</body>
</html>
