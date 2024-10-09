<?php
class CalculatorService
{
    // Basic Calculator operations
    public function basicOperation($number1, $number2, $operation)
    {
        switch ($operation) {
            case "add":
                return $number1 + $number2;
            case "subtract":
                return $number1 - $number2;
            case "multiply":
                return $number1 * $number2;
            case "divide":
                if ($number2 != 0) {
                    return $number1 / $number2;
                } else {
                    return "Division by zero error.";
                }
            default:
                return "Invalid operation.";
        }
    }

    // Forex conversion with XML-based rates
    public function forexConversion($fromCurrency, $toCurrency, $amount)
    {
        $xml = simplexml_load_file("currency_rates.xml");

        foreach ($xml->currency as $currency) {
            if (
                $currency["from"] == $fromCurrency &&
                $currency["to"] == $toCurrency
            ) {
                $rate = (float) $currency["rate"];
                return $amount * $rate;
            }
        }
        return "Invalid currency conversion.";
    }
}

// Initialize SOAP server
$server = new SoapServer(null, [
    "uri" =>
        "http://localhost:8080/Web_Services/finexo-html/server.php",
]);
$server->setClass("CalculatorService");
$server->handle();
?>
