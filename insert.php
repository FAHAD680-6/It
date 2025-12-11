<?php
include "db.php";

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$sql = "INSERT INTO contacts(name, phone, email) VALUES('$name', '$phone', '$email')";
mysqli_query($conn, $sql);

echo "Contact Saved Successfully!<br>";
echo '<a href="add_contact.html">Add Another</a> | <a href="view.php">View Contacts</a>';
?>
