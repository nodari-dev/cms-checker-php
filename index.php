<?php

$CHECKER = [
    "shopify" => ["_shopify_ga", "cdn.shopify", "myshopify"],
    "wordpress" => ["wp-includes", "wp-content"],
    "magento 1" => ["Mage.Cookies.path", "/skin/frontend/"],
    "magento 2" => ["mage/cookies", "/static/", "/pub/static/", "static/version"]
];

$PERCENTAGE = [
    "no cms found" => 1,
    "shopify" => 0,
    "wordpress" => 0,
    "magento 1" => 0,
    "magento 2" => 0
];

function openFile($file){
    /**
     * Opens file and starts
     *
     * @param string $file opens and set every new line as website
     */

    $handle = fopen($file, "r");
    if ($handle) {
        while (($websiteLink = fgets($handle)) !== false) {
            checkContent(getWebsite($websiteLink));
        }
        fclose($handle);
    } else {
        echo "error opening the file." . "\n";
    }
}

function getWebsite($link) : array{
    /**
     * Curling website and checking 301 redirect if happened
     *
     * @param string $link as a full website link
     *
     * @return string $html as a full page document
     */

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
    return array("html" => $html, "link" => $link);
}

function checkContent($content){
    /**
     * Finding keywords from $content
     * We use associated array $checker for checking
     * And every found result will be +1 to $percentage[$cms]
     *
     * @param string $link as a full website link
     */

    $checker = $GLOBALS['CHECKER'];
    $percentage = $GLOBALS['PERCENTAGE'];

    foreach ($checker as $cms => $value) {
        foreach ($value as $keyword){
            if(strpos($content["html"], $keyword)){
                $percentage[$cms] += substr_count($content["html"], $keyword);
            }
        }
    }
    generateResult($percentage, $content["link"]);
}

function chooseCMS($percentage):string{
    /**
     * get max value from $percentage and return cms
     *
     * @param array $percentage with all cms`s
     *
     * @return string with correct website cms
     */
    return array_search(max($percentage), $percentage);
}

function generateResult($percentage, $link){
    echo $link . " " . chooseCMS($percentage)."\n";
    //TODO: save result as csv file
}
openFile("websites.txt");