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
                <h1 class="h4">Officer's NHS Records List</h1>
            </div>
            <?php if (count($officer_record) > 0) { ?>
                <table id="datatable" class="table table-striped" style="color:black;font-size:small;">
                    <thead>
                        <tr>
                            <th scope="col">S. No.</th>
                            <th scope="col">Officer ID</th>
                            <th scope="col">Officer Name</th>
                            <th scope="col">Officer CNIC</th>
                            <th scope="col">Officer Rank</th>
                            <th scope="col">Payment Last Month</th>
                            <th scope="col">Total Payment</th>
                            <th scope="col" style="text-align:center">Edit Record</th>
                        </tr>
                    </thead>
                    <tbody id="table_rows">
                        <?php $count = 0;
                        foreach ($officer_record as $data) { ?>
                            <tr>
                                <td scope="row"><?= ++$count; ?></td>
                                <td class="quant" scope="row"><?= $data['officer_id']; ?></td>
                                <td class="quant" scope="row"><?= $data['officer_name']; ?></td>
                                <td class="quant" scope="row"><?= $data['officer_cnic']; ?></td>
                                <td class="quant" scope="row"><?= $data['officer_rank']; ?></td>
                                <td class="quant" scope="row"><?= $data['payment_last_month']; ?></td>
                                <td class="quant" scope="row"><?= $data['total_payment']; ?></td>
                                <td style="text-align:center" id="edit" class="edit" scope="row"><a href="<?= base_url(); ?>SO_RECORD/edit_officer_record/<?= $data['officer_id']; ?>" style="color:black;text-align:center"><i class="fas fa-edit"></i></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <a style="padding:20px"> No Officer Record Available </a>
            <?php } ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <?php $acct_type = $this->session->userdata('acct_type');
        if ($acct_type != "admin_super") { ?>
            <?php if ($acct_type != "admin_north") { ?>
                <?php if ($acct_type != "admin_south") { ?>
                    <form class="user" role="form" method="post" id="add_form" action="<?php echo base_url(); ?>SO_RECORD/add_officer_record">
                        <div class=" form-group row my-2 justify-content-center">
                            <div class="col-sm-4">
                                <input type="hidden" name="project_id_selected" id="project_id_selected">
                                <button type="submit" class="btn btn-primary btn-user btn-block" id="add_new_bill">
                                    <i class="fas fa-plus"></i>
                                    Add new Officer Record
                                </button>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
</div>

<form class="user" role="form" method="post" id="add_form" action="<?php echo base_url(); ?>SO_RECORD/index">
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


<?php $this->load->view('common/footer'); ?>
<script>
    $('#project_id').on('change', function() {
        $('#add_btn').attr('disabled', true);
        var validate = 0;
        var project_id = $('#project_id').val();

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