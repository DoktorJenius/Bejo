<?php

require '../includes/db.php';
require '../core/functions/connect.php';
require '../core/functions/common.php';
$site_title  ='Halaman';
include '../includes/header.php';

if($adminlog==1){
$aid=formget("id");

if(isset($_GET['create'])){
echo'
<link rel="stylesheet" href="/assets/css/tiny.css" />
<script type="text/javascript" src="/assets/js/tiny.js"></script>

<div class="box"><div class="title-menu">Buat Halaman</div>
<div class="menulist">';

if(isset($_POST["submit"])){

    $title=formpost('title');
	$url=permalink($title);
	$text=input($_POST['text']);

    $errors=array();
	if(strlen($title)<1){
       $errors[]='Harus ada judul!';
      }
	if(strlen($text)<1){
       $errors[]='Harus ada deskripsi!';
      }
	$emch=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM pages WHERE url='$url'");

	if(mysqli_num_rows($emch)>0){
	$errors[]='Judul sudah ada!';
	}
	
    if(empty($errors)){
       $add=mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO pages (title, url, text) VALUES ('$title', '$url', '$text')");
       if($add){
		header('Location:pages.php');
       }
       else {
         echo '<div class="alert-danger">Format yang anda masukkan tidak valid!</div>';
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
echo '
<form method="post" onsubmit="tinyeditor.post()" accept-charset="utf-8">
<input type="text" name="title" placeholder="Judul" required="required" /><br>
<textarea class="text" style="height:300px" name="text" id="post-content" required="required"></textarea><br>
<input type="submit" style="width:auto;" class="btn-submit" name="submit" value="Buat"> <a class="btn-ku" href="pages.php">Batal</a></form>
';
?>
<script type="text/javascript">
  tinyeditor = new TINY.editor.edit('editor', {
    id: 'post-content',
    width: '100%',
    height: 275,
    cssclass: 'te',
    controlclass: 'tecontrol',
    rowclass: 'teheader',
    dividerclass: 'tedivider',
    controls: ['bold', 'italic', 'underline', 'strikethrough', '|', 'subscript', 'superscript', '|', 'orderedlist', 'unorderedlist', '|', 'outdent', 'indent', '|', 'leftalign', 'centeralign', 'rightalign', 'blockjustify', '|', 'unformat', '|', 'undo', 'redo', 'n', 'hr', 'image', 'link', 'unlink', ],
    footer: true,
    fonts: ['Times New Roman', 'Verdana', 'Arial', 'Georgia', 'Courier New', 'Trebuchet MS', 'Comic Sans MS'],
    xhtml: true,
    bodyid: 'editor',
    footerclass: 'tefooter',
    toggle: {
      text: 'Code',
      activetext: 'Preview',
      cssclass: 'toggle'
    },
    resize: {
      cssclass: 'resize'
    }});
</script>
<?php
}
elseif(isset($_GET['edit'])){
echo'
<link rel="stylesheet" href="/assets/css/tiny.css" />
<script type="text/javascript" src="/assets/js/tiny.js"></script>

<div class="box"><div class="title-menu">Edit Halaman</div>
<div class="menulist">';

$edit = $_GET['edit'];
$epages=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM pages WHERE id='$edit'");
$pages=mysqli_fetch_array($epages);

if(isset($_POST["submit"])){

    $title=formpost('title');
	$url=permalink($title);
	$text=input($_POST['text']);

    $errors=array();
	if(strlen($title)<1){
       $errors[]='Harus ada judul!';
      }
	if(strlen($text)<1){
       $errors[]='Harus ada deskripsi!';
      }
	
    if(empty($errors)){
       $add=mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE pages SET title='$title', url='$url', text='$text' WHERE id='$edit'");
	   echo '<div class="alert-success">Halaman berhasil diperbarui.<meta http-equiv="Refresh" content="1; URL=pages.php"></div>';
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
<form method="post" onsubmit="tinyeditor.post()" accept-charset="utf-8">
<input type="text" name="title" value="'.$pages["title"].'" placeholder="Judul" required="required" /><br>
<textarea class="text" style="height:300px" name="text" id="post-content" required="required">'.htmlspecialchars($pages["text"]).'</textarea><br>
<input type="submit" style="width:auto;" class="btn-submit" name="submit" value="Perbarui"> <a class="btn-ku" href="pages.php">Batal</a></form>
';
?>
<script type="text/javascript">
  tinyeditor = new TINY.editor.edit('editor', {
    id: 'post-content',
    width: '100%',
    height: 275,
    cssclass: 'te',
    controlclass: 'tecontrol',
    rowclass: 'teheader',
    dividerclass: 'tedivider',
    controls: ['bold', 'italic', 'underline', 'strikethrough', '|', 'subscript', 'superscript', '|', 'orderedlist', 'unorderedlist', '|', 'outdent', 'indent', '|', 'leftalign', 'centeralign', 'rightalign', 'blockjustify', '|', 'unformat', '|', 'undo', 'redo', 'n', 'hr', 'image', 'link', 'unlink', ],
    footer: true,
    fonts: ['Times New Roman', 'Verdana', 'Arial', 'Georgia', 'Courier New', 'Trebuchet MS', 'Comic Sans MS'],
    xhtml: true,
    bodyid: 'editor',
    footerclass: 'tefooter',
    toggle: {
      text: 'Code',
      activetext: 'Preview',
      cssclass: 'toggle'
    },
    resize: {
      cssclass: 'resize'
    }});
</script>
<?php
}
elseif(isset($_GET['delete'])){
$del = $_GET['delete'];
$idf = mysqli_query($GLOBALS["___mysqli_ston"], "select * from pages where id = '$del'");
if(mysqli_num_rows($idf)>0){
$inf  = mysqli_fetch_assoc($idf);
mysqli_query($GLOBALS["___mysqli_ston"], "delete from pages where id = '$del'");
((mysqli_free_result($idf) || (is_object($idf) && (get_class($idf) == "mysqli_result"))) ? true : false);
header('location: pages.php');
}else{
echo'<script>
 alert("Halaman tidak tersedia!");
</script>';
}
}else{
echo '
<div class="box"><div class="title-menu">Halaman</div>
<div class="menulist"><a href="?create" class="btn-ku">Tambah</a></div>
<div class="menulist"><div class="scroll"><table class="table"><tr>
<th style="text-align:center">#</th>
<th width="80%">Judul</th>
<th style="text-align:center" width="15%">Opsi</th>
</tr>';

$pages=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM pages ORDER BY id DESC LIMIT ".$j.",$hal");
$queryNum = mysqli_query($GLOBALS["___mysqli_ston"], "select id from pages");
if(mysqli_num_rows($queryNum)>0){
$number =1;
$all = mysqli_num_rows($queryNum);
while($show=mysqli_fetch_array($pages)){
echo '
  <tr>
    <td style="text-align:center">'.$show["id"].'</td>
    <td><a href="/'.$show["url"].'" target="_blank">'.$show["title"].'</a></td>
    <td style="text-align:center">
		<a href="?edit='.$show["id"].'" title="Edit Halaman"><span class="label warning"><i class="fa fa-edit"></i></span></a>
		<a href="?delete='.$show["id"].'" title="Hapus Halaman" onclick="javascript: return confirm(\'Hapus Halaman?\')"><span class="label danger"><i class="fa fa-trash"></i></span></a>
	</td>
  </tr>
';
}
echo '</table></div>';

((mysqli_free_result($pages) || (is_object($pages) && (get_class($pages) == "mysqli_result"))) ? true : false);
((mysqli_free_result($queryNum) || (is_object($queryNum) && (get_class($queryNum) == "mysqli_result"))) ? true : false);
paging($all,$page,$hal,'?');
 }else{
echo '</table></div><div class="alert-danger">Belum ada Halaman.</div>';
}
}
 include '../includes/footer.php';
}
 else {
 header('Location: /');
 }
 ?>