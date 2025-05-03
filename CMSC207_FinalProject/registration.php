<?php
	if(isset($_SESSION["username"])) {
		header('Location: dashboard.php');
	};
?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link type="text/css" rel="stylesheet" href="stylesheet.css" />
  </head>
  <body>
	<header></header>
	<?php
		// define variables and set to empty values
		$firstNameErr = $lastNameErr = $emailErr = $usernameErr = $passwordErr = $birthDateErr = $accUniqueErr = "";
		$firstName = $lastName = $email = $username = $user_password = $birthDate = "";
		$account_unique = False;

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["first_name"])) {
				$firstNameErr = "First name is required";
			} else {
				$firstName = test_input($_POST["first_name"]);
				// check if name only contains letters and whitespace
				if (!preg_match("/^[a-zA-Z-' ]*$/",$firstName)) {
					$firstNameErr = "Only letters and white space allowed";
				}
			}
			
			if (empty($_POST["last_name"])) {
				$lastNameErr = "Last name is required";
			} else {
				$lastName = test_input($_POST["last_name"]);
				// check if name only contains letters and whitespace
				if (!preg_match("/^[a-zA-Z-' ]*$/",$lastName)) {
					$firstNameErr = "Only letters and white space allowed";
				}
			}
  
			if (empty($_POST["email"])) {
				$emailErr = "Email is required";
			} else {
				$email = test_input($_POST["email"]);
				// check if e-mail address is well-formed
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$emailErr = "Invalid email format";
				}
			}
			
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
			
			if (empty($_POST["birth_date"])) {
				$birthDateErr = "Birth date is required";
			} else {
				try{
					$birthDate = date("Y-m-d",strtotime($_POST["birth_date"]));
				} catch (Exception $e) {
					$birthDateErr = "Valid birth date format is required";
				}
			}
		}

		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	?>
	
	<section class="formBox">
		<h2>Registration</h2>
		<p><span class="error">* required field</span></p>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
			First Name: <input type="text" name="first_name" value="<?php echo $firstName;?>">
			<span class="error">* <?php echo $firstNameErr;?></span>
			<br><br>
			Last Name: <input type="text" name="last_name" value="<?php echo $lastName;?>">
			<span class="error">* <?php echo $lastNameErr;?></span>
			<br><br>
			E-mail: <input type="text" name="email" value="<?php echo $email;?>">
			<span class="error">* <?php echo $emailErr;?></span>
			<br><br>
			Username: <input type="text" name="username" value="<?php echo $username;?>">
			<span class="error">* <?php echo $usernameErr;?></span>
			<br><br>
			Password: <input type="text" name="user_password" value="<?php echo $user_password;?>">
			<span class="error">* <?php echo $passwordErr;?></span>
			<br><br>
			Birth Date: <input type="text" name="birth_date" value="<?php echo $birthDate;?>">
			<span class="error">* <?php echo $birthDateErr;?></span>
			<br><br>
			<span class="error"><?php echo $accUniqueErr;?></span>
			<input type="submit" name="submit_register" value="Submit">  
		</form>
	</section>
	
	<?php
		$servername = "localhost";
		$sql_username = "root";
		$sql_password = "";
		$db_name = "db";
		
		$conn = mysqli_connect($servername, $sql_username, $sql_password, $db_name);
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql_add_account = $conn->prepare("INSERT INTO users VALUES (?,?,?,?,?,?)");
		$sql_add_account -> bind_param("sssssb",$firstName,$lastName,$email,$username,$user_password,$birthDate);
		
		//$sql = "SELECT username, password FROM users WHERE username='$username' OR email_address='$email'";
		//$new_account = 
		//$result = conn -> query($sql);
		
		$result = $conn -> query("SELECT username, password FROM users WHERE username='$username' OR email_address='$email'");
		
		if ($result -> num_rows = 0) {
			$account_unique = True;
		} else {
			$account_unique = False;
			$accUniqueErr = "Email or username already taken";
		}
		
		$conn->close();
		
		if(isset($_POST["submit_register"]) && ($firstNameErr="") && ($lastNameErr="") && ($emailErr="") && ($usernameErr="") && ($passwordErr="") && ($birthDateErr="") && $account_unique) {
			$sql_add_account -> execute;
			session_unset();
			header("Location: index.php");
		}
	?>

	<?php
	echo "<h2>Your Input:</h2>";
	echo $firstName;
	echo "<br>";
	echo $lastName;
	echo "<br>";
	echo $email;
	echo "<br>";
	echo $username;
	echo "<br>";
	echo $user_password;
	echo "<br>";
	echo $birthDate;
	?>
  </body>
</html>