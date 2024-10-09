<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["country"])) {
    // Get the country input from the form
    $countryInput = trim($_POST["country"]);

    // URL to the WSDL file for the CountryInfoService
    $wsdl =
        "http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL";

    try {
        // Create a new SoapClient instance using the WSDL
        $client = new SoapClient($wsdl);

        // Step 1: Convert country name to ISO code using the 'CountryISOCode' method
        $isoParams = ["sCountryName" => $countryInput];
        $isoResponse = $client->CountryISOCode($isoParams);

        // Extract the ISO code from the response
        $isoCode = $isoResponse->CountryISOCodeResult;

        if (!empty($isoCode)) {
            // Step 2: Get the currency using the ISO code with 'CountryCurrency' method
            $currencyParams = ["sCountryISOCode" => $isoCode];
            $currencyResponse = $client->CountryCurrency($currencyParams);

            // Extract the currency code and name from the response
            $currencyCode = $currencyResponse->CountryCurrencyResult->sISOCode;
            $currencyName = $currencyResponse->CountryCurrencyResult->sName;

            // Display the result
            echo "<h3>The currency for $countryInput is ($currencyName) $currencyCode.</h3>";
        } else {
            echo "<p>Sorry, no ISO code found for the country $countryInput.</p>";
        }
    } catch (SoapFault $fault) {
        // Handle any errors
        echo "<p>Error: {$fault->faultcode} - {$fault->faultstring}</p>";
    }
}
?>
