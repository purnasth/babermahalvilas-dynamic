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
			
			$Package = new Package();
			
			$Package->slug 			= create_slug($_REQUEST['title']);
			$Package->title    		= $_REQUEST['title'];	
			$Package->sub_title    = $_REQUEST['sub_title'];
			$Package->detail   		= $_REQUEST['detail'];	
			$Package->facility   	= serialize(array_values(array_filter($_REQUEST['facility']))
				);
			$Package->content   	= $_REQUEST['content'];
			$Package->banner_image	= serialize(array_values(array_filter($_REQUEST['imageArrayname2'])));
			$Package->image			= $_REQUEST['imageArrayname'];					
			$Package->status		= $_REQUEST['status'];
			$Package->type 			= $_REQUEST['type'];
			$Package->dis_rate 			= $_REQUEST['dis_rate'];
			$Package->meta_title		= $_REQUEST['meta_title'];
			$Package->meta_keywords		= $_REQUEST['meta_keywords'];
			$Package->meta_description	= $_REQUEST['meta_description'];
			$Package->sortorder		= Package::find_maximum();
			$Package->added_date 	= registered();
			
			$checkDupliTitle = Package::checkDupliTitle($Package->title);			
			if($checkDupliTitle):
				echo json_encode(array("action"=>"warning","message"=>"Package Title Already Exists."));		
				exit;		
			endif;

			if(empty($_REQUEST['imageArrayname'])):				
				echo json_encode(array("action"=>"warning","message"=>"Required Upload Package Image!"));
				exit;					
			endif;
			
			$db->begin();
			if($Package->save()): $db->commit();
			   $message  = sprintf($GLOBALS['basic']['addedSuccess_'], "Package Image '".$Package->title."'");
			echo json_encode(array("action"=>"success","message"=>$message));
				log_action("Package [".$Package->title."]".$GLOBALS['basic']['addedSuccess'],1,3);
			else: $db->rollback();
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['unableToSave']));
			endif;				
		break;
		
		case "edit":			
			$Package = Package::find_by_id($_REQUEST['idValue']);
			
			if($Package->title!=$_REQUEST['title']){
				$checkDupliTitle = Package::checkDupliTitle($_REQUEST['title']);
				if($checkDupliTitle):
					echo json_encode(array("action"=>"warning","message"=>"Package Title is already exist."));		
					exit;		
				endif;
			}

			if(!empty($_REQUEST['imageArrayname'])):				
				$Package->image		= $_REQUEST['imageArrayname'];				
			endif;	
			$Package->banner_image	= serialize(array_values(array_filter($_REQUEST['imageArrayname2'])));
			
			$Package->slug 	   = create_slug($_REQUEST['title']);
			$Package->title    = $_REQUEST['title'];
			$Package->sub_title    = $_REQUEST['sub_title'];
			$Package->detail   = $_REQUEST['detail'];
			$Package->facility   	= serialize(array_values(array_filter($_REQUEST['facility'])));	
			$Package->content  = $_REQUEST['content'];	
			$Package->type 	   = $_REQUEST['type'];
			$Package->status   = $_REQUEST['status'];	
			$Package->dis_rate 			= $_REQUEST['dis_rate'];
			$Package->meta_title		= $_REQUEST['meta_title'];
			$Package->meta_keywords		= $_REQUEST['meta_keywords'];
			$Package->meta_description	= $_REQUEST['meta_description'];

			$db->begin();				
			if($Package->save()):$db->commit();	
			   $message  = sprintf($GLOBALS['basic']['changesSaved_'], "Package '".$Package->title."'");
			   echo json_encode(array("action"=>"success","message"=>$message));
			   log_action("Package [".$Package->title."] Edit Successfully",1,4);
			else:$db->rollback();echo json_encode(array("action"=>"notice","message"=>$GLOBALS['basic']['noChanges']));
			endif;							
		break;
								
		case "delete":
			$id = $_REQUEST['id'];
			$record = Package::find_by_id($id);
			log_action("Package  [".$record->title."]".$GLOBALS['basic']['deletedSuccess'],1,6);
			$db->begin();
			$res = $db->query("DELETE FROM tbl_package WHERE id='{$id}'");
  		    if($res):$db->commit();	else: $db->rollback();endif;
			reOrder("tbl_package", "sortorder");						
			echo json_encode(array("action"=>"success","message"=>"Package  [".$record->title."]".$GLOBALS['basic']['deletedSuccess']));							
		break;
		
		case "toggleStatus":
			$id = $_REQUEST['id'];
			$record = Package::find_by_id($id);
			$record->status = ($record->status == 1) ? 0 : 1 ;
			$db->begin();						
				$res   =  $record->save();
				   if($res):$db->commit();	else: $db->rollback();endif;
			echo "";
		break;

		case "bulkToggleStatus":
			$id = $_REQUEST['idArray'];
			$allid = explode("|", $id);
			$return = "0";
			for($i=1; $i<count($allid); $i++){
				$record = Package::find_by_id($allid[$i]);
				$record->status = ($record->status == 1) ? 0 : 1 ;
				$record->save();
			}
			echo "";
		break;
			
		case "bulkDelete":
			$id = $_REQUEST['idArray'];
			$allid = explode("|", $id);
			$return = "0";
			$db->begin();
			for($i=1; $i<count($allid); $i++){
						$db->query("DELETE FROM tbl_package_sub WHERE type='".$allid[$i]."'");
				$res  = $db->query("DELETE FROM tbl_package WHERE id='".$allid[$i]."'");
				$return = 1;
			}
			if($res)$db->commit();else $db->rollback();
			reOrder("tbl_package", "sortorder");
			
			if($return==1):
			    $message  = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Package"); 
				echo json_encode(array("action"=>"success","message"=>$message));
			else:
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['noRecords']));
			endif;
		break;
				
		case "sort":
			$id 	 = $_REQUEST['id']; 	// IS a line containing ids starting with : sortIds
			$sortIds = $_REQUEST['sortIds'];
			datatableReordering('tbl_package', $sortIds, "sortorder", '', '',1);
			$message  = sprintf($GLOBALS['basic']['sorted_'], "Package "); 
			echo json_encode(array("action"=>"success","message"=>$message));
		break;				

		/*********************** Sub Package Transaction Section *************************/
		case "addSubpackage":
			$record	= new Subpackage();

			$newArr = array();
			$fparent = (isset($_REQUEST['fparent']) and !empty($_REQUEST['fparent']))?$_REQUEST['fparent']:'';
			$feature = (isset($_REQUEST['feature']) and !empty($_REQUEST['feature']))?$_REQUEST['feature']:'';
			if(!empty($fparent) and !empty($feature)){				
				foreach($fparent as $kk=>$vv){ 
					$final_fpt = !empty($fparent[$kk])?$fparent[$kk]:'';
					$final_ft  = !empty($feature[$kk])?$feature[$kk]:'';
					$newArr[$kk] = array($final_fpt,$final_ft); 
				}
			}

			$record->type 			= $_REQUEST['type'];
			// $record->short_note   	= $_REQUEST['short_note'];
			$record->detail   		= $_REQUEST['detail'];	
			$record->slug 			= create_slug($_REQUEST['title']);
			$record->title 			= $_REQUEST['title'];
			$record->image2			= $_REQUEST['imageArrayname2'];
			$record->image 			= serialize(array_values(array_filter($_REQUEST['imageArrayname'])));
			$record->feature		= serialize($newArr);			
			$record->content 		= $_REQUEST['content'];
			$record->status			= $_REQUEST['status'];
			$record->meta_title		= $_REQUEST['meta_title'];
			$record->meta_keywords		= $_REQUEST['meta_keywords'];
			$record->meta_description	= $_REQUEST['meta_description'];
			$record->sortorder		= Subpackage::find_maximum_byparent("sortorder",$_REQUEST['type']);														
			$record->added_date 	= registered();

			$record->currency 		= $_REQUEST['currency'];
			$record->number_room       = $_REQUEST['number_room'];
			$record->people_qnty 	= $_REQUEST['people_qnty'];

			$pkg = Package::find_by_id($record->type);
            if($pkg->type==1):							
				$pricehed	= !empty($_REQUEST['room_price'])?$_REQUEST['room_price']:"";
				foreach($pricehed as $k=>$v){	
					$record->onep_price	= $v[0];
					$record->twop_price	= $v[1];
					$record->threep_price = $v[2];
				}	
			endif;

			$checkDupliTitle = Subpackage::checkDupliTitle($record->title);			
			if($checkDupliTitle):
				echo json_encode(array("action"=>"warning","message"=>"Subpackage Title Already Exists."));		
				exit;		
			endif;

			$db->begin();
			if($record->save()): $db->commit();
				$message  = sprintf($GLOBALS['basic']['addedSuccess_'], "Sub Package '".$record->title."'");
				echo json_encode(array("action"=>"success","message"=>$message));
				log_action($message,1,3);
			else: 
				$db->rollback(); echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['unableToSave']));
			endif;							
		break;

		case "editSubpackage":
			$record = Subpackage::find_by_id($_REQUEST['idValue']);

			if($record->title!=$_REQUEST['title']){
				$checkDupliTitle = Subpackage::checkDupliTitle($_REQUEST['title']);
				if($checkDupliTitle):
					echo json_encode(array("action"=>"warning","message"=>"Subpackage Title is already exist."));		
					exit;		
				endif;
			}
			
			$newArr = array();
			$fparent = (isset($_REQUEST['fparent']) and !empty($_REQUEST['fparent']))?$_REQUEST['fparent']:'';
			$feature = (isset($_REQUEST['feature']) and !empty($_REQUEST['feature']))?$_REQUEST['feature']:'';
			if(!empty($fparent) and !empty($feature)){				
				foreach($fparent as $kk=>$vv){ 
					$final_fpt = !empty($fparent[$kk])?$fparent[$kk]:'';
					$final_ft  = !empty($feature[$kk])?$feature[$kk]:'';
					$newArr[$kk] = array($final_fpt,$final_ft); 
				}
			}

			$record->type 			= $_REQUEST['type'];
			$record->slug 			= create_slug($_REQUEST['title']);
			$record->title 			= $_REQUEST['title'];
			// $record->short_note   	= $_REQUEST['short_note'];
			$record->detail   		= $_REQUEST['detail'];
			$record->image2			= $_REQUEST['imageArrayname2'];
			$record->image 			= serialize(array_values(array_filter($_REQUEST['imageArrayname'])));
			$record->feature		= serialize($newArr);
			$pkg = Package::find_by_id($record->type);
            if($pkg->type==1):							
				$pricehed	= !empty($_REQUEST['room_price'])?$_REQUEST['room_price']:"";
				foreach($pricehed as $k=>$v){	
					$record->onep_price	= $v[0];
					$record->twop_price	= $v[1];
					$record->threep_price = $v[2];
				}	
			endif;
			$record->people_qnty 	= $_REQUEST['people_qnty'];
			$record->currency 		= $_REQUEST['currency'];
			$record->content 		= $_REQUEST['content'];
			$record->status			= $_REQUEST['status'];
			$record->number_room       = $_REQUEST['number_room'];
			$record->meta_title		= $_REQUEST['meta_title'];
			$record->meta_keywords		= $_REQUEST['meta_keywords'];
			$record->meta_description	= $_REQUEST['meta_description'];
			
			$db->begin();
			if($record->save()):$db->commit();
			   $message  = sprintf($GLOBALS['basic']['changesSaved_'], "Sub Package '".$record->title."'");
			   echo json_encode(array("action"=>"success","message"=>$message));
			   log_action($message,1,4);
			else: $db->rollback();echo json_encode(array("action"=>"notice","message"=>$GLOBALS['basic']['noChanges']));
			endif;	
		break;

		case "deletesubpackage":
			$id = $_REQUEST['id'];
			$record = Subpackage::find_by_id($id);
			log_action("Sub Package [".$record->title."]".$GLOBALS['basic']['deletedSuccess'],1,6);
			$db->begin();
			$res = $db->query("DELETE FROM tbl_package_sub WHERE id='{$id}'");
  		    if($res):$db->commit();	else: $db->rollback();endif;
			reOrder("tbl_package_sub", "sortorder");						
			echo json_encode(array("action"=>"success","message"=>"Sub Package [".$record->title."]".$GLOBALS['basic']['deletedSuccess']));							
		break;

		case "SubtoggleStatus":
			$id = $_REQUEST['id'];
			$record = Subpackage::find_by_id($id);
			$record->status = ($record->status == 1) ? 0 : 1 ;
			$db->begin();						
				$res   =  $record->save();
				if($res):$db->commit();	else: $db->rollback();endif;
			echo "";
		break;

		case "subbulkToggleStatus":
			$id = $_REQUEST['idArray'];
			$allid = explode("|", $id);
			$return = "0";
			for($i=1; $i<count($allid); $i++){
				$record = Subpackage::find_by_id($allid[$i]);
				$record->status = ($record->status == 1) ? 0 : 1 ;
				$record->save();
			}
			echo "";
		break;
			
		case "subbulkDelete":
			$id = $_REQUEST['idArray'];
			$allid = explode("|", $id);
			$return = "0";
			$db->begin();
			for($i=1; $i<count($allid); $i++){
				$record = Subpackage::find_by_id($allid[$i]);
				$res  = $db->query("DELETE FROM tbl_package_sub WHERE id='".$allid[$i]."'");				
				reOrderSub("tbl_package_sub", "sortorder", "type",$record->type);

				$return = 1;
			}
			if($res)$db->commit();else $db->rollback();

			if($return==1):
			    $message  = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Package"); 
				echo json_encode(array("action"=>"success","message"=>$message));
			else:
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['noRecords']));
			endif;
		break;

		case "subSort":
			$id 	 = $_REQUEST['id']; 	// IS a line containing ids starting with : sortIds
			$sortIds = $_REQUEST['sortIds'];
			$posId   = Subpackage::field_by_id($id,'type');
			datatableReordering('tbl_package_sub', $sortIds, "sortorder", "type",$posId,1);
			$message  = sprintf($GLOBALS['basic']['sorted_'], "Sub Package"); 
			echo json_encode(array("action"=>"success","message"=>$message));
		break;	

		case "getRoomsdetails":
			$result='';
			$getdate = addslashes($_REQUEST['getdate']);
			$roomCat  = Subpackage::getPackage_limit(1);
	    	if($roomCat):
	    		foreach($roomCat as $roomRow){ 
	    			$rec = Subpackage::find_by_id($roomRow->id); 
	    			$nos = json_decode($rec->image, true);
	    			global $db;
	    			$sql = "SELECT ss.season,ss.date_from, ss.date_to, rp.one_person, rp.two_person, rp.three_person
	    					FROM 
	    					tbl_seasion AS ss
	    					INNER JOIN tbl_room_price AS rp
	    					ON ss.id = rp.season_id
	    					WHERE ss.date_to>='$getdate' LIMIT 1";
	    			$dtResult = $db->query($sql);

	    			$sql2 = "SELECT rp.one_person, rp.two_person, rp.three_person
	    			 		FROM 
	    			 		tbl_room_price AS rp
	    			 		WHERE rp.season_id='0' AND rp.room_id= $rec->id LIMIT 1";
	    			$dfltResult = $db->query($sql2);
	    				
	    			$myArr='';
	    			if($db->num_rows($dtResult)>0){
	    				$myArr = $dtResult;
	    			}else{
	    				$myArr = $dfltResult;
	    			}

	    			$romprice = array();
	    			while ($row = $db->fetch_array($myArr)) {
	    				foreach($row as $key=>$val){$$key=$val;}
	    				$romprice = array(1=>$one_person,2=>$two_person,3=>$three_person);
	    			}
	    	  $result.='<div class="main_imgdiv">
	    					<img alt="'.$rec->title.'" src="'.IMAGE_PATH.'subpackage/'.$nos[0].'">
	    				</div>
	    				<div class="main_listing">';
	    				for($i=1; $i<=$rec->people_qnty; $i++){ 
					$result.='<ul>
							 	<li>'.$i.'</li>
							 	<li>'.$rec->currency.' '.$romprice[$i].'</li>
							 	<li>
								 	<select name="" id="" class="select-room" data-person="'.$i.'" data-currency="'.$rec->currency.'" data-price="'.$romprice[$i].'"
                                    data-room="'.$rec->title.'">
								 		<option value="0">0</option>';
				    					 for($j=1; $j<=$rec->number_room; $j++){
				    						$result.='<option value="'.$j.'">'.$j.'</option>';
				    					} 
						  $result.='</select>
							 	</li>
							 	<li><span class="ind-total">0</span></li>
							</ul>
							<div class="clear"></div>';
						 } 								
				$result.='</div>
						<div class="clear"></div>';
    	  		 } 
			endif;

			echo json_encode(array("roomresult"=>$result));
		break;
	}
?>