<?php

session_start();
require "../includes/is_logged.php";

if (isset($_POST['update_seller'])) {
  require "../db/db.php";

  $id = clean_input($conn, $_POST['id']);
  $name = clean_input($conn, $_POST['name']);
  $lastname = clean_input($conn, $_POST['lastname']);
  $age = clean_input($conn, $_POST['age']);

  $query =
  "UPDATE seller 
  SET
  `name` = '$name',
  `lastname` = '$lastname',
  `age` = '$age'
  WHERE `id` = $id";

  $conn->query($query);

  $conn->close();
  $_SESSION['message'] = "Seller $id saved successfully";
  $_SESSION['message_type'] = "success";
  
  header('location: ../sellers.php');
}

?>