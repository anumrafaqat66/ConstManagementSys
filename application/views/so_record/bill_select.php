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
</style>

<div class="container">
    <div class="card o-hidden my-4 border-0 shadow-lg">
        <div class="card bg-custom3">
            <div class="card-header bg-custom1">
                <h1 class="h4">Select Project</h1>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-2 my-3">
                        <h6>&nbsp;Select Project:</h6>
                    </div>
                    <div class="col-sm-6 mb-1">

                        <form method="post" accept-charset="utf-8" action="<?php echo site_url("SO_RECORD/show_bills"); ?>">
                            <select class="form-control rounded-pill" name="project_id" onchange="this.form.submit()" id="project_id" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                <option class="form-control form-control-user" value="">Select Project Name</option>
                                <?php foreach ($projects as $data) { ?>
                                    <option class="form-control form-control-user" value="<?= $data['ID'] ?>"><?= $data['Name'] ?></option>
                                <?php } ?>
                            </select>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- <?php echo $total_payment_made['total_payment']; ?>
        <?php echo $total_verified_amount['total_verified']; ?> -->

        <?php if (isset($project_detail['Name'])) { ?>
            <div class="card-body bg-custom3" id="show_buttons">
                <div class="form-group row">
                    <h2 id="project_heading" style="margin-left:15px;text-decoration:underline"><strong><?php if (isset($project_detail['Name'])) {
                                                                                                            echo $project_detail['Name'];
                                                                                                        } ?></strong></h2>
                </div>
                <div class="form-group row justify-content-center" style="margin-top:50px;">
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-primary rounded-pill btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_inventory" onclick="location.href='<?php echo base_url(); ?>SO_RECORD/show_running_bills/<?php if (isset($project_detail['ID'])) {
                                                                                                                                                                                                                                                                echo $project_detail['ID'];
                                                                                                                                                                                                                                                            } ?>'">
                            <h4 style="font-weight: bold;">Running Bills</h4>
                        </button>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-primary rounded-pill  btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_material" onclick="location.href='<?php echo base_url(); ?>SO_RECORD/show_bills_summary/<?php if (isset($project_detail['ID'])) {
                                                                                                                                                                                                                                                                echo $project_detail['ID'];
                                                                                                                                                                                                                                                            } ?>'">
                            <h4 style="font-weight: bold;">Bills Summary</h4>
                        </button>
                    </div>

                    <div class="col-sm-4">
                        <button type="button" class="btn btn-primary rounded-pill  btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_material" >
                            <h4 style="font-weight: bold;">Progress <?php if (isset($total_payment_made['total_payment']) && isset($total_verified_amount['total_verified'])) {
                                                                        echo number_format(($total_payment_made['total_payment'] / $total_verified_amount['total_verified']) * 100, 2);
                                                                    } else {
                                                                        echo '0.00';
                                                                    } ?>%</h4>
                        </button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

</div>


<?php $this->load->view('common/footer'); ?>
<script>
    $('#project_id').on('change', function() {
        $('#add_btn').attr('disabled', true);
        var validate = 0;
        var project_id = $('#project_id').val();

        // $('#project_heading').html('<strong>' + project_id + '</strong>');
        // $('#show_buttons').show();

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