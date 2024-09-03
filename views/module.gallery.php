<?php
/*
* Gallery 
*/
$resgbread=$resglist='';
if(defined('GALLERY_PAGE')) {
	$recGall = Gallery::getGalleryList();
	if(!empty($recGall)) {
		$randRec = array_rand($recGall);
		$galImage = $recGall[$randRec]->image;

		$resgbread.='<section id="page-title" class="page-title page-title-dark dark-overlay" style="background-image: url('.IMAGE_PATH.'gallery/'.$galImage.'); 
        background-size: cover; background-position: center center;">

            <div class="container center clearfix">
                <h1 class="serif normal">Gallery</h1>
                <span class="breadcrumb">
                	<a href="'.BASE_URL.'">Home</a> | Gallery
                </span>
            </div>
                        
            <!-- Portfolio Filter
            ============================================= -->            
            <div class="portfolio-filter">
           		<ul id="portfolio-filter" class="clearfix">
                	<li class="activeFilter"><a href="javascript:void(0);" data-filter="*">All</a></li>';
                	$newArr = array();
                	foreach($recGall as $gallRow) {
                		$totchild = GalleryImage::getTotalImages($gallRow->id);
                		if($totchild>0) {
                			$newArr[] = array('parntId'=>$gallRow->id, 'slug'=>create_slug($gallRow->title));
                			$resgbread.='<li class="serif">
                				<a href="javascript:void(0);" data-filter=".'.create_slug($gallRow->title).'">'.ucfirst($gallRow->title).'</a>
                			</li>';
                		}
                	}
            	$resgbread.='</ul>
           	</div>

        </section><!-- #page-title end -->';

        if(!empty($newArr)) {
	        $resglist.='<section id="content">

	            <div class="content-wrap bgcolor-white dark nobottompadding notoppadding">

        			<!-- Portfolio Items
                    ============================================= -->
                    <div id="portfolio" class="portfolio-4 portfolio-nomargin portfolio-full clearfix">';

                    foreach($newArr as $newRow) {
                    	$subgRec = GalleryImage::getImagelist_by($newRow['parntId']);
                    	if(!empty($subgRec)) {
                    		foreach($subgRec as $subgRow) {
	                    		$img_path = SITE_ROOT.'images/gallery/galleryimages/'.$subgRow->image;	
	                    		if(file_exists($file_path) and !empty($subgRow->image)) {
			                        $resglist.='<article class="portfolio-item '.$newRow['slug'].'">
			                            <div class="portfolio-image">
			                                <img src="'.IMAGE_PATH.'gallery/galleryimages/'.$subgRow->image.'" alt="'.$subgRow->title.'">
			                                <div class="portfolio-overlay">
			                                    <div class="portfolio-desc heading-block center">
			                                        <h3 class="serif">
			                                        	<a href="'.IMAGE_PATH.'gallery/galleryimages/'.$subgRow->image.'" data-lightbox="image">'.$subgRow->title.'</a>
			                                        </h3>
			                                    </div>
			                                </div>
			                            </div>
			                        </article>';  
		                        }    
		                    }
	                    }       
                    }                                                                                                                     
	                        
                    $resglist.='</div><!-- #portfolio end -->	                    
                </div>
	        </section> <!-- #content end -->';
	    }

	}
}

$jVars['module:gallery_breadcrumb'] = $resgbread;
$jVars['module:gallery_imglist'] = $resglist;

$result='';

if(defined('GALLERY_PAGE')){
	$gallRec = GalleryImage::getImagelist_by(2);
	
	if($gallRec){
		$result.='<ul class="gallery-img-container clearfix content">
			    <!-- Image boxes -->';
		foreach($gallRec as $row){
			$file_path = SITE_ROOT.'images/gallery/galleryimages/'.$row->image;
			if(file_exists($file_path)):			
			    $result.='<li class="col-xs-6 col-md-4 suite">
			        <a href="'.IMAGE_PATH.'gallery/galleryimages/'.$row->image.'" title="'.$row->title.'">
			            <img class="lazy"  data-src="'.IMAGE_PATH.'gallery/galleryimages/'.$row->image.'" src="'.IMAGE_PATH.'apanel/loading.gif" alt="'.$row->title.'" />
			            <div class="caption"><span>'.$row->title.'</span></div>
			        </a>
			    </li>';		    
		    endif;
		}
		$result.='</ul>
		<div class="page_navigation"></div>
	    <!--<div class="pagination-box">
	        <ul>
	            <li class="active"><a href="#"><span>1</span></a></li>
	            <li><a href="#"><span>2</span></a></li>
	            <li><a href="#"><span>3</span></a></li>
	            <li><a href="#"><span>4</span></a></li>
	            <li><a href="#"><span>5</span></a></li>
	        </ul>
	    </div>-->';
	}
}

$jVars['module:galleryList']= $result;
?>