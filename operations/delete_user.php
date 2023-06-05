<?php
session_start();
require "../includes/is_logged.php";


if(isset($_GET['id']) && $_GET['id'] != 1) {
  require_once "../db/db.php";
  $id = clean_input($conn, $_GET['id']);
  
  $query = "DELETE FROM user WHERE id = $id";
  $conn->query($query);
  
  $_SESSION['message'] = "User deleted successfully";
  $_SESSION['message_type'] = 'success';

  $conn->close();

  header('location: ../users.php');
} 

else {
  $_SESSION['message'] = "An error has ocurred";
  $_SESSION['message_type'] = 'danger';
  header('location: ../users.php');
}

?>