<?php

    // api/forecast.php

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    header("Content-Type: application/json");

    $userAgent = "MyWeatherApp (myemail@example.com)";

    // Coordinates for Joplin, MO.
    // These coordinates are used to fetch the forecast data from the NWS API.
    $lat = 37.0842;
    $lon = -94.5133;

    /**
     * Helper function to fetch data using cURL.
     */
    function fetchData($url, $userAgent)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["User-Agent: $userAgent"]);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            error_log("cURL error: " . curl_error($ch));
        }
        curl_close($ch);
        return json_decode($response, true);
    }

    // Get gridpoint data for Joplin, MO.
    $pointsUrl = "https://api.weather.gov/points/{$lat},{$lon}";
    $pointsData = fetchData($pointsUrl, $userAgent);

    if (!isset($pointsData["properties"])) {
        echo json_encode(["error" => "Failed to get gridpoint data."]);
        exit();
    }

    $forecastUrl = $pointsData["properties"]["forecast"];
    $forecastHourlyUrl = $pointsData["properties"]["forecastHourly"];

    // Fetch forecast data.
    $forecastData = fetchData($forecastUrl, $userAgent);
    $hourlyData = fetchData($forecastHourlyUrl, $userAgent);

    // Wrap icon URLs with our proxy.
    if (isset($forecastData["properties"]["periods"])) {
        foreach ($forecastData["properties"]["periods"] as $idx => $period) {
            if (isset($period["icon"])) {
                $forecastData["properties"]["periods"][$idx]["icon"] =
                    "icon-proxy.php?url=" . urlencode($period["icon"]);
            }
        }
    }

    if (isset($hourlyData["properties"]["periods"])) {
        foreach ($hourlyData["properties"]["periods"] as $idx => $period) {
            if (isset($period["icon"])) {
                $hourlyData["properties"]["periods"][$idx]["icon"] =
                    "icon-proxy.php?url=" . urlencode($period["icon"]);
            }
        }
    }

    echo json_encode([
        "forecast" => $forecastData,
        "hourly" => $hourlyData,
    ]);

?>