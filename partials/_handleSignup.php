<?php
	$error = "";
	if($_SERVER['REQUEST_METHOD']=='POST'){
		require '_dbconnect.php';
		$email = $_POST['signupEmail'];
		$password = $_POST['signupPassword'];
		$cpassword = $_POST['signupCpassword'];

		$sql = "SELECT * FROM `users` WHERE `user_email`='$email';";
		$sqlResult = mysqli_query($conn,$sql);
		$numOfUsers = mysqli_num_rows($sqlResult);
		echo $numOfUsers;
		if($numOfUsers>0){
			$error = "User already exist";
		}else{
			if($password == $cpassword){
				$passwdHash = password_hash($password,PASSWORD_DEFAULT);
				$sql = "INSERT INTO `users`(`user_email`,`user_password`,`tstamp`) VALUES ('$email','$passwdHash',current_timestamp());";
				$sqlResult = mysqli_query($conn,$sql);
				if($sqlResult){
					header('location: /login-dir/php-forum/index.php?signUp=true');
					exit();
				}
			}else{
				$error = "Passwords do not match";
			}
			
		}
		header('location: /login-dir/php-forum/index.php?signUp=false&error='.$error);
	}
?>