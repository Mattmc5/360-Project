<html>
<?php

if (isset($_SESSION['login_user'])) {
    $username = $_SESSION['login_user'];
}

include 'connection.php';

if ($error != null) {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
} else {

    $sql = "Select * FROM post WHERE username LIKE '$username'";

    $stmt = mysqli_prepare($connection, $sql);
    $stmt->execute();

    $results = $stmt->get_result();

    while ($row = mysqli_fetch_assoc($results)) {


        echo "<br>" .$row['postID']. "<br>";
        echo $row['username']. "<br>";
        echo $row['content']. "<br>";
        echo $row['title']. "<br>";

    }
}

?>

</html>
