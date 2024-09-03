<?php 
/*
* Popup Message
*/
$respopup=''; 

$popRec = Config::getField('headers', true);
if(!empty($popRec)) {
    $respopup.='<a href="javascript:void(0);" data-toggle="modal" data-target=".popup-message" class="home-popup hide">&nbsp;</a>
    <div class="modal fade popup-message" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-body">
            
                <div class="modal-content">
                             
                    <div class="modal-body bgcolor-black dark">

                        <div class="boxedcontainer mini-links clearfix">
            
                            '.$popRec.'                                                   
        
                        </div>

                    </div>
     
                </div>
            </div>
        </div>
 	</div>';
}

$jVars['module:popup_message'] = $respopup;