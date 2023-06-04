<?php
session_start();
include('./includes/connect.php');
include('./functions/CommonFunctions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Cdn css -->
    <?php require "./css/stylelinks.html" ?>

    <!-- Custom css -->
    <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
    <div class="container-fluid p-0 overflow-hidden">
        <!-- Header -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <a href="/"><img src="./img/fav/favicon.png" id="brand-logo" alt=""></a>


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/display_all.php">Products</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/cart.php"><i class="fa-solid fa-cart-shopping"></i><sup id="cartNo">0</sup></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/cart.php">Total Price: <strong class="h5"><?php Query::showTotalCart(); ?></strong> </a>
                        </li>
                    </ul>

                    <form class='d-flex' role='search'>
                        <input class='form-control me-2' type='search' name='search_data' placeholder='Search' aria-label='Search'>
                        <input type='submit' name='data_searching' value='Search' class='btn btn-outline-light'>
                    </form>
                </div>
            </div>
        </nav>

        <!-- login -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav align-items-center">
                <?php Query::userSessionStatus(); ?>
            </ul>
        </nav>

        <?php Query::addToCart(); ?>

        <!-- banner -->
        <div class="bg-light">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Communications is at the heart of e-commerce and community</p>
        </div>