<?php
/* First Slideshow */
$reslide = '';

$Records = Slideshow::getSlideshow_by(1);
if (!empty($Records)) {
    $reslide .= '<section id="slider" class="swiper_wrapper clearfix bgcolor-grey-dark">
        <div class="swiper-container swiper-parent">           
            <div class="swiper-wrapper">';
    $newcss = '';
    foreach ($Records as $RecRow) {
        $file_path = SITE_ROOT . 'images/slideshow/' . $RecRow->image;
        if (file_exists($file_path) and !empty($RecRow->image)) {
            $splitSRC = explode("http://", $RecRow->linksrc);
            $linkTarget = ($RecRow->linktype == 1) ? ' target="_blank" ' : '';
            $linksrc = (count($splitSRC) == 1) ? BASE_URL . $RecRow->linksrc : $RecRow->linksrc;
            $linkstart = ($RecRow->linksrc != '') ? '<a href="' . $linksrc . '" ' . $linkTarget . ' class="button button-medium button-reveal button-outline button-dark tright">' : '<a href="javascript:void(0);" class="button button-medium button-reveal button-outline button-dark tright">';
            $linkend = ($RecRow->linksrc != '') ? '</a>' : '</a>';

            $reslide .= '<div class="swiper-slide new-banner-' . $RecRow->id . '">
                                <div class="hero-title-caption">
                                    <p class="text-left">' . strip_tags($RecRow->content) . '</p>
                                </div>
                    </div>';
            $newcss .= 'div.new-banner-' . $RecRow->id . '{ background:url(' . IMAGE_PATH . 'slideshow/' . $RecRow->image . '); background-size:cover}';
        }
    }

    $reslide .= '</div>  

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev" id="slider-arrow-left"><i>&larr;</i></div>
            <div class="swiper-button-next" id="slider-arrow-right"><i>&rarr;</i></div>              
        </div>

    </section>';
    $reslide .= '<style>' . $newcss . '</style>';
}

$jVars['module:slideshow'] = $reslide;
?>