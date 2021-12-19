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
    .img {
        background: url('<?= base_url() ?>assets/img/record-banner.jpg');
        background-position: center;
        background-size: cover;
        height: 250px;
        /* filter: blur(1px); */
        border-radius: 25px;
    }

    .red-border {
        border: 1px solid red !important;
    }
</style>

<div class="container">

    <h2 class="my-4">Welcome, SO Record!</h2>

    <div class="col-md-12 img">
    </div>

    <form class="user" role="form" method="post" id="add_form">

        <div class="form-group row justify-content-center" style="margin-top:50px;">
            <div class="col-sm-6">
                <button type="button" class="btn btn-primary btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_inventory" onclick="location.href='<?php echo base_url(); ?>SO_RECORD/show_letter_lists'">
                    <h4 style="font-weight: bold;">Allotment Letter</h4>
                </button>
            </div>

            <div class="col-sm-6">
                <button type="button" class="btn btn-primary btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_material" onclick="location.href='<?php echo base_url(); ?>SO_RECORD/view_material_used'">
                    <h4 style="font-weight: bold;">Material Used By Project</h4>
                </button>
            </div>


        </div>
        <div class="form-group row justify-content-center" style="margin-top:50px;">
            <div class="col-sm-6">
                <button type="button" class="btn btn-primary btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_material" onclick="location.href='<?php echo base_url(); ?>SO_RECORD/show_bills'">
                    <h4 style="font-weight: bold;">Finance</h4>
                </button>
            </div>

            <div class="col-sm-6">
                <button type="button" class="btn btn-primary btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_material" onclick="location.href='<?php echo base_url(); ?>SO_RECORD/view_performance_security'">
                    <h4 style="font-weight: bold;">Performance Security</h4>
                </button>
            </div>
        </div>
        <div class="form-group row justify-content-center" style="margin-top:50px;">
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_material" onclick="location.href='<?php echo base_url(); ?>SO_RECORD/show_officer_record_list'">
                    <h4 style="font-weight: bold;">Add Officer Record</h4>
                </button>
            </div>
        </div>
    </form>
</div>

</div>


<?php $this->load->view('common/footer'); ?>
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