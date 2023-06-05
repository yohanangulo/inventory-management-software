<?php
session_start();
require "../includes/is_logged.php";

if (isset($_POST['update_user_password'])) {
  require "../db/db.php";

  $id = clean_input($conn, $_POST['id']);
  $password = clean_input($conn, $_POST['password']);
  $password_confirmation = clean_input($conn, $_POST['password_confirmation']);

  if (!($password === $password_confirmation)) {
    $_SESSION['message'] = "Password don't match";
    $_SESSION['message_type'] = "danger";
    
    header("location: ../change-password.php?id=$id");
    exit;
  }
  
  if (strlen($password) < 4) {

    $_SESSION['message'] = "Password must have at least 4 characters";
    $_SESSION['message_type'] = "danger";
    
    header("location: ../change-password.php?id=$id");
    exit;
  }

  $query =
  "UPDATE user 
  SET
  `password` = sha1(?)
  WHERE `id` = ?";

  $stmt = $conn->prepare($query);
  $stmt->bind_param('ss', $password, $id);
  $stmt->execute();
  $stmt = null;

  $conn->close();
  $_SESSION['message'] = "Password updated successfully";
  $_SESSION['message_type'] = "success";
  
  header('location: ../users.php');

}
  ?>