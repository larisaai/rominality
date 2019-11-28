<?php
$showError = false;
if (!empty($_POST)) {
    /* New object of Students() */
    require_once('../classes/User_class.php');
    $user = new User();

    // get name fields from input in new_student.php
    $first = $_POST["firstname"];
    $last =  $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    // call add method in students object
    $res = $user->create($first, $last, $email, $password, $confirm_password);
    if ($res ===  true) {
        header("Location: latest_releases.php");
    } else {    
        $showError = $res;
        unset($_POST);
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
    require_once('../includes/menu.php');
    ?>
    <div class="container">
        <div class="row top-buffer">
            <div class="col-xs-8 col-xs-offset-2">
                <form class="form-horizontal" method="POST" action="signup.php">
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">First Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" placeholder="First Name" name="firstname" required 
                                <?php if(!empty($first)){ echo "value=' $first'";  }?>
                            >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="year" class="col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="year" placeholder="Last Name" name="lastname" required
                            <?php  if(!empty($last)){ echo "value=' $last'";  }?>
                            >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="director" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="director" placeholder="email" name="email" required 
                            <?php if(!empty($email)){ echo "value=' $email'";  }?>
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="plot" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="plot" placeholder="Password" name="password" required
                    
                            >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="plot" class="col-sm-2 control-label">Confirm password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="plot" placeholder="Confirm Password" name="confirm_password" required>
                        </div>
                    </div>
                    
                    <?php
                        if($showError){
                            echo "<div class='form-group'><p class='error-text'>$showError</p> </div>";
                        }
                    ?>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-primary" value="Register">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>