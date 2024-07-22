<?php
/******************

* Mp3 Tag Editor

* Moded by damnidea.com

******************/


$type = @$_GET['type'];
$p = @$_GET['p'];
$img = @$_GET['img'];
if((in_array($type,array('image/jpeg','image/png','image/gif'))) && (file_exists("../data/mp3/".$p)))
{
header('Content-Type: '.$type.'');
readfile("temp_albumarts/".$img);
unlink("temp_albumarts/".$img);
}
else
{
die('File doesn\'t exists');
}
?>