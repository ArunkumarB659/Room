function submitRentalDetails() {
  $("#responseMessage").html(''); // Clear previous messages

  // Serialize form data
  var formData = $('#rentalForm').serialize();

  // Basic validation (can be extended as needed)
  if (!$('#rNumber').val().trim() || !$('#tName').val().trim() || !$('#amount').val().trim() || !$('#month').val()) {
    alert('Please fill all required fields.');
    return false;
  }

  $.ajax({
    type: "POST",
    url: "ajax/ajaxcall.php",
    data: formData + "&action=submitRentalDetails",
    dataType: "json",
    success: function(response) {
      if (response.status === 'success') {
        $('#responseMessage').css('color', 'green').html('Rental details submitted successfully.');
        $('#rentalForm')[0].reset();
      } else if (response.status === 'exists') {
        $('#responseMessage').css('color', 'orange').html('Rental details for this R Number already exist.');
      } else {
        $('#responseMessage').css('color', 'red').html('Error submitting rental details. Please try again.');
      }
    },
    error: function() {
      $('#responseMessage').css('color', 'red').html('An unexpected error occurred.');
    }
  });

  return false;
}