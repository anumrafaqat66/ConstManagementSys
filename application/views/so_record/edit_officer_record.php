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
                                        <h1 class="h4">Update Officer NHS Payment Record</h1>
                                    </div>

                                    <div class="card-body">

                                        <form class="user" role="form" enctype="multipart/form-data" method="post" id="add_bill_form" action="<?= base_url(); ?>SO_RECORD/update_officer_record">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <h6>&nbsp;Officer ID:</h6>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6>&nbsp;Officer Name:</h6>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="officer_id" id="officer_id" value="<?= $officer_record['officer_id']; ?>" placeholder="Officer ID" readonly>
                                                </div>
                                                <div class="col-sm-6 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="officer_name" id="officer_name" value="<?= $officer_record['officer_name']; ?>" placeholder="Officer Name">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <h6>&nbsp;Officer CNIC:</h6>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6>&nbsp;Officer Rank:</h6>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="CNIC" id="CNIC" value="<?= $officer_record['officer_cnic']; ?>" placeholder="Enter CNIC">
                                                </div>
                                                <div class="col-sm-6 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="Rank" id="Rank" value="<?= $officer_record['officer_rank']; ?>" placeholder="Enter Rank">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <h6>&nbsp;Payment Last Month:</h6>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6>&nbsp;Total Payment:</h6>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-1">
                                                    <input type="number" class="form-control form-control-user" name="payment_last_month" value="<?= $officer_record['payment_last_month']; ?>" id="payment_last_month" placeholder="Enter Payment Last Month">
                                                </div>
                                                <div class="col-sm-6 mb-1">
                                                    <input type="number" class="form-control form-control-user" name="total_payment" id="total_payment" value="<?= $officer_record['total_payment']; ?>" placeholder="Enter Total Payment">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <h6>&nbsp;Document Attachment (if any):</h6>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-12 mb-1">
                                                    <input type="file" id="your_btn" multiple="multiple" value="<?= $officer_record['file_attach']; ?>" name="doc_attach[]" id="doc_attach">
                                                    <label><strong>&nbsp;<?= $officer_record['file_attach']; ?></strong></label>
                                                </div>
                                            </div>

                                            <div class="form-group row justify-content-center">
                                                <div class="col-sm-4">
                                                    <button type="button" class="btn btn-primary btn-user btn-block" name="file_upload" id="file_upload">
                                                        <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                        Update Record
                                                    </button>
                                                    <span id="show_error_new" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                                                </div>
                                            </div>
                                        </form>

                                        <form class="user" role="form" method="post" id="add_form" action="<?php echo base_url(); ?>SO_RECORD/show_officer_record_list">
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
                                </div>



                            </div>
                        </div>
                    </div>
        <?php }
            }
        } ?>

    </div>
</div>

</div>


<?php $this->load->view('common/footer'); ?>
<script>
    $('#file_upload').on('click', function() {
        //alert('javascript working');
        $('#file_upload').attr('disabled', true);
        var validate = 0;

        var officer_id = $('#officer_id').val();
        var officer_name = $('#officer_name').val();
        var CNIC = $('#CNIC').val();
        var Rank = $('#Rank').val();
        var payment_last_month = $('#payment_last_month').val();
        var total_payment = $('#total_payment').val();

        if (officer_id == '') {
            validate = 1;
            $('#officer_id').addClass('red-border');
        }
        if (officer_name == '') {
            validate = 1;
            $('#officer_name').addClass('red-border');
        }
        if (CNIC == '') {
            validate = 1;
            $('#CNIC').addClass('red-border');
        }
        if (Rank == '') {
            validate = 1;
            $('#Rank').addClass('red-border');
        }
        if (payment_last_month == '') {
            validate = 1;
            $('#payment_last_month').addClass('red-border');
        }
        if (total_payment == '') {
            validate = 1;
            $('#total_payment').addClass('red-border');
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