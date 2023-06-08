<?php
session_start();
include('../../includes/connect.php');
if (!isset($_SESSION['adminid']) || !isset($_SESSION['adminname'])) {
    header('Location:../auth.php?login');
}
if (isset($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_categories = $_POST['product_categories'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_status = 1;

    // images
    $product_img1 = $_FILES['product_img1']['name'];
    $product_img2 = $_FILES['product_img2']['name'];
    $product_img3 = $_FILES['product_img3']['name'];
    // image tmp name
    $temp_img1 = $_FILES['product_img1']['tmp_name'];
    $temp_img2 = $_FILES['product_img2']['tmp_name'];
    $temp_img3 = $_FILES['product_img3']['tmp_name'];


    // Checking Empty
    if ($product_title == "" or $product_description == "" or $product_keywords == "" or $product_categories == "" or $product_brands == "" or $product_price == "" or $product_img1 == "" or $product_img2 == "" or $product_img3 == "") {
        echo "<script>alert('Please fill')</script>";
        exit();
    } else {
        move_uploaded_file($temp_img1, "./product_img/$product_img1");
        move_uploaded_file($temp_img2, "./product_img/$product_img2");
        move_uploaded_file($temp_img3, "./product_img/$product_img3");

        // Insert Query
        $insert_products = "INSERT INTO products (product_title, product_description, product_keywords, category_id, brand_id, product_img1, product_img2, product_img3, product_price, deploy_date, product_status) VALUES ('$product_title', '$product_description', '$product_keywords', '$product_categories', '$product_brands', '$product_img1', '$product_img2', '$product_img3', '$product_price', NOW(), '$product_status')";


        if (mysqli_query($connect, $insert_products)) {
            echo "<script>alert('success')</script>";
        } else {
            echo "$product_img1";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products - Admin Dashboard</title>
    <!-- Cdn css -->
    <?php require "./../../css/stylelinks.html" ?>

    <!-- Custom css -->
    <link rel="stylesheet" href="./../../css/style.css" />
</head>

<body class="bg-light">
    <div class="container">
        <a href="../index.php" class="btn btn-primary mt-3">Back</a>
        <h1 class="text-center my-3">
            Insert Products
        </h1>

        <!-- form -->
        <form class="w-50 m-auto py-5" action="" method="post" enctype="multipart/form-data">
            <!-- title -->
            <div class="mb-4">
                <label for="product_title" class="form-label">Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter Product Title" autocomplete="off" require="required">
            </div>

            <!-- description -->
            <div class="mb-4">
                <label for="product_description" class="form-label">Description</label>
                <input type="text" name="product_description" id="product_description" class="form-control" placeholder="Enter Product descripion" autocomplete="off" require="required">
            </div>

            <!-- keywords -->
            <div class="mb-4">
                <label for="product_keywords" class="form-label">Keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter Product Keywords" autocomplete="off" require="required">
            </div>

            <!-- categories -->
            <div class="mb-4">
                <select name="product_categories" id="product_categories" class="form-select">
                    <option value="" selected disabled>Select a Category</option>

                    <?php
                    $select_query = "SELECT * FROM categories";
                    $result_query = mysqli_query($connect, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'>$category_title</option></script>";
                    }
                    ?>
                </select>
            </div>

            <!-- brands -->
            <div class="mb-4">
                <select name="product_brands" id="product_brands" class="form-select">
                    <option value="" selected disabled>Select a brand</option>

                    <?php
                    $select_query = "SELECT * FROM brands";
                    $result_query = mysqli_query($connect, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $brand_title = $row['brand_title'];
                        $brand_id = $row['brand_id'];
                        echo "<option  value='$brand_id'>$brand_title</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- image1 -->
            <div class="mb-4">
                <label for="product_img1" class="form-label">Image1</label>
                <input type="file" name="product_img1" id="product_img1" class="form-control" require="required">
            </div>

            <!-- image2 -->
            <div class="mb-4">
                <label for="product_img2" class="form-label">Image2</label>
                <input type="file" name="product_img2" id="product_img2" class="form-control" require="required">
            </div>

            <!-- image3 -->
            <div class="mb-4">
                <label for="product_img3" class="form-label">Image3</label>
                <input type="file" name="product_img3" id="product_img3" class="form-control" require="required">
            </div>

            <!-- price -->
            <div class="mb-4">
                <label for="product_price" class="form-label">Price</label>

                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="text" name="product_price" id="product_price" class="form-control" require="required">
                </div>
            </div>

            <!-- Sumit -->
            <div class="">
                <input type="submit" class="form-control btn btn-primary text-light" name="insert_product" value="Insert Product">
            </div>
        </form>
    </div>


    <!-- cdn js -->
    <?php require "./../../js/scriptlinks.html" ?>
</body>

</html>