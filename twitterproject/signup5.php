<?php 

	session_start();
	include 'init.php' ;
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$username = $_SESSION['Username'];

	$stmt = $con->prepare("SELECT * FROM Profile WHERE Username = ? LIMIT 1");

	$stmt->execute(array($username));

	$row = $stmt->fetch();
	$count = $stmt->rowCount();

	if ($count > 0) { $pass = $_POST['pass'];
		$stmt = $con->prepare("UPDATE Profile SET Password = ? WHERE Username = ? LIMIT 1");
		$stmt->execute(array($pass,$username));	?>
	

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  <link rel="stylesheet" href="./resources/css/signup5.css">
</head>
<body>
 
<div class="container">
	<div class="top">
		<div><img src="./images/twitterlogo.png"></div>
		<form enctype="multipart/form-data" method="POST" action="signup6.php" >
		<div><input type="submit" class="pro" value="Skip for Now"></div>
	</div>

		<div class="bottom">
			<h2>Pick a profile picture</h2>
			<p>Have a favorite selfie? Upload it now.</p>

			<div class="wrapper">
				<label for="pic">
					<img src="./images/1.png" class="no">
				</label>
				<input type="file" name="pic" id="pic" class="my_file">
			</div>

		</div>
	</form>




			</div>
			<?php 
				

		}
	

} else {
				echo "You are not allowed u motherf***er";
				header('Location: index.php');


	} ?>
</body>
</html>