<?php
$res_fstboking='';

$res_fstboking.='<div class="search-row">
	<form class="search-form horizontal container" action="#" name="idForm" target="dispoprice" id="idForm">
  		<input name="showPromotions" value="1" type="hidden" />
  		<input name="langue" value="" type="hidden" />
  		<input name="Clusternames" value="NPKATShambala" type="hidden" />
  		<input name="Hotelnames" value="NPKATShambala" type="hidden" />
	    <div class="search-fields col-xs-6 col-md-3">
	        <input placeholder="Check-in" class="datepicker-fields check-in" type="text" name="arrival"/><!-- Date Picker field ( Do Not remove the "datepicker-fields" class ) -->
	        <i class="fa fa-calendar"></i><!-- Date Picker Icon -->
	    </div>
	    <div class="search-fields col-xs-6 col-md-3">
	        <input placeholder="Check-Out" class="datepicker-fields check-out" type="text" name="departure"/>
	        <i class="fa fa-calendar"></i>
	    </div>';
	    $pkgId = Package::type_by_id();
	    $rec = Subpackage::getPackage_limit($pkgId);
	    if($rec){	    	
		    $res_fstboking.='<div class="search-fields col-xs-6 col-md-2">
		        <!-- Select boxes ( you can change the items and its value based on your project\'s needs ) -->
		        <select name="room-type" id="search-field2">
		            <option value="">Room Type</option><!-- Select box items ( you can change the items and its value based on your project\'s needs ) -->';
		            foreach($rec as $row){
		            $res_fstboking.='<option>'.$row->title.'</option>';
		        	}
		        $res_fstboking.='</select>
		        <!-- End of Select boxes -->
		    </div>';
		}
	    $res_fstboking.='<div class="search-fields col-xs-6 col-md-2">
	        <select name="adulteresa" id="search-field3">
	            <option value="0">No. of Guests</option><!-- Select box items -->
	           	<option value="1">1</option>
	            <option value="2">2</option>
	            <option value="3">3</option>
	            <option value="4">4</option>
	        </select>
	    </div>
	    <div class="search-fields col-xs-6 col-md-2">
	    	<input placeholder="Access code/IATA code" class="" type="text" name="AccessCode"/>
	    </div>
	    <div class="search-button-container">
	        <input  value="Book Now" type="submit"/><!-- Submit button -->
	    </div>
	</form>
</div>
<!-- End of Booking Form -->';

$jVars['module:frmFastbooking'] = $res_fstboking;

$shortBooking='';

$shortBooking.='<form action="http://www.fastbooking.co.uk/DIRECTORY/dispoprice.phtml" name="idForm" target="dispoprice" id="idForm">
  		<input name="showPromotions" value="1" type="hidden" />
  		<input name="langue" value="" type="hidden" />
  		<input name="Clusternames" value="NPKATShambala" type="hidden" />
  		<input name="Hotelnames" value="NPKATShambala" type="hidden" />

  		<input  value="Book Now" type="submit" class="bookbtn"/>
  		</form>';

$jVars['module:fastbook'] = $shortBooking;  		
?>