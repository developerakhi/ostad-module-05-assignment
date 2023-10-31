<?php

	session_start();
	$users = json_decode( file_get_contents( 'users.json' ), true );

	if ( isset( $_POST['submit'] ) ) {
		$email    = $_POST['email'];
		$password = $_POST['password'];
		
	//Validation
		if ( empty( $email ) || empty( $password ) ) {
			$errorMsg = "Please fill  all the fields.";
		} else {
			$user = $users[$email];
			$_SESSION['loggin']= $user;
			if ($user["role"] == "admin") {
				header("Location: admin_dashboard.php");
				exit;
			} else if ($user["role"] == "manager") {
				header("Location: manager_dashboard.php");
				exit;
			} else if ($user["role"] == "user") {
				header("Location: user_dashboard.php");
				exit;
			} else {
				header("Location: guest_dashboard.php");
				exit;
			}
		}
	}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('include/header_files.php');?>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Sign In
					</span>
				</div>

				<form class="login100-form validate-form" action="login.php" method="POST">

					<div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="Enter email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<p class="text">Don't have an account? <a href="signup.php" class="txt1"> Signup</a></p>
							
						</div>
					</div>

					<div class="container-login100-form-btn">
						<input class="login100-form-btn" type="submit" name="submit" value="Login">
						<!-- <button class="login100-form-btn">
							Login
						</button> -->
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<?php include('include/footer_files.php');?>
</body>
</html>