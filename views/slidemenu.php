<?php
$result='';

$menuRec = Menu::getMenuByParent(0,1);
if($menuRec):
$result.='<ul id="mega_main_menu_ul" class="mega_main_menu_ul">'; 	
	foreach($menuRec as $menuRow):		
		$menusubRec = Menu::getMenuByParent($menuRow->id,1);			
		$result.='<li id="menu-item-'.$menuRow->id.'" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor menu-item-has-children menu-item-194 multicolumn_dropdown default_style drop_to_right  submenu_default_width columns2">';
		$result.= getMenuList($menuRow->name, $menuRow->linksrc, $menuRow->linktype,'item_link  with_icon');
			/* Second Level Menu */
			if($menusubRec):		
			$result.= '<ul class="mega_dropdown secondlevel">';	
			foreach($menusubRec as $menusubRow):
			   $menusub2Rec = Menu::getMenuByParent($menusubRow->id,1);	
			   $chkparent2 = (!empty($menusub2Rec))?1:0;
			   $result.='<li id="menu-item-'.$menusubRow->id.'" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-195  default_style   submenu_default_width columns" style="width:50%;">';
			   $result.= getMenuList($menusubRow->name, $menusubRow->linksrc, $menusubRow->linktype,$chkparent2);
			   		/* Third Level Menu */
			   		if($menusub2Rec):
			   			$result.='<ul class="mega_dropdown thirdlevel">';
			   			foreach ($menusub2Rec as $menusub2Row):
			   				$menusub3Rec = Menu::getMenuByParent($menusub2Row->id,1);	
			   				$chkparent3 = (!empty($menusub3Rec))?1:0;
			   				$result.='<li id="menu-item-'.$menusub2Row->id.'" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-195  default_style   submenu_default_width columns" style="width:50%;">';
			   				$result.= getMenuList($menusub2Row->name, $menusub2Row->linksrc, $menusub2Row->linktype,$chkparent3);
			   					/* Fourth Level Menu */
			   					if($menusub3Rec):
			   						$result.='<ul class="mega_dropdown">';
			   						foreach($menusub3Rec as $menusub3Row):
			   							$menusub4Rec = Menu::getMenuByParent($menusub3Row->id,1);
			   							$chkparent4 = (!empty($menusub4Rec))?1:0;
			   							$result.='<li id="menu-item-'.$menusub2Row->id.'" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-195  default_style   submenu_default_width columns" style="width:50%;">';
			   							$result.= getMenuList($menusub3Row->name, $menusub3Row->linksrc, $menusub3Row->linktype,$chkparent4);
			   								/* Fifth Level Menu */
			   								if($menusub4Rec):
			   									$result.='<ul class="mega_dropdown">';
			   									foreach($menusub4Rec as $menusub4Row):
			   										$menusub5Rec = Menu::getMenuByParent($menusub4Row->id,1);
			   										$chkparent5 = (!empty($menusub4Rec))?1:0;
			   										$result.='<li>'.getMenuList($menusub4Row->name, $menusub4Row->linksrc, $menusub4Row->linktype,$chkparent5).'</li>';
			   									endforeach;
			   									$result.='</ul>';
			   								endif;
			   							$result.='</li>';
			   						endforeach;			   							
			   						$result.='</ul>';
			   					endif;
			   				$result.='</li>';
			   			endforeach;
			   			$result.='</ul>';
			   	    endif;
			   	$result.='</li>';    
			endforeach;
			$result.='</ul>';
			endif;
		$result.='</li>';
	endforeach;
$result.='</ul>';
endif;			

$jVars['module:menu']= $result;


$result1='';
$FmenuRec = Menu::getMenuByParent(0,5);
if($FmenuRec):
$result1.='<ul>';
	foreach($FmenuRec as $FmenuRow):
	   $result1.='<li>';
	   $result1.= getMenuList($FmenuRow->name, $FmenuRow->linksrc, $FmenuRow->linktype,'');
	   $result1.='</li>';
   	endforeach;
$result1.='</ul>';
endif;
$jVars['module:bottom_menu']= $result1;

//For Responsive Menu
$resultRes='';

$resmenuRec = Menu::getMenuByParent(0,1);
if($resmenuRec):
$resultRes.='<ul id="menu-mobile-menu" class="">';
	foreach($resmenuRec as $resmenuRow):
		$resmenusubRec = Menu::getMenuByParent($resmenuRow->id,1);	
		$checkParent = !empty($resmenusubRec)?' menu-item-has-children ':'';
		$resultRes.='<li id="menu-item-'.$resmenuRow->id.'" class="menu-item menu-item-type-custom menu-item-object-custom '.$checkParent.' menu-item-'.$resmenuRow->id.' bgnav">';
			$resultRes.= getResMenuList($resmenuRow->name, $resmenuRow->linksrc, $resmenuRow->linktype);
		$resultRes.='</li>';

		// 1st child 
		if($resmenusubRec):
			foreach($resmenusubRec as $resmenuRow2):
				$resmenusubRec2 = Menu::getMenuByParent($resmenuRow2->id,1);
				$checkParent2 = !empty($resmenusubRec2)?' menu-item-has-children ':'';
				$resultRes.='<li id="menu-item-'.$resmenuRow2->id.'" class="menu-item menu-item-type-custom menu-item-object-custom '.$checkParent2.' menu-item-'.$resmenuRow2->id.' bgnav">';
					$resultRes.= getResMenuList($resmenuRow2->name, $resmenuRow2->linksrc, $resmenuRow2->linktype,'','&nbsp;&nbsp;— &nbsp;&nbsp;');
				$resultRes.='</li>';

				// 2nd child
				if($resmenusubRec2):
					foreach($resmenusubRec2 as $resmenuRow3):
						$resmenusubRec3 = Menu::getMenuByParent($resmenuRow3->id,1);
						$checkParent3 = !empty($resmenusubRec3)?' menu-item-has-children ':'';
						$resultRes.='<li id="menu-item-'.$resmenuRow3->id.'" class="menu-item menu-item-type-custom menu-item-object-custom '.$checkParent3.' menu-item-'.$resmenuRow3->id.' bgnav">';
							$resultRes.= getResMenuList($resmenuRow3->name, $resmenuRow3->linksrc, $resmenuRow3->linktype,'','&nbsp;&nbsp;&nbsp;&nbsp;— &nbsp;&nbsp;&nbsp;&nbsp;');
						$resultRes.='</li>';
					endforeach;
				endif;
			endforeach;
		endif;
	endforeach;
$resultRes.='</ul>';
endif;

$jVars['module:responsivemenu']= $resultRes;
?>
