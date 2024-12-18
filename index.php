<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sip & Savor Coffee Shop offers freshly brewed coffee, delicious pastries, and a warm atmosphere. Visit us for a sip of comfort and a taste to savor!">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="50">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="#">
                <img src="images/logo.png" alt="Sip and Savor Logo" height="30">
            </a>

            <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Sip & Savor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="view/menu.php">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="admin.php">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="#">Portfolio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="#">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>

            <a href="view/login.php" class="btn btn-dark login-button">Login</a>
            <a href="view/admin_login.php" class="btn btn-dark login-button">Login As Administrator</a>
        </div>                                                                    
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-white py-5">
        <div class="container text-center">
            <h1>Sip & Savor</h1>
            <h2>Your Daily Ritual, Our Crafted Art</h2>
            <!-- <a href="menu.php" class="btn btn-secondary btn-lg mt-3">Explore Our Menu</a> -->
        </div>
    </section>

    <!-- Home Section -->
   <!-- Home Section -->
<section id="home" class="home py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 order-md-2">
                <img src="images/home.jpg" alt="Sip and Savor Coffee Shop" class="img-fluid rounded home-image">
            </div>
            <div class="col-md-6 order-md-1 text-center">
                <div class="content">
                    <h3>Inhale coffee, exhale negativity</h3>
                    <p>
                        Sip and Savor Coffee Shop is a cozy haven for coffee enthusiasts and casual sippers alike.
                        We offer a wide variety of freshly brewed coffee, specialty drinks, and delightful pastries in a warm and inviting atmosphere.
                        Whether you're here for a quick pick-me-up, a productive work session, or a relaxing chat with friends, Sip and Savor is your perfect escape.
                        Join us for a sip of comfort and a taste to savor!
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Features Section -->
    <section class="features bg-light py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <i class="fas fa-coffee feature-icon"></i>
                    <h4 class="mt-3">Premium Beans</h4>
                    <p>We source the finest coffee beans from around the world, ensuring each cup is a unique experience.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="fas fa-leaf feature-icon"></i>
                    <h4 class="mt-3">Fresh Ingredients</h4>
                    <p>Our pastries and snacks are made fresh daily using locally sourced, high-quality ingredients.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="fas fa-calendar-alt feature-icon"></i>
                    <h4 class="mt-3">Community Events</h4>
                    <p>Join us for live music, poetry nights, and coffee workshops that bring our community together.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="featured-products py-5">
        <div class="container">
            <h2 class="text-center mb-4">Our Featured Offerings</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="images/index_pic.png" class="card-img-top" alt="Specialty Coffee">
                        <div class="card-body">
                            <h5 class="card-title">Signature Blend</h5>
                            <p class="card-text">Our house-crafted blend that promises a perfect balance of flavor and aroma.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="images/pastry.png" class="card-img-top" alt="Pastry Selection">
                    <div class="card-body">
                        <h5 class="card-title">Fresh Pastries</h5>
                        <p class="card-text">Delectable pastries baked fresh every morning to complement your coffee.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="images/mocktail.jpg" class="card-img-top" alt="Cold Brew">
                    <div class="card-body">
                        <h5 class="card-title">Cold Brew Selection</h5>
                        <p class="card-text">Smooth, refreshing cold brews perfect for hot days and cool refreshment.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

            <!-- SlideShow Start -->
            <!-- <section class="slideshow py-5">
            <div id="carouselSlides" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img class="d-block w-100" src="images/about_page.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="images/coffee shop.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="images/coffee shop2.jpg" alt="Third slide">
                    </div>
                </div>
                </div>
</section> -->
<!-- SlideShow End -->
            
    <!-- Footer -->
    <footer>
        <div class="footer-content bg-dark text-white py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h3>Quick Links</h3>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white">Home</a></li>
                            <li><a href="#" class="text-white">About</a></li>
                            <li><a href="#" class="text-white">Menu</a></li>
                            <li><a href="#" class="text-white">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h3>Have Questions?</h3>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-phone"></i> (233) 54 876 1535</li>
                            <li><i class="fas fa-envelope"></i> info@sipandsavor.com</li>
                            <li><i class="fas fa-map-marker-alt"></i>Rocky Road St, Lashibi</li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h3>Operating Hours</h3>
                        <ul class="list-unstyled">
                            <li>Mon - Thur: 8am - 10pm</li>
                            <li>Fri - Sat:8am - 11pm</li>
                            <li>Sun: 12pm - 10pm</li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h3>Follow Us</h3>
                        <div class="social-links">
                            <a href="#" class="text-white me-2"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom bg-black text-white text-center py-3">
            <p class="mb-0">&copy; 2024 Sip & Savor. All rights reserved.</p>
        </div>
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QjSQM+kIrIQJ+T9h5UOkpLBQDl5J39dIPmUVDfiDhvto5spB1PfPynHxW6Azwy2m" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});


$(document).ready(function () {
            $('.image-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                autoplay: true,
                autoplayTimeout: 2000,
                responsive: {
                    0: { items: 1 },
                    768: { items: 2 },
                    992: { items: 3 }
                }
            });
        });

        </script>

</body>
</html>
