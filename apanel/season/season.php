<?php
$moduleTablename  = "tbl_season"; // Database table name
$moduleId 		  = 24;				// module id >>>>> tbl_modules
$moduleFoldername = "season";		// Image folder name
	
if(isset($_GET['page']) && $_GET['page'] == "season" && isset($_GET['mode']) && $_GET['mode']=="list"):       
?>
<h3>
List Season
<a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="AddNewSeason();">
    <span class="glyph-icon icon-separator">
        <i class="glyph-icon icon-plus-square"></i>
    </span>
    <span class="button-content"> Add New </span>
</a>
</h3>
<div class="my-msg"></div>
<div class="example-box">
    <div class="example-code">    
    <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
        <thead>
            <tr>
               <th class="text-center">S.No.</th>
               <th>Title</th> 
               <th>start Date</th>
               <th>End Date</th>
               <th class="text-center"><?php echo $GLOBALS['basic']['action'];?></th>
            </tr>
        </thead> 
            
        <tbody>
            <?php $records = Season::find_by_sql("SELECT * FROM ".$moduleTablename." ORDER BY sortorder ASC "); 
                  foreach($records as $record): ?>    
            <tr id="<?php echo $record->id;?>">
                <td class="text-center"><?php echo $record->sortorder;?></td>                
                <td>
                    <div class="col-md-1">                                                                                    
                        <a href="javascript:void(0);" onClick="editRecord(<?php echo $record->id;?>);" class="loadingbar-demo" title="<?php echo $record->season;?>">
                            <?php echo $record->season;?>
                        </a>
                    </div> 
                </td>    
                <td class="text-center"><?php echo date('M d, Y', strtotime($record->date_from));?></td>
                <td class="text-center"><?php echo date('M d, Y', strtotime($record->date_to));?></td>
                <td class="text-center">
                    <?php   
                        $statusImage = ($record->status == 1) ? "bg-green" : "bg-red" ; 
                        $statusText = ($record->status == 1) ? $GLOBALS['basic']['clickUnpub'] : $GLOBALS['basic']['clickPub'] ;                        
                    ?>                                             
                    <a href="javascript:void(0);" class="btn small <?php echo $statusImage;?> tooltip-button statusToggler" data-placement="top" title="<?php echo $statusText;?>" status="<?php echo $record->status;?>" id="imgHolder_<?php echo $record->id;?>" moduleId="<?php echo $record->id;?>">
                        <i class="glyph-icon icon-flag"></i>
                    </a>
                    <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button" data-placement="top" title="Edit" onclick="editRecord(<?php echo $record->id;?>);">
                        <i class="glyph-icon icon-edit"></i>
                    </a>
                    <a href="javascript:void(0);" class="btn small bg-red tooltip-button" data-placement="top" title="Remove" onclick="recordDelete(<?php echo $record->id;?>);">
                        <i class="glyph-icon icon-remove"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>

<?php elseif(isset($_GET['mode']) && $_GET['mode'] == "addEdit"): 
if(isset($_GET['id']) && !empty($_GET['id'])):
    $seasonId    = addslashes($_REQUEST['id']);
    $seasonInfo  = Season::find_by_id($seasonId);
    $status      = ($seasonInfo->status==1)?"checked":" ";
    $unstatus    = ($seasonInfo->status==0)?"checked":" ";
endif;  
?>

<h3>
    <?php echo (isset($_GET['id']))?'Edit Season Link':'Add Season Link';?>
    <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);" onClick="viewSeasonlist();">
        <span class="glyph-icon icon-separator">
            <i class="glyph-icon icon-arrow-circle-left"></i>
        </span>
        <span class="button-content"> Back </span>
    </a>
</h3>
<div class="my-msg"></div>
<div class="example-box">
    <div class="example-code">
        <form action="" class="col-md-10 center-margin" id="season_frm">
            
            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Title :
                    </label>
                </div>                
                <div class="form-input col-md-20">
                    <input placeholder="Season Title" class="col-md-4 validate[required,length[0,200]]" type="text" name="season" id="season" value="<?php echo !empty($seasonInfo->season)?$seasonInfo->season:"";?>">
                </div>                
            </div>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Start Date :
                    </label>
                </div>                
                <div class="form-input col-md-20">
                    <input placeholder="Start Date" class="col-md-4 validate[required]" type="text" name="date_from" id="date_from" value="<?php echo !empty($seasonInfo->date_from)?$seasonInfo->date_from:"";?>">
                </div>                
            </div>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        End Date :
                    </label>
                </div>                
                <div class="form-input col-md-20">
                    <input placeholder="End Date" class="col-md-4 validate[required]" type="text" name="date_to" id="date_to" value="<?php echo !empty($seasonInfo->date_to)?$seasonInfo->date_to:"";?>">
                </div>                
            </div>


            <div class="form-row">   
                <div class="form-label col-md-2">
                    <label for="">
                        Published :
                    </label>
                </div>             
                <div class="form-checkbox-radio col-md-9">
                    <input type="radio" class="custom-radio" name="status" id="check1" value="1" <?php echo !empty($status)?$status:"checked";?>>
                    <label for="">Published</label>
                    <input type="radio" class="custom-radio" name="status" id="check0" value="0" <?php echo !empty($unstatus)?$unstatus:"";?>>
                    <label for="">Un-Published</label>
                </div>                
            </div> 

            <button type="submit" name="submit" class="btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4" id="btn-submit" title="Save">
                <span class="button-content">
                    Save
                </span>
            </button>

            <input type="hidden" name="idValue" id="idValue" value="<?php echo !empty($seasonInfo)?$seasonInfo->id:0;?>" />
        </form>
    </div>
</div>    
<?php endif; ?>