<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Database/Database Connection.php';
include_once $base_url . 'Assets/Composer/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['UpdateQuantity'])) {
    $supportFormat = [".xlsx", ".csv", ".ods"];
    if (isset($_FILES['ExcelFile']['tmp_name'])) {
        $file = $_FILES['ExcelFile']['tmp_name'];

        $fileName = $_FILES['ExcelFile']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); 
        if (!in_array("." . $fileExtension, $supportFormat)) {
            $response = [
                'Status' => 'Invalid Format',
                'Message' => 'Invalid file type. Only .xlsx, .csv, and .ods are supported.'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }

        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        $response = [];

        foreach ($data as $row) {
            $productId = $row[0];
            $Title = $row[1];
            $newQuantity = $row[2];
            if($newQuantity < 0){
                $newQuantity=0;
            }

            $SQL = "SELECT * FROM `posts` WHERE `Custom Product ID` = '$productId'";
            $SqlRun = mysqli_query($conn, $SQL);

            if (mysqli_num_rows($SqlRun) > 0) {
                $updateSQL = "UPDATE `posts` SET `Product Quantity` = '$newQuantity' WHERE `Custom Product ID` = '$productId'";
                if (!mysqli_query($conn, $updateSQL)) {
                    $response[] = [
                        'Status' => 'Error',
                        'ProductID' => $productId,
                        'Title' => $Title,
                        'Message' => 'Update failed'
                    ];
                }
            } else {
                $response[] = [
                    'Status' => 'Error',
                    'ProductID' => $productId,
                    'Title' => $Title,
                    'Message' => 'Not found'
                ];
            }
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
