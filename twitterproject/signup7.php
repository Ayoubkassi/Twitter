<?php 
				session_start();
				include 'init.php' ;
				$username = $_SESSION['Username'];
				$bio=$_POST['bio'];
				$stmt = $con->prepare("UPDATE Profile SET Bio= ? WHERE Username = ? LIMIT 1");
				$stmt->execute(array($bio,$username));


				?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  <link rel="stylesheet" href="./resources/css/signup7.css">
</head>
<body>
 
<div class="container">
	<div class="top">
		<div><img src="./images/twitterlogo.png" id="my"></div>
		<form method="POST" action="signup8.php">
		<div class="mz"><input value="Skip for now" class="pro" type="submit" ></div>
		</form>
	</div>

		<div class="bottom">
			<h2>Waht are you interested in?</h2>
			<p>Select some topics you're interested in to help personalize your Twitter experience, starting with finding people to follow.</p>

			<div class="search">
				<img src="./images/2.png">
				<input type="text" placeholder="Search for interests">
			</div>
			<div class="jadi">
				
			</div>
		

			<div class="fli">
				<div class="title">
					News
				</div>
				<div class="elements">
					<input type="submit" class="inp" value="General News">
					<input type="submit" class="inp" value="Journalists">
					<input type="submit" class="inp"
					value="World News">
				</div>
			</div>

			<div class="fli">
				<div class="title">
					Sports
				</div>
				<div class="elements">
					<input type="submit" class="inp" value="Local Sports">
					<input type="submit" class="inp" value="Soccer">
				</div>
			</div>

			<div class="fli">
				<div class="title">
					Goverments & Politics
				</div>
				<div class="elements">
					<input type="submit" class="inp" value="Politicians">
					<input type="submit" class="inp" value="Politics">
					
				</div>
			</div>

			<div class="fli">
				<div class="title">
					Entertainment
				</div>
				<div class="elements">
					<input type="submit" class="inp" value="General Entertainment">
					<input type="submit" class="inp" value="Music">
					
				</div>
			</div>

			<div class="fli">
				<div class="title">
					Sience & Tech
				</div>
				<div class="elements">
					<input type="submit" class="inp" value="Tech">
					<input type="submit" class="inp" value="Sience">
					
				</div>
			</div>



				</div>
			</div>
<script type="text/javascript" src="./resources/js/script2.js">
	
</script>
</body>
</html>