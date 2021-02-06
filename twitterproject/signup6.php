<?php 
				session_start();
				include 'init.php' ;
				$username = $_SESSION['Username'];

				
				$picName = $_FILES['pic']['name'];
				$picSize = $_FILES['pic']['size'];
				$picTmp	= $_FILES['pic']['tmp_name'];
				$picType = $_FILES['pic']['type'];

				$picAllowedExtension = array("jpeg", "jpg", "png", "gif");

				$picpreExtension = explode('.', $picName);
				$picExtension = strtolower(end($picpreExtension));

				$pic = rand(0, 10000000000) . '_' . $picName;

				$source_path = $picTmp;

				$target_path = 'uploads/pics/' . $_FILES["pic"]["name"];

				move_uploaded_file($source_path,$target_path);
				$stmt = $con->prepare("UPDATE Profile SET Photo= ? WHERE Username = ? LIMIT 1");
				$stmt->execute(array($picName,$username));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  <link rel="stylesheet" href="./resources/css/signup6.css">
</head>
<body>
 
<div class="container">
	<div class="top">
		<div><img src="./images/twitterlogo.png"></div>
		<form method="POST" action="signup7.php">
		<div><input type="submit" value="Skip fon now" class="pro"></div>
	</div>

		<div class="bottom">
			<h2>Pick a profile picture</h2>
			<p>Have a favorite selfie? Upload it now.</p>


			<label class="laby">
 				<div class="name">Bio</div>
 				<textarea name="bio">
 					
 				</textarea> </label>

		</div>
		</form>
			</div>
</body>
</html>