function AddTenant_details() {
  $("#Tenant_Details_responseMessage").html(''); // Clear previous messages

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
        $('#Tenant_Details_responseMessage').css('color', 'green').html('Tenant details submitted successfully.');
        $('#Tenant_details_form')[0].reset();
      } else {
        $('#Tenant_Details_responseMessage').css('color', 'red').html('Error submitting Tenant details. Please try again.');
      }
    },
    error: function() {
      $('#Tenant_Details_responseMessage').css('color', 'red').html('An unexpected error occurred.');
    }
  });

  return false;
}

function AddRentDetails() {
  $("#Rent_Details_responseMessage").html(''); // Clear previous messages

  var formData = $("#Rent_details_form").serialize();

  if (!$('#month_year').val().trim() || 
      !$('#rent_room_number').val().trim() || 
      !$('#water_front').val().trim() || 
      !$('#water_back').val().trim() || 
      !$('#eb_bill').val().trim() || 
      !$('#maintenance').val().trim() || 
      !$('#Notes').val().trim()) {
    alert('Please fill all required fields.');
    return false;
  }

  $.ajax({
    type: "POST",
    url: "ajax/ajaxcall.php",
    data: formData + "&action=SubmitAddrentDetails",
    dataType: "json",
    success: function(response) {
      if (response.status === 'success') {
        $('#Rent_Details_responseMessage')
          .css('color', 'green')
          .html('Rent details submitted successfully.');
        $('#Rent_details_form')[0].reset();
      } else {
        $('#Rent_Details_responseMessage')
          .css('color', 'red')
          .html('Error submitting rent details. Please try again.');
      }
    },
    error: function() {
      $('#Rent_Details_responseMessage')
        .css('color', 'red')
        .html('An unexpected error occurred.');
    }
  });

  return false;
}
