<?php if ($this->session->userdata('acct_type') == 'admin_super' || $this->session->userdata('acct_type') == 'admin_south' || $this->session->userdata('acct_type') == 'admin_north') {
    $this->load->view('Admin/common/header');
} else if ($this->session->userdata('acct_type') == 'PO') {
    $this->load->view('project_officer/common/header');
} else if ($this->session->userdata('acct_type') == 'SO_RECORD') {
    $this->load->view('so_record/common/header');
} else if ($this->session->userdata('acct_type') == 'SO_CW') {
    $this->load->view('so_cw/common/header');
} else if ($this->session->userdata('acct_type') == 'SO_STORE') {
    $this->load->view('so_store/common/header');
} ?>

<style>
    .red-border {
        border: 1px solid red !important;
    }

    .modal {
        display: none;
        position: fixed;
        padding-top: 100px;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        overflow: auto;
        z-index: 9999;
    }
</style>

<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 my-2">
        <h1 class="h3 mb-0 text-black-800"></h1>
        <a onclick="location.href='<?php echo base_url(); ?>Project_Officer/report_projects'" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-print text-white-50"></i> Print Page</a>
    </div>

    <div class="card o-hidden my-4 border-0 shadow-lg">

        <div class="modal fade" id="new_bids">
            <!-- <div class="row"> -->
            <div class="modal-dialog modal-dialog-centered " style="margin-left: 370px;" role="document">
                <div class="modal-content bg-custom3" style="width:1000px;">
                    <div class="modal-header" style="width:1000px;">

                    </div>
                    <div class="card-body bg-custom3">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-header bg-custom1">
                                        <h1 class="h4">Enter Project Bids</h1>
                                    </div>

                                    <div class="card-body bg-custom3">
                                        <form class="user" role="form" method="post" id="add_form_bids" action="<?= base_url(); ?>Project_Officer/insert_project_bids">

                                            <div class="add_rows" id="add_bid_rows">
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <h6>&nbsp;Contractor:</h6>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <h6>&nbsp;Bid Amount</h6>
                                                    </div>

                                                    <div class="col-sm-3">

                                                    </div>

                                                    <div class="col-sm-2">
                                                        Add New Row
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <i id="add_row" type="button" class="far fa-plus-square" style="font-size:25px; margin-top:2px"></i>
                                                    </div>

                                                </div>


                                                <div class="form-group row">
                                                    <div class="col-sm-3 mb-1">
                                                        <select class="form-control rounded-pill" name="contractor[]" id="contractor" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                                            <option class="form-control form-control-user" value="">Select Contractor Name</option>
                                                            <?php foreach ($contractor_name as $contractor) { ?>
                                                                <option class="form-control form-control-user" value="<?= $contractor['ID'] ?>"><?= $contractor['Name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-3 mb-1">
                                                        <input type="number" class="form-control form-control-user" name="bid_amount[]" id="bid_amount" placeholder="Bid Amount">
                                                    </div>

                                                    <div class="col-sm-3 mb-1" style="display:none">
                                                        <input type="text" class="form-control form-control-user" name="project_id_on_bid" id="project_id_on_bid">
                                                    </div>


                                                </div>
                                            </div>
                                            <input type="hidden" name="Name_of_Project" id="Name_of_Project" value="">
                                            <div class="form-group row justify-content-center">
                                                <div class="col-sm-4">
                                                    <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn_bids" name="add_btn_bids">
                                                        Submit & Return
                                                        <span><i class="fas fa-sign-in-alt"></i></span>
                                                    </button>
                                                    <span id="show_error_new" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="new_project">
            <!-- <div class="row"> -->
            <div class="modal-dialog modal-dialog-centered " style="margin-left: 370px;" role="document">
                <div class="modal-content bg-custom3" style="width:1000px;">
                    <div class="modal-header" style="width:1000px;">
                    </div>
                    <div class="card-body bg-custom3">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-header bg-custom1">
                                        <h1 class="h4">Add New Project</h1>
                                    </div>

                                    <div class="card-body bg-custom3">
                                        <form class="user" role="form" method="post" id="add_form" action="<?= base_url(); ?>Project_Officer/insert_project">
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <h6>&nbsp;Name:</h6>
                                                </div>

                                                <div class="col-sm-4">
                                                    <h6>&nbsp;Code:</h6>
                                                </div>

                                                <div class="col-sm-4">
                                                    <h6>&nbsp;Start Date:</h6>
                                                </div>

                                                <!-- <div class="col-sm-3">
                                                     <h6>&nbsp;End Date:</h6>
                                                 </div> -->

                                            </div>


                                            <div class="form-group row">
                                                <div class="col-sm-4 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="project_name" id="project_name" placeholder="Project Name">
                                                    <span id="show_project_name_error" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please enter project name & code first</span>
                                                </div>

                                                <div class="col-sm-4 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="code" id="code" placeholder="Project Code.">
                                                </div>

                                                <div class="col-sm-4 mb-1">
                                                    <input type="date" class="form-control form-control-user" name="start_date" id="start_date" placeholder="Start Date">
                                                    <!--  <span id="show_error_email" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;not valid email id</span> -->
                                                </div>

                                                <!-- <div class="col-sm-3 mb-1">
                                                     <input type="date" class="form-control form-control-user" name="end_date" id="end_date" placeholder="End Date">
                                                      <span id="show_error_email" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;not valid email id</span>
                                                 </div> -->


                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <h6>&nbsp;Assigned Bid:</h6>
                                                </div>
                                                <!-- <div class="col-sm-3">
                                                     <h6>&nbsp;Created By:</h6>
                                                 </div> -->
                                                <div class="col-sm-4">
                                                    <h6>&nbsp;Total Cost:</h6>
                                                </div>

                                                <div class="col-sm-4">
                                                    <h6>&nbsp;Status:</h6>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <!--  <div class="col-sm-3">
                                                     <select class="form-control rounded-pill" name="contractor" id="contractor" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                                         <option class="form-control form-control-user" value="">Select Contractor Name</option>
                                                         <?php foreach ($contractor_name as $contractor) { ?>
                                                             <option class="form-control form-control-user" value="<?= $contractor['ID'] ?>"><?= $contractor['Name'] ?></option>
                                                         <?php } ?>
                                                     </select>
                                                 </div> -->
                                                <div class="col-sm-3 mb-1">
                                                    <!--  <input type="text" class="form-control form-control-user" name="bid_amount" id="bid_amount" placeholder="Select Bids" disabled="true"> -->

                                                    <select class="form-control rounded-pill" name="assign_bid" id="assign_bid" data-placeholder="Select Bid" style="font-size: 0.8rem; height:50px;">
                                                        <option class="form-control form-control-user" value="">Select Bid</option>
                                                    </select>
                                                </div>

                                                <div class="col-sm-1 mb-1">
                                                    <span><a href="#"><i class="fas fa-folder-plus" type="" data-toggle="modal" data-target="#new_bids1" id="add_bids" style="font-size: 40px; margin-top:2px; color:black"></i></a></span>
                                                </div>

                                                <div class="col-sm-4 mb-1" style="display:none">
                                                    <input type="text" class="form-control form-control-user" name="created_by" id="created_by" placeholder="Created By." value="<?= $this->session->userdata('username'); ?>" readonly="true">
                                                </div>

                                                <div class="col-sm-4 mb-1">
                                                    <input type="number" class="form-control form-control-user" name="total_cost" id="total_cost" placeholder="Total Cost">
                                                    <!--  <span id="show_error_email" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;not valid email id</span> -->
                                                </div>

                                                <div class="col-sm-4 mb-1">
                                                    <select class="form-control rounded-pill" name="status" id="status" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                                        <option class="form-control form-control-user" value="">Select Status</option>
                                                        <option class="form-control form-control-user" value="On-going">On going</option>
                                                        <option class="form-control form-control-user" value="Initiated">Initiated</option>
                                                        <option class="form-control form-control-user" value="Closed">Closed</option>
                                                        <option class="form-control form-control-user" value="Completed">Completed</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="form-group row justify-content-center">
                                                <div class="col-sm-4">
                                                    <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn">
                                                        <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                        Submit
                                                    </button>
                                                    <span id="show_error_new" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit_project">
            <!-- <div class="row"> -->
            <div class="modal-dialog modal-dialog-centered " style="margin-left: 370px;" role="document">
                <div class="modal-content bg-custom3" style="width:1000px;">
                    <div class="modal-header" style="width:1000px;">

                    </div>
                    <div class="card-body bg-custom3">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-header bg-custom1">
                                        <h1 class="h4">Update Project</h1>
                                    </div>

                                    <div class="card-body bg-custom3">
                                        <form class="user" role="form" method="post" id="edit_form" action="<?= base_url(); ?>Project_Officer/edit_project">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <h3 id="project_name_heading"></h3>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <h6>&nbsp;Start Date:</h6>
                                                </div>

                                                <div class="col-sm-4">
                                                    <h6>&nbsp;End Date:</h6>
                                                </div>

                                                <div class="col-sm-4">
                                                    <h6>&nbsp;Assigned Bid</h6>
                                                </div>

                                            </div>

                                            <div class="form-group row">

                                                <div class="col-sm-3 mb-1" style="display:none">
                                                    <input type="text" class="form-control form-control-user" name="project_id_edit" id="project_id_edit">
                                                </div>

                                                <div class="col-sm-3 mb-1" style="display:none">
                                                    <input type="text" class="form-control form-control-user" name="project_name" id="project_name">
                                                </div>

                                                <div class="col-sm-4 mb-1">
                                                    <input type="date" class="form-control form-control-user" name="project_start_date_edit" id="project_start_date_edit" placeholder="Start Date">
                                                </div>

                                                <div class="col-sm-4 mb-1">
                                                    <input type="date" class="form-control form-control-user" name="project_end_date_edit" id="project_end_date_edit" placeholder="End Date*" value="">
                                                </div>

                                                <div class="col-sm-4 mb-1">
                                                    <select class="form-control rounded-pill" name="project_bid_edit" id="project_bid_edit" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                                        <option class="form-control form-control-user" value="">Select Bid</option>
                                                        <?php foreach ($bids as $data) { ?>
                                                            <option class="form-control form-control-user" value="<?= $data['id'] ?>"><?= $data['Name'] ?> : <?= $data['bid_amount'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <h6>&nbsp;Contractor:</h6>
                                                </div>
                                                <!-- <div class="col-sm-3">
                                                     <h6>&nbsp;Created By:</h6>
                                                 </div> -->
                                                <div class="col-sm-4">
                                                    <h6>&nbsp;Total Cost:</h6>
                                                </div>

                                                <div class="col-sm-4">
                                                    <h6>&nbsp;Status:</h6>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <select class="form-control rounded-pill" name="contractor_edit" id="contractor_edit" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                                        <option class="form-control form-control-user" value="">Select Contractor Name</option>
                                                        <?php foreach ($contractor_name as $contractor) { ?>
                                                            <option class="form-control form-control-user" value="<?= $contractor['ID'] ?>"><?= $contractor['Name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="col-sm-4 mb-1">
                                                    <input type="number" class="form-control form-control-user" name="total_cost_edit" id="total_cost_edit" placeholder="Total Cost">
                                                    <!--  <span id="show_error_email" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;not valid email id</span> -->
                                                </div>

                                                <div class="col-sm-4 mb-1" style="display:none">
                                                    <input type="text" class="form-control form-control-user" name="created_by" id="created_by" placeholder="Created By." value="<?= $this->session->userdata('username'); ?>" readonly="true">
                                                </div>

                                                <div class="col-sm-4 mb-1">
                                                    <select class="form-control rounded-pill" name="status_edit" id="status_edit" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                                        <option class="form-control form-control-user" value="">Select Status</option>
                                                        <option class="form-control form-control-user" value="On-going">On Going</option>
                                                        <option class="form-control form-control-user" value="Initiated">Initiated</option>
                                                        <option class="form-control form-control-user" value="Closed">Closed</option>
                                                        <option class="form-control form-control-user" value="Completed">Completed</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="form-group row justify-content-center">
                                                <div class="col-sm-4">
                                                    <button type="button" class="btn btn-primary btn-user btn-block" id="edit_btn" data-dismiss="modal">
                                                        <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                        Update Project
                                                    </button>
                                                    <span id="show_error_update" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body bg-custom3">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">

                    <div class="alert alert-success" role="alert" style="display:none">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Success!</strong> Material Quantity updated successfully!
                    </div>

                    <div class="card bg-custom3">
                        <div class="card-header bg-custom1">
                            <h1 class="h4">Projects</h1>
                        </div>

                        <div class="card-body">
                            <div id="table_div">
                                <?php if (count($project_records) > 0) { ?>
                                    <table id="datatable" class="table table-striped" style="color:black">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Project Name</th>
                                                <th scope="col">Start Date</th>
                                                <th scope="col">End Date</th>
                                                <th scope="col">Total Cost</th>
                                                <th scope="col">Status</th>
                                                <?php $acct_type = $this->session->userdata('acct_type');
                                                if ($acct_type != "admin_super") {
                                                    if ($acct_type != "admin_north") {
                                                        if ($acct_type != "admin_south") { ?>
                                                            <th scope="col">Edit Project</th>
                                                <?php }
                                                    }
                                                } ?>
                                                <th scope="col" style="display:none">Contractor ID</th>
                                                <th scope="col" style="display:none">Bid ID</th>
                                                <?php if ($acct_type == "admin_super") { ?>
                                                    <th scope="col">Region</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody id="table_rows_project">
                                            <?php $count = 1;
                                            foreach ($project_records as $data) { ?>
                                                <tr>
                                                    <td scope="row" id="cont<?= $count; ?>"><?= $data['ID']; ?></td>
                                                    <td style="width:150px;" scope="row"><a style="color:black; font-weight:800;" href="<?= base_url() ?>Project_Officer/overview/<?= $data['ID'] ?>"><?= $data['Name']; ?></a></td>
                                                    <td id="quant<?= $data['ID']; ?>" class="quant" scope="row"><?= $data['Start_date']; ?></td>
                                                    <td scope="row"><?= $data['End_date']; ?></td>
                                                    <td style="width:150px" scope="row"><?= $data['Total_Cost']; ?></td>
                                                    <td style="width:150px" scope="row"><?= $data['Status']; ?></td>
                                                    <?php $acct_type = $this->session->userdata('acct_type');
                                                    if ($acct_type != "admin_super") {
                                                        if ($acct_type != "admin_north") {
                                                            if ($acct_type != "admin_south") { ?>
                                                                <td style="width:120px" type="button" id="edit<?= $data['ID']; ?>" class="edit" scope="row" data-toggle="modal" data-target="#edit_project"><i style="margin-left: 40px;" class="fas fa-edit"></i></td>
                                                    <?php }
                                                        }
                                                    } ?>
                                                    <td scope="row" style="display:none;"><?= $data['contractor_id']; ?></td>
                                                    <td scope="row" style="display:none;"><?= $data['bid_id']; ?></td>
                                                    <?php if ($acct_type == "admin_super") { ?>
                                                        <td scope="row"><?= $data['region']; ?></td>
                                                    <?php } ?>
                                                </tr>
                                            <?php
                                                $count++;
                                            } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <a> No Data Available yet </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php $acct_type = $this->session->userdata('acct_type');
                    if ($acct_type != "admin_super") { ?>
                        <?php if ($acct_type != "admin_north") { ?>
                            <?php if ($acct_type != "admin_south") { ?>
                                <form class="user" role="form" method="post" id="add_form" action="">
                                    <div class="form-group row my-2 justify-content-center">
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn" data-toggle="modal" data-target="#new_project">
                                                <i class="fas fa-plus"></i>
                                                Add new Project
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

</div>


<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url('assets/js/chat/chat.js'); ?>"></script>
<script>
    window.onload = function() {

    }

    $('#table_rows_project').find('tr').click(function(e) {
        var $columns = $(this).find('td');

        $('#project_name_heading').html('<strong>' + $columns[1].innerHTML + '</strong>');
        $('#project_name').val($columns[1].innerHTML);
        $('#project_id_edit').val($columns[0].innerHTML);
        $('#project_start_date_edit').val($columns[2].innerHTML);
        $('#project_end_date_edit').val($columns[3].innerHTML);
        $('#total_cost_edit').val($columns[4].innerHTML);
        $('#status_edit').val($columns[5].innerHTML);
        $('#contractor_edit').val($columns[7].innerHTML);
        $('#project_bid_edit').val($columns[8].innerHTML);

    });

    $('#add_bids').on('click', function() {
        var name = $('#project_name').val();
        var code = $('#code').val();
        if (name == '') {
            validate = 1;
            $('#project_name').addClass('red-border');
            $('#show_project_name_error').show();
        } else {
            validate = 0;
            $('#project_name').removeClass('red-border');
            $('#show_project_name_error').hide();
        }
        if (code == '') {
            validate = 1;
            $('#code').addClass('red-border');
        } else {
            validate = 0;
            $('#code').removeClass('red-border');
        }

        if (validate == 1) {

        } else {
            var btn = document.getElementById('add_bids');
            btn.dataset.target = "#new_bids";

            $.ajax({
                url: '<?= base_url(); ?>Project_Officer/insert_project_initial',
                method: 'POST',
                data: {
                    'project_name': name,
                    'project_code': code
                },
                success: function(data) {
                    document.getElementById("project_id_on_bid").value = data;
                },
                async: true
            });

        }

    });

    $('#add_btn').on('click', function() {
        var name = $('#project_name').val();
        var code = $('#code').val();
        if (name == '') {
            validate = 1;
            $('#project_name').addClass('red-border');
            $('#show_project_name_error').show();
        } else {
            validate = 0;
            $('#project_name').removeClass('red-border');
            $('#show_project_name_error').hide();
        }
        if (code == '') {
            validate = 1;
            $('#code').addClass('red-border');
        } else {
            validate = 0;
            $('#code').removeClass('red-border');
        }

        if (validate == 1) {

        } else {
            var btn = document.getElementById('add_bids');
            btn.dataset.target = "#new_bids";

            $.ajax({
                url: '<?= base_url(); ?>Project_Officer/insert_project_initial',
                method: 'POST',
                data: {
                    'project_name': name,
                    'project_code': code
                },
                success: function(data) {
                    document.getElementById("project_id_on_bid").value = data;
                },
                async: true
            });

        }

    });

    var loop = 1;
    //  var row_count

    $("#add_row").click(function() {

        loop = parseInt(document.getElementById('add_bid_rows').childNodes.length / 3);

        $("#add_bid_rows").append(`<div class="form-group row" id="add_bid_head${loop}">
                                        <div class="col-sm-3">
                                            <h6>&nbsp;Contractor:</h6>
                                        </div>

                                        <div class="col-sm-3">
                                            <h6>&nbsp;Bid Amount</h6>
                                        </div>

                                    </div>

                                    <div class="form-group row" id="add_bid_rows${loop}">
                                        <div class="col-sm-3 mb-1">
                                            <select class="form-control rounded-pill" name="contractor[]" id="contractor" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                                <option class="form-control form-control-user" value="">Select Contractor Name</option>
                                                <?php foreach ($contractor_name as $contractor) { ?>
                                                    <option class="form-control form-control-user" value="<?= $contractor['ID'] ?>"><?= $contractor['Name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control form-control-user" name="bid_amount[]" id="bid_amount" placeholder="Bid Amount">
                                        </div>

                                        <div class="col-sm-3 mb-1">
                                            <span><a href="#" type="button" onclick="deleteRow(${loop})" id="delete_row${loop}"><i class="fas fa-trash-alt" style="margin-top:15px; color:black"></i></a></span>
                                        </div>
                                        
                                    </div>`);
        loop++;
    });

    function deleteRow(elmnt) {
        var elh = document.getElementById('add_bid_head' + elmnt);
        var elr = document.getElementById('add_bid_rows' + elmnt);
        elh.remove();
        elr.remove();
    }

    var elementClicked;

    $('#new_bids').on('hide.bs.modal', function() {
        if (elementClicked != true) {
            var project_id = $('#project_id_on_bid').val();
            $.ajax({
                url: '<?= base_url(); ?>Project_Officer/delete_project',
                method: 'POST',
                //  type:'json',
                data: {
                    'id': project_id
                },
                success: function(response) {},
                async: false
            });
        }
    });

    $('#add_btn_bids').on('click', function() {

        var validate = 0;
        elementClicked = true;

        var project_id = $('#project_id_on_bid').val();

        var contractor = $('#contractor').val();
        var bid_amount = $('#bid_amount').val();

        var contractor_arr = $("select[name='contractor[]']").map(function() {
            return $(this).val();
        }).get();
        var bid_amount_arr = $("input[name='bid_amount[]']").map(function() {
            return $(this).val();
        }).get();

        if (contractor == '') {
            validate = 1;
            $('#contractor').addClass('red-border');
        }
        if (bid_amount == '') {
            validate = 1;
            $('#bid_amount').addClass('red-border');
        }

        if (validate == 0) {
            $.ajax({
                url: '<?= base_url(); ?>Project_Officer/insert_project_bids',
                method: 'POST',
                //  type:'json',
                data: {
                    'id': project_id,
                    'contractor': contractor_arr,
                    'bid_amount': bid_amount_arr

                },
                success: function(response) {

                },
                async: false
            });

            $.ajax({
                url: '<?= base_url(); ?>Project_Officer/add_bids_values',
                method: 'POST',
                //  type:'json',
                data: {
                    'id': project_id
                },
                success: function(response) {
                    var result = jQuery.parseJSON(response);
                    var len = response.length;

                    $("#assign_bid").empty();
                    $("#bid_amount").empty();
                    $('#bid_amount').removeAttr('disabled');

                    for (var i = 0; i < len; i++) {
                        var ID = result[i]['id'];
                        var contractor_name = result[i]['Name'];
                        var bid_amount = result[i]['bid_amount'];
                        var str = contractor_name + ' : ' + bid_amount;
                        //  alert(id + '---' + amount);
                        $("#assign_bid").append(`<option value="${ID}">
                                                        ${str}
                                                    </option>`);

                    }
                },
                async: false
            });

            //  $('#add_form_bids')[0].submit();
            $('#show_error_new').hide();
            $('#new_bids').modal('hide');


        } else {
            $('#add_btn_bids').removeAttr('disabled');
            $('#show_error_new').show();
        }
    });

    $('#add_btn').on('click', function() {

        $('#add_btn').attr('disabled', true);
        var validate = 0;

        var name = $('#project_name').val();
        var code = $('#code').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var assigned_bid = $('#assign_bid');

        var created_by = $('#created_by').val();
        var cost = $('#total_cost').val();
        var status = $('#status').val();

        if (name == '') {
            validate = 1;
            $('#project_name').addClass('red-border');
        }
        if (code == '') {
            validate = 1;
            $('#code').addClass('red-border');
        }
        if (start_date == '') {
            validate = 1;
            $('#start_date').addClass('red-border');
        }
        if (assigned_bid == '') {
            validate = 1;
            $('#assign_bid').addClass('red-border');
        }

        if (end_date == '') {
            validate = 1;
            $('#end_date').addClass('red-border');
        }
        if (created_by == '') {
            validate = 1;
            $('#created_by').addClass('red-border');
        }
        if (cost == '') {
            validate = 1;
            $('#total_cost').addClass('red-border');
        }
        if (status == '') {
            validate = 1;
            $('#status').addClass('red-border');
        }


        if (validate == 0) {
            $('#add_form')[0].submit();
            $('#show_error_new').hide();
        } else {
            $('#add_btn').removeAttr('disabled');
            $('#show_error_new').show();
        }
    });

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    $('#edit_btn').on('click', function() {
        //  alert('javascript working');
        $('#edit_btn').attr('disabled', true);
        var validate = 0;

        var start_end = $('#project_start_date_edit').val();
        var end_date = $('#project_end_date_edit').val();
        var cost = $('#total_cost_edit').val();
        var status = $('#status_edit').val();
        var contractor = $('#contractor_edit').val();
        var bid_id = $('#project_bid_edit').val();

        if (start_end == '') {
            validate = 1;
            $('#project_start_date_edit').addClass('red-border');
        }
        if (end_date == '') {
            validate = 1;
            $('#project_end_date_edit').addClass('red-border');
        }
        if (cost == '') {
            validate = 1;
            $('#total_cost_edit').addClass('red-border');
        }
        if (status == '') {
            validate = 1;
            $('#status_edit').addClass('red-border');
        }
        if (contractor == '') {
            validate = 1;
            $('#contractor_edit').addClass('red-border');
        }

        if (validate == 0) {
            $('#edit_form')[0].submit();
            $('#show_error_update').hide();
        } else {
            $('#edit_btn').removeAttr('disabled');
            $('#show_error_update').show();
        }
    });

    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).on('show.bs.modal', '.modal', function() {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });

    $(document).on('hide.bs.modal', '#new_project', function() {
        var project_id = $('#project_id_on_bid').val();
        //alert(project_id);
        var name = $('#project_name').val();
        var code = $('#code').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var assigned_bid = $('#assign_bid');
        //var contractor_name = $('#contractor').val();
        var created_by = $('#created_by').val();
        var cost = $('#total_cost').val();
        var status = $('#status').val();

        if (name == null || code == null || start_date == null || end_date == null ||
            assign_bid == null || created_by == null || cost == null || status == null) {

            if (code != null) {
                $.ajax({
                    url: '<?= base_url(); ?>Project_Officer/delete_project_code',
                    method: 'POST',
                    //  type:'json',
                    data: {
                        // 'id': project_id
                        'code': code
                    },
                    success: function(response) {

                    },
                    async: false
                });
            } else if (name != null) {
                $.ajax({
                    url: '<?= base_url(); ?>Project_Officer/delete_project_by_name',
                    method: 'POST',
                    data: {
                        'name': name
                    },
                    success: function(response) {

                    },
                    async: false
                });
            } else {
                $.ajax({
                    url: '<?= base_url(); ?>Project_Officer/delete_project_id',
                    method: 'POST',
                    data: {
                        'id': project_id
                    },
                    success: function(response) {

                    },
                    async: false
                });
            }
        } else {
            //alert('all okay');
        }
    });
</script>
<script type="text/javascript">
    function seen(data) {
        // var receiver_id=$(this).attr('id');
        $.ajax({
            url: '<?= base_url(); ?>ChatController/seen',
            method: 'POST',
            data: {
                'id': data
            },
            success: function(data) {
                $('#notification').html(data);
            },
            async: true
        });
    }
    $('#notifications').focusout(function() {
        // alert('notification clicked');
        $.ajax({
            url: '<?= base_url(); ?>ChatController/activity_seen',
            success: function(data) {
                $('#notifications').html(data);
            },
            async: true
        });
    });
</script>