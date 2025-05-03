<?php
	// Initializes session and redirects if necessary //
	session_start();
	$_SESSION['username'] = NULL;
	if(isset($_SESSION['username'])) {
		header('Location : dashboard.php');
	}
?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sustainable Product Catalog - Patrick Jasper</title>
    <link type="text/css" rel="stylesheet" href="stylesheet.css"/>
  </head>
  <body>
	<header></header>
	<?php
		// START OF DATABASE //
		//$servername = "localhost";
		//$username = "username";
		//$password = "password";
		
		// Create connection
		//$conn = new mysqli($servername, $username, $password);

		// Check connection
		//if (mysqli_connect_error()) {
		//	die("Database connection failed: " . mysqli_connect_error());
		//}
		
		// END OF DATABASE//
		
		
		
		// define variables and set to empty values
		$usernameErr = $passwordErr = $accErr = "";
		$username = $user_password = "";
		$account_validated = False;

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["username"])) {
				$usernameErr = "Username is required";
			} else {
				$username = $_POST["username"];
			}
	
			if (empty($_POST["user_password"])) {
				$passwordErr = "Password is required";
			} else {
				$user_password = $_POST["user_password"];
				}
		}
		
		//if (isset($_POST["submit_login"]) && $username
	?>
	
	<section class="formBox">
		<h2>Log-In</h2>
		<p><span class="error">* required field</span></p>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<!-- NAME -->
			Username: <input type="text" name="username" value="<?php echo $username;?>">
			<span class="error">* <?php echo $usernameErr;?></span>
			<br><br>
			<!-- Password -->
			Password: <input type="text" name="user_password" value="<?php echo $user_password;?>">
			<span class="error">* <?php echo $passwordErr;?></span>
			<br><br>
			<!-- SUBMIT BUTTON -->
			<span class="error"><?php echo $accErr;?></span>
			<input type="submit" name="submit_login" value="Submit">
			<button type="button" name="register"><a href='registration.php'>Register</a></button>
		</form>
	</section>
	
	<?php
		$servername = "localhost";
		$sql_username = "root";
		$sql_password = "";
		$db_name = "db_new";
		
		$conn = new mysqli($servername, $sql_username, $sql_password, $db_name);
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = "SELECT username, password FROM users WHERE username='$username' AND password='$user_password'";
		$result = conn -> query($sql);
		
		if ($result->num_rows = 1) {
			$account_validated = True;
		} elseif ($result->num_rows > 1) {
			$account_validated = False;
			$accError = "Invalid Account";
		} else {
			$account_validated = False;
			$accError = "Invalid Account";
		}
		
		$conn->close();
	?>

	<?php
		echo "<h2>Your Input:</h2>";
		echo $username;
		echo "<br>";
		echo $user_password;
		echo "<br>";
		echo $_SESSION["username"];
	?>
  </body>
</html>