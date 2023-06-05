<?php

session_start();
require "../includes/is_logged.php";

if (isset($_POST['update_product'])) {
  require "../db/db.php";

  $id = clean_input($conn, $_POST['id']);
  $name = clean_input($conn, $_POST['name']);
  $category = clean_input($conn, $_POST['category']);
  $seller = clean_input($conn, $_POST['seller']);
  $stock = clean_input($conn, $_POST['stock']);
  $product_type = clean_input($conn, $_POST['type']);

  $query =
  "UPDATE product
  SET
  `name` = '$name',
  `category` = '$category',
  `seller_id` = '$seller',
  `stock` = '$stock',
  `type_id` = '$product_type'
  WHERE `id` = $id";

  $conn->query($query);

  $conn->close();
  $_SESSION['message'] = "Product $id saved successfully";
  $_SESSION['message_type'] = "success";
  
  header('location: ../products.php');
}

?>