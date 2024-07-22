<?php
ob_start();
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="cache-control" content="max-age=0"/>
  <meta http-equiv="expires" content="0"/>
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <title><?php echo $site_title; ?></title>
  <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
  <link href="//fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.rawgit.com/FortAwesome/Font-Awesome/v4.6.3/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/admin.css" />
  <meta name="theme-color" content="#2196F3">
  <script type="text/javascript" src="/assets/js/jquery.min.js"></script>
<?php if($userlog==1){
$uid=users("id"); ?>
</head>
<body onload="myFunction()" style="margin:0;">
<div id="loader"></div>
<div style="display:none;" id="myDiv">
  <header>
	<input type="checkbox" id="tag-menu"/>
	  <label class="fa fa-bars menu-bar" for="tag-menu"></label>
	  <div class="panel-logo"><a rel="home" href="/"><span style="font-weight:normal">bejo</span>Panel</a></div>
	  <div class="menu-right"><a href="logout.php"><i class="fa fa-sign-out"></i></a></div>
	  <div class="jw-drawer">
		<div class="hai">Hai, <?php echo users( 'name' ); ?>!</div>
		<nav>
		  <ul id="nganu">
			<li <?php if($site_title == "Dasbor") echo "class='active'"; ?>>
			  <a href="index.php"><i class="fa fa-dashboard"></i>Dasbor</a>
			</li>
			<li><a class="tutup<?php if($site_title == "Halaman") echo " buka active"; ?><?php if($site_title == "Manual MP3") echo " buka active"; ?><?php if($site_title == "Playlist") echo " buka active"; ?>" href="#"><i class="fa fa-book"></i> Postingan</a>
			<ul class="sub" <?php if($site_title == "Halaman") echo "style='display:block;'"; ?><?php if($site_title == "Manual MP3") echo "style='display:block;'"; ?><?php if($site_title == "Playlist") echo "style='display:block;'"; ?>>
			<li>
              <a <?php if($site_title == "Manual MP3") echo "class='aktiff'"; ?> href="posts.php"><i class="fa fa-circle-o"></i>Manual MP3</a>
			</li>
			<li>
              <a <?php if($site_title == "Halaman") echo "class='aktiff'"; ?> href="pages.php"><i class="fa fa-circle-o"></i>Halaman</a>
			</li>
			</ul>
			</li>
			<li><a class="tutup<?php if($site_title == "Kata Kunci") echo " buka active"; ?><?php if($site_title == "DMCA") echo " buka active"; ?><?php if($site_title == "Google Scanner") echo " buka active"; ?>" href="#"><i class="fa fa-wrench"></i> Alat</a>
			<ul class="sub" <?php if($site_title == "Kata Kunci") echo "style='display:block;'"; ?><?php if($site_title == "DMCA") echo "style='display:block;'"; ?><?php if($site_title == "Google Scanner") echo "style='display:block;'"; ?>>
			<li>
              <a <?php if($site_title == "Kata Kunci") echo "class='aktiff'"; ?> href="keywords.php"><i class="fa fa-circle-o"></i>Kata Kunci</a>
			</li>
			<li>
              <a <?php if($site_title == "DMCA") echo "class='aktiff'"; ?> href="dmca.php"><i class="fa fa-circle-o"></i>DMCA</a>
			</li>
			<li>
              <a <?php if($site_title == "Google Scanner") echo "class='aktiff'"; ?> href="tools.php"><i class="fa fa-circle-o"></i>Google Scanner</a>
			</li>
			</ul>
			</li>
			<li <?php if($site_title == "Safelink") echo "class='active'"; ?>>
              <a href="safelink.php"><i class="fa fa-link"></i>Safelink</a>
			</li>
			<li <?php if($site_title == "Tata Letak") echo "class='active'"; ?>>
              <a href="layout.php"><i class="fa fa-th-large"></i>Tata Letak</a>
			</li>
			<li <?php if($site_title == "Tema") echo "class='active'"; ?>>
              <a href="themes.php"><i class="fa fa-television"></i>Tema</a>
			</li>
			<li <?php if($site_title == "Pengaturan") echo "class='active'"; ?>>
              <a href="settings.php"><i class="fa fa-gears"></i>Pengaturan</a>
			</li>
			<li <?php if($site_title == "Akun Saya") echo "class='active'"; ?>>
              <a href="myaccount.php"><i class="fa fa-user"></i>Akun Saya</a>
			</li>
			<li style="color:#777;padding:20px;">
			  <center>
              bejo<b>Panel</b> v3.0
			  </center>
			</li>
		  </ul>
		</nav>
	  </div>
  </header>
  <div class="content">
<?php }else{ ?>
  <style>body{background:#2196F3!important;}</style>
</head>
<body>
  <div class="sign-logo">
	<a rel="home" href="/"><img src="/assets/images/icon.png"></a>
  </div>
  <div class="clear"></div>
<?php } ?>