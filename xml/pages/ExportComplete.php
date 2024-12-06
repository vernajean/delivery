<?php
include('conn.php');
// Headers for download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=transaction.xls");



// Check connection
if ($connforMyOnlineDb->connect_error) {
    die("Connection failed: " . $connforMyOnlineDb->connect_error);
}

// Fetch data from your database table
$sql = "SELECT * FROM transaction";
$result = $connforMyOnlineDb->query($sql);

// Output data in Excel format
if ($result->num_rows > 0) {
    // Output Excel headers
    echo "id\titem_name\titem_price\titem_source\tbuyer_location\tbuyer_age\tnumber\tseller\tdate\n"; // Adjust column names accordingly

    // Output data rows
    while ($row = $result->fetch_assoc()) {
        echo $row["id"] . "\t" . "\t" . $row["item_name"] . "\t" . $row["item_price"] . "\t" . $row["item_source"] . "\t"  . "\t" . $row["buyer_location"] . "\t" . $row["buyer_age"] . "\t" . $row["number"] . "\t" . $row["seller"] . "\t" . $row["date"] . "\n"; // Adjust column names accordingly
    }
} else {
    echo "0 results";
}
$connforMyOnlineDb->close();
