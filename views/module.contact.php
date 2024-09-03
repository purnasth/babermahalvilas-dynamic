<?php
/*
* Contact page
*/
$resbread=$rescntct='';

if(defined('CONTACTUS_PAGE')) {

    $configRec  = Config::find_by_id(1);
    $resbread.='<section id="page-title" class="page-title page-title-dark mild-dark-overlay" style="background-image: url('.IMAGE_PATH.'imgContact.jpg); 
        background-size: cover; background-position: center top;">

        <div class="container center clearfix">
            <h1 class="serif normal">Contact Us</h1>
            <span class="breadcrumb">
                <a href="'.BASE_URL.'">Home</a> | Contact Us
            </span>
            <span>Experience the Rana style of living - <span class="brand">Baber Mahal Vilas</span></span>
        </div>
        
        <div class="floating-pn-dark dark">Call us '.$configRec->contact_info.'</div> 

    </section>';

	$rescntct.='<form class="nobottommargin" id="template-contactform" name="template-contactform" action="'.BASE_URL.'enquery_mail.php" method="post">
                                                                             
            <div class="col_full bottommargin-xsm">
                <label for="template-contactform-name" class="serif">Name <small>*</small></label>
                <input type="text" id="template-contactform-name" name="fullname" value="" class="sm-form-control required" />
            </div>

            <div class="col_full bottommargin-xsm">
                <label for="template-contactform-email" class="serif">Email <small>*</small></label>
                <input type="email" id="template-contactform-email" name="mailaddress" value="" class="required email sm-form-control" />
            </div>

            <div class="col_full bottommargin-xsm">
                <label for="template-contactform-phone" class="serif">Phone</label>
                <input type="text" id="template-contactform-phone" name="phoneno" value="" class="sm-form-control" />
            </div>

            <div class="col_full bottommargin-xsm">
                <label for="template-contactform-subject" class="serif">Subject <small>*</small></label>
                <input type="text" id="template-contactform-subject" name="subject" value="" class="required sm-form-control" />
            </div>

            <div class="col_full">
                <label for="template-contactform-message" class="serif">Message <small>*</small></label>
                <textarea class="required sm-form-control" id="template-contactform-message" name="message" rows="6" cols="30"></textarea>
            </div>

            <div class="col_full" style="padding-left:8px">
                <button class="button button-medium button-reveal button-gradient-blue tright" type="submit" id="template-contactform-submit" 
                name="template-contactform-submit" value="submit"><span>Submit</span> <i class="icon-chevron-right"></i></button>
            </div>

        </form>';
}


$jVars['module:contact_breadcrumb'] = $resbread;
$jVars['module:contact_form'] = $rescntct;
?>