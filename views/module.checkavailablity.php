<?php
$session->start();
if(isset($_POST['btn-availablity'])):
	foreach($_POST as $k=>$v){$$k=$v;}
	$session->set('checkIn',$checkIn);
	$session->set('checkOut',$checkOut);
	$session->set('nofnight',$nofnight);
endif;
$result='';

$roomCat  = Subpackage::getPackage_limit(1); //array(1=>'Standard Room Twin Bed',2=>'Deluxe Room');

ob_start(); ?>		
<style type="text/css">
.main_imgdiv{width:20%; margin-right:2%; float:left;}
.main_imgdiv img{ width:100px; max-height: 100px;}
.main_listing{width:78%; float:left;}
.main_listing ul li{ width:25%; float: left; list-style:none;} 
.main_listing ul{ margin-bottom:10px;}
.main_booking_ul{ margin-bottom:15px;}
.main_booking_ul li{ /*background:#e3e3e3;*/ margin-bottom:15px; list-style:none;}
.clear{ clear: both; padding:0; margin:0;}

.cal_sn{width:95px;float:left;}
.cal_room{width:250px;float:left;}
.cal_no_room{width:150px;float:left;}
.cal_price{width:50px;float:left;}
</style>				


<form id="my-booking-form" action="transaction.php" method="post">
	<h3>Check Availablity</h3>
	<fieldset>
		<legend>Check Availablity</legend>

		<label for="">CheckIn Date *</label>
		<input type="text" class="form-control" name="checkin" id="checkin" placeholder="Check in" value="<?php echo ($session->get('checkIn'))?$session->get('checkIn'):'';?>">

		<label for="">CheckOut Date *</label>
		<input type="text" class="form-control" name="checkout" id="checkout" placeholder="Check out" value="<?php echo ($session->get('checkOut'))?$session->get('checkOut'):'';?>">

		<label for="">No.of Nights</label>
		<div class="total-night"><?php echo ($session->get('nofnight'))?$session->get('nofnight'):0;?></div>
		<input type="hidden" name="totnight" value="<?php echo ($session->get('nofnight'))?$session->get('nofnight'):0;?>">

		<p>(*) Mandatory</p>
	</fieldset>

	<h3>Room Lists</h3>
	<fieldset>
		<legend>Room Lists</legend>

		<ul class="main_booking_ul">
			<li class="showresult">Record Not Found</li>
		</ul>
	</fieldset>

	<h3>Transaction</h3>
	<fieldset>
		<legend>Transaction</legend>

		<table class="table">
			<thead>
				<tr>
					<th width="95">S.No.</th>
					<th width="250">Type of Room</th>
					<th width="220">No of Room</th>
					<th width="95">Price</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="4" class="calculate_td">
                    Plese Select the rooms!
                    </td>
				</tr>			

				<tr>
					<td colspan="5">Amount :</td>
					<td>
						<span id="total_price">0.00</span>
						<input type="hidden" name="total_price" value="0">
					</td>
				</tr>
				<tr>
					<td colspan="5">Amount After (0%) Discount :</td>
					<td>
						<span id="final_dis_price">0.00</span>
						<input type="hidden" name="final_dis_price" value="0">
					</td>
				</tr>
				<tr>
					<td colspan="5">Service Charge (10%) :</td>
					<td>
						<span id="service_charge">0.00</span>
						<input type="hidden" name="service_charge" value="0">
					</td>
				</tr>
				<tr>
					<td colspan="5">Tax Amount (13%):</td>
					<td>
						<span id="tax_price">0.00</span>
						<input type="hidden" name="tax_price" value="0">
					</td>
				</tr>
				<tr>
					<td colspan="5">Grand Total Amount:</td>
					<td>
						<span id="grand_total">0.00</span>
						<input type="hidden" name="grand_total" value="0">
					</td>
				</tr>
			</tbody>			
		</table>
	</fieldset>

	<h3>Personal Information</h3>
	<fieldset>
		<legend>Personal Information</legend>
		<table class="table booking_personal_info">
			<tbody>
				<tr>
					<td>
						<label>Transaction ID</label> : 
						<?php $accessId =  @randomKeys('15');  echo $accessId;?>					
						<input type="hidden" class="form-control" value="<?php echo $accessId;?>" name="accessId">
					</td>
				</tr>
				<tr>
					<td>
						<label for="">First Name *</label>
						<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
					</td>
					<td>
						<label for="">Last Name *</label>
						<input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name">
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Address *</label>
						<input type="text" class="form-control" id="address" name="address" placeholder="Address">
					</td>
					<td>
						<label for="">City *</label>
						<input type="text" class="form-control" id="city" name="city" placeholder="City">
					</td>				
				</tr>
				<tr>
					<td>
						<label for="">Zip Code *</label>
						<input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Zip Code">
					</td>
					<td>
						<label for="">Country *</label>
						<select name="country" id="country" class="form-control">
							<option value="">Choose Country</option>
							<?php $countryRec = Countries::find_all();
							foreach($countryRec as $row):
								echo '<option value="'.$row->country_name.'">'.$row->country_name.'</option>';
							endforeach; ?>
						</select>
					</td>
				</tr>		
				<tr>
					<td>
						<label for="">Mail Address *</label>
						<input type="text" class="form-control" id="mailaddress" name="mailaddress" placeholder="Mail Address">
					</td>
					<td>
						<label for="">Contact Number *</label>
						<input type="text" class="form-control" id="contactno" name="contactno" placeholder="Contact Number">
					</td>
				</tr>			
			</tbody>
		</table>
		<p>(*) Mandatory</p>
	</fieldset>

	<h3>Transaction Type</h3>
	<fieldset>
		<legend>Transaction Type</legend>
		
		<table class="table booking_transactions">
			<tbody>
				<tr>
					<td>
						<input type="radio" checked="checked" name="paytype" value="paypal">
						<label>Paypal</label>
						<input type="radio" name="paytype" value="creditcard">
						<label>Credit Card</label>
						<input type="radio" name="paytype" value="inquery">
						<label>Email Booking</label>
						<input type="hidden" name="frm-post" value="submit-trans">
					</td>
				</tr>
			</tbody>
		</table>
	</fieldset>
</form>

<?php
$result=ob_get_clean();
$jVars['module:checkavailablity_list']= $result;
?>