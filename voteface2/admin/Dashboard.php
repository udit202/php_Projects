<?php
$title ="Dashboard";
require 'Sections/Admin_header.php';
require '../conn.php';

?>
<div class="row mt-2 me-2 w-100">
    <div class="col-6">
        <h3 style="color: navy; font-family: 'Times New Roman', Times, serif; text-transform: uppercase;">Dashboard </h3>
    </div>
    <div class="col-6 text-end">
        <button class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#insertdatamodel">
            ADD
        </button>

    </div>
</div>
<hr style="color:navy; " />

<div class="row d-flex justify-content-evenly my-2">
<?php
// Assuming you have a database connection in 'conn.php'
require 'php/conn.php';

// Step 1: Fetch all teams from the team table
$sql = "SELECT id, name, logo FROM team";
$teamsResult = $conn->query($sql);

// Check if there are any teams
if ($teamsResult->num_rows > 0) {
    // Step 2: Loop through each team and fetch the vote count based on matching id
    while ($teamRow = $teamsResult->fetch_assoc()) {
        $teamId = $teamRow['id'];
        $teamName = $teamRow['name'];
        $teamLogo = $teamRow['logo']; // Assuming the logo is stored as a file name

        // Step 3: Get the vote count for the current team
        $voteSql = "SELECT COUNT(*) AS total_votes FROM vote WHERE vote_to = $teamId";
        $voteResult = $conn->query($voteSql);
        
        if ($voteResult) {
            $voteRow = $voteResult->fetch_assoc();
            $totalVotes = $voteRow['total_votes'];
        } else {
            $totalVotes = 0; // If no votes are found, set to 0
        }

        // Step 4: Output the team details with vote count
        echo '
        <div class="col-md-4 mt-3">
            <div class="p-2 shadow rounded">
                <h1 class="fs-4"><i class="bi bi-microsoft-teams mx-2 text-danger"></i>' . htmlspecialchars($teamName) . '</h1>
                <div class="row">
                <div class="col-4">
                <img src="uploads/' . htmlspecialchars($teamLogo) . '" alt="' . htmlspecialchars($teamName) . ' Logo" class="img-fluid mb-3 w-100" >
                </div>
                <div class="col-8">
                <h2 class="m-3 ms-md-5 fs-3 text-center">
                    ' . htmlspecialchars($totalVotes) . ' <br>Votes
                </h2>
                </div>
                </div>
                
                
            </div>
        </div>';
    }
} else {
    echo 'No teams found.';
}

$conn->close();
?>



   
    
</div>

<?php
$model='Sections/Employeeforms.php';
$script ='JS/Employecrud.php';
require 'Sections/Admin_footer.php';
?>
