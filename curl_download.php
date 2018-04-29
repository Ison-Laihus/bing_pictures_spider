<?php
/**
 * Created by PhpStorm.
 * User: lyk
 * Date: 2018/4/29 0029
 * Time: 23:19
 */

require 'vendor/simple-html-dom/simple-html-dom/simple_html_dom.php';

$startTime = time();

$picturePath = './img_curl_download';

if ( !is_dir($picturePath) ) {
    mkdir($picturePath);
}

$baseUrl = 'https://bing.ioliu.cn';

$linkArrNotScratch = array('https://bing.ioliu.cn/');
$linkArrHasScratch = array();

$count = 0;

$ci = curl_init();
curl_setopt($ci, CURLOPT_TIMEOUT, 100);
curl_setopt($ci, CURLOPT_HEADER, 0);


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
        $handler = fopen($picturePath . '/' . basename($name), 'wb');
        curl_setopt($ci, CURLOPT_URL, $name);
        curl_setopt($ci, CURLOPT_FILE, $handler);
        curl_exec($ci);
        fclose($handler);
    }
}

curl_close($ci);


$endTime = time();

echo 'count: ' . $count . "\n";

echo 'time: ' . ($endTime - $startTime) . " (sec)\n";