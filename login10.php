<?php
require_once 'welcome.php';
$input_email = $_POST['email'];
$input_password = $_POST['password'];
$sql = "SELECT id FROM users WHERE email = ? AND password = ?";

if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);
    $param_email = $input_email;
    $param_password = $input_password; 
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {

            echo "<p style='color: green;'>✅ **Login Successful!** Welcome.</p>";

        } else {
            echo "<script>alert('wrong username or password');</script>";
        }
    } else {
        echo "Oops! Something went wrong with the query execution.";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($link);
?>
