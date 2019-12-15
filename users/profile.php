<?php
session_start();
require_once('../classes/User_class.php');
$user = new User();

$id = $_SESSION['user']['id'];

if (!empty($_POST)) {

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];

    $fileContent = $_FILES['profileImage']['tmp_name'];
    $sExtention = (pathinfo("{$_FILES['profileImage']['name']}", PATHINFO_EXTENSION));

    $res = $user->update($id, $firstname, $lastname, $email, $fileContent, $sExtention);
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
    <div class="hero-container profile-page">
        <div class="hero-img-container">
            <img class="hero-img" src="../img/hero2.png">
        </div>

        <div class="box-wide">
            <div class="profile-page-inner">
                <h3>My profile</h3>
                <div class="editable-data">
                    <div class="image-container">
                        <img src="..<?php echo $_SESSION['user']['profile_picture']; ?>" alt="">
                    </div>
                    <div class="profile-form-container">
                        <form class="form-horizontal" method="POST" action="profile.php" enctype="multipart/form-data">

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="First Name" name="firstname" value="<?php echo $_SESSION['user']['firstname'];  ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Last Name" name="lastname" value="<?php echo $_SESSION['user']['lastname']; ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="email" name="email" value=" <?php echo $_SESSION['user']['email']; ?>" required>
                            </div>

                            <div class="form-group">
                                <input type="file" class="form-control " value="<?php echo $_SESSION['user']['profile_picture'] ?>444" name="profileImage" accept="image/png, image/jpeg">
                            </div>

                            <div class="form-group">
                                <a href="change_password.php" class="change-pass">Change password </a>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="button btn-white update-btn" value="Update profile">
                            </div>
                        </form>
                        <div class="form-group">
                            <button class="button btn-white delete-btn delete-button">Delete profile</button>
                        </div>
                    </div>

                    <div class="delete-account-container">
                        <div class="delete-account-content">
                            <h4>We are sorry to see you go...</h4>
                            <p>Are you sure that you want to delete your account?</p>
                            <div>
                                <button class="button btn-white cancel-btn">Cancel</button>
                                <a href="delete_user.php"><button class="button btn-white confirm-delete-btn delete-button">Yes</button></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- bottom -->

    <?php
    require_once('../includes/footer.php');
    ?>
</body>
<script src="../scripts/profile.js"></script>

</html>