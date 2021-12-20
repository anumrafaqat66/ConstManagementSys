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
} else {
    $this->load->view('so_record/common/header');
} ?>

<style>
    .red-border {
        border: 1px solid red !important;
    }
</style>

<div class="container">
    <div class="card o-hidden my-4 border-0 shadow-lg">
        <div class="card bg-custom3">
            <div class="card-header bg-custom1">
                <h1 class="h4">Search Officer NHS Record</h1>
            </div>

            <div class="card-body">
                <form class="user" role="form" enctype="multipart/form-data" method="post" id="search_officer_form" action="<?= base_url(); ?>SO_RECORD/show_officer_record">
                    <div class="form-group row">

                        <div class="col-sm-2 my-3">
                            <h6>&nbsp;Enter Officer ID:</h6>
                        </div>
                        <div class="col-sm-3 mb-1">
                            <input type="text" class="form-control form-control-user rounded-pill" name="search_id" id="search_id" placeholder="Enter Officer ID">
                        </div>
                        <div class="col-sm-3 mb-1">
                            <button type="button" class="btn btn-primary btn-user btn-block rounded-pill" id="add_btn">
                                Search
                            </button>
                            <span id="show_error_new" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <?php if (isset($isdata)) {
        if ($isdata != 'Yes') { ?>
            <div class="card-body bg-custom3">
                <h3 style="padding:20px; color:brown"><strong>No record found. Please Enter the ID and try again.</strong></h3>
            </div>
    <?php }
    } ?>
    <?php if (isset($officer_detail['officer_name'])) { ?>
        <div class="card-body bg-custom3" id="show_buttons">
            <form class="user" role="form" enctype="multipart/form-data" method="post" id="show_officer" action="">
                <div class="form-group row">
                    <h2 id="project_heading" style="margin-left:15px;text-decoration:underline"><strong>Officer Name: <?php if (isset($officer_detail['officer_name'])) {
                                                                                                                            echo $officer_detail['officer_name'];
                                                                                                                        } ?></strong></h2>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <h6>&nbsp;Officer Name:</h6>
                    </div>
                    <div class="col-sm-4">
                        <h6>&nbsp;Officer Rank:</h6>
                    </div>
                    <div class="col-sm-4">
                        <h6>&nbsp;Officer CNIC:</h6>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4 mb-1">
                        <input type="text" style="font-size:large; color:black; font-weight:900" class="form-control form-control-user" name="officer_name" id="officer_name" value="<?= $officer_detail['officer_name']; ?>" placeholder="Bill No." readonly>
                    </div>
                    <div class="col-sm-4 mb-1">
                        <input type="text" style="font-size:large; color:black; font-weight:900" class="form-control form-control-user" name="officer_rank" id="officer_rank" value="<?= $officer_detail['officer_rank']; ?>" placeholder="Gross Work Done" readonly>
                    </div>
                    <div class="col-sm-4 mb-1">
                        <input type="text" style="font-size:large; color:black; font-weight:900" class="form-control form-control-user" name="officer_cnic" id="officer_cnic" value="<?= $officer_detail['officer_cnic']; ?>" placeholder="Gross Work Done" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <h6>&nbsp;Last Month Payment:</h6>
                    </div>
                    <div class="col-sm-4">
                        <h6>&nbsp;Total Payment:</h6>
                    </div>
                    <div class="col-sm-4">
                        <h6>&nbsp;Document Attachement:</h6>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4 mb-1">
                        <input type="text" style="font-size:large; color:black; font-weight:900" class="form-control form-control-user" name="payment_last_month" id="payment_last_month" value="<?= $officer_detail['payment_last_month']; ?>" placeholder="Bill No." readonly>
                    </div>
                    <div class="col-sm-4 mb-1">
                        <input type="text" style="font-size:large; color:black; font-weight:900" class="form-control form-control-user" name="total_payment" id="total_payment" value="<?= $officer_detail['total_payment']; ?>" placeholder="Gross Work Done" readonly>
                    </div>
                    <div class="col-sm-4 mb-1">
                        <!-- <input type="text" style="font-size:large; color:black; font-weight:900" class="form-control form-control-user" name="file_attach" id="file_attach" value="<?= $officer_detail['file_attach']; ?>" placeholder="File Attached" readonly> -->
                        <a href="<?= base_url(); ?>uploads/officer_records/<?= $officer_detail['file_attach']; ?>" style="font-size:large; color:black; font-weight:900;white-space:nowrap"> <?= $officer_detail['file_attach']; ?></a>
                    </div>
                </div>
            </form>
        </div>
    <?php } ?>
</div>

<form class="user" role="form" method="post" id="add_form" action="<?php echo base_url(); ?>">
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

<?php $this->load->view('common/footer'); ?>
<script>
    $('#add_btn').on('click', function() {
        // $('#add_btn').attr('disabled', true);
        var validate = 0;
        var search_id = $('#search_id').val();

        if (search_id == '') {
            validate = 1;
            $('#search_id').addClass('red-border');
        }

        if (validate == 0) {
            $('#search_officer_form')[0].submit();
            //  $('#show_error_new').hide();
        } else {
            // $('#file_upload').removeAttr('disabled');
            //  $('#show_error_new').show();
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

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>