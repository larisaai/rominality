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
    <div class="container">
        <div class="row top-buffer">
            <h3>Latest releases</h3>
            <div class="col-xs-8 col-xs-offset-2">
                <div>Welcome, <?php echo $_SESSION['user']['firstname'];  ?>
                    <?php echo $_SESSION['user']['lastname']; ?>
                    <?php echo $_SESSION['user']['id']; ?>

                    <a href="cart.php">CART: <span id="cartItems"><?php echo count($_SESSION['cartItems']); ?></span></p>
                </div>
            </div>

            <div>
                <a href="upload_song.php">Add song</a>
                <?php

                $songs = Song::all();
                foreach ($songs as $song) {
                    $id = $song['id'];
                    $attributes = Attribute::getAttributesForId($id);
                    echo '<div style="background-color: lightgrey; margin: 10px; padding: 4px;">
                    
                    
                        <h3>' . $song['song_title'] . '</h3>
                        <p>' . $song['artist_name'] . '</p>
                        <div>' .  Attribute::getCurrentAttributesAsList($attributes) . '</div>
                        <p>Add comment</p>
                        <a href="#">Like</a>
                        <audio controls="controls">
                            <source src="../uploads/' . $song['path_id'] . '.mp3" type="audio/mpeg" />
                                Your browser does not support the audio element.
                        </audio>
                        <p>Price: ' . $song['price'] . ' EUR</p>
                        <a class="cartButton" value="' . $song['id'] . '" href="#">Add to cart</a>
                    </div>';
                }

                ?>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
    </script>
</body>

</html>