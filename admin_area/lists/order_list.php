<?php include('../includes/connect.php');

if (!isset($_SESSION['adminid']) || !isset($_SESSION['adminname'])) {
    header('Location:../auth.php?login');
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php



$order_pending_query = "SELECT * FROM orders WHERE order_status='pending'";
$order_pending_result = mysqli_query($connect, $order_pending_query);
if (($num_of_pending = mysqli_num_rows($order_pending_result)) > 0) {
    $order_pendings = mysqli_fetch_all($order_pending_result, MYSQLI_ASSOC);
}

$order_success_query = "SELECT * FROM orders WHERE order_status='success'";
$order_success_result = mysqli_query($connect, $order_success_query);
if (($num_of_success = mysqli_num_rows($order_success_result)) > 0) {
    $order_successes = mysqli_fetch_all($order_success_result, MYSQLI_ASSOC);
}

$order_all_query = "SELECT * FROM orders";
$order_all_result = mysqli_query($connect, $order_all_query);
if (($num_of_all = mysqli_num_rows($order_all_result)) > 0) {
    $order_all = mysqli_fetch_all($order_all_result, MYSQLI_ASSOC);
}
if (isset($_GET['orders'])) { ?>
    <h3 class="text-center text-secondary">Orders</h3>
    <a class="btn btn-info position-relative me-3" href="index.php?orders&all">
        All<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> <?= $num_of_all; ?></span>
    </a>
    <a class="btn btn-warning position-relative me-3" href="index.php?orders&pending">
        Pending<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> <?= $num_of_pending; ?></span>
    </a>
    <a class="btn btn-success position-relative me-3" href="index.php?orders&success">
        Success<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> <?= $num_of_success; ?></span>
    </a>

<?php } ?>

<body>
    <div class="container py-4">
        <?php if (isset($_GET['orders'])) { ?>
            <?php if (isset($_GET['orders']) && isset($_GET['pending'])) { ?>
                <h3 class='text-center text-primary'>Pending Orders</h3>
                <table style="width:100%" class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Invoice ID</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($order_pendings)) { ?>
                            <?php foreach ($order_pendings as $No => $orders) { ?>
                                <tr>
                                    <td><?= $No; ?></td>
                                    <td><?= $orders['invoice_id']; ?></td>
                                    <td><?php $qty = json_decode($orders['product_qty_arr'], true);
                                        echo array_sum($qty); ?></td>
                                    <td><?= $orders['total_amount']; ?></td>
                                    <td><?= $orders['order_status']; ?></td>
                                    <td><?= $orders['order_date']; ?></td>
                                    <td><a href="index.php?orders&orderid=<?= $orders['order_id']; ?>">More</a></td>
                                </tr>

                            <?php } ?>

                        <?php } else { ?>
                            <tr>
                                <td colspan="7">
                                    <h3>NO Pending Orders</h3>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>


            <?php } else if (isset($_GET['orders']) && isset($_GET['success'])) { ?>
                <h3 class='text-center text-primary'>Success Orders</h3>
                <table style="width:100%" class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Invoice ID</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($order_successes)) { ?>
                            <?php foreach ($order_successes as $No => $orders) { ?>

                                <tr>
                                    <td><?= $No; ?></td>
                                    <td><?= $orders['invoice_id']; ?></td>
                                    <td><?php $qty = json_decode($orders['product_qty_arr'], true);
                                        echo array_sum($qty); ?></td>
                                    <td><?= $orders['total_amount']; ?></td>
                                    <td><?= $orders['order_status']; ?></td>
                                    <td><?= $orders['order_date']; ?></td>
                                    <td><a href="index.php?orders&orderid=<?= $orders['order_id']; ?>">More</a></td>
                                </tr>

                            <?php } ?>

                        <?php } else { ?>
                            <tr>
                                <td colspan="7">
                                    <h3>NO Success Orders</h3>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else if (isset($_GET['orders']) && isset($_GET['all'])) { ?>
                <h3 class='text-center text-primary'>All Orders</h3>
                <table style="width:100%" class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Invoice ID</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($order_all)) { ?>
                            <?php foreach ($order_all as $No => $orders) { ?>

                                <tr>
                                    <td><?= $No; ?></td>
                                    <td><?= $orders['invoice_id']; ?></td>
                                    <td><?php $qty = json_decode($orders['product_qty_arr'], true);
                                        echo array_sum($qty); ?></td>
                                    <td><?= $orders['total_amount']; ?></td>
                                    <td><?= $orders['order_status']; ?></td>
                                    <td><?= $orders['order_date']; ?></td>
                                    <td><a href="index.php?orders&orderid=<?= $orders['order_id']; ?>">More</a></td>
                                </tr>

                            <?php } ?>

                        <?php } else { ?>
                            <tr>
                                <td colspan="7">
                                    <h3>NO Orders</h3>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        <?php } ?>
        <?php if (isset($_GET['orders']) && isset($_GET['orderid'])) { ?>

            <?php
            $orderid = $_GET['orderid'];
            $order_query = "SELECT * FROM orders WHERE order_id='$orderid'";
            $order_result = mysqli_query($connect, $order_query);
            $order_detail = mysqli_fetch_assoc($order_result);

            $userid = $order_detail['user_id'];
            $user_query = "SELECT * FROM user_info WHERE user_id='$userid'";
            $user_result = mysqli_query($connect, $user_query);
            $user_info = mysqli_fetch_assoc($user_result);

            $product_id_arr =  json_decode($order_detail['product_id_arr'], true, JSON_NUMERIC_CHECK);
            $product_price_arr = json_decode($order_detail['product_price_arr'], true, JSON_NUMERIC_CHECK);
            $product_qty_arr = json_decode($order_detail['product_qty_arr'], true, JSON_NUMERIC_CHECK);


            ?>
            <div class="row bg-info text-muted">
                <div class="col-4">
                    <h3><?= $order_detail['invoice_id']; ?></h3>
                    <h3><?= $user_info['user_name']; ?></h3>
                </div>
                <div class="col-4"></div>
                <div class="col-4">
                    <h3><?= $order_detail['order_date']; ?></h3>
                    <h3><?= $order_detail['order_status']; ?></h3>
                </div>

                <table style="width:100%" class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($product_id_arr as $idx => $product_id) {
                            $product_name_query = "SELECT * FROM products WHERE product_id='$product_id'";
                            $product_name_result = mysqli_query($connect, $product_name_query);
                            $product_name_row = mysqli_fetch_assoc($product_name_result);
                            $product_name = $product_name_row['product_title'];
                            $product_price = $product_price_arr[$idx];
                            $product_qty = $product_qty_arr[$idx];
                            $amount = $product_price * $product_qty;
                            $status = $product_name_row['product_status'] == 0 ? "Out Of Stock" : "In Stock";
                            $img = $product_name_row['product_img1'];
                            $no += $idx; ?>
                            <tr class="text-end" style="vertical-align: middle;">
                                <td><?= $no; ?></td>
                                <td><?= $product_name; ?></td>
                                <td><img style="width:50px;height:50px" src="insert/product_img/<?= $img; ?>" alt=""></td>
                                <td><?= $product_price; ?></td>
                                <td><?= $product_qty; ?></td>
                                <td><?= $amount; ?></td>
                                <td><?= $status; ?></td>
                            </tr>
                        <?php } ?>

                        <tr class="text-end">
                            <td colspan="5" class="text-center h5">Total Amount</td>
                            <td><?= $order_detail['total_amount']; ?></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>

</body>

</html>