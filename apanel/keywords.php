<?php

require '../includes/db.php';
require '../core/functions/connect.php';
require '../core/functions/common.php';

if($adminlog==1){
$aid=formget("id");

if(isset($_GET['create'])){
$site_title  ='Kata Kunci';
include '../includes/header.php';

echo'
<div class="box"><div class="title-menu">Tambah Kata Kunci</div>
<div class="menulist">';

if(isset($_POST['keyword'])){
	$key = strtolower($_POST['keyword']);
    if(strpos($key, "\n")){
        $entries = explode("\n", $key);
    } else {
        $entries = array($key);
    }
	$total = count(explode("\n", $key));
	
    foreach($entries as $e){
		$eTrim = trim($e);
		$query = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO keywords(keyword)VALUES('$eTrim')");
	}
	echo'<div class="alert-success"><b>'.$total.'</b> Kata kunci berhasil ditambahkan<meta http-equiv="Refresh" content="2; URL=keywords.php"></div>';
}


echo '
<form method="post">
<div class="alert-info">Pisahkan dengan <b>ENTER</b>.</div>
<textarea class="text" style="height:300px" name="keyword" required="required"></textarea><br>
<input type="submit" style="width:auto;" class="btn-submit" name="submit" value="Tambah"> <a class="btn-ku" href="keywords.php">Batal</a>
</form>
';
include '../includes/footer.php';
}
elseif(isset($_GET['delete'])){
$del = $_GET['delete'];
$idf = mysqli_query($GLOBALS["___mysqli_ston"], "select * from keywords where id = '$del'");
if(mysqli_num_rows($idf)>0){
$inf  = mysqli_fetch_assoc($idf);
mysqli_query($GLOBALS["___mysqli_ston"], "delete from keywords where id = '$del'");
((mysqli_free_result($idf) || (is_object($idf) && (get_class($idf) == "mysqli_result"))) ? true : false);
header('location: keywords.php');
}else{
echo'<script>
 alert("Kata kunci tidak tersedia!");
</script>';
}
}elseif(isset($_GET['reset'])){
$del = $_GET['reset'];
mysqli_query($GLOBALS["___mysqli_ston"], "delete from keywords");
header('location: keywords.php');
}else{
$site_title  ='Kata Kunci';
include '../includes/header.php';

echo '
<div class="box"><div class="title-menu">Kata kunci</div>
<div class="menulist">
<a href="?create" class="btn-ku">Tambah</a>
<a href="?reset" class="btn-danger" style="float:right" onclick="javascript: return confirm(\'Anda yakin untuk reset keywords?\')">Reset</a>
<a href="?export" class="btn-info" style="float:right">Export</a>
</div>
<div class="menulist"><div class="scroll"><table class="table"><tr>
<th width="95%">Kata Kunci</th>
<th style="text-align:center" width="15%">Opsi</th>
</tr>';

$keywords=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM keywords ORDER BY id DESC LIMIT ".$j.",$hal");
$queryNum = mysqli_query($GLOBALS["___mysqli_ston"], "select id from keywords");
if(mysqli_num_rows($queryNum)>0){
$all = mysqli_num_rows($queryNum);
while($show=mysqli_fetch_array($keywords)){
echo '
  <tr>
    <td>'.$show["keyword"].'</td>
    <td style="text-align:center">
		<a href="?delete='.$show["id"].'" title="Hapus keyword" onclick="javascript: return confirm(\'Hapus kata kunci '.$show["keyword"].'?\')"><span class="label danger"><i class="fa fa-trash"></i></span></a>
	</td>
  </tr>
';
}
echo '</table></div>';

((mysqli_free_result($keywords) || (is_object($keywords) && (get_class($keywords) == "mysqli_result"))) ? true : false);
((mysqli_free_result($queryNum) || (is_object($queryNum) && (get_class($queryNum) == "mysqli_result"))) ? true : false);
paging($all,$page,$hal,'?');
 }else{
echo '</table></div><div class="alert-danger">Belum ada kata kunci.</div>';
}

include '../includes/footer.php';
}
}
else {
 header('Location: /');
}
if(isset($_GET['export'])){
$file = 'keywords.txt';
header("Content-type: text/plain");
header("Content-Disposition: attachment; filename=".$file);
$query = mysqli_query($GLOBALS["___mysqli_ston"], "select keyword from keywords");
while($data = mysqli_fetch_array($query))
{
	echo $data['keyword']."\r\n";
}
}
 ?>