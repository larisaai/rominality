<?php
    session_start();
    require_once('../classes/User_class.php');
    $user = new User();
    
    $id = $_SESSION['user']['id'];
    
    if (!empty($_POST)) {

        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        
        $res = $user->update($id, $firstname, $lastname, $email);
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
            <h3>Your profile</h3>
        
            <div class="editable-data">
            <div class="row top-buffer">
            <div class="col-xs-8 col-xs-offset-2">
                <form class="form-horizontal" method="POST" action="profile.php">
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">First Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" placeholder="First Name" name="firstname" value="<?php echo $_SESSION['user']['firstname'];  ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="year" class="col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="year" placeholder="Last Name" name="lastname" value="<?php echo $_SESSION['user']['lastname']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="director" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="director" placeholder="email" name="email" value=" <?php echo $_SESSION['user']['email']; ?>" required>
                        </div>
                    </div>

                 
                    <div>Add a picture</div>
                    <div class="form-group">
                        <a href="change_password.php" class="col-sm-offset-2 col-sm-10"> Change password </a>
                    </div>
                  
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button >Delete profile</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-primary" value="Update profile">
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