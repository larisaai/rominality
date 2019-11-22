<?php
    if(!empty($_POST)){
        /* New object of Students() */
        require_once('../includes/Users_class.php');
        $user = new User();

        // get name fields from input in new_student.php
        $first = $_POST["firstname"];
        $last =  $_POST["lastname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        // call add method in students object
        $res = $user->create($first, $last, $email, $password, $confirm_password );
        if($res){
            header("Location: latest_releases.php"); 
        }
        else{
            echo "email is take or any other error";
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
                            <input type="text" class="form-control" id="title" placeholder="First Name" name="firstname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="year" class="col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="year" placeholder="Last Name" name="lastname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="director" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="director" placeholder="email" name="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="plot" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="plot" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="plot" class="col-sm-2 control-label">Confirm password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="plot" placeholder="Confirm Password" name="confirm_password">
                        </div>
                    </div>

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