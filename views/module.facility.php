<?php
$result='';
$records = Facility::getAllFacility();
$counter= 1;
foreach($records as $record):
    $display = ($counter++%4==0)?'style="margin-left:0px;"':'';
    $result.='<div class="span4  jeg_do_animate  " '.$display.' data-animation="janimate-fadein"    data-position="janimpos-bottom" >';
    $result.='<h3><a href="'.$record->link.'"><img class="size-full wp-image-24 aligncenter" src="'.IMAGE_PATH.'facility/'.$record->image.'" alt="'.$record->title.'" width="1024" height="600" /></a></h3>';
    $result.='<h3 style="text-align: center;"><em>'.$record->title.'</em></h3>';
	$result.=$record->content;
	if(!empty($record->link)){
	$result.='<p style="text-align: center; margin-top:15px;" ><a href="'.$record->link.'"  class="btn  btn-default">'.$record->link_title.'</a></p>';
	}
	else{
		$result.='<p style="text-align: center; display:none; margin-top:15px;" ><a href="'.$record->link.'"  class="btn  btn-default">'.$record->link_title.'</a></p>';
		}
	$result.='</div>';
endforeach;
$jVars['module:facility'] = $result;

?>