<?php
$showError = false;
if (!empty($_POST)) {
    require_once __DIR__ . "/../vendor/autoload.php";
    /* New object of Students() */
    require_once('../classes/User_class.php');
    $user = new User();

    // get name fields from input in new_student.php
    $first = $_POST["firstname"];
    $last =  $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $user_type = $_POST["user_type"];
    // call add method in students object
    $res = $user->create($first, $last, $email, $password, $confirm_password, $user_type);

    if ($res ===  true) {
        $collection = (new MongoDB\Client)->rominality->users;
        $date = date("Y-m-d");
        $time = date("h:i:sa");

        $insertOneResult = $collection->insertOne([
            'first_name' => $first,
            'last_name' => $last,
            'email' => $email,
            'password' => $password,
            'user_type' => $user_type,
            'current_date' => $date,
            'current_time' => $time,
        ]);
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
                <div class="signup-form-container">
                    <div class="user-sigup-btn-container active">
                        <h4 class="user-sigup-btn ">Signup as a user</h4>
                        <svg class="arrow-down " xmlns="http://www.w3.org/2000/svg" width="43" height="18" viewBox="0 0 43 18">
                            <text id="_" data-name="&gt;" transform="translate(11) rotate(90)" fill="#f2edf0" font-size="30" font-family="Poppins-SemiBold, Poppins" font-weight="600">
                                <tspan x="0" y="0">&gt;</tspan>
                            </text>
                        </svg>
                    </div>
                    <div class="producer-sigup-btn-container">
                        <h4 class="producer-sigup-btn">Signup as a producer</h4>
                        <svg class="arrow-down " xmlns="http://www.w3.org/2000/svg" width="43" height="18" viewBox="0 0 43 18">
                            <text id="_" data-name="&gt;" transform="translate(11) rotate(90)" fill="#f2edf0" font-size="30" font-family="Poppins-SemiBold, Poppins" font-weight="600">
                                <tspan x="0" y="0">&gt;</tspan>
                            </text>
                        </svg>
                    </div>

                    <div class="signup-form user-signup active">
                        <form class="" method="POST" action="signup.php">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="First Name" name="firstname" required <?php if (!empty($first)) {
                                                                                                                                echo "value=' $first'";
                                                                                                                            } ?>>

                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" i placeholder="Last Name" name="lastname" required <?php if (!empty($last)) {
                                                                                                                                echo "value=' $last'";
                                                                                                                            } ?>>

                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email" name="email" required <?php if (!empty($email)) {
                                                                                                                        echo "value=' $email'";
                                                                                                                    } ?>>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="user_type" value="1" required>
                            </div>

                            <?php
                            if ($showError) {
                                echo "<div class='form-group'><p class='error-text'>$showError</p> </div>";
                            }
                            ?>

                            <div class="form-group">
                                <input type="submit" class="button btn-white login-btn" value="Register">
                            </div>

                        </form>
                    </div>

                    <div class="signup-form producer-signup ">
                        <form class="" method="POST" action="signup.php">

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="First Name" name="firstname" required <?php if (!empty($first)) {
                                                                                                                                echo "value=' $first'";
                                                                                                                            } ?>>

                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Last Name" name="lastname" required <?php if (!empty($last)) {
                                                                                                                                echo "value=' $last'";
                                                                                                                            } ?>>

                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email" name="email" required <?php if (!empty($email)) {
                                                                                                                        echo "value=' $email'";
                                                                                                                    } ?>>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Password" name="password" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="user_type" value="2" required>
                            </div>

                            <?php
                            if ($showError) {
                                echo "<div class='form-group'><p class='error-text'>$showError</p> </div>";
                            }
                            ?>

                            <div class="form-group">
                                <input type="submit" class="button btn-white login-btn" value="Register">
                            </div>

                        </form>
                    </div>
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
    <script src="../scripts/app.js"></script>

</body>

</html>