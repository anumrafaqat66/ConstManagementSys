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

    #your_btn {
        position: relative;
        /*  top: 150px;*/
        font-family: calibri;
        width: 480px;
        padding: 10px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border: 1px dashed #BBB;
        text-align: center;
        background-color: #DDD;
        cursor: pointer;
    }
</style>

<div class="container">
    <div class="card o-hidden my-4 border-0 shadow-lg">
        <!--          <div class="modal fade" id="new_material"> -->
        <!-- <div class="row"> -->
        <!--   
         </div> -->

        <!--  <div class="modal fade" id="edit_material"> -->
        <!-- <div class="row"> -->
        <!--  <div class="modal-dialog modal-dialog-centered " style="margin-left: 370px;" role="document">
                 <div class="modal-content bg-custom3" style="width:1000px;">
                     <div class="modal-header" style="width:1000px;">

                     </div>
                     <div class="card-body bg-custom3"> -->
        <!-- Nested Row within Card Body -->
        <!--  <div class="row">
                             <div class="col-lg-12">

                                 <div class="card">
                                     <div class="card-header bg-custom1">
                                         <h1 class="h4">Update/Edit Material</h1>
                                     </div>

                                     <div class="card-body bg-custom3">
                                         <form class="user" role="form" method="post" id="edit_form" action="<?= base_url(); ?>SO_STORE/edit_inventory">
                                             <div class="form-group row">
                                                 <div class="col-sm-4">
                                                     <h6>&nbsp;Material:</h6>
                                                 </div>

                                                 <div class="col-sm-4">
                                                     <h6>&nbsp;Add Quantity:</h6>
                                                 </div>

                                                 <div class="col-sm-4">
                                                     <h6>&nbsp;New Price:</h6>
                                                 </div>

                                             </div>

                                             <div class="form-group row">

                                                 <div class="col-sm-4 mb-1" style="display:none">
                                                     <input type="text" class="form-control form-control-user" name="id_edit" id="id_edit" placeholder="id" readonly="readonly" style="color:black; font-size:medium; background-color:lightgray; border:1px solid black;">
                                                 </div>

                                                 <div class="col-sm-4 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="material_name_edit" id="material_name_edit" placeholder="Material" readonly="readonly" style="color:black; font-size:medium; background-color:lightgray; border:1px solid black;">
                                                 </div>

                                                 <div class="col-sm-4 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="new_quantity" id="new_quantity" placeholder="Add Quantity">
                                                 </div>

                                                 <div class="col-sm-4 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="new_price" id="new_price" placeholder="New Price">
                                                 </div>

                                             </div>

                                             <div class="form-group row justify-content-center">
                                                 <div class="col-sm-4">
                                                     <button type="button" class="btn btn-primary btn-user btn-block" id="edit_btn"> -->
        <!-- <i class="fab fa-google fa-fw"></i>  -->
        <!--  Update Material
                                                     </button>
                                                     <span id="show_error_update" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                                                 </div>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div> -->
        <!--  <div class="modal-footer"> -->
        <!-- <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button> -->
        <!--         </div>
                 </div>
             </div>
         </div> -->

        <?php $acct_type = $this->session->userdata('acct_type');
        if ($acct_type != "admin_super") {
            if ($acct_type != "admin_north") {
                if ($acct_type != "admin_south") { ?>

                    <div class="card-body bg-custom3">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="card bg-custom3">
                                    <div class="card-header bg-custom1">
                                        <h1 class="h4">Add New Allotment Record</h1>
                                    </div>

                                    <div class="card-body">

                                        <form class="user" role="form" enctype="multipart/form-data" method="post" id="add_drawing_form" action="<?= base_url(); ?>SO_RECORD/upload_allotment_letter">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <h6>&nbsp;Received Date:</h6>
                                                </div>

                                                <div class="col-sm-6">
                                                    <h6>&nbsp;Dispatched Date:</h6>
                                                </div>



                                            </div>

                                            <div class="form-group row">

                                                <div class="col-sm-6 mb-1">
                                                    <input type="date" class="form-control form-control-user" name="rcvd_date" id="rcvd_date">
                                                </div>

                                                <div class="col-sm-6 mb-1">
                                                    <input type="date" class="form-control form-control-user" name="dispatch_date" id="dispatch_date">
                                                </div>



                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <h6>&nbsp;Officer Name:</h6>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6>&nbsp;Project Name:</h6>
                                                </div>
                                            </div>

                                            <div class="form-group row">

                                                <div class="col-sm-6 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="officer_name" id="officer_name" placeholder="Enter Officer Name">
                                                </div>

                                                <div class="col-sm-6 mb-1">
                                                    <select class="form-control rounded-pill" name="project_id" id="project_id" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                                        <option class="form-control form-control-user" value="">Select Project Name</option>
                                                        <?php foreach ($projects as $data) { ?>
                                                            <option class="form-control form-control-user" value="<?= $data['ID'] ?>"><?= $data['Name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <h6>&nbsp;Upload Letter:</h6>
                                                </div>
                                            </div>

                                            <div class="form-group row">

                                                <div class="col-sm-12 mb-1">
                                                    <input type="file" id="your_btn" multiple="multiple" name="project_allotment_letter[]">
                                                </div>

                                                <!-- <div class="col-sm-12 mb-1" class="justify-content-center" style="margin-top: 30px;">
                                         <button type="submit" class="btn btn-primary btn-user btn-block" name="file_upload" id="file_upload">
                                             Upload Allotment Letter
                                         </button>
                                     </div> -->
                                            </div>

                                            <div class="form-group row justify-content-center">
                                                <div class="col-sm-4">
                                                    <button type="button" class="btn btn-primary btn-user btn-block" name="file_upload" id="file_upload">
                                                        <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                        Upload Allotment Letter
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
        <?php }
            }
        } ?>

        <div class="card-body bg-custom3">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">

                    <div class="card bg-custom3">
                        <div class="card-header bg-custom1">
                            <h1 class="h4">Record of Allotments</h1>
                        </div>

                        <div class="card-body">
                        <a onclick="location.href='<?php echo base_url(); ?>SO_RECORD/print_allotment_letters'" style="float: right; margin-bottom: 10px" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-print text-white-50"></i> Print Page</a>
                            <div id="table_div">
                                <?php if (count($letter_list) > 0) { ?>
                                    <table id="datatable" class="table table-striped" style="color:black;">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.No.</th>
                                                <th scope="col" style="white-space:nowrap">Project Name</th>
                                                <th scope="col" style="white-space:nowrap">Received Date</th>
                                                <th scope="col" style="white-space:nowrap">Dispatched Date</th>
                                                <th scope="col" style="white-space:nowrap">Officer Name</th>
                                                <th scope="col">File Name</th>
                                                <th scope="col">View</th>
                                                <?php if ($this->session->userdata('acct_type') == "admin_super") { ?>
                                                    <th scope="col">Region</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody id="table_rows_project">
                                            <?php $count = 1;
                                            foreach ($letter_list as $data) { ?>
                                                <tr>

                                                    <td scope="row" id="cont<?= $count; ?>"><?= $count; ?></td>
                                                    <td scope="row" style="white-space:nowrap"><b><?= $data['Name']; ?></b></td>
                                                    <td scope="row" style="white-space:nowrap"><?= $data['received_date']; ?></td>
                                                    <td scope="row" style="white-space:nowrap"><?= $data['dispatch_date']; ?></td>
                                                    <td scope="row" style="white-space:nowrap"><?= $data['officer_name']; ?></td>
                                                    <td scope="row"><?= $data['file_name']; ?></td>
                                                    <td type="button" class="edit" scope="row"><a style="color:black;" href="<?= base_url(); ?>uploads/project_allotment_letter/<?= $data['file_name']; ?>"><i style="margin-left: 10px;" class="fas fa-eye"></i></a></td>
                                                    <?php if ($this->session->userdata('acct_type') == "admin_super") { ?>
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
                </div>
            </div>
        </div>



    </div>
</div>

</div>


<?php $this->load->view('common/footer'); ?>
<script>
    $('#file_upload').on('click', function() {
        //alert('javascript working');
        $('#add_btn').attr('disabled', true);
        var validate = 0;

        var rcvd_date = $('#rcvd_date').val();
        var dispatch_date = $('#dispatch_date').val();
        var officer_name = $('#officer_name').val();
        var project_id = $('#project_id').val();
        var project_allotment_letter = $('#your_btn').val();

        if (rcvd_date == '') {
            validate = 1;
            $('#rcvd_date').addClass('red-border');
        }
        if (dispatch_date == '') {
            validate = 1;
            $('#dispatch_date').addClass('red-border');
        }
        if (officer_name == '') {
            validate = 1;
            $('#officer_name').addClass('red-border');
        }
        if (project_id == '') {
            validate = 1;
            $('#project_id').addClass('red-border');
        }

        if (project_allotment_letter == '') {
            validate = 1;
            $('#your_btn').addClass('red-border');
        }

        if (validate == 0) {
            $('#add_drawing_form')[0].submit();
            //  $('#show_error_new').hide();
        } else {
            $('#add_btn').removeAttr('disabled');
            //  $('#show_error_new').show();
        }
    });




    $('#table_rows').find('tr').click(function() {
        var $columns = $(this).find('td');
        $('#material_name_edit').val($columns[1].innerHTML);
        $('#id_edit').val($columns[0].innerHTML);
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