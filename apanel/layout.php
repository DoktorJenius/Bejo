<?php

require '../includes/db.php';
require '../core/functions/connect.php';
require '../core/functions/common.php';
$site_title  ='Tata Letak';
include '../includes/header.php';
echo'<style>.main{margin:10px!important;background:#f2f2f2;color:#999;border:2px dashed #ddd;padding:10px;height:400px!important;vertical-align:middle;}
.main.ku{height:auto!important;}</style>';
if($adminlog==1){
$aid=formget("id");
?>

<div class="box">
    <div class="title-menu">Tata Letak <font color="green">(Coming soon!)</font></div>
	<center>
	<div class="tabel1">
	<div class="main ku">
	Header
	</div>
	</div>
    <div class="tabel2" style="width: 65%;">
	<div class="main">
	Main Page
	</div>
	</div>
	<div class="tabel2" style="width: 35%;">
	<div class="main">
	Sidebar
	</div>
	</div>
	<div class="clear"></div>
	<div class="tabel1">
	<div class="main ku">
	Footer
	</div>
	</div>
	</center>
	<br>
</div>

<?php
 include '../includes/footer.php';
}
 else {
 header('Location: /');
 }
?>