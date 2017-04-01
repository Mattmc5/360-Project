<html>
<?php

session_start();

if (isset($_SESSION['login_user'])) {
    $username = $_SESSION['login_user'];
}

include 'connection.php';

$title = $_POST['post'];
$postContent = $_POST['postContent'];


if ($error != null) {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
} else {


    ///postID	vote	date	username	content	title

        $sql1 = "INSERT INTO post (username, content, title) VALUES (?,?,?)";

        $stmt1 = mysqli_prepare($connection, $sql1);
        $stmt1->bind_param("sss", $username, $postContent, $title);
        $stmt1->execute();

        header("Location: ../index.php");

        mysqli_close($connection);

}
?>

</html>
