<?php
include 'db_connection.php';

// Fetch the initial set of blogs (5 blogs)
$sql = "SELECT blogs.*, (SELECT COUNT(*) FROM comments WHERE comments.blog_id = blogs.id) AS comment_count FROM blogs ORDER BY published_at DESC LIMIT 5";
$stmt = $pdo->query($sql);
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalBlogs = count($blogs);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <title>Reat state</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/style.css">

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
                        <a href="index.php" class="logo" style="color: white; font-size: 24px;">Real Estate<em>
                                Website</em></a>
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
    <!-- ***** Header Area End ***** -->

    <section class="section section-bg" id="call-to-action"
        style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2>Read our <em>Blog</em></h2>
                        <p>Get each detail information about your next real estate investment with us...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** Blog Start ***** -->
    <section class="section" id="our-classes">
        <div class="container">
            <br>
            <br>
            <div class="row">
                <div class="col-lg-8">
                    <section class='tabs-content' id="blog-container">
                        <?php foreach ($blogs as $blog): ?>
                        <article>
                            <img src="<?php echo htmlspecialchars($blog['image_path']); ?>" alt="blog image" style="width:100%;">
                            <h4>
                                <?php echo htmlspecialchars($blog['title']); ?>
                            </h4>
                            <p><i class="fa fa-user"></i> Admin &nbsp;|&nbsp; <i class="fa fa-calendar"></i>
                                <?php echo date('d.m.Y H:i', strtotime($blog['published_at'])); ?> &nbsp;|&nbsp; <i
                                    class="fa fa-comments"></i>
                                <?php echo $blog['comment_count']; ?> comments
                            </p>
                            <p class="truncate-text">
                                <?php echo htmlspecialchars($blog['paragraph1']); ?>
                            </p>
                            <div class="main-button">
                                <a href="blog-details.php?id=<?php echo $blog['id']; ?>">Continue Reading</a>
                            </div>
                        </article>
                        <br><br>
                        <?php endforeach; ?>
                    </section>
                    <?php if ($totalBlogs >= 5): ?>
                        <div class="main-button" id="load-more-container">
                            <button id="load-more" class="btn btn-primary">Load More</button>
                        </div>
                    <?php endif;?>
                </div>

                <div class="col-lg-4">

                <?php
                $sql = "SELECT blogs.*, (SELECT COUNT(*) FROM comments WHERE comments.blog_id = blogs.id) AS comment_count FROM blogs ORDER BY published_at DESC LIMIT 8";
                $stmt = $pdo->query($sql);
                $recentBlogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                    <h5 class="h5">Recent posts</h5>

                    <ul>
                    <?php foreach ($blogs as $blog): ?>
                        <li>
                            <p><a href="blog-details.php?id=<?php echo $blog['id']; ?>"><?php echo htmlspecialchars($blog['title']); ?></a></p>
                            <small><i class="fa fa-user"></i> Admin &nbsp;|&nbsp; <i class="fa fa-calendar"></i>
                            <?php echo date('d.m.Y H:i', strtotime($blog['published_at'])); ?></small>
                        </li>

                        <li><br></li>
                    <?php endforeach; ?>    
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Blog End ***** -->

    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        Copyright © 2020 Company Name

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
        let offset = 5;

        document.getElementById('load-more').addEventListener('click', function() {
            $.ajax({
                url: 'load_more_blogs.php',
                type: 'GET',
                data: {
                    offset: offset
                },
                success: function(response) {
                    const blogs = JSON.parse(response);
                    if (blogs.length > 0) {
                        blogs.forEach(blog => {
                            $('#blog-container').append(`
                                <article>
                                    <img src="${blog.image_path}" alt="">
                                    <h4>${blog.title}</h4>
                                    <p><i class="fa fa-user"></i> John Doe &nbsp;|&nbsp; <i class="fa fa-calendar"></i> ${blog.created_at} &nbsp;|&nbsp; <i class="fa fa-comments"></i> ${blog.comment_count} comments</p>
                                    <p class="truncate-text">${blog.paragraph1}</p>
                                    <div class="main-button">
                                        <a href="blog-details.php?id=${blog.id}">Continue Reading</a>
                                    </div>
                                </article>
                                <br><br>
                            `);
                        });
                        offset += 5;
                    } else {
                        $('#load-more-container').html('<p>No more blogs to load.</p>');
                    }
                }
            });
        });
    </script>

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

</body>

</html>