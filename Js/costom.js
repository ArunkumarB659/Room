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
		console.log("AJAX Response:", response);
      if (response.status == 'success') 
	  {
        $('#Tenant_Details_responseMessage').css('color', 'green').html('Tenant details submitted successfully.');
        $('#Tenant_details_form')[0].reset();
      } else {
        $('#Tenant_Details_responseMessage').css('color', 'red').html('Error submitting Tenant details. Please try again.');
      }
    },

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
		
      if (response.status == 'success') {
		  alert('Product added successfully');
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

function GetRentDetails() {
    $.ajax({
        type: "POST",
        data: { action: "GetRentDetails" }, // Send as an object
        url: "ajax/ajaxcall.php",
        dataType: "json", // Expect JSON response
        success: function(response) {
            if (Array.isArray(response)) {
                let tableRows = '';
                response.forEach(row => {
                    tableRows += `<tr>
						<td>${row.id}</td>
						<td>${row.room_number}</td>
                        <td>${row.month_year}</td>
                        <td>${row.water_front}</td>
                        <td>${row.water_back}</td>
                        <td>${row.eb_bill}</td>
                        <td>${row.maintenance}</td>
                        <td>${row.Notes}</td>
                        <td>${row.water_bill}</td>
						<td><button>eb_bill</button></td>
                    </tr>`;
                });
                $('#rentTableBody').html(tableRows); // Insert table rows
            } else {
                console.error("Invalid data format:", response);
                $('#rentTableBody').html('<tr><td colspan="8">Error loading data</td></tr>');
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
            $('#rentTableBody').html('<tr><td colspan="8">Failed to fetch data</td></tr>');
        }
    });
}

  
  