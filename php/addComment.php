<?php

session_start();

if (isset($_SESSION['login_user']) ) {
    $_SESSION['login_user'];
}
if (isset($_SESSION['admin']) ) {
    $_SESSION['admin'];
}
if (isset($_SESSION['priv']) ) {
    $_SESSION['priv'];
}

$username = $_SESSION['login_user'];
$comment = $_POST['postContent'];
$postID = $_POST['pId'];


include 'connection.php';



if ($error != null) {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
} else {


    $sql = "INSERT INTO comment (postID, username, comment) VALUES (?,?,?)";


// INSERT INTO `comment`(`commentID`, `postID`, `username`, `comment`, `date`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])

    $stmt = mysqli_prepare($connection, $sql);
    $stmt->bind_param("iss", $postID, $username, $comment);
    $stmt->execute();

    header("location: ../comment.php?pId=".$postID);


}
?>



