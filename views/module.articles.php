<?php
$resinnbread=$resinndetail='';

if(defined('INNER_PAGE') and isset($_REQUEST['page'])) {
	$slug = addslashes($_REQUEST['page']);
	$recRow = Article::find_by_slug($slug);
	if(!empty($recRow)) {
		$imglink='';
		if($recRow->image != "a:0:{}") { 
			$imageList = unserialize($recRow->image);
			$imgno = array_rand($imageList);
			$file_path = SITE_ROOT.'images/articles/'.$imageList[$imgno];
			if(file_exists($file_path)) {
				$imglink = IMAGE_PATH.'articles/'.$imageList[$imgno];
			}
			else {
				$imglink = IMAGE_PATH.'inner-img.jpg';
			}
		}
		else {
			$imglink = IMAGE_PATH.'inner-img.jpg';
		}


		$resinnbread.='<section id="page-title" class="page-title page-title-dark mild-dark-overlay" style="background-image: url('.$imglink.'); 
        background-size: cover; background-position: center bottom;">

            <div class="container center clearfix">
                <h1 class="serif normal">'.$recRow->title.'</h1>
                <span class="breadcrumb">
                	<a href="'.BASE_URL.'">Home</a> | 
                	'.$recRow->title.'
                </span>
            </div>

        </section>';

        $content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->content));	
		$content = implode(" ", $content);
        $resinndetail.= $content;
	}
    else {
		redirect_to(BASE_URL);
	}    
}

$jVars['module:inner_breadcrumb']= $resinnbread;
$jVars['module:inner_detail']= $resinndetail;


/*
* Home page 
*/
$resinnh='';

if(defined('HOMEPAGE')) {
	$recInn = Article::homepageArticle(3);
	if(!empty($recInn)) {
		$cn=1;
		foreach($recInn as $innRow) {
			$parallax = ($cn%2==1)?'parallax mobile-parallax':'';
			$imglink='';
			if($innRow->image != "a:0:{}") { 
				$imageList = unserialize($innRow->image);
				$imgno = array_rand($imageList);
				$file_path = SITE_ROOT.'images/articles/'.$imageList[$imgno];
				if(file_exists($file_path)) {
					$imglink = IMAGE_PATH.'articles/'.$imageList[$imgno];
				}
				else {
					$imglink = IMAGE_PATH.'inner-img.jpg';
				}
			}
			else {
				$imglink = IMAGE_PATH.'inner-img.jpg';
			}
			$htitle = ($cn==1)?'<h1 class="text-center">'.$innRow->title.'</h1>':'<h2 class="text-center">'.$innRow->title.'</h2>';
			
			$resinnh.='<div id="hm'.$innRow->id.'" class="section nobottommargin '.$parallax.' notopmargin bottompadding-lg '.$innRow->slug.'">                
				<style>div.'.$innRow->slug.'{background-image: url('.$imglink.');}</style>                                          
				<div class="container center">
					<div class="row">
						<div class="col-sm-8 centered parallax-height">

							<div class="black_palatte ">
								'.$htitle.'
								<p>'.strip_tags($innRow->sub_title).'</p><br />';
								if(!empty($innRow->content)) {
									$resinnh.='<a href="'.BASE_URL.'page/'.$innRow->slug.'" class="btn btn-sm btn-default transparent">Read More</a>';                
								}
							$resinnh.='</div>   
						</div>
					</div>   
				</div>                   
			</div>';
					
		$cn++; }
	}
	
}

$jVars['module:home_article'] = $resinnh;

?>