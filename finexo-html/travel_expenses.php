<?php
// Set the header to return a JSON response
header("Content-Type: application/json");

// Load the JSON file containing travel expenses data.
$data = json_decode(file_get_contents("travel_expenses.json"), true);

// Get the country from the query parameter.
$country = $_GET["country"];

// Check if the country exists in the data.
if (isset($data[$country])) {
    // If the country is found, return its data as a JSON response
    echo json_encode($data[$country]);
} else {
    // If the country is not found, return an error message
    echo json_encode(["error" => "Country not found"]);
}
?>
