<?php
header('Content-Type: application/json');
include("../lib/function.php");

$RentalManager = new RentalManager();
$response = array('status' => 'error');

if (isset($_POST['action']) && $_POST['action'] === 'submitTenantDetails') {
  $response = $RentalManager->addTenantDetails($_POST['Tenant_name'], $_POST['Room_number'], $_POST['Mobile_number'], $_POST['Permanent_address'], $_POST['Local_address'], $_POST['Aadhaar_number']);
} else {
  $response['message'] = 'Invalid action.';
}

echo json_encode($response);
?>