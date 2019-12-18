<!DOCTYPE html>
<html lang="en">
<?php
$active = 'libraryPage';
/* Include <head></head> */
require_once('../includes/header.php');
require_once('../classes/Attribute_class.php');
session_start();
?>

<body>
    <?php

    require_once('../includes/menu_logged.php');
    ?>
    <div class="parent-container">
        <div class="imgParent"></div>
        <div class="box-wide" id="containerLatest">
            <div class="titles" id="searchAndTitle">
                <h1>Library.</h1>
                <div style="display: none;">
                    <?php
                    require_once('../includes/searchBar.php')
                    ?>
                </div>

            </div>


            <div class="container">
                <div class="row" style="display: grid; grid-template-columns: 1fr">
                    <ul>
                        <li><a id="likedSongs" userId=<?php echo '"' . $_SESSION['user']['id'] . '"'; ?> href="#">Liked songs</a></li>
                        <li><a id="boughtSongs" userId=<?php echo '"' . $_SESSION['user']['id'] . '"'; ?> href="#">Bought songs</a></li>
                        <li style=" <?= $_SESSION['user']['user_type'] == 1 ? 'display:none;' : 'display:inline-block;' ?> padding: 10px;"><a id="mySongs" userId=<?php echo '"' . $_SESSION['user']['id'] . '"'; ?> href="#">My songs</a></li>
                    </ul>
                    <div id="songs-container"></div>
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
        $("#boughtSongs").on('click', function() {
            let userId = $(this).attr('userId');

            $('#likedSongs').removeClass('menu-active');
            $('#mySongs').removeClass('menu-active');
            $('#boughtSongs').addClass('menu-active');
            let elements = $(document).find('.like');


            $.ajax({
                    method: "GET",
                    url: "../includes/getBoughtSongs.php",
                })
                .done(function(data) {
                    var result = $.parseJSON(data);
                    let array = result.items;
                    $('#songs-container').html('');
                    if (array.length > 0) {
                        array.forEach(element => {
                            createAudioElement(element.song_title, element.artist_name, element.path_id, element.id, element.price, getAttributesForSongId(element.id), element[0].profile_picture, "../img/like.svg", bought = 1);
                        })
                    } else {
                        $('#songs_container').html('');
                        let errorMessage = document.createElement('h2');
                        errorMessage.innerHTML = 'Sorry there are no items here';

                        document.getElementById('songs-container').appendChild(errorMessage);
                    }

                }).fail(function(xhr, status, error) {
                    alert(xhr.responseText);
                })
        });



        $("#mySongs").on('click', function() {
            let userId = $(this).attr('userId');

            $('#likedSongs').removeClass('menu-active');
            $('#mySongs').addClass('menu-active');
            $('#boughtSongs').removeClass('menu-active');

            $.ajax({
                    method: "GET",
                    url: "../includes/getMySongs.php",
                })
                .done(function(data) {
                    var result = $.parseJSON(data);
                    let array = result.items;
                    $('#songs-container').html('');
                    if (array.length > 0) {
                        array.forEach(element => {
                            createAudioElement(element.song_title, element.artist_name, element.path_id, element.id, element.price, getAttributesForSongId(element.id), element[0].profile_picture, "../img/like.svg", bought = 1);
                        })
                    } else {
                        $('#songs-container').html('');
                        let errorMessage = document.createElement('h2');
                        errorMessage.innerHTML = 'Sorry there are no items here';

                        document.getElementById('songs-container').appendChild(errorMessage);
                    }

                }).fail(function(xhr, status, error) {
                    alert(xhr.responseText);
                })
        });


        $('#likedSongs').on('click', function() {

            $('#likedSongs').addClass('menu-active');
            $('#mySongs').removeClass('menu-active');
            $('#boughtSongs').removeClass('menu-active');

            $.ajax({
                    method: "GET",
                    url: "../includes/getRandomSongs.php",
                })
                .done(function(data) {

                    var result = $.parseJSON(data);
                    let array = result.items;
                    $('#songs-container').html('');
                    if (array.length > 0) {
                        array.forEach(element => {
                            createAudioElement(element.song_title, element.artist_name, element.path_id, element.id, element.price, getAttributesForSongId(element.id), element[0].profile_picture, "../img/red_heart.svg");
                        })
                    } else {
                        $('#songs-container').html('');
                        let errorMessage = document.createElement('h2');
                        errorMessage.innerHTML = 'Sorry there are no items here';

                        document.getElementById('songs-container').appendChild(errorMessage);
                    }

                }).fail(function(xhr, status, error) {
                    alert(xhr.responseText);
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

        $("#likedSongs").trigger("click");


        setTimeout(addValueToCartButtons, 100);
    </script>
</body>

</html>