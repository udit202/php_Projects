<script>
    $(document).ready(function() {
    // Initialize DataTable
    $('#content').DataTable();
    
    // Fetch and populate the table
    Content_list();

    // Event listener for the delete icon
    $(document).on('click', '.bi-trash3', function() {
        var teamId = $(this).data('id'); // Get the team ID from the data-id attribute
        $('#del_id').val(teamId); // Set the ID in the hidden input field in the modal
    });

    // Handle the deletion confirmation
    $('#Deleteform').submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        
        var teamId = $('#del_id').val(); // Get the team ID from the form input

        // AJAX request to delete the team
        $.ajax({
            url: 'php/Deleteteam.php', // PHP script to delete the team
            type: 'POST',
            data: { id: teamId }, // Send the team ID to the server
            success: function(response) {
                if (response == "1") {
                    $('#deletemodel').modal('hide'); // Hide the modal
                    Content_list(); // Reload the table
                    swal("Deleted!", "The team has been deleted.", "success"); // Show success message
                } else {
                    swal("Error", "There was an error deleting the team.", "error"); // Show error message
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                swal("Error", "An error occurred while deleting the team. Please try again.", "error");
            }
        });
    });
});

// Function to fetch team data and populate the table
function Content_list() {
    $.ajax({
        url: 'php/Teamlist.php', // URL to fetch data from
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var tableBody = $("#content tbody");
            tableBody.empty();  // Clear existing rows
            var html = '';
            var no = 1;

            $.each(data, function(index, team) {
                html += "<tr>" +
                        "<td class='text-center'>" + no + "</td>" +
                        "<td>" + team.name + "</td>" +
                        "<td><div class='text-center'><img src='uploads/" + team.logo + "' alt='" + team.name + " Logo' style='max-width: 50px;'></div></td>" +
                        "<td class='text-center'>" +
                        
                        "<i class='bi bi-trash3 mx-2' style='color:red; cursor:pointer' data-id='" + team.id + "' data-bs-toggle='modal' data-bs-target='#deletemodel'></i>" +
                        "</td>" +
                        "</tr>";
                no++;
            });

            tableBody.append(html);
            $('#content').DataTable().clear().draw();
            $('#content').DataTable().rows.add($(html)).draw();
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

</script>