<?php
header('Content-Type: application/json');
include("../lib/function.php");

$RentalManager = new RentalManager();
$response = array('status' => 'error');

if (isset($_POST['action']) && $_POST['action'] === 'submitRentalDetails') {
  $response = $RentalManager->addRental(
    $_POST['rNumber'],
    $_POST['tName'],
    $_POST['amount'],
    $_POST['month'],
    $_POST['ebBill'] ?? 0,
    $_POST['waterFront1'] ?? 0,
    $_POST['waterBack1'] ?? 0,
    $_POST['notes'] ?? ''
  );
} else {
  $response['message'] = 'Invalid action.';
}

echo json_encode($response);
?>