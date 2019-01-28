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
	<title>FORUM</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/bootstrap/bootstrap/dist/css/bootstrap.min.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
	
</head>	


<body>

<?php  include "header.php";?>
<!-- <a href="index.php?logout=logout">LOGOUT</a> -->


<section id="create_topic" class="mt-4">
<div class="container">
<div class="row">	

		
	<div class="col-md-9">
	<div class="row">

		<div class="col-md-9">	
		<div class="row">
			<img src="assets/images/profile.png" class="prof_img">
			<div class="pt-3">
				
				<h6 class="prof_title pl-3 ">
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

				<h6 class="prof_user pl-3 ">by: 
					<?php 
						$myrow = $obj->get_fullname($uid);
						foreach($myrow as $row):
						echo 
						ucfirst($row['username']);
						endforeach;
					?> 
				<!-- | Posted: 1 week ago | 14 replies -->
				</h6>
			</div>	
		</div>	
		</div>

		
		<div class="col-md-12 mt-2">	
		<br>
		<form action="" method="POST" runat="server">	
			<div class="row m-0 p-0">
					<?php 
						$myrow = $obj->get_fullname($uid);
						foreach($myrow as $row):
						$neym = ucwords($row['id']);
						endforeach;
					?> 
				<input type="hidden" name="user" value="<?php echo $neym; ?>">
				<div id="topic" class="pt-2 px-3">
					<span id="create_post">CREATE POST</span>
				</div>
				<input type="text" name="topic" id="" class="topic_title w-100 p-3" placeholder="&#xf101;  Enter topic title ">	

				<textarea type="text" name="topicdesc" placeholder="Start a new topic !	" id="topic_create"></textarea> 
				
<!-- 				<span class="pt-2">
					<input type="image" src="assets/images/gallery2.png" class="icon_img">
					<input type="file" id="my_file" style="display: none;">	
					<img src="#" id="pics"alt="your image" />
				</span>
				<h6 class="post_icon pl-2 pt-3">Photo</h6> -->	
			</div>
			<br>	
				<button class="btn btn-primary btn-sm float-right px-2 post_button" type="submit" name="post_topic">NEW POST</button><br><br>	
		</form>
		</div>
		


	</div>
	</div>

	
	<div class="col-md-9">	
	<div class="row">	

		<div class="col-lg-12 p-0">
			<div class="row">
			<div class="list-group d-flex flex-row row-hl col-lg-12 px-2" id="th_disc" role="tablist">

			    <a class="list-group-item list-group-item-action active btn-outline-secondary btn text-center" data-toggle="list" href="#feed" role="tab">
			        <h3 class="pop-title pt-1">Discussion</h3>
			    </a>
			    <a class="list-group-item list-group-item-action btn-outline-secondary btn text-center" data-toggle="list" href="#recent" role="tab">
			       	<h3 class="pop-title pt-1">Recent</h3>
			    </a>

			    <a class="list-group-item list-group-item-action btn-outline-secondary btn text-center" data-toggle="list" href="#recent" role="tab">
			       	<h3 class="pop-title pt-1">My Posts</h3>
			    </a>    

			</div>
			</div>
		</div>
	

    	<div id="myTabContent" class="col-md-12 p-0 tab-content">	
    	<div class="tab-pane active in" id="feed">	
    	<table class="table table-hover">	
		<tr>
			<td>

			<?php
			$myrow = $obj->fetch_data();
			foreach($myrow as $row):
				$dates = $row['date'];	
				$date  = date_create($dates);
				$topic_date =  date_format($date,"F j, Y");	
				$oldTime =  date_format($date,"y-m-d h:i:s");
				$newTime = date("y-m-d h:i:s");

				$tid = $row['id'];
				$desc = $row['topic_desc'];
				$title = $row['topic'];

//converting timestamp to x h.m.s ago

				$timeCalc = strtotime($newTime)-strtotime($oldTime);

				if ($timeCalc > (60*60*24)) {
					$timeCalc = round($timeCalc/60/60/24)." days ago";
				}
				else if ($timeCalc > (60*60)) {
					$timeCalc = round($timeCalc/60/60) . " hours ago";
				}
				else if ($timeCalc > 60) {
					$timeCalc = round($timeCalc/60) . " minutes ago";
				}

				else if ($timeCalc > 0) {
					$timeCalc .= " seconds ago";
				}
				else if ($timeCalc == 0) {
					$timeCalc .= " second ago";
				}
//end							
			?>
				<h4 class=" pt-2 td_disc">	
				<i class="fa fa-user">				
				<span class="neym"> 
					<?php 
							echo 
							ucwords($row['first_name'])." ". 
							ucfirst($row['middle_name'])." ".
							ucfirst($row['last_name']);
					?>
				</span>	
				</i>					
				</h4>

				<h6 class="pl-3 pt-0 td_user">				
					<span class="neym"> 							
						<input type="hidden" name="user" value="<?php echo $tid;?>">
					</span>		
					  
					
					<span class="date">
						<i class="fa fa-clock-o">
						<?php echo " Posted ". $timeCalc. "  |";?>
						</i>
					</span>				
					

					<?php 
						$myrow = $obj->count_replies($tid);
						foreach($myrow as $row):
						$replies = $row['comments'];
						endforeach;
					?>
					<span class="date">
						<?php 
						if($replies <= 1){
							echo $replies." comment  |";
						}
						else {
							echo $replies." comments  |";
						}
					
						?> 
					</span>

					<span class="date">
						<?php echo strtoupper($title);?>
					</span>	
				</h6>

				<p class="pl-5"><?php echo $desc;?></p>

				<form action="" method="POST" runat="server">
					<?php 
						$myrow = $obj->get_fullname($uid);
						foreach($myrow as $row):
						$neym = ucwords($row['id']);
						endforeach;
					?> 
				<input type="hidden" name="user" value="<?php echo $neym; ?>">
				<input type="hidden" name="tid" value="<?php echo $tid; ?>">
				<h6 class="td_repl pl-3 td_user">

					<button class="btn btn-primary btn-sm ml-5 float-right" type="submit" name="post_comment">COMMENT</button>
				</h6>	
				<div class="row">
				<div class="col-md-12 p-0">
					<textarea id="comment_section" class="ml-4" name="commentdesc"></textarea>
				</div>
				</div>

				</form>


				<?php 
					$myrow = $obj->fetch_comments($tid);
					foreach($myrow as $row):

				$datess = $row['date'];	
				$dates  = date_create($datess);
				$topic_date =  date_format($dates,"F j, Y");	
				$oldTimes =  date_format($dates,"y-m-d h:i:s");
				$newTimes = date("y-m-d h:i:s");

//converting timestamp to x h.m.s ago

				$timeCalcs = strtotime($newTimes)-strtotime($oldTimes);

				if ($timeCalcs > (60*60*24)) {
					$timeCalcs = round($timeCalcs/60/60/24)." days ago";
				}

				else if ($timeCalcs > (60*60)) {
					$timeCalcs = round($timeCalcs/60/60) . " hours ago";
				}

				else if ($timeCalcs > 60) {
					$timeCalcs = round($timeCalcs/60) . " minutes ago";
				}

				else if ($timeCalcs > 0) {
					$timeCalcs .= " seconds ago";
				}

				else if ($timeCalcs == 0) {
					$timeCalcs .= " seconds ago";
				}
			
				?>
				
				<div id="comments p-5	">
				<h6 class="pl-3 pt-0 mb-0 td_user">
					<i class="fa fa-user">
					<span class="neym"> 	
						<?php 
							echo 
							ucwords($row['first_name'])." ". 
							ucfirst($row['middle_name'])." ".
							ucfirst($row['last_name']);
						?>
					</span>			
					</i> 
				</h6>
				<p class="pl-5 mb-0 pt-0"><?php echo $row['comment_msg'];?></p>	
				<h6 class="pl-5 pt-0 td_comments">
					<i class="fa fa-clock-o">
						<span class="date">
							<?php echo $timeCalcs;?>
						</span>					
					</i>
				</h6>
					
				</div>

				<?php endforeach; ?>

				<form action="" method="POST" runat="server">
					<?php 
						$myrow = $obj->get_fullname($uid);
						foreach($myrow as $row):
						$neym = ucwords($row['id']);
						endforeach;
					?> 
				<input type="hidden" name="user" value="<?php echo $neym; ?>">
				<input type="hidden" name="tid" value="<?php echo $tid; ?>">
				<h6 class="td_repl pl-3 td_user">

					<button class="btn btn-primary btn-sm ml-5 float-right" type="submit" name="post_subcomment">SUB-COMMENT</button>
				</h6>	
				<div class="row">
				<div class="col-md-12 p-0">
					<textarea id="subcomment_section" class="ml-4" name="commentdesc"></textarea>
				</div>
				</div>

				</form>
				<br>

				<?php endforeach; ?>

				</td>
					
		</tr>
		</table>
		</div>


		<div class="tab-pane fade" id="recent">	
		<tr>
			<td>

				<h1>ayh</h1>	

			</td>			
		</tr>
		</div>

		</div>

<br><br>	

	</div>
	</div>

	<div class="col-md-3">
	<h6 id="f_topic" class="pb-2">&nbsp;&nbsp;&nbsp;FORUM TOPICS</h6>

		<ul>
		<?php
			$myrow = $obj->fetch_data("topic");
			 foreach($myrow as $row):		
		?>

			<li><?php echo strtoupper($row['topic']);?></li>

		<?php endforeach; ?>	
		</ul>

	</div>

</div>
</div>		
</section>



</body>	
	
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="assets/bootstrap/bootstrap/dist/js/bootstrap.min.js"></script>

<script type="text/javascript">

// click file upload
	$(".icon_img").click(function() {
	    $("#my_file").click();
	});
//end

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

$("#my_file").change(function(){
    readURL(this);
});

// function xTimeAgo ($oldTime, $newTime) {

// $timeCalc = strtotime($newTime)-strtotime($oldTime);

// if ($timeCalc > (60*60*24)) {
// 	$timeCalc = round($timeCalc/60/60/24)."days ago";
// }
// else if ($timeCalc > (60*60)) {
// 	$timeCalc = round($timeCalc/60/60) . "hours ago";
// }
// else if ($timeCalc > 60) {
// 	$timeCalc = round($timeCalc/60) . "minutes ago";
// }
// else if ($timeCalc > 0) {
// 	$timeCalc .= "seconds ago";
// }

// return $timeCalc;
// }



</script>

</html>