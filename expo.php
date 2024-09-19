<?php
require 'vendor/autoload.php';  

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'dream skin nepal';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 2: Fetch Data from the Database using MySQLi
$sql = "SELECT * FROM `posts`";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo  "<pre>";
print_r(
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC)

);


    // Step 3: Create a Spreadsheet Object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Step 4: Populate the Excel File
    // Add headers
    // $columns = array_keys($rows[0]); // Get column names from the first row
    // $colIndex = 'A'; // Start with column A
    // foreach ($columns as $column) {
    //     $sheet->setCellValue($colIndex . '1', $column); // Place the column header in the first row
    //     $colIndex++;
    // }

    // Add data rows
    // $rowIndex = 2; // Start from the second row (below headers)
    // foreach ($rows as $row) {
    //     $colIndex = 'A'; // Reset column to A for each row
    //     foreach ($row as $cell) {
    //         $sheet->setCellValue($colIndex . $rowIndex, $cell); // Set cell value
    //         $colIndex++;
    //     }
    //     $rowIndex++;
    // }

    // Step 5: Export the Excel File for Download
    $filename = 'database_export_' . date('Y-m-d') . '.xlsx';

    // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    // header("Content-Disposition: attachment; filename=\"$filename\"");
    // header('Cache-Control: max-age=0');

    // Write the file to output
    // $writer = new Xlsx($spreadsheet);
    // $writer->save('php://output');
    exit;
} else {
    echo "No records found.";
}

// Close the database connection
mysqli_close($conn);
