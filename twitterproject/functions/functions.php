
<?php 

function Postinfo($id){
	global$con;
	$stmt = $con->prepare("SELECT * FROM Posts WHERE PostID=$id LIMIT 1");
	$stmt->execute();
	$row = $stmt->fetch();
	return $row;
}

function retweet($userid,$id){
	global $con;
	// $id_num= int ($id);
	// $userid_num = int ($userid);
	$row = Postinfo($id);
	$pic = $row["Image"];
	$text= $row["Text"];
	$stmt=$con->prepare("INSERT INTO Posts(`UserID`,`Text`,`Image`) VALUES(:zid,:ztext,:zimage)");
	$stmt->execute(array(
		'zid' => $userid,
		'ztext' => $text,
		'zimage' => $pic
	));

}
function getPic($id){
	global $con;
	$stmt= $con->prepare("SELECT Photo FROM Profile WHERE ID=$id LIMIT 1");
	$stmt->execute();
	$row = $stmt->fetchColumn();
	return $row != "" ? $row:"img.png";
} 

function getLatestPosts($user, $limit = 15) {

		global $con;

		$getStmt = $con->prepare("SELECT * FROM Posts WHERE UserID IN (
			SELECT DID FROM Following WHERE SID=$user ORDER BY date DESC)
	 ");

		$getStmt->execute();

		$rows = $getStmt->fetchAll();

		return $rows;

	}

	function getLatestFllowers($user, $limit = 15) {

		global $con;

		$getStmt = $con->prepare("SELECT * FROM Profile WHERE ID IN (
			SELECT DID FROM Following WHERE SID=$user ORDER BY Username)
	 ");

		$getStmt->execute();

		$rows = $getStmt->fetchAll();

		return $rows;

	}



	function getName($id){
		global $con;
		$getName = $con->prepare("SELECT Username FROM Profile WHERE ID='$id'");
		$getName->execute();
		$row = $getName->fetchColumn();
		return $row;
	}

	function getID($name){
		global $con;
		$getID = $con->prepare("SELECT ID FROM Profile WHERE Username='$name'");
		$getID->execute();
		$row = $getID->fetchColumn();
		return $row;
	}


function check_count($first, $second){
	global $count;
 $sql = "SELECT COUNT(*) FROM Following
 WHERE SID='$second' AND DID='$first'";
 $result = mysql_query($sql);
 $row = mysql_fetch_row($result);
 return $row[0];
}

function check_follow($first,$second){
		global $con;

		$statement = $con->prepare("SELECT * FROM Following WHERE SID = $first AND DID = $second");

		$statement->execute();

		$count = $statement->rowCount();

		return $count;

}
function follow_user($me,$them){
	global $con;
	if(check_follow($me,$them) == 0){
 $sql =  $con->prepare("INSERT INTO Following (SID, DID)
 VALUES ($me,$them)");
 $sql->execute();}

 }




function unfollow_user($me,$them){
 
 	global $con;
 	if(check_follow($me,$them) != 0){
 $sql =  $con->prepare("DELETE FROM Following
 WHERE SID='$me' and DID='$them'
 limit 1");
 $sql->execute();}
}





/*function show_posts($userid,$limit=0){
 $posts = array();
 $user_string = implode(',', $userid);
 $extra = " and id in ($user_string)";
 if ($limit > 0){
 $extra = "limit $limit";
 }else{
 $extra = '';
 }
 $sql = "SELECT UserID,Text, date FROM Posts
 WHERE UserID in ($user_string)
 ORDER BY date DESC $extra";
 echo $sql;
 $result = mysql_query($sql);
 while($data = mysql_fetch_object($result)){
 $posts[] = array( 'date' => $data->date,
 'userid' => $data->UserID,
 'body' => $data->Text
 );
 }
 return $posts;
} */


/*function show_users($user_id=0){
 if ($user_id > 0){
 $follow = array();
 $fsql = "SELECT UserID FROM Following
 WHERE DID='$user_id'";
 $fresult = mysql_query($fsql);
 while($f = mysql_fetch_object($fresult)){
 array_push($follow, $f->user_id);
 }
 if (count($follow)){
 $id_string = implode(',', $follow);
 $extra = " AND ID IN ($id_string)";
 }else{
 return array();
 }
 }
 $users = array();
 $sql = "SELECT ID, Username FROM Profile
 WHERE status='active'
 $extra ORDER BY Username";
 $result = mysql_query($sql);
 while ($data = mysql_fetch_object($result)){
 $users[$data->ID] = $data->Username;
 }
 return $users;
}*/



function add_post($userid,$body){
 $sql = "INSERT INTO Posts (UserID, Text, Image,)
 VALUES ($userid, '". mysql_real_escape_string($body). "',$image)";
 $result = mysql_query($sql);
}


function show_posts($userid){
 $posts = array();
 $sql = "SELECT Text, date FROM Posts
 WHERE UserID = '$userid' ORDER BY date DESC";
 $result = mysql_query($sql);
 while($data = mysql_fetch_object($result)){
 $posts[] = array( 'date' => $data->date,
 'userid' => $userid,
 'body' => $data->Text
 );
 }
 return $posts;
}


function show_users(){
 $users = array();
 $sql = "SELECT ID, Username FROM Profile WHERE status='active' ORDER BY Username";
 $result = mysql_query($sql);
 while ($data = mysql_fetch_object($result)){
 $users[$data->id] = $data->username;
 }
 return $users;
}


function following($userid){
 $users = array();
 $sql = "SELECT DISTINCT SID from Following
 where DID = '$userid'";
 $result = mysql_query($sql);
 while($data = mysql_fetch_object($result)){
 array_push($users, $data->user_id);
 }
 return $users;
}










