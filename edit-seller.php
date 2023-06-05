<?php
session_start();

// verify if any user is logged in
require "./includes/is_logged.php";

// database
require "./db/db.php";

if (isset($_GET['id'])) {

  $id = mysqli_escape_string($conn, $_GET['id']);

  $query = "SELECT * FROM seller WHERE id = $id;";

  $result = $conn->query($query);
  $row = $result->fetch_assoc();

  $conn->close();
}



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
        <h1 class="mt-4">Edit seller</h1>
        <div class="row">
          <div class="col-lg-12 col-md-12 mt-5">
            <div class="col-lg-12 col-md-12">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <form method="post" class="p-2" action="./operations/update_seller.php">


                        <!-- id -->
                        <div class="mb-3">
                          <label for="id_id" class="form-label requiredField">ID</label>
                          <input
                            type="text"
                            name="id"
                            class="visually-hidden"
                            value="<?= $row['id'] ?>"
                          >
                          <input
                            autocomplete="off"
                            value="<?= $row['id'] ?>"
                            type="text"
                            class="textinput form-control"
                            required
                            id="id_id"
                            disabled
                          >
                          <div class="form-text">Readonly</div>
                        </div>

                        <!-- name -->
                        <div class="mb-3">
                          <label for="id_name" class="form-label requiredField"> Name<span class="asteriskField">*</span> </label>
                          <input
                            autocomplete="off"
                            value="<?= $row['name'] ?>"
                            type="text"
                            name="name"
                            maxlength="50"
                            class="textinput form-control"
                            required=""
                            id="id_name"
                          >
                        </div>


                        <!-- last name -->
                        <div class="mb-3">
                          <label for="id_lastNmae" class="form-label requiredField">Last Name<span class="asteriskField">*</span></label>
                          <input
                            autocomplete="off"
                            value="<?=$row['lastname']?>"
                            type="text"
                            name="lastname"
                            maxlength="50"
                            class="textinput form-control"
                            required=""
                            id="id_category"
                          >
                        </div>

                        <!-- age -->
                        <div class="mb-3">
                          <label for="id_age" class="form-label requiredField">Age<span class="asteriskField">*</span></label>
                          <input
                            autocomplete="off"
                            value="<?=$row['age']?>"
                            type="number"
                            maxlength="50"
                            name="age"
                            max="90"
                            min="18"
                            class="numberinput form-control"
                            required
                            id="id_age"
                          >
                          <!-- <div class="form-text"></div> -->
                        </div>


                        <div class="mt-5">
                          <button name="update_seller" class="btn btn-success px-4">Save</button>
                          <a href="sellers.php" class="btn btn-secondary px-4">Cancel</a>
                        </div>

                      </form>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </main>
    <?php require_once "./includes/panel/dashboard_footer.php"; ?>