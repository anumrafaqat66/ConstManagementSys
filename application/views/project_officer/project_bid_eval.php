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

<div class="form-group row my-4 mx-5">
    <div class="col-sm-12">
        <h1 style="font-weight: bold;text-align: center;">Bid Evaluation Report</h1>
        <!-- <h1 id="project_name" style="font-weight: bold;text-align: center;"><?= $project_records['Name'] ?></h1> -->
    </div>
</div>

<div class="container">
    <div class="card o-hidden my-4 border-0 shadow-lg">
        <!-- <div class="row"> -->
        <!-- <div class="col-lg-12"> -->

        <div class="card bg-custom3" style="">
            <div class="card-header bg-custom1">
                <h1 class="h4" style="text-align:center">Concluding Results and Recommendataions</h1>
            </div>

            <?php $acct_type = $this->session->userdata('acct_type');
            if ($acct_type != "admin_super") {
                if ($acct_type != "admin_north") {
                    if ($acct_type != "admin_south") { ?>
                        <div  style="margin:5px !important" class="d-sm-flex align-items-center justify-content-between mb-4 my-2">
                            <h1 class="h3 mb-0 text-black-800"></h1>
                            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm rounded-pill" id="add_new_row">
                                <i class="fas fa-plus"></i>
                                Add new Contractor
                            </button>
                        </div>
            <?php }
                }
            } ?>

            <div class="card-body" style="padding:0px !important">
                <div id="table_div">
                    <table id="datatable" class="table table-striped" style="color:black; white-space: nowrap;">
                        <thead>
                            <tr>
                                <th scope="col">S. No.</th>
                                <th scope="col">Contractor Name</th>
                                <th scope="col">Technical Score</th>
                                <th scope="col">Financial Score</th>
                                <th scope="col">Total Score</th>
                                <th scope="col">Bid Amount</th>
                                <th scope="col">Recommendations</th>
                                <th scope="col">Select Contractor</th>

                                <th scope="col" style="display:none">Bid ID</th>
                            </tr>
                        </thead>
                        <tbody id="table_rows_bid_evaluation">
                            <tr style="padding:20px">
                                <td style="padding:20px">1. </td>
                                <td scope="row">
                                    <div class="form-group row">
                                        <select class="form-control rounded-pill" name="contractor_edit" id="contractor_edit" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:40px">
                                            <option class="form-control form-control-user" style="font-size: 0.8rem; " value="">Select Contractor</option>
                                            <?php foreach ($contractor_name as $contractor) { ?>
                                                <option class="form-control form-control-user" style="font-size: 0.8rem;" value="<?= $contractor['ID'] ?>"><?= $contractor['Name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <input type="number" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem; height:40px" name="txt_tech_score" id="txt_tech_score" placeholder="Technical Score">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <input type="number" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem; height:40px" name="txt_fin_score" id="txt_fin_score" placeholder="Financial Score">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <input type="number" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem; height:40px" name="txt_total_score" id="txt_total_score" placeholder="Total Score">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <input type="number" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem; height:40px" name="txt_bid_amount" id="txt_bid_amount" placeholder="Bid Amount">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <input type="text" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem; height:40px" name="txt_recommendation" id="txt_recommendation" placeholder="Recommendation">
                                    </div>
                                </td>
                                <td style="padding:20px">
                                    <div class="form-check" style="text-align:center">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                        </label>
                                    </div>
                                </td>
                                <!-- <a style="color:black; font-weight:800;" href="<?= base_url() ?>Project_Officer/overview/<?= $data['ID'] ?>"> -->
                                <!-- <td scope="row" id="cont<?= $count; ?>"><?= $count; ?></td> -->
                                <!-- <td style="width:150px;" scope="row"><b><?= $data['name']; ?></b></td> -->
                                <!-- <td scope="row"><?= $data['date_added']; ?></td> -->
                                <!-- <td scope="row"><?= $data['description']; ?></td> -->
                                <!-- <td style="width:120px" type="button" class="edit" scope="row"><a style="color:black;" href="<?= base_url(); ?>uploads/project_drawing/<?= $data['name']; ?>"><i style="margin-left: 20px;" class="fas fa-eye"></i></a></td> -->
                            </tr>
                        </tbody>
                    </table>

                    <?php $acct_type = $this->session->userdata('acct_type');
                    if ($acct_type != "admin_super") { ?>
                        <?php if ($acct_type != "admin_north") { ?>
                            <?php if ($acct_type != "admin_south") { ?>
                                <form class="user" role="form" method="post" id="add_form" action="">
                                    <div class="form-group row my-2 justify-content-center">
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn" data-toggle="modal" data-target="#new_project">
                                                <!-- <i class="fas fa-plus"></i> -->
                                                Save Evaluation Data
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
        <!-- </div> -->
        <!-- </div> -->
    </div>
</div>

</div>

<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
    function seen(data) {
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

    //var loop = 1;
    //  var row_count

    $("#add_new_row").click(function() {
        loop = parseInt(document.getElementById('table_rows_bid_evaluation').childNodes.length - 1);

        $("#table_rows_bid_evaluation").append(`<tr>
                                <td style="padding:20px">${loop} </td>
                                <td scope="row">
                                    <div class="form-group row">
                                        <select class="form-control rounded-pill" name="contractor_id${loop}" id="contractor_id${loop}" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:40px">
                                            <option class="form-control form-control-user" style="font-size: 0.8rem; " value="">Select Contractor</option>
                                            <?php foreach ($contractor_name as $contractor) { ?>
                                                <option class="form-control form-control-user" style="font-size: 0.8rem;" value="<?= $contractor['ID'] ?>"><?= $contractor['Name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <input type="number" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem; height:40px" name="txt_tech_score${loop}" id="txt_tech_score${loop}" placeholder="Technical Score">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <input type="number" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem; height:40px" name="txt_fin_score${loop}" id="txt_fin_score${loop}" placeholder="Financial Score">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <input type="number" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem; height:40px" name="txt_total_score${loop}" id="txt_total_score${loop}" placeholder="Total Score">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <input type="number" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem; height:40px" name="txt_bid_amount${loop}" id="txt_bid_amount${loop}" placeholder="Bid Amount">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <input type="text" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem; height:40px" name="txt_recommendation${loop}" id="txt_recommendation${loop}" placeholder="Recommendation">
                                    </div>
                                </td>
                                <td style="padding:20px">
                                    <div class="form-check" style="text-align:center">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="Radio${loop}">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                        </label>
                                    </div>
                                </td>
                            </tr>`);

    });
</script>