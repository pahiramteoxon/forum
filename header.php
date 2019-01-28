<?php

session_start();
include_once 'config/function.php';

$user = new DataOperation();
$uid = $_SESSION['id'];

if (isset($_REQUEST['submit'])) {
	extract($_REQUEST);
	$login = $user->check_login($email,$password);
	if ($login){
		// echo "LOGIN SUCCESSFUL";	
		header("location:index.php");	
		
	}
	else {
		echo "LOGIN FAILED";
	}		
}


// if(isset($_SESSION['uid'])){
// 	header("location:index.php");
// }

// if(isset($_GET['logout'])){
// 	$user->user_logout();
// 	header("location:header.php");
// }


?>
<!DOCTYPE html>
<html>
<head>
	<title>FORUM</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/bootstrap/bootstrap/dist/css/bootstrap.min.css">

	<script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	
</head>	



<body>
<div class="header sticky-top" id="header">

<!-- 	<div class="top-meta-data d-flex align-items-center">
		<div class="navbar navbar-expand-sm justify-content-between align-items-center text-uppercase" id="social-footer">
		<hr>	
			<ul class="navbar-nav mx-auto text-center">
				<li><a href="#" class="iconfb"><i class="fa fa-facebook"></i></a></li>
				<li><a href="#" class="icontwitter"><i class="fa fa-twitter"></i></a></li>
				<li><a href="#" class="icongp"><i class="fa fa-google-plus"></i></a></li>
				<li><a href="#" class="iconinsta"><i class="fa fa-instagram"></i></a></li>
			</ul>
		</div>
	</div> -->


<div class="top-meta-data d-flex align-items-center justify-content-end">
<nav class="navbar navbar-light navbar-expand-md justify-content-between align-items-center w-100 text-uppercase">
<hr>

<a href="index.php" class="navbar-brand">
	<h4 class="pl-4">Forum</h4>
</a>	

<button class="navbar-toggler" data-toggle="collapse" data-target="#navCollapse">
	<span class="navbar-toggler-icon"></span>
</button>
				
	<div class="collapse navbar-collapse" id="navCollapse">
	<ul class="navbar-nav mx-auto text-center">
<!-- 	<li class="nav-item px-3">
			<a href="index.php" class="nav-link" id="nav-linkz">Home</a>
		</li> -->
		<li class="nav-item px-3">
			<a href="index.php" class="nav-link" id="nav-linkz">Home</a>
		</li>
		<li class="nav-item px-3">
			<a href="chat.php" class="nav-link" id="nav-linkz">Messages</a>
		</li>
		<li class="nav-item px-3">
			<a href="about_author.html" class="nav-link" id="nav-linkz">About</a>
		</li>
		<li class="nav-item px-3">
			<a href="contact_us.html" class="nav-link" id="nav-linkz">Contact Us</a>
		</li>
	</ul>

	<?php if(!$uid) { ?>

	<form class="form-inline my-0 my-lg-0">
	    <button class="btn btn-secondary my-2 my-sm-0" type="button" data-toggle="modal" data-target="#loginModal" data-backdrop="static" data-keyboard="false">Login
	    </button>   
  	</form>

	<?php } else { ?>

<h6 class="mt-2 nav-link" id="nav-linkz">
<!-- 	<?php 	
		$myrow = $obj->get_fullname($uid);
			foreach($myrow as $row):
			echo 
			ucfirst($row['first_name'])." ". 
			ucfirst($row['middle_name'])." ".
			ucfirst($row['last_name']);
			endforeach;
	?> -->
</h6>					
						

	<form class="form-inline float-right">
		<a class="nav-link" id="nav-linkz" href="index.php?logout=logout">LOGOUT</a>
  	</form>

  <?php } ?>

	</div>
		
</nav>
</div>
</div>

<!-- login modal-->
<div class="modal" id="loginModal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<div class="modal-content">



	<div class="row">
	<div class="list-group d-flex flex-row row-hl col-lg-12 px-2" id="th_disc" role="tablist">

	    <a class="list-group-item list-group-item-action active btn-outline-secondary btn text-center" data-toggle="list" href="#signin" role="tab">
	        <h3 class="pop-title pt-1">Sign In</h3>
	    </a>
	    <a class="list-group-item list-group-item-action btn-outline-secondary btn text-center" data-toggle="list" href="#signup" role="tab">
	       	<h3 class="pop-title pt-1">Sign Up</h3>
	    </a>  

	</div>
	</div>

    <div class="modal-header">
    <!-- <h5 class="modal-title">Login</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

    <div class="modal-body">
    <div id="myTabContent" class="tab-content">	
    <div class="tab-pane active in" id="signin">	
    <form class="form-signin" name="login" method="POST">
          
        <div class="form-label-group">
            <label for="inputEmail">Username</label>
            <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Username" required autofocus>
        </div>
          
        <div class="form-label-group">
            <label for="inputPassword">Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        </div>
          
        <div class="checkbox mb-3">
            <label>
            	<input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
            <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit" onclick="return(submitLogin())">Sign in</button>
               
    </form> 
	</div>


    <div class="tab-pane fade" id="signup">	
    <form class="form-signup" name="register" method="POST">
          
        <div class="form-label-group">
            <label for="inputEmail">First Name</label>
            <input type="text" id="inputFirst" name="fname" class="form-control" placeholder="First Name" required autofocus>
        </div>

        <div class="form-label-group">
            <label for="inputEmail">Middle Name</label>
            <input type="text" id="inputMiddle" name="mname" class="form-control" placeholder="Middle Name" required autofocus>
        </div>

        <div class="form-label-group">
            <label for="inputEmail">Last Name</label>
            <input type="text" id="inputLast" name="lname" class="form-control" placeholder="Last Name" required autofocus>
        </div>

        <div class="form-label-group">
            <label for="inputEmail">Username</label>
            <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
        </div>

        <div class="form-label-group">
            <label for="inputEmail">Password</label>
            <input type="password" id="inputPass" name="pass" class="form-control" placeholder="Password" required autofocus>
        </div>
          
        <br>	  
            <button class="btn btn-lg btn-primary btn-block" name="submit_reg" type="submit" onclick="return(register())">Sign Up</button>
               
    </form> 
	</div>
	</div>
    </div>

<!--     <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div> -->

</div>
</div>
</div>
<!-- end login modal-->


</body>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="assets/bootstrap/bootstrap/dist/js/bootstrap.min.js"></script>

<?php

if (isset($_REQUEST['submit_reg'])) {
	extract($_REQUEST);
	$reg = $user->registerinfo($username,$pass,$fname,$mname,$lname);
	if ($reg){
		echo '<script> $("#loginModal").modal("show");</script>';	
	}
	else {
		echo "REGISTRATION FAILED";
	}
}



?>

<script type="text/javascript">

	function submitLogin(){
		var form = document.login;
		if(form.email.value == ""){
			alert("enter email or username");
			return false;
		}
		else if(form.password.value == ""){
			alert("enter password");
			return false;
		}
	}

	function register(){
		var form = document.register;
		if(form.username.value == ""){
			alert("enter username");
			return false;
		}
		else if(form.pass.value == ""){
			alert("enter password");
			return false;
		}
		else if(form.fname.value == ""){
			alert("enter first name");
			return false;
		}
		else if(form.mname.value == ""){
			alert("enter middle name");
			return false;
		}
		else if(form.lname.value == ""){
			alert("enter last name");
			return false;
		}
	}
</script>





</html>
