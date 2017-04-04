<?php

?>
<script>
    $(document).ready(function () {
        // ajax setup
        $.ajaxSetup({
            url: 'jq-ajax/ajaxvote.php',
            type: 'POST',
            async: 'true',
            cache: 'false'
        });

        // any voting button (up/down) clicked event
        $('.vote').click(function () {
            var self = $(this); // cache $this
            var action = self.data('action'); // grab action data up/down
            var parent = self.parent().parent(); // grab grand parent .item
            var postID = parent.data('postID'); // grab post id from data-postid
            var score = parent.data('score'); // grab score form data-score

            // only works where is no disabled class
            if (!parent.hasClass('.disabled')) {
                // vote up action
                if (action == 'up') {
                    // increase vote score and color to orange
                    parent.find('.vote-score').html(++score).css({'color': 'orange'});
                    // change vote up button color to orange
                    self.css({'color': 'orange'});
                    // send ajax request with post id & action
                    $.ajax({data: {'postID': postID, 'action': 'up'}});
                }
                // voting down action
                else if (action == 'down') {
                    // decrease vote score and color to red
                    parent.find('.vote-score').html(--score).css({'color': 'red'});
                    // change vote up button color to red
                    self.css({'color': 'red'});
                    // send ajax request
                    $.ajax({data: {'postID': postID, 'action': 'down'}});
                }
                ;

                // add disabled class with .item
                parent.addClass('.disabled');
            }
            ;
        });
    });
</script>

<?php


include 'connection.php';

if ($error != null) {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
} else {

    $sql = "Select * FROM post WHERE postID = ?";

    $stmt = mysqli_prepare($connection, $sql);
    $stmt->bind_param("s", $pId);
    $stmt->execute();

    $results = $stmt->get_result();

    while ($row = mysqli_fetch_assoc($results)) {

        ?>

        <div id="votePost" data-postid="<?php echo $row['postID'] ?>" data-score="<?php echo $row['vote'] ?>">
            <div class="vote-container" id="voteContatiner">
                <div class="vote" data-action="up" title="upVote">
                    <i class="vote-up">UP</i>
                </div>
                <div class="vote-score"><?php echo $row['vote'] ?></div>
                <div class="vote" data-action="down" title="downVote">
                    <i class="vote-down">DOWN</i>
                </div>
            </div>

            <?php

            $pId = $row['postID'];

            ?>

            <div class="post-container" id="postContainer">
                <?php
                echo "<h4 id=postTitle><a href=comment.php?pId=$pId>" . $row['title'] . "</a></h4>";
                ?>
                <h5>post #<?php echo $row['postID'] ?></h5>
                <h6>posted by: <?php echo $row['username'] ?></h6>
                <p><?php echo $row['content'] ?></p>

            </div>

        </div>


        <?php

        if (isset($_SESSION['login_user']) && !isset($_SESSION['priv'])) {

            ?>

            <div id="commentContainer">
                <form method="post" action="php/addComment.php" id="post">
                    <input type="hidden" name="pId" value='<?php echo "$pId"; ?>'>
                    <textarea rows="4" cols="50" id="comment" form="post" placeholder="leave a comment"
                              name="postContent"></textarea>
                    <input type="submit" value="comment" class="btn" id="commentbtn">

                </form>
            </div>


        <?php } else if (isset($_SESSION['priv'])) {

            ?>

            <div id="commentContainer">
                <form method="post" action="php/addComment.php" id="post">
                    <textarea rows="4" cols="50" id="comment" form="post" disabled="disabled"
                              placeholder="your post privileges have been revoked"
                              name="postContent"></textarea>
                    <input type="submit" value="comment" disabled="disabled" class="btn" id="commentbtn">
                </form>
            </div>

            <?php
        } else {

            ?>

            <div id="commentContainer">
                <form method="post" action="php/addComment.php" id="post">
                    <textarea rows="4" cols="50" id="comment" form="post" disabled="disabled"
                              placeholder="please login to leave a comment"
                              name="postContent"></textarea>
                    <input type="submit" value="comment" disabled="disabled" class="btn" id="commentbtn">
                </form>
            </div>

            <?php
        }
    }


    $sqlCom = "SELECT * FROM comment WHERE postID = ?";

    $stmtCom = mysqli_prepare($connection, $sqlCom);
    $stmtCom->bind_param("s", $pId);
    $stmtCom->execute();

    $resultsCom = $stmtCom->get_result();

    while ($rowCom = mysqli_fetch_assoc($resultsCom)) {

        ?>

        <div id="showCommentContainer">

            <h5>comment #<?php echo $rowCom['commentID'] ?></h5>
            <h6>posted by: <?php echo $rowCom['username'] ?></h6>
            <p><?php echo $rowCom['comment'] ?></p>

        </div>

        <?php


    }
}


?>

