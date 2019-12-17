<!DOCTYPE html>
<html lang="en">
<?php
/* Include <head></head> */
$active = 'homePage';
require_once('../includes/header.php');
require_once('../classes/Attribute_class.php');
require_once('../classes/Song_class.php');
session_start();

$attributes = Attribute::readAll();
$res = $attributes;
$song = new Song();

if ($_POST) {
    $songName = $_POST['songName'];
    $artistName = $_POST['artistName'];
    $price = $_POST['price'];
    $attributes = $_POST['tags'];

    $uniqueIdName = uniqid();

    $fileId = $uniqueIdName;
    $sExtention = (pathinfo("{$_FILES['songFile']['name']}", PATHINFO_EXTENSION));
    $fileId .= '.' . $sExtention;
    move_uploaded_file($_FILES['songFile']['tmp_name'], "../uploads/$fileId");


    $song->create($_SESSION['user']['id'], $songName, $artistName, $price, 1, $uniqueIdName, $attributes);
    header("Location: latest_releases.php");
}
?>

<body>
    <?php
    /* Include <head></head> */
    require_once('../includes/menu_logged.php');
    ?>
    <div class="parent-container-andrei" id="container-releases">
        <div class="imgParent"></div>
        <div class="box-wide" id="containerLatest">



            <div class="titles">
                <h1>Upload new song.</h1>
            </div>
            <form class="form-horizontal" method="POST" action="upload_song.php" enctype="multipart/form-data">

                <h3>Describe the style</h3>
                <div class="parent-tags">
                    <p>Select tags:</p>
                    <div class="container-tags">
                        <?php
                        foreach ($res as $element) {
                            echo '<div class="tags-upload">
                                    <input type="checkbox" id="tag' . $element['id'] . '" name="tags[]" value="' . $element['id'] . '"></input>
                                    <label for="tag' . $element['id'] . '">' . $element['attribute_name'] . '</label>
                                </div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="upload-input">
                    <input name="songName" type="text" placeholder="Put song name here*" required>

                    <input name="artistName" type="text" placeholder="Put artist name here*" required>

                    <input name="price" type="number" placeholder="Put price in EUR here*" required>
                </div>
                <div class="buttons-upload">
                    <div>
                        <input id="button-choose-file" type="file" name="songFile" required>
                        <label for="button-choose-file">Upload file</label>
                    </div>
                    <button type="submit">SUBMIT</button>
                </div>
            </form>
        </div>

    </div>
    </div>
    <?php

    require_once('../includes/footer.php');
    ?>
</body>

</html>