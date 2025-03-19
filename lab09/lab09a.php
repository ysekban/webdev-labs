<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'dbconnect.php';

$createTableQuery = "CREATE TABLE IF NOT EXISTS photographs (
    picture_number INT PRIMARY KEY AUTO_INCREMENT,
    subject VARCHAR(255),
    location VARCHAR(255),
    date_taken DATE,
    picture_url VARCHAR(255)
)";

if (mysqli_query($connect, $createTableQuery)) {
    echo "<p>Table 'photographs' is set up.</p>";
} else {
    echo "<p>Error creating table: " . mysqli_error($connect) . "</p>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = mysqli_real_escape_string($connect, $_POST['subject']);
    $location = mysqli_real_escape_string($connect, $_POST['location']);
    $date_taken = mysqli_real_escape_string($connect, $_POST['date_taken']);
    $picture_url = mysqli_real_escape_string($connect, $_POST['picture_url']);

    $query = "INSERT INTO photographs (subject, location, date_taken, picture_url) VALUES ('$subject', '$location', '$date_taken', '$picture_url')";
    if (mysqli_query($connect, $query)) {
        echo "<p>Record added successfully.</p>";
    } else {
        echo "<p>Error: " . mysqli_error($connect) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Photograph Record</title>
</head>
<body>
    <h1>Add Photograph Record</h1>
    <form method="post" action="lab09a.php">
        <p>
            <label>Subject:</label>
            <input type="text" name="subject" required>
        </p>
        <p>
            <label>Location:</label>
            <input type="text" name="location" required>
        </p>
        <p>
            <label>Date Taken (YYYY-MM-DD):</label>
            <input type="date" name="date_taken" required>
        </p>
        <p>
            <label>Picture URL:</label>
            <input type="url" name="picture_url" required>
        </p>
        <p>
            <input type="submit" value="Add Record">
        </p>
    </form>
</body>
</html>