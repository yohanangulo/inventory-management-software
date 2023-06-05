<?php

session_start();
require "../includes/is_logged.php";

if (isset($_POST['add_seller'])) {
  require "../db/db.php";
  $name = clean_input($conn, $_POST['name']);
  $lastname = clean_input($conn, $_POST['lastname']);
  $age = clean_input($conn, $_POST['age']);

  $query =
  "INSERT INTO `inventory`.`seller`
  (`name`,
  `lastname`,
  `age`)
    VALUES
  ('$name',
  '$lastname',
  '$age')";

  $conn->query($query);
  $conn->close();

  $_SESSION['message'] = "Seller added successfully";
  $_SESSION['message_type'] = "success";
  header('location: ../add-seller.php');
}

?>