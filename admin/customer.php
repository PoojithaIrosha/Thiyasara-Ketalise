<?php
session_start();
require_once "../MySQL.php";

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
    <title>Thiyasara katalise | Manage Users</title>
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
                                    <div class="input-group-prepend hover-cursor col-10" id="navbar-search-icon">
                                        <div class="d-flex justify-content-center align-items-center" id="search">
                                            <i class="icon-search" style="font-size: 27px;"></i>
                                        </div>
                                        <input type="text" class="form-control border-0" id="navbar-search-input"
                                               placeholder="Search customers" aria-label="search"
                                               aria-describedby="search">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All customers</h4>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Registered Date</th>
                                        <th>Password</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $userRs = MySQL::search("SELECT * FROM user");
                                    while ($user = $userRs->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                $userImgRs = MySQL::search("SELECT * FROM profile_image WHERE user_email = '" . $user['email'] . "'");

                                                if ($userImgRs->num_rows > 0) {
                                                    $userProfile = $userImgRs->fetch_assoc();

                                                    ?>
                                                    <img src="../<?= $userProfile['path'] ?>">
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="../assets/images/profile_img/newuser.svg">
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td><?= $user["fname"] ?> <?= $user["lname"] ?></td>
                                            <td><?= $user["email"] ?></td>
                                            <td><?= $user["mobile"] ?></td>
                                            <?php
                                            $uhaRs = MySQL::search("SELECT * FROM user_has_address JOIN city c on c.id = user_has_address.city_id WHERE user_email = '" . $user['email'] . "'");
                                            if($uhaRs->num_rows > 0) {
                                                $uha = $uhaRs->fetch_assoc();
                                                ?>
                                                <td><?= $uha["line1"] ?>, <?= $uha["line2"] ?>, <?= $uha["name"] ?></td>
                                            <?php
                                            }else {
                                                ?>
                                            <td>N/A</td>
                                            <?php
                                            }
                                            ?>

                                            <td><?= $user["reg_date"] ?></td>
                                            <td><?= $user["password"] ?></td>

                                            <td class="text-center">
                                                <label onclick="deleteUser('<?= $user['email'] ?>')"
                                                       class="badge badge-danger"><i
                                                            class="fa-solid fa-trash"></i></label>
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
<script src="js/admin.js"></script>
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
<!-- End custom js for this page-->
</body>

</html>

