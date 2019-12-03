<!DOCTYPE html>
<html lang="en">

<?php
/* Include <head></head> */
require_once('../includes/header.php');
require_once('../classes/Song_class.php');

require_once('../classes/Attribute_class.php');
session_start();

?>

<body>
    <?php
    /* Include <head></head> */
    require_once('../includes/menu_logged.php');
    ?>
<<<<<<< HEAD
    <div class="container" style="margin-top:100px;">
=======
    <div class="hero-container" id="container-releases">
        <div class="hero-img-container">
            <img class="hero-img" src="../img/mixer3_bw_gradient.jpg">
        </div>
>>>>>>> 62fa66abe4f4ee43e3fc2ae3fe0495834f5d039f
        <div class="row top-buffer">
            <div class="titles">
                <h1>Latest releases</h1>
            </div>
            <div class="col-xs-8 col-xs-offset-2">
                <div>Welcome, <?php echo $_SESSION['user']['firstname'];  ?>
                    <?php echo $_SESSION['user']['lastname']; ?>
                    <?php echo $_SESSION['user']['id']; ?>

<<<<<<< HEAD

=======
>>>>>>> 62fa66abe4f4ee43e3fc2ae3fe0495834f5d039f
                    <a href="cart.php">CART: <span id="cartItems"><?php if (empty($_SESSION['cartItems'])) {
                                                                        echo '0';
                                                                    } else {
                                                                        echo count($_SESSION['cartItems']);
<<<<<<< HEAD
                                                                    } ?>
                        </span></p>
=======
                                                                    } ?></span></p>
>>>>>>> 62fa66abe4f4ee43e3fc2ae3fe0495834f5d039f
                </div>

                <div>
                    <a id="upload-btn" href="upload_song.php">Upload new song</a>
                    <?php

                    $songs = Song::all();
                    foreach ($songs as $song) {
                        $id = $song['id'];
                        $attributes = Attribute::getAttributesForId($id);
                        echo '
    <div class="container-song">
      <div class="content-song">
        <h3>' . $song['song_title'] . '</h3>
        <div class="tags-container">
          <p>' . $song['artist_name'] . ' - ' . $song['song_title'] . '</p>
          <div class="tags">
            ' . Attribute::getCurrentAttributesAsList($attributes) . '
          </div>
        </div>

        <audio controls="controls">
          <source
            src="../uploads/' . $song['path_id'] . '.mp3"
            type="audio/mpeg"
          />
          Your browser does not support the audio element.
        </audio>
        
          <a href="#"><img class="like" src="../img/like.svg"/></a>
          <a class="cartButton" id="upload-btn" value="' . $song['id'] . '" href="#"
            >Add to cart</a
          >
          <p>Price: ' . $song['price'] . ' EUR</p>

          <details>
            <summary>Add comment</summary>
            <div class="commentDiv" songId="' . $song['id'] . '">
              <p>
                <span class="user-comment"></span>
                <span class="comment-body">Comment</span>
              </p>
            </div>
            <div class="addCommentDiv">
            <input
              type="text"
              placeholder="Add comment here"
              id="commentId"
              songId="' . $song['id'] . '"
                />
                <button class="addComment">Add</button>
            </div>
             
          </details>
        
      </div>
    </div>
                    ';
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src="../scripts/audio.js"></script> -->
    <script>
        $(function() {
            $(".cartButton").on('click', function() {

                let songId = $(this).attr('value');
                $.ajax({
                        method: "GET",
                        url: "../includes/addToCart.php?songId=" + songId + "",
                    })
                    .done(function(data) {
                        var result = $.parseJSON(data);
                        console.log(result);
                        // $.('#cartItems').html(result.itemNumber);
                        document.getElementById('cartItems').innerHTML = result.itemNumber;



                        //see what to do with the cart
                    })
            })
        })

        $(function() {
            $('.addComment').on('click', function() {
                let songId = $(this).siblings('#commentId').attr('songId');
                let commentBody = $(this).siblings('#commentId').val();
                console.log(songId);

                $.ajax({
                        method: "GET",
                        url: "../includes/addComment.php?songId=" + songId + "&&commentBody=" + commentBody + "",
                    })
                    .done(function(data) {
                        var result = $.parseJSON(data)
                    })
            })
        })

        function getUserNameById(user_id) {

            var s = $.ajax({
                async: false,
                method: "GET",
                url: "../includes/getUserNameByIdAPI.php?user_id=" + user_id
            })
            var result = $.parseJSON(s.responseText);
            return result.name;
        }


        function readComments() {
            let userComment = $('.user-comment');
            $.ajax({
                    url: "../includes/getAllComents.php"
                })
                .done(function(data) {
                    var result = $.parseJSON(data);
                    let comments = result.comments;
                    let commentDiv = document.querySelectorAll('.commentDiv');
                    // console.log(comments);

                    commentDiv.forEach(element => {
                        let thisDiv = element;
                        let songId = thisDiv.getAttribute('songId');
                        thisDiv.innerHTML = '';

                        // console.log(thisDiv);
                        comments.forEach(comment => {

                            if (songId == comment.song_id) {
                                // console.log(comment.comment_body);
                                var p = document.createElement('p');
                                thisDiv.appendChild(p);

                                var name = document.createElement('span');
                                let nameDb = getUserNameById(comment.user_id)
                                name.innerHTML = nameDb;
                                console.log(nameDb);
                                p.append(name);

                                var commentBody = document.createElement('span');
                                commentBody.innerHTML = comment.comment_body;
                                p.append(commentBody);
                            }
                        })

                    })

                    // console.log('====================================');
                    // console.log(result);
                    // console.log('====================================');
                })
            //get all comments
            //place the comments where they belong
        }
        readComments();
        setInterval(readComments, 1000);


        // PLAYER
        // var aud = $('audio')[0];

        // $('.play-pause').on('click', function() {
        //     if (aud.paused) {
        //         aud.play();
        //         $('.play-pause').removeClass('icon-play');
        //         $('.play-pause').addClass('icon-stop')
        //     } else {
        //         aud.pause();
        //         $('.play-pause').removeClass('icon-stop');
        //         $('.play-pause').addClass('icon-play')
        //     }
        // })
    </script>
</body>

</html>