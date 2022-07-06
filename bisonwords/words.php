<?php
$words = [
    // Word/Words/Phrase, Pronunciation, Url
    ['word' => 'Brison', 'pronunciation' => 'Like Bryson, Bry-son'], 
    ['word' => 'Hey Brison', 'pronunciation' => 'Hey Bry-son'],
    ['word' => 'Bison', 'pronunciation' => 'Bye-son'],
    ['word' => 'Hey Bison', 'pronunciation' => 'Hey Bye-son'],
    ['word' => 'Buffalo', 'pronunciation' => 'Buff-ah-low'],
    ['word' => 'Hey Buffalo', 'pronunciation' => 'Hey Buff-ah-low'],
    ['word' => 'Weather'],
    ['word' => "What's the weather?"]
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
foreach ($words as &$word) {
    $slug = \Transliterator::createFromRules($rules)
                           ->transliterate($word['word']);
    $word['slug'] = $slug;
}
unset($word);