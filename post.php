<?php

session_start();

if (isset($_SESSION['login_user'])) {
    $_SESSION['login_user'];

}  else {
    session_destroy();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Discussion Board</title>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet">
    <script type="text/javascript" src="/script.js"></script>
</head>

<body>
<header id="masthead">
    <figure>a picture! a masthead! a logo of some sort!</figure>
</header>

<?php

if (isset($_SESSION['login_user'])) {

?>


<div class="container">
    <div id="leftContent">
        <h4><a href="index.php">my discussion board</a></h4>
        <form method="post" action="search.php" id="searchForm">
            <input type="text" placeholder="search" id="search" class="textfield" name="keyword"><input type="submit" value=""
                                                                                                        id="searchbtn">
        </form>

        <div id="stuff">

            <?php

            include 'php/pDetails.php';

            ?>

            <p><a href="php/logout.php">logout</a></p>

        </div>


        <?php }

        else {

        ?>

        <div class="container">
            <div id="leftContent">
                <h4><a href="index.php">my discussion board</a></h4>
                <form method="post" action="search.php" id="searchForm" >
                    <input type="text" placeholder="search" id="search" class="textfield" name="userID"><input type="submit" value=""
                                                                                                               id="searchbtn">
                </form>
                <form method="post" action="php/loginprocess.php" id="loginForm">
                    <input type="text" placeholder="username" name="username">
                    <input type="password" placeholder="password" name="password">
                    <input type="submit" value="login" class="btn">
                    <p><a href="signup.php">login or sign up?</a></p>
                </form>
                <div id="stuff">

                </div>

                <?php

                }
                ?>


            </div>

            <div id="navHeader">
                <nav>
                    <ul>
                        <li><a href="index.php">home </a>/</li>
                        <li><a href="#">new </a>/</li>
                        <li><a href="#">top </a>/</li>
                        <li><a href="post.php">post</a></li>
                    </ul>
                </nav>
            </div>


            <?php

            if (isset($_SESSION['login_user'])) {

            ?>

            <article id="bodyContent">
                <form method="post" action="php/newPost.php" id="post">
                    <h4 id="postH4">create new post</h4>
                    <input type="text" placeholder="title" id="postTitle" name="post"><br>
                    <textarea rows="4" cols="50" id="newPost" form="post" placeholder="create your post ... " name="postContent"></textarea>
                    <input type="submit" value="post" class="btn">
                </form>
            </article>

            <?php }

            else {

                ?>

                <article id="bodyContent">
                    <form method="post" action="php/newPost.php" id="post">
                        <h4 id="postH4">create new post</h4>
                        <input type="text" disabled="disabled" placeholder="title" id="postTitle" name="post"><br>
                        <textarea disabled="disabled" rows="4" cols="50" id="newPost" form="post" placeholder="" name="postContent">you must be logged in to create a new post.</textarea>
                        <input type="submit" value="post" class="btn" disabled="disabled">
                    </form>
                </article>

                <?php

            }

            ?>

            <footer>
                copyright &copy; matt mccormack 2017
            </footer>
        </div>

</body>
</html>

