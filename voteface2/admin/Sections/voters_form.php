<div class="modal fade z-4" id="insertdatamodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="insertdatamodel">Add Voter</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="insertdataform" enctype="multipart/form-data">
                    <!-- Voter Name -->
                    <div class="form-group mb-3">
                        <label for="voterName" class="form-label">Voter Name:</label>
                        <input type="text" class="form-control" name="name" id="voterName" placeholder="Enter Voter Name" required />
                    </div>

                    <!-- Father Name -->
                    <div class="form-group mb-3">
                        <label for="fatherName" class="form-label">Father Name:</label>
                        <input type="text" class="form-control" name="father_name" id="fatherName" placeholder="Enter Father Name" required />
                    </div>

                    <!-- Mobile Number -->
                    <div class="form-group mb-3">
                        <label for="mobile" class="form-label">Mobile No:</label>
                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile Number" required />
                    </div>

                    <!-- Aadhar Number -->
                    <div class="form-group mb-3">
                        <label for="aadharNo" class="form-label">Aadhar No:</label>
                        <input type="text" class="form-control" name="aadhar" id="aadharNo" placeholder="Enter Aadhar Number" required />
                    </div>

                    <!-- Voter Image -->
                    <div class="form-group mb-3">
                        <label for="voterImage" class="form-label">Voter Image:</label>
                        <input type="file" class="form-control" name="voter_img" id="voterImage" required />
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add Voter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade z-4" id="editmodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editVoterLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editVoterLabel">Edit Voter</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="updateform" enctype="multipart/form-data">
                    <!-- Hidden ID Field -->
                    <input type="hidden" name="id" id="Edit_id" required />

                    <!-- Voter Name -->
                    <div class="form-group mb-3">
                        <label for="editVoterName" class="form-label">Voter Name:</label>
                        <input type="text" class="form-control" name="name" id="editVoterName" placeholder="Update Voter Name" required />
                    </div>

                    <!-- Father Name -->
                    <div class="form-group mb-3">
                        <label for="editFatherName" class="form-label">Father Name:</label>
                        <input type="text" class="form-control" name="father_name" id="editFatherName" placeholder="Update Father Name" required />
                    </div>

                    <!-- Mobile Number -->
                    <div class="form-group mb-3">
                        <label for="editMobile" class="form-label">Mobile No:</label>
                        <input type="text" class="form-control" name="mobile" id="editMobile" placeholder="Update Mobile Number" required />
                    </div>

                    <!-- Aadhar Number -->
                    <div class="form-group mb-3">
                        <label for="editAadharNo" class="form-label">Aadhar No:</label>
                        <input type="text" class="form-control" name="aadhar" id="editAadharNo" placeholder="Update Aadhar Number" required />
                    </div>

                    <!-- Voter Image -->
                    <div class="form-group mb-3">
                        <label for="editVoterImage" class="form-label">Voter Image:</label>
                        <input type="file" class="form-control" name="voter_img" id="editVoterImage" />
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deletemodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Voter</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="Deleteform">
                    <div class="form-group">
                        <label for="id" class="form-label">Voter ID</label>
                        <input type="number" class="form-control w-100" name="id" id="del_id" required hidden />
                        <h5 id=""> Are you sure you want to delete this Voter?</h5>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
