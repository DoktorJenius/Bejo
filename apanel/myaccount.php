<?php
require '../includes/db.php';
require '../core/functions/connect.php';
require '../core/functions/common.php';
$site_title  ='Akun Saya';
include '../includes/header.php';

if($userlog==1){
$uid=users("id");

echo '<div class="box"><div class="title-menu">Akun Saya</div>
<div class="menulist">';
if(isset($_GET['password'])){
echo'
<div class="intab">
<a class="tab" href="myaccount.php">Profil</a>
<div class="tab active-tab">Password</div>
</div>
';

if(isset($_POST['oldpwd']) AND isset($_POST['newpwd1']) AND isset($_POST['newpwd2'])){
  
  $oldpwd2=formpost("oldpwd");
  $oldpwd=md5($oldpwd2);
  $newpwd1=formpost("newpwd1");
  $newpwd2=formpost("newpwd2");  

  $errors=array();
  
  $check=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE id='$uid'");
  
  if(mysqli_num_rows($check)>0){
     $check2=mysqli_fetch_array($check);
        
     if($check2['password']!=$oldpwd){
       $errors[]='Password lama salah!';
     }
  }
  
  if(strlen($oldpwd)<1){
     $errors[]='Password lama harus di isi!';
  }
  
  if(strlen($newpwd1)<1){
     $errors[]='Password baru harus di isi!';
  }

  if(strlen($newpwd1)<6){
	 $errors[]='Password harus 6 karakter lebih!';
  }
  
  if(strlen($newpwd2)<1){
     $errors[]='Verify Password baru harus di isi!';
  }

  if($newpwd1!=$newpwd2){
     $errors[]='Password baru tidak sama!';
  }


if(empty($errors)){
$newpwd=md5($newpwd1);
$uppwd=mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE users SET password='$newpwd' WHERE id='$uid'");
if($uppwd){
echo '<div class="alert-success">Password berhasil diperbarui.<meta http-equiv="Refresh" content="1; URL=login.php"></div>';
session_destroy();
}else {
echo 'unk';
}
}
else{

echo '<div class="alert-danger">';

foreach($errors as $error){
echo ''.$error.'<br/>';
}
echo '</div>';
}
}
 
echo '
<form method="post">
<b>Password Lama</b>
<input type="password" name="oldpwd" required="required"/>
<b>Password Baru</b>
<input type="password" name="newpwd1" required="required" required="required"/>
<b>Verify Password Baru</b>
<input type="password" name="newpwd2" required="required"/>
<input class="btn-submit" type="submit" value="Update" />
</form>';

}
else{
echo'
<div class="intab">
<div class="tab active-tab">Profil</div>
<a class="tab" href="?password">Password</a>
</div>
';
if(isset($_POST['name']) AND isset($_POST['email']) AND isset($_POST['biodata']) AND isset($_POST['website'])){


$name=formpost("name");
$email=formpost("email");
$biodata=formpost("biodata");
$website=formpost("website");

//Codes
$errors=array();
unset($errors);

//Empty
if(strlen($name)<1){
$errors[]='Nama harus di isi!';
}

if(strlen($email)<1){
$errors[]='Email harus di isi!';
}

if(!preg_match('/^([a-zA-Z0-9_.-]+)\@([a-zA-Z0-9_.-]+)\.([a-zA-Z0-9_.-]+)$/', $email)){
$errors[]='Email tidak valid!';
}

if(empty($errors)){
$akun=mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE users SET name='$name', email='$email', biodata='$biodata', website='$website' WHERE id='$uid'");

echo '<div class="alert-success">Pengaturan umum berhasil diperbarui.<meta http-equiv="Refresh" content="1; URL=myaccount.php"></div>';
}else{

echo '<div class="alert-danger">';

foreach($errors as $error){
echo ''.$error.'<br/>';
}
echo '</div>';
}
}


echo'
<form method="post">
<b>Nama</b>
<input required="required" style="margin-bottom:15px" type="text" name="name" value="'.ucfirst(users("name")).'" required="required" placeholder="Nama Depan">
<b>Email</b>
<input required="required" style="margin-bottom:15px" type="text" name="email" value="'.users("email").'" required="required" placeholder="Email">
<b>Website</b>
<input style="margin-bottom:15px" type="text" name="website" value="'.users("website").'" placeholder="http://">
<b>Biodata</b>
<textarea class="text" name="biodata" style="margin-bottom:15px">'.stripslashes(users("biodata")).'</textarea>
<input class="btn-submit" type="submit" value="Update" />
</form>
';

}
echo'</div></div>';
include '../includes/footer.php';

}

else {

header('Location:/');
}
?>




