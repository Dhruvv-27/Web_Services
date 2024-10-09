<?php
header("Content-Type: application/json");

// Load the JSON file containing travel expenses data.
$data = json_decode(file_get_contents("travel_expenses.json"), true);

// Get the country from the query parameter.
$country = $_GET["country"];

// Check if the country exists in the data.
if (isset($data[$country])) {
    echo json_encode($data[$country]);
} else {
    echo json_encode(["error" => "Country not found"]);
}
?>
