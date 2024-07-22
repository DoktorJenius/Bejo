<?php

require '../includes/db.php';
require '../core/functions/connect.php';
require '../core/functions/common.php';
require '../core/functions/general.php';
$site_title  ='DMCA';
include '../includes/header.php';

if($adminlog==1){
$aid=formget("id");

if(isset($_GET['create'])){
echo'
<div class="box"><div class="title-menu">Tambah URL</div>
<div class="menulist">';

if(isset($_POST['url'])){
	$key = $_POST['url'];
    if(strpos($key, "\n")){
        $entries = explode("\n", $key);
    } else {
        $entries = array($key);
    }
	$total = count(explode("\n", $key));
	
    foreach($entries as $e){
		$eTrim = trim($e);
		$query = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO dmca(url)VALUES('$eTrim')");
	}
	echo'<div class="alert-success"><b>'.$total.'</b> url berhasil ditambahkan<meta http-equiv="Refresh" content="2; URL=dmca.php"></div>';
}


echo '
<form method="post">
<div class="alert-info">Pisahkan dengan <b>ENTER</b>.</div>
<textarea class="text" style="height:300px" name="url" required="required"></textarea><br>
NB : url tanpa domain. 
Ex. /download/ed-sheeran-perfect-official-music-video-LS0yVnYtQmZWb3E0Zw <br>
<input type="submit" style="width:auto;" class="btn-submit" name="submit" value="Tambah"> <a class="btn-ku" href="dmca.php">Batal</a>
</form>
';
}
elseif(isset($_GET['delete'])){
$del = $_GET['delete'];
$idf = mysqli_query($GLOBALS["___mysqli_ston"], "select * from dmca where id = '$del'");
if(mysqli_num_rows($idf)>0){
$inf  = mysqli_fetch_assoc($idf);
mysqli_query($GLOBALS["___mysqli_ston"], "delete from dmca where id = '$del'");
((mysqli_free_result($idf) || (is_object($idf) && (get_class($idf) == "mysqli_result"))) ? true : false);
header('location: dmca.php');
}else{
echo'<script>
 alert("Keyword tidak tersedia!");
</script>';
}
}else{
echo '
<div class="box"><div class="title-menu">DMCA Reports</div>
<div class="menulist"><a href="?create" class="btn-ku">Tambah</a></div>
<div class="menulist"><div class="scroll"><table class="table"><tr>
<th width="95%">URL</th>
<th style="text-align:center" width="15%">Opsi</th>
</tr>';

$dmca=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM dmca ORDER BY id DESC LIMIT ".$j.",$hal");
$queryNum = mysqli_query($GLOBALS["___mysqli_ston"], "select id from dmca");
if(mysqli_num_rows($queryNum)>0){
$number =1;
$all = mysqli_num_rows($queryNum);
while($show=mysqli_fetch_array($dmca)){
echo '
  <tr>
    <td>'.site_url().''.$show["url"].'</td>
    <td style="text-align:center">
		<a href="?delete='.$show["id"].'" title="Hapus url" onclick="javascript: return confirm(\'Hapus keyword '.$show["keyword"].'?\')"><span class="label danger"><i class="fa fa-trash"></i></span></a>
	</td>
  </tr>
';
}
echo '</table></div>';

((mysqli_free_result($dmca) || (is_object($dmca) && (get_class($dmca) == "mysqli_result"))) ? true : false);
((mysqli_free_result($queryNum) || (is_object($queryNum) && (get_class($queryNum) == "mysqli_result"))) ? true : false);
paging($all,$page,$hal,'?');
 }else{
echo '</table></div><div class="alert-danger">Belum ada url.</div>';
}
}
 include '../includes/footer.php';
}
 else {
 header('Location: /');
 }
 ?>