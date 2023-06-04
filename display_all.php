<?php include_once "templates/header.php"; ?>

<div class="row">
    <div class="col-md-10 ps-4">
        <!-- products -->
        <div class='row g-3'>


            <!--  Fetching Products -->
            <?php
            Query::fetchAllProducts();
            ?>


        </div>
    </div>

    <div class="col-md-2 p-0">
        <!-- sidenav -->
        <ul class="navbar-nav text-center me-auto border-bottom border-danger border-3">
            <li class="nav-item bg-info">
                <a href="#" class="nav-link text-light">
                    <h4>Delivery Brands</h4>
                </a>
            </li>

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
    <?php include_once "templates/templateFunctions.php";
    displayTitle('ALl Products') ?>
</script>
<!-- Footer -->
<?php require "./templates/footer.php"; ?>