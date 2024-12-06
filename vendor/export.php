<?php
include('../conn.php');
// Headers for download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=orders.xls");



// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch data from your database table
$sql = "SELECT * FROM orders";
$result = $connection->query($sql);

// Output data in Excel format
if ($result->num_rows > 0) {
    // Output Excel headers
    echo "id\tproduct_id\tquantity\tbuyer_id\tseller_id\torder_status\tdate_created\n"; // Adjust column names accordingly

    // Output data rows
    while ($row = $result->fetch_assoc()) {
        echo $row["id"] . "\t" . $row["product_id"] . "\t" . $row["quantity"] . "\t" . $row["buyer_id"] .  "\t" . $row["seller_id"] ."\t" . $row["order_status"] .  "\t" . $row["date_created"] . "\n"; // Adjust column names accordingly
    }
} else {
    echo "0 results";
}
$connection->close();
