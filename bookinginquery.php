<?php require_once("includes/initialize.php");
$usermail = User::field_by_id(1,email);
$ccusermail = User::field_by_id(1,optional_email);
$sitename = Config::getField('sitename',true);

foreach($_POST as $key=>$val){$$key=$val;}
	$body = '';
	$body .= '	  
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="flight_table">
        <tbody>
            <tr><td style="padding:3px; font-size:16px;"><strong>Personal Information</strong></td></tr>
            <tr><td style="padding:3px;"><strong>Your Full Name :</strong>&nbsp;'.$fullname.'</td></tr>
            <tr><td style="padding:3px;"><strong>Email :</strong>&nbsp;'.$mailaddress.'</td></tr>
            <tr><td style="padding:3px;"><strong>Phone :</strong>&nbsp;'.$tel.'</td></tr>
            <tr><td style="padding:3px;"><strong>Country :</strong>&nbsp;'.$country.'</td></tr>
                
            <tr><td style="padding:3px; font-size:16px;"><strong>Other Details</strong></td></tr>  
            <tr><td style="padding:3px;"><strong>Check In Date :</strong>&nbsp;'.$checkIn.'</td></tr>
            <tr><td style="padding:3px;"><strong>Check Out Date :</strong>&nbsp;'.$checkOut.'</td></tr>
            <tr><td style="padding:3px;"><strong>Flight In No :</strong>&nbsp;'.$in_flight.'</td></tr>
            <tr><td style="padding:3px;"><strong>Flight Out No :</strong>&nbsp;'.$out_flight.'</td></tr>
            <tr><td style="padding:3px;"><strong>Airport Pick Up :</strong>&nbsp;'.$air_pickup.'</td></tr>
            <tr><td style="padding:3px;"><strong>Airport Drop :</strong>&nbsp;'.$air_drop.'</td></tr>

            <tr><td style="padding:3px;"><strong>No of Person :</strong>&nbsp;'.$nop.'</td></tr>
          	<tr><td style="padding:3px;"><strong>Adults :</strong>&nbsp;'.$adult.'</td></tr>
          	<tr><td style="padding:3px;"><strong>Children :</strong>&nbsp;'.$child.'</td> </tr>
          	<tr><td style="padding:3px;"><strong>Room Type :</strong>&nbsp;'.$room.'</td></tr>
          	<tr> <td style="padding:3px;"><strong>Purpose To Visit :</strong>&nbsp;'.$purpose.'</td></tr>
          	<tr><td style="padding:3px;"><strong>Inquiry :</strong>&nbsp;'.$message.'</td></tr>
	        <tr>
	          td><p>&nbsp;</p>
				<strong><p>Thank you,<br />
				'.$fullname.'</strong>
				</p></td>
	          
	        </tr>
      	</tbody>
  	</table> ';
	
	/*
	* mail info
	*/
	
	$mail = new PHPMailer(); // defaults to using php "mail()"
	
	$mail->SetFrom($mailaddress, $fullname);
	$mail->AddReplyTo($mailaddress,$fullname);
	
	$mail->AddAddress($usermail, $sitename);
	// if add extra email address on back end
	if(!empty($ccusermail)){
		$rec = explode(';', $ccusermail);
		if($rec){
			foreach($rec as $row){
				$mail->AddCC($row,$sitename);
			}		
		}
	}

	$mail->Subject    = "Online Booking - ".$sitename;
	
	$mail->MsgHTML($body);

    /**Email to Subscriber**/
	$clientbody = '
		<table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
		  <tr>
			<td><p>Dear '.$fullname.',</p>
			</td>
		  </tr>
		  <tr>
			<td><p><span style="color:#0065B3; font-size:17px; font-weight:bold"> Thank you for booking in '.ucwords($sitename).' </span><br />
			 <p><span style="font-size:14px; font-weight:bold"> We will contact you soon.</p>
			</td>
		  </tr>
		 <!-- <tr>
			<td>
			   <p style="display:block;padding:15px;background:#189a58;color:white;">20% off on reservation for all rooms till 31st Jan, 2017</p>
			</td>
			</tr>-->
		  <tr>
			<td><p>&nbsp;</p>
				<strong><p>Thank you,<br />
				'.$sitename.'
				</p></strong>
			</td>
		  </tr>
		</table>';
		
		/** mail info**/	
		$cmail = new PHPMailer(); // defaults to using php "mail()"	
		$cmail->SetFrom($usermail, $sitename);
		$cmail->AddReplyTo($usermail, $sitename);	
		
		$cmail->AddAddress($mailaddress, $fullname);
		$cmail->Subject    = "Thank You For Booking - ".$sitename;
		$cmail->MsgHTML($clientbody);

		if(!$mail->Send()) {
		 	echo json_encode(array("action"=>"unsuccess","message"=>"Sorry! could not send your request."));
	    }else{
	    	$cmail->Send();
			echo json_encode(array("action"=>"success","message"=>"You message has been sent !"));
	    }		
?>