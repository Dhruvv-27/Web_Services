<?php
// Check if the form has been submitted and the 'country' input is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["country"])) {
    // Get the country input from the form and trim any extra spaces
    $countryInput = trim($_POST["country"]);

    // URL to the WSDL file for the CountryInfoService, which provides the web service methods
    $wsdl = "http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL";

    try {
        // Create a new SoapClient instance using the provided WSDL URL
        $client = new SoapClient($wsdl);

        // Step 1: Convert the country name to its ISO code using the 'CountryISOCode' method
        // Prepare the parameters for the SOAP request
        $isoParams = ["sCountryName" => $countryInput];
        // Call the 'CountryISOCode' method with the parameters and store the response
        $isoResponse = $client->CountryISOCode($isoParams);

        // Extract the ISO code from the SOAP response
        $isoCode = $isoResponse->CountryISOCodeResult;

        // Check if the ISO code is not empty before proceeding
        if (!empty($isoCode)) {
            // Step 2: Get the currency information using the ISO code with the 'CountryCurrency' method
            // Prepare the parameters for the 'CountryCurrency' method
            $currencyParams = ["sCountryISOCode" => $isoCode];
            // Call the 'CountryCurrency' method with the parameters and store the response
            $currencyResponse = $client->CountryCurrency($currencyParams);

            // Extract the currency code and name from the SOAP response
            $currencyCode = $currencyResponse->CountryCurrencyResult->sISOCode;
            $currencyName = $currencyResponse->CountryCurrencyResult->sName;

            // Display the currency information to the user
            echo "<h3>The currency for $countryInput is ($currencyName) $currencyCode.</h3>";
        } else {
            // Display an error message if no ISO code was found for the country
            echo "<p>Sorry, no ISO code found for the country $countryInput.</p>";
        }
    } catch (SoapFault $fault) {
        // Handle any SOAP errors that occur during the request
        // Display the fault code and fault string for debugging purposes
        echo "<p>Error: {$fault->faultcode} - {$fault->faultstring}</p>";
    }
}
?>
