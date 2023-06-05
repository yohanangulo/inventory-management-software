<?php
session_start();

// verify if any user is logged in
require "./includes/is_logged.php";

// database
require "./db/db.php";

if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($conn, $_GET['id']);

  $query = "SELECT username FROM user WHERE id = $id";
  $result = $conn->query($query);
  $row = $result->fetch_assoc();
  $username = $row['username'];

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
        <h1 class="mt-4">Change password</h1>
        <?php require_once "./includes/message.php";?>
        <div class="row">
          <div class="col-lg-12 col-md-12 mt-5">
            <div class="col-lg-12 col-md-12">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <form method="post" class="p-2" action="./operations/update_user_password.php">

                        <p class="h5 mb-5">Change <span class="fw-semibold">"<?=$username?>"</span> password</p>

                        <!-- id -->
                        <input
                          name="id"
                          value="<?=$id?>"
                          type="hidden"
                        >

                        <!-- password -->
                        <div class="mb-3">
                          <label for="id_password" class="form-label requiredField">New password<span class="asteriskField">*</span> </label>
                          <input
                            autocomplete="off"
                            type="password"
                            name="password"
                            min="4"
                            maxlength="50"
                            class="textinput form-control"
                            required
                            id="id_password"
                          >
                        </div>

                        <!-- password confirmation -->
                        <div class="mb-3">
                          <label for="id_password_confirmation" class="form-label requiredField">Confirm password<span class="asteriskField">*</span> </label>
                          <input
                            autocomplete="off"
                            min="4"
                            type="password"
                            name="password_confirmation"
                            maxlength="50"
                            class="textinput form-control"
                            required
                            id="id_password_confirmation"
                          >
                        </div>

                        <div class="mt-5">
                          <button name="update_user_password" class="btn btn-success px-4">Change password</button>
                          <a href="edit-user.php?id=<?=$id?>" class="btn btn-secondary px-4">Cancel</a>
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