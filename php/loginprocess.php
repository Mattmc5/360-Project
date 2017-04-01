<html>
<?php

session_start(); // Starting Session

include 'connection.php';


$username = $_POST['username'];
$passwordForm = md5($_POST['password']);

if ($error != null) {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
} else {
    $sql = "SELECT username, password FROM user WHERE username LIKE ? AND password LIKE ?;";

    $stmt = mysqli_prepare($connection, $sql);
    $stmt->bind_param("ss", $username, $passwordForm);
    $stmt->execute();

    $results = $stmt->get_result();
    $row = mysqli_fetch_assoc($results);

        if ($row['username'] === $username AND $row['password'] === $passwordForm) {
            echo 'User has a Valid Account!';
            $_SESSION['login_user'] = $username; // Initializing Session
           header("location: ../index.php"); // Redirecting To Other Page

        } else {
            echo 'Username and/or Password are invalid.';
            //header("location: ../index.php");
        }

        mysqli_free_result($results);
        mysqli_close($connection);

   // }

}
?>
</html>
