<?php

include 'words.php';
$size = $_FILES['audio_data']['size']; //the size in bytes
$tmpName = $_FILES['audio_data']['tmp_name']; //temporary name that PHP gave to the uploaded file
$name = $_FILES['audio_data']['name'];
foreach ($words as $word) {
    if ($name == $word['slug']) {
        $basename = $slug;
        $outputName = uniqid($basename . '-', true) . '.wav';
        //move the file from temp name to local folder using $output name
        move_uploaded_file($tmpName, 'recordings/' . $outputName);
    }
}


