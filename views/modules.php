<?php
// SITE REGULARS
$jVars['site:footer'] = Config::getField('footer', true);
$siteRegulars = Config::find_by_id(1);
$jVars['site:copyright'] = '&copy; <span class="brand">Baber Mahal Vilas</span> ' . str_replace('{year}', date('Y'), $siteRegulars->copyright);
$jVars['site:fevicon'] = '<link rel="shortcut icon" href="' . IMAGE_PATH . 'preference/' . $siteRegulars->icon_upload . '"> 
							    <link rel="apple-touch-icon" href="' . IMAGE_PATH . 'preference/' . $siteRegulars->icon_upload . '"> 
							    <link rel="apple-touch-icon" sizes="72x72" href="' . IMAGE_PATH . 'preference/' . $siteRegulars->icon_upload . '"> 
							    <link rel="apple-touch-icon" sizes="114x114" href="' . IMAGE_PATH . 'preference/' . $siteRegulars->icon_upload . '">';
$jVars['module:logos'] = '<a class="" href="' . BASE_URL . '"><img id="logo" alt="' . $siteRegulars->sitetitle . '" src="' . IMAGE_PATH . 'preference/' . $siteRegulars->logo_upload . '" width="200"></a>';
$jVars['site:seotitle'] = MetaTagsFor_SEO();
$jVars['site:baseUrl'] = BASE_URL;
$jVars['site:contactinfo'] = $siteRegulars->contact_info;

/*
$jVars['site:head'] = '
<!-- Header
        ============================================= -->
        <header id="header" class="transparent-header semi-transparent">

            <div id="header-wrap">

                <div class="container clearfix">
                   <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
                    <!-- Logo
                    ============================================= -->
                    <div id="logo" class="nobottomborder">
                        '.$jVars['module:logos'].'
                    </div>

                    <!-- Primary Navigation
                    ============================================= -->
                    <nav id="primary-menu" class="serif normal">
                        <jcms:module:main_menu/>
                    </nav><!-- #primary-menu end -->
                </div>
                <div class="pullover">
                    <ul>
                        <li style="display:none"><a href="https://41615.staygrid.com/webreservation/index/index/hidHotelIdWebOut/QV5TX0ZSczM0XzQxNjE1X0Y1dGVyOTA4N3NfKWRoZl9kcnRlcjdfNDE2MTVfaGdmaF9nXmQ4NTQ=/hidLanguageId/1/" target="_blank"><span>Reservation</span><img src="'.BASE_URL.'template/cms/images/arrow.png" alt="reservation"></a></li>
            
                    </ul>
                </div>
        
        <!--<div class="offer hidden-xs">
            <img src="'.$jVars['site:baseUrl'].'template/cms/images/off.jpg" />
        </div>
        <div class="offer_mob hidden-sm hidden-lg">
            25% off on reservation for all rooms till 31st July, 2018.
        </div>-->
            </div>
        </header><!-- #header end -->
';
*/

$jVars['site:head'] = '
<!-- Header
        ============================================= -->
        <header id="header" class="transparent-header semi-transparent">

            <div id="header-wrap">

                <div class="container clearfix">
                   <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
                    <!-- Logo
                    ============================================= -->
                    <div id="logo" class="nobottomborder">
                        ' . $jVars['module:logos'] . '
                    </div>

                    <!-- Primary Navigation
                    ============================================= -->
                    <nav id="primary-menu" class="serif normal">
                        <jcms:module:main_menu/>
                    </nav><!-- #primary-menu end -->
                </div>

                 <div class="pullover">
                    <ul>
                        <li>
                        <a href="https://41615.staygrid.com/webreservation/index/index/hidHotelIdWebOut/QV5TX0ZSczM0XzQxNjE1X0Y1dGVyOTA4N3NfKWRoZl9kcnRlcjdfNDE2MTVfaGdmaF9nXmQ4NTQ=/hidLanguageId/1/" title="Book online securely | Babermahal Vilas" target="_blank" class="d-flex align-items-center gap-2">
                        Reservation
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="text-lg" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path></svg>  
                      </a>
			
                    </ul>
                </div>
		
		<!--<div class="offer hidden-xs">
			<img src="' . $jVars['site:baseUrl'] . 'template/cms/images/off.jpg" />
		</div>
		<div class="offer_mob hidden-sm hidden-lg">
			25% off on reservation for all rooms till 31st July, 2018.
		</div>-->
            </div>
        </header><!-- #header end -->
';

// view modules 
require_once("views/module.breadcrumb.php");
require_once("views/module.contact.php");
require_once("views/module.booking.php");
require_once("views/module.fastbooking.php");
require_once("views/module.socialmedia_block.php");
require_once("views/module.roomsside_block.php");
require_once("views/module.inner_booking.php");
require_once("views/module.checkavailablity.php");
require_once("views/module.booking_info.php");
// require_once("views/module.blogs.php");
require_once("views/module.reservation.php");
require_once("views/module.events_enquiry.php");
require_once("views/module.careeropp.php");
require_once("views/module.onlinebooking.php");
require_once("views/module.popup.php");

// include ("jpcache/jpcache.php");
// SITE MODULES
$modulesList = Module::getAllmode();
foreach ($modulesList as $module):
    $fileName = "module." . $module->mode . ".php";
    if (file_exists("views/" . $fileName)) {
        require_once("views/" . $fileName);
    }
endforeach;

?>