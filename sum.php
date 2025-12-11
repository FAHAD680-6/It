<?php
if(isset($_GET['num1'])) {
    $a = $_GET['num1'];
    $b = $_GET['num2'];
    echo "<h2>Result (GET Method)</h2>";
} else {
    $a = $_POST['num1'];
    $b = $_POST['num2'];
    echo "<h2>Result (POST Method)</h2>";
}

$sum = $a + $b;
echo "<p>Sum = $sum</p>";
?>
