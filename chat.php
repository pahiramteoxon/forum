<?php
session_start();
include_once 'config/function.php';
date_default_timezone_set('Asia/Manila');

$user = new DataOperation();
$uid = $_SESSION['id'];

if(!$user->get_session()) {
	header("location:header.php");
}

if(isset($_GET['logout'])){
	$user->user_logout();
	header("location:header.php");
}


?>


<!DOCTYPE html>
<html>
<head>
	<title>MESSAGES</title>

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/bootstrap/bootstrap/dist/css/bootstrap.min.css">

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<!-- <script type="text/javascript" src="assets/jquery-typeahead/dist/jquery.typeahead.min.js"></script> -->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">

</head>

<?php  include "header.php";?>

<body id="mess_body">




<section id="messages">
<!-- <div class="container"> -->
<div class="row m-0 p-0">	


	<div class="row pl-5">
				<h6 class="prof_title">
					<br>
					<?php 	
						$myrow = $obj->get_fullname($uid);
						foreach($myrow as $row):
						echo 
						ucfirst($row['first_name'])." ". 
						ucfirst($row['middle_name'])." ".
						ucfirst($row['last_name']);
						endforeach;
					?>
				
				</h6>
	</div>

<div class="col-md-5 p-0 mt-5 m-0">
<br>	
	<form action="" method="GET">			
		<div class="col-md-12 p-0">	
        <div class="input-group">
           <input type="text" class="search-query form-control" name="code_search" placeholder="Search" id="searchs">
               <button class="btn" type="submit" id="search_btn">
                  <i class=" fa fa-search"></i>
               </button>
        </div>
        </div>
    </form>


<div id="mess_section">
        
	<table class="table-bordered" id="display_users">
	<form action="" method="POST">	
		<?php		
			$myrow = $obj->fetch_users($uid );
			foreach($myrow as $row):
			$uidss = $row['id'];	
		?>
		
		<tbody id="">
			<tr class="clickable-row" id="<?php echo ucwords($row['first_name']." ".$row['middle_name']." ".$row['last_name']);?>">
				
				<td class="px-3" id="chat_td">

					<div class="row">	
					<input type="hidden" name="" value="<?php echo $row['id']; ?>" id="idu">
					<img src="assets/images/profile.png" class="mess_img">
					
					<span class="mt-2 pt-2">
						<?php 
							echo ucwords($row['first_name']) ." ";
							echo ucwords($row['middle_name']) ." "	;
							echo ucwords($row['last_name']);
						?>
					</span>	
					</div>

					<div class="row mx-5 pb-2" id="mess_prev">	
						<?php 
							echo ucwords($row['first_name']) ." ";
						?>
					</div>		

				</td>	
			</tr>	
		</tbody>

		<?php endforeach; ?>	

	</form>	
	</table>

	<table id="resultt">
		
	</table>
	
				

</div> <!--mess section -->
</div> <!-- col-md-5 -->


<div class="col-md-5 mt-5">
<div class="container">
    <div class="row">

    	<div id="chat"></div>


    </div>
</div>
</div>


</div> <!-- row -->
<!-- </div> -->	<!-- container -->
</section> <!-- section -->




</body>

<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="assets/bootstrap/bootstrap/dist/js/bootstrap.min.js"></script>

<script type="text/javascript">
	
	$("#searchs").keyup(function(){

		var code_search = this.value;

		$.ajax({
			method:"POST",
			url: "result.php" ,
			data:{ps:1,keyword:code_search},
			success: function(data){
				$("#display_users").css("display","none");
				$('#resultt').show();
				$('#resultt').html(data);
				
			}

		});
	});



	$("body").delegate(".clickable-row","click" ,function(event){
	event.preventDefault();

	var uids = $(this).attr("id"); // contact name
	var idu = $(this).find('#idu').val(); //id on contacts senderid
	var sid = "<?php echo $uid; ?>"; //login id receiverid

		$.ajax({
			method:"POST",
			url: "result.php" ,
			data:{chat:1,recid:sid,sendid:idu},
			success: function(data){
				$("#chat").show();
				$("#chat").html(data);
				
			}

		});

});


	$("body").delegate(".msg_icon" ,"click" , function(e){
	
	var uids = $(this).attr("id"); // contact name
	var idu = $(this).attr('data-id'); //id on contacts senderid
	var sid = "<?php echo $uid; ?>"; //login id receiverid	
	var mess = $(".msg_input").val() // textarea
		
			 $.post(
			 	"result.php" , 
			 	{sent:1,recid:idu,sender:sid,message:mess},
			 	function(data) {
			 		alert(idu);
			 		$("#chat").html(data);
			 		
			 	});
			}); 


	$("body").delegate("#minimize" ,"click" , function(e){
		$("#chat").css("display","none");

   });

</script>



</html> 