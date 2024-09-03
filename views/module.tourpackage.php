<?php
$result='';
if(defined('TOUR_PACKAGES')):

	$id = addslashes($_REQUEST['tpid']);
	$Record = Tourpackage::find_by_id($id);
	if($Record){
	 	$file_path = SITE_ROOT.'images/tourpackage/'.$Record->image;
        	if(file_exists($file_path) and !empty($Record->image)):
			$result.='<div class="featured">
						<img src="'.IMAGE_PATH.'tourpackage/'.$Record->image.'" class=\'loaded\' data-width=\'915\' data-height=\'350\'/>				
					  </div>';
			endif;	  

  	$result.='<!--start content-->
  			<div class="grid_12">
              <em style="color : #;">
                <h2>'.$Record->title.'</h2>
              </em>
                '.$Record->content.'
            </div>
            <!--end content-->';
  	        
    }else{
		$result.='Record Not Found !';//redirect_to('404');
	}   

endif;

$jVars['module:tour_packages']= $result;
?>