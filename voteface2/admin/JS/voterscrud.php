<script>
    $(document).ready(function () {
        // Initialize a basic DataTable with default settings
        $('#content').DataTable({
            pageLength: 10, // Number of entries to display by default
            lengthMenu: [10, 25, 50, 100], // Options for "Show X entries"
            columnDefs: [
                { targets: '_all', className: 'text-center' } // Align all columns to center
            ]
        });

        // Fetch and populate the data
        Content_list();
        $("#insertdataform").submit(function (event) {
    event.preventDefault(); // Prevent default form submission
    var formData = new FormData(this); // Create form data object

    $.ajax({
        url: 'php/VoterInsert.php', // PHP file to handle the insertion
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            switch (response) {
                case '1':
                    $('#insertdatamodel').modal('hide');
                    $("#insertdataform")[0].reset();
                    Content_list(); // Refresh the data table
                    swal("Good job!", "Voter added successfully!", "success");
                    break;
                case '5':
                    swal("Error", "Error uploading the image", "error");
                    break;
                case '6':
                    swal("Error", "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed", "error");
                    break;
                case '7':
                    swal("Error", "Missing required fields. Please fill all fields", "error");
                    break;
                case '8':
                    swal("Error", "No image uploaded or upload error occurred", "error");
                    break;
                case '9':
                    swal("Error", "Mobile number or Aadhar number already exists", "error");
                    break;
                default:
                    swal("Error", "Failed to add voter. Please try again", "error");
                    break;
            }
        },
        error: function (xhr, status, error) {
            console.error(error);
            swal("Error", "An error occurred. Please try again", "error");
        }
    });
});

     

        $(document).on('click', '.del_btn', function () {
            $('#del_id').val($(this).data('id')); // Set voter ID to hidden input for deletion 
        });

        // Update voter data
       

        // Delete voter
        $("#Deleteform").submit(function (event) {
            event.preventDefault(); // Prevent form submission

            var formData = new FormData(this); // Get form data
            $.ajax({
                url: 'php/VoterDelete.php', // PHP script to delete voter
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    switch (response) {
                        case '1':
                            $('#deletemodel').modal('hide');
                            $("#Deleteform")[0].reset();
                            Content_list(); // Refresh the list
                            swal("Deleted!", "Voter deleted successfully!", "success");
                            break;
                        case '0':
                            swal("Error", "Failed to delete voter", "error");
                            break;
                        default:
                            swal("Error", "Unknown error occurred", "error");
                            break;
                    }
                },
                error: function (xhr, status, error) {
                    console.log('Error:', error);
                    alert("An error occurred: " + error);
                }
            });
        });
    });

    // Function to fetch voter data and populate the table
    function Content_list() {
        $.ajax({
            url: 'php/VoterList.php', // PHP file to fetch voter data
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var tableBody = $("#content tbody");
                tableBody.empty(); // Clear the table before appending new data
                var html = '';
                var no = 1;

                $.each(data, function (index, voter) {
                    var status = voter.status == 1 ? 'Active' : 'Inactive';
                    var bgClass = voter.status == 1 ? 'success' : 'danger';

                    html += "<tr>" +
                        "<td>" + no + "</td>" +
                        "<td>" + voter.name + "</td>" +
                        "<td>" + voter.father_name + "</td>" +
                        "<td>" + voter.mobile_no + "</td>" +
                        "<td>" + voter.aadhar_no + "</td>" +
                        "<td><div class='text-center'><img src='votersimg/" + voter.voter_img + "' alt='Voter Image' style='max-width: 50px;'></div></td>" +                        
                        "<td class='text-center'>" +                        
                        "<i class='bi bi-trash3 del_btn mx-2' data-bs-toggle='modal' data-bs-target='#deletemodel' data-id='" + voter.id + "'></i>" +
                        "</td>" +
                        "</tr>";
                    no++;
                });

                tableBody.append(html);
                $('#content').DataTable().clear().draw();
                $('#content').DataTable().rows.add($(html)).draw();
            },
            error: function (xhr, status, error) {
                console.log('Error:', error);
            }
        });
    }
</script>
