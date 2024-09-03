<?php
/* Bottom Advertisment */
$result='';

$Records = Advertisement::getAdvertisment_by(4,1);
if($Records):
  $sn=1;
  foreach($Records as $RecRow):
    $file_path = SITE_ROOT.'images/advertisement/'.$RecRow->image;
    if(file_exists($file_path)):
    $result.='<div class="blog-sidebar-content">
                <div class="blog-sidebar-title">
                  <h3>'.$RecRow->title.'</h3>
                </div>
                <div class="blog-sidebar-square-ads"> 
                  <a href="'.$RecRow->url_link.'" target="_blank">
                    <img src="'.IMAGE_PATH.'advertisement/'.$RecRow->image.'" alt="'.$RecRow->title.'" style="max-width: 400px;">
                  </a>
                </div>
              </div>';
    endif;	
  endforeach;	
endif;
$jVars['module:advertismentLeft']= $result;

?>