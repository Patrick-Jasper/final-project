<?php
	if(!isset($_SESSION['username'])) {
		header('Location: dashboard.php');
	}
?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Logged In</title>
    <link type="text/css" rel="stylesheet" href="stylesheet.css" />
  </head>
  <body>
	<h1>You are now logged in!</h1>
	<h2>Username : <?php echo $_SESSION['username'] ?><h2>
</body>
</html>