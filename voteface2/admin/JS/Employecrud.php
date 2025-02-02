<script>
    $("#insertdataform").submit(function (event) {
      event.preventDefault(); // Prevent the default form submission
  
      var formData = new FormData(this); // Create FormData object from the form
  
      $.ajax({
          url: 'php/Teaminsert.php', // URL to your PHP script
          type: 'POST', // The request method
          data: formData, // Send the form data including file
          contentType: false, // Do not modify the content type
          processData: false, // Do not process the data
          success: function (response) {
              console.log(response); // Debugging: Print the response for verification
  
              switch (response) {
                  case '1': // Success case
                      $('#insertdatamodel').modal('hide'); // Close the modal
                      $("#insertdataform")[0].reset(); // Reset the form
                      Content_list(); // Refresh the content list (if needed)
                      swal({
                          title: "Success!",
                          text: "Team added successfully!",
                          icon: "success",
                          button: "OK",
                      }).then(() => {
                          location.reload(); // Reload the page after success
                      });
                      break;
                  case '0': // Error case
                      swal("Error", "An error occurred while uploading the data.", "error");
                      break;
                  case '9': // Duplicate team name case
                      swal("Error", "Team name already exists.", "info");
                      break;
                  case '8': // Invalid image format
                      swal("Error", "Invalid image format. Only JPG, PNG, or JPEG are allowed.", "error");
                      break;
                  case '10': // Image size exceeds limit
                      swal("Error", "Image size exceeds 2MB.", "warning");
                      break;
                  case '7': // Missing required fields
                      swal("Error", "All fields are required.", "warning");
                      break;
                  default: // Fallback error case
                      swal("Error", "An unexpected error occurred. Please try again.", "error");
                      break;
              }
          },
          error: function (xhr, status, error) {
              console.error("Error Status: " + status);
              console.error("Error Thrown: " + error);
              alert("An error occurred: " + xhr.status + " " + error + ". Please try again.");
          }
      });
  });
  </script>
  