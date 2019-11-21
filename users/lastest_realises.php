<!DOCTYPE html>
<html lang="en">
<?php
/* Include <head></head> */
require_once('../includes/header.php');

/* New object of Students() */
require_once('../includes/Users_class.php');
$users = new Users();

// get name fields from input in new_student.php
$first = $_POST["firstname"];
$last =  $_POST["lastname"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];
// call add method in students object
$res = $users->add($first, $last, $email, $password, $confirm_password );
echo $res;

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
                <div>Welcome, <?php echo  $first ; 
                 echo $last ?></div>
            </div>
        </div>
    </div>
</body>

</html>