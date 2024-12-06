<?php
include('conn.php');
// Headers for download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=User Account.xls");



// Check connection
if ($connForMyDatabase->connect_error) {
    die("Connection failed: " . $connForMyDatabase->connect_error);
}

// Fetch data from your database table
$sql = "SELECT * FROM user_account";
$result = $connForMyDatabase->query($sql);

// Output data in Excel format
if ($result->num_rows > 0) {
    // Output Excel headers
    echo "id\tfullname\tpassword\tnumber\tprofilePic\n"; // Adjust column names accordingly

    // Output data rows
    while ($row = $result->fetch_assoc()) {
        echo $row["id"] . "\t" . $row["fullname"] . "\t" . $row["password"] . "\t" . $row["number"] . "\t" . $row["profilePic"] . "\n"; // Adjust column names accordingly
    }
} else {
    echo "0 results";
}
$connForMyDatabase->close();
