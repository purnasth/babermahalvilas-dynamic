<?php

$resfloc='';
$reslocinfo='';
$resgmap='';

$configRec  = Config::find_by_id(1);
if($configRec) {
   	/*
	* Footer office location
	*/
	$emlAddress = str_replace('@','&#64;',$configRec->mail_address);
    $resfloc.= '<p class="nomargin"><a class="" href="'.BASE_URL.'"><img alt="'.$configRec->sitetitle.'" src="'.IMAGE_PATH.'preference/'.$configRec->logo_upload.'" width="150"></a></p>

	<p class="small-font serif nobottommargin"><a href="mailto:'.$emlAddress.'">'.$configRec->fiscal_address.',<br> '.$emlAddress.'</a></p>

	<p class="small-font serif"><a href="tel:'.$configRec->contact_info.'">'.$configRec->contact_info.'</a></p>';


	/*
	* Office location
	*/$emails = explode(",", $configRec->email_address);
	$reslocinfo.='<ul class="iconlist nobottommargin">';
		$reslocinfo.='<li><i class="icon-map-marker2"></i> '.$configRec->fiscal_address.'</li>';
		$reslocinfo.='<li><i class="icon-phone3"></i><a href="tel:'.$configRec->contact_info.'"> '.$configRec->contact_info.'</a></li>';
		$reslocinfo.='<li><i class="icon-line-mail"></i> <a href="mailto:'.$emails[0].'">'.$emails[0].'</a></li>';
		// $reslocinfo.='<li><i class="icon-line-mail"></i> <a href="mailto:'.$emails[0].'">'.$emails[0].'</a>,<a href="mailto:'.$emails[1].'">'.$emails[1].'</a></li>';
	$reslocinfo.='</ul>';

	/*
	* Google map
	*/
	if($configRec->location_type==1) {
		$resgmap.='<div class="col_full nopadding nomargin" id="overlay">
	        <iframe id="map" width="100%" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src='.$configRec->location_map.'></iframe>
	    </div>';
	}
	else {
		$resgmap.='<div class="col_full nopadding nomargin" id="overlay">
	        <img src="'.IMAGE_PATH.'preference/locimage/'.$configRec->location_image .'" alt="'.$configRec->sitetitle.'" class="img-responsive">
	    </div>';
	}

}
$jVars['module:officeLocation'] = $resfloc;
$jVars['module:office_information'] = $reslocinfo;
$jVars['module:office_map'] = $resgmap;
?>