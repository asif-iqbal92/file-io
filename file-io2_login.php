<?php 

			session_start();
	$uname = $pass = "";
	if($_SERVER['REQUEST_METHOD'] === "POST") {
		$userName = $password = "";

			$contents = file("data.txt");
			$found = false;
			$_SESSION['userName'] = $userName;
			$_SESSION['password'] = $password;

foreach ($contents as $line) {
    $data = explode(',', $line);  

		if(($userName === $data[10]) && ($password === $data[11])) {

			echo "welcome!";

			if(isset($_POST['rememberme'])) {
				setcookie("userName", $userName, time() + 60*60*24);
				setcookie("password", $password, time() + 60*60*24);
				setcookie("rememberme", "1", time() + 60*60*24);
			} 

			header("location: welcome.php");
		}

		if (empty($userName || $password))
		{
			header("location: file-io2_login.php");
		}
	}


	if(isset($_COOKIE['rememberme'])) {
		$uname = $_COOKIE['userName'];
		$pass = $_COOKIE['password'];
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
</head>
<body>
	<h1>Login Form</h1>
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
		<label for="userName">Username: </label>
		<input type="text" name="userName" id="userName" value="<?php echo $uname; ?>">

		<br><br>

		<label for="password">Password: </label>
		<input type="password" name="password" id="password" value="<?php echo $pass; ?>">

		<br><br>

		<input type="checkbox" name="rememberme" id="rememberme" value="1">
		<label for="rememberme">Remember Me</label>

		<input type="submit" name="submit" value="Login">
	</form>

	<br>

	<p>Not Registered? <a href="file-io2.php">Click to Register</a></p>
	

</body>
</html>