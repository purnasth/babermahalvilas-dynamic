<?php 
$resevntinq='';

if(defined('EVENTS_ENQUIRY_PAGE'))
{ 
	foreach($_POST as $key=>$val){$$key=$val;}
	$resevntinq.='<form id="eventsbooking" action="" method="post">
		<div class="col-sm-12 col-md-12 col-lg-12 titles_reservation">Personal Information:</div>
		<div class="col-sm-12 col-md-4 col-lg-4">
			<input type="text" id="" name="applicantsname" placeholder="Applicant\'s Name *">
		</div>
		<div class="col-sm-12 col-md-4 col-lg-4">
			<input type="text" id="organisation" name="organisation" placeholder="Organisation *">
		</div>
		<div class="col-sm-12 col-md-4 col-lg-4">
			<input type="text" id="address" name="address" placeholder="Address *">
		</div>
		<div class="col-sm-12 col-md-4 col-lg-4">
			<input type="text" id="city" name="city" placeholder="City *">
		</div>
		<div class="col-sm-12 col-md-4 col-lg-4">
			<input type="text" id="country" name="country" placeholder="Country *">
		</div>
		<div class="col-sm-12 col-md-4 col-lg-4">
			<input type="text" id="mailaddress" name="mailaddress" placeholder="Email *" >
		</div>
		<div class="col-sm-12 col-md-4 col-lg-4">
			<input type="text" id="telno" name="telno" placeholder="Phone *">
		</div>

		<div class="col-sm-12 col-md-12 col-lg-12 titles_reservation">Event Information:</div>

		<div class="col-sm-12 col-md-4 col-lg-4">
			<input type="text" id="conference_event" name="conference_event" placeholder="Conference or Event title *" value="'.@$conference_events.'">
		</div>
		<div class="col-sm-12 col-md-4 col-lg-4">
			<input type="text" id="events_date" name="events_date" placeholder="Event Date *" value="'.@$events_date.'">
		</div>
		<div class="clear"></div>
		<div class="col-sm-12 col-md-4 col-lg-4">
			<input type="text" id="eventstart" name="eventstart" placeholder="Event Start Time *" value="'.@$eventstart.'">
		</div>
		<div class="col-sm-12 col-md-4 col-lg-4">
			<input type="text" id="eventend" name="eventend" placeholder="Event End Time *" value="'.@$eventend.'">
		</div>
		<div class="col-sm-12 col-md-4 col-lg-4">
			<select name="nunofpax" id="">
				<option value="">Number of pax.</option>
				<option value="Between (1 to 25) Pax.">1-25</option>
				<option value="Between (26 to 50) Pax.">26-50</option>
				<option value="Between (51 to 75) Pax.">51-75</option>
				<option value="Above 75 Pax.">75+</option>
			</select>
		</div>
		<div class="eventstart-field col-md-12 col-xs-12">
			<textarea name="comment" id="message-field2" placeholder="Comments *" class="" style="height:138px;"></textarea>
			<!-- event start time Field --> 
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12 ">Type the characters you see in the picture below.</div>
		<div class="col-sm-12 col-md-6 col-lg-6 capcha_img">
			<img src="captcha/imagebuilder.php?rand=310333"  border="1" class="text-field" onclick="updateCaptcha(this)">
			<input placeholder="Enter Security Code" type="text" class="text-field" name="userstring" maxlength="5" />
		</div>
		<div class="clear"></div>
		<div class=" col-xs-6 col-md-2">
			<input type="submit" id="frm-submit" class="contact-submit btn colored" value="Send">
			<!-- Submit Button --> 
		</div>
	</form>';
}

$jVars['module:eventsenquiryform'] = $resevntinq;
?>