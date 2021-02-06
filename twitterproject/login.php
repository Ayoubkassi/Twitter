<?php
	session_start();
	$pageTitle = 'Login';

	if (isset($_SESSION['Username'])) {
		header('Location: home.php'); // Redirect To Dashboard Page
	}

	include 'init.php';

	// Check If User Coming From HTTP Post Request

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$username = $_POST['login'];
		$password = $_POST['pass'];

		// Check If The User Exist In Database

		$stmt = $con->prepare("SELECT 
									 Username, Password 
								FROM 
									Profile
								WHERE 
									Username = ? 
								AND 
									Password = ? 
								
								LIMIT 1");

		$stmt->execute(array($username, $password));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();

		// If Count > 0 This Mean The Database Contain Record About This Username

		if ($count > 0) {
			$_SESSION['Username'] = $username; // Register Session Name
			/*$_SESSION['ID'] = $row['UserID']; // Register Session ID*/

			header('Location: home.php'); // Redirect To Dashboard Page
			exit();
		}

	}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  <link rel="stylesheet" href="./resources/css/login.css">
</head>
<body>
	<div class="container">
		<head>
			<img src="./images/twitterlogo.png">
			<h2>Log in to Twitter</h2>
		</head>
		<form action="" method="POST">
		<div class="main">

			<div class="input">
				<div class="up"><label for="login">
					<span id="spa">
					Phone,email,or username
					</span>
					</label>
				</div>
				<div>
					<input type="text" name="login" id="login">
				</div>
			</div>

				<div class="input">
				<div class="up"><label for="pass">
					<span id="spa">
					Password
					</span>
					</label>
				</div>
				<div>
					<input type="password" name="pass" id="pass">
				</div>
			</div>


			<input type="submit" name="twit" class="btn">
		</div>
	</form>
			<div class="link">
				<a href="#">Forgot password?</a>
				<a href="#">Sign up for Twitter</a>
			</div>
		</div>
	</div>
  



    <script src="./resources/js/script.js"></script>
</body>
</html>
