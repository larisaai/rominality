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

    <div class="hero-container">
        <div class="hero-img-container">
            <img class="hero-img" src="../img/hero2.png">
        </div>
        <div class="box-wide">
            <div class="landing-page-container box-wide-inner">
                <div class="titles">
                    <h1>Play and share</h1>
                    <h3>Underground music community</h3>
                </div>
            <div class="signup-form login-form">
                <form class="" method="POST" action="signup.php">
                <h4>Signup to rominality</h4>
                    <div class="form-group">
                            <input type="text" class="form-control" id="title" placeholder="First Name" name="firstname" required 
                                <?php if(!empty($first)){ echo "value=' $first'";  }?>
                            >
                     
                    </div>
                    <div class="form-group">
                            <input type="text" class="form-control" id="year" placeholder="Last Name" name="lastname" required
                            <?php  if(!empty($last)){ echo "value=' $last'";  }?>
                            >
                     
                    </div>
                    <div class="form-group">
                            <input type="email" class="form-control" id="director" placeholder="email" name="email" required 
                            <?php if(!empty($email)){ echo "value=' $email'";  }?>
                            >
                    </div>

                    <div class="form-group">
                            <input type="text" class="form-control" id="plot" placeholder="Password" name="password" required
                    
                            >
                    </div>
                    <div class="form-group">
                            <input type="text" class="form-control" id="plot" placeholder="Confirm Password" name="confirm_password" required>
                    </div>
                    
                    <?php
                        if($showError){
                            echo "<div class='form-group'><p class='error-text'>$showError</p> </div>";
                        }
                    ?>

                    <div class="form-group">
                            <input type="submit" class="button btn-white login-btn" value="Register">
                    </div>

                </form>
            </div>
   
        </div>
        <?php
            require_once('../components/landing-page-bottom-animation.php');
        ?>
        </div>
    </div>


    <?php
        require_once('../components/about-us-component.php');
        require_once('../includes/footer.php');
    ?>
</body>

</html>