<?php
session_start();

// verify if any user is logged in
require "./includes/is_logged.php";

require "./db/db.php";

$sql = "SELECT id, concat(name, ' ', lastname) as fullname FROM seller;";

$result = $conn->query($sql);
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
        <h1 class="mt-4">Add product</h1>
        <div class="row">
          <?php require "./includes/message.php";?>
          <div class="col-lg-12 col-md-12 mt-5">
            <div class="col-lg-12 col-md-12">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <form method="post" class="p-2" action="./operations/insert_product.php">

                        <!-- name -->
                        <div class="mb-3">
                          <label for="id_name" class="form-label requiredField"> Name<span class="asteriskField">*</span> </label>
                          <input autocomplete="off" type="text" name="name" maxlength="50" class="textinput form-control" required="" id="id_name">
                          <!-- <div class="form-text"></div> -->
                        </div>

                        <!-- category -->
                        <div class="mb-3">
                          <label for="id_category" class="form-label requiredField">Category<span class="asteriskField">*</span></label>
                          <input autocomplete="off" type="text" name="category" maxlength="50" class="textinput form-control" required="" id="id_category">
                        </div>

                        <!-- Seller -->
                        <div class="mb-3">
                          <label class="form-label requiredField">Seller<span class="asteriskField">*</span></label>
                          <select required name="seller" class="form-select" aria-label="Default select example">
                            <option value="" disabled selected>-- Choose a seller --</option>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                              <option value="<?= $row['id'] ?>"><?= $row['fullname'] ?></option>
                            <?php } ?>
                          </select>
                        </div>

                        <!-- stock -->
                        <div class="mb-3">
                          <label for="id_stock" class="form-label requiredField">Stock<span class="asteriskField">*</span></label>
                          <input autocomplete="off" type="text" maxlength="50" name="stock" value="1" min="1" class="numberinput form-control" required id="id_stock">
                          <!-- <div class="form-text"></div> -->
                        </div>

                        <!-- type -->
                        <div class="mb-3">
                          <label for="id_type" class="form-label requiredField">Product type<span class="asteriskField">*</span></label>
                          <select required class="form-select" name="type" id="id_type">
                            <option value="" disabled selected>-- Choose product type --</option>
                            <option value="1">Physical</option>
                            <option value="2">Digital</option>
                          </select>
                        </div>

                        <div class="mt-5">
                          <button name="add_product" class="btn btn-success px-4">Add</button>
                          <a href="products.php" class="btn btn-secondary px-4">Cancel</a>
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