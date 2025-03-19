<?php
// Problem 2
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = $_POST["number1"];
    $num2 = $_POST["number2"];

    if ($num1 >= 3 && $num1 <= 12 && $num2 >= 3 && $num2 <= 12) {
        // Redirect to the same page with GET parameters
        header("Location: lab08.php?num1=$num1&num2=$num2");
        exit;
    } else {
        echo "<p>Numbers must be between 3 and 12. Please <a href='javascript:history.back()'>go back</a> and correct your input.</p>";
        exit;
    }
}

// Problem 3
$hitCount = 0;
if(isset($_COOKIE['hitCount'])) {
    $hitCount = (int)$_COOKIE['hitCount'];
}
$hitCount++;
setcookie('hitCount', $hitCount, time() + 3600 * 24 * 365); // Set cookie for 1 year

// Problem 1
$hour = date("H");
$backgroundImage = "";
$greeting = "";

if ($hour < 12) {
    $backgroundImage = "morning.jpg";
    $greeting = "Good morning";
} elseif ($hour < 18) {
    $backgroundImage = "afternoon.jpg";
    $greeting = "Good afternoon";
} elseif ($hour < 22) {
    $backgroundImage = "evening.jpg";
    $greeting = "Good evening";
} else {
    $backgroundImage = "night.jpg";
    $greeting = "Good night";
}

// Problem 4
$imageToShow = '';
$validImages = ['witch.gif', 'dracula.gif', 'jackolantern.gif'];
$imageName = '';

if (isset($_GET['image']) && in_array($_GET['image'], $validImages)) {
    $imageToShow = $_GET['image'];
    $imageName = "The image in use is: " . htmlspecialchars($imageToShow);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dynamic Webpage</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .time-of-day {
            height: 100vh;
            background: url('<?php echo $backgroundImage; ?>') no-repeat center center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 48px;
        }
        .form-section, .hit-counter {
            text-align: center;
            padding: 20px;
        }
        .hit-counter {
            position: fixed;
            bottom: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent bg */
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 16px;
            z-index: 100; /* Ensures it's above other content */
        }
        .halloween-image {
            position: fixed;
            top: 10px;
            right: 10px;
            opacity: 0.8;
            max-width: 150px;
            max-height: 150px;
            z-index: 10;
        }
        .image-name {
            text-align: right;
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="time-of-day">
        <?php echo $greeting; ?>
    </div>

    <div class="form-section">
        <!-- Form for Problem 2 -->
        <form action="" method="post">
            <label for="number1">Number 1 (3-12):</label>
            <input type="number" id="number1" name="number1" min="3" max="12" required>
            <br>
            <label for="number2">Number 2 (3-12):</label>
            <input type="number" id="number2" name="number2" min="3" max="12" required>
            <br>
            <input type="submit" value="Generate Table">
        </form>
        <?php
        // Check if GET parameters are set and open multiplication table in a new window
        if (isset($_GET['num1']) && isset($_GET['num2'])) {
            echo "<script>window.open('lab08b.php?num1=".$_GET['num1']."&num2=".$_GET['num2']."', '_blank');</script>";
        }
        ?>
    </div>

    <div class="hit-counter">
        Visits: <?php echo $hitCount; ?>
    </div>

    <?php if ($imageToShow): ?>
        <img src="<?php echo $imageToShow; ?>" class="halloween-image">
        <div class="image-name"><?php echo $imageName; ?></div>
    <?php endif; ?>

</body>
</html>