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
    <title>Thiyasara katalise | Manage Products</title>
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
                                               placeholder="Search Product" aria-label="search"
                                               aria-describedby="search">
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#addproduct">
                                            Add Product
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
                            <h4 class="card-title">All Products</h4>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php


                                    $prodRs = MySQL::search("SELECT *, product.id as pid, c.name as cat, c.id as cid, b.id as bid FROM product 
                                    JOIN category c on c.id = product.category_id JOIN brand b on product.brand_id = b.id 
                                    JOIN product_img pi on product.id = pi.product_id ORDER BY product.datetime DESC ");
                                    while ($prod = $prodRs->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td>
                                                <img src="../<?= $prod["path"] ?>">
                                            </td>
                                            <td><?= $prod["title"] ?></td>
                                            <td><?= $prod["name"] ?></td>
                                            <td><?= $prod["b_name"] ?></td>
                                            <td><?= $prod["qty"] ?></td>
                                            <td><?= $prod["price"] ?></td>
                                            <td><?= $prod["description"] ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                           id="pstatus<?= $prod['pid'] ?>"
                                                           onchange="changeProductStatus('<?= $prod['pid'] ?>')"
                                                        <?= ($prod['status_id'] == 1) ? "checked" : "" ?>>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <label class="badge badge-warning" onclick='showUpdateProductModal(<?= json_encode($prod)  ?>)'>
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </label>
                                                <label class="badge badge-danger" onclick="deleteProduct('<?= $prod['pid'] ?>')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </label>
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
                                <h5 class="modal-title">Add Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!--Form-->
                                <div class="forms-sample">
                                    <div class="form-group row">
                                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Product
                                            Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="pname"
                                                   placeholder="Product Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Category</label>
                                        <div class="col-sm-9">
                                            <select type="email" class="form-control" id="category"
                                                    placeholder="Category">
                                                <option>Select Category</option>
                                                <?php
                                                $prodRs = MySQL::search("SELECT * FROM category");
                                                while ($prod = $prodRs->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $prod['id'] ?>"><?= $prod["name"] ?></option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Brand</label>
                                        <div class="col-sm-9">
                                            <select type="text" class="form-control" id="brand" placeholder="Brand">
                                                <option>Select Brand</option>
                                                <?php
                                                $prodRs = MySQL::search("SELECT * FROM brand");
                                                while ($prod = $prodRs->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $prod['id'] ?>"><?= $prod["b_name"] ?></option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Qty</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="qty" placeholder="Qty">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputConfirmPassword2"
                                               class="col-sm-3 col-form-label">Price</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="price" placeholder="Price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="desc" placeholder="Description">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="form-label">Product Images</label>
                                        <div class="d-flex justify-content-center gap-3"
                                             id="images-container">

                                            <!-- Product Images -->

                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Upload Media</label>
                                        <input type="file" class="form-control"
                                               id="productImages" accept="image/*" multiple
                                               onchange="addProductImage()">
                                    </div>

                                </div>
                                <!--Form-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" onclick="addProduct()">Add Product</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Modal-->

                <!--Update Modal-->
                <div class="modal" id="updateproduct" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!--Form-->
                                <div class="forms-sample">
                                    <div>
                                        <input type="text" id="pid" hidden>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Product
                                            Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="u-pname"
                                                   placeholder="Product Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Category</label>
                                        <div class="col-sm-9">
                                            <select type="email" class="form-control" id="u-category"
                                                    placeholder="Category">
                                                <option>Select Category</option>
                                                <?php
                                                $prodRs = MySQL::search("SELECT * FROM category");
                                                while ($prod = $prodRs->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $prod['id'] ?>"><?= $prod["name"] ?></option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Brand</label>
                                        <div class="col-sm-9">
                                            <select type="text" class="form-control" id="u-brand" placeholder="Brand">
                                                <option>Select Brand</option>
                                                <?php
                                                $prodRs = MySQL::search("SELECT * FROM brand");
                                                while ($prod = $prodRs->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $prod['id'] ?>"><?= $prod["b_name"] ?></option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Qty</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="u-qty" placeholder="Qty">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputConfirmPassword2"
                                               class="col-sm-3 col-form-label">Price</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="u-price" placeholder="Price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="u-desc" placeholder="Description">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="form-label">Product Images</label>
                                        <div class="d-flex justify-content-center gap-3"
                                             id="u-images-container">
                                            <!-- Product Images -->
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Upload Media</label>
                                        <input type="file" class="form-control"
                                               id="u-productImage" accept="image/*"
                                               onchange="updateProductImage()">
                                    </div>

                                </div>
                                <!--Form-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" onclick="updateProduct()">Add Product</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Update Modal-->
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
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
<!-- End custom js for this page-->
<script src="js/admin.js"></script>
</body>

</html>

