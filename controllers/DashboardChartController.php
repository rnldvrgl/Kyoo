<?php
// * For Login Process

session_start();

use Core\Validator;
use Core\Database;

// For the Functions
require '../Core/functions.php';

// Validator Class
require base_path('Core/Validator.php');

// Database Class
require base_path('Core/Database.php');

// require connection to the database
$config = require base_path('config/connection.php');

// instantiate the database
$db = new Database($config['database']);

// Get the selected year
$selectedYear = Validator::validate($_POST['year']);

// Query to fetch number of users per month based on the selected year
$dates = $db->query("SELECT MONTH(created_at) AS month, COUNT(*) AS num_users 
FROM queue 
WHERE YEAR(created_at) = :selected_year 
GROUP BY MONTH(created_at)", [
    'selected_year' => $selectedYear,
])->get();

// Initialize an empty array
$dates_details = [];

foreach ($dates as $date) {
    // Fill that empty array with data
    $dates_details[] = $date['num_users'];
}

// Return the Data as JSON
echo json_encode($dates_details);
