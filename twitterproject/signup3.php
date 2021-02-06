<?php 

	session_start();
	include 'init.php' ;
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$username = $_SESSION['Username'];

	$stmt = $con->prepare("SELECT * FROM Profile WHERE Username = ? LIMIT 1");

	$stmt->execute(array($username));

	$row = $stmt->fetch();
	$count = $stmt->rowCount();

	if ($count > 0) { 	?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  <link rel="stylesheet" href="./resources/css/signup3.css">
</head>
<body>
 
<div class="container">
	<div class="top">
		<div><a href=""><img src="./images/fleche.png" class="ima"></a></div>
		<div><h2>Step 3 of 5</h2></div>
	</div>
	<div class="bottom">
			<h2>Create your account</h2>
				<label class="labo">
 				<div class="name">Name</div>
 				<input type="text" name="login" value="<?php echo $row['Username'] ?>" class="lagin">
 			</label>


 			<label class="labo">
 				<div class="name">Email</div>
 				<input type="email" name="phone" value="<?php echo $row['Email'] ?>" class="poss">
 			</label>

 			<label class="labo">
 				<div class="name">Birth date</div>
 				<input type="text" name="phone" value="<?php echo $row['Date_naissance'] ?>" class="poss">
 			</label>

 		</div>
 		<div class="privacy">
 			By signing up,you agree to the <span>Terms of Service</span> and <span>Privacy Policy</span>, including <span>Cookie Use</span>. Others will be able to find you by email or phone number when provided. <span>Privacy Options</span>
 		</div>
		<form method="POST" action="signup4.php">
		 <input type="submit" name="" value="Sign up">
		</form>




	</div>
	<?php }} else {
				echo "You are not allowed u motherf***er";
				header('Location: index.php');


	} ?>
</body>
</html>