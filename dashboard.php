<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: signin.php');
    exit;
}

require_once "./db/db.php";
// get the number of products
$sql = "SELECT COUNT(*) as product_count, (SELECT COUNT(*) from seller) as seller_count, (SELECT COUNT(*) FROM user) as user_count FROM product;";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$products_count = $data['product_count'];
$seller_count = $data['seller_count'];
$user_count = $data['user_count'];

$conn->close();


?>
<?php require_once "./includes/panel/dashboard_header.php"; ?>
<?php require_once "./includes/panel/dashborad_nav.php"; ?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php require_once "./includes/siderbar.php"; ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Welcome <?= $_SESSION['username'] ?></li>
                </ol>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Total Products: <?= $products_count ?></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="products.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">Total sellers: <?= $seller_count ?></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="sellers.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <?php if ($_SESSION['role_id'] == 1) { ?>
                    <div class="col-xl-3 col-md-12">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">Total users: <?= $user_count ?></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="./users.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </main>
        <?php require_once "./includes/panel/dashboard_footer.php"; ?>