function AddTenant_details() {
  $("#responseMessage").html(''); // Clear previous messages

  // Serialize form data
  var formData = $('#Tenant_details_form').serialize();

  // Basic validation (can be extended as needed)
  if (!$('#Tenant_name').val().trim() || !$('#Room_number').val().trim() || !$('#Mobile_number').val().trim() || !$('#Permanent_address').val() || !$('#Local_address').val() || !$('#Aadhaar_number').val()) {
    alert('Please fill all required fields.');
    return false;
  }

  $.ajax({
    type: "POST",
    url: "ajax/ajaxcall.php",
    data: formData + "&action=submitTenantDetails",
    dataType: "json",
    success: function(response) {
      if (response.status === 'success') {
        $('#responseMessage').css('color', 'green').html('Tenant details submitted successfully.');
        $('#Tenant_details_form')[0].reset();
      } else {
        $('#responseMessage').css('color', 'red').html('Error submitting Tenant details. Please try again.');
      }
    },
    error: function() {
      $('#responseMessage').css('color', 'red').html('An unexpected error occurred.');
    }
  });

  return false;
}