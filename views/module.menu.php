<?php
// Top menu
$resTop='';
$TmenuRec = Menu::getMenuByParent(0, 1);
if($TmenuRec):
$resTop.='<ul class="serif">';
	foreach($TmenuRec as $TmenuRow):
		$resTop.='<li>';
			$resTop.= getMenuList($TmenuRow->name, $TmenuRow->linksrc, $TmenuRow->linktype);		   
		$resTop.='</li>';
   	endforeach;
$resTop.='</ul>';
endif;
$jVars['module:top_menu']= $resTop;


$resMain='';

$menuRec = Menu::getMenuByParent(0, 2);

$current_url = $_SERVER["REQUEST_URI"];
$data = explode('/',$current_url);

if($menuRec):
$resMain.='<ul>'; 	
	foreach($menuRec as $menuRow):	
		$linkActive=$PlinkActive='';
		if($data[1]):	
			$linkActive = ($menuRow->linksrc==$data['1'])?" current":"";
			$parentInfo	= Menu::find_by_linksrc($data['1']);
			if($parentInfo):
				$PlinkActive = ($menuRow->id==$parentInfo->parentOf)?" current":"";
			endif;
		endif;

		$menusubRec = Menu::getMenuByParent($menuRow->id, 2);	
		$resMain.='<li class="'.$linkActive.$PlinkActive.'">';
		$resMain.= getMenuList($menuRow->name, $menuRow->linksrc, $menuRow->linktype, $linkActive.$PlinkActive);
			/* Second Level Menu */
			if($menusubRec):		
			$resMain.= '<ul>';	
			foreach($menusubRec as $menusubRow): 
			   $menusub2Rec = Menu::getMenuByParent($menusubRow->id, 2);	
			   $chkparent2 = (!empty($menusub2Rec))?1:0;
			   $resMain.='<li>';
			   $resMain.= getMenuList($menusubRow->name, $menusubRow->linksrc, $menusubRow->linktype,$chkparent2);
			   		/* Third Level Menu */
			   		if($menusub2Rec):
			   			$resMain.='<ul>';
			   			foreach ($menusub2Rec as $menusub2Row):
			   				$menusub3Rec = Menu::getMenuByParent($menusub2Row->id, 2);	
			   				$chkparent3 = (!empty($menusub3Rec))?1:0;
			   				$resMain.='<li>';
			   				$resMain.= getMenuList($menusub2Row->name, $menusub2Row->linksrc, $menusub2Row->linktype,$chkparent3);
			   					/* Fourth Level Menu */
			   					if($menusub3Rec):
			   						$resMain.='<ul>';
			   						foreach($menusub3Rec as $menusub3Row):
			   							$menusub4Rec = Menu::getMenuByParent($menusub3Row->id, 2);
			   							$chkparent4 = (!empty($menusub4Rec))?1:0;
			   							$resMain.='<li>';
			   							$resMain.= getMenuList($menusub3Row->name, $menusub3Row->linksrc, $menusub3Row->linktype,$chkparent4);
			   								/* Fifth Level Menu */
			   								if($menusub4Rec):
			   									$resMain.='<ul>';
			   									foreach($menusub4Rec as $menusub4Row):
			   										$menusub5Rec = Menu::getMenuByParent($menusub4Row->id, 2);
			   										$chkparent5 = (!empty($menusub4Rec))?1:0;
			   										$resMain.='<li>'.getMenuList($menusub4Row->name, $menusub4Row->linksrc, $menusub4Row->linktype,$chkparent5).'</li>';
			   									endforeach;
			   									$resMain.='</ul>';
			   								endif;
			   							$resMain.='</li>';
			   						endforeach;			   							
			   						$resMain.='</ul>';
			   					endif;
			   				$resMain.='</li>';
			   			endforeach;
			   			$resMain.='</ul>';
			   	    endif;
			   	$resMain.='</li>';    
			endforeach;
			$resMain.='</ul>';
			endif;
		$resMain.='</li>';
	endforeach;
$resMain.='</ul>';
endif;			

$jVars['module:main_menu']= $resMain;

//Footer Menu
$resFooter='';
$FmenuRec = Menu::getMenuByParent(0, 3);

if($FmenuRec) {

$resFooter.='<div class="section  notopmargin nobottommargin notopborder btmpd bgcolor-grey-dark dark">
	<div class="container">
    	<div class="boxedcontainer mini-links">';
    	$j=1;
		foreach($FmenuRec as $FmenuRow) {
			$resFooter.='<div class="col_one_fourth">
            	<h6>'.getMenuList($FmenuRow->name, $FmenuRow->linksrc, $FmenuRow->linktype).'</h6>
            </div>';

            $subRec = Menu::getMenuByParent($FmenuRow->id, 3);	
		   	if($subRec) {
		   		$i=1;
		   		foreach($subRec as $subRow) {
		   			$last_row = ($i++%3==0)?'col_last':'';
		   			$resFooter.='<div class="col_one_fourth '.$last_row.'">
		            	<h6>'.getMenuList($subRow->name, $subRow->linksrc, $subRow->linktype).'</h6>';
		            	$sub2Rec = Menu::getMenuByParent($subRow->id, 3);	
		            	if($sub2Rec) {
			                $resFooter.='<ul>';
			                foreach($sub2Rec as $sub2Row) {
				                $resFooter.='<li>'.getMenuList($sub2Row->name, $sub2Row->linksrc, $sub2Row->linktype).'</li>';
				            }
			                $resFooter.='</ul>';
			            }
		            $resFooter.='</div>';
		   		}
		   	}
		   	if($j++<=(count($FmenuRec)-1)) { $resFooter.='<div class="divider"></div>'; }
		}
		$resFooter.='</div>
	</div>
</div>';
}

$jVars['module:bottom_menu']= $resFooter;
?>