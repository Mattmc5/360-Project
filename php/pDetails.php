<?php


if (isset($_SESSION['login_user'])) {
    $username = $_SESSION['login_user'];
}

include 'connection.php';

if ($error != null) {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
} else {


    $sqlID = "SELECT * FROM user WHERE username LIKE '$username' ";
    $stmtID = mysqli_prepare($connection, $sqlID);
    $stmtID->execute();

    $resultsID = $stmtID->get_result();

    echo "welcome <a href='profile.php' name='link1'>".$_SESSION['login_user']."</a>";

    while($row = mysqli_fetch_assoc($resultsID)) {

        $userID = $row['userID'];


 /*     $q = "SELECT image FROM userImages WHERE userID LIKE '$userID' ";
        $qstmt = mysqli_prepare($connection, $q);
        $qstmt->execute();
        $qr = $qstmt->get_result();


         while ($row = mysqli_fetch_assoc($qr)) {
            $img = $row['image'];
            echo '<img src="data:image/jpeg;base64,' . base64_encode($img) . '" height="200px" width="200px" />' . "<br><br>";
        }
*/


    }

}

?>