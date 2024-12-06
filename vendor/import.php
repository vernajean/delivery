<?php
include('../conn.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file is uploaded successfully
    if (isset($_FILES["excelFile"]) && $_FILES["excelFile"]["error"] == UPLOAD_ERR_OK) {
        // Specify the target directory for file upload
        $targetDir = "uploads/";
        $targetFilePath = $targetDir . basename($_FILES["excelFile"]["name"]);
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowedExtensions = array("xls", "xlsx");
        if (in_array($fileType, $allowedExtensions)) {
            // Move uploaded file to the specified directory
            if (move_uploaded_file($_FILES["excelFile"]["tmp_name"], $targetFilePath)) {
                // Include the required PHPExcel library
                require '../xml/pages/PHPExcel/classes/PHPExcel.php';

                // Load the Excel file
                $excelReader = PHPExcel_IOFactory::createReaderForFile($targetFilePath);
                $excelReader->setReadDataOnly(true);
                $objPHPExcel = $excelReader->load($targetFilePath);
                $worksheet = $objPHPExcel->getActiveSheet();

                // Iterate through each row and insert data into the database
                foreach ($worksheet->getRowIterator() as $row) {
                    $rowData = [];
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false); // Loop through all cells, even if they are empty
                    foreach ($cellIterator as $cell) {
                        $rowData[] = $cell->getValue();
                    }

                    // Insert data into the database
                    $sql = "INSERT INTO orders (id, product_id, quantity, buyer_id, seller_id, order_status, date_created) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param("iississ", $rowData[0], $rowData[1], $rowData[2], $rowData[3], $rowData[4], $rowData[5], $rowData[6]);
                    $stmt->execute();
                    $stmt->close();
                }

                echo "Import completed successfully!";
            } else {
                echo json_encode(array('error' => 'File upload failed'));
            }
        } else {
            echo json_encode(array('error' => 'Only .xls and .xlsx files are allowed'));
        }
    } else {
        echo json_encode(array('error' => 'No file uploaded'));
    }
}
?>
