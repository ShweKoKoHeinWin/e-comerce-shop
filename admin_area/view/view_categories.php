<?php
if (!isset($_SESSION['adminid']) || !isset($_SESSION['adminname'])) {
    header('Location:auth.php?login');
}
include('../includes/connect.php');

$category_qry = "SELECT * FROM categories ORDER BY category_title ASC";
$category_result = mysqli_query($connect, $category_qry);
$categories = mysqli_fetch_all($category_result, MYSQLI_ASSOC);
?>

<h2 class="text-primary text-center">Categories</h2>

<table class="table table-dark table-bordered table-striped text-center mb-2">
    <thead>
        <tr>
            <th>No</th>
            <th>Categories</th>
            <th style="width:15%"></th>
            <th style="width:15%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($categories) { ?>
            <?php foreach ($categories as $no => $category) { ?>
                <tr>
                    <td><?= $no + 1; ?></td>
                    <td><?= $category['category_title']; ?></td>
                    <td><a class="btn btn-info" href="admin_controllers/admin_categories_controller.php?edit=<?= $category['category_id']; ?>">Edit</a></td>
                    <td><a class="btn btn-danger" href="admin_controllers/admin_categories_controller.php?remove=<?= $category['category_id']; ?>">Remove</a></td>
                </tr>

            <?php }
        } else { ?>
            <h3 class="text-center">No Categories.</h3>
        <?php } ?>
    </tbody>
</table>