<?php
    if(!empty($_POST)){

       /* New object of Students() */
        require_once('../includes/Users_class.php');
        $user = new User();
        // get name fields from input in new_student.php
        $email = $_POST["email"];
        $password = $_POST["password"];

        // call add method in students object
        $res = $user->login( $email, $password );
  
        if($res){
            header("Location: latest_releases.php"); 
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
                <form class="form-horizontal" method="POST" action="login.php">
                 
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
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-primary" value="Login">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>