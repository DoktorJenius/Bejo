<?php
require '../includes/db.php';
require '../core/functions/connect.php';

if($userlog==1){
  header('Location:index.php');
}else{

  $site_title='Masuk';
  include '../includes/header.php';

  echo '
  <div class="sign-wrap">
	<div class="sign">
	  <div style="text-align:center;padding-bottom:20px;">
		<h2>Masuk</h2>
	  </div>';


	  if(isset($_POST['email']) AND isset($_POST['password'])){
     
		$email=formpost("email");
		$password=formpost("password");
		$user_password=md5($password);
		$errors=array();
		$login_check=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE email='$email'");
		
		if(mysqli_num_rows($login_check)<1){
		  $errors[]='Email tidak ditemukan!';
		}
 
		if(mysqli_num_rows($login_check)>0){
          $login_check2=mysqli_fetch_array($login_check);
          if($login_check2['password']!=$user_password){
			$errors[]='Password salah!';
		  }
		}

		if(strlen($email)<1){
		  $errors[]='Email harus diisi!';
		}

		if(strlen($user_password)<1){
		  $errors[]='Password harus diisi!';
		}

		if(empty($errors)){
		  $_SESSION['email']=$email;
		  $_SESSION['password']=$user_password;
		  header("Location: index.php");
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
	  <form method="post">
		<input class="contect" type="email" name="email" required="required" placeholder="email"/>
		<input class="contect" type="password" name="password"required="required" placeholder="Password"/>
		<button style="width:100%" class="btn-submit href="login.php">Masuk</button>
	  </form>
	</div>
  </div>
  <div style="color:#bbb;padding-bottom:25px">
			  <center>
              bejo<b>Panel</b> v3.0
			  </center>
			</div>
</body>
</html>';
}
?>
