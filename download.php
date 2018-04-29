<?php
/**
 * Created by PhpStorm.
 * User: lyk
 * Date: 2018/4/29 0029
 * Time: 23:19
 */

require 'vendor/simple-html-dom/simple-html-dom/simple_html_dom.php';

$startTime = time();

$picturePath = './img_download';

if ( !is_dir($picturePath) ) {
    mkdir($picturePath);
}

$baseUrl = 'https://bing.ioliu.cn';

$linkArrNotScratch = array('https://bing.ioliu.cn/');
$linkArrHasScratch = array();

$count = 0;

while(count($linkArrNotScratch)) {
    $url = array_shift($linkArrNotScratch);
    echo $url . "\n";

    array_push($linkArrHasScratch, $url);
    $html = file_get_html($url);

    # find link to another page and record the urls
    foreach($html->find('.page a') as $a ) {
        $anotherUrl = $baseUrl . $a->href;
        if ( !in_array($anotherUrl, $linkArrHasScratch)
            && !in_array($anotherUrl, $linkArrNotScratch) ) {
            array_push($linkArrNotScratch, $anotherUrl);
        }
    }

    # find pictures and store them
    foreach( $html->find('img') as $img ) {
        $count ++;
        $name = str_replace('400x240', '1920x1080', $img->src);
        file_put_contents($picturePath . '/' . basename($name), file_get_contents($name));
    }
}

$endTime = time();

echo 'count: ' . $count . "\n";

echo 'time: ' . ($endTime - $startTime) . " (sec)\n";
