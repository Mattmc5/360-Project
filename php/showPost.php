<?php

?>
<script>
    $(document).ready(function(){
        // ajax setup
        $.ajaxSetup({
            url: 'jq-ajax/ajaxvote.php',
            type: 'POST',
            async: 'true',
            cache: 'false'
        });

        // any voting button (up/down) clicked event
        $('.vote').click(function(){
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
                    parent.find('.vote-score').html(++score).css({'color':'orange'});
                    // change vote up button color to orange
                    self.css({'color':'orange'});
                    // send ajax request with post id & action
                    $.ajax({data: {'postID' : postID, 'action' : 'up'}});
                }
                // voting down action
                else if (action == 'down'){
                    // decrease vote score and color to red
                    parent.find('.vote-score').html(--score).css({'color':'red'});
                    // change vote up button color to red
                    self.css({'color':'red'});
                    // send ajax request
                    $.ajax({data: {'postID' : postID, 'action' : 'down'}});
                };

                // add disabled class with .item
                parent.addClass('.disabled');
            };
        });
    });
</script>
<?php


if (isset($_SESSION['login_user'])) {
    $username = $_SESSION['login_user'];
}

include 'connection.php';

if ($error != null) {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
} else {

    $sql = "Select * FROM post";

    $stmt = mysqli_prepare($connection, $sql);
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

               <div class="post-container" id="postContainer">
                   <h1><?php echo $row['title'] ?></h1>
                   <h2><?php echo $row['postID'] ?></h2>
                   <h2><?php echo $row['username'] ?></h2>
                   <p><?php echo $row['content'] ?></p>
               </div>
           </div>



            <?php
       }


}

?>

