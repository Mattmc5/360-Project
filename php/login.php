<?php

$host = "localhost";
$database = "360project";
$user = "root";
$password = "";


$username = $_POST['username'];
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
    $sql = "SELECT username, password FROM user WHERE username LIKE ? and password LIKE ?;";

    $stmt = mysqli_prepare($connection, $sql);
    $stmt->bind_param("ss", $username, $passwordForm);
    $stmt->execute();

    $results = $stmt->get_result();

    $row = mysqli_fetch_assoc($results);

    if($row['username'] == $username AND $row['password'] == $passwordForm) {
        echo  'User has a Valid Account!';

    } else {
        echo 'Username and/or Password are invalid.';
    }

    mysqli_free_result($results);
    mysqli_close($connection);

}

header("Location: ../index.html");
?>
