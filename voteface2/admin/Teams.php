<?php
$title ="Employees List";
require 'Sections/Admin_header.php';
?>
<div class="row mt-2 me-2 w-100">
    <div class="col-6">
        <h3 style="color: navy; font-family: 'Times New Roman', Times, serif; text-transform: uppercase;">Teams </h3>
    </div>
    <div class="col-6 text-end">
        <button class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#insertdatamodel">
            ADD
        </button>

    </div>
</div>
<hr style="color:navy; " />

<table id="content" class="display w-100">
    <thead>
        <tr>
            <th class="text-center">NO:</th>
            <th class="text-start">Name</th>
            <th class="text-center">logo </th>
            <th class="text-center">Operations</th>
        </tr>
    </thead>
    <tbody>
    </tbody>

</table>

<?php
$model='Sections/Employeeforms.php';
$script ='JS/Teamcrud.php';
require 'Sections/Admin_footer.php';
?>