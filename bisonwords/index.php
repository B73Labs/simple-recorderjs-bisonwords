<html lang="en">
<head>
    <title>Bison Words</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
<div class="container">
    <h1>BisonWords</h1>
    <p>Thank you for helping out! Just follow the directions below to submit snippets of your voice. These will be used
       in a machine learning project to make Brison the Bison respond to specific phrases.</p>
    <div class="row">
        <h3>What Are You Making?</h3>
        <p>We are working on a way for Brison the Bison to respond to simple voice commands</p>
    </div>
    <div class="row">
        <h3>How to Participate</h3>
        <p>Just follow these steps! Please try to make each recording with no background noise, if possible.</p>
        <ol>
            <li> We have several words or phrases that we'd like you to say. Under each phrase, press the <b>Record</b>
                 button and say the word or phrase. Accept any pop-ups that ask you to use your computer/phone's
                 microphone.
                 Note that timing is sometimes off, as it might take a fraction of a second to actually begin recording.
                 Take look at the browser tab or phone's notification bar: you should see a recording symbol when
                 recording
                 is actually happening.
            </li>
            <li>
                Please make several recordings of each word/phrase using different inflections! It will help the
                training
                process.
            </li>
            <li>
                Play back each recording to make sure that the word or phrase is easily understood (and not truncated).
            </li>
            <li>
                For each word or phrase recording that you are happy with, click the <b>Upload to server</b> link next
                to
                it.
            </li>
        </ol>
    </div>
    <div class="row">
        <h3>License</h3>
        <p>By uploading your voice, you're giving me consent to use it in an aggregate fashion as part of a machine
           learning
           exercise. They will only be used as part of a personal project for non-commercial purposes. Code for the
           project
           will
           be open source and available on GitHub.</p>
        <p>Audio recordings will be labeled with non-identifying information (so people won't know who is speaking). All
           recordings will be bundled and available as a .zip file for anyone to download to use in their machine
           learning
           projects, similar to the
            <a href="https://ai.googleblog.com/2017/08/launching-speech-commands-dataset.html">
                Google Speech Commands dataset
            </a>.
        </p>
    </div>
    <div class="row">
        <h3>Format</h3>
        <p>This section will automatically update with your sample rate when you start recording.</p>
        <div id="formats">Format:</div>
    </div>
    <?php
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

    foreach ($words as $word) {
        $slug = \Transliterator::createFromRules($rules)
                               ->transliterate($word[0]);
        print <<<HTML
<div class="row">
<h4>${word[0]}</h4>
<div>
<button class="recordButton btn btn-dark" id="${slug}" style="height:50px; margin-left:20px;">
<i style="color: red" class="bi bi-circle-fill"></i>
 Record "${word[0]}"</button>
</div>
<p><strong>Recordings:</strong></p>
<div id="${slug}List" class="mb-4"></div>
</div>
HTML;
    }
    ?>
    <p>
        This page is based on the <a href="https://github.com/addpipe/simple-recorderjs-demo">
            simple-recorder-js demo project</a> and
        <a href="https://github.com/ShawnHymel/simple-recorderjs-projects">Shawn Hymel's BotWords</a>
    </p>
    <br>

    <!-- Scripts to run. Make sure these are listed at the end of HTML -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
            crossorigin="anonymous"></script>
    <script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
    <script src="app.js"></script>
</div>
</body>
</html>
