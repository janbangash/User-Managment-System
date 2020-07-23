<?php 
 		
	 session_start();
		
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\SMTP;
		use PHPMailer\PHPMailer\Exception;

		// Load Composer's autoloader
		require 'vendor/autoload.php';

		// Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);

	 require_once 'auth.php';
	 $user = new Auth();

	 // Handel Register Ajax Request

	 if (isset($_POST['action']) && $_POST['action'] == 'register') {
	 	$name = $user->test_input($_POST['name']);
	 	$email = $user->test_input($_POST['email']);
	 	$pass = $user->test_input($_POST['password']);

	 	$hpass = password_hash($pass, PASSWORD_DEFAULT);

	 	if ($user->user_exist($email)) {
	 		echo $user->showMesssage('warning','This E-Mail is already registered!');
	 	}
	 	else {
	 		if ($user->register($name, $email, $hpass)) {
	 			echo 'register';
	 			$_SESSION['user'] = $email;

 		  		$mail->isSMTP();
 		  		$mail->Host ='smtp.gmail.com';
 		  		$mail->SMTPAuth = true;
 		  		$mail->Username = Database::USERNAME;
 		  		$mail->Password = Database::PASSWORD;
 		  		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
 		  		$mail->Port = 587;

 		  		//Reciptent
 		  		$mail->setFrom(Database::USERNAME,'Bangash Managment System');
 		  		$mail->addAddress($email);

 		  		//Content
 		  		$mail->isHTML(true);
 		  		$mail->Subject = 'E-Mail Verification';
 		  		$mail->Body = '<h3>Click the below link to verify your E-Mail.<br><a href="http://localhost/user_systemproject/verify-email.php?email='.$email.'">http://localhost/user_systemproject/verify-email.php?email='.$email.'</a><br>Regards<br>Bangash Managment System!</h3>';

 		  		$mail->send();
	 		}
	 		else {
	 			echo $user->showMesssage('danger','Something went wrong! try again later!');
	 		}
	 	}
	 }

	 // Handel Login Ajax Request
	 
	 if (isset($_POST['action']) && $_POST['action'] == 'login') {
	 	$email = $user->test_input($_POST['email']);
	 	$pass = $user->test_input($_POST['password']);

	 	$loggedInUser = $user->login($email);

	 	if ($loggedInUser != null) {
	 		if (password_verify($pass, $loggedInUser['password'])) {
	 			if (!empty($_POST['rem'])) {
	 				setcookie("email", $email, time()+(30*24*60*60), '/');
	 				setcookie("password", $pass, time()+(30*24*60*60), '/');
	 			}
	 			else {
	 				setcookie("email","",1, '/');
	 				setcookie("password","",1, '/');
	 			}

	 			echo 'login';
	 			$_SESSION['user'] = $email;
	 		}
	 		else {
	 			echo $user->showMesssage('danger','Password is incorrect!');
	 		}		
	 	}
	 	else {
	 		echo $user->showMesssage('danger','This User is not register!');
	 	}
	 }

	 // Handle forgot password Ajax Request
	 if (isset($_POST['action']) && $_POST['action'] == 'forgot') {
	 	$email = $user->test_input($_POST['email']);

	 	$user_found = $user->currentUser($email);

	 	if ($user_found != null) {
	 		$token = uniqid();
	 		$token = str_shuffle($token);

	 		$user->forgot_password($token,$email);

	 		try {
	 				//Server Setting
	 				
	 		  		$mail->isSMTP();
	 		  		$mail->Host ='smtp.gmail.com';
	 		  		$mail->SMTPAuth = true;
	 		  		$mail->Username = Database::USERNAME;
	 		  		$mail->Password = Database::PASSWORD;
	 		  		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	 		  		$mail->Port = 587;

	 		  		//Reciptent
	 		  		$mail->setFrom(Database::USERNAME,'Bangash Managment System');
	 		  		$mail->addAddress($email);

	 		  		//Content
	 		  		$mail->isHTML(true);
	 		  		$mail->Subject = 'Reset Password';
	 		  		$mail->Body = '<h3>Click the below link to reset your password.<br><a href="http://localhost/user_systemproject/reset-pass.php?email='.$email.'&token='.$token.'">http://localhost/user_systemproject/reset-pass.php?email='.$email.'&token='.$token.'</a><br>Regards<br>Bangash Managment System!</h3>';

	 		  		$mail->send();
	 		  		echo $user->showMesssage('success','We have send you the reset link to your e-mail ID, please check your e-mail!');

	 		  	} 
	 		  	catch (Exception $e) {
	 		  		echo $user->showMesssage('danger','Something went wrong please try again later!');
	 		  	}  	
	 	}
	 	else {
	 		echo $user->showMesssage('info','This e-mail is not registerd!');
	 	}
	 }

	 // Checking User is logged in or not
	 if (isset($_POST['action']) && $_POST['action'] == 'checkUser') {
	 	if (!$user->currentUser($_SESSION['user'])) {
	 		echo 'bye';
	 		unset($_SESSION['user']);
	 	}
	 }



 ?>