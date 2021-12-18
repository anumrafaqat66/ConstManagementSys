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
        width: 100%;
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

        <div class="card-body bg-custom3">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">

                    <div class="card bg-custom3">
                        <div class="card-header bg-custom1">
                            <h1 class="h4">Add New Bill</h1>
                        </div>

                        <div class="card-body">

                            <form class="user" role="form" enctype="multipart/form-data" method="post" id="add_bill_form" action="<?= base_url(); ?>SO_RECORD/edit_project_bill">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <h6>&nbsp;Bill No:</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6>&nbsp;Gross Work Done:</h6>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-1">
                                        <input type="number" class="form-control form-control-user" value="<?= $project_bills['bill_name'] ?>" name="bill_no" id="bill_no" placeholder="Bill No." readonly>
                                    </div>
                                    <div class="col-sm-6 mb-1">
                                        <input type="number" class="form-control form-control-user" value="<?= $project_bills['gross_work_done'] ?>" name="gross_work" id="gross_work" placeholder="Gross Work Done" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <h6>&nbsp;Bill Description:</h6>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 mb-1">
                                        <input type="text" class="form-control form-control-user" name="bill_desc" id="bill_desc" value="<?= $project_bills['bill_description'] ?>" placeholder="Enter Bill Description" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <h6>&nbsp;WD in the Bill:</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6>&nbsp;R/M Deducted:</h6>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-1">
                                        <input type="number" class="form-control form-control-user" name="WD_bill" id="WD_bill" value="<?= $project_bills['wd_in_bill'] ?>" placeholder="WD in the Bill" readonly>
                                    </div>
                                    <div class="col-sm-6 mb-1">
                                        <input type="number" class="form-control form-control-user" value="<?= $project_bills['rm_deducted'] ?>" name="RM_deducted" id="RM_deducted" placeholder="R/M Deducted" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <h6>&nbsp;Payment Made:</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6>&nbsp;Cheque Number:</h6>
                                    </div>
                                </div>
                                <input type="hidden" name="project_id_selected" id="project_id_selected" value="<?= $project_bills['project_id'] ?>">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-1">
                                        <input type="number" class="form-control form-control-user" value="<?= $project_bills['payment_made'] ?>" name="payment_made" id="payment_made" placeholder="Payment Made" readonly>
                                    </div>
                                    <div class="col-sm-6 mb-1">
                                        <input type="number" class="form-control form-control-user" name="cheque_number" value="<?= $project_bills['cheque_no'] ?>" id="cheque_number" placeholder="Enter Cheque No" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <h6>&nbsp;Billing Date:</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6>&nbsp;IT Deducted:</h6>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-1">
                                        <input type="date" class="form-control form-control-user" value="<?= $project_bills['date_added'] ?>" name="date" id="date" placeholder="Bill Date" readonly>
                                    </div>
                                    <div class="col-sm-6 mb-1">
                                        <input type="number" class="form-control form-control-user" value="<?= $project_bills['it_deducted'] ?>" name="it_deducted" id="it_deducted" placeholder="IT Deducted" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <h6>&nbsp;Contract Amount:</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6>&nbsp;Paid Till Last Bill:</h6>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-1">
                                        <input type="number" class="form-control form-control-user" value="<?= $project_bills['contract_amount'] ?>" name="contract_amt" id="contract_amt" placeholder="Contract Amount" readonly>
                                    </div>
                                    <div class="col-sm-6 mb-1">
                                        <input type="number" class="form-control form-control-user" name="last_bill_paid" value="<?= $project_bills['paid_till_last_bill'] ?>" id="last_bill_paid" placeholder="Amount Paid till Last Bill" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <h6>&nbsp;Claimed Amount:</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6>&nbsp;Verified Amount:</h6>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-1">
                                        <input type="number" class="form-control form-control-user" value="<?= $project_bills['claim_amount'] ?>" name="claim_amt" id="claim_amt" placeholder="Claimed Amount" readonly>
                                    </div>
                                    <div class="col-sm-6 mb-1">
                                        <input type="number" class="form-control form-control-user" name="verify_amt" value="<?= $project_bills['verified_amount'] ?>" id="verify_amt" placeholder="Verfied Amount" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <h6>&nbsp;Attach Bill Files:</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6>&nbsp;Total Cost of Material Used:</h6>
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-sm-6 mb-1">
                                        <label style="font-weight:900"> <?php if (isset($project_bills['bill_file_attach_1'])) {
                                                                            echo $project_bills['bill_file_attach_1'];
                                                                        } else {
                                                                            echo 'No Attachment Found';
                                                                        }  ?> </label>
                                    </div>

                                    <div class="col-sm-6 mb-1">
                                        <input type="number" class="form-control form-control-user" name="material_used" value="<?= $project_bills['total_cost_material_used'] ?>" id="material_used" placeholder="Verfied Amount" readonly>
                                    </div>
                                </div>


                            </form>

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
        $('#file_upload').attr('disabled', true);
        var validate = 0;

        var bill_no = $('#bill_no').val();
        var gross_work = $('#gross_work').val();
        var WD_bill = $('#WD_bill').val();
        var RM_deducted = $('#RM_deducted').val();
        var payment_made = $('#payment_made').val();

        var cheque_number = $('#cheque_number').val();
        var date = $('#date').val();
        var it_deducted = $('#it_deducted').val();
        var contract_amt = $('#contract_amt').val();

        var last_bill_paid = $('#last_bill_paid').val();
        var verify_amt = $('#verify_amt').val();
        var claim_amt = $('#claim_amt').val();


        if (bill_no == '') {
            validate = 1;
            $('#bill_no').addClass('red-border');
        }
        if (gross_work == '') {
            validate = 1;
            $('#gross_work').addClass('red-border');
        }
        if (WD_bill == '') {
            validate = 1;
            $('#WD_bill').addClass('red-border');
        }
        if (RM_deducted == '') {
            validate = 1;
            $('#RM_deducted').addClass('red-border');
        }

        if (payment_made == '') {
            validate = 1;
            $('#payment_made').addClass('red-border');
        }

        if (cheque_number == '') {
            validate = 1;
            $('#cheque_number').addClass('red-border');
        }
        if (date == '') {
            validate = 1;
            $('#date').addClass('red-border');
        }
        if (it_deducted == '') {
            validate = 1;
            $('#it_deducted').addClass('red-border');
        }
        if (last_bill_paid == '') {
            validate = 1;
            $('#last_bill_paid').addClass('red-border');
        }

        if (contract_amt == '') {
            validate = 1;
            $('#contract_amt').addClass('red-border');
        }

        if (verify_amt == '') {
            validate = 1;
            $('#verify_amt').addClass('red-border');
        }
        if (claim_amt == '') {
            validate = 1;
            $('#claim_amt').addClass('red-border');
        }

        if (validate == 0) {
            $('#add_bill_form')[0].submit();
            //  $('#show_error_new').hide();
        } else {
            $('#file_upload').removeAttr('disabled');
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