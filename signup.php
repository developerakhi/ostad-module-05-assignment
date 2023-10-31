<?php
session_start();

$usersFile = 'users.json';

$users = file_exists( $usersFile ) ? json_decode( file_get_contents( $usersFile ), true ) : [];

function saveUsers( $users, $file )
{
    file_put_contents( $file, json_encode( $users, JSON_PRETTY_PRINT ) );
}
$errorMsg = "";
// Registration Form Handling
if ( isset( $_POST['submit'] ) ) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
	
//Validation
    if ( empty( $username ) || empty( $email ) || empty( $password ) ) {
        $errorMsg = "Please fill  all the fields.";
    } else {
        if ( isset( $users[$email] )) {
            $errorMsg = "Email already exists.";
        } else {
            $users[$email] = [
                'username' => $username,
                'password' => $password,
                'role'     => '',
            ];

            $saveUsers = saveUsers( $users, $usersFile );
			
           
			if(!isset($saveUsers) == "success") { echo "Registered Successfully"; }
			$_SESSION['email'] = $email;
            header( 'Location: admin_dashboard.php' );
            // header( 'Location: update.php' );
        }

    }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign Up</title>
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
						Sign Up  
					</span>
				</div>
				<div class="text-center">
					<span style="font-size: 14px; color: red; text-align:center;"><?php echo $errorMsg;?></span>
				</div>
				
				<form class="login100-form validate-form" name="form" action="signup.php" method="POST">
					
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">User Name</span>
						<input class="input100" type="text" name="username" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

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
						<div>
							<p class="text">Already have an account? <a href="login.php" class="txt1"> Login</a></p>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<input class="input100" type="hidden" name="role" value="">
						<input class="login100-form-btn" type="submit" name="submit" value="Signup">
						<!-- <button class="login100-form-btn">
							Signup
						</button> -->
					</div>
				</form>
			</div>
		</div>
	</div>
	

<?php include('include/footer_files.php');?>
</body>
</html>