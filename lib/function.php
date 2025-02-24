<?php
// Place this in lib/function.php
include("../config/db_connect.php");
include $_SERVER["DOCUMENT_ROOT"]."/home/config/db_connect.php";
class RentalManager {
	
function addTenantDetails($Tenant_name, $Room_number, $Mobile_number, $Permanent_address, $Local_address, $Aadhaar_number) {
	global $con;
    $response = array();
    $sql = "INSERT INTO Tenant_details (Tenant_name, Room_number, Mobile_number, Permanent_address, Local_address, Aadhaar_number) VALUES ('$Tenant_name', '$Room_number', '$Mobile_number', '$Permanent_address', '$Local_address', '$Aadhaar_number')";
    if (mysqli_query($con,$sql)) {
      $response['status'] = 'success';
      $response['message'] = 'Tenant details added successfully.';
    } else {
      $response['message'] = 'Database insertion failed.';
	  echo "Error: " . mysqli_error($con); // This line will display the error in network response
    }
    return $response;
  }
}
?>
