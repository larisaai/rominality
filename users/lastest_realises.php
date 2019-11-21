<!DOCTYPE html>
<html lang="en">
<?php
    /* Include <head></head> */
    require_once('../includes/header.php');
    session_start();

?>

<body>
    <?php
    /* Include <head></head> */
    require_once('../includes/menu.php');
    ?>
    <div class="container">
        <div class="row top-buffer">
            <h3>Lastest realises</h3>
            <div class="col-xs-8 col-xs-offset-2">
                <div>Welcome, <?php echo   $_SESSION['user']['name'] ; 
            ?></div>
            </div>
        </div>
    </div>
</body>

</html>