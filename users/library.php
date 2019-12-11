<!DOCTYPE html>
<html lang="en">
<?php
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
                <?php
                require_once('../includes/searchBar.php')
                ?>
            </div>


            <div class="container">
                <div class="row" style="display: grid; grid-template-columns: 1fr">
                    <ul>
                        <li style="display: inline-block; padding: 10px;"><a id="likedSongs" userId=<?php echo '"' . $_SESSION['user']['id'] . '"'; ?> href="#">Liked songs</a></li>
                        <li style="display: inline-block; padding: 10px;"><a id="boughtSongs" userId=<?php echo '"' . $_SESSION['user']['id'] . '"'; ?> href="#">Bought songs</a></li>
                        <li style=" <?= $_SESSION['user']['user_type'] == 0 ? 'display:none;' : 'display:inline-block;' ?> padding: 10px;"><a id="mySongs" userId=<?php echo '"' . $_SESSION['user']['id'] . '"'; ?> href="#">My songs</a></li>
                    </ul>
                    <div id="songList"></div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once('../includes/footer.php');
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>

    <script>
        function createSongElement(title, artist, price, path) {
            var div = document.createElement('div');
            div.setAttribute('style', 'background-color: lightgrey; margin: 10px; padding: 4px;')
            document.getElementById('songList').appendChild(div);

            var h3 = document.createElement('h3');
            h3.innerHTML = title;
            div.appendChild(h3);

            var p = document.createElement('p');
            p.innerHTML = artist;
            div.appendChild(p);

            var a = document.createElement('a');
            a.setAttribute('href', '#');
            a.innerHTML = 'Like';
            div.appendChild(a);

            var audio = document.createElement('audio');
            audio.setAttribute('controls', 'controls');
            div.appendChild(audio);

            var Elemprice = document.createElement('p');
            price.innerHTML = 'Price: ' + price + 'EUR';
            div.appendChild(Elemprice);

            var source = document.createElement('source');
            source.setAttribute('src', '../uploads/' + path + '.mp3');
            source.setAttribute('type', 'audio/mpeg');
            audio.appendChild(source);
        }

        function createSongElementWithCart(song_id, title, artist, price, path) {
            var div = document.createElement('div');
            div.setAttribute('style', 'background-color: lightgrey; margin: 10px; padding: 4px;')
            document.getElementById('songList').appendChild(div);

            var h3 = document.createElement('h3');
            h3.innerHTML = title;
            div.appendChild(h3);

            var p = document.createElement('p');
            p.innerHTML = artist;
            div.appendChild(p);

            var a = document.createElement('a');
            a.setAttribute('href', '#');
            a.innerHTML = 'Like';
            div.appendChild(a);

            var audio = document.createElement('audio');
            audio.setAttribute('controls', 'controls');
            div.appendChild(audio);

            var Elemprice = document.createElement('p');
            price.innerHTML = 'Price: ' + price + 'EUR';
            div.appendChild(Elemprice);

            var cartButton = document.createElement('a');
            a.setAttribute('class', 'cartButton');
            a.setAttribute('id', 'upload-btn');
            a.setAttribute('value', song_id);
            a.setAttribute('href', '#');
            a.innerHTML = 'Add to cart';
            div.appendChild(cartButton);

            var aLike = document.createElement('a');
            a.setAttribute('href', '#');
            div.appendChild(aLike);

            var img = document.createElement('img');
            img.setAttribute('class', 'like');
            img.setAttribute('src', '../img/like.svg');
            aLike.appendChild(img);

            var source = document.createElement('source');
            source.setAttribute('src', '../uploads/' + path + '.mp3');
            source.setAttribute('type', 'audio/mpeg');
            audio.appendChild(source);
        }

        $(function() {
            $("#songList").on('click', '.cartButton', function() {

                let songId = $(this).attr('value');
                $.ajax({
                        method: "GET",
                        url: "../includes/addToCart.php?songId=" + songId + "",
                    })
                    .done(function(data) {
                        var result = $.parseJSON(data);
                        document.getElementById('cartItems').innerHTML = result.itemNumber;
                    })
            })
        })

        $("#boughtSongs").on('click', function() {
            let userId = $(this).attr('userId');
            $.ajax({
                    method: "GET",
                    url: "../includes/getBoughtSongs.php",
                })
                .done(function(data) {
                    var result = $.parseJSON(data);
                    let array = result.items;
                    $('#songList').html('');
                    if (array.length > 0) {
                        array.forEach(element => {
                            createSongElement(element.song_title, element.artist_name, element.price, element.path_id)
                        })
                    } else {
                        $('#songList').html('');
                        let errorMessage = document.createElement('h2');
                        errorMessage.innerHTML = 'Sorry there are no items here';

                        document.getElementById('songList').appendChild(errorMessage);
                    }

                }).fail(function(xhr, status, error) {
                    alert(xhr.responseText);
                })
        });

        $("#mySongs").on('click', function() {
            let userId = $(this).attr('userId');
            $.ajax({
                    method: "GET",
                    url: "../includes/getMySongs.php",
                })
                .done(function(data) {
                    var result = $.parseJSON(data);
                    let array = result.items;
                    $('#songList').html('');
                    if (array.length > 0) {
                        array.forEach(element => {
                            createSongElement(element.song_title, element.artist_name, element.price, element.path_id)
                        })
                    } else {
                        $('#songList').html('');
                        let errorMessage = document.createElement('h2');
                        errorMessage.innerHTML = 'Sorry there are no items here';

                        document.getElementById('songList').appendChild(errorMessage);
                    }

                }).fail(function(xhr, status, error) {
                    alert(xhr.responseText);
                })
        });


        $('#likedSongs').on('click', function() {
            $.ajax({
                    method: "GET",
                    url: "../includes/getRandomSongs.php",
                })
                .done(function(data) {

                    var result = $.parseJSON(data);
                    let array = result.items;
                    $('#songList').html('');
                    if (array.length > 0) {
                        array.forEach(element => {
                            createSongElementWithCart(element.id, element.song_title, element.artist_name, element.price, element.path_id)
                        })
                    } else {
                        $('#songList').html('');
                        let errorMessage = document.createElement('h2');
                        errorMessage.innerHTML = 'Sorry there are no items here';

                        document.getElementById('songList').appendChild(errorMessage);
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

        function addValueToCartButtons() {
            cartButtons = document.querySelectorAll('.cartButton');
            cartButtons.forEach(item => {
                checkIfElementIsInCart(item.getAttribute('value'), item);
            })
        }
        setTimeout(addValueToCartButtons, 100);
    </script>
</body>

</html>