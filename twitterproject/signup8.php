<?php 
				session_start();
				include 'init.php' ;
				$username = $_SESSION['Username'];
				$userid= getID($username);
				follow_user($userid,$userid);
			/*if ($_SERVER['REQUEST_METHOD'] == 'POST'){*/



		
				
						?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="./resources/css/signup8.css">
</head>
<body class="mo">
 
<div class="container">
	<div class="top">
		<div><img src="./images/twitterlogo.png" id="na"></div>
		<form method="POST" action="home.php">
		<div><input type="submit" class="pro" id="finalo" value="Next"></div>
		</form>
	</div>
		<div class="bottom">
			<h2>Suggestions for you to follow</h2>
			<p>When you follow someone, you'll see their Tweets in your Home Timeline.</p>

			<div class="intere">You may be interesed in</div>
			<!--
			<div class="perso">
				<div class="tap">
					<div class="left">
						<div class="ima"><img src="./images/bayden.png" class="pir"></div>
						<div>
							<div class="name">
								<span class="nz">Joe Biden</span><img src="./images/suivre.png" class="verefi">
								<p id="tag">@JoeBiden</p>
							</div>
						</div>
					</div>
						<div class="right">
						<a href="" class="inp">Follow</a>
						</div>
				</div>
				<div class="bit">
					President-elect,husband to <span class="colo">@DrBiden</span>, proud father & grandfather.</br>Ready to build back better for all Americans.
				</div>
			</div>  -->

			<?php 


				$query="SELECT * FROM Profile WHERE Username != ?  ORDER BY ID DESC LIMIT 4";			
				$stmt = $con->prepare($query);
				$stmt->execute(array($username));
				$result = $stmt->fetchAll();
				$output="";
		

				foreach($result as $row){
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
					';
					if(check_follow($userid,$row["ID"]) == 0) $output.=
							'<a href="action.php?id='.$row["ID"].'&do=follow" class="inp">Follow</a>
						</div>
				</div>
				<div class="bit">
					'.$row["Bio"].'.
				</div>
			</div>

			';

			else $output.='<a href="action.php?id='.$row["ID"].'&do=unfollow" class="ha">Unfollow</a>
						</div>
				</div>
				<div class="bit">
					'.$row["Bio"].'.
				</div>
			</div>';
			
			
			



		}
		echo $output;
			
			?>


				<!--<div class="perso">
				<div class="tap">
					<div class="left">
						<div class="ima"><img src="./images/bayden.png" class="pir"></div>
						<div>
							<div class="name">
								<span class="nz">Joe Biden</span><img src="./images/suivre.png" class="verefi">
								<p id="tag">@JoeBiden</p>
							</div>
						</div>
					</div>
						<div class="right">
							<input type="submit" value="follow" class="inp">
						</div>
				</div>
				<div class="bit">
					President-elect,husband to <span class="colo">@DrBiden</span>, proud father & grandfather.</br>Ready to build back better for all Americans.
				</div>
			</div>

				<div class="perso">
				<div class="tap">
					<div class="left">
						<div class="ima"><img src="./images/bayden.png" class="pir"></div>
						<div>
							<div class="name">
								<span class="nz">Joe Biden</span><img src="./images/suivre.png" class="verefi">
								<p id="tag">@JoeBiden</p>
							</div>
						</div>
					</div>
						<div class="right">
							<input type="submit" value="follow" class="inp">
						</div>
				</div>
				<div class="bit">
					President-elect,husband to <span class="colo">@DrBiden</span>, proud father & grandfather.</br>Ready to build back better for all Americans.
				</div>
			</div>

				<div class="perso">
				<div class="tap">
					<div class="left">
						<div class="ima"><img src="./images/bayden.png" class="pir"></div>
						<div>
							<div class="name">
								<span class="nz">Joe Biden</span><img src="./images/suivre.png" class="verefi">
								<p id="tag">@JoeBiden</p>
							</div>
						</div>
					</div>
						<div class="right">
							<input type="submit" value="follow" class="inp">
						</div>
				</div>
				<div class="bit">
					President-elect,husband to <span class="colo">@DrBiden</span>, proud father & grandfather.</br>Ready to build back better for all Americans.
				</div>
			</div>
		-->

			





				</div>
	</div>

	<!-- <?php/* } else {
		echo "motherfucker";
				header('Location: index.php');
	}*/
?> -->
<script>
	/*btns = document.querySelectorAll('.inp');
	btns.forEach((btn)=>{
		btn.addEventListener('click',(e)=>{
			e.preventDefault();
			console.log(e);
			if(e.target.className === 'inp'){
				e.target.className="ha";
				e.href ="action.php?id=$row[ID]?do=unfollow";
				e.target.innerText = "Unfollow";
			}
			
			else {e.target.className="inp";
			e.target.value="action.php?id=$row[ID]?do=follow";
			e.target.innerText = "Follow";

		}
		});
	});
	/*
	fetch_user();

	function fetch_user(){
		let action = 'fetch_user';
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:action},
			success:function(data){
				$('#user_list').html(data);
			}
		});
	}

	*/
</script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>
</html>