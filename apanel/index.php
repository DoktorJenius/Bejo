<?php
require '../includes/db.php';
require '../core/functions/connect.php';
require '../core/functions/general.php';
require '../core/functions/permalinks.php';
require '../core/functions/common.php';
$site_title = 'Dasbor';
include '../includes/header.php';

if($userlog==1){
  echo '
  <div class="box">
	<div class="alert-danger">Pastikan beli script langsung dengan <a href="http://fb.me/bayuzlink"><b>Pembuatnya</b></a> untuk terus mendapatkan update gratis.</div>
  </div>
  <div class="box">
	<div class="alert-warning"><iframe HEIGHT="15" scrolling="no" frameborder="0" src="https://pastebin.com/raw/VS8HnAAB" FRAMEBORDER="0" MARGINWIDTH="0" MARGINHEIGHT="0" SCROLLING="no"></iframe></div>
  </div>
  <div class="tabel4">
	<div class="main">
	  <div class="main-title">Total Posts</div>
	  '.ceil(mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT `id` FROM `posts`"))).'
	</div>
  </div>
  <div class="tabel4">
	<div class="main">
	  <div class="main-title">Total Playlist</div>
	  '.ceil(mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT `id` FROM `cache_search`"))).'
	</div>
  </div>
  <div class="tabel4">
	<div class="main">
	  <div class="main-title">Total Keywords</div>
	  '.ceil(mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT `id` FROM `keywords`"))).'
	</div>
  </div>
  <div class="tabel4">
	<div class="main">
	  <div class="main-title">Total DMCA</div>
	  '.ceil(mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT `id` FROM `dmca`"))).'
	</div>
  </div>
  <div class="clear"></div>';

  echo'
  <div class="tabel2" style="text-align:left">
	<div class="box">
	  <div class="title-menu">Postingan Terakhir</div>
	  <div class="menulist">
		<div class="scroll">
		  <table class="table">
			<tr>
			  <th style="text-align:center">#</th>
			  <th width="90%">Judul</th>
			</tr>';

			$posts=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts ORDER BY id DESC LIMIT 5");
			while($show=mysqli_fetch_array($posts)){
			echo '
			<tr>
			  <td style="text-align:center">'.$show["id"].'</td>
			  <td><a href="'.file_permalink($show["id"], $show["artist"], $show["title"]).'" target="_blank">'.$show["artist"].' - '.$show["title"].'</a></td>
			</tr>';
			}
		  echo'
		  </table>
		</div>
	  </div>
	</div>
	<div class="box">
	  <div class="title-menu">Halaman Terakhir</div>
	  <div class="menulist">
		<div class="scroll">
		  <table class="table">
			<tr>
			  <th style="text-align:center">#</th>
			  <th width="90%">Judul</th>
			</tr>';

			$pages=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM pages ORDER BY id DESC LIMIT 5");
			while($show=mysqli_fetch_array($pages)){
			echo '
			<tr>
			  <td style="text-align:center">'.$show["id"].'</td>
			  <td><a href="/'.$show["url"].'" target="_blank">'.$show["title"].'</a></td>
			</tr>';
			}
		  echo '
		  </table>
		</div>
	  </div>
	</div>
  </div>';
  echo'
  <div class="tabel2" style="text-align:left">
	<div class="box">
	  <div class="title-menu">Keywords Terakhir</div>
	  <div class="menulist">
		<div class="scroll">
		  <table class="table">
			<tr>
			  <th width="100%">Keywords</th>
			</tr>';

			$keywords=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM keywords ORDER BY id DESC LIMIT 5");
			while($show=mysqli_fetch_array($keywords)){
			echo '
			<tr>
			  <td>'.$show["keyword"].'</td>
			</tr>';
			}
		  echo '
		  </table>
		</div>
	  </div>
	</div>';
	echo'
	<div class="box">
	  <div class="title-menu">DMCA Terakhir</div>
	  <div class="menulist">
		<div class="scroll">
		  <table class="table">
			<tr>
			  <th width="100%">DMCA</th>
			</tr>';

			$dmca=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM dmca ORDER BY id DESC LIMIT 5");
			while($show=mysqli_fetch_array($dmca)){
			echo '
			<tr>
			  <td>'.$show["url"].'</td>
			</tr>';
			}
		  echo '
		  </table>
		</div>
	  </div>
	</div>
  </div>';
} else {
  header('Location:login.php');
}
include '../includes/footer.php';