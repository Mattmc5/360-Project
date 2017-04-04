<?php

# start new session
session_start();

include '../php/connection.php';

if ($error != null) {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
} else {

    if ($_SERVER['HTTP_X_REQUESTED_WITH']) {
        if (isset($_POST['postID']) AND isset($_POST['action'])) {
            $postID = ($_POST['postID']);
            # check if already voted, if found voted then return
            if (isset($_SESSION['vote'][$postID])) return;
            # connect mysql db


            # query into db table to know current voting score

            $sql = "SELECT vote FROM post WHERE postID ='$postID' LIMIT 1";
            $stmt = mysqli_prepare($connection, $sql);
            $stmt->execute();

         //   $query = mysqli_query("
         //    SELECT vote
          //    from post
         //     WHERE id = '$postId'
         //     LIMIT 1" );



            // $query = mysql_query("SELECT vote from voting WHERE id = '{$postId}' LIMIT 1" );

            # increase or dicrease voting score
            if ($data = mysqli_fetch_assoc($sql)) {
                if ($_POST['action'] === 'up') {
                    $vote = ++$data['vote'];
                } else {
                    $vote = --$data['vote'];
                }
                # update new voting score

                $sqlUP = "UPDATE post SET vote = '$vote' WHERE postID = '$postID'";
                $stmtUP = mysqli_prepare($connection, $sqlUP);
                $stmtUP->execute();

               // mysqli_query("UPDATE post SET vote = '$vote' WHERE postID = '$postId'");

                # set session with post id as true
                $_SESSION['vote'][$postID] = true;
                # close db connection

            }
        }
    }
    mysqli_close($connection);
}
