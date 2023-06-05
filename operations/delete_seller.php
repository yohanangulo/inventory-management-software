<?php
session_start();
require "../includes/is_logged.php";


if(isset($_GET['id'])) {
  require_once "../db/db.php";
  $id = clean_input($conn, $_GET['id']);
  
  $query = "SELECT seller_id FROM product WHERE seller_id = $id LIMIT 1";
  $result = $conn->query($query);

  if ($result->num_rows > 0 ) {

    $_SESSION['message'] = "This seller has products associated";
    $_SESSION['message_type'] = 'danger';
    header('location: ../sellers.php');

  } else {
    $_SESSION['message'] = "Seller deleted successfully";
    $_SESSION['message_type'] = 'success';

    $query = "DELETE FROM seller WHERE id = $id";
    header('location: ../sellers.php');
  }
  
    $conn->query($query);

}

?>