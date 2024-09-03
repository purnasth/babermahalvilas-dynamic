<?php 
$rescareer='';

if(defined('CAREER_OPPORTUNITIES_PAGE'))
{
	$rescareer.='';
	$rescareer.='<form id="careeroppform" action="" method="post">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 titles_reservation">Personal Information:</div>
				<div class="col-sm-6 col-md-4 col-lg-4 mgb20">
					<select name="salutation" class="show_fields">
						<option value="">Salutation</option>
						<option value="Mr.">Mr.</option>
						<option value="Ms.">Ms.</option>
					</select>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4">
					<input type="text" id="" name="fullname" placeholder="Full Name *">
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4">
					<input type="text" id="" name="currentaddress" placeholder="Current Address *">
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4">
					<input type="text" id="" name="homephone" placeholder="Home Phone *">
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4">
					<input type="text" id="" name="mobileno" placeholder="Mobile No. *">
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4">
					<input type="text" id="" name="mailaddress" placeholder="Email Address *">
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4">
					<input type="text" id="" name="confirmemail" placeholder="Confirm Email *">
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4">
					<input type="text" id="" name="careertitle" placeholder="Career Title *">
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 titles_reservation">Career & Application Information</div>
				<div class="col-sm-12 col-md-12 col-lg-12"> * Do You have any Experience? : 
					<span class="radio_btn">
						<input type="radio" id="" name="exptype" value="yes" checked>Yes
					</span> 
					<span class="radio_btn">
						<input type="radio" id="" name="exptype" value="no">No
					</span> 
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4 mgb20">
					<select class="select bdr_r4 small_select show_fields" id="expyear" name="expyear" style="display: inline-block;">
						<option value="">Exp.Years</option>';
						for($i=1; $i<=30; $i++){
							$rescareer.='<option value="'.$i.'">'.$i.'</option>';
						}
					$rescareer.='</select>
				</div>
				<div class="col-sm-6 col-md-5 col-lg-5">
					<select style="vertical-align:top " class="select bdr_r4 small_select show_fields" id="expmonth" name="expmonth">
						<option selected="" value="">Exp.Months</option>';
						for($j=1; $j<=12; $j++){
							$rescareer.='<option value="'.$j.'">'.$j.'</option>';
						}
					$rescareer.='</select>
				</div>
				<div class="clear"></div>
				<br/>
				<div class="col-sm-12 col-md-12 col-lg-12 "> Expected Salary : per month(Gross)
					<div class="row">
						<div class="col-sm-4 col-md-2 col-lg-2">
							<select class="select bdr_r4 small_select show_fields" id="ES_Currency_Abb" name="es_currency_abb">
								<option value="NRs.">NRs.</option>
								<option value="IRs.">IRs.</option>
								<option value="USD">USD</option>
							</select>
						</div>
						<div class="col-sm-4 col-md-2 col-lg-2">
							<select class="select bdr_r4 small_select show_fields" id="SalaryCriteria" name="SalaryCriteria">
								<option value="Above">Above</option>
								<option value="Below">Below</option>
								<option selected="" value="Equals">Equals</option>
							</select>
						</div>
						<div class="col-sm-4 col-md-5 col-lg-5 margin-above">
							<input type="text" value="Amount" class="select bdr_r4 text_field" id="expectedSalary" name="expectedSalary" original-title="">
						</div>
					</div>
				</div>
				<br/>
				<div class="col-sm-12 col-md-12 col-lg-6 mgb10"> Looking For : <br/>
					<span class="radio_btn">
						<input type="radio" checked="" name="optLevel" value="Entry">Entry Level
					</span> 
					<span class="radio_btn">
						<input type="radio" name="optLevel" value="Mid">Mid Level
					</span> 
					<span class="radio_btn">
						<input type="radio" name="optLevel" value="Senior">Senior Level 
					</span> 
					<span class="radio_btn">
						<input type="radio" name="optLevel" value="Top">Top Level
					</span> 
				</div>
				<div class="col-sm-12 col-md-12 col-lg-6 mgb10">Available For : <br/>
					<span class="radio_btn">
					<input type="radio" checked="" value="Full Time" name="availfor" id="availfor">
					Full Time</span> <span class="radio_btn">
					<input type="radio" value="Part Time" name="availfor" id="availfor">
					Part-Time</span> <span class="radio_btn">
					<input type="radio" value="Contract" name="availfor" id="availfor">
					Contract</span> 
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="col-sm-12 col-md-12 col-lg-12 titles_reservation">Other Relevant Information</div>
		<div class="eventstart-field col-md-10 col-xs-12">
			<textarea name="comment" id="message-field2" placeholder="Special Qualification *" class="" style="height:138px; margin-bottom:15px;"></textarea>
			<!-- event start time Field --> 
		</div>
		<div class="eventstart-field col-md-12 col-xs-12">
			*Upload Resume:
			<div id="queue"></div>
			<input id="file_upload" name="file_upload" type="file" multiple="true">
			<input type="hidden" name="uploadfile" id="uploadfile" />
			<span class="action-msg"></span>
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

$jVars['module:careeropptuform'] = $rescareer;
