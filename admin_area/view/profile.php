<?php

$id = $_SESSION['adminid'];

$profile_qry = "SELECT * FROM admins WHERE id='$id'";
$profile_result = mysqli_query($connect, $profile_qry);
$profile = mysqli_fetch_assoc($profile_result);

?>
<div class='card w-50 bg-warning p-2 m-auto'>
    <div class='card-body'>
        <h5 class='card-title'>Admin : <?= $profile['name']; ?></h5>
        <p class='card-text'>email : <?= $profile['email'] ?></p>
        <div class='d-flex flex-column'>
            <a href='auth.php?edit=<?= $id; ?>' class='btn btn-info mb-2'>Edit Profile</a>
            <a href='auth.php?delete=<?= $id; ?>' class='btn btn-danger mb-2'>Delete Account</a>
        </div>
    </div>
</div>