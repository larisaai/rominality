<!DOCTYPE html>
<html lang="en">

<?php
/* Include <head></head> */
require_once('../includes/header.php');
require_once('../classes/Song_class.php');

require_once('../classes/Attribute_class.php');
session_start();
echo $_SESSION['user']['user_type'];
?>


<body>
    <?php
    require_once('../includes/menu_logged.php');
    ?>

    <div class="hero-container" id="container-releases">
        <div class="hero-img-container">
            <img class="hero-img" src="../img/mixer3_bw_gradient.jpg">
        </div>
        <div>
            <div class="titles">
                <h1>Latest releases</h1>
            </div>
            <div>
                <div>
                    <a style="<?= $_SESSION['user']['user_type'] == 1 ? 'display: none;' : 'display: inline-block;' ?>" id="upload-btn" href="upload_song.php">Upload new song</a>
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
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src="../scripts/audio.js"></script> -->
    <script>
        $(function() {
            $(".cartButton").on('click', function() {
                let buttonElement = $(this);
                let songId = $(this).attr('value');
                $.ajax({
                        method: "GET",
                        url: "../includes/addToCart.php?songId=" + songId + "",
                    })
                    .done(function(data) {
                        var result = $.parseJSON(data);
                        if (result.status == 1) {
                            document.getElementById('cartItems').innerHTML = result.itemNumber;

                            buttonElement.addClass("addedToCart");
                            buttonElement.html('Added to cart');
                        } else {
                            console.log(result);
                        }
                    })
            })
        })

        function checkIfElementIsInCart(id, element) {
            $.ajax({
                url: '../includes/checkIfElementIsInCart.php?song_id=' + id
            }).done(function(data) {
                var result = $.parseJSON(data);
                if (result.status == 1) {
                    element.classList.remove('notAddedToCart')
                    element.classList.add('addedToCart');
                    element.innerHTML = 'Added to cart';
                } else {
                    element.classList.remove('addedToCart');
                    element.classList.add('notAddedToCart');
                    element.innerHTML = 'Add to cart';
                }
            })
        }

        cartButtons = document.querySelectorAll('.cartButton');
        cartButtons.forEach(item => {
            checkIfElementIsInCart(item.getAttribute('value'), item);
        })


        $(function() {
            $('.addComment').on('click', function() {
                let songId = $(this).siblings('#commentId').attr('songId');
                let commentBody = $(this).siblings('#commentId').val();

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

                    commentDiv.forEach(element => {
                        let thisDiv = element;
                        let songId = thisDiv.getAttribute('songId');
                        thisDiv.innerHTML = '';

                        comments.forEach(comment => {

                            if (songId == comment.song_id) {
                                var p = document.createElement('p');
                                thisDiv.appendChild(p);

                                var name = document.createElement('span');
                                let nameDb = getUserNameById(comment.user_id)
                                name.innerHTML = nameDb;
                                p.append(name);

                                var commentBody = document.createElement('span');
                                commentBody.innerHTML = comment.comment_body;
                                p.append(commentBody);
                            }
                        })

                    })
                })
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