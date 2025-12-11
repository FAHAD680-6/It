<?php
include "db.php";
$result = mysqli_query($conn, "SELECT * FROM contacts");

echo "<h2>Contact List</h2>";

echo "<table border='1' cellpadding='10'>
<tr><th>Name</th><th>Phone</th><th>Email</th></tr>";

while($row = mysqli_fetch_assoc($result)){
    echo "<tr>
            <td>".$row['name']."</td>
            <td>".$row['phone']."</td>
            <td>".$row['email']."</td>
          </tr>";
}

echo "</table>";
echo "<br><a href='add_contact.html'>Add New</a> | <a href='clear.php'>Clear List</a>";
?>
