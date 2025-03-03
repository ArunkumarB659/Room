<?php
// Place this in lib/function.php
include("../config/db_connect.php");
include $_SERVER["DOCUMENT_ROOT"]."/home/config/db_connect.php";
class RentalManager {
//AddTenantDetails
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
//AddRentDetails
function addRentDetails($month_year, $rent_room_number, $water_front, $water_back, $eb_bill, $maintenance, $Notes) {
    global $con;
    $response = array();

    // Get the previous month's data
    $prev_month = date("Y-m", strtotime("$month_year -1 month"));

    // Fetch previous month's water readings
    $prev_month_sql = "SELECT water_front, water_back FROM Rent_details 
                       WHERE room_number = '$rent_room_number' 
                       AND month_year = '$prev_month' 
                       LIMIT 1"; 

    $prev_month_result = mysqli_query($con, $prev_month_sql);
    
    if ($prev_month_result && mysqli_num_rows($prev_month_result) > 0) {
        $prev_data = mysqli_fetch_assoc($prev_month_result);
        $prev_water_front = $prev_data['water_front'];
        $prev_water_back = $prev_data['water_back'];
    } else {
        // If no previous record exists, assume 0
        $prev_water_front = 0;
        $prev_water_back = 0;
    }

    // ✅ Calculate Water Reading
    $water_reading = ($water_front - $prev_water_front) + ($water_back - $prev_water_back);

    // ✅ Calculate Water Bill
    $water_bill = $water_reading * 10 * 0.175;

    // Insert new record with water_reading and water_bill
    $sql = "INSERT INTO Rent_details (month_year, room_number, water_front, water_back, eb_bill, maintenance, Notes, water_reading, water_bill) 
            VALUES ('$month_year', '$rent_room_number', '$water_front', '$water_back', '$eb_bill', '$maintenance', '$Notes', '$water_reading', '$water_bill')";

    if (mysqli_query($con, $sql)) {
        $response['status'] = 'success';
        $response['message'] = 'Rent details added successfully.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Database insertion failed.';
        $response['error'] = mysqli_error($con); // Debugging output
    }

    return json_encode($response);
}

}
?>
