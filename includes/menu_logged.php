<?php


echo '
<nav class="navbar  " >
        <div class="box-wide">
            <div class="navigation ">
                    <div class="nav-left-aligned"><h4>rominality</h4></div>
                    <div class="nav-right-aligned">
                        <li><a href="../users/latest_releases.php">Home</a></li>
                        <li><a href="../users/library.php">Library</a></li>
                        
                        <div class="sub-menu-header"><a >';
echo $_SESSION['user']['firstname']; ?>
                         <?php echo $_SESSION['user']['lastname'];
                            echo '</a>
                            <div class="sub-menu">
                                <li> <a href="../users/profile.php">My profile</a></li>
                                <li> <a href="../users/cart.php">My cart</a></li>
                                <li><a href="../users/logout.php">Logout</a></li>
                            </div>
                            <img class="menu-arrow-down" src="../svg/arrow-down.svg" alt="menu arrow down">
                        </div>
                        
                     
                    </div>
            </div>
        </div>

    </nav>
    <script src="../scripts/drop-down-sub-menu.js"></script>

';
