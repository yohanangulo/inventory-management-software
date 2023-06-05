<?php

if (isset($_SESSION['is_logged_in'])) {
  header('location: dashboard.php');
  exit;
}

if ($_POST) {
  if (!(isset($_POST['user']) and isset($_POST['password']))) return; 

  require_once "./db/db.php";
  
  
  $user = clean_input($conn, $_POST['user']);
  $password = clean_input($conn, $_POST['password']);
  $password_c = sha1($password);
  

  $query = "SELECT username, password, role_id FROM user WHERE BINARY username = ? ";

  $stmt = $conn->prepare($query);
  $stmt->bind_param('s', $user);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt = null;
  
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_db = $row['username'];
    $password_db = $row['password'];
    $role = $row['role_id'];


    if ($password_c === $password_db) {
      $_SESSION['is_logged_in'] = true;
      $_SESSION['username'] = $user_db;
      $_SESSION['role_id'] = $row['role_id'];
      header('location: dashboard.php');
    } else {
      echo "Wrong password";
    }

  } else {
    echo "User not found";
  }
  $conn->close();
}
?>