<?php

if (!isset($_SESSION['adminid']) || !isset($_SESSION['adminname'])) {
    header('Location:../auth.php?login');
}
?>

<h3 class="text-center text-muted">User Lists</h3>

<table class="table table-dark table-striped table-bordered my-4">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Image</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $user_query = "SELECT * FROM user_info";
        $user_result = mysqli_query($connect, $user_query);
        $users = mysqli_fetch_all($user_result, MYSQLI_ASSOC);
        foreach ($users as $no => $user) {
            if (empty($user['user_img'])) {
                $user['user_img'] = "default.jpg";
            }
        ?>
            <tr>
                <td><?= $no + 1; ?></td>
                <td><?= $user['user_name']; ?></td>
                <td><img style="width:50px;height:50px;" src="../user_area/user_imgs/<?= $user['user_img']; ?>" alt=""></td>
                <td><?= $user['user_email']; ?></td>
                <td><?= $user['user_phone']; ?></td>
                <td><?= $user['user_address']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>