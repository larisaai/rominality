<?php

if (empty($_SESSION['cartItems'])) {
    $cartItems = 0;
} else {
    $cartItems = count($_SESSION['cartItems']);
}


echo '
<nav class="navbar  " >
        <div class="box-wide">
            <div class="navigation ">
            <a href="../users/latest_releases.php">
                <div class="nav-left-aligned"><h4>rominality</h4></div>
            </a>
                <div class="burger-menu-container">
                    <div class="burger-menu">
                        <span class="burger-menu-item"></span>
                        <span class="burger-menu-item"></span>
                        <span class="burger-menu-item"></span>
                    </div>
                </div>
                    <div class="nav-right-aligned logged-in">
                   
                        <li><a href="../users/latest_releases.php">Home</a></li>
                        <li><a href="../users/library.php">Library</a></li>
                        
                        <div class="sub-menu-header"><a class="user-name">';
echo $_SESSION['user']['firstname']; ?>
                         <?php 
                            echo '
                            <img class="menu-arrow-down" src="../svg/arrow-right.svg" alt="menu arrow down">
                            <div class="sub-menu"></a>
                       
                                <li> <a href="../users/profile.php">My profile</a></li>
                                <li> <a href="../users/cart.php">My cart ( <span id="cartItems">' . $cartItems . '</span> )</a></li>
                                <li><a href="../users/logout.php">Logout</a></li>
                            </div>
                           
                        </div>
                        
                     
                    </div>
            </div>
        </div>

    </nav>
    <script src="../scripts/drop-down-sub-menu.js"></script>

';
?>