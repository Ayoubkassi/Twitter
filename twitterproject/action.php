<?php

//action.php

include('init.php');

session_start();
$username = $_SESSION['Username'];
$userid= getID($username);

		$ok=true;
		$id = $_GET['id'];
		$do = $_GET['do'];
	switch ($do){
		 case "follow":
		 follow_user($userid,$id);
		 $msg = "You have followed a user!";
		 break;
		 case "unfollow":
		 unfollow_user($userid,$id);
		 $msg = "You have unfollowed a user!";
		 break;
		 case "retweet":
		retweet(intval($userid),intval($id));
		$ok=false;
		break;
		}
		$_SESSION['message'] = $msg;
	$ok ?	header("Location:signup8.php"):header("Location:home.php");
	

