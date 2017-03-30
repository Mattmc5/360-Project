<!DOCTYPE html>
<html>

<p>Here are some results:</p>

<?php

$host = "localhost";
$database = "360project";
$user = "root";
$password = "";

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$passwordForm = $_POST['password'];


$connection = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
else
{

  $sql = "SELECT * FROM users WHERE username LIKE '$username' or email LIKE '$email'";
  $results = mysqli_query($connection, $sql);

  if($row = mysqli_fetch_assoc($results) == 0) {

    $sql = "INSERT INTO users (firstname,	lastname,	username,	email,
                password) VALUES (?,?,?,?,?)";

    $stmt = mysqli_prepare($connection, $sql);
    $stmt->bind_param("sssss", $username, $firstname, $lastname, $email, md5($passwordForm));
    $stmt->execute();


  }
else {

  echo 'The User Name or E-mail already exists!';
  echo '<br><a href="lab8-1.html">Return to user entry.</a>';
  mysqli_close($connection);

  }
}
?>
</html>
