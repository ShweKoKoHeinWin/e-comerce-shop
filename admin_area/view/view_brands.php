<?php


if (!isset($_SESSION['adminid']) || !isset($_SESSION['adminname'])) {
    header('Location:auth.php?login');
}

include('../includes/connect.php');

$brand_qry = "SELECT * FROM brands ORDER BY brand_title ASC";
$brand_result = mysqli_query($connect, $brand_qry);
$brands = mysqli_fetch_all($brand_result, MYSQLI_ASSOC);
?>

<h2 class="text-primary text-center">Brands</h2>

<table class="table table-dark table-bordered table-striped text-center mb-2">
    <thead>
        <tr>
            <th>No</th>
            <th>Brands</th>
            <th style="width:15%"></th>
            <th style="width:15%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($brands) { ?>
            <?php foreach ($brands as $no => $brand) { ?>
                <tr>
                    <td><?= $no + 1; ?></td>
                    <td><?= $brand['brand_title']; ?></td>
                    <td><a class="btn btn-info" href="admin_controllers/admin_brands_controller.php?edit=<?= $brand['brand_id']; ?>">Edit</a></td>
                    <td><a class="btn btn-danger" href="admin_controllers/admin_brands_controller.php?remove=<?= $brand['brand_id']; ?>">Remove</a></td>
                </tr>

            <?php }
        } else { ?>
            <h3 class="text-center">No Brands.</h3>
        <?php } ?>
    </tbody>
</table>