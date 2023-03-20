<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		require '_dbconnect.php';
		$loginEmail = $_POST['loginEmail'];
		$loginPassword = $_POST['loginPassword'];

		$sql = "SELECT * FROM `users` WHERE `user_email`='$loginEmail';";
		$sqlResult = mysqli_query($conn,$sql);
		$recordCount = mysqli_num_rows($sqlResult);
		if($recordCount==1){
			$row = mysqli_fetch_assoc($sqlResult);
			if(password_verify($loginPassword,$row['user_password'])){
				session_start();
				$_SESSION['loggedIn']=true;
				$_SESSION['email']=$loginEmail;
				$_SESSION['UserId'] = $row['slno'];
				header('Location: /login-dir/php-forum/index.php?login=true');
				exit();
			}
			else{
				$error = "Password is incorrect";
			}
		}else{
			$error = "User doesn't exist";
		}
		header('Location: /login-dir/php-forum/index.php?login=false&error='.$error);
	}
?>