<?php
// Retrieve numbers from URL parameters
$num1 = $_GET["num1"];
$num2 = $_GET["num2"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Multiplication Table</title>
    <style>
        table {
            border-collapse: collapse;
        }
        td, th {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
        /* Add more CSS styling as needed */
    </style>
</head>
<body>
    <table>
        <?php
        for ($row = 1; $row <= $num1; $row++) {
            echo "<tr>";
            for ($col = 1; $col <= $num2; $col++) {
                echo "<td>" . $row * $col . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
