<?php
// Place this in lib/function.php
include("../config/db_connect.php");
include $_SERVER["DOCUMENT_ROOT"]."/home/config/db_connect.php";
class RentalManager {
	
function addRental($rNumber, $tName, $amount, $month, $ebBill, $waterFront1, $waterBack1, $notes) {
	global $con;
    $response = array();
    $sql = "INSERT INTO rental_details (room_number, tenant_name, rent_amount, month, eb_bill, water_front_1, water_back_1, notes) VALUES ('$rNumber', '$tName', '$amount', '$month', '$ebBill', '$waterFront1', '$waterBack1', '$notes')";
    if (mysqli_query($con,$sql)) {
      $response['status'] = 'success';
      $response['message'] = 'Rental details added successfully.';
    } else {
      $response['message'] = 'Database insertion failed.';
    }
    return $response;
  }
}
?>
