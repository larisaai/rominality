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
    <div class="container">
        <div class="row top-buffer">
            <h3>Cart</h3>
            <div class="col-xs-8 col-xs-offset-2">
                <div>Welcome, <?php echo $_SESSION['user']['firstname'];  ?>
                    <?php echo $_SESSION['user']['id']; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>Cart songs with play</p>
                <?php
                $cartSongs = $_SESSION['cartItems'];

                foreach ($_SESSION['cartItems'] as $song) {

                    $attributes = Attribute::getAttributesForId($song['id']);
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
                    </div>';
                }
                ?>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <p>My cart with price and listed songs</p>
                <div style="background-color:lightgray; padding: 20px;">

                    <ol id="listedItems" style="width: 100%; padding: 0px;">
                        <?php

                        //name
                        //price
                        //remove button
                        //total
                        //pay   
                        print_r($_SESSION['cartItems']);

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

                        <p style="text-align: right; margin-right: 35%; margin-top: 20px;">Total: <?php echo $totalPrice; ?>EUR</p>
                    </ol>




                    <button>Pay</button>


                </div>

            </div>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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

        function createSongElement() {

        }


        $("#listedItems").on('click', '.cartRemove', function() {

            let songId = $(this).attr('value');
            $.ajax({
                    method: "GET",
                    url: "../includes/removeFromCart.php?songId=" + songId + "",
                })
                .done(function(data) {
                    console.log(data);
                    console.log('accessed');
                    var result = $.parseJSON(data);
                    let array = result.items;
                    $('#listedItems').html('');

                    array.forEach(element => {
                        // console.log(element);
                        createListElement(element.song_title, element.price, element.id);

                    })

                    //see what to do with the cart
                }).fail(function(xhr, status, error) {
                    alert(xhr.responseText);
                })
        });
    </script>
</body>

</html>