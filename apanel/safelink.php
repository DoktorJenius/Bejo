<?php

require '../includes/db.php';
require '../core/functions/connect.php';
require '../core/functions/common.php';
$site_title  ='Safelink';
include '../includes/header.php';

if($adminlog==1){
	$aid=formget("id");

if(isset($_GET['downloader'])){
echo'<div class="box"><div class="title-menu">Template Downloader</div>
<div class="menulist">
	<div class="intab">
		<a class="tab" href="safelink.php">Safelink</a>
		<a class="tab" href="?template">Template</a>
		<div class="tab active-tab">Downloader</div>
	</div>';

echo'<link rel="stylesheet" href="../assets/syntax/lib/codemirror.css">
<script src="../assets/syntax/lib/codemirror.js"></script>
<script src="../assets/syntax/mode/xml/xml.js"></script>';

$file = '../assets/download.php';

// check if form has been submitted
if (isset($_POST['text']))
{
    // save the text contents
    file_put_contents($file, $_POST['text']);

    // redirect to form again
    //header(sprintf('Location: %s', $url));
    printf('<div class="alert-success">Template downloader berhasil diperbarui.</div>', htmlspecialchars($url));
}

// read the textfile
$text = file_get_contents($file);

echo'<form action="" method="post">
<div style="border:1px solid #ddd;margin:5px 0;">
<textarea id="code" class="text" style="height:400px;" name="text">'.htmlspecialchars($text).'</textarea>
</div>
<input type="submit" style="width:auto;" class="btn-submit" value="Update">
<input type="reset" style="width:auto;" class="btn-ku" value="Reset">
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
echo'</div></div>';

}elseif(isset($_GET['go'])){

$tema = $_GET['go'];
$name = str_replace('_', ' ', $tema);
$name = ucwords($name);
$folder = '../safelink/'.$tema.'';

if(!($buka_folder = opendir($folder)));

$file_array = array(); 
while($baca_folder = readdir($buka_folder))
 {
  if(substr($baca_folder,0,1) != '.')
   {
     $file_array[] =  $baca_folder;
    }
 }

echo'<div class="box"><div class="alert-info"><b>Tips Adsense:</b><br>
Download template safelink ini, kemudian ekstrak langsung di direktori utama (public_html) pada <b>domain</b> baru. Insyallah aman banned.</div></div>';
echo'<div class="box"><div class="title-menu">Template Safelink '.$name.'</div>
<div class="menulist">';

if(isset($_POST['change'])){
$safelink_theme = input($_GET['go']);
update('safelink_theme',$safelink_theme);

echo '<div class="alert-success">Template safelink berhasil diubah.<meta http-equiv="Refresh" content="1; URL=safelink.php?template"></div>';
}

echo'<form method="post">
<input type="submit" style="width:auto;" class="btn-ku" name="change" value="Gunakan">
<a href="?zip='.$tema.'" class="btn-info" style="float:right">Download</a>
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
$file = '../safelink/'.$_GET['go'].'/'.$_GET['edit'].'';
}else{
$file = '../safelink/'.$_GET['go'].'/index.php';
}

// check if form has been submitted
if (isset($_POST['text']))
{
    // save the text contents
    file_put_contents($file, $_POST['text']);

    // redirect to form again
    //header(sprintf('Location: %s', $url));
    printf('<div class="alert-success">Template safelink <b>'.$tema.'</b> berhasil diperbarui.</div>', htmlspecialchars($url));
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

}elseif(isset($_GET['zip'])){

$tema = $_GET['zip'];
$folder = '../safelink/'.$tema.'';
$zipname = ''.$tema.'.zip';
$zip = new ZipArchive;
if ($zip->open($zipname, ZipArchive::CREATE) === TRUE) {
  	//point 1
	if ($handle = opendir($folder))     
  	{
		while (false !== ($entry = readdir($handle))) 
		{
  	                                	//point 3             
			if ($entry != "." && $entry != ".." && !is_dir($folder.'/' . $entry))
			{
				//point 4  
				$zip->addFile($entry);             
			} 
		}
		closedir($handle);
 
 
	}
	$zip->close(); 
}
/* download file jika eksis*/
if(file_exists($zipname)){
$namezip = ''.$tema.'.zip';
header('Content-Type: application/zip');
header('Content-disposition: attachment;  filename='.$namezip);
header('Content-Length: ' . filesize($zipname));
readfile($zipname);
unlink($zipname);
 
} else{
$error = "Proses mengkompresi file gagal  ";
} //end of if file_exist


}elseif(isset($_GET['template'])){
	
$folder = '../safelink';
if(!($buka_folder = opendir($folder)));

$file_array = array(); 
while($baca_folder = readdir($buka_folder))
 {
  if(substr($baca_folder,0,1) != '.')
   {
     $file_array[] =  $baca_folder;
    }
 }

echo'
<div class="box">
    <div class="title-menu">Template</div>
	<div class="menulist">
	<div class="intab">
		<a class="tab" href="safelink.php">Safelink</a>
		<div class="tab active-tab">Template</div>
		<a class="tab" href="?downloader">Downloader</a>
	</div>';

while(list($index, $nama_file) = each($file_array))
  {
	echo'
	<div class="tabel">
	<div class="kotakku">';
	if($set['safelink_theme'] == ''.$nama_file.'') echo "<div class='select'>Terpakai</div>";
	echo'<div class="cover">
		<a href="?go='.$nama_file.'" title="'.ucwords($nama_file).'">
		<img src="/safelink/'.$nama_file.'/images/thumbnail.png" alt="'.ucwords($nama_file).'"/>
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

}else{
?>
<div class="box">
    <div class="title-menu">Safelink</div>
	<div class="menulist">
	<div class="intab">
		<div class="tab active-tab">Safelink</div>
		<a class="tab" href="?template">Template</a>
		<a class="tab" href="?downloader">Downloader</a>
	</div>
	<div class="alert-info"><b>Tips:</b><br>
	Masukkan url safelink eksternal kamu disini, eksternal safelink kamu wajib menggunakan <b>base64</b>.<br>
	<b>Contoh:</b> <u>http://domain.com/benefits-of-consumption/</u>
	</div><br>

	<?php
	if(isset($_POST['change'])){
		$safelink = input($_POST['safelink']);
		$safelink_url = input($_POST['safelink_url']);
		update('safelink',$safelink);
		update('safelink_url',$safelink_url);
		echo '<div class="alert-success">Safelink berhasil diperbarui.<meta http-equiv="Refresh" content="1; URL=safelink.php"></div>';
	} ?>
	<form method="post">
		<label class="switch">
		<?php if($set['safelink'] == 'yes'){ ?>
			<input type="checkbox" value="no" name="safelink" <?php if($set['safelink'] == "yes") echo " checked"; ?>>
		<?php }else{ ?>
			<input type="checkbox" value="yes" name="safelink" <?php if($set['safelink'] == "yes") echo " checked"; ?>>
		<?php } ?>
		<div class="slider round"></div>
		</label>
		URL Safelink: <br>
		<input type="text" name="safelink_url" placeholder="http://" value="<?php echo $set['safelink_url'];?>" style="margin-bottom:15px">
		<input type="submit" class="btn-submit" name="change" value="Update">
	</form>
	</div>
</div>
<?php
}
 include '../includes/footer.php';
}
 else {
 header('Location: /');
 }
?>