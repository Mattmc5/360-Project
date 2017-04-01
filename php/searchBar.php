<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 01/04/2017
 * Time: 11:26 AM
 */

if (isset($_SESSION['login_user'])) {
    $username = $_SESSION['login_user'];
}

include 'connection.php';

$userID = $_POST['userID'];

if ($error != null) {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
} else {

    $sqlID = "SELECT userID FROM user WHERE userID LIKE '$userID'";
    $stmtID = mysqli_prepare($connection, $sqlID);
    $stmtID->execute();

    $resultsID = $stmtID->get_result();
    $rowID = mysqli_fetch_assoc($resultsID);


    $sql = "SELECT contentType, image FROM userImages where userID=?";
// build the prepared statement SELECTing on the userID for the user
    $stmt = mysqli_stmt_init($connection);
//init prepared statement object
    mysqli_stmt_prepare($stmt, $sql);
// bind the query to the statement
    mysqli_stmt_bind_param($stmt, "i", $userID);
// bind in the variable data (ie userID)
    $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
// Run the query. run spot run!
    mysqli_stmt_bind_result($stmt, $type, $image); //bind in results
    // Binds the columns in the resultset to variables
    mysqli_stmt_fetch($stmt);
// Fetches the blob and places it in the variable $image for use as well
// as the image type (which is stored in $type)
    mysqli_stmt_close($stmt);
// release the statement


    echo '<img src="data:image/' . $type . ';base64,' . base64_encode($image) . '"/>';


}
?>