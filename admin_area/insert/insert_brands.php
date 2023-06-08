<?php
include('../includes/connect.php');

if (!isset($_SESSION['adminid']) || !isset($_SESSION['adminname'])) {
    header('Location:../auth.php?login');
}
if (isset($_POST['insert_brand'])) {
    $brand_title = $_POST['brand_title'];

    // Select data from table 
    $select_query = "SELECT * FROM brands WHERE brand_title = '$brand_title'";
    $select_result = mysqli_query($connect, $select_query);
    $number = mysqli_num_rows($select_result);

    // Check the data is already existed;
    if ($number > 0) {
        echo "<script>alert('This is present inside the database');</script>";
    } else {
        $insert_query = "INSERT INTO brands (brand_title) VALUES ('$brand_title')";
        $result = mysqli_query($connect, $insert_query);
        if ($result) {
            echo "<script>alert('$brand_title is added')</script>";
        } else {
            echo "bad";
        }
    }
}

?>

<form action="" method="post" class="mb-2">
    <h2 class="text-center">Insert Brands</h2>
    <div class="input-group w-90 mb-2">
        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" name="brand_title" id="" class="form-control" placeholder="Insert Brands">
    </div>

    <div class="input-group w-10 mb-2">
        <input type="submit" value="Insert Brands" class="btn btn-secondary text-light mx-auto" name="insert_brand">
    </div>
</form>