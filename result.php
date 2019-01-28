<?php
session_start();
include_once 'config/function.php';

$user = new DataOperation();
$uid = $_SESSION['id'];

date_default_timezone_set('Asia/Manila');

// SEARCH //
if(isset($_POST['ps'])) {
			
				$code_search = $_POST['keyword'];
				$myrow = $obj->fetch_search($code_search);
					
			
			if($myrow) {		
				foreach($myrow as $row):

				
			?>	
			
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

					<div class="row mx-5 pb-1" id="mess_prev">	
						<?php 
							echo ucwords($row['first_name']) ." ";
						?>
					</div>		

					</td>	
			

<?php  endforeach; }

	else { ?>

				<div class="my-5 mx-5" id="no-result">
					<h6> NO RESULTS FOUND </h6>
				</div>

<?php 
	} //else

} //if isset

// END SEARCH //


// CHAT //
if(isset($_POST['chat'])){


			$recid = $_POST['recid'];
			$sendid = $_POST['sendid'];
			
			$myrow = $obj->fetch_userswid($sendid);
			foreach($myrow as $row):

			$ids = $row['id'];	
			$fname = $row['first_name'];
			$mname = $row['middle_name'];
			$lname = $row['last_name'];	
			
				// $oldTime =  date_format($date,"h:i:s");
				// $newTime = date("h:i:s");
		
		?>

<form action="" method="POST">	
<div class="msg_box" style="right:30px" id="chatbox">

    <div class="msg_head">
	     	<i class="fa fa-comments fa-lg"></i>
	     	<?php 
	     		echo ucwords(
	     			$row['first_name']." ".
	     			$row['middle_name']." ".
	     			$row['last_name']);
	     	?>
	    <div class="close" id="close">
	    	<i class="fa fa-close fa-sm" id="minimize"></i>
	    </div> 
    </div>

    <div class="msg_wrap"> 
    <div class="msg_body"> 

    <div class="panel-body msg_container_base">	
    	<input type="hidden" name="sender" value="<?php echo $sendid;?>">
	    <input type="hidden" name="receiver" value="<?php echo  $recid;?>">

	    <?php
	    
	    endforeach;   

				$myrow = $obj->fetch_userschat($recid,$sendid);
				foreach($myrow as $row):
					$recidlog = $row['receiver_id'];
					$dates = $row['date_chat'];	
					$date  = date_create($dates);
					$datesent =  date_format($date,"F j, Y , h:i a");	

		if($uid != $recidlog) {				
	    ?>	


    	<div class="row msg_container base_receive">
        <div class="col-md-10 col-xs-10 p-0">
            <div class="messages msg_receive">
                <p>
		    		<?php 
			     		echo $row['message']
			     	?>	
                </p>
                <time datetime="2009-11-13T20:00"><?php echo $datesent; ?></time>
            </div>
        </div>
        </div>
    
	    <?php 	
	    }	
			   

		else if($uid == $recidlog) {	
				
		?> 

        <div class="row msg_container base_sent">
        <div class="col-md-10 col-xs-10">
            <div class="messages msg_sent">
                <p>
		    		<?php 
			     		echo 
			     			$row['message']
			     	?>	
                </p>
                <time datetime="2009-11-13T20:00"><?php echo $datesent; ?></time>
            </div>
        </div>
        </div>        
    

	<?php 		
		} endforeach; 
	?> 

	</div>    
	    
	</div>      
	</div>  

	<div class="msg_footer">
	<div class="row m-0 p-0">
	    	<textarea class="msg_input" rows="4" placeholder="Send a message" name="sent_message"></textarea>
	    	<button class="msg_icon" name="replysent" type="button" data-id="<?php echo $ids; ?>" id="<?php echo ucwords($fname." ".$mname." ".$lname);?>">SEND
	    		<i class="fa fa-paper-plane-o"></i>
	    	</button>
	    	
	</div>
	</div>

</div>
</form>

<?php } 

if (isset($_REQUEST['sent'])) { 

		$sendid = $_REQUEST['sender'];
		$recid = $_REQUEST['recid'];

		$myarray = array(
		"message"=>$_REQUEST['message'],
		"sender_id"=>$sendid,	
		"receiver_id"=>$recid,	
		);

		$obj->sendmessage("reply" , $myarray);
				
		$myrow = $obj->fetch_userswid($recid);
		foreach($myrow as $row):
			$ids = $row['id'];
			$fname = $row['first_name'];
			$mname = $row['middle_name'];
			$lname = $row['last_name'];	

	?>


<form action="" method="POST">	
<div class="msg_box" style="right:30px" id="chatbox">

    <div class="msg_head">
	     	<i class="fa fa-comments fa-lg"></i>
	     	<?php 
	     		echo ucwords(
	     			$fname." ".
	     			$mname." ".
	     			$lname);
	     	?>
	    <div class="close" id="close">
	    	<i class="fa fa-close fa-sm"></i>
	    </div> 
    </div>

    <div class="msg_wrap"> 
    <div class="msg_body"> 

    <div class="panel-body msg_container_base">	
    	<input type="hidden" name="sender" value="<?php echo $sendid;?>">
	    <input type="hidden" name="receiver" value="<?php echo  $recid;?>">

	    <?php
	    
	    endforeach;   

				$myrow = $obj->fetch_userschat($recid,$sendid);
				foreach($myrow as $row):
					$recidlog = $row['receiver_id'];
					$dates = $row['date_chat'];	
					$date  = date_create($dates);
					$datesent =  date_format($date,"F j, Y , h:i a");	

		if($uid != $recidlog) {				
	    ?>	


    	<div class="row msg_container base_receive">
        <div class="col-md-10 col-xs-10 p-0">
            <div class="messages msg_receive">
                <p>
		    		<?php 
			     		echo $row['message'];
			     	?>	
                </p>
                <time datetime="2009-11-13T20:00"><?php echo $datesent; ?></time>
            </div>
        </div>
        </div>
    
	    <?php 	
	    }	
			   

		else if($uid == $recidlog) {	
				
		?> 

        <div class="row msg_container base_sent">
        <div class="col-md-10 col-xs-10">
            <div class="messages msg_sent">
                <p>
		    		<?php 
			     		echo 
			     			$row['message']
			     	?>	
                </p>
                <time datetime="2009-11-13T20:00"><?php echo $datesent; ?></time>
            </div>
        </div>
        </div>        
    

	<?php 		
		} endforeach; 
	?> 

	</div>    
	    
	</div>      
	</div>  

	<div class="msg_footer">
	<div class="row m-0 p-0">
	    	<textarea class="msg_input" rows="4" placeholder="Send a message" name="sent_message"></textarea>
	    	<button class="msg_icon" name="replysent" type="button" data-id="<?php echo $ids; ?>" id="<?php echo ucwords($fname." ".$mname." ".$lname);?>">SEND
	    		<i class="fa fa-paper-plane-o"></i>
	    	</button>
	    	
	</div>
	</div>

</div>
</form>
<?php } ?>



