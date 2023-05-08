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
    <title>Thiyasara katalise | Manage Category</title>
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
        <!--partial:partials/_settings-panel.html -->
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
                                               placeholder="Search Category" aria-label="search"
                                               aria-describedby="search">
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#addproduct">
                                            Add Category
                                        </button>
                                    </div>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Categories</h4>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Name</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $categoryRs = MySQL::search("SELECT * FROM category");
                                    while ($category = $categoryRs->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?= $category["id"] ?></td>
                                            <td><?= $category["name"] ?></td>
                                            <td class="text-center">
                                                <label onclick='showUpdateCategoryModal(<?= json_encode($category) ?>)'
                                                       class="badge badge-warning"><i
                                                            class="fa-solid fa-pen-to-square"></i></label>
                                                <label onclick="deleteCategory('<?= $category['id'] ?>')"
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
                <!--Modal-->
                <div class="modal" id="addproduct" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!--Form-->
                                <form class="forms-sample">
                                    <div class="form-group row">
                                        <label for="categoryname" class="col-sm-3 col-form-label">Category Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="categoryname"
                                                   placeholder="Category Name">
                                        </div>
                                    </div>
                                </form>
                                <!--Form-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="addNewCategory()">Add New
                                    Category
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Modal-->

                <!--Modal-->
                <div class="modal" id="updatecategory" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!--Form-->
                                <form class="forms-sample">
                                    <div>
                                        <input type="text" id="cat-id" hidden>
                                    </div>
                                    <div class="form-group row">
                                        <label for="u-categoryname" class="col-sm-3 col-form-label">Category
                                            Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="u-categoryname"
                                                   placeholder="Category Name">
                                        </div>
                                    </div>
                                </form>
                                <!--Form-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="updateCategory()">Add New
                                    Category
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Modal-->
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
<script src="js/admin.js"></script>
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
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
<!-- End custom js for this page-->
</body>

</html>

