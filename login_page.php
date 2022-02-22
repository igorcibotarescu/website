<?php include ("php/server.php");
if(isset($_SESSION['username'])){
	header("location:user_page.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login_page.css">
    <title>Document</title>
</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-up-container">
	<form method="post" action="">
		<?php include ("php/errors.php");?>
			<h1>Create Account</h1>
			<input type="text" name="username" placeholder="Username" required>
			<input type="text" name="email"  placeholder="Email" required>
            <input type="password" name="password_1" minlength="8" maxlength="20"  placeholder="Password" required>
            <input type="password" name="password_2" minlength="8" maxlength="20"  placeholder="Confirm Password" required>
            <button type="submit" name="reg_user">Sign Up</button>
			<a href="index.php">Home</a>
		</form>
	</div>
	<div class="form-container sign-in-container">
	<form method="post" action="">
	<?php include ("php/errors.php");?>
			<h1>Sign in</h1>
			<input type="text" name="username" placeholder="Username" required >
			<input type="password" name="password"  placeholder="Password" minlength="8" maxlength="20" required>
			<a href="forgot_password.php">Forgot your password?</a>
			<button type="submit" name="login_user">Sign In</button>
			<a href="index.php">Home</a>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>

<script src="login_page.js"></script>

</body>
</html>