<!DOCTYPE html>
<html lang="en">
<?php
/* Include <head></head> */
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


    $song->create($_SESSION['user']['id'], $songName, $artistName, $price, 'EUR', $uniqueIdName, $attributes);
    header("Location: latest_releases.php");
}
?>

<body>
    <?php
    /* Include <head></head> */
    require_once('../includes/menu_logged.php');
    ?>
    <div class="container">
        <div class="box-wide">
            <h3>Latest releases</h3>
            <div>
                <div>Welcome, <?php echo $_SESSION['user']['firstname'];  ?>
                    <?php echo $_SESSION['user']['id']; ?>

                </div>
            </div>

            <div>
                <div>
                    <h1>Upload new song</h1>

                    <form class="form-horizontal" method="POST" action="upload_song.php" enctype="multipart/form-data">
                        <p>Select tags:</p>

                        <div>
                            <?php
                            foreach ($res as $element) {
                                echo '<div>
                                    <input type="checkbox" id="tag' . $element['id'] . '" name="tags[]" value="' . $element['id'] . '"></input>
                                    <label for="tag' . $element['id'] . '">' . $element['attribute_name'] . '</label>
                                </div>';
                            }
                            ?>
                        </div>

                        <input name="songName" type="text" placeholder="Add the title of the song" required><br>

                        <input name="artistName" type="text" placeholder="Add the name of the artist" required><br>

                        <input name="price" type="number" placeholder="Add the price" required><br>

                        <input type="file" name="songFile" required><br><br>

                        <button type="submit">Add song</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>