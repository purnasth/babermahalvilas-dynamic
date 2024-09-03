<?php
$result='';
if(defined('TOUR_ACTIVITY')):

	$id = addslashes($_REQUEST['tpid']);
	$Record = Touractivity::find_by_id($id);
	if($Record){
	 	$file_path = SITE_ROOT.'images/touractivity/'.$Record->image;
        	if(file_exists($file_path) and !empty($Record->image)):
			$result.='<div class="featured">
						<img src="'.IMAGE_PATH.'touractivity/'.$Record->image.'" class=\'loaded\' data-width=\'915\' data-height=\'350\'/>				
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

$jVars['module:tour_activities']= $result;


/***** Heighlight Activities List ******/
$highlight='';
$highRec = Touractivity::get_activity_type(1,10);
if($highRec):
$highlight.='<div class="blog-sidebar-title">
              <h3>Highlighted Activities</h3>
            </div>';

$highlight.='<ul class="highlight_activities">';
  foreach($highRec as $hrow){
    $highlight.='<li><a href="'.BASE_URL.'tour-activity'.$hrow->id.'-'.$hrow->name.'">'.$hrow->title.'</a></li>';
  }
$highlight.='</ul>';            
endif;

$optRec = Touractivity::get_activity_type(0,10);
if($optRec):
$highlight.='<div class="additional">
              Additional and Optional Program
            </div>';


$highlight.='<ul class="highlight_activities">';
  foreach($optRec as $orow){
    $highlight.='<li><a href="'.BASE_URL.'tour-activity'.$orow->id.'-'.$orow->name.'">'.$orow->title.'</a></li>';
  }
$highlight.='</ul>'; 
endif;

$jVars['module:highlights_list']= $highlight;
?>