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


?>

<!DOCTYPE html>
<html>
<head>
    <title>Discussion Board</title>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet">
    <script type="text/javascript" src="/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

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
            <input type="text" placeholder="search" id="search" class="textfield" name="keyword"><input type="submit"
                                                                                                        value=""
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
                <form method="post" action="search.php" id="searchForm">
                    <input type="text" placeholder="search" id="search" class="textfield" name="keyword"><input
                            type="submit" value=""
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

            <article id="bodyContent">
                <?php

                include 'php/editProfile.php';

                ?>
            </article>

            <footer>
                copyright &copy; matt mccormack 2017
            </footer>
        </div>

</body>
</html>
