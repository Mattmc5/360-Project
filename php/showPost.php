<?php

$sql = "Select * FROM post WHERE username LIKE '$username'";

$stmt = mysqli_prepare($connection, $sql);
$stmt->execute();

$results = $stmt->get_result();

while($row = mysqli_fetch_assoc($results)) {


    echo $row['postID'] . "<br>";
    echo $row['vote'] . "<br>";
    echo $row['username'] . "<br>";
    echo $row['content'] . "<br>";
    echo $row['title'] . "<br>";

}