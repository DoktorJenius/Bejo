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

if(isset($_GET['delete'])){
$del = $_GET['delete'];
$idf = mysqli_query($GLOBALS["___mysqli_ston"], "select * from genres where id = '$del'");
if(mysqli_num_rows($idf)>0){
$inf  = mysqli_fetch_assoc($idf);
mysqli_query($GLOBALS["___mysqli_ston"], "delete from genres where id = '$del'");
((mysqli_free_result($idf) || (is_object($idf) && (get_class($idf) == "mysqli_result"))) ? true : false);
header('location: genre.php');
}else{
echo'<script>
 alert("Genre tidak tersedia!");
</script>';
}
}else{
echo '
<div class="box"><div class="title-menu">Genre</div>
<div class="intab" style="padding:20px 10px 0;margin:0;">
<a class="tab" href="posts.php">Post</a>
<a class="tab" href="artist.php">Artist</a>
<div class="tab active-tab">Genre</div>
</div>
<div class="menulist">';

if(isset($_POST["submit"])){

    $genre=formpost('genre');
    $errors=array();

    $emch=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM genres WHERE name='$genre'");
	if(mysqli_num_rows($emch)>0){
	$errors[]='Genre sudah ada!';
	}
	if(strlen($genre)<1){
    $errors[]='Form tidak boleh kosong!';
	}

    if(empty($errors)){
       $add=mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO genres(name)VALUES('$genre')");
       if($add){
        echo '<div class="alert-success">Genre berhasil di tambahkan.</div>';
       }
       else {
         echo '<div class="alert-danger">Genre yang anda masukkan tidak valid!</div>';
       }
    }
    else {
    echo '<div class="alert-danger">';
	foreach($errors as $error){
		echo ''.$error.'<br/>';
	}
	echo '</div>';
    }
}

echo'<div class="tabel2">
<form method="post" class="searchform">
<input type="text" name="genre" required="required" class="carian" placeholder="Genre Name"/>
<input type="submit" name="submit" class="klik" value="Tambah"/>
</form>
</div><div class="clear"></div>
</div>
<div class="menulist"><div class="scroll"><table class="table"><tr>
<th style="text-align:center" width="5%">#</th>
<th width="83%">Genre</th>
<th style="text-align:center" width="10%">Opsi</th>
</tr>';

$genres=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM genres ORDER BY id DESC LIMIT ".$j.",$hal");
$queryNum = mysqli_query($GLOBALS["___mysqli_ston"], "select id from genres");
if(mysqli_num_rows($queryNum)>0){
$number =1;
$all = mysqli_num_rows($queryNum);
while($show=mysqli_fetch_array($genres)){
echo '
  <tr>
    <td style="text-align:center">'.$show["id"].'</td>
    <td><a href="'.genre_permalink($show["name"]).'" target="_blank">'.$show["name"].'</a></td>
    <td style="text-align:center">
		<a href="?delete='.$show["id"].'" title="Hapus Genre '.$show["name"].'" onclick="javascript: return confirm(\'Hapus Genre '.$show["name"].'?\')"><span class="label danger"><i class="fa fa-trash"></i></span></a>
	</td>
  </tr>
';
}
echo '</table></div>';

((mysqli_free_result($posts) || (is_object($posts) && (get_class($posts) == "mysqli_result"))) ? true : false);
((mysqli_free_result($queryNum) || (is_object($queryNum) && (get_class($queryNum) == "mysqli_result"))) ? true : false);
paging($all,$page,$hal,'?');
 }else{
echo '</table></div><div class="alert-danger">Belum ada Genre.</div>';
}
}
 include '../includes/footer.php';
}
 else {
 header('Location: /');
 }
 ?>