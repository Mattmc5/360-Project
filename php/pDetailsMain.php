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
            <p>user profile</p>

            <?php

            echo "<p>username: " . $username . "</p>";
            echo "<p>name: " . $name . "</p>";
            echo "<p>e-mail: " . $userEmail . "</p>";
            echo "<p>user id: " . $userID . "</p>";

            echo "<a id='editLink' href='profileEdit.php'>edit profile</a><br>";

            ?>

        </div>

        <?php

    }
}

?>