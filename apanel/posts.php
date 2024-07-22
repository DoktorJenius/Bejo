<?php
require '../includes/db.php';
require '../core/functions/connect.php';

require '../core/functions/general.php';
require '../core/functions/permalinks.php';
require '../core/functions/common.php';
$site_title  ='Manual MP3';
include '../includes/header.php';

if($adminlog==1){
$aid=formget("id");

if(isset($_GET['create'])){
echo'
<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
<div class="box"><div class="title-menu">Buat Postingan</div>
<div class="menulist">';

if(isset($_POST["submit"])){
$cekid = insert('posts');
$ts = users('id');
$nama_file = $_FILES['cover']['name'];
$tipe_file = $_FILES['cover']['type'];
$tmp_file = $_FILES['cover']['tmp_name'];
$sunat = explode(".", strtolower($nama_file));
$ext = array("",end($sunat));
$ext[1] = str_replace('jpeg', 'jpg', $ext[1]);
$ext[1] = str_replace('png', 'jpg', $ext[1]);
$luar = input($_POST['luar']);
if(strlen($luar)<1){
if($tipe_file == ""){
$cover = 'http://'.$_SERVER['HTTP_HOST'].'/assets/images/cover.jpg';
$nameid = 'cover.jpg';
$path = '../assets/images/cover.jpg';
}else{
$nameid = ''.$cekid.'.'.$ext[1].'';
$cover = 'http://'.$_SERVER['HTTP_HOST'].'/data/cover/'.$nameid;
$path = "../data/cover/".$nameid;
}
}else{
$cover = $luar;
}

$nama_file2 = $_FILES['file']['name'];
$tipe_file2 = $_FILES['file']['type'];
$tmp_file2 = $_FILES['file']['tmp_name'];
$sunat2 = explode(".", strtolower($nama_file2));
$ext2 = array("",end($sunat2));
$nameid2 = ''.$cekid.'.'.$ext2[1].'';
$path2 = "../data/mp3/".$nameid2;
$mp3_publisher = ''.$_SERVER['HTTP_HOST'].'';
$mp3_encoded_by = users('name');

$title=formpost('title');
$artist=formpost('artist');
$urlku=permalink($artist.'-'.$title);
$album=formpost('album');
$genre=formpost('genre');
$rilis=formpost('rilis');
$publish=formpost('publish');
$youtube=formpost('youtube');
$lyric=input($_POST['lyric']);
$time=date("Y-m-d");

$errors=array();
if(strlen($title)<1){
    $errors[]='Harus ada judul!';
}
if(strlen($genre)<1){
    $errors[]='Harus ada genre!';
}
$gen=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM genres WHERE name='$genre'");
if(mysqli_num_rows($gen)<1){
	$errors[]='Masukkan Genre yang ada!';
}
$art=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM artists WHERE name='$artist'");
if(mysqli_num_rows($art)<1){
	$errors[]='Masukkan Artist yang ada!';
}
if(strlen($rilis)<1){
    $errors[]='Harus ada tahun rilis!';
}
if($tipe_file == "" || $tipe_file == "image/jpeg" || $tipe_file == "image/png"){
}else{
	$errors[]='Ekstensi cover harus berupa gambar!';
}

if($set['post_file'] == 'yes'){

if($tipe_file2 == ""){
	$errors[]='Tidak ada lagu yang di Upload!';
}

if($tipe_file2 == "audio/mp3"){
}else{
	$errors[]='Ekstensi lagu harus .mp3!';
}
}else{
if(strlen($youtube)<1){
    $errors[]='Eksternal/Youtube Link harus diisi!';
}
}

$emch=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts WHERE title='$title'");
if(mysqli_num_rows($emch)>0){
	$errors[]='Judul sudah ada!';
}
if(empty($errors)){
move_uploaded_file($tmp_file, $path);

$nameid2 = str_replace(DIRECTORY_SEPARATOR,"-X-",$nameid2);
if(move_uploaded_file($tmp_file2,$path2)){
$path2 = "../data/mp3/".$nameid2;
$size = fsize(filesize($path2));        
$mp3_tagformat = 'UTF-8';
require_once('../plugin/getid3/getid3.php');
$mp3_handler = new getID3;
$mp3_handler->setOption(array('encoding'=>$mp3_tagformat));
require_once('../plugin/getid3/write.php'); 
$mp3_writter = new getid3_writetags;
$mp3_writter->filename       = $path2;
$mp3_writter->tagformats     = array('id3v1', 'id3v2.3');
$mp3_writter->overwrite_tags = true;
$mp3_writter->tag_encoding   = $mp3_tagformat;
$mp3_writter->remove_other_tags = true;
$mp3_data['title'][]   = $title;
$mp3_data['artist'][]  = $artist;
$mp3_data['album'][]   = $album;
$mp3_data['year'][]    = $rilis;
$mp3_data['genre'][]   = $genre;
$mp3_data['publisher'][] = $mp3_publisher;
$mp3_data['encoded_by'][] = $mp3_encoded_by;
$mp3_data['attached_picture'][0]['data'] = file_get_contents($path);
$mp3_data['attached_picture'][0]['picturetypeid'] = 'image/jpeg';
$mp3_data['attached_picture'][0]['description'] = $nameid;
$mp3_data['attached_picture'][0]['mime'] = 'image/jpeg';

$mp3_writter->tag_data = $mp3_data;
$mp3_writter->WriteTags();
}

$add=mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO posts (title, url, userid, artist, album, genre, rilis, time, publish, yt, lyric, cover) VALUES ('$title', '$urlku', '$ts', '$artist', '$album', '$genre', '$rilis', '$time', '$publish', '$youtube', '$lyric', '$cover')");
	if($add){
		header('Location:posts.php');
    }else{
        echo '<div class="alert-danger">Format yang anda masukkan tidak valid!</div>';
    }
}else {
    echo '<div class="alert-danger">';
	foreach($errors as $error){
		echo ''.$error.'<br/>';
	}
	echo '</div>';
}
}

echo '
<form method="post" enctype="multipart/form-data" accept-charset="utf-8">
<label class="fileContainer" style="margin-bottom:20px">
	<div style="margin-top:35px;color:#999;">Cover</div>
	<img src="" id="gambar_nodin" width="90px"/>
	<input type="file" name="cover" id="preview_gambar"/>
</label>
<div style="padding:4px 0 18px;text-align:center;color:#999;">OR</div>
<input type="text" name="luar" placeholder="Link Cover Ex. http://domain.com/cover.png" /><br>
<hr style="margin-top:15px;margin-bottom:15px;">
<input type="text" name="title" placeholder="Title" required="required" /><br>
<input type="text" id="daftar_artist" name="artist" placeholder="Artist" required="required" /><br>
<input type="text" id="daftar_genre" name="genre" placeholder="Genre" required="required" /><br>
<select name="rilis" required="required">
	<option value="">- Release Year -</option>';
	for($d=date('Y');$d>=1960;$d--) 
echo'<option value="'.$d.'">'.$d.'</option>';
echo'</select><br>
<input type="text" name="album" placeholder="Album" required="required" /><br>';
?>
<div id="show" onclick="document.getElementById('show').style.display='none';document.getElementById('hide').style.display='block';document.getElementById('konten').style.display='block'">Add Lyric ...</div>
<div style="display:none" id="hide" onclick="document.getElementById('hide').style.display='none';document.getElementById('show').style.display='block';document.getElementById('konten').style.display='none'">Add Lyric ...</div>
<?php
echo'<div style="display:none" id="konten">
<textarea name="lyric" required="required"></textarea>
</div>';
if($set['post_file'] == 'yes'){
	echo'<div class="upfile">
		<input id="uploadFile" class="upil" placeholder="Upload lagu disini"/>
		<input id="uploadBtn" name="file" type="file"/>
	</div>';
}else{
	echo'<input type="text" id="youtube" name="youtube" placeholder="https://www.youtube.com/watch?v=ID atau http://domain/judul-lagu.mp3" required="required" /><br>';
}
echo'
<input type="submit" style="width:auto;" class="btn-submit" name="submit" value="Buat"> 
<a class="btn-ku" href="posts.php">Batal</a>
</form>
';
?>
<script>
  CKEDITOR.replace( 'lyric' );
</script>
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
<?php
}
elseif(isset($_GET['edit'])){
echo'
<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
<div class="box"><div class="title-menu">Edit Postingan</div>
<div class="menulist">';

$edit = $_GET['edit'];
$eposts=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts WHERE id='$edit'");
$posts=mysqli_fetch_array($eposts);

if(isset($_POST["submit"])){
$ts = users('id');
$nama_file = $_FILES['cover']['name'];
$tipe_file = $_FILES['cover']['type'];
$tmp_file = $_FILES['cover']['tmp_name'];
$sunat = explode(".", strtolower($nama_file));
$ext = array("",end($sunat));
$ext[1] = str_replace('jpeg', 'jpg', $ext[1]);
$ext[1] = str_replace('png', 'jpg', $ext[1]);
$luar = input($_POST['luar']);
if(strlen($luar)<1){
if($tipe_file == ""){
$cover = 'http://'.$_SERVER['HTTP_HOST'].'/assets/images/cover.jpg';
$nameid = 'cover.jpg';
$path = '../assets/images/cover.jpg';
}else{
$nameid = ''.$edit.'.'.$ext[1].'';
$cover = 'http://'.$_SERVER['HTTP_HOST'].'/data/cover/'.$nameid;
$path = "../data/cover/".$nameid;
}
}else{
$cover = $luar;
}

$nama_file2 = $_FILES['file']['name'];
$tipe_file2 = $_FILES['file']['type'];
$tmp_file2 = $_FILES['file']['tmp_name'];
$sunat2 = explode(".", strtolower($nama_file2));
$ext2 = array("",end($sunat2));
$nameid2 = ''.$edit.'.'.$ext2[1].'';
$path2 = "../data/mp3/".$nameid2;
$mp3_publisher = ''.$_SERVER['HTTP_HOST'].'';
$mp3_encoded_by = users('name');

$title=formpost('title');
$artist=formpost('artist');
$urlku=permalink($artist.'-'.$title);
$album=formpost('album');
$genre=formpost('genre');
$rilis=formpost('rilis');
$publish=formpost('publish');
$youtube=formpost('youtube');
$lyric=input($_POST['lyric']);
$time=date("Y-m-d");

$errors=array();
if(strlen($title)<1){
    $errors[]='Harus ada judul!';
}
if(strlen($genre)<1){
    $errors[]='Harus ada genre!';
}
if(strlen($rilis)<1){
    $errors[]='Harus ada tahun rilis!';
}
if($tipe_file == "" || $tipe_file == "image/jpeg" || $tipe_file == "image/png"){
}else{
	$errors[]='Ekstensi cover harus berupa gambar!';
}

if($set['post_file'] == 'yes'){

if($tipe_file2 == "" || $tipe_file2 == "audio/mp3"){
}else{
	$errors[]='Ekstensi lagu harus .mp3!';
}
}else{
	if(strlen($youtube)<1){
    $errors[]='Eksternal/Youtube Link harus diisi!';
}
}
	
if(empty($errors)){
	move_uploaded_file($tmp_file, $path);

$nameid2 = str_replace(DIRECTORY_SEPARATOR,"-X-",$nameid2);
if(move_uploaded_file($tmp_file2,$path2)){
$path2 = "../data/mp3/".$nameid2;
$size = fsize(filesize($path2));        
$mp3_tagformat = 'UTF-8';
require_once('../plugin/getid3/getid3.php');
$mp3_handler = new getID3;
$mp3_handler->setOption(array('encoding'=>$mp3_tagformat));
require_once('../plugin/getid3/write.php'); 
$mp3_writter = new getid3_writetags;
$mp3_writter->filename       = $path2;
$mp3_writter->tagformats     = array('id3v1', 'id3v2.3');
$mp3_writter->overwrite_tags = true;
$mp3_writter->tag_encoding   = $mp3_tagformat;
$mp3_writter->remove_other_tags = true;
$mp3_data['title'][]   = $title;
$mp3_data['artist'][]  = $artist;
$mp3_data['album'][]   = $album;
$mp3_data['year'][]    = $rilis;
$mp3_data['genre'][]   = $genre;
$mp3_data['publisher'][] = $mp3_publisher;
$mp3_data['encoded_by'][] = $mp3_encoded_by;
$mp3_data['attached_picture'][0]['data'] = file_get_contents($path);
$mp3_data['attached_picture'][0]['picturetypeid'] = 'image/jpeg';
$mp3_data['attached_picture'][0]['description'] = $nameid;
$mp3_data['attached_picture'][0]['mime'] = 'image/jpeg';

$mp3_writter->tag_data = $mp3_data;
$mp3_writter->WriteTags();
}
    $add=mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE posts SET title='$title', url='$urlku', artist='$artist', album='$album', genre='$genre', rilis='$rilis', publish='$publish', yt='$youtube', time='$time', lyric='$lyric', cover='$cover' WHERE id='$edit'");
	echo '<div class="alert-success">Postingan berhasil diperbarui.<meta http-equiv="Refresh" content="1; URL=posts.php"></div>';
}
else {
    echo '<div class="alert-danger">';
	foreach($errors as $error){
		echo ''.$error.'<br/>';
	}
	echo '</div>';
}
}
echo '
<form method="post" enctype="multipart/form-data" accept-charset="utf-8">
<label class="fileContainer" style="margin-bottom:20px">
	<div style="margin-top:35px;color:#999;">Cover</div>
	<img src="'.$posts["cover"].'" id="gambar_nodin" width="90px"/>
	<input type="file" name="cover" id="preview_gambar"/>
</label>
<div style="padding:4px 0 18px;text-align:center;color:#999;">OR</div>
<input type="text" name="luar" value="'.$posts["cover"].'" placeholder="Link Cover Ex. http://domain.com/thumb.png" /><br>
<hr style="margin-top:15px;margin-bottom:15px;">
<input type="text" name="title" value="'.$posts["title"].'" placeholder="Title" required="required" /><br>
<input type="text" name="artist" value="'.$posts["artist"].'" placeholder="Artist" required="required" /><br>
<input type="text" name="genre" value="'.$posts["genre"].'" placeholder="Genre" required="required" /><br>
<select name="rilis" required="required">
	<option value="">- Release Year -</option>
	<option value="'.$posts["rilis"].'" selected>'.$posts["rilis"].'</option>';
	for($d=date('Y');$d>=1960;$d--) 
	echo'<option value="'.$d.'">'.$d.'</option>';
echo'</select><br>
<input type="text" name="album" value="'.$posts["album"].'" placeholder="Album" required="required" /><br>';
?>
<div id="show" onclick="document.getElementById('show').style.display='none';document.getElementById('hide').style.display='block';document.getElementById('konten').style.display='block'">Add Lyric ...</div>
<div style="display:none" id="hide" onclick="document.getElementById('hide').style.display='none';document.getElementById('show').style.display='block';document.getElementById('konten').style.display='none'">Add Lyric ...</div>
<?php
echo'<div style="display:none" id="konten">
<textarea name="lyric" required="required">'.$posts["lyric"].'</textarea>
</div>';
if($set['post_file'] == 'yes'){
	echo'<div class="upfile">
		<input id="uploadFile" class="upil" placeholder="Upload lagu disini"/>
		<input id="uploadBtn" name="file" type="file"/>
	</div>';
}else{
	echo'<input type="text" id="youtube" name="youtube" value="'.$posts["yt"].'" placeholder="Youtube ID (Ex. 8g_wa06LlCA)" /><br>';
}
echo'<input type="submit" style="width:auto;" class="btn-submit" name="submit" value="Perbarui"> 
<a class="btn-ku" href="posts.php">Batal</a></form>
';
?>
<script>
  CKEDITOR.replace( 'lyric' );
</script>
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
<?php
}
elseif(isset($_GET['delete'])){
$del = $_GET['delete'];
unlink('../data/cover/'.$del.'.jpg');
unlink('../data/mp3/'.$del.'.mp3');
$idf = mysqli_query($GLOBALS["___mysqli_ston"], "select * from posts where id = '$del'");
if(mysqli_num_rows($idf)>0){
$inf  = mysqli_fetch_assoc($idf);
mysqli_query($GLOBALS["___mysqli_ston"], "delete from posts where id = '$del'");
((mysqli_free_result($idf) || (is_object($idf) && (get_class($idf) == "mysqli_result"))) ? true : false);
header('location: posts.php');
}else{
echo'<script>
 alert("Postingan tidak tersedia!");
</script>';
}
}elseif(isset($_GET['search'])){
	
$q = $_GET['search'];
echo '
<div class="box"><div class="title-menu">Postingan</div>
<div class="intab" style="padding:20px 10px 0;margin:0;">
<div class="tab active-tab">Post</div>
<a class="tab" href="artist.php">Artist</a>
<a class="tab" href="genre.php">Genre</a>
</div>
<div class="menulist">
<div class="tabel2" style="text-align:left;">
<a href="?create" class="btn-ku">Tambah</a>
</div>
<div class="tabel2">
<form method="get" action="" class="searchform">
<input type="text" class="carian" name="search" placeholder="'.$q.'"/>
<input type="submit" class="klik" value="Search"/>
</form>
</div><div class="clear"></div>
</div>
<div class="menulist"><div class="scroll"><table class="table"><tr>
<th style="text-align:center" width="5%">#</th>
<th width="73%">Judul</th>
<th width="12%" style="text-align:center">Publikasi</th>
<th style="text-align:center" width="10%">Opsi</th>
</tr>';
if (strlen($q) == 3){
	$qq = $q;
	$search = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts where title LIKE '%".$qq."%' OR artist LIKE '%".$qq."%' ORDER BY id DESC LIMIT  ".$j.",$hal");
	$queryNum = mysqli_query($GLOBALS["___mysqli_ston"], "select id from posts WHERE title LIKE '%".$qq."%' OR artist LIKE '%".$qq."%'");
	}else{
	$q3 = str_replace(' ', ' +', $q);
	$qq = '+'.$q3;
	$search = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * 
                  FROM posts 
                  WHERE MATCH ( title, artist ) 
                  AGAINST ('".$qq."' IN BOOLEAN MODE) ORDER BY id DESC LIMIT  ".$j.",$hal");
	$queryNum = mysqli_query($GLOBALS["___mysqli_ston"], "select id from posts WHERE MATCH ( title, artist ) 
                  AGAINST ('".$qq."' IN BOOLEAN MODE)");
}
if(mysqli_num_rows($queryNum)>0){
$number =1;
$all = mysqli_num_rows($queryNum);
while($show=mysqli_fetch_array($search)){
echo '
  <tr>
    <td style="text-align:center">'.$show["id"].'</td>
    <td><a href="'.file_permalink($show["id"], $show["artist"], $show["title"]).'" target="_blank"><b>'.$show["title"].'</b></a><br>
	<a href="'.artist_permalink($show["artist"]).'" target="_blank"><i>'.$show["artist"].'</i></a></td>
    <td style="text-align:center">'.$show["time"].'</td>
    <td style="text-align:center">
		<a href="?edit='.$show["id"].'" title="Edit Postingan"><span class="label warning"><i class="fa fa-edit"></i></span></a><a href="?delete='.$show["id"].'" title="Hapus lagu '.$show["artist"].' - '.$show["title"].'" onclick="javascript: return confirm(\'Hapus lagu '.$show["artist"].' - '.$show["title"].'?\')"><span class="label danger"><i class="fa fa-trash"></i></span></a>
	</td>
  </tr>
';
}
echo '</table></div>';

((mysqli_free_result($posts) || (is_object($posts) && (get_class($posts) == "mysqli_result"))) ? true : false);
((mysqli_free_result($queryNum) || (is_object($queryNum) && (get_class($queryNum) == "mysqli_result"))) ? true : false);
paging($all,$page,$hal,'posts.php?search='.$q.'&');
 }else{
echo '</table></div><div class="alert-danger">Belum ada Postingan.</div>';
}
}else{
echo '
<div class="box"><div class="title-menu">Postingan</div>
<div class="intab" style="padding:20px 10px 0;margin:0;">
<div class="tab active-tab">Post</div>
<a class="tab" href="artist.php">Artist</a>
<a class="tab" href="genre.php">Genre</a>
</div>
<div class="menulist">
<div class="tabel2" style="text-align:left;">
<a href="?create" class="btn-ku">Tambah</a>
</div>
<div class="tabel2">
<form method="get" action="" class="searchform">
<input type="text" class="carian" name="search" placeholder="Search Title / Artist ..."/>
<input type="submit" class="klik" value="Search"/>
</form>
</div><div class="clear"></div>
</div>
<div class="menulist"><div class="scroll"><table class="table"><tr>
<th style="text-align:center" width="5%">#</th>
<th width="63%">Judul</th>
<th width="12%" style="text-align:center">Publikasi</th>
<th width="10%" style="text-align:center">Hits</th>
<th style="text-align:center" width="10%">Opsi</th>
</tr>';

$posts=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts ORDER BY id DESC LIMIT ".$j.",$hal");
$queryNum = mysqli_query($GLOBALS["___mysqli_ston"], "select id from posts");
if(mysqli_num_rows($queryNum)>0){
$number =1;
$all = mysqli_num_rows($queryNum);
while($show=mysqli_fetch_array($posts)){
echo '
  <tr>
    <td style="text-align:center">'.$show["id"].'</td>
    <td><a href="'.file_permalink($show["id"], $show["artist"], $show["title"]).'" target="_blank"><b>'.$show["title"].'</b></a>';
	if($show['lyric'] == ''){}else{echo'<i> with Lyric</i>';}
	echo'<br>
	<a href="'.artist_permalink($show["artist"]).'" target="_blank"><i>'.$show["artist"].'</i></a></td>
    <td style="text-align:center">'.$show["time"].'</td>
	<td style="text-align:center">'.$show["listen"].'</td>
    <td style="text-align:center">
		<a href="?edit='.$show["id"].'" title="Edit Postingan"><span class="label warning"><i class="fa fa-edit"></i></span></a><a href="?delete='.$show["id"].'" title="Hapus lagu '.$show["artist"].' - '.$show["title"].'" onclick="javascript: return confirm(\'Hapus lagu '.$show["artist"].' - '.$show["title"].'?\')"><span class="label danger"><i class="fa fa-trash"></i></span></a>
	</td>
  </tr>
';
}
echo '</table></div>';

((mysqli_free_result($posts) || (is_object($posts) && (get_class($posts) == "mysqli_result"))) ? true : false);
((mysqli_free_result($queryNum) || (is_object($queryNum) && (get_class($queryNum) == "mysqli_result"))) ? true : false);
paging($all,$page,$hal,'?');
 }else{
echo '</table></div><div class="alert-danger">Belum ada Postingan.</div>';
}
}
?>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script>
$(function() {
  $( "#daftar_artist" ).autocomplete({
    source: '/assets/autocomplete/artist.php'
  });
  $( "#daftar_genre" ).autocomplete({
    source: '/assets/autocomplete/genre.php'
  });
});
</script>
<?php
 include '../includes/footer.php';
}
 else {
 header('Location: /');
 }
 ?>