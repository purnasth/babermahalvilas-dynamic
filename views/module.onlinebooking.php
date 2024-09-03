<?php 
/*
* Online Booking 
*/
$resonline=''; 

$resonline.='<div class="button-feedback right">
        <a href="javascript:void(0);" data-toggle="modal" data-target=".booking-modal" class="button button-medium button-rounded button-vertical tright">Check Availability</a>
    </div>

    <div class="modal fade booking-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-body">
            
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title serif" id="myModalLabel">Check Availability</h4>
                    </div>
         
                    <div class="modal-body bgcolor-black dark">

                        <div class="boxedcontainer mini-links clearfix">
            
                            <form target="dispoprice" name="idForm" action="http://www.fastbookings.biz/DIRECTORY/dispoprice.phtml" id="booking-frm">
                            	<input type="hidden" name="showPromotions" value="1">
								<input type="hidden" name="langue" value="">
								<input type="hidden" name="Clusternames" value="ASIANPClubHimalaya">
								<input type="hidden" name="Hotelnames" value="ASIANPClubHimalaya">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="arrival">Check In Date</label>
                                            <input type="text" class="form-control" id="arrival" name="arrival" placeholder="Check In Date">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="departure">Check Out Date</label>
                                            <input type="text" class="form-control" id="departure" name="departure" placeholder="Check Out Date">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="adulteresa">Adults Per Room</label>
                                            <select name="adulteresa" class="form-control" id="adulteresa">
                                            	<option value="1" selected="">1</option>
                                            	<option value="2">2</option>
                                            	<option value="3">3</option>
                                            	<option value="4">4</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="enfantresa">Children</label>
                                            <select name="enfantresa" class="form-control" id="enfantresa">
                                            	<option value="0" selected="">0</option>
                                            	<option value="1">1</option>
                                            	<option value="2">2</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="AccessCode">Access code/IATA code</label>
                                            <input type="password" class="form-control" id="AccessCode" name="AccessCode" placeholder="Access code/IATA code">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="button">&nbsp;</label>
                                            <button type="submit" class="form-control btn btn-primary">Submit</button>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="button">&nbsp;</label>
                                            <button type="button" onclick="hhotelcancel(&#39;NPPOKHTLPokharaChoic&#39;,&#39;&#39;);" class="form-control btn btn-primary">Cancel</button>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="button">&nbsp;</label>
                                            <button type="button" onclick="hhotelSearch(&#39;NPPOKHTLPokharaChoic&#39;, &#39;&#39;, &#39;&#39;, &#39;&#39;, &#39;&#39;, &#39;&#39;, &#39;&#39;);" class="form-control btn btn-primary">Options/Languages</button>
                                        </div>
                                    </div>
                                </div>
                            </form>                                                         
        
                        </div>

                    </div>
     
                </div>
            </div>
        </div>
 	</div>';

$jVars['module:online_booking'] = $resonline;