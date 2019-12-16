<?php

if (empty($_SESSION['cartItems'])) {
    $cartItems = 0;
} else {
    $cartItems = count($_SESSION['cartItems']);
}
?>

<!DOCTYPE html>
<html lang="en">
<nav class="navbar  ">
    <div class="box-wide">
        <div class="navigation ">
            <a href="../users/latest_releases.php">
                <div class="nav-left-aligned"><img src="../img/logo2.png" /></div>
            </a>
            <div class="burger-menu-container">
                <div class="burger-menu">
                    <span class="burger-menu-item"></span>
                    <span class="burger-menu-item"></span>
                    <span class="burger-menu-item"></span>
                </div>
            </div>
            <div class="nav-right-aligned logged-in">

                <li><a <?php echo ($active == 'homePage') ? 'class="menu-active"' : '' ?> href="../users/latest_releases.php">Home</a></li>
                <li><a <?php echo ($active == 'libraryPage') ? 'class="menu-active"' : '' ?> href="../users/library.php">Library</a></li>

                <div class="sub-menu-header"><a <?php echo ($active == 'userPage') ? 'class="menu-active"' : '' ?> id="userNameId" class="user-name">
                        <?= $_SESSION['user']['firstname']; ?>

                        <div class="nav-two-design-lines">
                            <div class="nav-design-line"></div>
                            <div class="nav-design-line"></div>
                        </div>
                        <div class="sub-menu">
                    </a>

                    <li> <a href="../users/profile.php">My profile</a></li>
                    <li> <a href="../users/cart.php">My cart ( <span id="cartItems"><?= $cartItems ?></span> )</a></li>
                    <li><a href="../users/logout.php">Logout</a></li>
                </div>

            </div>


        </div>
    </div>
    </div>

</nav>
<script src="../scripts/drop-down-sub-menu.js"></script>