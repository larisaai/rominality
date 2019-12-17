<?php
session_start();
require_once('../classes/User_class.php');

$showError = false;
$user = new User();
$active = "changePasswordPage";
$id = $_SESSION['user']['id'];

if (!empty($_POST)) {
    $oldPassword = $_POST["old_password"];
    $newPassword = $_POST["new_password"];

    if ($oldPassword === $newPassword) {
        $showError = 'New password cannot be the same as the previous one;';
    } else {

        if ($_SESSION['user']['password'] == $oldPassword) {
            $res = $user->update_password($id, $oldPassword, $newPassword);
            if ($res === 'wrongoldpass') {
                $showError = 'Please  check your old password';
            }
            else{

                unset($_POST);
                header("Location: profile.php");
            }

        } else {
            $showError = 'Old password doesnt match';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<?php
/* Include <head></head> */
require_once('../includes/header.php');

?>

<body>
    <?php
    /* Include <head></head> */
    require_once('../includes/menu_logged.php');
    ?>
    <div class="hero-container change-password-page">
        <div class="hero-img-container">
            <img class="hero-img" src="../img/hero2.png">
        </div>
        <div class="box-wide change-password-page-inner">
            <h3>Change your password</h3>
            <div class="">
                <h4> <?php echo $_SESSION['user']['firstname'];  ?>
                    <?php echo $_SESSION['user']['lastname']; ?>
                </h4>
            </div>
            <div class="editable-data">

                <form class="form-horizontal change-password-form" method="POST" action="change_password.php">
                    <div class="form-group">
                        <input type="password" class="form-control" id="title" placeholder="Old password" name="old_password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="new_pass1" placeholder="New password" name="new_password" required>
                    </div>
                    <?php
                        if ($showError) {
                            echo "<div class='form-group'><p class='error-text'>$showError</p> </div>";
                        }
                    ?>

                    <div class="form-group">
                        <input type="submit" class="button btn-white update-btn" value="Update password">
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