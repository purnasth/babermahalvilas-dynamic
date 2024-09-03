<?php
/*
* Reservation Form
*/

$resbread=$resresrv='';

if(defined('RESERVATION_PAGE')){ 

	$configRec  = Config::find_by_id(1);
	$resbread.='<section id="page-title" class="page-title page-title-dark mild-dark-overlay" style="background-image: url('.IMAGE_PATH.'img-contact.jpg); 
        background-size: cover; background-position: center top;">

        <div class="container center clearfix">
            <h1 class="serif normal">Room Reservation</h1>
            <span class="breadcrumb">
                <a href="'.BASE_URL.'">Home</a> | Room Reservation
            </span>
            <span>Experience the Rana style of living - <span class="brand">Baber Mahal Vilas</span></span>
        </div>
        
        <div class="floating-pn-dark dark">Call us '.$configRec->contact_info.'</div> 

    </section>';

	$resresrv.='<section id="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					
				</div>
			</div>

			<form id="roombooking" name="roombooking" action="" method="post">
				<div class="col-sm-12">
					<div class="row"> 
						<div class=" col-sm-8">
							<div class=" reserve_room_info">
							<div class="row">
								<div class="subtitle col-sm-12">
									<h6 >Room List</h6>
								</div>


<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="col-sm-12 col-md-12 col-lg-12">

';




								
								$pkgId  = Package::getRoompackage();
								if(!empty($pkgId)) {
									$isfirst = 0;
									foreach($pkgId as $pkgIdrow) {

										$subRec = Subpackage::get_relatedpkg($pkgIdrow->id);
										$pktitle = str_replace(" ", "_", $pkgIdrow->title);

										if($subRec) {

											$ini_in = ($isfirst == 0) ? "in": "";
											$resresrv.='
											
												 <div class="panel panel-default">
												    <div class="panel-heading" role="tab" id="headingThree">
												      <h4 class="panel-title">
												        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#'.$pktitle.'" aria-expanded="false" aria-controls="collapseThree">
												          <h4>'.$pkgIdrow->title.'</h4>
												        </a>
												      </h4>
												    </div>
												    <div id="'.$pktitle.'" class="panel-collapse collapse '.$ini_in.'" role="tabpanel" aria-labelledby="headingThree">
												      <div class="panel-body">
												       
												      

											
												<table class="table roomtypes">
													<tr>
														<th>Room Type</th>
														<th>Adults No.</th>
														<th>Price per Night</th>
														<th>Rooms No.</th>
														<th>Extra Bed</th>
													</tr>';

													foreach($subRec as $recRow) {
														$totroom = $recRow->number_room;
														$totppl = $recRow->people_qnty;
														$priceArr = array('1'=>$recRow->onep_price, '2'=>$recRow->twop_price, '3'=>$recRow->threep_price);						

														$nos = unserialize($recRow->image);

														$resresrv.='<tr>
															<td rowspan="'.($totppl+1).'" class="table_image" >
																<h6 style="margin-top:0;">'.$recRow->title.'</h6>
																<img src="'.IMAGE_PATH.'subpackage/'.$nos[0].'" alt="room image" class="img-responsive" width="120px"/>
															</td>
														</tr>';

														for($i=1; $i<=$totppl; $i++)
														{
															$actual_price = !empty($pkgIdrow->dis_rate)?'<span class="main-price">'.$priceArr[$i].'</span>':'';
															$after_dis = ($priceArr[$i]-($priceArr[$i]*$pkgIdrow->dis_rate/100));
															$resresrv.='<tr class="table_contents">
																<td>
																	'.$i.' <span class="display_hide">pax</span>
																	<input type="hidden" name="ppqnty['.$recRow->title.'][]" value="'.$i.'" />
																</td>
																<td>
																	'.$recRow->currency.' '.$actual_price.' '.$after_dis.'
																	<input type="hidden" name="currency['.$recRow->title.'][]" value="'.$recRow->currency.'"/>
																	<input type="hidden" name="roomprice['.$recRow->title.'][]" value="'.$priceArr[$i].'" />
																	<input type="hidden" name="roomdis['.$recRow->title.'][]" value="'.$pkgIdrow->dis_rate.'" />
																</td>
																<td>
																	<select name="roomqnty['.$recRow->title.'][]" class="form-control">
																		<option value="N/A">Select</option>';
																		for($r=1; $r<=$totroom; $r++)
																		{
																			$resresrv.='<option value="'.$r.'">'.$r.'</option>';
																		}
																	$resresrv.='</select>
																</td>
																<td>
																	<select name="extrabed['.$recRow->title.'][]" class="form-control"> 
																		<!--<option value="N/A">Extra Bed</option>-->
																		<option value="No">No</option>
																		<option value="Yes">Yes</option>
																		
																	</select>
																	<p style=" margin-bottom: 0;font-size: 12px;margin-top: 2px;">Extra Price '.$recRow->currency.' '.set_na($recRow->discount).'</p>
																	<input type="hidden" name="extrabedrate['.$recRow->title.'][]" value="'.$recRow->currency.' '.set_na($recRow->discount).'" />
																</td>				
															</tr>';
														}
												}
												$resresrv.='</table>
												    </div>
												  </div>
											</div>';

											$isfirst++;
										}

									};
									
								}

							$resresrv.='</div></div>
											<div class="clear"></div></div></div>
						</div>

						<div class=" col-sm-4">
						<div class="reserve_personal_info">
							<div class="row">
								<div class="form-group col-sm-12">
									<h6 style="margin:0px;">Personal Details</h6>
								</div>
								<div class="form-group col-sm-12">
									<input type="text" class="form-control" name="fullname" placeholder="Full Name *" >
								</div>
								<div class="form-group col-sm-12">
									<input type="text" class="form-control" name="mailaddress" placeholder="Email *" >
								</div>
								<div class="form-group col-sm-12">
									<input type="text" class="form-control" name="phone" placeholder="Phone *" >
								</div>
								<div class="form-group col-sm-12">
									<input type="text" class="form-control" name="address" placeholder="Address *" >
								</div>
								<div class="form-group col-sm-12">			
									<select name="country" class="form-control" class="show_fields">
										<option value="">Choose Country *</option>';
										$contRec = Countries::find_all();
										foreach($contRec as $contRow){
											$resresrv.='<option value="'.$contRow->country_name.'">'.$contRow->country_name.'</option>';
										}
									$resresrv.='</select>
								</div>

								

								<h6 >Reservation Information</h6>
								<div class="form-group col-sm-6">
									<input type="text" name="checkin" class="form-control" id="checkin" placeholder="Check-In *">
								</div>
								<div class="form-group col-sm-6">
									<input type="text" name="checkout" class="form-control" id="checkout" placeholder="Check-Out *">
								</div>
								<div class="form-group col-sm-12">
									<textarea name="special_offer" class="form-control" placeholder="Special Requirements or any Special Packages with Special Offer"></textarea>
								</div>
								
								<div class="form-group col-sm-6">
									<img src="'.BASE_URL.'captcha/imagebuilder.php?rand=310333" border="1" class="form-control" onclick="updateCaptcha(this);">				
								</div>
								<div class="form-group col-sm-6">
									<input placeholder="Security Code" type="text" class="form-control" name="userstring" maxlength="5" />
								</div>
								<div class="form-group col-sm-12">
									<input id="btn-booking" name="submit" type="submit" class="btn btn-primary" value="Send">
								</div>

							</div>
						</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>';

}


$jVars['module:reservation_breadcrumb'] = $resbread;
$jVars['module:reservationform'] = $resresrv;
