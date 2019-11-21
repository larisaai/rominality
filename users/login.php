<!DOCTYPE html>
<html lang="en">
<?php
/* Include <head></head> */
require_once('../includes/header.php');

/* New object of Students() */
//require_once('../includes/Students_class.php');
//$students = new Students();
/* Get a list of all students in DB */
//$result = $students->list();
?>

<body>
    <?php
    /* Include <head></head> */
    require_once('../includes/menu.php');
    ?>
    <div class="container">
        <div class="row top-buffer">
            <div class="col-xs-8 col-xs-offset-2">
                <form class="form-horizontal" method="POST" action="lastest_realises2.php">
                 
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