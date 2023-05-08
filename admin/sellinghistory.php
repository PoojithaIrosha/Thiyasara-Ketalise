<?php
require_once "../MySQL.php";
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Thiyasara katalise | Manage Selling History</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/logo.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php require "header.php" ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!--         partial:partials/_settings-panel.html -->

        <?php require "chat.php" ?>
        <?php require "sidebar.php" ?>

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <ul class="navbar-nav mr-lg-2">
                            <li class="nav-item nav-search d-none d-lg-block">
                                <div class="input-group">
                                    <div class="col-12 bg-white mt-3 mb-3 ">
                                        <div class="row">
                                            <div class="col-12 col-lg-3 mt-3 mb-3">
                                                <label class="form-label">Search by Invoice Id</label>
                                                <input id="inv-search-input" type="text" class="form-control"
                                                       placeholder="Invoice ID..."/>
                                            </div>
                                            <div class="col-12 col-lg-3 mt-3 mb-3">
                                                <label class="form-label">From Date:</label>
                                                <input id="date-from" type="date" class="form-control"/>
                                            </div>
                                            <div class="col-12 col-lg-3 mt-3 mb-3">
                                                <label class="form-label">To Date:</label>
                                                <input id="date-to" type="date" class="form-control"/>
                                            </div>
                                            <div class="col-12 col-lg-3 mt-3 mb-3 d-grid">
                                                <label class="form-label"></label>
                                                <button onclick="searchOrder()" class="btn btn-primary btn-sm fw-bold">
                                                    Find
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Selling History</h4>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Invoice Id</th>
                                        <th>Buyer</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                        <th>Date</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody id="table-body">

                                    <?php
                                    $invoiceRs = MySQL::search("SELECT * FROM invoice JOIN user u on invoice.user_email = u.email ORDER BY date DESC");

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
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <?php require "footer.php" ?>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="vendors/chart.js/Chart.min.js"></script>
<script src="vendors/datatables.net/jquery.dataTables.js"></script>
<script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="js/dataTables.select.min.js"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="js/off-canvas.js"></script>
<script src="js/hoverable-collapse.js"></script>
<script src="js/template.js"></script>
<script src="js/settings.js"></script>
<script src="js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="js/dashboard.js"></script>
<script src="js/Chart.roundedBarCharts.js"></script>
<script src="js/admin.js"></script>
<!-- End custom js for this page-->
</body>

</html>

