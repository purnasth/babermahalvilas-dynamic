<?php 
$res_offers='';


$recOffer = Offers::getOffers_by();
if($recOffer){
	$res_offers.='<div class="zoomin image">
	    <a class="popup-modal" href="#test-modal"><img src="template/web/assets/img/offer.png" alt="Rooms"></a>
	</div>';

	$res_offers.='<div id="test-modal" class="mfp-hide black-popup-block" >
		<h3><span style="  border-bottom: 1px solid #fff; color:#B19261 !important;"><b>Special</b> Offers</span></h3>
		<!-- Rooms -->
		<section id="rooms">
			<!-- Main Room container -->
			<ul class="property-container clearfix special">';

			foreach($recOffer as $row){
				$res_offers.='<li class="property-boxes col-xs-4 col-md-4" style="float: none;
  margin: auto; margin-bottom:25px;">
					<!-- Room Image and its title -->';
					$file_path = SITE_ROOT.'images/offers/'.$row->image;
        			if(file_exists($file_path)):
					$res_offers.='<div class="prp-img">
						<img src="'.IMAGE_PATH.'offers/'.$row->image.'" alt="'.$row->title.'">
					</div>';
					endif;
					$res_offers.='<div class="prp-detail">
						<div class="title" style="color:#fff">'.$row->title.'</div>';
						if($row->content){
						$res_offers.='<div class="description">'.$row->content.'</div>';
						}

						$splitSRC   = explode("http://", $row->linksrc);
					    $linkTarget = ($row->linktype == 1)? ' target="_blank" ' : ''; 
					    $linksrc  = (count($splitSRC) == 1)? BASE_URL.$row->linksrc : $row->linksrc;
					    $linkstart  = ($row->linksrc!='')? '<a href="'.$linksrc.'" '.$linkTarget.' class="more-detail btn colored">' : '';
					    $linkend  = ($row->linksrc!='')? '</a>' : '' ;
						$res_offers.= $linkstart.'Details'.$linkend.'
					</div>
				</li>
				<!-- End of Room Box -->';
			}

			$res_offers.='</ul>
			<!-- End of Main Room container -->

			<a class="more-detail btn colored popup-modal-dismiss" style="position: absolute;
  top: 0;
  right: 0;" href="javascript:void(0);">X</a>
		</section>
		<!-- END OF Rooms -->
	</div>';
}

$jVars['module:specialOffers'] = $res_offers;

$rsinnoffer='';

$inofferRec = Offers::get_latestoffer(1);
if($inofferRec){	
	$rsinnoffer.='<div class="side-boxes inner_booking inner_offer">
  		<h3 class="side-title">Offer</h3>';
		foreach($inofferRec as $inofferRow)
		{
			$file_path = SITE_ROOT.'images/offers/'.$inofferRow->image;
			if(file_exists($file_path) and !empty($inofferRow->image))
			{
				$splitSRC   = explode("http://", $inofferRow->linksrc);
			    $linkTarget = ($inofferRow->linktype == 1)? ' target="_blank" ' : ''; 
			    $linksrc  = (count($splitSRC) == 1)? BASE_URL.$inofferRow->linksrc : $inofferRow->linksrc;
			    $rsinnoffer.= ($inofferRow->linksrc!='')? '<a href="'.$linksrc.'" '.$linkTarget.'>' : '';
					$rsinnoffer.='<img class="img-responsive" src="'.IMAGE_PATH.'offers/'.$inofferRow->image.'" alt="'.$inofferRow->title.'">';
				$rsinnoffer.= ($inofferRow->linksrc!='')? '</a>' : '' ;
			}
		}
	$rsinnoffer.='</div>';
}
$jVars['module:inner-specialoffer'] = $rsinnoffer;
?>