<?php include('../../includes/connect.php');
session_start();
if (!isset($_SESSION['adminid']) || !isset($_SESSION['adminname'])) {
    header('Location:../auth.php?login');
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Categories</title>
    <!-- Cdn css -->
    <?php require "./../../css/stylelinks.html" ?>

    <!-- Custom css -->
    <link rel="stylesheet" href="./../../css/style.css" />
</head>

<body>
    <div class="py-4 container">

        <a href="../index.php?view_categories" class="btn btn-primary mt-3">Back</a>
        <?php if (isset($_GET['edit']) && !empty($_GET['edit'])) { ?>
            <h2 class="text-center text-secondary">Edit Categories</h2>

            <?php
            $category_id = $_GET['edit'];
            $category_qry = "SELECT * FROM categories WHERE category_id='$category_id'";
            $category_result = mysqli_query($connect, $category_qry);
            if ($category = mysqli_fetch_assoc($category_result)) {
                $category_title = $category['category_title'];
            }
            ?>
            <form action="" class="form w-50 m-auto bg-warning border border-rounded p-5" method="post">
                <div class="form-group mb-3">
                    <label class="text-muted h5" for="category">Title</label>
                    <input id="category" name="category" value="<?= $category_title; ?>" type="text" class="form-control">
                </div>

                <div class="d-flex justify-content-center">
                    <input class="btn btn-success" type="submit" name="update" value="Edit">
                </div>

            </form>

            <?php
            if (isset($_POST['update'])) {
                $update_title = $_POST['category'];
                $update_qry = "UPDATE categories SET category_title='$update_title' WHERE category_id='$category_id'";
                if (mysqli_query($connect, $update_qry)) {
                    echo "<script>alert('Edited Successfully');</script>";
                    echo "<script>window.open('../../admin_area/index.php?view_categories','_self')</script>";
                } else {
                    echo "<script>alert('Something went wrong');</script>";
                    echo "<script>window.open('../../admin_area/index.php?view_categories','_self')</script>";
                }
            }
            ?>


        <?php } else if (isset($_GET['remove']) && !empty($_GET['remove'])) {

            $category_id = $_GET['remove'];
            $delete_qry = "DELETE FROM categories WHERE category_id='$category_id'";

            if (mysqli_query($connect, $delete_qry)) {
                echo "<script>alert('Deleted Successfully');</script>";
                echo "<script>window.open('../../admin_area/index.php?view_categories','_self')</script>";
            }
        } ?>

    </div>
</body>

</html>