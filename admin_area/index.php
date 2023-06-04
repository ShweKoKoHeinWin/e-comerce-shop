<?php include('../includes/connect.php');
session_start();
$_SESSION['adminname'] = 'shweko2003##';;
if (!isset($_SESSION['adminid']) && !isset($_SESSION['adminname'])) {
    header('Location:auth.php?login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Cdn css -->
    <?php require "../css/stylelinks.html" ?>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
    <div class="container-fluid p-0">
        <!-- Header -->
        <nav class="navbar navbat-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <a href="/"><img src="./../img/fav/favicon.png" id="brand-logo" alt=""></a>


                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index.php?profile" class="nav-link">Welcome <?= $_SESSION['adminname']; ?></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <!-- banner -->
        <div class="bg-light">
            <h3 class="text-center">
                Manage Details
            </h3>
        </div>

        <!-- control panel -->
        <div class="row m-0">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-2">
                    <a href="index.php?profile"><img src="./../img/furniture/3.jpg" class="admin-image" alt=""></a>
                    <p class="text-light text-center"><?= $_SESSION['adminname']; ?></p>
                </div>

                <div class="text-center d-flex flex-wrap justify-content-center align-items-space-between">
                    <button class="m-2"><a href="./insert/insert_products.php" class="nav-link text-light bg-info p-1 m-1">Insert Products</a></button>
                    <button class="m-2"><a href="index.php?view_products&allproducts" class="nav-link text-light bg-info p-1 m-1">View Products</a></button>
                    <button class="m-2"><a href="index.php?insert_categories" class="nav-link text-light bg-info p-1 m-1">Insert Catagories</a></button>
                    <button class="m-2"><a href="index.php?view_categories" class="nav-link text-light bg-info p-1 m-1">View Categories</a></button>
                    <button class="m-2"><a href="index.php?insert_brands" class="nav-link text-light bg-info p-1 m-1">Insert Brands</a></button>
                    <button class="m-2"><a href="index.php?view_brands" class="nav-link text-light bg-info p-1 m-1">View Brands</a></button>
                    <button class="m-2"><a href="index.php?orders&all" class="nav-link text-light bg-info p-1 m-1">All Orders</a></button>
                    <button class="m-2"><a href="index.php?users" class="nav-link text-light bg-info p-1 m-1">List Users</a></button>
                    <button class="m-2"><a href="auth.php?logout" class="nav-link text-light bg-info p-1 m-1">Logout</a></button>
                </div>
            </div>
        </div>

        <!--  -->
        <div class="container my-3">
            <?php
            if (isset($_GET['insert_categories'])) {
                include('./insert/insert_categories.php');
            }
            if (isset($_GET['insert_brands'])) {
                include('./insert/insert_brands.php');
            }
            if (isset($_GET['view_products'])) {
                include('./view/view_products.php');
            }
            if (isset($_GET['view_brands'])) {
                include('./view/view_brands.php');
            }
            if (isset($_GET['view_categories'])) {
                include('./view/view_categories.php');
            }
            if (isset($_GET['orders'])) {
                include('./lists/order_list.php');
            }
            if (isset($_GET['users'])) {
                include('./lists/user_list.php');
            }
            if (isset($_GET['profile'])) {
                include('./view/profile.php');
            }

            ?>
        </div>

        <div class="bg-info p-2 text-center">
            <hr>
            <p>All rights reserved &copy;- Designed by Khanam-2022</p>
        </div>

    </div>

    <!-- cdn js -->
    <?php require "../js/scriptlinks.html" ?>
    <script>
        <?php include_once "../templates/templateFunctions.php";
        if (isset($_GET['insert_categories'])) {
            displayTitle('Admin Dashboard - Insert Categories');
        } else  if (isset($_GET['insert_brands'])) {
            displayTitle('Admin Dashboard - Insert Brands');
        } else  if (isset($_GET['view_products'])) {
            displayTitle('Admin Dashboard - View Products');
        } else  if (isset($_GET['view_categories'])) {
            displayTitle('Admin Dashboard - View Categories');
        } else  if (isset($_GET['view_brands'])) {
            displayTitle('Admin Dashboard - View Brands');
        } else  if (isset($_GET['orders'])) {
            displayTitle('Admin Dashboard - Orders');
        } else  if (isset($_GET['users'])) {
            displayTitle('Admin Dashboard - Users');
        } else {
            displayTitle('Admin Dashboard');
        }

        ?>
    </script>
</body>

</html>