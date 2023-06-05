<?php
session_start();
if (!isset($_SESSION['username'])) header('location: signin.php');

require_once "./db/db.php";
// get the number of products
$sql = "SELECT * FROM seller";
$result = $conn->query($sql);
// $data = $result->fetch_assoc();

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
        <h1 class="mt-4">Sellers</h1>
        <div class="row">
          <?php require_once "./includes/message.php";?>
          <div class="card mb-4 mt-5">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              List of all sellers
            </div>
            <div class="card-body">
              <?php if ($_SESSION['role_id'] == 1) {?>
              <a href="add-seller.php" class="btn btn-success mb-3">
                <div>
                  <i class="fa-solid fa-circle-plus"></i>
                  Create seller
                </div>
              </a>
              <?php } ?>
              <table id="datatablesSimple">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <?php if ($_SESSION['role_id'] == 1) { ?>
                    <th>Action</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                      <td><?= $row['id'] ?></td>
                      <td><?= $row['name'] ?></td>
                      <td><?= $row['lastname'] ?></td>
                      <td><?= $row['age'] ?></td>
                      <?php if ($_SESSION['role_id'] == 1) { ?>
                      <td>
                        <div class="d-flex gap-1 justify-content-center">
                          <!-- edit -->
                          <a title="Edit" href="./edit-seller.php?id=<?= $row['id'] ?>" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-pencil"></i>
                          </a>

                          <!-- delete -->
                          <a href="./operations/delete_seller.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                          </a>
                        </div>
                      </td>
                      <?php } ?>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php require_once "./includes/panel/dashboard_footer.php"; ?>