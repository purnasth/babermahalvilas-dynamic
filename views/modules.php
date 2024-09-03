<?php
// SITE REGULARS
$jVars['site:footer'] 		= Config::getField('footer',true);
$siteRegulars 						= Config::find_by_id(1);
$jVars['site:copyright']	= '&copy; <span class="brand">Baber Mahal Vilas</span>. '.str_replace('{year}',date('Y'),$siteRegulars->copyright);
$jVars['site:fevicon']		=  '<link rel="shortcut icon" href="'.IMAGE_PATH.'preference/'.$siteRegulars->icon_upload.'"> 
							    <link rel="apple-touch-icon" href="'.IMAGE_PATH.'preference/'.$siteRegulars->icon_upload.'"> 
							    <link rel="apple-touch-icon" sizes="72x72" href="'.IMAGE_PATH.'preference/'.$siteRegulars->icon_upload.'"> 
							    <link rel="apple-touch-icon" sizes="114x114" href="'.IMAGE_PATH.'preference/'.$siteRegulars->icon_upload.'">';
$jVars['module:logos']		= '<a class="" href="'.BASE_URL.'"><img id="logo" alt="'.$siteRegulars->sitetitle.'" src="'.IMAGE_PATH.'preference/'.$siteRegulars->logo_upload.'" width="200"></a>';				    
$jVars['site:seotitle'] 	= MetaTagsFor_SEO();
$jVars['site:baseUrl'] 	= BASE_URL;
$jVars['site:contactinfo'] 	= $siteRegulars->contact_info;

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
                        <li><a href="https://41615.staygrid.com/webreservation/index/index/hidHotelIdWebOut/QV5TX0ZSczM0XzQxNjE1X0Y1dGVyOTA4N3NfKWRoZl9kcnRlcjdfNDE2MTVfaGdmaF9nXmQ4NTQ=/hidLanguageId/1/" title="Book online securely | Babermahal Vilas" target="_blank"><span>Reservation</span> <!--<img src="'.BASE_URL.'template/cms/images/arrow.png" alt="Book online securely | Babermahal Vilas"></a>--></li>
			
                    </ul>
                    <!--
                    <section id="hbe-bws-wrapper-widget-code"></section><link type="text/css" rel="stylesheet" href="//book.securebookings.net/css/search-wdg.css" /><script type="text/javascript" src="//book.securebookings.net/js/widget.search.js"></script><script type="text/javascript" src="//book.securebookings.net/searchWidgetCustomize?lang=en&id=6a54fcb9-1718-1522127846-465c-8eed-c7da19473889&ajax=true"></script>                   
                    -->
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
foreach($modulesList as $module):	
	$fileName = "module.".$module->mode.".php";
	if(file_exists("views/".$fileName)){
	  require_once("views/".$fileName);
	}
endforeach;

?>