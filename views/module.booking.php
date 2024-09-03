<?php
$result='';
foreach($_POST as $key=>$val){$$key=$val;}
ob_start(); ?>

<div class="pageinnerwrapper">
	<h2>Booking Form</h2>
	<form id="frm-booking" method="post" action="">
	  
	  <table width="100%" border="0" cellspacing="3" cellpadding="5">
	  <tbody>
	  <tr>
	  <td width="18%">Check In Date :<span class="mf" style="margin: 2px 0px 2px 5px"><font color="#FF0000">*</font></span></td>
	  <td width="29%"><input class="validate[required] datepicker" type="text" id="checkIn" name="checkIn" value="<?php echo !empty($checkin)?$checkin:'';?>">	</td>
	  
	  <td width="22%" class="rightform_manage">Check Out Date :</td>
	  <td width="29%"><input class="validate[required] datepicker" type="text" id="checkOut" name="checkOut" value="<?php echo !empty($checkout)?$checkout:'';?>"></td>
	  </tr>
	  <tr>
	  <td width="18%"> Flight No :</td>
	  <td width="29%"><input type="text" name="in_flight" size="17"></td>
	  
	  <td width="22%" class="rightform_manage">Flight No :</td>
	  <td width="29%"><input name="out_flight" type="text" id="out_flight" size="17"></td>
	  </tr>
	  <tr>
	  <td width="18%">Airport Pick Up :</td>
	  <td width="29%" class="fontcontrol">Yes :&nbsp;<input style="top: 9px !important;position: relative !important;" class="radio" type="radio" value="Yes" name="air_pickup">&nbsp;&nbsp;&nbsp;&nbsp;No :&nbsp;<input style="top: 9px !important;position: relative !important;" class="radio" type="radio" name="air_pickup" value="No" checked="checked"></td>
	  
	  <td width="20%" class="rightform_manage">Airport Drop :</td>
	  <td width="29%" class="fontcontrol">Yes :&nbsp;<input style="top: 9px !important;position: relative !important;" class="radio" type="radio" value="Yes" name="air_drop">&nbsp;&nbsp;&nbsp;&nbsp;No :&nbsp;<input style="top: 9px !important;position: relative !important;" class="radio" type="radio" name="air_drop" value="No" checked="checked"></td>
	  </tr>

	  <tr>
	  <td colspan="5">&nbsp;</td>
	  </tr>
	  <tr>
	  <td width="18%">Full Name :<span class="mf" style="margin: 2px 0px 2px 5px"><font color="#FF0000">*</font></span></td>
	  <td width="29%"><input class="validate[required]" name="fullname" type="text" id="fullname"></td>
	  
	  <td width="20%" class="display_none"></td>
	  <td width="29%" class="display_none"></td>
	  </tr>
	  <tr>
	  <td width="18%">Email :<span class="mf" style="margin: 2px 0px 2px 5px"><font color="#FF0000">*</font></span></td>
	  <td width="29%"><input class="validate[required,custom[email]]" name="mailaddress" type="text" id="mailaddress"></td>
	  
	  <td width="20%" class="rightform_manage">Telephone :</td>
	  <td width="29%" ><input name="tel" type="text" id="tel" size="25"></td>
	  </tr>
	   <tr>
	  <td width="18%">Country :<span class="mf" style="margin: 2px 0px 2px 5px"><font color="#FF0000">*</font></span></td>
	  <td width="29%">
	  	<select class="validate[required] drop4" name="country" id="country">
	  		<option value="" selected="selected">Select your country</option>
	  		<?php $sql= "SELECT country_name FROM tbl_countries ORDER BY country_name ASC";
	  			$result = $db->query($sql);
	  			while($row = $db->fetch_array($result)){
	  				$hc = !empty($home_country)?$home_country:'';
	  				$sel = ($hc==$row['country_name'])?'selected':'';
	  				echo '<option value="'.$row['country_name'].'" '.$sel.'>'.$row['country_name'].'</option>';
	  			}
			?>
		</select>
	   </td>
	  
	  <td width="20%" class="display_none"></td>
	  <td width="29%" class="display_none"></td>
	  </tr>
	  <tr>
	  <td width="18%">No of Person :</td>
	  <td width="29%"><input type="text" name="nop" size="8"></td>
	  
	  <td width="20%" class="rightform_manage">Adult :</td>
	  <td width="29%" ><input type="text" name="adult" size="8"></td>
	  </tr>
	  <tr>
	  <td width="18%">Child :</td>
	  <td width="29%"><input type="text" name="child" size="9"></td>
	  
	  <td width="20%" class="display_none"></td>
	  <td width="29%" class="display_none"></td>
	  </tr>
	  <tr>
	  <td width="18%">Room Type :<span class="mf" style="margin: 2px 0px 2px 5px"><font color="#FF0000">*</font></span></td>
	  <td width="29%">
	  <select class="drop3" name="room" id="room">
          <option selected="selected">Select Room</option>
          <option value="Single Deluxe" <?php echo (!empty($home_room) and ($home_room=='Single Deluxe'))?'selected':'';?>>Single Deluxe</option>
          <option value="Double Deluxe" <?php echo (!empty($home_room) and ($home_room=='Double Deluxe'))?'selected':'';?>>Double Deluxe</option>
          <option value="Luxury Suite" <?php echo  (!empty($home_room) and ($home_room=='Luxury Suite'))?'selected':'';?>>Luxury Suite</option>	              
	  </select>
	  </td>
	  
	  <td width="20%" class="display_none"></td>
	  <td width="29%" class="display_none"></td>
	  </tr>
	  <tr>
	  <td width="18%">Purpose To Visit :</td>
	  <td width="29%"><input name="purpose" type="text" id="purpose" size="25"></td>
	  
	  <td width="20%" class="display_none"></td>
	  <td width="29%" class="display_none"></td>
	  </tr>
	  <tr>
	  <td width="18%">Inquiry :</td>
	  <td width="29%" colspan="3"><textarea name="message" cols="42" style="height:150px;"></textarea></td>
	  </tr>
	  <tr>
	  <td colspan="5">&nbsp;</td>
	  </tr>
	  <tr>
	  <td width="20%"  class="display_none"></td>
	  <td width="29%"><input type="submit" value="Submit" id="btn_booking" name="B1"></td>
	  <td width="20%"><input class="resetbutton" style="margin-top: 0px;height: 35px;position: relative;top: 4px;" type="reset" value="Reset" name="B2"></td>
	  <td width="29%"  class="display_none"></td>
	  </tr>
	  
	  </tbody>
	  </table>

	</form>
	<!-- article content -->
	<div class="clearfix"></div>
</div>

<script>
(function($) {
	$(document).ready(function() {
		jQuery('#checkIn').datepicker({
	        changeMonth: true,
	        changeYear: true,
	        showButtonPanel: true,
	        dateFormat: 'yy-mm-dd',
	        minDate: '0',
	        maxDate: '+2Y'
	      });

	     jQuery('#checkOut').datepicker({ 
	        changeMonth: true,
	        changeYear: true,
	        showButtonPanel: true,
	        dateFormat: 'yy-mm-dd', 
	        minDate: '0'
	      });


		jQuery('#frm-booking').validationEngine({
			autoHidePrompt:true,
	      	onValidationComplete: function(form, status){
	        if(status==true){ 
		         	$('#btn_booking').attr('disabled', 'true').val('Processing...');
		          	var queryString = $('#frm-booking').serialize();
		          	$.ajax({
			           type: "POST",
			           dataType:"JSON",
			           url:  "bookinginquery.php",
			           data: queryString,
			           success: function(data){
			              var msg = eval(data);
			              alert(msg.message);
			              window.location.href='';
			           }
		         	});
		          return false;
	        	}
      		}
      	});
	});
})(jQuery);
</script> 
<?php
$result=ob_get_clean();
$jVars['module:booking_form']= $result;

/**** This Section For Home Page ****/
$result2='';
ob_start(); ?>

<form action="<?php echo BASE_URL;?>booking" method="post" id="form_booking_hotel" class="cmxform">	
<span class="txtreguler">Reservation</span>
  	<input type="text"  class="validate[required]" name="checkin" id="checkin" placeholder="Check In" >
  	<input type="text"  class="validate[required]" name="checkout" id="checkout" placeholder="Check Out" >
  	<select name="home_room" id="home_room" class="validate[required]">
    	<option value="">Select Rooms</option>
    	<option value="Single Deluxe">Single Deluxe</option>
    	<option value="Double Deluxe">Double Deluxe</option>
    	<option value="Luxary Suite">Luxary Suite</option>
  	</select>
  	<select name="home_country" id="home_country" class="validate[required]">
  		<option value="" selected="selected">Select your country</option>
  		<?php $sql= "SELECT country_name FROM tbl_countries ORDER BY country_name ASC";
  			$result = $db->query($sql);
  			while($row = $db->fetch_array($result)){
  				echo '<option value="'.$row['country_name'].'">'.$row['country_name'].'</option>';
  			}
		?>
  	</select>
  	<input type="submit" name="btn_bookingproceed" id="submit_hotel_form" value="Submit">
</form>

<script>
(function($) {
	$(document).ready(function() {
		jQuery('#checkin').datepicker({
	        changeMonth: true,
	        changeYear: true,
	        showButtonPanel: true,
	        dateFormat: 'yy-mm-dd',
	        minDate: '0',
	        maxDate: '+2Y'
	      });

	     jQuery('#checkout').datepicker({ 
	        changeMonth: true,
	        changeYear: true,
	        showButtonPanel: true,
	        dateFormat: 'yy-mm-dd', 
	        minDate: '0'
	      });

	    jQuery('#form_booking_hotel').validationEngine({'showPrompts':false,scroll:false});
	});
})(jQuery);
</script> 
<?php 
$result2=ob_get_clean();
$jVars['module:homeBooking_form']= $result2;
?>
