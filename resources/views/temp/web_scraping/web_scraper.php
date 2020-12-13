<?php

$file = file_get_contents('https://www.imdb.com/search/title/?genres=comedy&certificates=US%3APG-13');

function tidy_html($input_string, $format = 'html') {
    if ($format == 'xml') {
         $config = array(
            'input-xml' => true, 
             'indent' => true,
            'wrap'           => 800
            );
    } else {
        $config = array(
           'output-html'   => true,
            'indent' => true,
           'wrap'           => 800
        ); 
    }
// Detect if Tidy is in configured    
if( function_exists('tidy_get_release') ) {
$tidy = new tidy;
$tidy->parseString($input_string, $config, 'raw');
$tidy->cleanRepair();
$cleaned_html  = tidy_get_output($tidy); 
} else {
# Tidy not configured for this computer
$cleaned_html = $input_string;
}
return $cleaned_html;
}

$cleaned_html = tidy_html($file);

echo $cleaned_html;
?>