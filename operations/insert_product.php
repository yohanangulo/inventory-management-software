<?php

session_start();
require "../includes/is_logged.php";

if (isset($_POST['add_product'])) {
  require "../db/db.php";
  $name = clean_input($conn, $_POST['name']);
  $category = clean_input($conn, $_POST['category']);
  $seller = clean_input($conn, $_POST['seller']);
  $stock = clean_input($conn, $_POST['stock']);
  $product_type = clean_input($conn, $_POST['type']);

  $query = "INSERT INTO `product`
  (`name`,
  `category`,
  `seller_id`,
  `stock`,
  `type_id`)
    VALUES
  ('$name',
  '$category',
  $seller,
  $stock,
  $product_type)";

  $conn->query($query);
  $conn->close();

  // unset product count
  unset($_SESSION['product_count']);
  
  $_SESSION['message'] = "Product added successfully";
  $_SESSION['message_type'] = "success";
  header('location: ../add-product.php');
}

?>