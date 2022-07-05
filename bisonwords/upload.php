<?php

$size = $_FILES['audio_data']['size']; //the size in bytes
$input = $_FILES['audio_data']['tmp_name']; //temporary name that PHP gave to the uploaded file
$words = [
    // Word/Words, Pronunciation, Url
    ['Brison'],
    ['Hey Brison'],
    ['Bison'],
    ['Hey Bison'],
    ['Buffalo'],
    ['Hey Buffalo'],
    ['Weather'],
    ["What's the weather?"]
];
$rules = <<<'RULES'
    :: Any-Latin;
    :: NFD;
    :: [:Nonspacing Mark:] Remove;
    :: NFC;
    :: [^-[:^Punctuation:]] Remove;
    :: Lower();
    [:^L:] { [-] > ;
    [-] } [:^L:] > ;
    [-[:Separator:]]+ > '-';
RULES;

$name = $_FILES['audio_data']['name'];
foreach ($words as $word) {
    $slug = \Transliterator::createFromRules($rules)
                           ->transliterate($word[0]);
    if ($name == $slug) {
        $filename = $slug;
        $output = uniqid($filename . '-', true) . '.wav';
        //move the file from temp name to local folder using $output name
        move_uploaded_file($input, 'recordings/' . $output);
    }
}


