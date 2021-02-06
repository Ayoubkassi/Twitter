<?php 

	session_start();
	include 'init.php' ;
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	
		?>
	


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  <link rel="stylesheet" href="./resources/css/signup4.css">
</head>
<body>
 
<div class="container">
	<div class="top">
		<div><img src="./images/twitterlogo.png"></div>
		<form action="signup5.php" method="POST">
		<div><input type="submit" class="pro" value="Next"></div>
	</div>
	<div class="bottom">
			<h2>You'll need a password</h2>
			<p>Make sure it's 8 characters or more.</p>
			
			<label class="labi">
 				<div class="name">Password</div>
 				<input type="password" name="pass" require="required" value="" class="lagin">
 			</label>

 			<a href="">Reval password</a>
		</div>
	</div>
	</form>
	<?php } ?>
	

 
</body>
</html>