<?php
session_start();

if (isset($_POST['signup'])) {

  // database
  require "../db/db.php";
  
  // get user information
  $name = clean_input($conn, $_POST['name']);
  $lastname = clean_input($conn, $_POST['lastname']);
  $username = clean_input($conn, $_POST['username']);
  $email = clean_input($conn, $_POST['email']);
  $password = clean_input($conn, $_POST['password']);
  $confirm_password = clean_input($conn, $_POST['passwordConfirm']);

  // validate information
  $errors = []; // start empty array to store error 

  // name
  if (empty($name)) $errors[] = "Enter a name";
  elseif (!preg_match("/^[A-Za-z\s']+$/", $name)) $errors[] = "Don't include special characters in the name";

  // lastname
  if (empty($lastname)) $errors[] = "Enter a last name";
  elseif (!preg_match("/^[A-Za-z\s']+$/", $lastname)) $errors[] = "Don't include special characters in the last name";
  else {
    // check if username already exists 
    $check_user_query = "SELECT username FROM user WHERE BINARY username = ?";
    $stmt = $conn->prepare($check_user_query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    
    $result = $stmt->get_result();

    if ($result->num_rows > 0) $errors[] = "Username <b>'$username'</b> is already taken";
  }

  // username
  if (empty($username)) $errors[] = "Enter a username";
  elseif (!preg_match("/^[A-Za-z0-9_]{4,}$/", $username)) $errors[] = "Don't include special characters in the username";

  // email
  if (empty($email)) $errors[] = "Enter a email";
  elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) $errors[] = "Make sure you are typing a valid email";

  // password
  if (empty($password) || strlen($password) < 4) $errors[] = "Enter a long enough password";
  elseif ($password !== $confirm_password) $errors[] = "Passwords do not match";
  
  // save errors in a session variable
  $_SESSION['errors'] = $errors;

  if (empty($errors)) {

    $query = "INSERT INTO `user` (`name`, `lastname`, `username`, `password`, `email`) VALUES (?, ?, ?, sha1(?), ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssss', $name, $lastname, $username, $password, $email);
    $stmt->execute();

    $_SESSION['message'] = 'User created successfully!';
    $_SESSION['message_type'] = 'success';

    $conn->close();
    $_SESSION['new_user_data'] = array(
      'name' => $name,
      'email' => $email
    );

    header('location: ../signin.php');
    exit;
  }

  $conn->close();
  header('location: ../signup.php');

}
?>