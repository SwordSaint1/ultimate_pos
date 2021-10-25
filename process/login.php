<?php
 include 'conn.php';
 session_start();
 if (isset($_POST['login_btn'])) {
 	$username = $_POST['username'];
 	$password = $_POST['password'];
 	if (empty($username)) {
 		echo 'Please Enter Username';
 	}else if(empty($password)){
 		echo 'Please Enter Password';
 	}else{

 		$check = "SELECT id FROM users WHERE BINARY username = '$username' AND BINARY password = '$password'";
 		$stmt = $conn->prepare($check);
 		$stmt->execute();
 		if ($stmt->rowCount() > 0) {
 			    $_SESSION['username'] = $username;
                header('location: page/dashboard.php');
             		}else{
 			echo 'Wrong Password';
 		}
 	}
 }
 if (isset($_POST['logout'])) {
 	session_unset();
 	session_destroy();
 	header('location: ../index.php');
 }

?>