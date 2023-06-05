<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'inventory';

// clean input

function clean_input($conn, $data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = mysqli_real_escape_string($conn, $data);

  return $data;
}

$conn = new mysqli($host, $user, $pass, $database);
