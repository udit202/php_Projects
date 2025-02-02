<div class="modal fade z-4" id="insertdatamodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="insertdatamodel">Add Team</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="insertdataform" enctype="multipart/form-data">
                    <!-- Team Name -->
                    <div class="form-group mb-3">
                        <label for="employeeName" class="form-label">Team Name:</label>
                        <input type="text" class="form-control" name="name" id="employeeName" placeholder="Enter Team Name" required />
                    </div>

                    <!-- Team Logo -->
                    <div class="form-group mb-3">
                        <label for="logo" class="form-label">Team Logo :</label>
                        <input type="file" class="form-control" name="logo" id="logo" placeholder="Select Team Logo" required />
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add Team</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade z-4" id="editmodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editEmployeeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editEmployeeLabel">Edit Employee</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="updateform" enctype="multipart/form-data">
                    <!-- Hidden ID Field -->
                    <input type="hidden" name="id" id="Edit_id" required />

                    <!-- Employee Name -->
                    <div class="form-group mb-3">
                        <label for="editEmployeeName" class="form-label">Employee Name:</label>
                        <input type="text" class="form-control" name="name" id="editEmployeeName" placeholder="Update Employee Name" required />
                    </div>

                    <!-- Mobile Number -->
                    <div class="form-group mb-3">
                        <label for="editMobile" class="form-label">Mobile No:</label>
                        <input type="text" class="form-control" name="mobile" id="editMobile" placeholder="Update Mobile Number" required />
                    </div>

                    <!-- Gmail -->
                    <div class="form-group mb-3">
                        <label for="editGmail" class="form-label">Email (Gmail):</label>
                        <input type="email" class="form-control" name="gmail" id="editGmail" placeholder="Update Gmail" required />
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-3">
                        <label for="editStatus" class="form-label">Status:</label>
                        <select class="form-select" id="editStatus" name="status" required>
                            <option value="" selected disabled>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Team</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="Deleteform">
                    <div class="form-group">
                        <input type="number" class="form-control w-100" name="id" id="del_id" required hidden />
                        <h5 id=""> Are you sure you want to Delete this Team</h5>
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