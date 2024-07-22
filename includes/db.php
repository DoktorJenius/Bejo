<?php


$dbcon=@($GLOBALS["___mysqli_ston"] = mysqli_connect('localhost','jajxmwfh_kicau','JuraganPuls4'));
$dbselect=@mysqli_select_db($dbcon, 'jajxmwfh_kicau');
$url = "http://".$_SERVER["HTTP_HOST"]."/";

if(!$dbcon OR !$dbselect){
 echo"<style>
	.box {color:#888;position: relative;background: #fff;box-shadow: 0 2px 3px 0 rgba(0,0,0,.15);margin:10px;}
	.menulist{border-bottom: 1px solid #eee;padding: 20px 10px;margin: 0px;font-weight: normal;}
 </style>";
 echo '<div class="box"><div class="menulist">Database connection failed!<div></div>';
exit;
}

?>