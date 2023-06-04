<?php include_once 'templates/header.php'; ?>

<div class="row mb-3">
    <div class="col-md-10 ps-4">
        <!-- products -->
        <div class='row'>


            <!--  Fetching Products -->
            <?php
            Query::fetchProducts();
            ?>


        </div>
    </div>

    <div class="col-md-2">
        <!-- sidenav -->
        <ul class="navbar-nav text-center me-auto border-bottom border-danger border-3">
            <li class="nav-item bg-info">
                <a href="#" class="nav-link text-light">
                    <h4>Brands</h4>
                </a>
            </li>

            <!-- SHow all brands -->
            <?php
            Query::fetchBrands();
            ?>
        </ul>



        <ul class="navbar-nav text-center me-auto">
            <li class="nav-item bg-secondary">
                <a href="#" class="nav-link text-light">
                    <h4>Categories</h4>
                </a>
            </li>
            <!-- categories list from db -->
            <?php
            Query::fetchCategories();
            ?>
        </ul>
    </div>
</div>



<script>
    // Title
    <?php include_once "templates/templateFunctions.php";
    displayTitle('Home') ?>
</script>

<!-- Footer -->
<?php require "./templates/footer.php"; ?>