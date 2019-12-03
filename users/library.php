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
    /* Include <head></head> */
    require_once('../includes/menu_logged.php');
    ?>
    <div class="container" style="margin-top: 100px;">
        <div class="row top-buffer">
            <h3>Library</h3>
            <div class="col-xs-8 col-xs-offset-2">
                <div>Welcome, <?php echo $_SESSION['user']['firstname'];  ?>
                    <?php echo $_SESSION['user']['id']; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 30px;">
        <div class="row" style="display: grid; grid-template-columns: 1fr">
            <ul>
                <li style="display: inline-block; padding: 10px;"><a id="likedSongs" userId=<?php echo '"' . $_SESSION['user']['id'] . '"'; ?> href="#">Liked songs</a></li>
                <li style="display: inline-block; padding: 10px;"><a id="boughtSongs" userId=<?php echo '"' . $_SESSION['user']['id'] . '"'; ?> href="#">Bought songs</a></li>
                <li style="display: inline-block; padding: 10px;"><a id="mySongs" userId=<?php echo '"' . $_SESSION['user']['id'] . '"'; ?> href="#">My songs</a></li>
            </ul>
            <div id="songList"></div>
        </div>
    </div>
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

        $("#boughtSongs").on('click', function() {

            let userId = $(this).attr('userId');
            console.log(userId);
            $.ajax({
                    method: "GET",
                    url: "../includes/getBoughtSongs.php",
                })
                .done(function(data) {
                    // console.log(data);

                    var result = $.parseJSON(data);
                    let array = result.items;
                    let total = 0;
                    $('#songList').html('');

                    array.forEach(element => {
                        console.log(element);
                        createSongElement(element.song_title, element.artist_name, element.price, element.path_id)
                    })
                }).fail(function(xhr, status, error) {
                    alert(xhr.responseText);
                })
        });

        //liked songs will return the sattic songs that have the class liked.
        //bought songs are the songs where I am the buyer in the invoices.
        //my songs are the songs that are created by me

        //we want to populate the div with songs based on the return from the api ajax call
    </script>
</body>

</html>