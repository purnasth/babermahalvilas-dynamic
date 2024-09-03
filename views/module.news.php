<?php
/*
* News page
*/
$resnwsbread=$resnews='';

if(defined('NEWS_PAGE')) {
	$newsRec = News::get_allnews();
	if(!empty($newsRec)) {

		$resnwsbread.='<section id="page-title" class="page-title page-title-dark mild-dark-overlay" style="background-image: url('.IMAGE_PATH.'news-img.jpg); 
        background-size: cover; background-position: center bottom;">

            <div class="container center clearfix">
                <h1 class="handwriting xlarge-font heading1">Conference & Events</h1>
                <span>Meetings, Incentives, Conference & Events (M.I.C.E)</span>
            </div>

        </section>';

		foreach($newsRec as $newsRow) {
			$resnews.='<!-- Post -->
	        <div class="entry clearfix fixborder-tablet fixborder-phone">
	            <div class="entry-image">';
	            	if($newsRow->type=='1') {
	            		$file_path = SITE_ROOT.'images/news/'.$newsRow->image;
	            		if(file_exists($file_path) and !empty($newsRow->image)) {
		            		$resnews.='<a href="'.IMAGE_PATH.'news/'.$newsRow->image.'" data-lightbox="image">
			            		<img class="image_fade" src="'.IMAGE_PATH.'news/'.$newsRow->image.'" alt="'.$newsRow->title.'">
			            	</a>';
			            }
	            	}
	            	else {
	            		if(!empty($newsRow->source)) {
	            			$resnews.= embedYoutube($newsRow->source);
	            		}
	            	}            	
	                
	            $resnews.='</div>
	            <div class="entry-title">
	                <h2><a href="javascript:void(0);">'.$newsRow->title.'</a></h2>
	            </div>
	            <ul class="entry-meta clearfix">
	                <li><i class="icon-calendar3"></i> '.date('dS M Y', strtotime($newsRow->news_date)).'</li>
	            </ul>
	            <div class="entry-content">';
	            	$content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($newsRow->content));	
					$content = !empty($content[1])?$content[1]:$content[0];
			        $resnews.= $content;
	                
	            $resnews.='</div>
	        </div>
	        <!-- End Post -->';
	    }

	}
	
}

$jVars['module:news_breadcrumb'] = $resnwsbread;
$jVars['module:news_list'] = $resnews;

?>