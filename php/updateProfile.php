<html>
<?php

session_start();


include 'connection.php';

$name = $_POST['name'];
$username = $_SESSION['login_user'];
$email = $_POST['email'];

echo $username;

if ($error != null) {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
} else {

    $sql = "SELECT * FROM user WHERE username LIKE '$username'";
    $results = mysqli_query($connection, $sql);

    $row = mysqli_fetch_assoc($results);

        $sql = "UPDATE user SET name = ?, email = ? WHERE username = ?";

        $stmt = mysqli_prepare($connection, $sql);
        $stmt->bind_param("sss", $name, $email, $username);
        $stmt->execute();

        $sqlID = "SELECT userID FROM user WHERE username LIKE '$username'";
        $stmtID = mysqli_prepare($connection, $sqlID);
        $stmtID->execute();

        $resultsID = $stmtID->get_result();
        $rowID = mysqli_fetch_assoc($resultsID);

        echo $rowID['userID'];

        $userID = $rowID['userID'];


        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if($traget_file==null) {


            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 100000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file


            } else {


                $imagedata = file_get_contents($_FILES['fileToUpload']['tmp_name']);
                //store the contents of the files in memory in preparation for upload

                $sqlIMG = "UPDATE userimages SET contentType = ?, image = ?  WHERE userID = ?";
                // create a new statement to insert the image into the table. Recall
                // that the ? is a placeholder to variable data.

                $stmtIMG = mysqli_stmt_init($connection); //init prepared statement object

                mysqli_stmt_prepare($stmtIMG, $sqlIMG); // register the query

                $null = NULL;
                mysqli_stmt_bind_param($stmtIMG, "sbi", $null, $imageFileType, $userID);
                // bind the variable data into the prepared statement. You could replace
                // $null with $data here and it also works. You can review the details
                // of this function on php.net. The second argument defines the type of
                // data being bound followed by the variable list. In the case of the
                // blob, you cannot bind it directly so NULL is used as a placeholder.
                // Notice that the parametner $imageFileType (which you created previously)
                // is also stored in the table. This is important as the file type is
                // needed when the file is retrieved from the database.

                mysqli_stmt_send_long_data($stmtIMG, 1, $imagedata);
                // This sends the binary data to the third variable location in the
                // prepared statement (starting from 0).
                $resultIMG = mysqli_stmt_execute($stmtIMG) or die(mysqli_stmt_error($stmtIMG));
                // run the statement

                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            header("Location: ../profile.php");
        } else {
            header("Location: ../profile.php");


            mysqli_close($connection);
        }

}
?>

</html>
