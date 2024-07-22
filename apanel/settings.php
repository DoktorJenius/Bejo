<?php

require '../includes/db.php';
require '../core/functions/connect.php';
require '../core/functions/common.php';
$site_title  ='Pengaturan';
include '../includes/header.php';

if($adminlog==1){
$aid=formget("id");
echo '<div class="box"><div class="title-menu">Pengaturan</div>
<div class="menulist">';

if(isset($_GET['ads'])){
echo'
<div class="intab">
<a class="tab" href="settings.php">Umum</a>
<a class="tab" href="?post">Post</a>
<a class="tab" href="?grabber">Grabber</a>
<div class="tab active-tab">Ads</div>
</div>
';
if(isset($_POST['change'])){
$adstop = input($_POST['adstop']);
$adsbottom = input($_POST['adsbottom']);
$adspopup = input($_POST['adspopup']);
$adssidebar = input($_POST['adssidebar']);
$adslink = input($_POST['adslink']);
update('adstop',$adstop);
update('adsbottom',$adsbottom);
update('adspopup',$adspopup);
update('adssidebar',$adssidebar);
update('adslink',$adslink);

echo '<div class="alert-success">Ads berhasil diperbarui.<meta http-equiv="Refresh" content="1; URL=?ads"></div>';
}
echo '
<form method="post">
<b>Ads Top</b>
<textarea class="text" name="adstop" style="margin-bottom:15px">'.stripslashes($set['adstop']).'</textarea>
<b>Ads Bottom</b>
<textarea class="text" name="adsbottom" style="margin-bottom:15px">'.stripslashes($set['adsbottom']).'</textarea>
<b>Ads Popup</b>
<textarea class="text" name="adspopup" style="margin-bottom:15px">'.stripslashes($set['adspopup']).'</textarea>
<b>Ads Sidebar</b>
<textarea class="text" name="adssidebar" style="margin-bottom:15px">'.stripslashes($set['adssidebar']).'</textarea>
<b>Ads Link</b>
<input type="text" name="adslink" placeholder="http://" value="'.stripslashes($set['adslink']).'" style="margin-bottom:15px">
<input type="submit" class="btn-submit" name="change" value="Update"></form>
';
}

elseif(isset($_GET['post'])){
echo'
<div class="intab">
<a class="tab" href="settings.php">Umum</a>
<div class="tab active-tab">Post</div>
<a class="tab" href="?grabber">Grabber</a>
<a class="tab" href="?ads">Ads</a>
</div>
';
if(isset($_POST['change'])){
$post_url = input($_POST['post_url']);
$artist_url = input($_POST['artist_url']);
$genre_url = input($_POST['genre_url']);
$post_index = input($_POST['post_index']);
$artist_index = input($_POST['artist_index']);
$genre_index = input($_POST['genre_index']);
$post_title = input($_POST['post_title']);
$post_desc = input($_POST['post_desc']);
$artist_title = input($_POST['artist_title']);
$artist_desc = input($_POST['artist_desc']);
$genre_title = input($_POST['genre_title']);
$genre_desc = input($_POST['genre_desc']);
$post_count = input($_POST['post_count']);
$artist_count = input($_POST['artist_count']);
$genre_count = input($_POST['genre_count']);
$new_post_count = input($_POST['new_post_count']);
$post_file = input($_POST['post_file']);
update('post_url',$post_url);
update('artist_url',$artist_url);
update('genre_url',$genre_url);
update('post_index',$post_index);
update('artist_index',$artist_index);
update('genre_index',$genre_index);
update('post_title',$post_title);
update('post_desc',$post_desc);
update('artist_title',$artist_title);
update('artist_desc',$artist_desc);
update('genre_title',$genre_title);
update('genre_desc',$genre_desc);
update('post_count',$post_count);
update('artist_count',$artist_count);
update('genre_count',$genre_count);
update('new_post_count',$new_post_count);
update('post_file',$post_file);

echo '<div class="alert-success">Post berhasil diperbarui.<meta http-equiv="Refresh" content="1; URL=?post"></div>';
}
echo '
<form method="post">
<b>Post Title</b>
<input required="required" type="text" name="post_title" value="'.$set['post_title'].'" style="margin-bottom:15px"/>
<b>Post Description</b>
<input required="required" type="text" name="post_desc" value="'.$set['post_desc'].'" style="margin-bottom:15px"/>
<b>Artist Title</b>
<input required="required" type="text" name="artist_title" value="'.$set['artist_title'].'" style="margin-bottom:15px"/>
<b>Artist Description</b>
<input required="required" type="text" name="artist_desc" value="'.$set['artist_desc'].'" style="margin-bottom:15px"/>
<b>Genre Title</b>
<input required="required" type="text" name="genre_title" value="'.$set['genre_title'].'" style="margin-bottom:15px"/>
<b>Genre Description</b>
<input required="required" type="text" name="genre_desc" value="'.$set['genre_desc'].'" style="margin-bottom:15px"/>
<b>Post URL</b>
<input required="required" type="text" name="post_url" value="'.$set['post_url'].'" style="margin-bottom:15px"/>
<b>Artist URL</b>
<input required="required" type="text" name="artist_url" value="'.$set['artist_url'].'" style="margin-bottom:15px"/>
<b>Genre URL</b>
<input required="required" type="text" name="genre_url" value="'.$set['genre_url'].'" style="margin-bottom:15px"/>
<b>Post Robots Index</b>
<input required="required" type="text" name="post_index" value="'.$set['post_index'].'" style="margin-bottom:15px"/>
<b>Artist Robots Index</b>
<input required="required" type="text" name="artist_index" value="'.$set['artist_index'].'" style="margin-bottom:15px"/>
<b>Genre Robots Index</b>
<input required="required" type="text" name="genre_index" value="'.$set['genre_index'].'" style="margin-bottom:15px"/>
<b>New Post Count</b>
<input required="required" type="number" name="new_post_count" value="'.$set['new_post_count'].'" style="margin-bottom:15px"/>
<b>Post Count</b>
<input required="required" type="number" name="post_count" value="'.$set['post_count'].'" style="margin-bottom:15px"/>
<b>Artist Count</b>
<input required="required" type="number" name="artist_count" value="'.$set['artist_count'].'" style="margin-bottom:15px"/>
<b>Genre Count</b>
<input required="required" type="number" name="genre_count" value="'.$set['genre_count'].'" style="margin-bottom:15px"/>
<b>Upload File</b>';
?>
<select name="post_file" style="margin-bottom:15px">
	<option value="yes" <?php if($set['post_file'] == "yes") echo "selected"; ?>>Upload Manual</option>
	<option value="no"  <?php if($set['post_file'] == "no") echo "selected"; ?>>Eksternal/Youtube Link</option>
</select>
<?php
echo'
<input type="submit" class="btn-submit" name="change" value="Update"></form>
';
}

elseif(isset($_GET['grabber'])){
echo'
<div class="intab">
<a class="tab" href="settings.php">Umum</a>
<a class="tab" href="?post">Post</a>
<div class="tab active-tab">Grabber</div>
<a class="tab" href="?ads">Ads</a>
</div>
';
if(isset($_POST['change'])){
$apikey = input($_POST['apikey']);
$search_url = input($_POST['search_url']);
$download_url = input($_POST['download_url']);
$stream_url = input($_POST['stream_url']);
$download_index = input($_POST['download_index']);
$stream_index = input($_POST['stream_index']);
$search_index = input($_POST['search_index']);
$search_count = input($_POST['search_count']);
$itunes_count = input($_POST['itunes_count']);
$trend_count = input($_POST['trend_count']);
$sitemap_index = input($_POST['sitemap_index']);
$sitemap = input($_POST['sitemap']);
$sitemap_limit = input($_POST['sitemap_limit']);
$auto_search = input($_POST['auto_search']);
$cache = input($_POST['cache']);
$rating = input($_POST['rating']);
$limit_keyword = input($_POST['limit_keyword']);
update('apikey',$apikey);
update('search_url',$search_url);
update('download_url',$download_url);
update('stream_url',$stream_url);
update('download_index',$download_index);
update('stream_index',$stream_index);
update('search_index',$search_index);
update('search_count',$search_count);
update('itunes_count',$itunes_count);
update('trend_count',$trend_count);
update('sitemap_index',$sitemap_index);
update('sitemap',$sitemap);
update('sitemap_limit',$sitemap_limit);
update('auto_search',$auto_search);
update('cache',$cache);
update('rating',$rating);
update('limit_keyword',$limit_keyword);

echo '<div class="alert-success">Grabber berhasil diperbarui.<meta http-equiv="Refresh" content="1; URL=?grabber"></div>';
}
echo '
<form method="post">
<b>Youtube API Key</b> <font color="red">(Tambah boleh, pisah dengan koma. Gak perlu diganti, udah Unlimited)</font>
<input required="required" type="text" name="apikey" value="'.$set['apikey'].'" style="margin-bottom:15px"/>
<b>Search URL</b>
<input required="required" type="text" name="search_url" value="'.$set['search_url'].'" style="margin-bottom:15px"/>
<b>Download URL</b>
<input required="required" type="text" name="download_url" value="'.$set['download_url'].'" style="margin-bottom:15px"/>
<b>Stream URL</b>
<input required="required" type="text" name="stream_url" value="'.$set['stream_url'].'" style="margin-bottom:15px"/>
<b>Search Robots Index</b>
<input required="required" type="text" name="search_index" value="'.$set['search_index'].'" style="margin-bottom:15px"/>
<b>Download Robots Index</b>
<input required="required" type="text" name="download_index" value="'.$set['download_index'].'" style="margin-bottom:15px"/>
<b>Stream Robots Index</b>
<input required="required" type="text" name="stream_index" value="'.$set['stream_index'].'" style="margin-bottom:15px"/>
<b>Search Count</b>
<input required="required" type="number" name="search_count" value="'.$set['search_count'].'" style="margin-bottom:15px"/>
<b>Itunes Count</b>
<input required="required" type="number" name="itunes_count" value="'.$set['itunes_count'].'" style="margin-bottom:15px"/>
<b>Trend Count</b>
<input required="required" type="number" name="trend_count" value="'.$set['trend_count'].'" style="margin-bottom:15px"/>
<b>Sitemap Limit per Page</b>
<input required="required" type="number" name="sitemap_limit" value="'.$set['sitemap_limit'].'" style="margin-bottom:15px"/>
<b>Limit Keywords</b> <font color="red">(Auto hapus semua keyword bila dibatasi)</font>
<input required="required" type="number" name="limit_keyword" placeholder="angka 0 untuk unlimited" value="'.$set['limit_keyword'].'" style="margin-bottom:15px"/>
<b>Sitemap Index URL</b>
<input required="required" type="text" name="sitemap_index" value="'.$set['sitemap_index'].'" style="margin-bottom:15px"/>
<b>Sitemap Paging URL</b>
<input required="required" type="text" name="sitemap" value="'.$set['sitemap'].'" style="margin-bottom:15px"/>
<b>Auto Submit Search to SQL</b>';
?>
<select name="auto_search" style="margin-bottom:15px">
	<option value="yes" <?php if($set['auto_search'] == "yes") echo "selected"; ?>>Ya</option>
	<option value="no"  <?php if($set['auto_search'] == "no") echo "selected"; ?>>Tidak</option>
</select>
<?php
echo'<b>Enable Cache</b> <font color="red">(Beta Version)</font>';
?>
<select name="cache" style="margin-bottom:15px" disabled>
	<option value="yes" <?php if($set['cache'] == "yes") echo "selected"; ?>>Ya</option>
	<option value="no"  <?php if($set['cache'] == "no") echo "selected"; ?>>Tidak</option>
</select>
<?php
echo'<b>Enable Rating</b>';
?>
<select name="rating" style="margin-bottom:15px">
	<option value="yes" <?php if($set['rating'] == "yes") echo "selected"; ?>>Ya</option>
	<option value="no"  <?php if($set['rating'] == "no") echo "selected"; ?>>Tidak</option>
</select>
<?php
echo'
<input type="submit" class="btn-submit" name="change" value="Update"></form>
';
}else{
echo'
<div class="intab">
<div class="tab active-tab">Umum</div>
<a class="tab" href="?post">Post</a>
<a class="tab" href="?grabber">Grabber</a>
<a class="tab" href="?ads">Ads</a>
</div>
';
if(isset($_POST['change'])){
$sitename = input($_POST['sitename']);
$tagline = input($_POST['tagline']);
$home_title = input($_POST['home_title']);
$home_desc = input($_POST['home_desc']);
$keywords = input($_POST['keywords']);
$search_title = input($_POST['search_title']);
$search_desc = input($_POST['search_desc']);
$download_title = input($_POST['download_title']);
$download_desc = input($_POST['download_desc']);
$stream_title = input($_POST['stream_title']);
$stream_desc = input($_POST['stream_desc']);
$email = input($_POST['email']);
$google = input($_POST['google']);
update('sitename',$sitename);
update('tagline',$tagline);
update('home_title',$home_title);
update('home_desc',$home_desc);
update('keywords',$keywords);
update('search_title',$search_title);
update('search_desc',$search_desc);
update('download_title',$download_title);
update('download_desc',$download_desc);
update('stream_title',$stream_title);
update('stream_desc',$stream_desc);
update('email',$email);
update('google',$google);

echo '<div class="alert-success">Pengaturan umum berhasil diperbarui.<meta http-equiv="Refresh" content="1; URL=settings.php"></div>';
}

if(isset($_POST['upload'])){
$nama_file = $_FILES['cover']['name'];
$tipe_file = $_FILES['cover']['type'];
$tmp_file = $_FILES['cover']['tmp_name'];
$sunat = explode(".", strtolower($nama_file));
$ext = array("",end($sunat));
$ext[1] = str_replace('jpeg', 'jpg', $ext[1]);
$ext[1] = str_replace('png', 'jpg', $ext[1]);
$nameid = 'cover.'.$ext[1].'';
$path = "../assets/images/".$nameid;

$errors=array();
if($tipe_file == "" || $tipe_file == "image/jpeg" || $tipe_file == "image/png"){
}else{
	$errors[]='Ekstensi cover harus berupa gambar!';
}
if(empty($errors)){
	move_uploaded_file($tmp_file, $path);
echo '<meta http-equiv="Refresh" content="0; URL=settings.php"></div>';
}
}
if(isset($_POST['upload2'])){
$nama_file = $_FILES['favicon']['name'];
$tipe_file = $_FILES['favicon']['type'];
$tmp_file = $_FILES['favicon']['tmp_name'];
$sunat = explode(".", strtolower($nama_file));
$ext = array("",end($sunat));
$ext[1] = str_replace('jpeg', 'ico', $ext[1]);
$ext[1] = str_replace('jpg', 'ico', $ext[1]);
$ext[1] = str_replace('png', 'ico', $ext[1]);
$nameid = 'favicon.'.$ext[1].'';
$path = "../".$nameid;

$errors=array();
if($tipe_file == "" || $tipe_file == "image/jpeg" || $tipe_file == "image/png"){
}else{
	$errors[]='Ekstensi favicon harus berupa gambar!';
}
if(empty($errors)){
	move_uploaded_file($tmp_file, $path);
echo '<meta http-equiv="Refresh" content="0; URL=settings.php"></div>';
}
}
echo '
<center>
<form method="post" enctype="multipart/form-data" style="padding:10px;display:inline-block;">
<center>-- COVER --</center>
<label class="fileContainer">
	<div style="margin-top:35px;color:#999;">Cover</div>
	<img src="/assets/images/cover.jpg" id="gambar_nodin" width="90px"/>
	<input type="file" name="cover" id="preview_gambar"/>
</label>
<center><input type="submit" style="width:auto;" class="btn-submit" name="upload" value="Upload"></center>
</form>
<form method="post" enctype="multipart/form-data" style="padding:10px;display:inline-block;">
<center>-- FAVICON --</center>
<label class="fileContainer">
	<div style="margin-top:35px;color:#999;">Favicon</div>
	<img src="/favicon.ico" id="gambar_nodin2" width="90px"/>
	<input type="file" name="favicon" id="preview_gambar2"/>
</label>
<center><input type="submit" style="width:auto;" class="btn-submit" name="upload2" value="Upload"></center>
</form>
</center>
<form method="post">
<b>Sitename</b>
<input required="required" type="text" name="sitename" value="'.$set['sitename'].'" style="margin-bottom:15px"/>
<b>Tag Line</b>
<input type="text" name="tagline" value="'.$set['tagline'].'" style="margin-bottom:15px"/>
<b>Email</b> <br>
<input type="text" name="email" value="'.$set['email'].'" style="margin-bottom:15px"/><br>
<b>Google Verify</b>
<input type="text" placeholder="Ex. gcsD9E-yBptQXe85EtdzNBXgKKZwsUTByAoP0c-gbd8" name="google" value="'.$set['google'].'" style="margin-bottom:15px"/><br>
<b>Keywords</b>
<textarea class="text" name="keywords" style="margin-bottom:15px">'.stripslashes($set['keywords']).'</textarea>
<b>Home Title</b>
<input required="required" type="text" name="home_title" value="'.$set['home_title'].'" style="margin-bottom:15px"/>
<b>Home Description</b>
<textarea class="text" name="home_desc" style="margin-bottom:15px">'.stripslashes($set['home_desc']).'</textarea>
<b>Search Title</b>
<input required="required" type="text" name="search_title" value="'.$set['search_title'].'" style="margin-bottom:15px"/>
<b>Search Description</b>
<textarea class="text" name="search_desc" style="margin-bottom:15px">'.stripslashes($set['search_desc']).'</textarea>
<b>Download Title</b>
<input required="required" type="text" name="download_title" value="'.$set['download_title'].'" style="margin-bottom:15px"/>
<b>Download Description</b>
<textarea class="text" name="download_desc" style="margin-bottom:15px">'.stripslashes($set['download_desc']).'</textarea>
<b>Stream Title</b>
<input required="required" type="text" name="stream_title" value="'.$set['stream_title'].'" style="margin-bottom:15px"/>
<b>Stream Description</b>
<textarea class="text" name="stream_desc" style="margin-bottom:15px">'.stripslashes($set['stream_desc']).'</textarea>
<input type="submit" class="btn-submit" name="change" value="Update"></form>
';
?>
<script type="text/javascript">
function bacaGambar(input) {
   if (input.files && input.files[0]) {
      var reader = new FileReader();
 
      reader.onload = function (e) {
          $('#gambar_nodin').attr('src', e.target.result);
      }
 
      reader.readAsDataURL(input.files[0]);
   }
}
$("#preview_gambar").change(function(){
   bacaGambar(this);
});
document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
};
</script>
<script type="text/javascript">
function bacaGambar(input) {
   if (input.files && input.files[0]) {
      var reader = new FileReader();
 
      reader.onload = function (e) {
          $('#gambar_nodin2').attr('src', e.target.result);
      }
 
      reader.readAsDataURL(input.files[0]);
   }
}
$("#preview_gambar2").change(function(){
   bacaGambar(this);
});
document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
};
</script>
<?php
}
 include '../includes/footer.php';
}
 else {
 header('Location: /');
 }
 ?>