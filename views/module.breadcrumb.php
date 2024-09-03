<?php 
$result='';

$homelink='<h6><a href="home">Home</a></h6>';

if(defined('CONTACT_PAGE')):
	$result.=$homelink.'<h6><span class="page-active">Contact</span></h6>';
endif;	

if(defined('SUBPKGDETAIL_PAGE')){
	$id = (!empty($_REQUEST['id']) and isset($_REQUEST['id']))?$_REQUEST['id']:'0';
	$sid = (!empty($_REQUEST['sid']) and isset($_REQUEST['sid']))?$_REQUEST['sid']:'0';

	if($id){
		$rec1 = Subpackage::find_by_id($id);
		if($rec1){
		$rec2 = Package::find_by_id($rec1->type);
	$result.='<a href="'.BASE_URL.'">Home</a>
                <span class="seperator" >/</span>
                <a href="'.BASE_URL.'package'.$rec2->id.'-'.sanitize_titlesite($rec2->title).'">'.$rec2->title.'</a>
                <span class="seperator" >/</span>
                '.$rec1->title;
            }
    }

    if($sid){
    	$rec3 = Package::find_by_id($sid);
    	$result.='<a href="'.BASE_URL.'">Home</a>
                <span class="seperator" >/</span>
                '.$rec3->title;
    }
}

$jVars['module:breadcrumb']= $result;
?>