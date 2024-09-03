<?php
$result='';

$menuRec = Menu::getMenuByParent(0,1);

$current_url = $_SERVER["REQUEST_URI"];
$data = explode('/',$current_url);

if($menuRec):
$result.='<ul class="main-menu pull-right">'; 	
	foreach($menuRec as $menuRow):	
		$linkActive=$PlinkActive='';
		if($data[1]):	
			$linkActive = ($menuRow->linksrc==$data['1'])?" current":"";
			$parentInfo	= Menu::find_by_linksrc($data['1']);
			if($parentInfo):
				$PlinkActive = ($menuRow->id==$parentInfo->parentOf)?" current":"";
			endif;
		endif;

		$menusubRec = Menu::getMenuByParent($menuRow->id,1);	
		$subclass = ($menusubRec)?' class="has-sub-menu"':'';
		$result.='
		<li '.$subclass.' >';
		$result.= getMenuList($menuRow->name, $menuRow->linksrc, $menuRow->linktype, $linkActive.$PlinkActive);
			/* Second Level Menu */
			if($menusubRec):		
			$result.= '
			<ul>';	
			foreach($menusubRec as $menusubRow): 
			   $menusub2Rec = Menu::getMenuByParent($menusubRow->id,1);	
			   $chkparent2 = (!empty($menusub2Rec))?1:0;
			   $result.='<li id="menu-item-'.$menusubRow->id.'">';
			   $result.= getMenuList($menusubRow->name, $menusubRow->linksrc, $menusubRow->linktype,$chkparent2);
			   		/* Third Level Menu */
			   		if($menusub2Rec):
			   			$result.='<ul class="dropdown-menu">';
			   			foreach ($menusub2Rec as $menusub2Row):
			   				$menusub3Rec = Menu::getMenuByParent($menusub2Row->id,1);	
			   				$chkparent3 = (!empty($menusub3Rec))?1:0;
			   				$result.='
							<li id="menu-item-'.$menusub2Row->id.'">';
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

//Footer Menu
$result1='';
$FmenuRec = Menu::getMenuByParent(0,5);
if($FmenuRec):
$result1.='<ul class="footer1">';
	foreach($FmenuRec as $FmenuRow):
	   $result1.='<li class="grid_3 gridfooter">';
	   $result1.= getMenuList($FmenuRow->name, $FmenuRow->linksrc, $FmenuRow->linktype,'parent');
		   $subRec = Menu::getMenuByParent($FmenuRow->id,5);	
		   if($subRec):
			   $result1.='<ul>';
				foreach($subRec as $subRow):
					$result1.='<li>';
	   					$result1.= getMenuList($subRow->name, $subRow->linksrc, $subRow->linktype,'child');
	   				$result1.='</li>';
				endforeach;
			   $result1.='</ul>';
		   endif;
	   $result1.='</li>';
   	endforeach;
$result1.='</ul>';
endif;
$jVars['module:bottom_menu']= $result1;
?>