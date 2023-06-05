<?php
session_start();
require "../includes/is_logged.php";

if(isset($_GET['id'])) {
  require_once "../db/db.php";
  $id = clean_input($conn, $_GET['id']);

  $query = "DELETE FROM product WHERE id = $id";
  $_SESSION['message'] = "Product $id deleted successfully";
  $_SESSION['message_type'] = "success";

  header('location: ../products.php');

  // unset product count
  unset($_SESSION['product_count']);

  $conn->query($query);
  $conn->close();

}

?>