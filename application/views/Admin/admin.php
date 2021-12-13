<?php $this->load->view('Admin/common/header'); ?>


<div class="container-fluid my-4">

    <div class="modal fade" id="all_projects">
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
                                    <h1 class="h4">Select Project:</h1>
                                </div>

                                <div class="card-body">
                                    <div id="table_div">
                                        <?php if (count($projects_records) > 0) { ?>
                                            <table id="datatable" class="table table-striped" style="color:black">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Project Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_rows_project">
                                                    <?php $count = 1;
                                                    foreach ($projects_records as $data) { ?>
                                                        <tr>
                                                            <td scope="row" id="cont<?= $count; ?>"><?= $count; ?></td>
                                                            <td scope="row"><a style="color:black; font-weight:800;" type="button" onclick="location.href='<?php echo base_url(); ?>Project_Officer/progress_report/<?= $data['ID']; ?>'"><?= $data['Name']; ?></a></td>
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


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button> -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="select_region">
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
                                    <h1 class="h4">Select Region</h1>
                                </div>

                                <div class="card-body">
                                    <div id="table_div">
                                        <form class="user" role="form" method="post" id="add_form" action="">
                                            <div class="form-group row justify-content-center">
                                                <div class="col-sm-6">
                                                    <button type="button" class="btn btn-primary btn-user btn-block" id="north_btn" onclick="location.href='<?php echo base_url(); ?>SO_STORE/add_inventory/north'">
                                                        North
                                                    </button>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button type="button" class="btn btn-primary btn-user btn-block" id="south_btn" onclick="location.href='<?php echo base_url(); ?>SO_STORE/add_inventory/south'">
                                                        South
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-black-800"><strong>Welcome to <?= $this->session->userdata('full_name');?> Dashboard</strong></h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#all_projects"><i class="fas fa-download fa-sm text-white-50"></i> Project Progress Report</a>
    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body" type="button" onclick="location.href='<?php echo base_url(); ?>Project_Officer/add_projects'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                                Projects
                            </div>
                            <!-- <div class="h6 mb-0 font-weight-bold text-gray-800">Total Projects: <?= $projects['total_project'] ?></div> -->
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                            <i class="fas fa-project-diagram fa-2x text-black-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body" type="button" onclick="location.href='<?php echo base_url(); ?>Project_Officer/add_contractors'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                                Contractors</div>
                            <!-- <div class="h6 mb-0 font-weight-bold text-gray-800">Total Contractors: <?= $contractors['total_contractors'] ?></div> -->
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                            <i class="fas fa-file-signature fa-2x text-black-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <?php $acct_type = $this->session->userdata('acct_type');
                if ($acct_type != "admin_super") { ?>
                    <div class="card-body" type="button" onclick="location.href='<?php echo base_url(); ?>SO_STORE/add_inventory'">
                    <?php } else { ?>
                        <div class="card-body" type="button" data-toggle="modal" data-target="#select_region">
                        <?php } ?>
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                                    Inventory
                                </div>
                                <!-- <div class="h6 mb-0 font-weight-bold text-gray-800">Available: <?= $quantity['sum_qty']; ?></div> -->
                            </div>
                            <div class="col-auto">
                                <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                                <i class="fas fa-dolly-flatbed fa-2x text-black-300"></i>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body" type="button" onclick="location.href='<?php echo base_url(); ?>SO_STORE/view_projects'">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                                    Material Used</div>
                                <!-- <div class="h6 mb-0 font-weight-bold text-gray-800">Total Cost: PKR. <?= $price['sum_price']; ?></div> -->
                            </div>
                            <div class="col-auto">
                                <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                                <i class="fas fa-tools fa-2x text-black-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body" type="button" onclick="location.href='<?php echo base_url(); ?>SO_RECORD/show_letter_lists'">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                                    Allotment Records</div>
                                <!-- <div class="h6 mb-0 font-weight-bold text-gray-800">Total Letters: <?= $allot_letter_count['allotment_letter_count'] ?></div> -->
                            </div>
                            <div class="col-auto">
                                <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                                <i class="far fa-clipboard fa-2x text-black-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body" type="button" onclick="location.href='<?php echo base_url(); ?>SO_RECORD/show_bills'">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                                    Finance Department</div>
                                <!-- <div class="h6 mb-0 font-weight-bold text-gray-800">Total Running Bills: <?= $bill_count['bill_count'] ?></div> -->
                            </div>
                            <div class="col-auto">
                                <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                                <i class="fas fa-file-alt fa-2x text-black-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body" type="button" onclick="location.href='<?php echo base_url(); ?>SO_RECORD/view_performance_security'">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                                    Performance Security Letter</div>
                                <!-- <div class="h6 mb-0 font-weight-bold text-gray-800">Total Letters: <?= $perform_letter_count['perform_letter_count'] ?></div> -->
                            </div>
                            <div class="col-auto">
                                <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                                <i class="fas fa-file-alt fa-2x text-black-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<?php $this->load->view('common/footer'); ?>
<script>
    function seen(data) {
        // alert('in');
        // alert(data);
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