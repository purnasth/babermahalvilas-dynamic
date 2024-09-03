<?php
$result='';

$socialRec = SocialNetworking::getSocialNetwork();
if($socialRec):
	$result.='<div class="social-widget">
    	<ul>';
	foreach($socialRec as $socialRow):                    		
		$result.='<li>
		<a target="_blank" href="'.$socialRow->linksrc.'"  class="social-icon si-small si-facebook">
	    	<img title="'.$socialRow->title.'" src="'.IMAGE_PATH.'social/'.$socialRow->image.'" alt="'.$socialRow->title.'">
	  	</a></li>';    
    endforeach;
    	$result.='</ul>
    </div>';
endif;

$jVars['module:socilaLink']= $result;
?>