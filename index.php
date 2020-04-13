<?php 


//ADD HTTP OR HTTPS IF DOESNT EXIST
function http_https(&$urls)
{   
    $i = 0;
    $el_check_id = 0;

    while ($i !== sizeof($urls)) {
        $ch = curl_init ('https://'.$urls[$el_check_id]);

        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, 'HEAD'); //its a  HEAD
        curl_setopt ($ch, CURLOPT_NOBODY, true);          // no body

        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, true);  // in case of redirects
        curl_setopt ($ch, CURLOPT_VERBOSE,        0); //turn on if debugging
        curl_setopt ($ch, CURLOPT_HEADER,         1);     //head only wanted

        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);    // we dont want to wait forever

        curl_exec ( $ch ) ;

        $header = curl_getinfo($ch,CURLINFO_HTTP_CODE);

        if(strpos($urls[$el_check_id], 'https') !== false || strpos($urls[$el_check_id], 'http') !== false){
            $el_check_id++;
        }
        elseif($header == 0){//no ssl
            $urls[$el_check_id] = 'http://' . $urls[$el_check_id];
            $el_check_id++;
        }
        else{
            $urls[$el_check_id] = 'https://' . $urls[$el_check_id];
            $el_check_id++;
        }
        $i++;
$urls = [
    'https://magecloud.agency/',
    'http://insulationstop.com/',
    'https://www.mvintage.com/',
    ];

$check_list=[
    "wp-includes",//WORDPRESS

    'skin/frontend',//Magento1
    'media',//Magento1

    'pub/static/',//Magetno 2
    'static/version',//Magento 2
];


function get_web($urls){
    global $websites;
$websites = [];
function get_web($urls, $websites){
    $urls_download = 0;
    $a = 0;
    for ($i=0; $i < sizeof($urls); $i++){
        $websites[$a] = file_get_contents($urls[$urls_download]);
        $a++;
        $urls_download++;
    }
}
//ADD HTTP OR HTTPS IF DOESNT EXIST


//CHECK ALL WEBISTES

//First we need to check coockies on home pages
//If can't, we search for special folder links
//For some servers we need to use ini_set, because we get 403 (no permissions)
function check_web($urls, $check_list, &$result)
{
    $i=1;
    $web_el_id = 0;
    $check_el_id = 0;

    while ($i <= sizeof($urls)) {
        if(strpos(file_get_contents($urls[$web_el_id].'/wp-login.php'), $check_list[0])){

            $result[$web_el_id] = array($web_el_id,$urls[$web_el_id],'wordpress');

            echo $urls[$web_el_id].' wordpress'.'<br>';

            $web_el_id++;
        }
        elseif (strpos(file_get_contents($urls[$web_el_id]), $check_list[1]) 
            || strpos(file_get_contents($urls[$web_el_id]), $check_list[2])) {

                $result[$web_el_id] = array($web_el_id,$urls[$web_el_id],'magento 1');


            echo $urls[$web_el_id].' magento 1'.'<br>';

                $web_el_id++;
        }
        elseif (strpos(file_get_contents($urls[$web_el_id]), $check_list[3])  
            || strpos(file_get_contents($urls[$web_el_id]), $check_list[4]) 
                || strpos(file_get_contents($urls[$web_el_id]), $check_list[5]) 
                    || strpos(file_get_contents($urls[$web_el_id]), $check_list[6])){

                    $result[$web_el_id] = array($web_el_id,$urls[$web_el_id],'magento 2');
                echo $urls[$web_el_id].' magento 2';

                    $web_el_id++;
        }
        elseif (strpos(file_get_contents($urls[$web_el_id]), $check_list[7]) 
            || strpos(file_get_contents($urls[$web_el_id]), $check_list[8])) {

                $result[$web_el_id] = array($web_el_id,$urls[$web_el_id],'Shopify');
            echo $urls[$web_el_id].' Shopify'.'<br>';
                $web_el_id++;
        }
        elseif (strpos(get_headers($urls[$web_el_id])[0], '403')){
            try{
                ini_set('user_agent', 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-GB; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3');
                if (strpos(file_get_contents($urls[$web_el_id]), $check_list[7]) 
                    || strpos(file_get_contents($urls[$web_el_id]), $check_list[8])) {
                        throw new Exception($urls[$web_el_id].' Shopify'.'<br>');
                }
                else{
                    throw new Exception($urls[$web_el_id]." ".get_headers($urls[$web_el_id])[0]);
                }
            }
            catch (Exception $ex) {
                $result[$web_el_id] = array($web_el_id,$urls[$web_el_id],'Shopify');

                echo $urls[$web_el_id].' Shopify'.'<br>';

                $web_el_id++;
            }
        }
        else{
            $a = 1;
            while ($a <= sizeof($urls[$web_el_id])) {
                $curlInit = curl_init($urls[$web_el_id]);
                curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
                curl_setopt($curlInit,CURLOPT_HEADER,true);
                curl_setopt($curlInit,CURLOPT_NOBODY,true);
                curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

                //get answer
                $response = curl_exec($curlInit);
                if ($response) {
                    $result[$web_el_id] = array($web_el_id,$urls[$web_el_id],'Fault');
                    echo $urls[$web_el_id].' Fault'.'<br>';
                    $web_el_id++;
                }
                else {
                    $result[$web_el_id] = array($web_el_id,$urls[$web_el_id],'Dead');
                    echo $urls[$web_el_id].' Dead'.'<br>';
                    $web_el_id++;
                }
                curl_close($curlInit);
                $a++;
            }
        }
        $i++;
function check_web($websites, $check_list, $urls){
    $result_web[0] = array('Number', 'Website', 'CMS');
    $result_web_el_id = 1;
    $el_web_id = 0;
    $i = 1;
    while ($i <= sizeof($websites)) {
        if(strpos($websites[$el_web_id], $check_list[0])) {
            // print_r($urls[$el_web_id]);
            // echo ' CMS WORDPRESS<br>';
            $cms = 'wodpress';
            $result_web[$result_web_el_id] = array($el_web_id, $urls[$el_web_id], $cms);
            $result_web_el_id++;
            $el_web_id++;

        }
        elseif(strpos($websites[$el_web_id], $check_list[1]) && strpos($websites[$el_web_id], $check_list[2])) {
            // print_r($urls[$el_web_id]);
            // echo ' CMS MAGENTO 1<br>';
            $cms = 'magento 1';
            $result_web[$result_web_el_id] = array($el_web_id, $urls[$el_web_id], $cms);
            $result_web_el_id++;
            $el_web_id++;
        }
        elseif(strpos($websites[$el_web_id], $check_list[3]) || strpos($websites[$el_web_id], $check_list[4])) {
            // print_r($urls[$el_web_id]);
            // echo 'CMS MAGENTO 2<br>';
            $cms = 'magento 2';
            $result_web[$result_web_el_id] = array($el_web_id, $urls[$el_web_id], $cms);
            $result_web_el_id++;
            $el_web_id++;
        }
        else{
            // print_r($urls[$el_web_id]);
            // echo ' CMS NO<br>';
            $el_check_id++;
            $cms = "undefinded";
            $result_web[$result_web_el_id] = array($el_web_id, $urls[$el_web_id], $cms);
            $result_web_el_id++;
            $el_web_id++;
        }
    $i++;

    }
    print_r($result_web);
}

get_web($urls);
check_web($websites, $check_list, $urls);
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="table.csv"');

$fp = fopen('../table.csv', 'w'); 
foreach ($result_web as $fields) {
    fputcsv($fp, $fields, ',');
}
//CHECK ALL WEBISTES


//SAVE INTO FILE
function save_result($result){
    $counter = 1;
    $file_name = './results/' .'result-'.date("D-M-j_").$counter.'.csv';
    if (file_exists($file_name)) {
        $counter++;
        echo $relative_pathrelative_path;
        $fp = fopen('./results/' .'result-'.date("D-M-j_").$counter.'.csv', 'w');


    }
    else {
        echo $relative_pathrelative_path;
        $fp = fopen('./results/' .'result-'.date("D-M-j_").$counter.'.csv', 'w');
    }
            foreach ($result as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
        echo '<a href="'.$file_name.'">Download result</a>';
}
//SAVE INTO FILE

$urls = [
'ilovecarousel.com',
// 'mountainbikesdirect.com.au',
// 'nopolka.com',
// 'benjifrank.com',
// 'comstockheritage.com',
// 'coliesail.com',
// 'propercloth.com',
// 'picturesplus.com',
// 'tileliving.com',
// 'awe-tuning.com',
// 'fitdir.com',
// 'bkkgemstones.com',


];
$check_list=[
    "wp-includes",//WORDPRESS

    'Mage.Cookies.path', //Cookies magento 1
    '/skin/frontend/',//Magento 1
    
    'mage/cookies', //Cookies magento 2
    '/static/', //Magetno 2
    '/pub/static/',//Magetno 2
    'static/version',//Magento 2

    '_shopify_ga',//Cookie shopify
    'cdn.shopify',//Shopify

    'extensions', //Netsuite
];


$result[0] = array('Number','Webiste','CMS');

if (sizeof($urls) > 0){
    http_https($urls);
    check_web($urls, $check_list, $result);
    save_result($result);
}
else{
     echo '<p>No websites selected</p>';
}

fclose($fp);

get_web($urls, $websites);
check_web($websites, $check_list);
?>
