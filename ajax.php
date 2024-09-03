<?php
require_once("includes/initialize.php");

$galResult='';
$offset = is_numeric($_POST['offset']) ? $_POST['offset'] : die();
$postnumbers = is_numeric($_POST['number']) ? $_POST['number'] : die();

$gallRec = GalleryImage::getImagelist_by(1,$postnumbers,$offset);
if($gallRec){
    foreach($gallRec as $row){
        $file_path = SITE_ROOT.'images/gallery/galleryimages/'.$row->image;
        if(file_exists($file_path)):            
            $galResult.='<li class="col-xs-6 col-md-3 suite">
                <a href="'.IMAGE_PATH.'gallery/galleryimages/'.$row->image.'" title="'.$row->title.'">
                    <!--<img src="'.IMAGE_PATH.'gallery/galleryimages/'.$row->image.'" alt="'.$row->title.'">-->
                    <img class="lazy"  data-src="'.IMAGE_PATH.'gallery/galleryimages/'.$row->image.'" src="'.IMAGE_PATH.'apanel/loading.gif" alt="'.$row->title.'" />
                    <div class="caption"><span>'.$row->title.'</span></div>
                </a>
            </li>';         
        endif;
    }
}

echo $galResult;
?>