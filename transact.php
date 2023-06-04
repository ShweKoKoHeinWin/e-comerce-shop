<?php

include_once 'templates/header.php';
include_once "templates/templateFunctions.php";
if (isset($_SESSION['username']) && Query::checkCart() > 0) {
    include_once "user_area/payment.php";
} else if (isset($_SESSION['username']) && Query::checkCart() == 0) {
    echo "<script>alert('No items to buy')</script>";
    echo "<script>window.open('index.php', '_self')</script>";
} else {
    include_once "user_area/login.php";
}
?>




<?php Query::updateProductQty('transact.php'); ?>
<?php Query::removeCartItemByOne('transact.php'); ?>
<?php require "templates/footer.php"; ?>