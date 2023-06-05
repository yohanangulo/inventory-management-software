<?php
session_start();

// check if it is logged in ad has permissions
require "./includes/is_logged.php";

require_once "./db/db.php";

$query =
"SELECT 
  u.id, u.name, u.lastname, u.username, u.email, r.role
FROM
  user AS u
    INNER JOIN
  role AS r ON u.role_id = r.id;"
;

$result = $conn->query($query);
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
        <h1 class="mt-4">Users</h1>
        <div class="row">
          <?php require_once "./includes/message.php";?>
          <div class="card mb-4 mt-5">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              List of users
            </div>
            <div class="card-body">
              <table id="datatablesSimple">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Usermane</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                      <td><?= $row['id'] ?></td>
                      <td><?= $row['name'] ?></td>
                      <td><?= $row['lastname'] ?></td>
                      <td><?= $row['username'] ?></td>
                      <td><?= $row['email'] ?></td>
                      <td><?= $row['role'] ?></td>
                      <td>
                        <div class="d-flex gap-1 justify-content-center">
                          <!-- edit -->
                          <a title="Edit" href="./edit-user.php?id=<?= $row['id'] ?>" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-pencil"></i>
                          </a>
                          
                          <!-- delete -->
                          <?php if (!($row['username'] == 'admin')) { ?>
                          <a href="./operations/delete_user.php?id=<?= $row['id'] ?>" title="delete" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                          </a>
                          <?php } ?>
                        </div>
                      </td>
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