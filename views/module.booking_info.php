<?php
$session->start();
if(isset($_POST['btn_bookingproceed'])):
	$session->set('roomInfo',$_POST);

$result='';
foreach($_POST as $key=>$val){$$key=$val;}
ob_start(); ?>
<form action="transaction.php" method="post" id="frm-finalBooking">
	<h3>Room Information</h3>
	<table class="table table_style">
		<tbody>
			<tr>
				<td>
					<label>CheckIn Date</label>
					<div><?php echo $checkIn;?></div>
				</td>
				<td>
					<label>CheckOut Date</label>
					<div><?php echo $checkOut;?></div>
				</td>
				<td>
					<label>No.of Nights</label>
					<div><?php echo $totNignt;?></div>
				</td>
			</tr>
		</tbody>			
	</table>
<br/>
	<table class="table room_info_table">
		<thead>
			<tr>
				<th>S.No.</th>
				<th>Type of Room</th>
				<th>No of Room</th>
				<th>Adult</th>
				<th>Child</th>
				<th>Price</th>
			</tr>
		</thead>
		<tbody>
		<?php if(!empty($roomType)){
			$sn=1;
			foreach($roomType as $k=>$v):
			  echo '<tr>
						<td>'.$sn++.'</td>
						<td>'.$roomType[$k].'</td>
						<td>'.$roomNo[$k].'</td>
						<td>'.$roomAdult[$k].'</td>
						<td>'.$roomChild[$k].'</td>
						<td>'.$roomPrice[$k].'</td>
					</tr>';
			endforeach;
		}?>
			

			<tr>
				<td colspan="5">Amount :</td>
				<td>
					<span id="total_price"><?php echo $total_price;?></span>
				</td>
			</tr>
			<tr>
				<td colspan="5">Amount After (0%) Discount :</td>
				<td>
					<span id="final_dis_price"><?php echo $final_dis_price;?></span>
				</td>
			</tr>
			<tr>
				<td colspan="5">Service Charge (10%) :</td>
				<td>
					<span id="service_charge"><?php echo $service_charge;?></span>
				</td>
			</tr>
			<tr>
				<td colspan="5">Tax Amount (13%):</td>
				<td>
					<span id="tax_price"><?php echo $tax_price;?></span>
				</td>
			</tr>
			<tr>
				<td colspan="5">Grand Total Amount:</td>
				<td>
					<span id="grand_total"><?php echo $grand_total;?></span>
					<input type="hidden" name="grand_total" value="<?php echo $grand_total;?>">
				</td>
			</tr>
		</tbody>			
	</table>

<br/>
	<h3>Personal Information</h3>
	<table class="table booking_personal_info">
		<tbody>
			<tr>
				<td>
					<label>Access ID</label> : 
					<?php $accessId =  @randomKeys('15');  echo $accessId;?>
					<input type="hidden" name="accessId" value="<?php echo $accessId;?>" class="form-control validate[required]">
				</td>
			</tr>
			<tr>
				<td><input type="text" placeholder="First Name" name="fname" id="fname" class="form-control validate[required]"></ins></td>
				<td><input type="text" placeholder="Last Name" name="lname" id="lname" class="form-control validate[required]"></ins></td>
			</tr>
			<tr>
				<td><input type="text" placeholder="Address" name="address" id="address" class="form-control validate[required]"></td>
				<td><input type="text" placeholder="City" name="city" id="city" class="form-control validate[required]"></td>				
			</tr>
			<tr>
				<td><input type="text" placeholder="Zip Code" name="zipcode" id="zipcode" class="form-control validate[required]"></td>
				<td>
					<select name="country" id="country" class="form-control validate[required]">
						<option value="">Choose Country</option>
						<?php $countryRec = Countries::find_all();
						foreach($countryRec as $row):
							echo '<option value="'.$row->country_name.'">'.$row->country_name.'</option>';
						endforeach; ?>
					</select>
				</td>
			</tr>		
			<tr>
				<td><input type="text" placeholder="Mail Address" name="mailaddress" id="mailaddress" class="form-control validate[required,custom[email]]"></td>
				<td><input type="text" placeholder="Contact Number" name="contactno" id="contactno" class="form-control validate[required]"></td>
			</tr>			
		</tbody>
	</table>
<br/>
	<h3>Transaction Types</h3>
	<table class="table booking_transactions">
		<tbody>
			<tr>
				<td>					
					<input type="radio" value="paypal" name="paytype" checked="checked">
					<label>Paypal</label> &nbsp;
					<input type="radio" value="creditcard" name="paytype">
					<label>Credit Card</label>&nbsp;	
                <input type="radio" value="inquery" name="paytype">
					<label>Email Booking</label></td>

			</tr>
			<tr>
				<td>
					<button id="frm-submit" class="btn btn-primary" type="submit" name="btn_bookingInfo">SUBMIT</button>
				</td>
			</tr>
		</tbody>
	</table>
</form>
<?php
endif;
$result = ob_get_clean();
$jVars['module:booking_info']= $result;
?>
