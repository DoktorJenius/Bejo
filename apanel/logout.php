<?php
require '../includes/db.php';
require '../core/functions/connect.php';
$site_title = 'Logout';
include '../includes/header.php';

if($userlog==1){

session_destroy();

header('Location:login.php');

include '../includes/footer.php';
}
else {
header('Location:/');
}
?>
