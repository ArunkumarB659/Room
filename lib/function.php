<?php
// Place this in lib/function.php
include("../config/db_connect.php");

class RentalManager {
  private $conn;

  public function __construct() {
    global $conn;
    $this->conn = $conn;
  }

  public function addRental($rNumber, $tName, $amount, $month, $ebBill, $waterFront1, $waterBack1, $notes) {
    $response = array('status' => 'error');

    if (empty($rNumber) || empty($tName) || empty($amount) || empty($month)) {
      $response['message'] = 'Required fields are missing.';
      return $response;
    }

    $checkQuery = "SELECT id FROM rentals WHERE r_number = ? AND month = ?";
    $stmt = $this->conn->prepare($checkQuery);
    $stmt->bind_param("ss", $rNumber, $month);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $response['status'] = 'exists';
      $response['message'] = 'Rental details already exist for this R Number and month.';
      $stmt->close();
      return $response;
    }
    $stmt->close();

    $insertQuery = "INSERT INTO rentals (r_number, t_name, amount, month, eb_bill, water_front1, water_back1, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($insertQuery);
    $stmt->bind_param("ssdssdds", $rNumber, $tName, $amount, $month, $ebBill, $waterFront1, $waterBack1, $notes);

    if ($stmt->execute()) {
      $response['status'] = 'success';
      $response['message'] = 'Rental details added successfully.';
    } else {
      $response['message'] = 'Database insertion failed.';
    }

    $stmt->close();
    return $response;
  }
}
?>
