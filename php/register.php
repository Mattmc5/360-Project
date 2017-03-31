
<?php

$host = "localhost";
$database = "360project";
$user = "root";
$password = "";

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$passwordForm = md5($_POST['password']);


$connection = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
else
{

  $sql = "SELECT * FROM user WHERE username LIKE '$username' or email LIKE '$email'";
  $results = mysqli_query($connection, $sql);

  if($row = mysqli_fetch_assoc($results) == 0) {

    $sql = "INSERT INTO user (username, name, email,
                password) VALUES (?,?,?,?)";

    $stmt = mysqli_prepare($connection, $sql);
    $stmt->bind_param("ssss", $username, $name,  $email, $passwordForm);
    $stmt->execute();


  }
else {

  echo 'The User Name or E-mail already exists!';
  mysqli_close($connection);

  }
}
?>