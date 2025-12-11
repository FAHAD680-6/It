<?php
include "db.php";

mysqli_query($conn, "DELETE FROM contacts");

echo "All Contacts Deleted!<br>";
echo '<a href="add_contact.html">Back</a>';
?>
