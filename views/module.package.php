<?php
/*
* Package List
* Package::getPackage($limit);
*/
$respkg='';

$pkgRec = Package::getRoompackage();
if(!empty($pkgRec)) { $i=1;
	foreach($pkgRec as $pkgRow) {
		$col_last = ($i%2==0)?' col_last':'';
		$file_path = SITE_ROOT.'images/package/'.$pkgRow->image;
		if(file_exists($file_path) and !empty($pkgRow->image)) {
			$respkg.='<div class="col_half '.$col_last.'">
		        <div class="feature-box fbox-center fbox-effect clearfix">
		            <h3 class="serif"><span class="hd">'.$pkgRow->title.'</span><span class="subtitle">'.$pkgRow->sub_title.'</span></h3>                           
		            <div id="effect-4">
		                <figure>
		                    <a href="'.BASE_URL.'package/'.$pkgRow->slug.'">
		                    	<img src="'.IMAGE_PATH.'package/'.$pkgRow->image.'" alt="'.$pkgRow->title.'">
		                    </a>
		                    <figcaption class="text-left">                        
		                        <p>'.strip_tags($pkgRow->detail).'<br /></p>
		                        <a href="'.BASE_URL.'package/'.$pkgRow->slug.'" class="button button-small button-black button-reveal tright">
		                        	<span>Read More</span> 
		                        	<i class="icon-chevron-right"></i>
		                        </a>
		                    </figcaption>
		                </figure>
		            </div>                                                       
		        </div>
		    </div>';
		}
	$i++; }
}

$jVars['module:package_list'] = $respkg;


/*
* Room Listing
* Package::get_accommodationId();
* Subpackage::getPackage_limit(pkgid);
*/
// $resRoom='';

// $mpkgId = Package::get_accommodationId();
// if($mpkgId>0) {
// 	$resRoom.='<div class="section nobottommargin notopmargin bgcolor-white" id="goto">                                                          
// 		<div class="container center">                    
// 			<h3 class="handwriting xlarge-font heading1">'.Package::field_by_id($mpkgId, 'title').'</h3>
// 			<p class="bottommargin-sm">'.Package::field_by_id($mpkgId, 'detail').'</p>';
// 			$subRec = Subpackage::getPackage_limit($mpkgId, 3);
// 			if(!empty($subRec)) {
// 				$i=1;
// 				foreach($subRec as $subRow) {
// 					$file_path = SITE_ROOT.'images/subpackage/image/'.$subRow->image2;
// 					if(file_exists($file_path) and !empty($subRow->image2)){ 
// 						$last_chk = ($i++%3==0)?'col_last':'';
// 						$resRoom.='<div class="col_one_third '.$last_chk.'">
// 	                        <div class="feature-box fbox-center fbox-effect clearfix">
// 	                            <h3 class="serif"><span class="hd">'.$subRow->title.'</span><span class="subtitle">Starting at '.$subRow->currency.' '.$subRow->onep_price.' / night</span></h3>                           
// 	        					<div id="effect-4">
// 	                            	<figure>
// 	                                	<a href="'.BASE_URL.'subpackage/'.$subRow->slug.'">
// 	                                		<img src="'.IMAGE_PATH.'subpackage/image/'.$subRow->image2.'" alt="'.$subRow->title.'">
// 	                                	</a>
// 	                                	<figcaption>';
	                        			
// 	                            			$feature = unserialize($subRow->feature);
// 											if(!empty($feature) and !empty($subRow->feature)) {
// 												$resRoom.='<h4 class="color serif normal">'.$feature[1][0][0].'</h4>
// 	                            				<span>
// 	                            					<ul class="serif">';
// 													$flists = $feature[1][1];
// 													if($flists) {
// 														$j=1;
// 														foreach($flists as $k=>$fval) {
// 														if($j<=4) {
// 															$resRoom.='<li>'.Features::getFeaturesName($fval).'</li>';
// 											            }
// 														$j++; }	
// 													}
// 													$resRoom.='</ul>
// 	                                        	</span>';
// 											}
	                                        		
// 	                                        $resRoom.='<a href="'.BASE_URL.'subpackage/'.$subRow->slug.'" class="button button-small button-white button-reveal tright">
// 	                                        	<span>Room Detail</span> <i class="icon-chevron-right"></i>
// 	                                        </a>                        			
// 	                                    </figcaption>
// 	                    			</figure>
// 	                            </div>                                                       
// 	                        </div>
// 	                    </div>';
// 	                }
// 				}
// 				$resRoom.='<a href="javascript:void(0);" class="button button-medium button-reveal button-white tright">
// 					<span>See all Available Rooms</span> 
// 					<i class="icon-chevron-right"></i>
// 				</a>';
// 			}
// 		$resRoom.='</div>
// 	</div>';
// }

// $jVars['module:subpackage_list'] = $resRoom;


/*
* Package Detail
*/

$respkgbread=$respkgdetail='';

if(defined('PACKAGE_PAGE') and isset($_REQUEST['slug'])) {
	$slug = addslashes($_REQUEST['slug']);
	$recRow = Package::find_by_slug($slug);

	if(!empty($recRow)) {
		$imglink='';
		if($recRow->banner_image != "a:0:{}") { 
			$imageList = unserialize($recRow->banner_image);
			$imgno = array_rand($imageList);
			$file_path = SITE_ROOT.'images/package/banner/'.$imageList[$imgno];
			if(file_exists($file_path)) {
				$imglink = IMAGE_PATH.'package/banner/'.$imageList[$imgno];
			}
			else {
				$imglink = IMAGE_PATH.'package-img.jpg';
			}
		}
		else {
			$imglink = IMAGE_PATH.'package-img.jpg';
		}

		$respkgbread.='<section id="page-title" class="page-title page-title-dark mild-dark-overlay" style="background-image: url('.$imglink.'); 
        background-size: cover; background-position: center bottom;">

            <div class="container center clearfix">
                <h1 class="serif normal">'.$recRow->title.'</h1>
                <span class="breadcrumb">
                	<a href="'.BASE_URL.'">Home</a> | 
                	'.$recRow->title.'
                </span>
                <div class="subcaption">'.strip_tags($recRow->sub_title).'</div>
            </div>

        </section>';

        if(!empty($recRow->content)) {
	        $respkgdetail.='<section id="content" class="">

	            <div class="content-wrap">

	                <div class="container clearfix">

	                    <!-- Post Content
	                    ============================================= -->
	                    <div class="boxedcontainer">';

	                    	// Detail page
	                        $respkgdetail.= $recRow->content;
	                        
	                        // Facility
	                		$fctitle=''; $fcoptoin=array();
				            if(!empty($recRow->facility) and $recRow->facility!='a:0:{}') {
				                $fclty = unserialize($recRow->facility); 
				                $fctitle = $fclty[0];
				                $fcoptoin = array_slice($fclty, 1);
				            }

				            $respkgdetail.='<h4>'.$fctitle.'</h4>
				            <ul class="">';							            	
				            	foreach($fcoptoin as $fck=>$fcval) {
				            		$respkgdetail.='<li>'.$fcval.'</a></li>';
								}
				            $respkgdetail.='</ul>';

	                    $respkgdetail.='</div><!-- .postcontent end -->
	                </div>

	            </div>

	        </section><!-- #content end -->';
	    }

        $subRec = Subpackage::getPackage_limit($recRow->id);
		if(!empty($subRec)) {
	        $respkgdetail.='<div class="section nobottommargin notopmargin " id="goto">                                                          
				<div class="container center">                    
					
					<p class="center bottommargin-sm">'.strip_tags($recRow->detail).'</p>';				
					$i=1;
					foreach($subRec as $subRow) {
						$file_path = SITE_ROOT.'images/subpackage/image/'.$subRow->image2;
						if(file_exists($file_path) and !empty($subRow->image2)){ 
							$last_chk = ($i++%2==0)?'col_last':'';
							$respkgdetail.='<div class="col_half '.$last_chk.'">
		                        <div class="feature-box fbox-center fbox-effect clearfix">
		                            <h3 class="serif"><span class="hd">'.$subRow->title.'</span><!--<span class="subtitle">Starting at '.$subRow->currency.' '.$subRow->onep_price.' / night</span>--></h3>                           
		        					<div id="effect-4">
		                            	<figure>
		                                	<a href="'.BASE_URL.'subpackage/'.$subRow->slug.'">
		                                		<img src="'.IMAGE_PATH.'subpackage/image/'.$subRow->image2.'" alt="'.$subRow->title.'">
		                                	</a>
		                                	<figcaption>';
		                        			
		                            			$feature = unserialize($subRow->feature);
												if(!empty($feature) and !empty($subRow->feature)) {
													$respkgdetail.='<h4 class="color serif">'.$feature[1][0][0].'</h4>
		                            				<span>
		                            					<ul class="serif">';
														$flists = $feature[1][1];
														if($flists) {
															$j=1;
															foreach($flists as $k=>$fval) {
															if($j<=6) {
																$respkgdetail.='<li>'.Features::getFeaturesName($fval).'</li>';
												            }
															$j++; }	
														}
														$respkgdetail.='</ul>
		                                        	</span>';
												}
		                                        		
		                                        $respkgdetail.='<a href="'.BASE_URL.'subpackage/'.$subRow->slug.'" class="button button-small button-white button-reveal tright">
		                                        	<span>Room Detail</span> <i class="icon-chevron-right"></i>
		                                        </a>                        			
		                                    </figcaption>
		                    			</figure>
		                            </div>                                                       
		                        </div>
		                    </div>';
		                }
					}				
				$respkgdetail.='</div>
			</div>';
		}

	}

}

$jVars['module:package_breadcrumb']= $respkgbread;
$jVars['module:package_detail']= $respkgdetail;


/*
* Sub Package Detail
*/

$respkgsbread=$respkgsdetail='';

if(defined('SUBPKGDETAIL_PAGE') and isset($_REQUEST['slug'])) {
	$slug = addslashes($_REQUEST['slug']);
	$recRow = Subpackage::find_by_slug($slug);

	if(!empty($recRow)) { 
		$imglink='';
		if($recRow->image != "a:0:{}") { 
			$imageList = unserialize($recRow->image);
			$imgno = array_rand($imageList);
			$file_path = SITE_ROOT.'images/subpackage/'.$imageList[$imgno];
			if(file_exists($file_path)) {
				$imglink = IMAGE_PATH.'subpackage/'.$imageList[$imgno];
			}
			else {
				$imglink = IMAGE_PATH.'subpackage-img.jpg';
			}
		}
		else {
			$imglink = IMAGE_PATH.'subpackage-img.jpg';
		}

		$parentRec = Package::find_by_id($recRow->type);
		$respkgsbread.='<section id="page-title" class="page-title page-title-dark mild-dark-overlay" style="background-image: url('.$imglink.'); 
        background-size: cover; background-position: center bottom;">

            <div class="container center clearfix">
                <h1 class="serif normal">'.$recRow->title.'</h1>
                <span class="breadcrumb">
                	<a href="'.BASE_URL.'">Home</a> | 
                	<a href="'.BASE_URL.'package/'.$parentRec->slug.'">'.$parentRec->title.'</a> | 
                	'.$recRow->title.'
                </span>
                <span>'.strip_tags($recRow->detail).'</span>
            </div>

        </section>';


        $content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->content));	
		$content = !empty($content[1])?$content[1]:$content[0];

		$respkgsdetail.='<div class=" event entry-image parallax overlay-right nobottommargin" style="background-image: url('.$imglink.'); min-height:1100px" data-stellar-background-ratio="0.3">
		<div class="entry-overlay-meta">
			<div class="gallery">';
			if($recRow->image != "a:0:{}") {
				$imageList = unserialize($recRow->image);
				foreach($imageList as $k=>$img_name) {
					$file_path = SITE_ROOT.'images/subpackage/'.$img_name;
					if(file_exists($file_path)) {
						$respkgsdetail.='<div class="img_cover">
							<a href="'.IMAGE_PATH.'subpackage/'.$img_name.'" class="fancybox" data-fancybox-group="gallery">
								<img src="'.IMAGE_PATH.'subpackage/'.$img_name.'" />
							</a>
						</div>';
					}
				}

			}
			$respkgsdetail.='</div>
			<div class="btngoup">
			<a href="'.BASE_URL.'package/'.$parentRec->slug.'" class="btn btn-default-cstm  btn-default">Back to list</a>

			<!--<a href="https://book.securebookings.net/roomrate?id=6a54fcb9-1718-1522127846-465c-8eed-c7da19473889" class="button button-border button-dark button-outline button-medium topmargin-sm">Book Now</a>-->
			<a href="https://41615.staygrid.com/webreservation/index/index/hidHotelIdWebOut/QV5TX0ZSczM0XzQxNjE1X0Y1dGVyOTA4N3NfKWRoZl9kcnRlcjdfNDE2MTVfaGdmaF9nXmQ4NTQ=/hidLanguageId/1/" target="_blank" class="button button-border button-dark button-outline button-medium topmargin-sm">Book Now</a>

			</div>
            <div class="block">
                
                <div class="briefs">'.$content.'</div>';                

				if(!empty($recRow->feature)) {
		        	$ftRec = unserialize($recRow->feature);
		        	if(!empty($ftRec)) {
			        	foreach($ftRec as $k=>$v) {
			        		$respkgsdetail.='<h4>'.$v[0][0].'</h4>';
			        		if(!empty($v[1])) {
								$respkgsdetail.='<ul class="iconlist serif">';									
									foreach($v[1] as $kk=>$vv) {
										$sfetname = Features::find_by_id($vv);	
										$respkgsdetail.='<li>	
											<i class="icon-chevron-right"></i>'.$sfetname->title.'
										</li>';
									}										
								$respkgsdetail.='</ul>';
							}
			        	}
			        }
		        }


		        if(!empty($recRow->onep_price)) {
					$respkgsdetail.='<h4>Tariff</h4>
					<table class="table">
						<thead>
							<tr>
								<th style=" text-align:left;">Rooms</th>
								<th>1 no. of Pax</th>';
								if(!empty($recRow->twop_price)) {
									$respkgsdetail.='<th>2 no. of Pax</th>';
								}
								if(!empty($recRow->threep_price)) {
									$respkgsdetail.='<th>3 no. of Pax</th>';
								}
								if(!empty($recRow->extra_bed)) {
									$respkgsdetail.='<th>Extra bed</th>';
								}
							$respkgsdetail.='</tr>
						</thead>
						<tbody>
							<tr>
								<td>'.$recRow->title.'</td>
								<td><strong>'.$recRow->currency.' '.$recRow->onep_price.'</strong></td>';
								if(!empty($recRow->twop_price)) {
									$respkgsdetail.='<td><strong>'.$recRow->currency.' '.$recRow->twop_price.'</strong></td>';
								}
								if(!empty($recRow->threep_price)) {
									$respkgsdetail.='<td><strong>'.$recRow->currency.' '.$recRow->threep_price.'</strong></td>';
								}
								if(!empty($recRow->extra_bed)) {
									$respkgsdetail.='<td><strong>'.$recRow->currency.' '.$recRow->extra_bed.'</strong></td>';
								}
							$respkgsdetail.='</tr>
						</tbody>
					</table>';
				}

				$respkgsdetail.='</div></div></div>
            
        ';

	}

}

$jVars['module:subpackage_breadcrumb']= $respkgsbread;
$jVars['module:subpackage_detail']= $respkgsdetail;
?>