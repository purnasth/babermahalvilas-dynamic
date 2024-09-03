<?php
$result='';
ob_start();
?>
<h2 style="padding-top: 45px;"> Room Booking <span class="triangle-bottomright"> </span> </h2>
<form role="form" action="checkavailablity.php" method="post" id="frm-checkavailablity" class="inner_booking" style="margin-top:30px;"> 
						<div class="paddinone1">
							<div class=""><div class="input-group">
								<input type="text" placeholder="Check In Date" id="checkIn" name="checkIn" class="cal validate[required]">
								<span class="input-group-btn">
									<button class="btn btn-default cal-icon" type="button">
										<i class="fa fa-calendar">
										</i>
									</button>
								</span>
							</div></div><!-- /input-group -->
						</div>
						<div class="paddinone2">
							<div class="input-group">
								<input type="text" placeholder="Check Out Date" id="checkOut" name="checkOut" class="cal validate[required]">
								<span class="input-group-btn">
									<button class="btn btn-default cal-icon" type="button">
										<i class="fa fa-calendar">
										</i>
									</button>
								</span>
							</div><!-- /input-group -->
						</div>
						<div class="col-md-5 col-sm-5 paddinone3">
							<input type="hidden" name="nofnight">
							<input type="submit" value="CHECK AVAILABILITY" name="btn-availablity" class="btn btn-primary btn-block">
						</div>
					</form>
<div class="clear"></div>
<?php 
$result = ob_get_clean();
$jVars['module:inner_booking']= $result;
?>
