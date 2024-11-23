<?php
$url = 'https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100';

$response = file_get_contents($url);
if ($response === false) {
    die('Error fetching data from API');
}
$result = json_decode($response, true);
if ($result === null) {
    die('Error decoding JSON');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Statistics</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pico-css@latest/css/pico.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Statistics of Students Enrolled in Bachelor Programs</h1>
    <div class="overflow-auto">
        <table>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Nationality</th>
                    <th>College</th>
                    <th>Number of Students</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result['results'] as $record) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($record['year']) . '</td>';
                    echo '<td>' . htmlspecialchars($record['semester']) . '</td>';
                    echo '<td>' . htmlspecialchars($record['nationality']) . '</td>';
                    echo '<td>' . htmlspecialchars($record['colleges']) . '</td>';
                    echo '<td>' . htmlspecialchars($record['number_of_students']) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>