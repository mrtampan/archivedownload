<?php

echo "Input url archive.org:";

echo "\n";

$inputUrl = trim(fgets(STDIN));

function http_request($url)
{
    // create curl resource 
    $ch = curl_init();

    // set url 
    curl_setopt($ch, CURLOPT_URL, $url);

    //return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string 
    $output = curl_exec($ch);

    // tutup curl 
    curl_close($ch);

    // menampilkan hasil curl
    return $output;
}

function parsingData($data)
{
    $output = explode("<pre>", $data);

    $output = explode("</pre>", $output[1]);

    return $output[0];
}

function parsingTitle($data)
{
    $output = explode("<title>", $data);

    $output = explode("</title>", $output[1]);

    return $output[0];
}


$data = http_request($inputUrl);

$title = parsingTitle($data);

$data = parsingData($data);

$file = $title . ".txt";
$txt = fopen($file, "w") or die("Unable to open file!");
fwrite($txt, './result/' . $data);
fclose($txt);

$file = $title . ".doc";
$txt = fopen($file, "w") or die("Unable to open file!");
fwrite($txt, './result/' . $data);
fclose($txt);
