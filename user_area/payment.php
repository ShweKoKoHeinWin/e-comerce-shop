<?php Query::redirectHomeBySession(0); ?>

<div class="container">
    <form action="">
        <div class="row">
            <div class="col-6">

            </div>
        </div>
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

                <?php Query::showPaymentTable();
                ?>

            </tbody>
        </table>
        <div class="d-flex justify-content-around border bg-light py-3">
            <h3 class="text-success">Total Amount : <strong> <?php Query::showTotalCart(); ?> </strong></h3>
            <a href="/orderController.php?payment=1&<?php echo http_build_query(['orderIdQtyArr' => Query::orderIdQtyArr()]); ?>" class="btn btn-warning">Order</a>

            <a href="/" class="btn btn-secondary">Back to Home</a>
        </div>
    </form>
</div>

<script>
    <?php include_once "templates/templateFunctions.php";
    removeSearch();
    displayTitle('Payment'); ?>
</script>