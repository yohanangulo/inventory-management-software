<?php
if (!isset($_SESSION['username']) || $_SESSION['role_id'] != 1) {
  header('location: signin.php');
  exit;
}
?>