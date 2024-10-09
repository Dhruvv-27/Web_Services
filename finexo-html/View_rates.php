<?php
// Enable error reporting for debugging (optional)
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

// Define the API key and base URL
$apiKey = "492c6549b737e524683a52ccb9bbfa4c";
$baseUrl = "https://api.forexrateapi.com/v1/latest";
$baseCurrency = "USD";
$targetCurrencies = "EUR,JPY,INR,CAD,CHF,MUR,GBP"; // Target currencies to display rates for

// Check if the format is set in the URL parameters
$format = isset($_GET["format"]) ? strtolower($_GET["format"]) : "json";

// Construct the API URL dynamically based on user selection
$req_url = "$baseUrl?api_key=$apiKey&base=$baseCurrency&currencies=$targetCurrencies";

// Fetching data from API
$response_json = @file_get_contents($req_url);

if ($response_json === false) {
    echo "<p>Error: Unable to connect to the currency conversion service. Please check your internet connection and API URL.</p>";
    exit();
}

try {
    // Decode the JSON response
    $response = json_decode($response_json);

    // Check if decoding was successful
    if ($response === null && json_last_error() !== JSON_ERROR_NONE) {
        echo "<p>Error: Failed to parse the JSON response. Check the API key and URL.</p>";
        echo "<pre>" . print_r($response_json, true) . "</pre>"; // Print the raw JSON response for debugging
        exit();
    }

    // Check if the API request was successful
    if (isset($response->rates)) {
        $exchange_rates = $response->rates; // Extract exchange rates

        // Display the exchange rates in the selected format
        if ($format === "json") {
            // Output JSON format
            header("Content-Type: application/json");
            echo json_encode($exchange_rates, JSON_PRETTY_PRINT);
        } elseif ($format === "xml") {
            // Output XML format
            header("Content-Type: text/xml");
            $xml = new SimpleXMLElement("<exchange_rates/>");

            foreach ($exchange_rates as $currency => $rate) {
                $currencyNode = $xml->addChild("currency");
                $currencyNode->addChild("name", $currency);
                $currencyNode->addChild("rate", $rate);
            }

            // Print the XML content
            echo $xml->asXML();
        } else {
            echo "<p>Invalid format specified. Please choose either JSON or XML.</p>";
        }
    } else {
        // If the API returns an error or is unsuccessful
        echo "<p>Error: Unable to fetch exchange rate data. Please check the API key or the request parameters.</p>";
    }
} catch (Exception $e) {
    // Handle any exceptions or errors during the process
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
?>
