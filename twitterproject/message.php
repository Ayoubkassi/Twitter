<?php 
				session_start();
				include 'init.php' ;
				$username = $_SESSION['Username'];

				$query="SELECT * FROM Profile WHERE Username = ?";			
				$stmt = $con->prepare($query);
				$stmt->execute(array($username));
				$perso = $stmt->fetch();
				$userid=getID($username); 
				$show="";
				if(isset($_GET['id'])){
					$show="ok";
					$id = $_GET['id'];
					
				}

				$photo =$perso["Photo"] != "" ? $perso["Photo"] : "img.png";
				
				?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Twitter. it's what's happening</title>
  <link rel="stylesheet" href="./resources/css/message.css">
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
					<a href="home.php" id="home">Home</a>
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
					<p class="active">Messages</p>
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
					<img src="./uploads/pics/<?php echo $photo ; ?>" alt="image">
					<div style="flex-grow: 3;margin-left:25px;">
						<p><?php echo $perso["Username"]; ?></p>
						<span>@<?php echo $perso["Username"]; ?></span>
					</div>	
					<div style="flex-grow: 4;margin-left:60px;">
						<img src="./images/check.png" id="etoile" alt="">
					</div>	
				</div>
				<div class="bordi">Add an existing account</div>
				<div><a href="logout.php">Logout @<?php echo $perso["Username"]; ?></a></div>
			</div>
			
			<div class="logout">
				<img src="./uploads/pics/<?php echo $photo ; ?>" class="prof">
				<div>
					<h3><?php echo $perso["Username"]; ?></h3>
					<p>@<?php echo $perso["Username"]; ?></p>
				</div>
				<img src="./images/trou.png" class="logou">
			</div>
		</div>

			<div class="message">
				<div class="title">
					<h3>Messages</h3>
					<img src="./images/msg.png">
				</div>
				
				<div class="search">
					<img src="./images/2.png">
					<input type="text" placeholder="Search Twitter">
				</div>
				<div class="kol">
				<div class="new">
					<h2>Send a message, get a message</h2>
					<p>Direct Messages are private conversations between you and other people on Twitter. Share Tweets, media, and more!</p>
					<div class="tweetm">
							<input id="up" type="submit" name="Signup" value="Start a conversation">
					</div>
					</div>
				</div>
				<div class="followers">
					<?php  
						$followers= getLatestFllowers($userid);
						$output="";
						foreach($followers as $row){
							$profile_image = '';
							if($row['Photo'] != '')
							{
								$profile_image = '<img src="./uploads/pics/'.$row["Photo"].'" class="pir" />';
							}
				
							else
							{
								$profile_image = '<img src="./images/img.png" class="pir" />';
							}

							$output.='
				<div class="perso">
				<div class="tap">
					<div class="left">
						<div class="ima">'.$profile_image.'</div>
						<div>
							<div class="name">
								<span class="nz">'.$row["Username"].'</span><img src="./images/suivre.png" class="verefi">
								<p id="tag">@'.$row["Username"].'</p>
							</div>
						</div>
					</div>
						<div class="right">
						<a href="message.php?id='.$row["ID"].'&do=message" class="inp">Message</a>
						</div>
				</div>
			</div>
					  ';
						}
						echo $output;
					?>
				</div>


			</div>


			
				<?php if($show == ""){
					echo '
					<div class="conversation">
					<h2>You don’t have a message selected</h2>
					<p>Choose one from your existing messages, or start a new one.</p>
					<div class="tweety">
								<input id="up" type="submit" name="Signup" value="New message">
						</div>
				</div>
				</div>
						';
				} else {
					
					// $query = "SELECT * FROM Messages WHERE (SID='$userid' AND DID='$id')
						// OR (SID='$id' AND DID='$userid') ORDER BY 1 ASC)";
					$query = "SELECT * FROM `Messages` WHERE (`SID`=$userid AND `DID`=$id)
					OR (`SID`=$id AND `DID`=$userid) ORDER BY 1 ASC";
					$stmt = $con->prepare($query);
					$stmt->execute();
					$persons = $stmt->fetchAll();


					
					
					
					$query="SELECT * FROM Profile WHERE ID = ?";			
					$stmt = $con->prepare($query);
					$stmt->execute(array($id));
					$perso = $stmt->fetch();
					
					

					echo '
					


					<div class="load_message">
					<div class="infi" style="display:flex;justify-content:space-between;width:100%;align-items:center;border-bottom:1px solid rgb(8,160,233);margin: 5px 10px 10px 5px;padding:10px 0;">
					<img src="./uploads/pics/'.$perso["Photo"].'" class="pira" style="width:50px;height:50px;border-radius:50%;">
					<h2>'.$perso["Username"].'</h2>
				</div> 
					';
					foreach($persons as $person){
						if($person["SID"]==$userid && $person["DID"]==$id){
							echo '<div id="blue">'.$person["Message"].'</div>';
						}
						else{
							echo '<div id="green">'.$person["Message"].'</div>';
						}
						
					}
					echo '</div>
					<div class="posti">
					
					<form action="" method="POST">
					<div class="bj">
							<textarea name="message"></textarea>
						<input type="submit" class="send" name="send_message" value="Send">
						</div>
					</form>
					</div>
					
					
					';
				}
					

				?>

				<?php if(isset($_POST['send_message'])){

					$msg=$_POST["message"];
					if($msg == ""){
						echo "Please Enter a Message";
					}
					else{
					$query="INSERT INTO Messages(Message,SID,DID) VALUES(:zmessage,:zsid,:zdid)";
					$stmt = $con->prepare($query);

						$stmt->execute(array(

							'zmessage' 	=> $msg,
							'zsid' 	=> $userid,
							'zdid' => $id
	
						));

						


					}
				} ?>
				
		
		<script>
	let logout = document.querySelector('.logout');
	let logui = document.querySelector('.logui');
	const createlog = () => {
		if(logui.style.display != "none")
		logui.style.display="none";
		else logui.style.display = "block";
	}

	logout.addEventListener('click',createlog);
	
	

	

	
</script>

</body>
</html>