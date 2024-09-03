<?php 
	// Load the header files first
	header("Expires: 0"); 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	header("cache-control: no-store, no-cache, must-revalidate"); 
	header("Pragma: no-cache");

	// Load necessary files then...
	require_once('../initialize.php');
	
	$action = $_REQUEST['action'];
	
	switch($action) 
	{		
		case "add":	
			$record = new Config();
			
			$record->sitetitle 			= $_REQUEST['sitetitle'];
			$record->icon_upload 		= $_REQUEST['imageArrayname'];
			$record->logo_upload		= $_REQUEST['imageArrayname2'];
			$record->sitename			= $_REQUEST['sitename'];
			$record->copyright 			= $_REQUEST['copyright'];
			$record->meta_title 		= $_REQUEST['meta_title'];
			$record->site_keywords		= $_REQUEST['site_keywords'];
			$record->site_description	= $_REQUEST['site_description'];
			$record->schema_code		= $_REQUEST['schema_code'];
			$record->google_anlytics	= $_REQUEST['google_anlytics'];			

			$db->begin();
			if($record->save()): $db->commit();
			$message  = sprintf($GLOBALS['basic']['addedSuccess_'], "Config '".$record->sitetitle."'");
			echo json_encode(array("action"=>"success","message"=>$message));
			log_action($message,1,3);
			else: $db->rollback(); echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['unableToSave']));
			endif;
		break;
			
		case "edit":
			$record = Config::find_by_id($_REQUEST['idValue']);
			
			$record->sitetitle 			= $_REQUEST['sitetitle'];					
			$record->sitename			= $_REQUEST['sitename'];
			$record->copyright 			= $_REQUEST['copyright'];
			$record->meta_title 		= $_REQUEST['meta_title'];
			$record->site_keywords		= $_REQUEST['site_keywords'];
			$record->site_description	= $_REQUEST['site_description'];
			$record->schema_code		= $_REQUEST['schema_code'];
			$record->google_anlytics	= $_REQUEST['google_anlytics'];
			$record->action 			= '0';

			if(!empty($_REQUEST['imageArrayname'])):
				$record->icon_upload 		= $_REQUEST['imageArrayname'];
			endif;

			if(!empty($_REQUEST['imageArrayname2'])):
				$record->logo_upload		= $_REQUEST['imageArrayname2'];
			endif;

			$db->begin();
			if($record->save()):$db->commit();
			   $message  = sprintf($GLOBALS['basic']['changesSaved_'], "Config '".$record->sitetitle."'");
			   echo json_encode(array("action"=>"success","message"=>$message));
			   log_action($message,1,4);
			else: $db->rollback();echo json_encode(array("action"=>"notice","message"=>$GLOBALS['basic']['noChanges']));
			endif;
		break;	

		case "locationedit":
			$record = Config::find_by_id($_REQUEST['idValue']);
			
			$record->fiscal_address = $_REQUEST['fiscal_address'];
			$record->mail_address 	= $_REQUEST['mail_address'];
			$record->contact_info 	= $_REQUEST['contact_info'];
			$record->email_address 	= $_REQUEST['email_address'];
			$record->breif 			= $_REQUEST['breif'];
			$record->location_type 	= $_REQUEST['location_type'];					
			$record->location_map 	= $_REQUEST['location_map'];

			if(!empty($_REQUEST['imageArrayname'])):
				$record->location_image = $_REQUEST['imageArrayname'];
			endif;

			if(empty($_REQUEST['imageArrayname']) and $_REQUEST['location_type']!=1):				
				echo json_encode(array("action"=>"warning","message"=>"Required Upload Image !"));
				exit;					
			endif;
			
			$db->begin();
			if($record->save()):$db->commit();
			   $message  = sprintf($GLOBALS['basic']['changesSaved_'], "Config '".$record->sitetitle."'");
			   echo json_encode(array("action"=>"success","message"=>$message));
			   log_action($message,1,4);
			else: $db->rollback();echo json_encode(array("action"=>"notice","message"=>$GLOBALS['basic']['noChanges']));
			endif;
		break;
		
	}
?>