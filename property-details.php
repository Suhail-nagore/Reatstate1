    <?php
// Include database connection
include 'db_connection.php';

// Check if property ID is provided in the URL
if (isset($_GET['id'])) {
    // Get property ID from URL
    $propertyId = $_GET['id'];

    // Fetch property details from the database
    $sql = "SELECT p.name AS property_name, p.description, p.latitude, p.longitude, GROUP_CONCAT(DISTINCT ps.specification) AS specifications, GROUP_CONCAT(DISTINCT pa.amenity) AS amenities, GROUP_CONCAT(DISTINCT pi.image_path) AS image_paths
            FROM properties p
            LEFT JOIN property_specifications ps ON p.id = ps.property_id
            LEFT JOIN property_amenities pa ON p.id = pa.property_id
            LEFT JOIN property_images pi ON p.id = pi.property_id
            WHERE p.id = ?
            GROUP BY p.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$propertyId]);
    $property = $stmt->fetch(PDO::FETCH_ASSOC);
?>
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Bootstrap JS (popper.js included) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- jQuery (required for Bootstrap JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
    /* Large devices (desktops, 992px and up) */
    @media (min-width: 992px) {
        .carousel-item img {
            height: 600px; /* Adjust as needed */
        }
    }

    /* Medium devices (tablets, 768px and up) */
    @media (max-width: 991.98px) {
        .carousel-item img {
            height: 500px; /* Adjust as needed */
        }
    }

    /* Small devices (landscape phones, 576px and up) */
    @media (max-width: 767.98px) {
        .carousel-item img {
            height: 400px; /* Adjust as needed */
        }
    }

    /* Extra small devices (portrait phones, less than 576px) */
    @media (max-width: 575.98px) {
        .carousel-item img {
            height: 300px; /* Adjust as needed */
        }
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
                      <a href="index.php" class="logo" style="color: white; font-size: 24px;">Real Estate<em> Website</em></a>
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
                        <h2><?php echo $property['property_name']; ?></h2>
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

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                // Split image paths
                $imagePaths = explode(',', $property['image_paths']);
                // Output carousel indicators
                for ($i = 0; $i < count($imagePaths); $i++) {
                    $active = ($i == 0) ? 'active' : '';
                    echo "<li data-target='#carouselExampleIndicators' data-slide-to='$i' class='$active'></li>";
                }
                ?>
            </ol>
            <div class="carousel-inner">
                <?php
                // Output carousel items
                foreach ($imagePaths as $index => $imagePath) {
                    $active = ($index == 0) ? 'active' : '';
                    echo "<div class='carousel-item $active'>";
                    echo "<img class='d-block w-100' src='$imagePath' alt='Property Image' style='object-fit: cover;'>"; // Adjust height as needed
                    echo "</div>";
                }
                ?>
            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <br>
        <br>

        <div class="row" id="tabs">
            <div class="col-lg-4">
                <ul>
                    <li><a href='#tabs-1'><i class="fa fa-cog"></i> Property Specs</a></li>
                    <li><a href='#tabs-2'><i class="fa fa-info-circle"></i> Property Description</a></li>
                    <li><a href='#tabs-3'><i class="fa fa-phone"></i> Contact Details</a></li>
                </ul>
            </div>
            <div class="col-lg-8">
                <section class='tabs-content' style="width: 100%;">
                <article id='tabs-1'>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h4>Property Specifications</h4>
                                    <?php
                                    // Split specifications
                                    $specs = explode(',', $property['specifications']);
                                    // Output property specifications
                                    foreach ($specs as $spec) {
                                        echo "<label>$spec</label><br>";
                                    }
                                    ?>
                                </div>
                                <div class="col-sm-6">
                                    <h4>Amenities</h4>
                                    <?php
                                    // Split amenities
                                    $amenities = explode(',', $property['amenities']);
                                    // Output property amenities
                                    foreach ($amenities as $amenity) {
                                        echo "<label>$amenity</label><br>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </article>
                    <article id='tabs-2'>
                        <h4>Property Description</h4>
                        <p><?php echo $property['description']; ?></p>
                    </article>
                    <article id='tabs-3'>
                        <h4>Contact Details</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Name</label>
                                <p>Name here</p>
                            </div>
                            <div class="col-sm-6">
                                <label>Email</label>
                                <p>Email@example.com</p>
                            </div>
                            <div class="col-sm-6">
                                <label>Contact At</label>
                                <p>0123456789</p>
                            </div>
                            <!-- Add other contact details here -->
                        </div>
                        <div id="map">
                            <iframe src="https://maps.google.com/maps?q=<?php echo $property['latitude']; ?>,<?php echo $property['longitude']; ?>&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="600px" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </article>
                </section>
            </div>
        </div>
    </div>
</section>

<?php
} else {
    // If property ID is not provided, show an error message
    echo "<div class='container'><h2>Property not found.</h2></div>";
}
?>



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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Enquiry</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="contact-us">
            <div class="contact-form">
              <form action="#" id="contact">
                  <div class="row">
                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Enter full name" required="">
                          </fieldset>
                       </div>

                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Enter email address" required="">
                          </fieldset>
                       </div>
                  </div>

                  <div class="row">
                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Enter phone" required="">
                          </fieldset>
                       </div>

                       <div class="col-md-6">
                          <div class="row">
                             <div class="col-md-6">
                                <fieldset>
                                  <input type="text" class="form-control" placeholder="From date" required="">
                                </fieldset>
                             </div>

                             <div class="col-md-6">
                                <fieldset>
                                  <input type="text" class="form-control" placeholder="To date" required="">
                                </fieldset>
                             </div>
                          </div>
                       </div>
                  </div>
              </form>
           </div>
           </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary">Send Request</button>
          </div>
        </div>
      </div>
    </div>

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