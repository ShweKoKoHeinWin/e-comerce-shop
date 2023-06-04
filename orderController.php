<?php include_once 'templates/header.php'; ?>

<!-- Redirection function -->
<?php Query::redirectHomeBySession(0); ?>

<?php

//if click payment
if (isset($_GET['payment'])) {

    if (isset($_GET['orderIdQtyArr'])) {
        $id_Qty_arr = $_GET['orderIdQtyArr'];   //order products id and quantities array
        $product_id_arr = $id_Qty_arr[0];       //product id array
        $product_id_json_arr = json_encode(array_values($product_id_arr));  //for db product id array
        $product_qty_json_arr = json_encode(array_values($id_Qty_arr[1]));  //for db product quantity array
        $product_total_price = 0;                       //initiate total price
        $user_id = $_SESSION['userid'];                 //get user id

        // get all product price and put in a array
        foreach ($id_Qty_arr[0] as $id) {
            $query = "SELECT * FROM products WHERE product_id='$id'";
            $result = mysqli_query($connect, $query);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                // process the row data as needed
                $product_price_arr[] = $row['product_price'];   //put price into array
            } else {
                // handle the error
                echo "<script>alert('Ooch! Something went wrong.')</script>";
                echo "<script>window.open('transact.php','_self')</script>";
            }
        }

        // get all product quantity and put in array
        foreach ($id_Qty_arr[1] as $key => $quantity) {
            $product_total_price += $quantity * $product_price_arr[$key];   //calc total price
        }

        $product_price_json_arr = json_encode(array_values($product_price_arr));    //for db product price array
        $timestamp = date('YmdHis');        //for db time
        $unique_id = bin2hex(random_bytes(8));  //produce unique id 
        $invoice_num = $timestamp . "-" . $unique_id;   //voice number
        $order_status = "pending";      //db product status

        //if all field is empty , return error
        if (empty($invoice_num) || empty($user_id) || empty($product_id_json_arr) || empty($product_qty_json_arr) || empty($product_price_json_arr) || empty($product_total_price) || empty($order_status)) {
            // handle the error
            echo "<script>alert('Ooch! Something went wrong2.')</script>";
            echo "<script>window.open('transact.php','_self')</script>";
        } else {
            // insert into orders table
            $insert_order_qry = "INSERT INTO orders (invoice_id, user_id, product_id_arr, product_qty_arr, product_price_arr, total_amount, order_status, order_date) VALUES ('$invoice_num', '$user_id', '$product_id_json_arr', '$product_qty_json_arr', '$product_price_json_arr', '$product_total_price', '$order_status', NOW())";

            if ($insert_result = mysqli_query($connect, $insert_order_qry)) {
                Query::removeAllCart($product_id_arr);
                echo "<script>alert('Ordered Successfully. Enjoy The Day')</script>";
                echo "<script>window.open('cart.php','_self')</script>";
            }
        }
    } else {
        // handle the error
        echo "<script>alert('Ooch! Something went wrong1.')</script>";
        echo "<script>window.open('transact.php','_self')</script>";
    }
} else if (isset($_GET['edit']) && isset($_GET['orderid'])) {   //if click edit
    echo "<a href='profileController.php?orders&pending' class='btn btn-primary m-3'><i class='fa-solid fa-arrow-left'></i> Back to Pending Order Table</a>";

    $order_id = $_GET['orderid'];
    $order_detail_query = "SELECT * FROM orders WHERE order_id='$order_id'";    //get order data
    $order_detail_result = mysqli_query($connect, $order_detail_query);
    $order_detail = mysqli_fetch_assoc($order_detail_result);

    // get data from db
    $product_id_arr =  json_decode($order_detail['product_id_arr'], true, JSON_NUMERIC_CHECK);
    $product_price_arr = json_decode($order_detail['product_price_arr'], true, JSON_NUMERIC_CHECK);
    $product_qty_arr = json_decode($order_detail['product_qty_arr'], true, JSON_NUMERIC_CHECK);

    $user_name = $_SESSION['username']; //get username

    // for removing from order
    if (isset($_GET['removeid'])) {
        $remove_product = $_GET['removeid'];

        //removing local
        $index = array_search($remove_product, $product_id_arr);    //get remove index
        unset($product_id_arr[$index]);
        unset($product_qty_arr[$index]);
        unset($product_price_arr[$index]);

        // Recalculate the total amount
        $total_amount = 0;
        foreach ($product_price_arr as $i => $price) {
            $total_amount += $price * $product_qty_arr[$i];
        }

        //convert into json array
        $product_id_arr_json = json_encode(array_values($product_id_arr), JSON_NUMERIC_CHECK);
        $product_qty_arr_json = json_encode(array_values($product_qty_arr), JSON_NUMERIC_CHECK);
        $product_price_arr_json = json_encode(array_values($product_price_arr), JSON_NUMERIC_CHECK);

        // Update the order details in the database with the updated arrays and total amount
        $sql = "UPDATE orders SET product_id_arr='$product_id_arr_json', product_qty_arr='$product_qty_arr_json', product_price_arr='$product_price_arr_json', total_amount='$total_amount' WHERE order_id='$order_id'";
        mysqli_query($connect, $sql);
        echo "<script>window.open('orderController.php?edit&orderid=$order_id','_self')</script>";
    }

    // if user update quantity
    if (isset($_POST['updateOrder'])) {
        if (empty($_POST['updateId'])) {
            echo "<script>alert('Order Not Fount')<script>";
        } else {
            $update_order_id = $_POST['updateId'];
            $update_product_id_arr = $_POST['product_id_new_arr'];
            $update_product_price_arr = $_POST['product_price_new_arr'];
            $update_product_qty_arr = $_POST['product_qty_new_arr'];
            $update_total_amount = $_POST['update_total_amount'];
            $update_order_status = $_POST['order_status'];

            $update_product_id_arr_json = json_encode(array_values($update_product_id_arr), JSON_NUMERIC_CHECK);
            $update_product_qty_arr_json = json_encode(array_values($update_product_qty_arr), JSON_NUMERIC_CHECK);
            $update_product_price_arr_json = json_encode(array_values($update_product_price_arr), JSON_NUMERIC_CHECK);

            $sql = "UPDATE orders SET product_id_arr='$update_product_id_arr_json', product_qty_arr='$update_product_qty_arr_json', product_price_arr='$update_product_price_arr_json', total_amount='$update_total_amount', order_status='$update_order_status' WHERE order_id='$order_id'";
            mysqli_query($connect, $sql);
            echo "<script>window.open('orderController.php?edit&orderid=$order_id','_self')</script>";
        }
    }

    if ($order_detail['order_status'] == 'pending') {
        $pending_selected = 'selected';
    } else {
        $pending_selected = '';
    }

    if ($order_detail['order_status'] == 'success') {
        $success_selected = 'selected';
    } else {
        $success_selected = '';
    }

    if ($order_detail['order_status'] == 'canceled') {
        $canceled_selected = 'selected';
    } else {
        $canceled_selected = '';
    }

    // Show invoice bill
    echo "<div class='bg-warning text-center'>
    <form class='container px-2 py-4' action='orderController.php?edit&orderid=$order_id' method='post'>
        <div class='row text-muted'>
            <div class='col-4'>
                <h5>Invoice Id :: {$order_detail['invoice_id']} </h5>
                <h4>{$user_name}</h4>
            </div>
            <div class='col-4'></div>
            <div class='col-4'>
            <select name='order_status' class='form-select text-center'>
            <option value='pending' {$pending_selected}>Pending</option>
            <option value='success' {$success_selected}>Success</option>
            <option value='canceled' {$canceled_selected}>Canceled</option>
        </select>
                <h6>{$order_detail['order_date']}</h6>
            </div>
        </div>
        <table class='table table-dark table-striped table-bordered my-3' style='width:100%'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Amount</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>";
    // show all orders
    Query::pendingOrderTable($order_id, $product_id_arr, $product_price_arr, $product_qty_arr);

    echo "</tbody>
    <tfoot>
    <tr>
        <td colspan='4'>Total Amount</td>
        <td colspan='2'><input class='totalAmount' type='text' name='update_total_amount' value='{$order_detail['total_amount']}'></td>
    </tr>
</tfoot>";
    echo "</table>
    <input type='hidden' name='updateId' value='{$order_id}'>
    <input type='submit' class='btn btn-secondary' name='updateOrder' value='Update Order'>
    </form>";
} else if (isset($_GET['history']) && isset($_GET['orderid'])) {
    echo "<a href='profileController.php?orders&success' class='btn btn-primary m-3'><i class='fa-solid fa-arrow-left'></i> Back to Pending Order Table</a>";

    $order_id = $_GET['orderid'];
    $order_detail_query = "SELECT * FROM orders WHERE order_id='$order_id'";
    $order_detail_result = mysqli_query($connect, $order_detail_query);
    $order_detail = mysqli_fetch_assoc($order_detail_result);

    $product_id_arr =  json_decode($order_detail['product_id_arr'], true, JSON_NUMERIC_CHECK);
    $product_price_arr = json_decode($order_detail['product_price_arr'], true, JSON_NUMERIC_CHECK);
    $product_qty_arr = json_decode($order_detail['product_qty_arr'], true, JSON_NUMERIC_CHECK);

    $user_name = $_SESSION['username'];

    echo "<div class='bg-warning text-center'>
    <div class='container px-2 py-4'>
        <div class='row text-muted'>
            <div class='col-4'>
                <h5>Invoice Id :: {$order_detail['invoice_id']} </h5>
                <h4>{$user_name}</h4>
            </div>
            <div class='col-4'></div>
            <div class='col-4'>
                <h5>{$order_detail['order_status']}</h5>
                <h6>{$order_detail['order_date']}</h6>
            </div>
        </div>
        <table class='table table-dark table-striped table-bordered my-3' style='width:100%'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>";
    Query::showingOrderTable($order_id, $product_id_arr, $product_price_arr, $product_qty_arr);

    echo "<tfoot>
    <tr>
        <td colspan='4'>Total Amount</td>
        <td><input class='totalAmount' type='text' name='update_total_amount' value='{$order_detail['total_amount']}'></td>
    </tr>
</tfoot>";
    echo "</table>

    </div>";
} else if (isset($_GET['allorders']) && isset($_GET['orderid'])) {
    echo "<a href='profileController.php?orders&allorders' class='btn btn-primary m-3'><i class='fa-solid fa-arrow-left'></i> Back to Pending Order Table</a>";

    $order_id = $_GET['orderid'];
    $order_detail_query = "SELECT * FROM orders WHERE order_id='$order_id'";
    $order_detail_result = mysqli_query($connect, $order_detail_query);
    $order_detail = mysqli_fetch_assoc($order_detail_result);

    $product_id_arr =  json_decode($order_detail['product_id_arr'], true, JSON_NUMERIC_CHECK);
    $product_price_arr = json_decode($order_detail['product_price_arr'], true, JSON_NUMERIC_CHECK);
    $product_qty_arr = json_decode($order_detail['product_qty_arr'], true, JSON_NUMERIC_CHECK);

    $user_name = $_SESSION['username'];

    echo "<div class='bg-warning text-center'>
        <div class='container px-2 py-4'>
            <div class='row text-muted'>
                <div class='col-4'>
                    <h5>Invoice Id :: {$order_detail['invoice_id']} </h5>
                    <h4>{$user_name}</h4>
                </div>
                <div class='col-4'></div>
                <div class='col-4'>
                    <h5>{$order_detail['order_status']}</h5>
                    <h6>{$order_detail['order_date']}</h6>
                </div>
            </div>
            <table class='table table-dark table-striped table-bordered my-3' style='width:100%'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>";
    Query::showingOrderTable($order_id, $product_id_arr, $product_price_arr, $product_qty_arr);

    echo "<tfoot>
        <tr>
            <td colspan='4'>Total Amount</td>
            <td><input class='totalAmount' type='text' name='update_total_amount' value='{$order_detail['total_amount']}'></td>
        </tr>
    </tfoot>";
    echo "</table>
        </div>";
} else {
    echo "<script>window.open('profileController.php?orders', '_self')</script>";
}

?>


<script>
    <?php include_once "templates/templateFunctions.php";
    removeSearch();
    displayTitle('Orders'); ?>
</script>
<script>
    let prices = document.querySelectorAll('.price');
    let quantities = document.querySelectorAll('.quantity');
    let amounts = document.querySelectorAll('.amount');
    let totalAmount = document.querySelector('.totalAmount');

    function updateTotalAmount() {
        let total = 0;
        for (let i = 0; i < amounts.length; i++) {
            total += parseFloat(amounts[i].value);
        }
        totalAmount.value = total;
    }

    for (let i = 0; i < prices.length; i++) {
        quantities[i].addEventListener('input', () => {
            amounts[i].value = prices[i].value * quantities[i].value;
            updateTotalAmount();
        })

        quantities[i].addEventListener('change', () => {
            amounts[i].value = prices[i].value * quantities[i].value;
            updateTotalAmount();
        })
    }
</script>
<?php require "./templates/footer.php"; ?>