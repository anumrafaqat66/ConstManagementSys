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

    table,
    th,
    td {
        border: 1px solid black !important;
    }
</style>

<div class="container">
    <div class="card o-hidden my-4 border-0 shadow-lg">
        <div class="modal fade" id="new_running_bill">
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
                                        <h1 class="h4">Add New Running Bill</h1>
                                    </div>

                                    <div class="card-body bg-custom3">
                                        <form class="user" role="form" method="post" id="add_form" action="<?= base_url(); ?>SO_RECORD/insert_project_bill">
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <h6>&nbsp;Bill No:</h6>
                                                </div>

                                                <div class="col-sm-3">
                                                    <h6>&nbsp;Gross Work Done:</h6>
                                                </div>

                                                <div class="col-sm-3">
                                                    <h6>&nbsp;Price:</h6>
                                                </div>

                                                <div class="col-sm-3">
                                                    <h6>&nbsp;Unit:</h6>
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-3 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="material_name" id="material_name" placeholder="Material">
                                                </div>

                                                <div class="col-sm-3 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="quantity" id="quantity" placeholder="Quantity">
                                                </div>

                                                <div class="col-sm-3 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="price" id="price" placeholder="Price">
                                                </div>

                                                <div class="col-sm-3 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="unit" id="unit" placeholder="Unit">
                                                </div>
                                            </div>


                                            <div class="form-group row justify-content-center">
                                                <div class="col-sm-4">
                                                    <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn">
                                                        <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                        Submit Data
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

        <div class="modal fade" id="view_detail">
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
                                        <h1 class="h4">Uploaded Bills</h1>
                                    </div>

                                    <div class="card-body bg-custom3">

                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <h6>Uploaded Files:</h6>
                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <div class="col-sm-4 mb-1" id="bill_detail" style="width:100%">

                                            </div>

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

        <!-- <div class="card bg-custom3">
            <div class="card-header bg-custom1">
                <h1 class="h4">Running Bills</h1>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-2 my-3">
                        <h6>&nbsp;Select Project:</h6>
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

                </div>
            </div>
        </div> -->


        <div id="no_data" class="card-body bg-custom3" style="display:none">

            <div class="row">
                <div class="col-lg-12">

                    <div class="card bg-custom3">
                        <div class="card-header bg-custom1">
                            <h1 class="h4">Running Bill Detail</h1>
                        </div>

                        <div class="card-body">
                            <h5>No Data Available</h5>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div id="add_new" class="card-body bg-custom3" style="padding:16px">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12" style="padding:0px">

                    <!-- <div class="card bg-custom3"> -->
                    <div class="card-header bg-custom1">
                        <h1 class="h4">Bills Summary</h1>
                    </div>

                    <h1 class="h3" style="text-decoration:underline; text-align:center;margin-top:10px"><strong><?= $projects['Name']; ?></strong></h1>
                    <h1 class="h3" style="text-decoration:underline; text-align:center;margin-top:10px"><strong>Summary</strong></h1>

                    <!-- <div class="card-body"> -->
                    <a onclick="location.href='<?php echo base_url(); ?>SO_RECORD/bills_summary_print/<?= $projects['ID']; ?>'" style="float: right; margin-bottom:6px; margin-top:5px" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-print text-white-50"></i> Print Page</a>

                    <div id="table_div">
                        <?php $total_contract_amount = 0;
                              $total_paid_till_last_bill = 0;
                              $total_payment_made = 0;
                              $total_claim_amount = 0;
                              $total_verified_amount = 0;
                              $total_total_verified_amount = 0;
                        if (count($project_bills) > 0) { ?>
                            <table id="datatable" class="table" style="color:black;font-size:x-small;">
                                <thead>
                                    <tr>
                                        <th scope="col">S. No.</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Contract Amount</th>
                                        <th scope="col">Paid till Last Running Bill</th>
                                        <th scope="col">Payment Made</th>
                                        <th scope="col">Amount Claim in this Bill</th>
                                        <th scope="col">Amount Verified in this Bill</th>
                                        <th scope="col">Total Verified Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="table_rows">
                                    <?php $count = 0;
                                    foreach ($project_bills as $data) {
                                        $total_contract_amount = $total_contract_amount +  $data['contract_amount']; 
                                        $total_paid_till_last_bill = $total_paid_till_last_bill +  $data['paid_till_last_bill']; 
                                        $total_payment_made = $total_payment_made +  $data['payment_made']; 
                                        $total_claim_amount = $total_claim_amount +  $data['claim_amount']; 
                                        $total_verified_amount = $total_verified_amount +  $data['verified_amount']; 
                                        $total_total_verified_amount = $total_total_verified_amount +  $data['verified_amount']; 
                                        ?>
                                        <tr>
                                            <td scope="row"><?= ++$count; ?></td>
                                            <td scope="row"><?= $data['bill_description']; ?></td>
                                            <td scope="row">PKR <?php echo number_format($data['contract_amount'],2); ?></td>
                                            <td scope="row">PKR <?php echo number_format($data['paid_till_last_bill'],2); ?></td>
                                            <td scope="row">PKR <?php echo number_format($data['payment_made'],2); ?></td>
                                            <td scope="row">PKR <?php echo number_format($data['claim_amount'],2); ?></td>
                                            <td scope="row"><?php echo number_format($data['verified_amount'],2); ?></td>
                                            <td scope="row">PKR <?php echo number_format($total_verified_amount,2); ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <th scope="col" colspan="2">Total:</th>
                                        <th scope="col">PKR. <?php echo number_format($total_contract_amount,2); ?></th>
                                        <th scope="col">PKR. <?php echo number_format($total_paid_till_last_bill,2); ?></th>
                                        <th scope="col">PKR. <?php echo number_format($total_payment_made,2); ?></th>
                                        <th scope="col">PKR. <?php echo number_format($total_claim_amount,2); ?></th>
                                        <th scope="col">PKR. <?php echo number_format($total_verified_amount,2); ?></th>
                                        <th scope="col">PKR. <?php echo number_format($total_total_verified_amount,2); ?></th>
                                    </tr>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <a> No Data Available yet </a>
                        <?php } ?>
                    </div>
                    <!-- </div> -->
                    <!-- </div> -->
                </div>
            </div>
            <form class="user" role="form" method="post" id="add_form" action="<?php echo base_url(); ?>SO_RECORD/show_bills/<?= $projects['ID']; ?>">
                <div class="form-group row my-2 justify-content-center">
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-user btn-block" id="add_btn">
                            <i class="fas fa-arrow-left"></i>
                            Go Back
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div id="show_add_new_button" class="card-body bg-custom3" style="display:none">

            <div class="row">
                <div class="col-lg-12">
                    <?php $acct_type = $this->session->userdata('acct_type');
                    if ($acct_type != "admin_super") { ?>
                        <?php if ($acct_type != "admin_north") { ?>
                            <?php if ($acct_type != "admin_south") { ?>
                                <form class="user" role="form" method="post" id="add_form" action="<?php echo base_url(); ?>SO_RECORD/add_new_bill">
                                    <div class="form-group row my-2 justify-content-center">
                                        <div class="col-sm-4">
                                            <input type="hidden" name="project_id_selected" id="project_id_selected">
                                            <button type="submit" class="btn btn-primary btn-user btn-block" id="add_new_bill">
                                                <i class="fas fa-plus"></i>
                                                Add new Running Bill
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
<script>
    $('#project_id').on('change', function() {
        $('#add_btn').attr('disabled', true);
        var validate = 0;
        var project_id = $('#project_id').val();


        if (project_id != '') {

            $('#add_new').hide();
            $('#no_data').hide();
            $('#show_add_new_button').hide();
            $('#project_id_selected').val(project_id);

            $.ajax({
                url: '<?= base_url(); ?>SO_RECORD/get_running_bills_detail',
                method: 'POST',
                data: {
                    'project_id': project_id,
                },
                success: function(data) {

                    var result = jQuery.parseJSON(data);
                    var len = result.length;

                    if (len > 0) {
                        $('#add_new').show();
                        $('#show_add_new_button').show();
                        $('#table_rows').empty();
                        for (var i = 0; i < len; i++) {
                            $('#table_rows').append(` <tr>
                                                    <!-- <td scope="row">${i+1}</td> -->
                                                    <td type="button" scope="row" style="font-weight:900;cursor:pointer" onclick="view_bill(${result[i]['id']})">${result[i]['bill_name']}</td>
                                                    <td id="material" scope="row">${result[i]['date_added']}</td>
                                                    <td scope="row">PKR ${result[i]['gross_work_done']}</td>
                                                    <td scope="row">PKR ${result[i]['wd_in_bill']}</td>
                                                    <td scope="row">PKR ${result[i]['rm_deducted']}</td>
                                                    <td scope="row">PKR ${result[i]['payment_made']}</td>
                                                    <td scope="row">${result[i]['cheque_no']}</td>
                                                    <td scope="row">PKR ${result[i]['it_deducted']}</td>
                                                    <td scope="row">PKR ${result[i]['contract_amount']}</td>
                                                    <td scope="row">PKR ${result[i]['paid_till_last_bill']}</td>
                                                    <td scope="row">PKR ${result[i]['claim_amount']}</td>
                                                    <td scope="row">PKR ${result[i]['verified_amount']}</td>
                                                    <td scope="row">PKR ${result[i]['total_cost_material_used']}</td>
                                                    <?php $acct_type = $this->session->userdata('acct_type');
                                                    if ($acct_type != "admin_super") { ?>
                                                        <?php if ($acct_type != "admin_north") { ?>
                                                            <?php if ($acct_type != "admin_south") { ?>
                                                    <td type="button" id="edit" class="edit" onclick="edit_bill(${result[i]['id']})" scope="row"><i class="fas fa-edit"></i></td>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <td id="view" style="cursor:pointer" class="view" scope="row" onclick="view_detail(${result[i]['id']})" class="btn btn-primary btn-user rounded-pill" data-toggle="modal" data-target="#view_detail"><i class="fas fa-eye"></i></td>

                                                </tr>`);
                        }
                    } else {
                        $('#no_data').show();
                        $('#show_add_new_button').show();
                    }

                },
                async: true
            });

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
        $.ajax({
            url: '<?= base_url(); ?>ChatController/activity_seen',
            success: function(data) {
                $('#notifications').html(data);
            },
            async: true
        });
    });

    function edit_bill(id) {
        location.href = "<?= base_url() ?>SO_RECORD/edit_bill/" + id;
    }

    function view_bill(id) {
        location.href = "<?= base_url() ?>SO_RECORD/view_bill/" + id;
    }

    function view_detail(id) {
        $.ajax({
            url: '<?= base_url(); ?>SO_RECORD/view_bill_detail',
            method: 'POST',
            data: {
                'id': id
            },
            success: function(data) {
                var result = jQuery.parseJSON(data);
                var len = result.length;

                $("#bill_detail").empty();
                if (len > 0) {
                    for (var i = 0; i < len; i++) {

                        $("#bill_detail").append(`<a href="<?= base_url(); ?>uploads/project_billing/${result[i]}" style="font-weight:bold;color:black;white-space:nowrap">
                             ${result[i]}</a>`);
                    }
                } else {
                    $("#bill_detail").append(`<label>No Bill Uploaded</label> `);
                }
            },
            async: true
        });
    }
</script>