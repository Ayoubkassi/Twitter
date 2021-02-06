<?php 
				session_start();
				include 'init.php' ;
				$username = $_SESSION['Username'];
				$userid=getID($username);

				if ($_SERVER['REQUEST_METHOD'] == 'POST'  ||  (isset($_SESSION['Username']))){
					if(isset($_POST['Tweet'])){
						$info = $_POST['text_ar'];
						$userid=getID($username);

						
						$picName = $_FILES['pict']['name'];
						$picSize = $_FILES['pict']['size'];
						$picTmp	= $_FILES['pict']['tmp_name'];
						$picType = $_FILES['pict']['type'];

						$picAllowedExtension = array("jpeg", "jpg", "png", "gif");

						$picpreExtension = explode('.', $picName);
						$picExtension = strtolower(end($picpreExtension));

						$pic = rand(0, 10000000000) . '_' . $picName;

						$source_path = $picTmp;

						$target_path = 'uploads/pics/' . $_FILES["pict"]["name"];

						move_uploaded_file($source_path,$target_path);

						$query = "INSERT INTO Posts(`UserID`,`Text`,`Image`) VALUES(:zuser,:ztext,:zimage)";
						$stmt = $con->prepare($query);

						$stmt->execute(array(

							'zuser' 	=> $userid,
							'ztext' 	=> $info,
							'zimage' => $picName
	
						));
						header('Location: home.php');


					}
				$query="SELECT * FROM Profile WHERE Username = ?";			
				$stmt = $con->prepare($query);
				$stmt->execute(array($username));
				$count = $stmt->rowCount();
				
					if ($count > 0) {

					// Fetch The Data
					$perso = $stmt->fetch();

					$photo =$perso["Photo"] != "" ? $perso["Photo"] : "img.png";
				?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Twitter. it's what's happening</title>
  <link rel="stylesheet" href="./resources/css/home.css">
</head>
<body>
	<div class="container">
		<div class="sidebar">
			<div class="logo">
				<img src="./images/twitterlogo.png">
			</div>
			<div class="sidebaroption">
				<div class="element">
					<img src="./images/house.png">
					<a href="home.php" class="active">Home</a>
				</div>
				<div class="element">
					<img src="./images/diez.png">
					<p>Explore</p>
				</div>
				<div class="element">
					<img src="./images/cloche.png">
					<p>Notifications</p>
				</div>
				<div class="element">
					<img src="./images/msg.png">
					<a href="message.php">Messages</a>
				</div>
				<div class="element">
					<img src="./images/drap.png">
					<p>Bookmarks</p>
				</div>
				<div class="element">
					<img src="./images/list.png">
					<p>Lists</p>
				</div>
				<div class="element">
					<img src="./images/homme.png">
					<p>Profile</p>
				</div>
				<div class="element">
					<img src="./images/trou.png">
					<p>More</p>
				</div>
			</div>
			<div class="tweet">
				<input id="up" type="submit" name="Signup" value="Tweet">
			</div>
			<div class="logui">
				<div class="one">
					<img src="./uploads/pics/<?php echo $photo ; ?>"  alt="image">
					<div style="flex-grow: 3;margin-left:25px;">
						<p><?php echo $perso["Username"];?></p>
						<span>@<?php echo $perso["Username"]; ?></span>
					</div>	
					<div style="flex-grow: 4;margin-left:60px;">
						<img src="./images/check.png" id="etoile" alt="">
					</div>	
				</div>
				<div class="bordi">Add an existing account</div>
				<div><a href="logout.php">Logout @<?php echo $perso["Username"]; ?></a></div>
			</div>
			<div class="carr"></div>
			<div class="logout">
				<img src="./uploads/pics/<?php echo $photo; ?>" class="prof">
				<div>
					<h3><?php echo $perso["Username"]; ?></h3>
					<p>@<?php echo $perso["Username"]; ?></p>
				</div>
				<img src="./images/trou.png" class="logou">
			</div>
		</div>


		<div class="feed">
			<div class="header">
				<h2>Home</h2>
				<img src="./images/etoile.png">
			</div>
			<div class="tweetbox">
				<div class="top">
					<div class="left">
						<img src="./uploads/pics/<?php echo $photo; ?>">
					</div>
					<form action="" method="POST" enctype="multipart/form-data">
					<div class="right">
					<textarea rows="2" cols="59" name="text_ar" placeholder="What's happening?" class="put"></textarea>
					</div>
				</div>
				<div class="bottom">
					<div class="tssa">
						<!--<img src="./images/galerie.png"> -->

						<div class="wrapper">
							<label for="pict">
								<img src="./images/galerie.png" class="no">
							</label>
							<input type="file" name="pict" id="pict" class="my_file">
						</div>
						<img src="./images/gif.png">
						<img src="./images/e.png">
						<img src="./images/smile.png">
						<img src="./images/calendrier.png">
					</div>
					<div class="twee">
						<input type="submit" value="Tweet" name="Tweet">
					</div>
				</div>
				</form>
			</div>
			<div class="posts">

				<div class="post">
					<div class="lif">
						<img src="./uploads/pics/<?php echo $photo; ?>">
					</div>
					<div class="rit">
						<div class="info">
							<div class="na"><p><?php echo $perso["Username"]; ?></p><img src="./images/suivre.png"></div>
							<div class="po">@<?php echo $perso["Username"]; ?></div>
							<div class="po">2h</div>
						</div>
						<div class="text">
							Hey and Welcome Again.
						</div>
						<div class="post_pic">
							<img src="./images/kaka.jpeg">
						</div>
						<div class="react">
							<div class="single blue">
								<img src="./images/commentaire.png">
								<span>105</span>
							</div>
							<div class="single green retweet">
								<a href=""><img src="./images/retweet.png"></a>
								<span>941</span>
							</div>
							<div class="single red">
								<img src="./images/coeur.png">
								<span>5.6K</span>
							</div>
							<div class="single blue">
								<img src="./images/partage.png">
							</div>
						</div>
					</div>
				</div>
				<?php 
				$rows = getLatestPosts($perso["ID"]);
				$post = "";
				foreach($rows as $row){
					$post.='
							<div class="post">
					<div class="lif">
						<img src="./uploads/pics/'.getPic($row["UserID"]).'">
					</div>
					<div class="rit">
						<div class="info">
							<div class="na"><p>'.getName($row["UserID"]).'</p><img src="./images/suivre.png"></div>
							<div class="po">@'.getName($row["UserID"]).'</div>
							<div class="po">2h</div>
						</div>
						<div class="text">
							'.$row["Text"].'
						</div>
						<div class="post_pic">
							<img src="./uploads/pics/'.$row["Image"].'">
						</div>
						<div class="react">
							<div class="single blue">
								<img src="./images/commentaire.png">
								<span>105</span>
							</div>
							<div class="single green retweet">
							<a href="action.php?id='.$row["PostID"].'&do=retweet"><img src="./images/retweet.png"></a>
								<span>941</span>
							</div>
							<div class="single red">
								<img src="./images/coeur.png">
								<span>5.6K</span>
							</div>
							<div class="single blue">
								<img src="./images/partage.png">
							</div>
						</div>
					</div>
				</div>
					';
				}
				echo $post;
				?>
			</div>
		</div>



		<div class="widgets">
			<div class="search">
				<img src="./images/2.png">
				<input type="text" placeholder="Search Twitter">
			</div>
			<div class="news">
				<div class="trends">
					<h3>Trends for you</h3>
					<img src="./images/roue.png">
				</div>
				<div class="trandi">
					<div class="first">
						<div>Football . Trending</div>
						<img src="./images/trou.png">
					</div>
					<div class="second">
						<h4>Hazard</h4>
						<p>24K Tweets</p>
					</div>
				</div>

				<div class="trandi">
					<div class="first">
						<div>Football . Trending</div>
						<img src="./images/trou.png">
					</div>
					<div class="second">
						<h4>Hazard</h4>
						<p>24K Tweets</p>
					</div>
				</div>

				<div class="trandi">
					<div class="first">
						<div>Football . Trending</div>
						<img src="./images/trou.png">
					</div>
					<div class="second">
						<h4>Hazard</h4>
						<p>24K Tweets</p>
					</div>
				</div>

				<div class="trandi">
					<div class="first">
						<div>Football . Trending</div>
						<img src="./images/trou.png">
					</div>
					<div class="second">
						<h4>Hazard</h4>
						<p>24K Tweets</p>
					</div>
				</div>

				<div class="trandi">
					<div class="first">
						<div>Football . Trending</div>
						<img src="./images/trou.png">
					</div>
					<div class="second">
						<h4>Hazard</h4>
						<p>24K Tweets</p>
					</div>
				</div>
				<div class="more">
					Show more
				</div>
				</div>
				<div class="links">
					<a href="">Terms of Service</a>
					<a href="">Privacy Policy</a>
					<a href="">Cookie Policy</a>
					<a href="">Ads info</a>
					<a href="">More</a>
					<a href="">&#169 2021 Twitter, lnc.</a>
				</div>

		</div>
	</div>


<?php } }else {
		echo "motherfucker";
				header('Location: index.php');
	}
?>

<script>
	let logout = document.querySelector('.logout');
	let logui = document.querySelector('.logui');
	const createlog = () => {
		if(logui.style.display != "none")
		logui.style.display="none";
		else logui.style.display = "block";
	}

	logout.addEventListener('click',createlog);

	// let retweet = document.querySelectorAll('.retweet');

	// retweet.forEach(re => {
	// 	re.addEventListener('click',(e)=>{
	// 		let center = document.createElement('div');
	// center.className="center";
	
	// document.body.appendChild(center);

	// let pipbox = document.createElement('div');
	// pipbox.className="pip";
	// let linkos = document.createElement('a');
	// linkos.href="action.php?id='..'&do=retweet";
	// linkos.className="retweeta";
	// linkos.innerHTML="Retweet";

	// pipbox.appendChild(linkos);

	// document.body.appendChild(pipbox);
	// 	});
	// });
	

	

	
</script>
</body>
</html>