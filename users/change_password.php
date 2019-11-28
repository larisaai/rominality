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
    require_once('../includes/menu_logged.php');
    ?>
    <div class="container">
        <div class="row top-buffer">
            <h3>Your profile</h3>
            <div class="">
                <div> <?php echo $_SESSION['user']['firstname'];  ?>
                    <?php echo $_SESSION['user']['lastname']; ?>
                </div>
            </div>
            <div class="editable-data">
            <div class="row top-buffer">
            <div class="col-xs-8 col-xs-offset-2">
                <form class="form-horizontal" method="POST" action="profile.php">
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">First Name</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="title" placeholder="Old password" name="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_pass1" class="col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="new_pass1" placeholder="New password" name="new_password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_pass2" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="new_pass2" placeholder="Confirm new password" name="new_password" required>
                        </div>
                    </div>

                 
        
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-primary" value="Update password">
                        </div>
                    </div>

                </form>
            </div>
        </div>
            </div>
        </div>
    </div>
</body>

</html>