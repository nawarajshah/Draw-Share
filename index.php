<?php
include('loginRegister/login.php'); // Includes Login Script
include('loginRegister/register.php');
if(isset($_SESSION['login_id'])){
  if (isset($_SESSION['pageStore'])) {
      $pageStore = $_SESSION['pageStore'];
    }  
  else {        
      $pageStore = "draw.php";
    }
header("location: $pageStore"); // Redirecting To Profile Page
}

?> 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Login | Register</title>
	<link rel="stylesheet" href="css/auth.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="icon" type="image/png" href="image/pen.png">
	  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>

</head>

<body>
	<?php echo $error; ?>
	<div class="lowin">
		<div class="lowin-wrapper">
			<div class="lowin-box lowin-login">
				<div class="lowin-box-inner">
					<form action="" method="post">
						<p>Sign in to continue</p>
						<div class="lowin-group">
							<label>Email <a href="#" class="login-back-link">Sign in?</a></label>
							<input type="email" autocomplete="email" name="email" class="lowin-input" required>
						</div>
						<div class="lowin-group password-group">
							<label>Password <a href="#" class="forgot-link">Forgot Password?</a></label>
							<input type="password" name="password" autocomplete="current-password" class="lowin-input" required>
						</div>
						<button type="submit" class="lowin-btn login-btn" name="signIn">
							Sign In
						</button>

						<div class="text-foot">
							Don't have an account? <a href="" class="register-link">Register</a>
						</div>
					</form>
				</div>
			</div>

			<div class="lowin-box lowin-register">
				<div class="lowin-box-inner">
					<form action="" method="post" oninput='validatePassword();'>
						<p>Let's create your account</p>
							<label>First Name</label>
							<input type="text" name="fname" autocomplete="first name" class="lowin-input" required>

							<label>Last Name</label>
							<input type="text" name="lname" autocomplete="last name" class="lowin-input" required>
							
							<label>Email</label>
							<input type="email" autocomplete="email" name="email" class="lowin-input" required>
							
							<label>Password</label>
							<input type="password" name="password" id="newPass" autocomplete="new password" class="lowin-input" required>
							<div class="lowin-group">
							<label>Conform password</label>
							<input type="password" name="conformpassword" id="conformPass" class="lowin-input" required>
							</div>
						<button class="lowin-btn" name="signUp">
							Sign Up
						</button>

						<div class="text-foot">
							Already have an account? <a href="" class="login-link">Login</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	
		<footer class="lowin-footer" hidden>
			Design By <a href="http://fb.me/itskodinger">@itskodinger</a>
		</footer>
	</div>

	<script src="js/auth.js"></script>
	<script>
				Auth.init({
			login_url: '',
			forgot_url: ''
		});

		function validatePassword(){
  if(newPass.value != conformPass.value) {
    conformPass.setCustomValidity('Passwords do not match.');
  } else {
    conformPass.setCustomValidity('');
  }
}
	</script>
</body>
</html>