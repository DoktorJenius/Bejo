<?php
$id = $_GET['id'];
$domain = $_GET['domain'];
$name = $_GET['name'];
$download = 'http://'.$domain.'/data/mp3/'.$id.'.mp3';
header("Content-Type:audio/mpeg");
header('Content-Disposition:attachment; filename="'.$name.'.mp3"');
readfile("$download") ;
header("Content -Transfer-Encoding:binary");
?>
