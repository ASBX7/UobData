<?php
// Task 1: Data Retrieval

// First, we define the API endpoint URL where we can fetch data about students
$url = 'https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100';

// Next, we use file_get_contents to grab the data from the API.
$response = file_get_contents($url);

// We need to check if the response is false. If it is, it means something went wrong while fetching data.
if ($response === false) {
    die('Error fetching data from API'); // Stop the script and show an error message.
}

// Now, we take that JSON response and convert it into a PHP associative array.
// This makes it easier to work with the data in our script.
$result = json_decode($response, true);

if ($result === null) {
    die('Error decoding JSON'); // Stop the script and show an error message if decoding fails.
}
?>

// Task 2: Data Visualization

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Statistics</title>
    <!-- Here, we include Pico CSS for styling our table and page layout -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pico-css@latest/css/pico.min.css">
    <style>
        table {
            width: 100%; /* We want the table to take up the full width of its container */
            border-collapse: collapse; /* This removes the space between table borders */
        }
        th, td {
            padding: 10px; /* Adding some padding for better spacing inside cells */
            text-align: left; /* Aligning text to the left for easier reading */
            border-bottom: 1px solid #ddd; /* Adding a light bottom border for separation between rows */
        }
        th {
            background-color: #f2f2f2; /* Setting a light gray background for the header row */
        }
        tr:hover {
            background-color: #f1f1f1; /* Highlighting the row when a user hovers over it */
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Statistics of Students Enrolled in Bachelor Programs</h1>
    <div class="overflow-auto"> <!-- This div will help manage overflow if the table gets too wide -->
        <table>
            <thead>
                <tr>
                    <th>Year</th> <!-- Table header for the Year -->
                    <th>Semester</th> <!-- Table header for the Semester -->
                    <th>The Programs</th> <!-- New header for The Programs -->
                    <th>Nationality</th> <!-- Table header for the Nationality -->
                    <th>College</th> <!-- Table header for the College -->
                    <th>Number of Students</th> <!-- Table header for the Number of Students -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through each record in the results array to display the data
                foreach ($result['results'] as $record) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($record['year']) . '</td>'; // Year
                    echo '<td>' . htmlspecialchars($record['semester']) . '</td>'; // Semester
                    echo '<td>' . htmlspecialchars($record['the_programs']) . '</td>'; // The Programs
                    echo '<td>' . htmlspecialchars($record['nationality']) . '</td>'; // Nationality
                    echo '<td>' . htmlspecialchars($record['colleges']) . '</td>'; // College
                    echo '<td>' . htmlspecialchars($record['number_of_students']) . '</td>'; // Number of Students
                    echo '</tr>'; // End the row
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>