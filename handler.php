<?php
$servername = "localhost";
$username = "root"; // <--- غيّر هذا إلى اسم مستخدم MySQL الخاص بك
$password = "";     // <--- غيّر هذا إلى كلمة مرور MySQL الخاصة بك
$dbname = "addressbook_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");
function display_contacts($conn, $search_term = '') {
    $html = '';
    $sql = "SELECT * FROM contacts";
    if (!empty($search_term)) {
        $search_term = "%" . $conn->real_escape_string($search_term) . "%";
        $sql .= " WHERE last_name LIKE '$search_term'"; 
    }
    $sql .= " ORDER BY last_name ASC"; 
    $result = $conn->query($sql);
    $html .= '<h3>Contacts</h3>';
    $html .= '<table border="1" style="width:100%; text-align:left;">';
    $html .= '<thead><tr><th>First Name</th><th>Last Name</th><th>Street</th><th>City</th><th>State</th><th>Zip</th></tr></thead>';
    $html .= '<tbody>';
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $html .= "<tr>";
            $html .= "<td>" . htmlspecialchars($row['first_name']) . "</td>";
            $html .= "<td>" . htmlspecialchars($row['last_name']) . "</td>";
            $html .= "<td>" . htmlspecialchars($row['street']) . "</td>";
            $html .= "<td>" . htmlspecialchars($row['city']) . "</td>";
            $html .= "<td>" . htmlspecialchars($row['state']) . "</td>";
            $html .= "<td>" . htmlspecialchars($row['zip']) . "</td>";
            $html .= "</tr>";
        }
    } else {
        $html .= '<tr><td colspan="6">No contacts found.</td></tr>';
    }
    $html .= '</tbody></table>';   
    return $html;
}
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'insert') {
        $first_name = $conn->real_escape_string($_POST['first_name']);
        $last_name  = $conn->real_escape_string($_POST['last_name']);
        $street     = $conn->real_escape_string($_POST['street']);
        $city       = $conn->real_escape_string($_POST['city']);
        $state      = $conn->real_escape_string($_POST['state']);
        $zip        = $conn->real_escape_string($_POST['zip']);
        $sql_insert = "INSERT INTO contacts (first_name, last_name, street, city, state, zip) 
                       VALUES ('$first_name', '$last_name', '$street', '$city', '$state', '$zip')";                     
        if ($conn->query($sql_insert) === TRUE) {
            echo display_contacts($conn);
        } else {
            echo "Error inserting record: " . $conn->error;
        }
    } elseif ($_POST['action'] === 'search') {
        $search_term = $_POST['search_term'] ?? '';
        echo display_contacts($conn, $search_term);
    } elseif ($_POST['action'] === 'initial_load') {
        echo display_contacts($conn);
    }
} else {
    echo display_contacts($conn);
}

$conn->close();
?>