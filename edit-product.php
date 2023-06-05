<?php
session_start();

// verify if any user is logged in
require "./includes/is_logged.php";

// database
require "./db/db.php";

if (isset($_GET['id'])) {

  $id = mysqli_escape_string($conn, $_GET['id']);

  $query = "SELECT 
    p.id,
    p.name,
    p.category,
    s.id AS seller_id,
    p.stock,
    pt.type
  FROM
    product AS p
        INNER JOIN
    seller AS s ON p.seller_id = s.id
        INNER JOIN
  product_type AS pt ON p.type_id = pt.id WHERE p.id = $id;";

  $result = $conn->query($query);
  $row = $result->fetch_assoc();

  // get sellers
  $query_sellers = "SELECT id, concat(name, ' ', lastname) as fullname FROM seller";
  $seller_results = $conn->query($query_sellers);

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
        <h1 class="mt-4">Edit product</h1>
        <div class="row">
          <div class="col-lg-12 col-md-12 mt-5">
            <div class="col-lg-12 col-md-12">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <form method="post" class="p-2" action="./operations/update_product.php">


                        <!-- id -->
                        <div class="mb-3">
                          <label for="id_id" class="form-label requiredField">ID</label>
                          <input
                            type="hidden"
                            name="id"
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

                        <!-- category -->
                        <div class="mb-3">
                          <label for="id_category" class="form-label requiredField">Category<span class="asteriskField">*</span></label>
                          <input
                            value="<?=$row['category']?>"
                            autocomplete="off"
                            type="text"
                            name="category"
                            maxlength="50"
                            class="textinput form-control"
                            required=""
                            id="id_category"
                          >
                        </div>

                        <!-- Seller -->
                        <div class="mb-3">
                          <label class="form-label requiredField">Seller<span class="asteriskField">*</span></label>
                          <select name="seller" class="form-select" aria-label="Default select example">
                            <?php while ($seller = $seller_results->fetch_assoc()) { ?>
                              <option <?php echo ($row['seller_id'] == $seller['id']) ? "selected" : ''?> value="<?= $seller['id'] ?>">
                                <?= $seller['fullname'] ?>
                              </option>
                            <?php } ?>
                          </select>
                        </div>

                        <!-- stock -->
                        <div class="mb-3">
                          <label for="id_stock" class="form-label requiredField">Stock<span class="asteriskField">*</span></label>
                          <input
                            value="<?=$row['stock']?>"
                            autocomplete="off"
                            type="text"
                            maxlength="50"
                            name="stock"
                            min="1"
                            class="numberinput form-control"
                            required
                            id="id_stock"
                          >
                          <!-- <div class="form-text"></div> -->
                        </div>

                        <!-- type -->
                        <div class="mb-3">
                          <label for="id_type" class="form-label requiredField">Product type<span class="asteriskField">*</span></label>
                          <select class="form-select" name="type" id="id_type">
                            <option <?php if ($row['type'] == 'Physical') echo "selected" ?> value="1">Physical</option>
                            <option <?php if ($row['type'] == 'Digital') echo "selected" ?> value="2">Digital</option>
                          </select>
                        </div>

                        <div class="mt-5">
                          <button name="update_product" class="btn btn-success px-4">Save</button>
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