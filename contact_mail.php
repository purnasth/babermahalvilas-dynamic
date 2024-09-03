<?php
require_once("includes/initialize.php");

if(isset($_POST['submit'])):
	$usermail = User::get_UseremailAddress_byId(1);
	$sitename = Config::getField('sitename',true);

	$name 				=	 $_POST['fullname'];
	$mailaddress 	= $_POST['mailaddress'];
	$phone				= $_POST['phone'];
	$website 			= $_POST['website'];
	$comment 			= $_POST['comment'];

	$body = '
	<table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
	  <tr>
		<td><p>Dear Sir,</p>
		</td>
	  </tr>
	  <tr>
		<td><p><span style="color:#0065B3; font-size:14px; font-weight:bold">Comment message</span><br />
		  The details provided are:</p>
		  <p><strong>Name</strong> : '.$name.'<br />		
		  <strong>E-mail Address</strong>: '.$mailaddress.'<br />
		  <strong>Phone</strong>: '.$phone.'<br />
		  <strong>Website</strong>: '.$website.'<br />
		  <strong>Message</strong>: '.$comment.'<br />
		  </p>
		</td>
	  </tr>
	  <tr>
		<td><p>&nbsp;</p>
		<p>Thank you,<br />
		'.$sitename.'
		</p></td>
	  </tr>
	</table>
	';
	
	/*
	* mail info
	*/
	
	$mail = new PHPMailer(); // defaults to using php "mail()"
	
	$mail->SetFrom($mailaddress, $name);
	$mail->AddReplyTo($mailaddress,$name);
	
	$mail->AddAddress($usermail, $sitename);
	$mail->AddCC('deepen@longtail.info',$sitename);
	// if add extra email address on back end
	// if(!empty($ccusermail)){
	// 	$rec = explode(';', $ccusermail);
	// 	if($rec){
	// 		foreach($rec as $row){
	// 			$mail->AddCC($row,$sitename);
	// 		}		
	// 	}
	// }
	
	$mail->Subject    = "Comment Mail";
	
	$mail->MsgHTML($body);
	
	if(!$mail->Send()) {
		//echo json_encode(array("action"=>"unsuccess","message"=>"We could not sent your request at the time. Please try again later."));
		echo "<script> alert('We could not sent your request at the time. Please try again later.'); window.location.href='contact.php'; </script>";
	}else{
		//echo json_encode(array("action"=>"success","message"=>"Your request has been successfully received, You will be shortly informed through mail with you verified by admin."));
		echo "<script> alert('Your request has been successfully received, You will be shortly informed through mail with you verified by admin.'); window.location.href='index.php'; </script>";
	}
endif;
?>