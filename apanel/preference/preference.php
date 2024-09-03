<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css" />
<?php
$moduleTablename  = "tbl_configs"; // Database table name
$moduleId 		  = 13;				// module id >>>>> tbl_modules
$moduleFoldername = "";		// Image folder name

?>
<h3>Preference Management</h3>
<?php $PrefeRow   = Config::find_by_id(1); ?>
<div class="my-msg"></div>
<div class="example-box">
    <div class="example-code">
    	<form action="" class="col-md-12 center-margin" id="Preference_frm">
        	<div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Site Title :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <input placeholder="Site Title" class="col-md-6 validate[required,length[0,200]]" type="text" name="sitetitle" id="sitetitle" value="<?php echo !empty($PrefeRow->sitetitle)?$PrefeRow->sitetitle:"";?>">
                </div>                
            </div>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Site Name :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <input placeholder="Site Name" class="col-md-6 validate[required,length[0,200]]" type="text" name="sitename" id="sitename" value="<?php echo !empty($PrefeRow->sitename)?$PrefeRow->sitename:"";?>">
                </div>                
            </div>

            <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Copyright :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <input placeholder="&#0169; Copyright <?php echo date('Y');?> by Longtail-e-media - All Rights Reserved" class="col-md-6" type="text" name="copyright" id="copyright" value="<?php echo !empty($PrefeRow->copyright)?$PrefeRow->copyright:"&#0169; Copyright ".date('Y')." by Longtail-e-media - All Rights Reserved";?>">
                    <br /><label><small>Copy this red code for copyright year dynamic <span style="color:red;">{year}</span></small></label>
                </div>                
            </div>

            <div class="form-row">
            	<div class="form-label col-md-2">
                    <label for="">
                       Icon Image :
                    </label>
                </div> 
                
                <?php if(!empty($PrefeRow->icon_upload)):?>
                <div class="col-md-1" id="removeSavedimg1">
                    <div class="infobox info-bg">                            	                                
                        <div class="button-group" data-toggle="buttons">
                            <span class="float-left">
                                <?php 
                                    if(file_exists(SITE_ROOT."images/preference/".$PrefeRow->icon_upload)):
                                        $filesize = filesize(SITE_ROOT."images/preference/".$PrefeRow->icon_upload);
                                        echo 'Size : '.getFileFormattedSize($filesize);
                                    endif;
                                ?>
                            </span> 
                            <a class="btn small float-right" href="javascript:void(0);" onclick="deleteSavedPreferenceimage(1);">
                                <i class="glyph-icon icon-trash-o"></i>
                            </a>                                                       
                        </div>
                        <img src="<?php echo IMAGE_PATH.'preference/thumbnails/'.$PrefeRow->icon_upload;?>"  style="width:100%"/>                                                                                   
                    </div> 
                </div>
                <?php endif;?>
                <div class="form-input col-md-10 uploader1 <?php echo !empty($PrefeRow->icon_upload)?"hide":"";?>">          
                   <input type="file" name="icon_upload" id="icon_upload" class="transparent no-shadow">
                   <label><small>Image Dimensions (<?php echo Module::get_properties($moduleId,'imgwidth');?> px X <?php echo Module::get_properties($moduleId,'imgheight');?> px)</small></label>
                </div>                
                <!-- Upload user image preview -->
            	<div id="preview_Image"><input type="hidden" name="imageArrayname" value="" class="" /></div>
            </div>
            
            <div class="form-row">
            	<div class="form-label col-md-2">
                    <label for="">
                       Logo Image :
                    </label>
                </div> 
                
                <?php if(!empty($PrefeRow->logo_upload)):?>
                <div class="col-md-2" id="removeSavedimg2">
                    <div class="infobox info-bg">                            	                                
                        <div class="button-group" data-toggle="buttons">
                            <span class="float-left">
                                <?php 
                                    if(file_exists(SITE_ROOT."images/preference/".$PrefeRow->logo_upload)):
                                        $filesize = filesize(SITE_ROOT."images/preference/".$PrefeRow->logo_upload);
                                        echo 'Size : '.getFileFormattedSize($filesize);
                                    endif;
                                ?>
                            </span> 
                            <a class="btn small float-right" href="javascript:void(0);" onclick="deleteSavedPreferenceimage(2);">
                                <i class="glyph-icon icon-trash-o"></i>
                            </a>                                                       
                        </div>
                        <img src="<?php echo IMAGE_PATH.'preference/thumbnails/'.$PrefeRow->logo_upload;?>"  style="width:100%"/>                                                                                   
                    </div> 
                </div>
                <?php endif;?>
                <div class="form-input col-md-10 uploader2 <?php echo !empty($PrefeRow->logo_upload)?"hide":"";?>">          
                   <input type="file" name="logo_upload" id="logo_upload" class="transparent no-shadow">
                   <label><small>Image Dimensions (<?php echo Module::get_properties($moduleId,'simgwidth');?> px X <?php echo Module::get_properties($moduleId,'simgheight');?> px)</small></label>
                </div>                
                <!-- Upload user image preview -->
            	<div id="preview_Image2"><input type="hidden" name="imageArrayname2" value="" class="" /></div>
            </div>

            <div class="form-row">
                <div class="form-label col-md-12">
                    <label for="">
                        Google Analytics Code :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <textarea placeholder="Google Analytics Code" name="google_anlytics" id="google_anlytics" class=""><?php echo !empty($PrefeRow->google_anlytics)?$PrefeRow->google_anlytics:"";?></textarea>
                </div>                
            </div>
            <div class="form-row">
                <div class="form-label col-md-12">
                    <label for="">
                        Schema.org Code :
                    </label>
                </div>                
                <div class="form-input col-md-6">
                    <textarea placeholder="Schema.org Code" name="schema_code" id="schema_code" class=""><?php echo !empty($PrefeRow->schema_code)?$PrefeRow->schema_code:"";?></textarea>
                </div>                
            </div>

            <!-- <div class="form-row">
                <div class="form-label col-md-12">
                    <label for="">
                        Home Popup Content :
                    </label>                          
                    <textarea name="headers" id="headers" class="large-textarea"><?php // echo !empty($PrefeRow->headers)?$PrefeRow->headers:"";?></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-label col-md-12">
                    <label for="">
                        Hotel Promote Content :
                    </label>                        
                    <textarea name="footer" id="footer" class="large-textarea"><?php // echo !empty($PrefeRow->footer)?$PrefeRow->footer:"";?></textarea>
                </div>
            </div> -->


           <!-- Meta Tags-->
            <div class="form-row">              
                <div class="form-checkbox-radio col-md-9">
                	<a class="btn medium bg-blue" href="javascript:void(0);" onClick="toggleMetadata();">
                        <span class="glyph-icon icon-separator float-right">
                        	<i class="glyph-icon icon-caret-down"></i>
                        </span>
                        <span class="button-content"> Metadata Info </span>
                    </a>
                </div>                
            </div>  
            <div class="form-row <?php echo (!empty($PrefeRow->site_keywords) || !empty($PrefeRow->site_description))?'':'hide';?> metadata">              
                <div class="col-md-6 form-input">
                    <input type="text" placeholder="Meta Title" name="meta_title" id="meta_title" class="" value="<?php echo !empty($PrefeRow->meta_title)?$PrefeRow->meta_title:"";?>">                    
                </div>  <div class="clear"></div><br />
            	<div class="col-md-6 form-input">
                	<textarea placeholder="Meta Keyword" name="site_keywords" id="site_keywords" class="character-keyword validate[required]"><?php echo !empty($PrefeRow->site_keywords)?$PrefeRow->site_keywords:"";?></textarea>
                    <div class="keyword-remaining clear input-description">250 characters left</div>
                </div>  
                <div class="col-md-6 form-input">
                	<textarea placeholder="Meta Description" name="site_description" id="site_description" class="character-description validate[required]"><?php echo !empty($PrefeRow->site_description)?$PrefeRow->site_description:"";?></textarea>
                    <div class="description-remaining clear input-description">160 characters left</div>
                </div>                
            </div>
                       
            <button type="submit" name="submit" class="btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4" id="btn-submit" title="Save">
                <span class="button-content">
                    Save
                </span>
            </button>
            <input type="hidden" name="idValue" id="idValue" value="<?php echo !empty($PrefeRow->id)?$PrefeRow->id:0;?>" />
         </form>    
    </div>
</div>   

<script>
// var base_url =  "<?php echo ASSETS_PATH; ?>";
// var editor_arr = ["headers", "footer"];
// create_editor(base_url,editor_arr);
</script>

<script type="text/javascript" src="<?php echo ASSETS_PATH;?>uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript">
   // <![CDATA[
	$(document).ready(function() {
		// For Icon Image Upload
		$('#icon_upload').uploadify({
		'swf'  : '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
		'uploader'   : '<?php echo ASSETS_PATH;?>uploadify/uploadify.php',
		'formData'   : {PROJECT : '<?php echo SITE_FOLDER;?>',targetFolder:'images/preference/',thumb_width:60,thumb_height:60},
		'method'     : 'post',
		'cancelImg'  : '<?php echo BASE_URL;?>uploadify/cancel.png',
		'auto'       : true,
		'multi'      : false,	
		'hideButton' : false,	
		'buttonText' : 'Upload Image',
		'width'      : 125,
		'height'	 : 21,
		'removeCompleted' : true,
		'progressData' : 'speed',
		'uploadLimit' : 1,
		'fileTypeExts' : '*.gif; *.jpg; *.jpeg;  *.png; *.GIF; *.JPG; *.JPEG; *.PNG;',
		 'buttonClass' : 'button formButtons',
	   /* 'checkExisting' : '/uploadify/check-exists.php',*/
		'onUploadSuccess' : function(file, data, response) {
			$('#uploadedImageName').val('1');
			var filename =  data;
			$.post('<?php echo BASE_URL;?>apanel/preference/uploaded_image.php',{imagefile:filename},function(msg){			
				   $('#preview_Image').html(msg).show();
				}); 
				
		},
		'onDialogOpen'      : function(event,ID,fileObj) {		
		},
		'onUploadError' : function(file, errorCode, errorMsg, errorString) {
			   alert(errorMsg);
			},
		'onUploadComplete' : function(file) {
			  //alert('The file ' + file.name + ' was successfully uploaded');
			} 	
	  });

	// For Logo upload
	$('#logo_upload').uploadify({
		'swf'  : '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
		'uploader'   : '<?php echo ASSETS_PATH;?>uploadify/uploadify.php',
		'formData'   : {PROJECT : '<?php echo SITE_FOLDER;?>',targetFolder:'images/preference/',thumb_width:200,thumb_height:200},
		'method'     : 'post',
		'cancelImg'  : '<?php echo BASE_URL;?>uploadify/cancel.png',
		'auto'       : true,
		'multi'      : false,	
		'hideButton' : false,	
		'buttonText' : 'Upload Image',
		'width'      : 125,
		'height'	 : 21,
		'removeCompleted' : true,
		'progressData' : 'speed',
		'uploadLimit' : 1,
		'fileTypeExts' : '*.gif; *.jpg; *.jpeg;  *.png; *.GIF; *.JPG; *.JPEG; *.PNG;',
		 'buttonClass' : 'button formButtons',
	   /* 'checkExisting' : '/uploadify/check-exists.php',*/
		'onUploadSuccess' : function(file, data, response) {
			$('#uploadedImageName').val('1');
			var filename =  data;
			$.post('<?php echo BASE_URL;?>apanel/preference/uploaded_image2.php',{imagefile:filename},function(msg){			
				   $('#preview_Image2').html(msg).show();
				}); 
				
		},
		'onDialogOpen'      : function(event,ID,fileObj) {		
		},
		'onUploadError' : function(file, errorCode, errorMsg, errorString) {
			   alert(errorMsg);
			},
		'onUploadComplete' : function(file) {
			  //alert('The file ' + file.name + ' was successfully uploaded');
			} 	
	  });
	});
	// ]]>
</script>