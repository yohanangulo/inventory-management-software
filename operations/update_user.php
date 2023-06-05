<?php

session_start();
require "../includes/is_logged.php";

if (isset($_POST['update_user'])) {
  require "../db/db.php";

  $id = clean_input($conn, $_POST['id']);
  $name = clean_input($conn, $_POST['name']);
  $lastname = clean_input($conn, $_POST['lastname']);
  $email = clean_input($conn, $_POST['email']);
  $role_id = isset($_POST['role']) ? mysqli_escape_string($conn, $_POST['role']) : 1;

  $query =
  "UPDATE user 
  SET
  `name` = '$name',
  `lastname` = '$lastname',
  `email` = '$email',
  `role_id` = $role_id
  WHERE `id` = $id";

  $conn->query($query);

  $conn->close();
  $_SESSION['message'] = "User information updated successfully";
  $_SESSION['message_type'] = "success";
  
  header('location: ../users.php');
}

?>