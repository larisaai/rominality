
<?php
    session_start();
    require_once('../classes/User_class.php');

    $showError = false;
    $user = new User();
    
    $id = $_SESSION['user']['id'];

    if (!empty($_POST)) {
        $oldPassword = $_POST["old_password"];
        $newPassword = $_POST["new_password"];

        if($oldPassword === $newPassword ){
            $showError = 'New password cannot be the same as the previous one;';
        }
        else{

            if($_SESSION['user']['password'] == $oldPassword ){
                $res = $user->update_password($id, $oldPassword, $newPassword);

                unset($_POST);
                header("Location: profile.php");

            }else{
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
    <div class="container">
        <div class="row top-buffer">
            <h3>Change your password</h3>
            <div class="">
                <div> <?php echo $_SESSION['user']['firstname'];  ?>
                    <?php echo $_SESSION['user']['lastname']; ?>
                </div>
            </div>
            <div class="editable-data">
            <div class="row top-buffer">
            <div class="col-xs-8 col-xs-offset-2">
                <form class="form-horizontal" method="POST" action="change_password.php">
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">First Name</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="title" placeholder="Old password" name="old_password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_pass1" class="col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="new_pass1" placeholder="New password" name="new_password" required>
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-primary" value="Update password">
                        </div>
                    </div>

                    <?php
                        if($showError){
                            echo "<div class='form-group'><p class='error-text'>$showError</p> </div>";
                        }
                    ?>

                </form>
            </div>
        </div>
            </div>
        </div>
    </div>
</body>

</html>