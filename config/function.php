<?php

include "database_connect.php";

class DataOperation extends User {

	//for login process
	public function check_login($email,$password){

	// $password = md5($password);
		$sql = "SELECT id from user_info where username='$email' and password='$password'";
		$result = mysqli_query($this->con,$sql);
		$userdata = mysqli_fetch_array($result);
		$count_row = $result->num_rows;
		
		if ($count_row == 1) {
			$_SESSION['login'] = true;
			$_SESSION['id'] = $userdata['id'];
			return true;
		}
		else {
			return false;
		}
	}
	//end of login process


	//register
	public function registerinfo($username,$pass,$fname,$mname,$lname){
    	$password = md5($password);
    	$sql = "SELECT * FROM user_info where username = '$username'";

    	$check = $this->con->query($sql);
    	$count_row = $check->num_rows;

    	//insert in db

    	if ($count_row == 0) {
    		$sql1 = "INSERT INTO user_info SET username = '$username', password = '$pass' ,
    		first_name = '$fname' , middle_name = '$mname', last_name = '$lname' ";
    		$result = mysqli_query($this->con,$sql1)
    		or die(mysqli_connect_error()."Data cannot insert data");
    		return $result;
    	}
    	else {
    		return false;
    	}
	}
	//end


	//session start
	public function get_session(){
			return $_SESSION['login'];
	}
	//end session


	//show name or email 
    public function get_fullname($uid){
    	$sql = "SELECT *from user_info WHERE id = '$uid' ";
    	 $array = array();
    	$result = mysqli_query($this->con,$sql);
    	// $user_data = mysqli_fetch_array($result);
    	while($row = mysqli_fetch_assoc($result)){
	 	$array[] = $row;
	 	}
	 	return $array;
    	// echo $user_data['first_name']." ".$user_data['middle_name']." ".$user_data['last_name'];
    }
	//end


	//logout destroy session
	public function user_logout(){
		$_SESSION['login'] = false;
		session_destroy();
	}
	//end


	//add topic title, desc
	public function addTopic($table,$fields){
		 $sql ="";
		 $sql .=" INSERT INTO " .$table;
		 $sql .=" (".implode(",",array_keys($fields)).") VALUES ";
		 $sql .="('".implode("','",array_values($fields))."')";
		 //echo $sql;
		 $query = mysqli_query($this->con,$sql);
		 if($query){
		   return true;
		 }
	}
	//end

	// CHAT MESSAGE // REPLY
	public function sendmessage($table,$fields){
		 $sql ="";
		 $sql .=" INSERT INTO " .$table;
		 $sql .=" (".implode(",",array_keys($fields)).") VALUES ";
		 $sql .="('".implode("','",array_values($fields))."')";
		 //echo $sql;
		 $query = mysqli_query($this->con,$sql);
		 if($query){
		   return true;
		 }
	}
	//end

	//for fetch data
	 public function fetch_data(){
	 $sql = "SELECT t.id,t.topic,t.topic_desc,t.date,u.first_name,u.middle_name,u.last_name,
	 		 u.id as uid
	 		 FROM topic t 
	 		 LEFT JOIN user_info u on u.id = t.user
	 		 ORDER BY t.date DESC";
	 $array = array();
	 $query = mysqli_query($this->con,$sql);
	 while($row = mysqli_fetch_assoc($query)){
	 	$array[] = $row;
	 }
	 return $array;
	}
	//end


	//for fetch datacomments
	 public function fetch_comments($tid){
	 $sql = "SELECT * FROM comment c 
	 		 LEFT JOIN user_info u on u.id = c.user
	 		 WHERE topic_id = '$tid' 
	 		 ORDER BY c.date DESC";
	 $array = array();
	 $query = mysqli_query($this->con,$sql);
	 while($row = mysqli_fetch_assoc($query)){
	 	$array[] = $row;
	 }
	 return $array;
	}
	//end


	//count comments per post
	public function count_replies($tid){
	 $sql = "SELECT COUNT(comment.id) as comments FROM `comment` WHERE topic_id = '$tid'";
	 $array = array();
	 $query = mysqli_query($this->con,$sql);
	 while($row = mysqli_fetch_assoc($query)){
	 	$array[] = $row;
	 }
	 return $array;
	}
	//end

	//fetch users
	public function fetch_users($id){
	 $sql = "SELECT * FROM user_info WHERE id != '$id'";
	 $array = array();
	 $query = mysqli_query($this->con,$sql);
	 while($row = mysqli_fetch_assoc($query)){
	 	$array[] = $row;
	 }
	 return $array;
	}
	//end

	//fetch users on id
	public function fetch_userswid($id){
	 $sql = "SELECT * FROM user_info WHERE id = '$id' ";
	 $array = array();
	 $query = mysqli_query($this->con,$sql);
	 while($row = mysqli_fetch_assoc($query)){
	 	$array[] = $row;
	 }
	 return $array;
	}
	//end	

	//fetch users on id
	public function fetch_userschat($rec_id,$send_id){
	 $sql = "SELECT * FROM reply r
    		 LEFT JOIN user_info u on u.id = r.sender_id
    		 WHERE r.sender_id = '$send_id' and r.receiver_id = '$rec_id' 
    		 or  r.sender_id = '$rec_id' and r.receiver_id = '$send_id'
             ORDER BY r.date_chat ASC ";		 
	 $array = array();
	 $query = mysqli_query($this->con,$sql);
	 while($row = mysqli_fetch_assoc($query)){
	 	$array[] = $row;
	 }
	 return $array;
	}
	//end

	//fetch users on id
	public function fetch_chatter($send_id){
	 $sql = "SELECT * FROM reply r
    		 LEFT JOIN user_info u on u.id = r.sender_id
    		 WHERE r.sender_id = '$send_id'
             GROUP BY u.id"; 		 
	 $array = array();
	 $query = mysqli_query($this->con,$sql);
	 while($row = mysqli_fetch_assoc($query)){
	 	$array[] = $row;
	 }
	 return $array;
	}
	//end

	//search ajax query
	 public function fetch_search($codesearch){
	 $sql = "SELECT  * FROM user_info WHERE first_name LIKE '%$codesearch%' OR middle_name LIKE '%$codesearch%' OR last_name LIKE '%$codesearch%'";
	 
	 $array = array();
	 $query = mysqli_query($this->con,$sql);
	 while($row = mysqli_fetch_assoc($query)){
	 	$array[] = $row;
	 }
	 return $array;
	}
	//


} // end class

$obj = new DataOperation;

if(isset($_POST['post_topic'])) {
		$myarray = array(
		"topic"=>$_POST['topic'],
		"topic_desc"=>$_POST['topicdesc'],
		"user"=>$_POST['user'],	
		);

		if($obj->addTopic("topic" , $myarray)){
			header("location:index.php?msg=success");	
		}
		else{
			header("location:index.php?msg=failed");
		}
}

if(isset($_POST['post_comment'])) {
		$myarray = array(
		"comment_msg"=>$_POST['commentdesc'],
		"user"=>$_POST['user'],	
		"topic_id"=>$_POST['tid'],	
		);

		if($obj->addTopic("comment" , $myarray)){
			header("location:index.php?msg=commentsuccess");	
		}
		else{
			header("location:index.php?msg=commentfailed");
		}
}

//sub comment
if(isset($_POST['post_subcomment'])) {
		$myarray = array(
		"comment_msg"=>$_POST['commentdesc'],
		"user"=>$_POST['user'],	
		"topic_id"=>$_POST['tid'],	
		);

		if($obj->addTopic("comment" , $myarray)){
			header("location:index.php?msg=commentsuccess");	
		}
		else{
			header("location:index.php?msg=commentfailed");
		}
}


// if(isset($_POST['replysent'])){
// 		$myarray = array(
// 		"message"=>$_POST['sent_message'],
// 		"sender_id"=>$_POST['sender'],	
// 		"receiver_id"=>$_POST['receiver'],	
// 		);

// 		if($obj->sendmessage("reply" , $myarray)){
// 			header("location:chat.php?msg=messagesent");	
// 		}
// 		else{
// 			header("location:chat.php?msg=sendingfailed");
// 		}
// }

?>