<!DOCTYPE html>
<html lang="en">
<?php
/* Include <head></head> */
require_once('../includes/header.php');
require_once('../classes/Attribute_class.php');
require_once('../classes/Song_class.php');
session_start();
?>

<body>
    <?php
    /* Include <head></head> */
    require_once('../includes/menu_logged.php');
    ?>
    <div class="container">
        <div class="row top-buffer">
            <h3>your order</h3>
            <div class="col-xs-8 col-xs-offset-2">
                <div>Welcome, <?php echo $_SESSION['user']['firstname'];  ?>
                    <?php echo $_SESSION['user']['id']; ?>

                </div>
            </div>

            <div class="col-xs-8 col-xs-offset-2">
                <div>
                    <p>Payment has been completed/incompleted</p>
                    <p>Invoice:</p>;


                </div>
            </div>
        </div>
    </div>
</body>

</html>