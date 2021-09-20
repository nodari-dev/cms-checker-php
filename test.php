<?php

$CHECKER = [
    "shopify" => ["_shopify_ga", "cdn.shopify", "myshopify"],
    "wordpress" => ["wp-includes", "wp-content"],
    "magento 1" => ["Mage.Cookies.path", "/skin/frontend/"],
    "magento 2" => ["mage/cookies", "/static/", "/pub/static/", "static/version"]
];

$PERCENTAGE = [
    "shopify" => 0,
    "wordpress" => 0,
    "magento 1" => 0,
    "magento 2" => 0
];

function openFile($file){
    $handle = fopen($file, "r");

    if ($handle) {
        while (($websiteLink = fgets($handle)) !== false) {
            echo $websiteLink . "\n";
            checkContent(getWebsite($websiteLink));
        }
        fclose($handle);
    } else {
        echo "error opening the file." . "\n";
    }
}

function getWebsite($link) : string{
    echo "getting website html..." . "\n";
    $ch = curl_init($link);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}

function checkContent($content){
    $checker = $GLOBALS['CHECKER'];
    $percentage = $GLOBALS['PERCENTAGE'];

    foreach ($checker as $key => $value) {
        foreach ($value as $val){
            if(strpos($content, $val)){
                $percentage[$key] += substr_count($content, $val);
                echo "FOUND $key " . $percentage[$key] . "\n";
            }
        }
    }
    saveResult();
}

function saveResult(){
    echo "test";
    //TODO: Add correct comments to all functions
    //TODO: Generate result based on scoreboard
    //TODO: Save result file with all websites
//    $fileName = './results/' .'result-'.date("D-M-j_").$counter.'.csv';
}

openFile("websites.txt");