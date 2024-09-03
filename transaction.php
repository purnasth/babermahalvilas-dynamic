<?php
echo 'Transaction Processing..... Please wait.';
require_once("includes/initialize.php");
if(isset($_POST['frm-post']) and $_POST['frm-post']=='submit-trans'){

$usermail = User::get_UseremailAddress_byId(1);
$sitename = Config::getField('sitename',true);
$logo = Config::getField('logo_upload',true);

foreach($_POST as $key=>$val){$$key=$val;}

/* For Information store in booking master table */
$bokInfo = new Bookingmaster();

$bokInfo->checkin_date 	= $checkin;
$bokInfo->checkout_date = $checkout;
$bokInfo->totnight 		= $totnight;
$bokInfo->first_name 	= $fname;
$bokInfo->last_name 	= $lname;
$bokInfo->address 		= $address;
$bokInfo->city 			= $city;
$bokInfo->zipcode 		= $zipcode;
$bokInfo->country 		= $country;
$bokInfo->mailaddress 	= $mailaddress;
$bokInfo->contact 		= $contactno;
$bokInfo->booking_date 	= registered();
$bokInfo->txtnid 		= $accessId;
$bokInfo->pay_type 		= $paytype;
$bokInfo->added_date 	= registered();

$bokInfo->save();
$master_id  = mysql_insert_id(); 		
/* Add Data on Booking Child */

foreach($roomtype as $krom=>$vrom){
	if($roomtype){
		$bokChild = new Bookingchild();

		$bokChild->master_id 	= $master_id;
		$bokChild->room_type 	= $roomtype[$krom];
		$bokChild->room_label 	= $room_label[$krom];
		$bokChild->no_of_room 	= $room_no[$krom];
		$bokChild->currency 	= $curncy_type[$krom];
		$bokChild->price 		= $sub_total[$krom];

		$bokChild->save();
	}
}

$myArr = array('Amount'	=> $total_price,
			   'Amount After (0%) Discount '=> $final_dis_price,
			   'Service Charge (10%)'		=> $service_charge,
			   'Tax Amount (13%)'			=> $tax_price,
			   'Grand Total Amount'			=> $grand_total);

foreach($myArr as $exk=>$exv){
	$bokChild2 = new Bookingchild();

	$bokChild2->master_id 	= $master_id;
	$bokChild2->room_type 	= $exk;
	$bokChild2->price 		= $exv;

	$bokChild2->save();
}

/* End */

if($paytype=='paypal'){ 
	?>
	
	<!-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" name="frmchkoutpay" method="post" id="frm-paypal"> -->
	<form action="https://www.paypal.com/cgi-bin/webscr" name="frmchkoutpay" method="post" id="frm-paypal">
	    <input type="hidden" name="cmd" value="_xclick">
	    <input type="hidden" name="business" value="longtail@joshimerchants.com">
		<!-- <input type="hidden" name="business" value="<?php echo $paypal_id; ?>"> -->
	    
	    <input type="hidden" name="currency_code" value="USD">
	    <input type="hidden" name="item_name" value="<?php echo $sitename;?> Rooms : Booking">
	    <input type="hidden" name="item_number" value="<?php echo $accessId;?>">
	    <input type="hidden" name="custom" value="<?php echo $accessId;?>">
	    <input type="hidden" name="handling_cart" value="<?php echo $accessId;?>" />
	    <input type="hidden" name="no_shipping" value="1">
	    <input type="hidden" name="no_note" value="1">
	    <input type="hidden" name="amount" value="<?php echo $grand_total;?>">
	    <!--<input type="hidden" name="amount" value="200">-->
	    <input type="hidden" name="return" value="<?php echo BASE_URL;?>success.php">
	    <input type="hidden" name="cancel_return" value="<?php echo BASE_URL;?>unsuccess.php" />
	    <input type="hidden" name="notify_url" value="<?php echo BASE_URL;?>ipn.php">
	    <input type="hidden" name="cpp_header_image" value="<?php echo IMAGE_PATH.'preference/'.$logo;?>" />
	</form>
	<script>document.getElementById('frm-paypal').submit();</script>
<?php }

if($paytype=='inquery'){
	$body = '
	<h3>Room Information</h3>
	<table class="table-form">
		<tbody>
			<tr>
				<td>
					<label>CheckIn Date</label>
					<div>'.$checkin.'</div>
				</td>
				<td>
					<label>CheckOut Date</label>
					<div>'.$checkout.'</div>
				</td>
				<td>
					<label>No.of Nights</label>
					<div>'.$totnight.'</div>
				</td>
			</tr>
		</tbody>			
	</table>
	<table class="table-form">
		<thead>
			<tr>
				<th>S.No.</th>
				<th>Type of Room</th>
				<th>No of Room</th>
				<th>Price</th>
			</tr>
		</thead>
		<tbody>';
		foreach($roomtype as $krom=>$vrom){
			if($roomtype){
				$bokChild = new Bookingchild();

				$bokChild->master_id 	= $master_id;
				$bokChild->room_type 	= $roomtype[$krom];
				$bokChild->room_label 	= $room_label[$krom];
				$bokChild->no_of_room 	= $room_no[$krom];
				$bokChild->currency 	= $curncy_type[$krom];
				$bokChild->price 		= $sub_total[$krom];

				$bokChild->save();
			}
		}
		$sn=1;
		foreach($roomtype as $k=>$v):
			if($roomtype){
				$body.='<tr>
							<td>'.$sn++.'</td>
							<td>'.$roomtype[$k].'-'.$room_label[$k].'</td>
							<td>'.$room_no[$k].'</td>
							<td>'.$curncy_type[$k].' '.$sub_total[$k].'</td>
						</tr>';
			}
		endforeach;
	$body.='<tr>
				<td colspan="5">Amount :</td>
				<td>
					<span id="total_price">'.$total_price.'</span>
				</td>
			</tr>
			<tr>
				<td colspan="5">Amount After (0%) Discount :</td>
				<td>
					<span id="final_dis_price">'.$final_dis_price.'</span>
				</td>
			</tr>
			<tr>
				<td colspan="5">Service Charge (10%) :</td>
				<td>
					<span id="service_charge">'.$service_charge.'</span>
				</td>
			</tr>
			<tr>
				<td colspan="5">Tax Amount (13%):</td>
				<td>
					<span id="tax_price">'.$tax_price.'</span>
				</td>
			</tr>
			<tr>
				<td colspan="5">Grand Total Amount:</td>
				<td>
					<span id="grand_total">'.$grand_total.'</span>
				</td>
			</tr>
		</tbody>			
	</table>
	<h3>Personal Information</h3>
	<table class="table-form">
		<tbody>
			<tr>
				<td>
					<label>Access ID</label> : '.$accessId.'					
				</td>
			</tr>
			<tr>
				<td><label>First Name</label>: '.$fname.'</td>
				<td><label>Last Name</label>: '.$lname.'</td>
			</tr>
			<tr>
				<td><label>Address</label>: '.$address.'</td>
				<td><label>City</label>: '.$city.'</td>				
			</tr>
			<tr>
				<td><label>Zip Code</label>: '.$zipcode.'</td>
				<td><label>Country</label>: '.$country.'</td>
			</tr>		
			<tr>
				<td><label>Mail Address</label>: '.$mailaddress.'</td>
				<td><label>Contact Number</label>: '.$contactno.'</td>
			</tr>			
		</tbody>
	</table>';
	
	/*
	* mail info
	*/
	
	$mail = new PHPMailer(); // defaults to using php "mail()"
	
	$fullname = $fname.' '.$lname;
	$mail->SetFrom($mailaddress, $fullname);
	$mail->AddReplyTo($mailaddress, $fullname);
	$mail->AddAddress($usermail, $sitename);
	
	
	$mail->Subject    = $sitename. " Rooms : Booking Inquiry";
	
	$mail->MsgHTML($body);
	
	if(!$mail->Send()) {
		redirect_to(BASE_URL.'unsuccess.php');
	}else{
		redirect_to(BASE_URL.'success.php');
	}
}

}else{
	redirect_to(BASE_URL.'home');
}
?>