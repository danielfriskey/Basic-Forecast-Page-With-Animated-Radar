<?php
    // icon-proxy.php

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    if (!isset($_GET["url"])) {
        http_response_code(400);
        exit("No URL provided.");
    }

    $url = $_GET["url"];

    // Validate: Only allow URLs from the NWS icons endpoint.
    if (strpos($url, "https://api.weather.gov/icons/") !== 0) {
        http_response_code(400);
        exit("Invalid URL.");
    }

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "User-Agent: MyWeatherApp (myemail@example.com)",
    ]);
    $data = curl_exec($ch);
    $info = curl_getinfo($ch);
    $err = curl_error($ch);
    curl_close($ch);

    if ($data === false) {
        http_response_code(500);
        exit("Error fetching image: $err");
    }

    header("Content-Type: " . $info["content_type"]);
    echo $data;
    
?>