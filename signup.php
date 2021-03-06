<!DOCTYPE html>

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

<div class="container">
    <div id="leftContent">
        <h4><a href="index.php">my discussion board</a></h4>
        <form method="post" action="search.php" id="searchForm" >
            <input type="text" placeholder="search" id="search" class="textfield" name="keyword"><input type="submit" value=""
                                                                                                       id="searchbtn">
        </form>
        <form method="post" action="php/loginprocess.php" id="loginForm">
            <input type="text" placeholder="username" name="username">
            <input type="password" placeholder="password" name="password">
            <input type="submit" value="login" class="btn" id="btnL">
            <p><a href="signup.php">login or sign up?</a></p>
        </form>

        <div id="stuff">
        </div>
    </div>

    <div id="navHeader">
        <nav>
            <ul>
                <li><a href="index.php">home /</a></li>
                <li><a href="#">new /</a></li>
                <li><a href="#">top /</a></li>
                <li><a href="post.php">post</a></li>
            </ul>
        </nav>
    </div>

    <article id="bodyContent">

        <div id="regFormLeft">
            <form method="post" action="php/register.php" enctype="multipart/form-data">
                <h4>create new account</h4>
                <input type="text" placeholder="username" class="regForm" name="username">
                <input type="text" placeholder="name" class="regForm" name="name">
                <input type="text" placeholder="e-mail" class="regForm" name="email">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="password" placeholder="password" class="regForm" name="password">
                <input type="password" placeholder="verify password" class="regForm" name="passwordVerify">
                <input type="submit" value="register" class="btn" id="btnL">
            </form>
        </div>


    </article>

    <footer>
        copyright &copy; matt mccormack 2017
    </footer>
</div>

</body>
</html>
