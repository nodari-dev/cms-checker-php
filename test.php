<?php

function openFile($file){
    $handle = fopen($file, "r");

    if ($handle) {
        while (($websiteLink = fgets($handle)) !== false) {
            echo $websiteLink . "\n";
            if (strpos($websiteLink, 'http') == false) {
                $websiteLink = "http://" . $websiteLink;
                echo $websiteLink . "\n";
            } else{
                echo $websiteLink . "\n";
            }
        }

        fclose($handle);
    } else {
        echo "error opening the file." . "\n";
    }
}

openFile("websites.txt");
