<?php include_once 'templates/header.php'; ?>

<div class="container py-3">
    <form id='updatecart' action="">

        <table class="table table-bordered text-center cart-table">
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Product Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tablebody">

                <?php Query::showCartTable(); ?>

            </tbody>
        </table>
    </form>
    <div class="d-flex justify-content-around border bg-light py-3">
        <h3 class="text-success">Total Amount : <strong> <?php Query::showTotalCart(); ?> </strong></h3>
        <a href="/transact.php" class="btn btn-warning">Go to Buy</a>
        <a href="/" class="btn btn-secondary">Back to Home</a>
    </div>


</div>
<script>
    <?php include_once "templates/templateFunctions.php";
    removeSearch();
    displayTitle('Cart'); ?>
</script>
<?php require "./templates/footer.php"; ?>



<?php Query::updateProductQty('cart.php'); ?>
<?php Query::removeCartItemByOne('cart.php'); ?>