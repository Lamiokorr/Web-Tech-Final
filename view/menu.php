<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/menu.css">
</head>
<body>
     <!-- Navigation Bar -->
     <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="#">
                <img src="logo.png" alt="Sip and Savor Logo" height="30">
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
                            <a class="nav-link mx-lg-2 active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="#">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="#">Services</a>
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

            <a href="cart.php" class="btn btn-light">
    <i class="fa fa-shopping-cart"></i></a>
        </div>
    </nav>
<!-- Search Bar -->
    <div class="search-container">
        <label for="search">Search </label>
        <input type="text" id="search" placeholder="Enter food title...">

        <label for="category">Filter by Category:</label>
        <select id="category">
            <option value="">All Categories</option>
            <option value="Coffee">Coffee</option>
            <option value="Other Beverage">Other Beverage</option>
            <option value="Pastries">Pastries</option>
        </select>

        <button id="clearFilters" class="clear-btn">Clear</button>
        </div>

        <div id="results" class="results"></div>


    <!-- Menu Section -->
    <div class="gallery-container">

    <!-- COFFEE SECTION -->
    <!-- <h2 class="section-title" data-category="Coffee">Coffee</h2> -->
    <!-- <div class="galleries coffee-galleries"> -->
        <div class="gallery" data-category="Coffee">
            <a target="_blank" href="../images/Americano Coffee.jpg">
                <img src="../images/Americano Coffee.jpg" alt="Americano">
            </a>
            <div class="desc">Americano</div>
            <div class="price">GHS30.00</div>
            <button onclick="addToCart('Americano', 30)">Add to Cart</button>
        </div>

        <div class="gallery" data-category="Coffee">
            <a target="_blank" href="../images/Cappuccino.jpg">
                <img src="../images/Cappuccino.jpg" alt="Cappuccino">
            </a>
            <div class="desc">Cappuccino</div>
            <div class="price">GHS40.00</div>
            <button onclick="addToCart('Cappucino', 40)">Add to Cart</button>
        </div>

        <div class="gallery" data-category="Coffee">
            <a target="_blank" href="../images/Double Chocolate Chip Frappuccino.jpg">
                <img src="../images/Double Chocolate Chip Frappuccino.jpg" alt="Double Chocolate Chip Frappuccino">
            </a>
            <div class="desc">Double Chocolate Chip Frappuccino</div>
        <div class="price">GHS50.00</div>
        <button onclick="addToCart('Double Chocolate Chip Frappuccino', 50)">Add to Cart</button>
        </div>

        <!-- <div class="gallery-container"> -->
        <div class="gallery" data-category="Coffee">
            <a target="_blank" href="../images/expresso.png">
                <img src="../images/expresso.png" alt="Expresso" width="600" height="900">
            </a>
            <div class="desc">Expresso</div>
            <div class="price">GHS30.00</div>
            <button onclick="addToCart('Expresso', 30)">Add to Cart</button>
        </div>

        <div class="gallery" data-category="Coffee">
            <a target ="_blank" href="../images/Hot Mocha Latte.jpg">
                <img src="../images/Hot Mocha Latte.jpg" alt="Hot Mocha Latte">
            </a>
            <div class="desc">Hot Mocha Latte</div>
        <div class="price">GHS45.00</div>
        <button onclick="addToCart('Hot Mocha Latte', 45)">Add to Cart</button>
        </div>

        <div class="gallery" data-category="Coffee">
            <a target="_blank" href="../images/iced americano.jpg">
                <img src="../images/iced americano.jpg" alt="Iced Americano">
            </a>
            <div class="desc">Iced Americano</div>
        <div class="price">GHS40.00</div>
        <button onclick="addToCart('Iced Americano', 40)">Add to Cart</button>
        </div>

        <div class="gallery" data-category="Coffee">
            <a target="_blank" href="../images/iced caramel latte.jpg">
                <img src="../images/iced caramel latte.jpg" alt="Iced Caramel Latte">
            </a>
            <div class="desc">Iced Caramel Latte</div>
        <div class="price">GHS50.00</div>
        <button onclick="addToCart('Iced Caramel Latte', 50)">Add to Cart</button>
        </div>

        <div class="gallery" data-category="Coffee">
            <a target="_blank" href="../images/iced vanilla latte.jpg">
                <img src="../images/iced vanilla latte.jpg" alt="Iced Vanilla Latte">
            </a>
            <div class="desc">Iced Vanilla Latte</div>
        <div class="price">GHS40.00</div>
        <button onclick="addToCart('Iced Vanilla Latte', 40)">Add to Cart</button>
        </div>

        <div class="gallery" data-category="Coffee">
            <a target="_blank" href="../images/Macchiato.jpg">
                <img src="../images/Macchiato.jpg" alt="Macchiato">
            </a>
            <div class="desc">Macchiato</div>
        <div class="price">GHS40.00</div>
        <button onclick="addToCart('Macchiato', 40)">Add to Cart</button>
        </div>

        <div class="gallery" data-category="Coffee">
            <a target="_blank" href="../images/Mocha.jpg">
                <img src="../images/Mocha.jpg" alt="Mocha">
            </a>
            <div class="desc">Mocha</div>
        <div class="price">GHS50.00</div>
        <button onclick="addToCart('Mocha', 50)">Add to Cart</button>
        </div>

        <div class="gallery" data-category="Coffee">
            <a target="_blank" href="../images/Salted Caramel Macchiato.jpg">
                <img src="../images/Salted Caramel Macchiato.jpg" alt="Salted Caramel Macchiato">
            </a>
            <div class="desc">Salted Caramel Macchiato</div>
        <div class="price">GHS50.00</div>
        <button onclick="addToCart('Salted Caramel Macchiato', 50)">Add to Cart</button>
    </div><br>

    <!-- OTHER BEVERAGES SECTION -->
    <!-- <h2 class="section-title" data-category="Other Beverage">Other Beverages</h2> -->
    <!-- <div class="galleries other-beverage-galleries"> -->
        <div class="gallery" data-category="Other Beverage">
            <a target="_blank" href="../images/iced matcha green tea.jpg">
                <img src="../images/iced matcha green tea.jpg" alt="Iced Matcha Green Tea">
            </a>
            <div class="desc">Iced Matcha Green Tea</div>
        <div class="price">GHS40.00</div>
        <button onclick="addToCart('Iced Matcha Green Tea', 40)">Add to Cart</button>
    </div>

    <div class="gallery" data-category="Other Beverage">
            <a target="_blank" href="../images/Hot-Chocolate.jpg">
                <img src="../images/Hot-Chocolate.jpg" alt="Hot Chocolate">
            </a>
            <div class="desc">Hot Chocolate</div>
        <div class="price">GHS45.00</div>
        <button onclick="addToCart('Hot Chocolate', 45)">Add to Cart</button>
    </div>

    <div class="gallery" data-category="Other Beverage">
            <a target="_blank" href="../images/lemonade.jpg">
                <img src="../images/lemonade.jpg" alt="Lemonade">
            </a>
            <div class="desc">Lemonade</div>
        <div class="price">GHS15.00</div>
        <button onclick="addToCart('Lemonade', 15)">Add to Cart</button>

        <div class="gallery" data-category="Other Beverage">
            <a target="_blank" href="../images/water.jpg">
                <img src="../images/water.jpg" alt="Bottled Water">
            </a>
            <div class="desc">Bottled Water</div>
        <div class="price">GHS15.00</div>
        <button onclick="addToCart('Bottled Water', 7)">Add to Cart</button>
    </div>
 
    <!-- PASTRIES  SECTION-->
    <!-- <h2 class="section-title" data-category="Pastries">Pastries</h2> -->
    <!-- <div class="galleries pastries-galleries"> -->
        <div class="gallery" data-category="Pastries">
            <a target="_blank" href="../images/brownies.jpg">
                <img src="../images/brownies.jpg" alt="Brownies">
            </a>
            <div class="desc">Brownies</div>
        <div class="price">GHS50.00</div>
        <button onclick="addToCart('Brownies', 50)">Add to Cart</button>
    </div>

    <div class="gallery" data-category="Pastries">
            <a target="_blank" href="../images/cheesecake.webp">  
                <img src="../images/cheesecake.webp" alt="cheesecake">
            </a>
            <div class="desc">Cheesecake</div>
        <div class="price">GHS35.00</div>
        <button onclick="addToCart('Cheesecake', 35)">Add to Cart</button>
    </div>

    <div class="gallery" data-category="Pastries">
            <a target="_blank" href="../images/cinnamon rolls.jpg">
                <img src="../images/cinnamon rolls.jpg" alt="Cinnamon rolls">
            </a>
            <div class="desc">Cinnamon rolls</div>
        <div class="price">GHS35.00</div>
        <button onclick="addToCart('Cinnamon rolls', 35)">Add to Cart</button>
    </div>

    <div class="gallery" data-category="Pastries">
            <a target="_blank" href="../images/cookies.jpg">
                <img src="../images/cookies.jpg" alt="cookies">
            </a>
            <div class="desc">Cookies</div>
        <div class="price">GHS30.00</div>
        <button onclick="addToCart('Cookies', 30)">Add to Cart</button>
    </div>

    <div class="gallery" data-category="Pastries">
            <a target="_blank" href="../images/puff puff.jpg">
                <img src="../images/puff puff.jpg" alt="puff-puff">
            </a>
            <div class="desc">Puff puff</div>
        <div class="price">GHS15.00</div>
        <button onclick="addToCart('Puff puff', 15)">Add to Cart</button>
    </div>

    <div class="gallery" data-category="Pastries">
            <a target="_blank" href="../images/tiramisu.jpg">
                <img src="../images/tiramisu.jpg" alt="Tiramisu Cake Slice">
            </a>
            <div class="desc">Tiramisu Cake Slice</div>
        <div class="price">GHS30.00</div>
        <button onclick="addToCart('Tiramisu Cake Slice', 30)">Add to Cart</button>
    </div>  
</div>


<!-- Footer -->
<footer class="footer">
        <div class="container">
            <p>&copy; 2024 Sip & Savor. All rights reserved.</p>
        </div>
    </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QjSQM+kIrIQJ+T9h5UOkpLBQDl5J39dIPmUVDfiDhvto5spB1PfPynHxW6Azwy2m" crossorigin="anonymous"></script>     
        
          <script>
            document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const categorySelect = document.getElementById('category');
            const clearFiltersBtn = document.getElementById('clearFilters');   
            const resultsDiv = document.getElementById('results');
            const galleries = Array.from(document.querySelectorAll('.gallery'));

    function filterGalleries() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedCategory = categorySelect.value;

        let visibleCount = 0;

        galleries.forEach(gallery => {
            const desc = gallery.querySelector('.desc').textContent.toLowerCase();
            const category = gallery.getAttribute('data-category').toLowerCase();

            const matchesSearch = searchTerm === '' || desc.includes(searchTerm);
            const matchesCategory = selectedCategory === '' || category === selectedCategory.toLowerCase();

            if (matchesSearch && matchesCategory) {
                gallery.style.display = 'block';
                visibleCount++;
            } else {
                gallery.style.display = 'none';
            }
        });

        // Update results count
        resultsDiv.textContent = `${visibleCount} result(s) found.`;
    }

    function clearFilters() {
        searchInput.value = '';
        categorySelect.value = '';
        filterGalleries();
    }

    // Event listeners
    searchInput.addEventListener('input', filterGalleries);
    categorySelect.addEventListener('change', filterGalleries);
    clearFiltersBtn.addEventListener('click', clearFilters);

    // Initial display of all galleries
    filterGalleries();
});

 function addToCart(productName, price) {
    fetch('../actions/add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            'product_name': productName,
            'price': price
        }),
    })
    Swal.fire({
  title: 'Added to Cart!',
  text: `${productName} has been added to your cart for GHS${price}.`,
  icon: 'success',
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "OK!"
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
      title: "Added to Cart!",
      icon: "success"
    });
  }
});
}
</script>
</body>
</html>