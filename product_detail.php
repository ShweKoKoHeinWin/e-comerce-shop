<?php include_once "templates/header.php"; ?>


<div class="row container-fluid py-3">
    <div class="col-md-8 mb-3">
        <!-- show product detail -->
        <?php Query::showProductDetail(); ?>
    </div>

    <!-- Display related products -->
    <div class="col-md-4">
        <h3 class="bg-info p-2">Related Products</h3>

        <div class="row">
            <?php Query::showRelatedProduct(); ?>
        </div>
    </div>
</div>
<script>
    <?php include_once "templates/templateFunctions.php";
    displayTitle('Product Detail') ?>
</script>
<!-- Footer -->
<?php require "./templates/footer.php"; ?>