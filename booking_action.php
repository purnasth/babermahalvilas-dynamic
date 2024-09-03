<?php
require_once("includes/initialize.php");

if($_POST['action']=="forbooking"):
	$usermail = User::get_UseremailAddress_byId(1);
	$ccusermail = User::field_by_id(1,'optional_email');
	$sitename = Config::getField('sitename',true);

	foreach($_POST as $key=>$val){$$key=$val;}

	$newArr=array();
	foreach($roomprice as $k=>$v)
	{
		foreach($roomprice[$k] as $rk=>$rv)
		{
			$newArr[] = array('roomname'=>$k, 'ppqnty'=>$ppqnty[$k][$rk], 'currency'=>$currency[$k][$rk], 'discount'=>$roomdis[$k][$rk], 'roomprice'=>$rv, 'roomqnty'=>$roomqnty[$k][$rk], 'extrabed'=>$extrabed[$k][$rk], 'extrabedrate'=>$extrabedrate[$k][$rk]);
		}
	}

	$body = '
	<table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
	  <tr>
		<td><p>Dear Sir,</p>
		</td>
	  </tr>
	  <tr>
		<td><p><span style="color:#0065B3; font-size:14px; font-weight:bold">Room Reservation Information Message</span><br />
		  The details provided are:</p>
	  		<p>
			    <span style="width:150px; display:inline-block; margin-bottom: 4px;"><strong>Full Name</strong></span> : '.$fullname.'<br />
				<span style="width:150px; display:inline-block; margin-bottom: 4px;"><strong>Email Address</strong></span> : '.$mailaddress.'<br />
				<span style="width:150px; display:inline-block; margin-bottom: 4px;"><strong>Phone</strong></span> : '.$phone.'<br />
				<span style="width:150px; display:inline-block; margin-bottom: 4px;"><strong>Address</strong></span> : '.$address.'<br />
				<span style="width:150px; display:inline-block; margin-bottom: 4px;"><strong>Country</strong></span> : '.$country.'<br />
				<span style="width:150px; display:inline-block; margin-bottom: 4px;"><strong>Check-In Date</strong></span> : '.$checkin.'<br />
				<span style="width:150px; display:inline-block; margin-bottom: 4px;"><strong>Check-Out Date</strong></span> : '.$checkout.'<div style="border-top: 1px solid #E0DFDF; margin:15px 0;"></div>
				<table width="100%">
					<tr style="background:#E0DFDF;">
						<th style="padding: 8px 10px;">S.No.</th>
						<th style="padding: 8px 10px;">Room Type</th>
						<th style="padding: 8px 10px;">Max</th>
						<th style="padding: 8px 10px;">Price Per Nights</th>
						<th style="padding: 8px 10px;">No. Rooms</th>
						<th style="padding: 8px 10px;">Extra Bed</th>
					</tr>';
				$sn=1;	
				foreach($newArr as $reck=>$recv)
				{
					if($recv['roomqnty']!='N/A')
					{
						$body.='<tr style="background: #F1F1F1;">
							<td style="padding: 8px 10px; text-align:center;">'.$sn.'</td>
							<td style="padding: 8px 10px; ">'.$recv['roomname'].'</td>
							<td style="padding: 8px 10px; text-align:center;">'.$recv['ppqnty'].'</td>
							<td style="padding: 8px 10px; text-align:center;">';
							    $body.='Currency: '.$recv['currency'].' <br />';
								$body.='Actual Rate: '.$recv['roomprice'].' <br />';
								$body.='After ('.$recv['discount'].'%) Discount: '.($recv['roomprice']-($recv['roomprice']*$recv['discount']/100));;
							$body.='</td>
							<td style="padding: 8px 10px;">'.$recv['roomqnty'].'</td>
							<td style="padding: 8px 10px;">';
								if($recv['extrabed']!='N/A' and $recv['extrabed']!='No')
								{
									$body.= $recv['extrabed'].' <br /> (Extra Bed Rate : '.$recv['extrabedrate'].')';
								}else{
									$body.='No';
								}
							$body.='</td>
						</tr>';	
					}
				$sn++; }
				$body.='</table>
                
				<div style="border-top: 1px solid #E0DFDF; margin:15px 0;"></div>
				
				<span style="display:inline-block; margin-bottom: 4px; color:#222;"><strong>Special Requirements or any Special Packages with Special Offer</strong></span> :<br /> '.set_na($special_offer).'
		  	</p>
		</td>
	  </tr>
	  <tr>
		<td><p>&nbsp;</p>
		<p>Thank you,<br />
		'.$fullname.'
		</p></td>
	  </tr>
	</table>';

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
	
	$mail->Subject    = "Room's Reservation ".$sitename;
	
	$mail->MsgHTML($body);

	/**Email to Subscriber**/
	$clientbody = '<table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
		  <tr>
			<td><p>Dear '.$fullname.',</p>
			</td>
		  </tr>
		  <tr>
			<td><p><span style="color:#0065B3; font-size:17px; font-weight:bold"> Thank you for booking in '.ucwords($sitename).' </span><br />
			 <p><span style="font-size:14px; font-weight:bold"> We will contact you soon.</p>
			</td>
		  </tr>
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
		echo json_encode(array("action"=>"unsuccess","message"=>"We could not sent your request at the time. Please try again later."));
	}else{
		$cmail->Send();
		echo json_encode(array("action"=>"success","message"=>"Your request has been successfully received, You will be shortly informed by admin."));
	}
endif;


if($_POST['action']=='foreventsbooking')
{
	$usermail = User::get_UseremailAddress_byId(1);
	$ccusermail = User::field_by_id(1,'optional_email');
	$sitename = Config::getField('sitename',true);

	foreach($_POST as $key=>$val){$$key=$val;}
	$body = '
	<table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
	  <tr>
		<td><p>Dear Sir,</p>
		</td>
	  </tr>
	  <tr>
		<td><p><span style="color:#0065B3; font-size:14px; font-weight:bold">Conference or Events Reservation Information message</span><br />
		  The details provided are:</p>
	  		<p><strong>Applicant\'s Name</strong> : '.$applicantsname.'<br />
	  			<strong>Organisation</strong> : '.$organisation.'<br />
	  			<strong>Address</strong> : '.$address.'<br />
	  			<strong>City</strong> : '.$city.'<br />
	  			<strong>Country</strong> : '.$country.'<br />
				<strong>Email Address</strong> : '.$mailaddress.'<br />
				<strong>Phone</strong> : '.$telno.'<br />
				<strong>Conference or Event Title </strong> : '.$conference_event.'<br />
				<strong>Conference Or Event Date</strong> : '.$events_date.'<br />
				<strong>Conference Or Event Start Time</strong> : '.$eventstart.'<br />
				<strong>Conference Or Event End Time</strong> : '.$eventend.'<br />
				<strong>Number Of Pax.</strong> : '.$nunofpax.'<br />
				<strong>Comment</strong><br /> : '.$comment.'<br />
		  	</p>
		</td>
	  </tr>
	  <tr>
		<td><p>&nbsp;</p>
		<p>Thank you,<br />
		'.$applicantsname.'
		</p></td>
	  </tr>
	</table>
	';
	
	/*
	* mail info
	*/
	
	$mail = new PHPMailer(); // defaults to using php "mail()"
	
	$mail->SetFrom($mailaddress, $applicantsname);
	$mail->AddReplyTo($mailaddress,$applicantsname);
	
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
	
	$mail->Subject    = "Conference or Events Reservation ".$sitename;
	
	$mail->MsgHTML($body);
	
	if(!$mail->Send()) {
		echo json_encode(array("action"=>"unsuccess","message"=>"We could not sent your request at the time. Please try again later."));
	}else{
		echo json_encode(array("action"=>"success","message"=>"Your request has been successfully received, You will be shortly informed by admin."));
	}
}

if($_POST['action']=='forcareers')
{
	$usermail = User::get_UseremailAddress_byId(1);
	$ccusermail = User::field_by_id(1,'optional_email');
	$sitename = Config::getField('sitename',true);

	foreach($_POST as $key=>$val){$$key=$val;}
	$body = '
	<table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
	  <tr>
		<td><p>Dear Sir,</p>
		</td>
	  </tr>
	  <tr>
		<td><p><span style="color:#0065B3; font-size:14px; font-weight:bold">'.$careertitle.' Career Opportunities Details</span><br />
		  The details provided are:</p>
	  		<p><strong>Fullname</strong> : '.$salutation.' '.$fullname.'<br />
	  			<strong>Current Address</strong> : '.$currentaddress.'<br />
	  			<strong>Home Phone</strong> : '.$homephone.'<br />
	  			<strong>Mobile No.</strong> : '.$mobileno.'<br />
				<strong>Email Address</strong> : '.$mailaddress.'<br />
				<strong>Career Title</strong> : '.$careertitle.'<br />
				<strong>Do You have any Experience?</strong> : '.$exptype.'<br />
				<strong>Exp. Years </strong> : '.$expyear.'<br />
				<strong>Exp. Months</strong> : '.$expmonth.'<br />
				<strong>Expect Salary: Per Month(Gross)</strong> : '.$es_currency_abb.' '.$SalaryCriteria.'<br />
				<strong>Salary Amount</strong> : '.$expectedSalary.'<br />
				<strong>Looking For</strong> : '.$optLevel.'<br />
				<strong>Available For</strong> : '.$availfor.'<br />
				<strong>Other Relevant Information</strong><br /> : '.$comment.'<br />
				<strong>Please Find the attachment for my Resume </strong>
		  	</p>
		</td>
	  </tr>
	  <tr>
		<td><p>&nbsp;</p>
		<p>Thank you,<br />
		'.$fullname.'
		</p></td>
	  </tr>
	</table>
	';
	
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
	
	$mail->Subject    = $careertitle." Career Opportunities Details For ".$sitename;
	
	$mail->MsgHTML($body);
	$mail->AddAttachment(SITE_ROOT.'uploadcareer/'.$uploadfile);
	
	if(!$mail->Send()) {
		echo json_encode(array("action"=>"unsuccess","message"=>"We could not sent your request at the time. Please try again later."));
	}else{
		echo json_encode(array("action"=>"success","message"=>"Your request has been successfully received, You will be shortly informed by admin."));
	}
}
?>