<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = '/uploadcareer'; // Relative to the root

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] .'/'. $targetFolder;
	$modifyfile = randomkeys(5).preg_replace('/\s+/', '_', $_FILES['Filedata']['name']);
	$targetFile = rtrim($targetPath,'/') . '/' . $modifyfile;

	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png','pdf','xlsx','docs','txt'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo $modifyfile;
	} else {
		echo '';
	}
}

function randomkeys($length) {
    $validCharacters = "1234567890abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ";
    $validCharNumber = strlen($validCharacters);
 
    $result = "";
 
    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
 
    return $result;
}
?>