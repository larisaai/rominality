<!DOCTYPE html>
<html lang="en">
<?php
$active = 'userPage';
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
        <div class="box-wide">
            <h3>Cart</h3>
        </div>
    </div>

    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr;">
            <div id="listedSongsDiv" style=<?php if (empty($_SESSION['cartItems'])) {
                                                echo '"display: none;"';
                                            } ?>>
                <p>Songs in cart</p>
                <div id="songs-container">

                </div>

            </div>
            <div id="noSongsMessage">
                <?php

                if (empty($_SESSION['cartItems'])) {
                    echo '<h2>Your cart is empty please go back shopping</h2>';
                }

                ?>
            </div>
            <div id="myCartDiv" style=<?php if (empty($_SESSION['cartItems'])) {
                                            echo '"display: none;"';
                                        } ?>>
                <p>My cart with price and listed songs</p>
                <div style="background-color:lightgray; padding: 20px;">
                    <ol id="listedItems" style="width: 100%; padding: 0px;">
                        <?php
                        $totalPrice = 0;
                        foreach ($_SESSION['cartItems'] as $song) {
                            $totalPrice += $song['price'];
                            echo '<li>
                                    <ul style="padding: 0px; width: 100%;">
                                        <li style="display:inline-block; width:50%;">' . $song['song_title'] . '</li>
                                        <li style="display:inline-block; width:30%;">' . $song['price'] . 'EUR</li>
                                        <li style="display:inline-block; width:auto;";><a class="cartRemove" value="' . $song['id'] . '" href="#">Remove</a></li>
                                    </ul>
                                </li>';
                        }
                        ?>
                    </ol>
                    <p style="text-align: right; margin-right: 35%; margin-top: 20px;">Total: <span id="cartTotal"><?php echo $totalPrice . ' EUR'; ?></span></p>

                    <a href="../includes/processPayment.php">Pay now</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../scripts/audio.js"></script>
    <script>
        function createListElement(name, price, id) {

            var li = document.createElement('li');
            document.getElementById('listedItems').appendChild(li);

            var ul = document.createElement('ul');
            ul.setAttribute('style', 'padding: 0px; width: 100%;');
            li.appendChild(ul);

            var nameVar = document.createElement('li');
            nameVar.setAttribute('style', 'display:inline-block; width:50%;');
            nameVar.innerHTML = name;
            ul.appendChild(nameVar);

            var priceLi = document.createElement('li');
            priceLi.setAttribute('style', 'display:inline-block; width:30%;');
            priceLi.innerHTML = price + 'EUR';
            ul.appendChild(priceLi);

            var linkLi = document.createElement('li');
            linkLi.setAttribute('style', 'display:inline-block; width:auto;');
            ul.appendChild(linkLi);

            var link = document.createElement('a');
            link.setAttribute('style', 'display:inline-block; width:auto;');
            link.setAttribute('class', "cartRemove");
            link.setAttribute('href', '#');
            link.setAttribute('value', id);
            link.innerHTML = "Remove";

            linkLi.appendChild(link);
        };

        function createSongElement(
            songTitle,
            artistName,
            songPath,
        ) {

            let parentParentDiv = document.createElement("div");
            parentParentDiv.setAttribute("class", "player-component");
            document.getElementById("songs-container").appendChild(parentParentDiv);

            let parentDiv = document.createElement("div");
            parentDiv.setAttribute("class", "details-player-component");
            parentParentDiv.appendChild(parentDiv);

            let songTitleElement = document.createElement("h3");
            songTitleElement.innerHTML = songTitle;
            parentDiv.appendChild(songTitleElement);

            let tagsContainer = document.createElement("div");
            tagsContainer.setAttribute("class", "tags-container");
            parentDiv.appendChild(tagsContainer);

            let artist = document.createElement("p");
            artist.innerHTML = artistName + " - " + songTitle;
            tagsContainer.appendChild(artist);

            let seekBarDiv = document.createElement("div");
            seekBarDiv.setAttribute("id", "seek-bar");
            parentDiv.appendChild(seekBarDiv);

            let fillSeekBar = document.createElement("div");
            fillSeekBar.setAttribute("id", "fill");
            seekBarDiv.appendChild(fillSeekBar);

            let handleSeekBar = document.createElement("div");
            handleSeekBar.setAttribute("id", "handle");
            seekBarDiv.appendChild(handleSeekBar);

            let audioFile = document.createElement("audio");
            parentDiv.appendChild(audioFile);

            let sourceAudioFile = document.createElement("source");
            sourceAudioFile.setAttribute("src", "../uploads/" + songPath + ".mp3");
            sourceAudioFile.setAttribute("type", "audio/mpeg");
            audioFile.appendChild(sourceAudioFile);

            let infoAboutSongDiv = document.createElement("div");
            infoAboutSongDiv.setAttribute("class", "infoAboutSong");
            parentDiv.appendChild(infoAboutSongDiv);

            let playerDiv = document.createElement("div");
            playerDiv.setAttribute("id", "player");
            infoAboutSongDiv.appendChild(playerDiv);

            let aTagPlay = document.createElement("a");
            aTagPlay.setAttribute("id", "play");
            aTagPlay.setAttribute("class", "play");
            playerDiv.appendChild(aTagPlay);

            let imgTagPlay = document.createElement("img");
            imgTagPlay.setAttribute("src", "../img/play.png");
            aTagPlay.appendChild(imgTagPlay);

        }

        $(document).ready(function getSongsFromCart() {
            $.ajax({
                url: "../includes/getSongsFromCart.php",
            }).done(function(data) {
                var result = $.parseJSON(data);
                let songs = result.items;
                console.log(songs);
                songs.forEach(song => {
                    createSongElement(song.song_title, song.artist_name, song.path_id);
                })

            })
        })



        $("#listedItems").on('click', '.cartRemove', function() {
            let songId = $(this).attr('value');
            $.ajax({
                    method: "GET",
                    url: "../includes/removeFromCart.php?songId=" + songId + "",
                })
                .done(function(data) {
                    var result = $.parseJSON(data);
                    let array = result.items;
                    if ((result.items).length == 0) {
                        document.getElementById('myCartDiv').style.display = 'none';
                        document.getElementById('listedSongsDiv').style.display = 'none';

                        var h2 = document.createElement('h2');
                        h2.innerHTML = "Your cart is empty, go back to shopping";
                        document.getElementById('noSongsMessage').appendChild(h2);
                    } else {
                        document.getElementById('myCartDiv').style.display = 'block';
                        document.getElementById('listedSongsDiv').style.display = 'block';
                    }
                    let total = 0;
                    $('#listedItems').html('');
                    $('#songs-container').html('');

                    array.forEach(element => {
                        createListElement(element.song_title, element.price, element.id);
                        createSongElement(element.song_title, element.artist_name, element.path_id)
                        total += element.price;
                    })

                    $('#cartTotal').html(total + ' EUR');
                }).fail(function(xhr, status, error) {
                    alert(xhr.responseText);
                })
        });
    </script>
</body>

</html>