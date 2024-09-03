<?php
$result='';
$records = Testimonial::getAllTestimonial();
if($records): 
	$result.='<section id="testimonials" data-background="parallax">
		<div id="testimonials-container">
			<div id="testimonials-content" class="container" data-animation="fadeInUp">			
				<div id="testimonials-slider" class="owl-carousel owl-theme">
					<!-- Testimonial item -->';
					foreach($records as $record){
						$result.='<div class="item">
							<div class="client-pic"> 
								<img src="'.IMAGE_PATH.'testimonial/'.$record->image.'" alt="'.$record->name.'" /> 
							</div>
							<blockquote>'.strip_tags($record->content).' <span> '.$record->country.'</span></blockquote>					
						</div>';
					}
					$result.='<!-- End of Testimonial item -->
				</div>
			</div>
		</div>
	</section>';
endif;

$jVars['module:testimonial'] = $result;


$resTestm='';

$TestmRec = Testimonial::getTestimonialList();
if(!empty($TestmRec)) {
	$resTestm.='<div class="section nobottommargin notopmargin bottompadding-lg bgcolor-black dark">                                                          
  		<div id="testimonials-list" class="container toppadding-sm center owl-carousel team-carousel" >';
		foreach($TestmRec as $row) {
		    $resTestm.='<div class="oc-item">
			    <div class="blockquote">
			  		<h3>'.strip_tags($row->content).'</h3>
			  		<span>'.$row->name.' - '.$row->country.'</span>';
				$resTestm.='</div>';
				if(!empty($row->url_link)) {
					$resTestm.='<br /><a href="'.$row->url_link.'" target="_blank" class="button button-medium button-reveal button-border button-dark tright">
						<span>View List</span> 
						<i class="icon-chevron-right"></i>
					</a>';
				}
			$resTestm.='</div>';                
		}
		$resTestm.='</div>                   
    </div>';
}

$jVars['module:home_testimonail'] = $resTestm;
?>

