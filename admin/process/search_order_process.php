<?php

require "../../MySQL.php";

$text = $_POST['text'];
$dateFrom = $_POST['from'];
$dateTo = $_POST['to'];

$q = "SELECT * FROM invoice JOIN user u on invoice.user_email = u.email WHERE id LIKE '%" . $text . "%'";

if (!empty($dateFrom) && empty($dateTo)) {
    $q .= " AND date >= '" . $dateFrom . "'";
} else if (empty($dateFrom) && !empty($dateTo)) {
    $q .= " and date <= '" . $dateTo . "'";
} else if (!empty($dateFrom) && !empty($dateTo)) {
    $q .= " AND date BETWEEN '" . $dateFrom . "' AND '" . $dateTo . "'";
}

$invoiceRs = MySQL::search($q);
while ($inv = $invoiceRs->fetch_assoc()) {
    ?>
    <tr>
        <td><?= $inv['id'] ?></td>
        <td><?= $inv['fname'] . ' ' . $inv['lname'] ?></td>
        <td>Rs.<?= $inv['amount'] ?></td>
        <td>
            <?= MySQL::search("SELECT * FROM invoice_item WHERE invoice_id = '" . $inv['id'] . "'")->num_rows ?>
        </td>
        <td><?= $inv['date'] ?></td>
        <td>
            <div class="d-flex justify-content-center align-items-center">

                <?php
                if ($inv['status'] == '0') {
                    ?>
                    <button onclick="changeOrderStatus('<?= $inv['id'] ?>')" class="btn btn-warning btn-sm">Delivering</button>
                    <?php
                }else if($inv['status'] == '1') {
                    ?>
                    <button class="btn btn-success btn-sm">Order Complete</button>
                    <?php
                }
                ?>


            </div>
        </td>
    </tr>
    <?php
}
