<html>
<?php

include 'connection.php';

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$passwordForm = md5($_POST['password']);

if ($error != null) {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
} else {

    $sql = "SELECT * FROM user WHERE username LIKE '$username' or email LIKE '$email'";
    $results = mysqli_query($connection, $sql);

    if ($row = mysqli_fetch_assoc($results) == 0) {

        $sql = "INSERT INTO user (username, name, email,
                password) VALUES (?,?,?,?)";

        $stmt = mysqli_prepare($connection, $sql);
        $stmt->bind_param("ssss", $username, $name, $email, $passwordForm);
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

            $sqlIMG = "INSERT INTO userimages (userID, contentType, image) VALUES(?,?,?)";

            $stmtIMG = mysqli_stmt_init($connection); 

            mysqli_stmt_prepare($stmtIMG, $sqlIMG);

            $null = NULL;
            mysqli_stmt_bind_param($stmtIMG, "isb", $userID, $imageFileType, $null);
            mysqli_stmt_send_long_data($stmtIMG, 2, $imagedata);
            $resultIMG = mysqli_stmt_execute($stmtIMG) or die(mysqli_stmt_error($stmtIMG));

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        header("Location: ../index.php");

    } else {

        echo 'The User Name or E-mail already exists!';
        mysqli_close($connection);

    }
}
?>

</html>
