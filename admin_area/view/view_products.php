<?php include('../includes/connect.php');

if (!isset($_SESSION['adminid']) && !isset($_SESSION['adminname'])) {
    header('Location:auth.php?login');
} ?>
<h2 class="text-center text-primary bg-warning">Products</h2>
<ul class="nav">
    <li class="nav-item me-3">
        <a class="btn btn-primary" href="index.php?view_products&allproducts">All</a>
    </li>
    <li class="nav-item me-3">
        <a class="btn btn-success" href="index.php?view_products&instock">In Stock</a>
    </li>
    <li class="nav-item me-3">
        <a class="btn btn-secondary" href="index.php?view_products&outofstock">Out of stock</a>
    </li>
</ul>
<?php if (isset($_GET['view_products']) && isset($_GET['allproducts'])) { ?>
    <h3 class="text-center text-muted">All Products</h3>
<?php } else if (isset($_GET['view_products']) && isset($_GET['instock'])) { ?>
    <h3 class="text-center text-muted">In Stock Products</h3>
<?php } else if (isset($_GET['view_products']) && isset($_GET['outofstock'])) { ?>
    <h3 class="text-center text-muted">Out Of Stock Products</h3>
<?php } ?>

<table class="table table-striped table-bordered table-dark mb-4 text-center">
    <thead>
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Image</th>
            <th>Price</th>
            <th>Status</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($_GET['view_products']) && isset($_GET['allproducts'])) { ?>
            <?php
            $all_products_qry = "SELECT * FROM products ORDER BY product_title ASC";
            $all_products_result = mysqli_query($connect, $all_products_qry);
            if ($all_products = mysqli_fetch_all($all_products_result, MYSQLI_ASSOC)) { ?>
                <?php foreach ($all_products as $no => $product) { ?>
                    <tr style="vertical-align: middle;">
                        <td><?= $no + 1; ?></td>
                        <td><?= $product['product_title']; ?></td>
                        <td><img src="insert/product_img/<?= $product['product_img1'] ?>" style="width:60px;height:60px;" alt=""></td>
                        <td><?= $product['product_price'] ?></td>
                        <td><?php if ($product['product_status'] == 0) {
                                echo 'Out of Stock';
                            } else if ($product['product_status'] == 1) {
                                echo "In Stock";
                            } ?></td>
                        <td><a class="btn btn-info" href="admin_controllers/admin_products_controller.php?edit=<?= $product['product_id'] ?>">Edit</a></td>
                        <td><a class="btn btn-danger" href="admin_controllers/admin_products_controller.php?remove=<?= $product['product_id'] ?>">Remove</a></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <h3 class="text-center text-secondary">No Products</h3>
            <?php } ?>

        <?php } else if (isset($_GET['view_products']) && isset($_GET['instock'])) { ?>
            <?php
            $instock_products_qry = "SELECT * FROM products WHERE product_status=1";
            $instock_products_result = mysqli_query($connect, $instock_products_qry);
            if ($instock_products = mysqli_fetch_all($instock_products_result, MYSQLI_ASSOC)) { ?>
                <?php foreach ($instock_products as $no => $product) { ?>
                    <tr style="vertical-align: middle;">
                        <td><?= $no + 1; ?></td>
                        <td><?= $product['product_title']; ?></td>
                        <td><img src="insert/product_img/<?= $product['product_img1'] ?>" style="width:60px;height:60px;" alt=""></td>
                        <td><?= $product['product_price'] ?></td>
                        <td><?php if ($product['product_status'] == 0) {
                                echo 'Out of Stock';
                            } else if ($product['product_status'] == 1) {
                                echo "In Stock";
                            } ?></td>
                        <td><a class="btn btn-info" href="admin_controllers/admin_products_controller.php?edit=<?= $product['product_id'] ?>">Edit</a></td>
                        <td><a class="btn btn-danger" href="admin_controllers/admin_products_controller.php?remove=<?= $product['product_id'] ?>">Remove</a></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <h3 class="text-center text-secondary">No Products</h3>
            <?php } ?>
        <?php } else if (isset($_GET['view_products']) && isset($_GET['outofstock'])) { ?>
            <?php
            $outofstock_products_qry = "SELECT * FROM products WHERE product_status=0";
            $outofstock_products_result = mysqli_query($connect, $outofstock_products_qry);
            if ($ourofstock_products = mysqli_fetch_all($outofstock_products_result, MYSQLI_ASSOC)) { ?>
                <?php foreach ($ourofstock_products as $no => $product) { ?>
                    <tr style="vertical-align: middle;">
                        <td><?= $no + 1; ?></td>
                        <td><?= $product['product_title']; ?></td>
                        <td><img src="insert/product_img/<?= $product['product_img1'] ?>" style="width:60px;height:60px;" alt=""></td>
                        <td><?= $product['product_price'] ?></td>
                        <td><?php if ($product['product_status'] == 0) {
                                echo 'Out of Stock';
                            } else if ($product['product_status'] == 1) {
                                echo "In Stock";
                            } ?></td>
                        <td><a class="btn btn-info" href="admin_controllers/admin_products_controller.php?edit=<?= $product['product_id'] ?>">Edit</a></td>
                        <td><a class="btn btn-danger" href="admin_controllers/admin_products_controller.php?remove=<?= $product['product_id'] ?>">Remove</a></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <h3 class="text-center text-secondary">No Products</h3>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>