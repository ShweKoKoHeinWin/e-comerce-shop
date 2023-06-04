<?php if (isset($_GET['orders']) && isset($_GET['pending'])) { ?>
    <h3 class='text-center text-primary'>Pending Orders</h3>
    <table style="width:100%" class="table table-dark table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Invoice ID</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($order_pendings)) { ?>
                <?php foreach ($order_pendings as $No => $orders) { ?>
                    <tr>
                        <td><?= $No; ?></td>
                        <td><?= $orders['invoice_id']; ?></td>
                        <td><?php $qty = json_decode($orders['product_qty_arr'], true);
                            echo array_sum($qty); ?></td>
                        <td><?= $orders['total_amount']; ?></td>
                        <td><?= $orders['order_status']; ?></td>
                        <td><?= $orders['order_date']; ?></td>
                        <td><a href="orderController.php?edit&orderid=<?= $orders['order_id']; ?>">More</a></td>
                    </tr>

                <?php } ?>

            <?php } else { ?>
                <tr>
                    <td colspan="6">
                        <h3>NO Pending Orders</h3>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>


<?php } else if (isset($_GET['orders']) && isset($_GET['success'])) { ?>
    <h3 class='text-center text-primary'>Success Orders</h3>
    <table style="width:100%" class="table table-dark table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Invoice ID</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($order_successes)) { ?>
                <?php foreach ($order_successes as $No => $orders) { ?>

                    <tr>
                        <td><?= $No; ?></td>
                        <td><?= $orders['invoice_id']; ?></td>
                        <td><?php $qty = json_decode($orders['product_qty_arr'], true);
                            echo array_sum($qty); ?></td>
                        <td><?= $orders['total_amount']; ?></td>
                        <td><?= $orders['order_status']; ?></td>
                        <td><?= $orders['order_date']; ?></td>
                        <td><a href="orderController.php?history&orderid=<?= $orders['order_id']; ?>">More</a></td>
                    </tr>

                <?php } ?>

            <?php } else { ?>
                <tr>
                    <td colspan="6">
                        <h3>NO Success Orders</h3>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else if (isset($_GET['orders']) && isset($_GET['allorders'])) { ?>
    <h3 class='text-center text-primary'>All Orders</h3>
    <table style="width:100%" class="table table-dark table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Invoice ID</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($order_all)) { ?>
                <?php foreach ($order_all as $No => $orders) { ?>

                    <tr>
                        <td><?= $No; ?></td>
                        <td><?= $orders['invoice_id']; ?></td>
                        <td><?php $qty = json_decode($orders['product_qty_arr'], true);
                            echo array_sum($qty); ?></td>
                        <td><?= $orders['total_amount']; ?></td>
                        <td><?= $orders['order_status']; ?></td>
                        <td><?= $orders['order_date']; ?></td>
                        <td><a href="orderController.php?allorders&orderid=<?= $orders['order_id']; ?>">More</a></td>
                    </tr>

                <?php } ?>

            <?php } else { ?>
                <tr>
                    <td colspan="6">
                        <h3>NO Orders</h3>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <a href="profileController.php?orders&pending">
        <h2 class="text-secondary">You have <?= $num_of_pending; ?> pending orders</h2>
    </a>
    <br>
    <i class="text-info">AND</i>
    <br>
    <a href="profileController.php?orders&success">
        <h2 class="text-success"><?= $num_of_success; ?> success orders</h2>
    </a>
    <br>
    <i class="text-info">SO</i>
    <br>
    <a href="profileController.php?orders&allorders">
        <h2 class="text-primary">You did total <?= $num_of_all; ?> orders</h2>
    </a>
<?php } ?>