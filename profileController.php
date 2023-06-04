<?php include_once 'templates/header.php'; ?>

<div class="container-fluid py-3  bg-info">
    <div class="row">

        <div class="col-md-3">
            <?php

            $user_name = "GUEST";   //user is guest by default
            $user_img = "default.jpg";  //default img

            if (isset($_SESSION['userid']) && isset($_SESSION['username'])) {   //if user is member get user data
                $user_id = $_SESSION['userid'];
                $user_name = $_SESSION['username'];
                $user_ip = Query::getIPAddress();
                $profile_query = "SELECT * FROM user_info WHERE user_id='$user_id' AND user_name='$user_name' AND user_ip='$user_ip'";
                $profile_result = mysqli_query($connect, $profile_query);
                if ($row = mysqli_fetch_assoc($profile_result)) {
                    $user_email = $row['user_email'];
                    $user_img = $row['user_img'];
                    $user_phone = $row['user_phone'];
                    $user_address = $row['user_address'];
                }
            }

            include_once "user_area/profile.php";
            ?>
        </div>

        <div class="col-md-9 text-center">
            <?php

            if (isset($_SESSION['userid']) && isset($_SESSION['username'])) {
                $user_id = $_SESSION['userid'];
                $user_name = $_SESSION['username'];
                if (isset($_GET['orders'])) {

                    $order_pending_query = "SELECT * FROM orders WHERE user_id = '$user_id' AND order_status='pending'";
                    $order_pending_result = mysqli_query($connect, $order_pending_query);
                    if (($num_of_pending = mysqli_num_rows($order_pending_result)) > 0) {
                        $order_pendings = mysqli_fetch_all($order_pending_result, MYSQLI_ASSOC);
                    }

                    $order_success_query = "SELECT * FROM orders WHERE user_id = '$user_id' AND order_status='success'";
                    $order_success_result = mysqli_query($connect, $order_success_query);
                    if (($num_of_success = mysqli_num_rows($order_success_result)) > 0) {
                        $order_successes = mysqli_fetch_all($order_success_result, MYSQLI_ASSOC);
                    }

                    $order_all_query = "SELECT * FROM orders WHERE user_id = '$user_id' AND order_status<>'canceled'";
                    $order_all_result = mysqli_query($connect, $order_all_query);
                    if (($num_of_all = mysqli_num_rows($order_all_result)) > 0) {
                        $order_all = mysqli_fetch_all($order_all_result, MYSQLI_ASSOC);
                    }

                    include_once('user_area/orderlist.php');
                }
            } else {
                echo "<h3 class='text-danger text-center'>You're not one of us.<h3>";
            }

            ?>
        </div>
    </div>
    <hr>
</div>

<script>
    <?php include_once "templates/templateFunctions.php";
    removeSearch();
    displayTitle('Profile'); ?>
</script>
<?php require "./templates/footer.php"; ?>