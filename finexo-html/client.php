<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a new SOAP client
    $client = new SoapClient(null, [
        "location" =>
            "http://localhost:8080/Web_Services/finexo-html/server.php",
        "uri" =>
            "http://localhost:8080/Web_Services/finexo-html/",
    ]);

    // Get the mode (basic calculator or forex)
    $mode = $_POST["mode"];

    if ($mode == "basic") {
        // Basic calculator mode
        $number1 = $_POST["number1"];
        $number2 = $_POST["number2"];
        $operation = $_POST["operation"];

        try {
            // Call the basicOperation method from the web service
            $result = $client->basicOperation($number1, $number2, $operation);
            echo "Result of $operation: " . $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } elseif ($mode == "forex") {
        // Forex converter mode
        $fromCurrency = $_POST["fromCurrency"];
        $toCurrency = $_POST["toCurrency"];
        $amount = $_POST["amount"];

        try {
            // Call the forexConversion method from the web service
            $result = $client->forexConversion(
                $fromCurrency,
                $toCurrency,
                $amount
            );
            echo "Converted amount: " . $result . " $toCurrency";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
