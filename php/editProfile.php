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

    while ($row = mysqli_fetch_assoc($resultsID)) {

        $name = $row['name'];
        $userEmail = $row['email'];
        $userID = $row['userID'];
        $q = "SELECT image FROM userImages WHERE userID LIKE '$userID' ";
        $qstmt = mysqli_prepare($connection, $q);
        $qstmt->execute();
        $qr = $qstmt->get_result();

        while ($row = mysqli_fetch_assoc($qr)) {
            $img = $row['image']; ?>

            <div id="pImg" class="crop">
                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($img) . '"   />'; ?>
            </div>

            <?php
        }

        ?>
        <div id="pInfo">
            <form method="post" action="php/updateProfile.php" enctype="multipart/form-data" id="profileForm">
                <label>edit profile <?php echo $username; ?> </label>

                <?php

                echo "<p>name: " . $name . "</p>";
                echo "<input type='text' name='name' value=" . $name . " id='profileInput'>";
                echo "<p>e-mail: " . $userEmail . "</p>";
                echo "<input type='text' name='email' value=" . $userEmail . " placeholder='change email' id='profileInput'>";
                echo "<p>choose a new profile picture: <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\" class='profilePic'></p>";
                echo "<input type='submit' value='finish' id='submitEdit'>";

                ?>
            </form>
        </div>

        <?php


    }


}

?>