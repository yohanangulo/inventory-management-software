<?php
session_start();

// verify if any user is logged in
require "./includes/is_logged.php";

// database
require "./db/db.php";

if (isset($_GET['id'])) {

  $id = mysqli_escape_string($conn, $_GET['id']);

  $query =
  "SELECT 
    u.id, u.name, u.lastname, u.username, u.email, r.role, r.id as role_id
  FROM
    user AS u
      INNER JOIN
    role AS r ON u.role_id = r.id WHERE u.id = $id;"
  ;

  $result = $conn->query($query);
  $user = $result->fetch_assoc();

  // get roles
  $roles_query = "SELECT * FROM role";
  $roles_result = $conn->query($roles_query);

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
        <h1 class="mt-4">Edit user</h1>
        <div class="row">
          <div class="col-lg-12 col-md-12 mt-5">
            <div class="col-lg-12 col-md-12">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <form method="post" class="p-2" action="./operations/update_user.php">


                        <!-- id -->
                        <div class="mb-3">
                          <label for="id_id" class="form-label requiredField">ID</label>
                          <input
                            type="text"
                            name="id"
                            class="visually-hidden"
                            value="<?= $user['id'] ?>"
                          >
                          <input
                            autocomplete="off"
                            value="<?= $user['id'] ?>"
                            type="text"
                            class="textinput form-control"
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
                            value="<?= $user['name'] ?>"
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
                            value="<?=$user['lastname']?>"
                            type="text"
                            name="lastname"
                            maxlength="50"
                            class="textinput form-control"
                            required=""
                            id="id_category"
                          >
                        </div>

                        <!-- username -->
                        <div class="mb-3">
                          <label for="id_username" class="form-label requiredField">Username</label>
                          <input
                            autocomplete="off"
                            value="<?=$user['username']?>"
                            type="text"
                            name="username"
                            maxlength="50"
                            class="textinput form-control"
                            required=""
                            disabled
                            id="id_username"
                          >
                          <div class="form-text">Readonly</div>
                        </div>

                        <!-- last name -->
                        <div class="mb-3">
                          <label for="id_email" class="form-label requiredField">Email<span class="asteriskField">*</span></label>
                          <input
                            autocomplete="off"
                            value="<?=$user['email']?>"
                            type="email"
                            name="email"
                            class="textinput form-control"
                            required
                            id="id_email"
                          >
                        </div>

                        <!-- role -->
                        <?php if (!($user['username'] == 'admin')) { ?>
                        <div class="mb-3">
                          <label class="form-label requiredField">Role<span class="asteriskField">*</span></label>
                          <select name="role" class="form-select" aria-label="Default select example">
                            <?php while ($role = $roles_result->fetch_assoc()) { ?>
                              <option <?php echo ($role['id'] == $user['role_id']) ? "selected" : ''?> value="<?= $role['id'] ?>">
                                <?= $role['role'] ?>
                              </option>
                            <?php } ?>
                          </select>
                        </div>
                        <?php } ?>
                        
                        <p class="pb-lg-2 mb-0" style="color: #393f81;"><a href="change-password.php?id=<?=$user['id']?>" style="color: #393f81;">Change user password</a></p>

                        <div class="mt-5">
                          <button name="update_user" class="btn btn-success px-4">Save</button>
                          <a href="users.php" class="btn btn-secondary px-4">Cancel</a>
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