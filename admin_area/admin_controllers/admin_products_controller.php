<?php include('../../includes/connect.php');
session_start();
if (!isset($_SESSION['adminid']) && !isset($_SESSION['adminname'])) {
    header('Location:../auth.php?login');
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Products</title>
    <!-- Cdn css -->
    <?php require "./../../css/stylelinks.html" ?>

    <!-- Custom css -->
    <link rel="stylesheet" href="./../../css/style.css" />
</head>

<?php if (isset($_GET['edit']) && !empty($_GET['edit'])) { ?>

    <?php
    $product_id = $_GET['edit'];
    $product_detail_qry = "SELECT * FROM products WHERE product_id='$product_id'";
    $product_detail_result = mysqli_query($connect, $product_detail_qry);
    if ($product_detail = mysqli_fetch_assoc($product_detail_result)) {
        $product_title = $product_detail['product_title'];
        $product_description = $product_detail['product_description'];
        $product_keywords = $product_detail['product_keywords'];
        $product_category = $product_detail['category_id'];
        $product_brand = $product_detail['brand_id'];
        $product_img1 = $product_detail['product_img1'];
        $product_img2 = $product_detail['product_img2'];
        $product_img3 = $product_detail['product_img3'];
        $product_price = $product_detail['product_price'];
        $product_status = $product_detail['product_status'];
        $product_date = $product_detail['deploy_date'];
    }

    ?>

    <?php if (isset($_POST['updateproduct'])) {
        $updated_title = $_POST['product_title'];
        $updated_description = $_POST['product_description'];
        $updated_keywords = $_POST['product_keywords'];
        $updated_category = $_POST['product_categories'];
        $updated_brand = $_POST['product_brands'];
        $updated_img1 = $_FILES['product_img1']['name'];
        $updated_img2 = $_FILES['product_img2']['name'];
        $updated_img3 = $_FILES['product_img3']['name'];
        $updated_price = $_POST['product_price'];
        $updated_status = $_POST['product_status'];
        $updated_date = $_POST['deploy_date'];

        $temp_img1 = $_FILES['product_img1']['tmp_name'];
        $temp_img2 = $_FILES['product_img2']['tmp_name'];
        $temp_img3 = $_FILES['product_img3']['tmp_name'];

        if (empty($updated_img1)) {
            $updated_img1 = $product_img1;
        } else {
            move_uploaded_file($temp_img1, "../insert/product_img/$updated_img1");
        }
        if (empty($updated_img2)) {
            $updated_img2 = $product_img2;
        } else {
            move_uploaded_file($temp_img2, "../insert/product_img/$updated_img2");
        }
        if (empty($updated_img3)) {
            $updated_img3 = $product_img3;
        } else {
            move_uploaded_file($temp_img3, "../insert/product_img/$updated_img3");
        }

        if (empty($updated_date)) {
            $update_product_qry = "UPDATE products SET product_title='$updated_title', product_description='$updated_description', product_keywords='$updated_keywords', category_id='$updated_category', brand_id='$updated_brand', product_img1='$updated_img1', product_img2='$updated_img2', product_img3='$updated_img3', product_price='$updated_price', deploy_date=NOW(), product_status='$updated_status' WHERE product_id='$product_id'";
        } else {
            $update_product_qry = "UPDATE products SET product_title='$updated_title', product_description='$updated_description', product_keywords='$updated_keywords', category_id='$updated_category', brand_id='$updated_brand', product_img1='$updated_img1', product_img2='$updated_img2', product_img3='$updated_img3', product_price='$updated_price', deploy_date='$updated_date', product_status='$updated_status' WHERE product_id='$product_id'";
        }
        if (mysqli_query($connect, $update_product_qry)) {
            echo "<script>alert('Updated Successfully');</script>";
            echo "<script>window.open('../../admin_area/index.php?view_products&allproducts','_self')</script>";
        } else {
            echo "<script>alert('Something went wrong');</script>";
            echo "<script>window.open('../../admin_area/index.php?view_products&allproducts','_self')</script>";
        }
    } ?>

    <body>
        <div class="container">
            <a href="../index.php" class="btn btn-primary mt-3">Back</a>
            <h2 class="text-center my-3">
                Editing Product
            </h2>
            <form class="w-75 m-auto py-5" action="" method="post" enctype="multipart/form-data">
                <!-- title -->
                <div class="mb-4">
                    <label for="product_title" class="form-label">Title</label>
                    <input type="text" name="product_title" value="<?= $product_title; ?>" id="product_title" class="form-control" placeholder="Enter Product Title" autocomplete="off" require="required">
                </div>

                <!-- description -->
                <div class="mb-4">
                    <label for="product_description" class="form-label">Description</label>
                    <input type="text" name="product_description" value="<?= $product_title; ?>" id="product_description" class="form-control" placeholder="Enter Product descripion" autocomplete="off" require="required">
                </div>

                <!-- keywords -->
                <div class="mb-4">
                    <label for="product_keywords" class="form-label">Keywords</label>
                    <input type="text" name="product_keywords" value="<?= $product_title; ?>" id="product_keywords" class="form-control" placeholder="Enter Product Keywords" autocomplete="off" require="required">
                </div>

                <!-- categories -->
                <div class="mb-4">
                    <select name="product_categories" id="product_categories" class="form-select">

                        <?php
                        $select_query = "SELECT * FROM categories";
                        $result_query = mysqli_query($connect, $select_query);
                        while ($row = mysqli_fetch_assoc($result_query)) {
                            $category_title = $row['category_title'];
                            $category_id = $row['category_id'];
                        ?>
                            <option value='<?= $category_id; ?>' <?php if ($product_category == $category_id) {
                                                                        echo "selected";
                                                                    } ?>><?= $category_title; ?></option>
                        <?php } ?>

                    </select>
                </div>

                <!-- brands -->
                <div class="mb-4">
                    <select name="product_brands" id="product_brands" class="form-select">


                        <?php
                        $select_query = "SELECT * FROM brands";
                        $result_query = mysqli_query($connect, $select_query);
                        while ($row = mysqli_fetch_assoc($result_query)) {
                            $brand_title = $row['brand_title'];
                            $brand_id = $row['brand_id'];
                        ?>
                            <option value='<?= $brand_id; ?>' <?php if ($product_brand == $brand_id) {
                                                                    echo "selected";
                                                                } ?>><?= $brand_title; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- image1 -->
                <div class="mb-4">
                    <label for="product_img1" class="form-label">Image1</label>
                    <input type="file" name="product_img1" id="product_img1" class="form-control" require="required">
                    <img style="width:150px;height:150px;" class="mb-3" src="../insert/product_img/<?= $product_img1; ?>" alt="">
                </div>

                <!-- image2 -->
                <div class="mb-4">
                    <label for="product_img2" class="form-label">Image2</label>
                    <input type="file" name="product_img2" id="product_img2" class="form-control" require="required">
                    <img style="width:150px;height:150px;" class="mb-3" src="../insert/product_img/<?= $product_img2; ?>" alt="">
                </div>

                <!-- image3 -->
                <div class="mb-4">
                    <label for="product_img3" class="form-label">Image3</label>
                    <input type="file" name="product_img3" id="product_img3" class="form-control" require="required">
                    <img style="width:150px;height:150px;" class="mb-3" src="../insert/product_img/<?= $product_img3; ?>" alt="">
                </div>

                <!-- price -->
                <div class="mb-4">
                    <label for="product_price" class="form-label">Price</label>

                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="text" name="product_price" value="<?= $product_price; ?>" id="product_price" class="form-control" require="required">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="product_status">Status</label>
                    <select name="product_status" id="product_status">
                        <option value="1" <?php if ($product_status == 1) {
                                                echo "selected";
                                            } ?>>In Stock</option>
                        <option value="0" <?php if ($product_status == 0) {
                                                echo "selected";
                                            } ?>>Out Of Stock</option>
                    </select>
                </div>

                <!-- deploy date -->
                <div class="mb-4">
                    <label for="deploy_date" class="form-label">Deploy Date</label>
                    <input name="deploy_date" id="deploy_date" type="date" class="form-control" require="required" autocomplete="off">
                </div>

                <!-- Sumit -->
                <div class="">
                    <input type="submit" class="form-control btn btn-primary text-light" name="updateproduct" value="Update Product">
                </div>
            </form>
        </div>

    <?php } else if (isset($_GET['remove']) && !empty($_GET['remove'])) {

    $product_id = $_GET['remove'];
    $delete_qry = "DELETE FROM products WHERE product_id='$product_id'";
    if (mysqli_query($connect, $delete_qry)) {
        echo "<script>alert('Deleted Successfully');</script>";
        echo "<script>window.open('../../admin_area/index.php?view_products&allproducts','_self')</script>";
    }
} ?>



    <div class="bg-info p-2 text-center">
        <hr>
        <p>All rights reserved &copy;- Designed by Khanam-2022</p>
    </div>

    </div>

    <!-- cdn js -->
    <?php require "../../js/scriptlinks.html" ?>
    <script>
        <?php include_once "../templates/templateFunctions.php";
        if (isset($_GET['insert_categories'])) {
            displayTitle('Insert Categories');
        } else  if (isset($_GET['insert_brands'])) {
            displayTitle('Insert Brands');
        } else {
            displayTitle('Admin Dashboard');
        }

        ?>
    </script>
    </body>

</html>