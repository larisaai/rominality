
<?php
session_start();
require_once('../classes/User_class.php');
$user = new User();

// Get id from parameter in URL
 
$id = $_SESSION['user']['id'];
// Call delete method in $user object
$res = $user->dezactivate_account($id);
if( $res){
header('Location: logout.php');
}
?>


