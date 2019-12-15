<!DOCTYPE html>
<html lang="en">

<?php

require_once('../includes/header.php');

session_start();
?>


<body>
    <?php
    require_once('../includes/menu_logged.php');
    ?>

    <div class="parent-container" id="container-releases">
        <div class="imgParent"></div>
        <div class="box-wide" id="containerLatest">
            <div class="titles" id="searchAndTitle">
                <h1>Latest releases.</h1>
                <?php
                require_once('../includes/searchBar.php')
                ?>
            </div>
            <div <?= $_SESSION['user']['user_type'] == 1 ? 'style="display:none;"' : 'style="display:inline-block;"' ?> id="buttonLatest">
                <a href="upload_song.php"><button>Upload new song</button></a>
            </div>
            <div id="songs-container">
            </div>
            <div>
                <button id="loadMore" style="text-align: center;" value="0">Load more</button>
            </div>
        </div>

    </div>
    </div>
    <?php

    require_once('../includes/footer.php');
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../scripts/audio.js"></script>
    <script src="../scripts/search.js"></script>
    <script>
        $("#loadMore").on("click", function() {
            var row = Number($('#loadMore').val());

            $.ajax({
                method: "POST",
                data: {
                    row: row
                },
                url: "../includes/loadMoreSongs.php"
            }).done(function(data) {
                $('#loadMore').val(row + 5);
                var result = $.parseJSON(data);

                let songs = result.items;

                songs.forEach(song => {
                    createAudioElement(song.song_title, song.artist_name, song.path_id, song.id, song.price, getAttributesForSongId(song.id))
                });

                if ($('#loadMore').val() > document.getElementById('songs-container').children.length) {
                    document.getElementById('loadMore').style.display = 'none';
                }

            });
        });

        $("#loadMore").trigger("click");

        $(function() {
            $("#songs-container").on('click', ".cartButton", function() {
                let buttonElement = $(this);
                let songId = $(this).attr('value');
                $.ajax({
                        method: "GET",
                        url: "../includes/addToCart.php?songId=" + songId
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
                console.log(data);
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

        function getAttributesForSongId(id) {

            var s = $.ajax({
                async: false,
                method: "GET",
                url: "../includes/getAttributesForSong.php?id=" + id
            })
            var result = $.parseJSON(s.responseText);
            return result.attributesHTML;
        }

        function addValueToCartButtons() {
            cartButtons = document.querySelectorAll('.cartButton');
            cartButtons.forEach(item => {
                checkIfElementIsInCart(item.getAttribute('value'), item);
            })
        }

        addValueToCartButtons()


        $(function() {
            $('#songs-container').on('click', ".addComment", function() {
                let currentElement = $(this).siblings();
                console.log(currentElement);
                let songId = $(this).siblings('#commentId').attr('songId');
                let commentBody = $(this).siblings('#commentId').val();


                $.ajax({
                        method: "GET",
                        url: "../includes/addComment.php?songId=" + songId + "&&commentBody=" + commentBody + "",
                    })
                    .done(function(data) {
                        var result = $.parseJSON(data);
                        readComments();
                    })
                currentElement.val('');
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

                                var dash = " - ";
                                p.append(dash)

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
    </script>
</body>

</html>