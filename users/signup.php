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
        <div class="full-width landing-page-bottom-lines">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23.5" height="119.009" viewBox="0 0 23.5 119.009">
                        <g id="Group_5" data-name="Group 5" transform="translate(-277 -863.491)">
                            <line id="Line_5" data-name="Line 5" x1="22.5" transform="translate(278 981.5)" fill="none" stroke="#f2edf0" stroke-width="2"/>
                            <line id="Line_20" data-name="Line 20" x1="0.5" y2="54" transform="translate(278 863.5)" fill="none" stroke="#f2edf0" stroke-width="2"/>
                    </g>
                    </svg>
                    
                    <svg class="arrow-down bounce" xmlns="http://www.w3.org/2000/svg" width="43" height="18" viewBox="0 0 43 18">
                        <text id="_" data-name="&gt;" transform="translate(11) rotate(90)" fill="#f2edf0" font-size="30" font-family="Poppins-SemiBold, Poppins" font-weight="600"><tspan x="0" y="0">&gt;</tspan></text>
                    </svg>

                    <svg xmlns="http://www.w3.org/2000/svg" width="122" height="65" viewBox="0 0 122 65">
                        <g id="Group_6" data-name="Group 6" transform="translate(-1520 -917.5)">
                            <line id="Line_3" data-name="Line 3" x2="75.5" transform="translate(1520 981.5)" fill="none" stroke="#f2edf0" stroke-width="2"/>
                            <line id="Line_4" data-name="Line 4" y2="44" transform="translate(1641 917.5)" fill="none" stroke="#f2edf0" stroke-width="2"/>
                        </g>
                    </svg>


                </div>
        </div>
    </div>

    <div class="about-us-container">
        <div class="box-wide about-us-inner-container">
            <div class="about-us-top-left-short-line"></div>
            <div class="about-us-top-right-short-line"></div>
            <div class="about-us-bottom-left-short-line"></div>
            <div class="about-us-bottom-right-short-line"></div>
            <div class="about-us box-wide-inner">
                <h2 class="about-title">About us</h2>
                <p class="about-description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
            </div>
    </div>
</div>

</body>

</html>