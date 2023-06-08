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
    <title>Edit Brands</title>
    <!-- Cdn css -->
    <?php require "./../../css/stylelinks.html" ?>

    <!-- Custom css -->
    <link rel="stylesheet" href="./../../css/style.css" />
</head>

<body>
    <div class="py-4 container">

        <a href="../index.php?view_brands" class="btn btn-primary mt-3">Back</a>
        <?php if (isset($_GET['edit']) && !empty($_GET['edit'])) { ?>
            <h2 class="text-center text-secondary">Edit Brands</h2>

            <?php
            $brand_id = $_GET['edit'];
            $brand_qry = "SELECT * FROM brands WHERE brand_id='$brand_id'";
            $brand_result = mysqli_query($connect, $brand_qry);
            if ($brand = mysqli_fetch_assoc($brand_result)) {
                $brand_title = $brand['brand_title'];
            }
            ?>
            <form action="" class="form w-50 m-auto bg-warning border border-rounded p-5" method="post">
                <div class="form-group mb-3">
                    <label class="text-muted h5" for="brand">Title</label>
                    <input id="brand" name="brand" value="<?= $brand_title; ?>" type="text" class="form-control">
                </div>

                <div class="d-flex justify-content-center">
                    <input class="btn btn-success" type="submit" name="update" value="Edit">
                </div>

            </form>

            <?php
            if (isset($_POST['update'])) {
                $update_title = $_POST['brand'];
                $update_qry = "UPDATE brands SET brand_title='$update_title' WHERE brand_id='$brand_id'";
                if (mysqli_query($connect, $update_qry)) {
                    echo "<script>alert('Edited Successfully');</script>";
                    echo "<script>window.open('../../admin_area/index.php?view_brands','_self')</script>";
                } else {
                    echo "<script>alert('Something went wrong');</script>";
                    echo "<script>window.open('../../admin_area/index.php?view_brands','_self')</script>";
                }
            }
            ?>


        <?php } else if (isset($_GET['remove']) && !empty($_GET['remove'])) {

            $brand_id = $_GET['remove'];
            $delete_qry = "DELETE FROM brands WHERE brand_id='$brand_id'";

            if (mysqli_query($connect, $delete_qry)) {
                echo "<script>alert('Deleted Successfully');</script>";
                echo "<script>window.open('../../admin_area/index.php?view_brands','_self')</script>";
            }
        } ?>

    </div>
</body>

</html>