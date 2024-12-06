<?php

ob_start();

include "../conn.php";
require 'autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Function to export data from venues table to Excel
function exportToExcel($conn, $filename)
{
    // Create a new PHPExcel object
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

    // Retrieve data from venues table
    $query = "SELECT id, venue_id, venue_name, description, location, contact, capacity, facilities, product_id, venue_image FROM venues";
    $result = $conn->query($query);

    // Set column headers
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'id')
        ->setCellValue('B1', 'venue_id')
        ->setCellValue('C1', 'venue_name')
        ->setCellValue('D1', 'description')
        ->setCellValue('E1', 'location')
        ->setCellValue('F1', 'contact')
        ->setCellValue('G1', 'capacity')
        ->setCellValue('H1', 'facilities')
        ->setCellValue('I1', 'product_id')
        ->setCellValue('J1', 'venue_image');

    // Fill data from database
    if ($result->num_rows > 0) {
        $rowNumber = 2;
        while ($row = $result->fetch_assoc()) {
            $spreadsheet->getActiveSheet()
                ->setCellValue('A' . $rowNumber, $row["id"])
                ->setCellValue('B' . $rowNumber, $row["venue_id"])
                ->setCellValue('C' . $rowNumber, $row["venue_name"])
                ->setCellValue('D' . $rowNumber, $row["description"])
                ->setCellValue('E' . $rowNumber, $row["location"])
                ->setCellValue('F' . $rowNumber, $row["contact"])
                ->setCellValue('G' . $rowNumber, $row["capacity"])
                ->setCellValue('H' . $rowNumber, $row["facilities"])
                ->setCellValue('I' . $rowNumber, $row["product_id"])
                ->setCellValue('J' . $rowNumber, $row["venue_image"]);
            $rowNumber++;
        }
    }

    // Set headers for download
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    // Save Excel 2007 file
    $writer = IOFactory::createWriter($spreadsheet, 'Xls');
    $writer->save('php://output');
}

// Check if the form is submitted
if (isset($_POST['export'])) {
    $filename = 'venues_export.xls'; // Filename for the exported file with .xls extension
    // Call the function to export data to Excel
    exportToExcel($conn, $filename);
}
?>



















<?php
include ('../conn.php');
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
        echo $row["id"] . "\t" . $row["product_id"] . "\t" . $row["quantity"] . "\t" . $row["buyer_id"] . "\t" . $row["seller_id"] . "\t" . $row["order_status"] . "\t" . $row["date_created"] . "\n"; // Adjust column names accordingly
    }
} else {
    echo "0 results";
}
$connection->close();
