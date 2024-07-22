<?php
require '../includes/db.php';
require '../core/functions/connect.php';
$site_title = 'Tema';
include '../includes/header.php';
if($userlog==1){

if(isset($_GET['go'])){

$tema = $_GET['go'];
$name = str_replace('_', ' ', $tema);
$name = ucwords($name);
$folder = '../themes/'.$tema.'';

if(!($buka_folder = opendir($folder)));

$file_array = array(); 
while($baca_folder = readdir($buka_folder))
 {
  if(substr($baca_folder,0,1) != '.')
   {
     $file_array[] =  $baca_folder;
    }
 }

echo'<div class="box"><div class="title-menu">Tema '.$name.'</div>
<div class="menulist">';

if(isset($_POST['change'])){
$theme = input($_GET['go']);
update('theme',$theme);

echo '<div class="alert-success">Tema berhasil diubah.<meta http-equiv="Refresh" content="1; URL=themes.php"></div>';
}

echo'<form method="post">
<input type="submit" style="width:auto;" class="btn-ku" name="change" value="Gunakan">
</form>
</div>
<div class="menulist">
<div class="kiri"><div class="list-group">';

while(list($index, $nama_file) = each($file_array))
  {
	echo'<a class="list-group-item" href="?go='.$_GET['go'].'&edit='.$nama_file.'">'.$nama_file.'</a>';
  }

closedir($buka_folder);

echo'</div></div>
<div class="kanan">';

echo'<link rel="stylesheet" href="../assets/syntax/lib/codemirror.css">
<script src="../assets/syntax/lib/codemirror.js"></script>
<script src="../assets/syntax/mode/xml/xml.js"></script>';

if(isset($_GET['edit'])){
$file = '../themes/'.$_GET['go'].'/'.$_GET['edit'].'';
}else{
$file = '../themes/'.$_GET['go'].'/home.php';
}

// check if form has been submitted
if (isset($_POST['text']))
{
    // save the text contents
    file_put_contents($file, $_POST['text']);

    // redirect to form again
    //header(sprintf('Location: %s', $url));
    printf('<div class="alert-success">Tema <b>'.$tema.'</b> berhasil diperbarui.</div>', htmlspecialchars($url));
}

// read the textfile
$text = file_get_contents($file);

echo'<form action="" method="post">
<div style="border:1px solid #ddd;margin:5px 0;">
<textarea id="code" class="text" style="height:400px;" name="text">'.htmlspecialchars($text).'</textarea>
</div>
<input type="submit" style="width:auto;" class="btn-submit" value="Update">
<input type="reset" style="width:auto;" class="btn-ku" value="Reset" />
</form>';
?>
<script>
var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
  mode: "application/xml",
  styleActiveLine: true,
  lineNumbers: true,
  lineWrapping: true
});
</script>
<?php
echo'</div>
<div class="clear"></div>
</div></div>';

}
elseif(isset($_GET['add'])){

echo'<div class="box"><div class="title-menu">Tambah Tema</div>
<div class="menulist">';

if(isset($_POST["submit"])){
$file_zip = $_FILES['file_zip']['tmp_name'];
$direktori = "../themes/";
$zip = new ZipArchive;
if ($zip->open($file_zip) === TRUE) {
 $zip->extractTo($direktori);
 $zip->close();
 echo '<div class="alert-success">Tema berhasil ditambah.</div>';
} else {
 echo '<div class="alert-danger">Tema gagal ditambah.</div>';
}
}

echo'<form enctype="multipart/form-data" method="post">
Tema berekstensi .ZIP: <input name="file_zip" type="file" /> 
<input type="submit" name="submit" style="width:auto;" class="btn-submit" value="Upload" />
</form>';

echo'</div></div>';
}
else{

$folder = '../themes';
if(!($buka_folder = opendir($folder)));

$file_array = array(); 
while($baca_folder = readdir($buka_folder))
 {
  if(substr($baca_folder,0,1) != '.')
   {
     $file_array[] =  $baca_folder;
    }
 }

echo'<div class="box"><div class="title-menu">Tema</div>
<div class="menulist"><a href="?add" class="btn-ku">Tambah</a> 
<a target="_blank" href="https://prodeku.blogspot.com/search/label/BejoAGC Themes?&max-results=8" class="btn-info">Koleksi</a></div>
<div class="menulist">';

while(list($index, $nama_file) = each($file_array))
  {
	echo'
	<div class="tabel">
	<div class="kotakku">';
	if($set['theme'] == ''.$nama_file.'') echo "<div class='select'>Terpakai</div>";
	echo'<div class="cover">
		<a href="?go='.$nama_file.'" title="'.ucwords($nama_file).'">
		<img src="/themes/'.$nama_file.'/images/thumbnail.png" alt="'.ucwords($nama_file).'"/>
		</a>
	</div>
	<div class="artist">
		<a href="?go='.$nama_file.'" title="'.ucwords($nama_file).'"><b>'.ucwords($nama_file).'</b></a>
	</div>
	</div>
	</div>';
  }

closedir($buka_folder);
echo'
<div class="clear"></div>
</div></div>';

}


}
else {
header('Location:login.php');
}
include '../includes/footer.php';