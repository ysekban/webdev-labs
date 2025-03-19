<?php
include 'dbconnect.php';

// Fetch unique locations and years from the database
$locationQuery = "SELECT DISTINCT location FROM photographs";
$dateQuery = "SELECT DISTINCT YEAR(date_taken) as year FROM photographs ORDER BY year DESC";

$locations = mysqli_query($connect, $locationQuery);
$years = mysqli_query($connect, $dateQuery);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedLocation = mysqli_real_escape_string($connect, $_POST['location']);
    $selectedYear = mysqli_real_escape_string($connect, $_POST['year']);

    $photoQuery = "SELECT * FROM photographs WHERE location = '$selectedLocation' AND YEAR(date_taken) = '$selectedYear'";
    $photos = mysqli_query($connect, $photoQuery);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Photo Query</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            margin: 30px auto;
            width: 50%;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .photo-container {
            margin: 20px auto;
            display: inline-block;
            border: 1px solid #ddd;
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .photo-container img {
            max-width: 300px;
            height: auto;
            border-radius: 4px;
        }
        .caption {
            margin-top: 10px;
            font-weight: bold;
        }
        select, input[type="submit"] {
            padding: 10px;
            margin: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            background-color: #fff;
            cursor: pointer;
        }
        input[type="submit"] {
            color: white;
            background-color: #007bff;
            border-color: #007bff;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Filter Photographs</h1>
        <form method="post" action="lab09d.php">
            <label for="location">Location:</label>
            <select name="location" id="location">
                <?php while ($row = mysqli_fetch_assoc($locations)) {
                    $isSelected = ($row['location'] == $selectedLocation) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($row['location']) . "' $isSelected>" . htmlspecialchars($row['location']) . "</option>";
                } ?>
            </select>
            <label for="year">Year:</label>
            <select name="year" id="year">
                <?php while ($row = mysqli_fetch_assoc($years)) {
                    $isSelected = ($row['year'] == $selectedYear) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($row['year']) . "' $isSelected>" . htmlspecialchars($row['year']) . "</option>";
                } ?>
            </select>
            <input type="submit" value="Search">
        </form>
    </div>

    <?php
    if (isset($photos)) {
        if (mysqli_num_rows($photos) > 0) {
            while ($row = mysqli_fetch_assoc($photos)) {
                // Display each photo with a caption
                echo "<div class='photo-container'>";
                echo "<img src='" . htmlspecialchars($row['picture_url']) . "' alt='Photo'>";
                echo "<div class='caption'>" . htmlspecialchars($row['subject']) . " - " . htmlspecialchars($row['location']) . "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No photographs found for this selection.</p>";
        }
    }
    ?>
</body>
</html>
<?php
mysqli_close($connect);
?>
