<?php
include 'dbconnect.php'; // Include your dbconnect.php file

$query = "SELECT * FROM photographs ORDER BY date_taken DESC"; // SQL query
$result = mysqli_query($connect, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($connect));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Photograph Records - Sorted</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        table {
            margin: auto;
            border-collapse: collapse;
            width: 80%;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Photograph Records</h1>
    <table>
        <tr>
            <th>Picture Number</th>
            <th>Subject</th>
            <th>Location</th>
            <th>Date Taken</th>
            <th>Picture URL</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['picture_number']) . "</td>";
            echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
            echo "<td>" . htmlspecialchars($row['location']) . "</td>";
            echo "<td>" . htmlspecialchars($row['date_taken']) . "</td>";
            echo "<td><a href='" . htmlspecialchars($row['picture_url']) . "' target='_blank'>View Image</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
<?php
mysqli_close($connect); // Close the database connection
?>
