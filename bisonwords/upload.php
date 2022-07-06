<?php

include 'words.php';
$size = $_FILES['audio_data']['size']; //the size in bytes
$tmpName = $_FILES['audio_data']['tmp_name']; //temporary name that PHP gave to the uploaded file
$name = $_FILES['audio_data']['name'];
foreach ($words as $word) {
	$slug = $word['slug'];
    if ($name == $slug) {
        $outputName = uniqid($slug . '-', true) . '.wav';
        //move the file from temp name to local folder using $output name
        move_uploaded_file($tmpName, 'recordings/' . $outputName);
    }
}