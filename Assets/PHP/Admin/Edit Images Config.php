<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/PHP/Database/Database Connection.php';
if (isset($_POST['ListImage'])) {
    $ID = $_POST['ID'];
    $Query = "SELECT * FROM `postsmeta` WHERE `Product ID`='$ID' AND `Product Meta Key` LIKE '%Image%'";
    $RunQuery = mysqli_query($conn, $Query);
    if ($RunQuery->num_rows > 0) {
        $Array = array();
        while ($Row = $RunQuery->fetch_assoc()) {
            $Array[] = $Row;
        }
        $Data = json_encode($Array);
        header('Content-Type: application/json');
        echo $Data;
    } else {
        echo json_encode(array("Message" => "Invalid Request"));
    }
}
if (isset($_POST['UpdateOrder'])) {
    $NewImageOrder = $_POST['NewImageOrder'];
    $ProductID = $_POST['ProductID'];
    $ImageArray = array();
    $ImageQuery = "SELECT * FROM `postsmeta` WHERE `Product ID`='$ProductID' AND `Product Meta Key` LIKE '%Image%'";
    $RunImageQuery = mysqli_query($conn, $ImageQuery);
    if ($RunImageQuery->num_rows > 0) {
        while ($Row = $RunImageQuery->fetch_assoc()) {
            $ImageArray[] = $Row;
        }
    }
    for ($i = 0; $i < (count($ImageArray)); $i++) {
        if ($ImageArray[$i]['ID'] != $NewImageOrder[$i]) {
            $index = array_search($NewImageOrder[$i], array_column($ImageArray, 'ID'));
            $ID = $ImageArray[$i]['ID'];
            $Path = $ImageArray[$index]['Product Meta Value'];
            $SQL = "UPDATE `postsmeta` SET `Product Meta Value`='$Path' WHERE `ID`='$ID'";
            $RunQuery = mysqli_query($conn, $SQL);
        }
    }
    if ($RunQuery) {
        echo "Success";
    }
}
if (isset($_POST['DeleteImage'])) {
    $ProductID = $_POST['ProductID'];
    $MetaID = $_POST['MetaID'];
    $ImageQuery = "SELECT * FROM postsmeta WHERE ID='$MetaID'";
    $ImagePath = mysqli_query($conn, $ImageQuery);
    $Row = $ImagePath->fetch_assoc();
    $DeleteImagePath = $Row['Product Meta Value'];
    $DeleteImageQuery = "DELETE FROM postsmeta WHERE ID='$MetaID'";
    $DeleteImageQueryRun = mysqli_query($conn, $DeleteImageQuery);
    $Delete = unlink($base_url . $DeleteImagePath);
    if ($Delete && $DeleteImageQuery) {
        echo "Success";
    } else {
        echo "Fail";
    }
}
?>