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
                        <div style="margin:5px !important" class="d-sm-flex align-items-center justify-content-between mb-4 my-2">
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

                    <form class="user" role="form" method="post" id="add_form" action="<?= base_url(); ?>Project_Officer/submit_bid_eval_form/<?= $project; ?>">
                        <table id="datatable" class="table table-striped" style="color:black; white-space: nowrap;">
                            <thead>
                                <tr style="display:none" id="table_header">
                                    <th scope="col">S. No.</th>
                                    <th scope="col">Contractor Name</th>
                                    <th scope="col">Technical Score</th>
                                    <th scope="col">Financial Score</th>
                                    <th scope="col">Total Score</th>
                                    <th scope="col">Bid Amount</th>
                                    <th scope="col">Select Contractor</th>

                                    <th scope="col" style="display:none">Bid ID</th>
                                </tr>
                            </thead>
                            <tbody id="table_rows_bid_evaluation">
                                <?php if (isset($project_bid_eval_data)) {
                                    if (count($project_bid_eval_data) > 0) {
                                        $count = 1;
                                        foreach ($project_bid_eval_data as $data) { ?>
                                            <tr style="padding:20px">
                                                <td style="padding:20px"> <?= $count; ?> </td>
                                                <td scope="row">
                                                    <div class="form-group row">
                                                        <select class="form-control form-control-user rounded-pill" name="contractor_id<?= $count ?>" id="contractor_id<?= $count ?>" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px; padding:10px !important">
                                                            <?php if (isset($data['contractor_id'])) { ?>
                                                                <option class="form-control form-control-user" style="font-size: 0.8rem;" value="<?= $data['contractor_id']; ?>"><?= $data['Name']; ?></option>
                                                            <?php } else { ?>
                                                                <option class="form-control form-control-user" style="font-size: 0.8rem;" value="">Select Contractor</option>
                                                                <?php foreach ($contractor_name as $contractor) { ?>
                                                                    <option class="form-control form-control-user" style="font-size: 0.8rem;" value="<?= $contractor['ID'] ?>"><?= $contractor['Name'] ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group row">
                                                        <input type="number" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem;" onchange="update_total_score(<?= $count ?>)" name="txt_tech_score<?= $count ?>" id="txt_tech_score<?= $count ?>" placeholder="Technical Score" value="<?= $data['technical_score']; ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group row">
                                                        <input type="number" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem;" onchange="update_total_score(<?= $count ?>)" name="txt_fin_score<?= $count ?>" id="txt_fin_score<?= $count ?>" placeholder="Financial Score" value="<?= $data['financial_score']; ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group row">
                                                        <input type="number" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem;" name="txt_total_score<?= $count ?>" id="txt_total_score<?= $count ?>" placeholder="Total Score" value="<?= $data['total_score']; ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group row">
                                                        <input type="number" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem;" name="txt_bid_amount<?= $count ?>" id="txt_bid_amount<?= $count ?>" placeholder="Bid Amount" value="<?= $data['bid_amount']; ?>">
                                                    </div>
                                                </td>
                                                <td style="padding:20px">
                                                    <div class="form-check" style="text-align:center">
                                                        <input class="form-check-input" type="radio" value="<?= $count ?>" name="flexRadioDefault" id="Radio" <?= $data['eval_Status'] == "Selected" ? "checked" : "" ?>>
                                                        <!-- <label class="form-check-label" for="flexRadioDefault1"> -->
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php $count++;
                                        }
                                    } else { ?>
                                        <h4 style="text-align:center; padding:5px; color:red;" id="no_record_msg"> No Bid Evaluation form submitted. Press [Add new contractor] button. </h4>
                                    <?php }
                                } else { ?>
                                    <h4 style="text-align:center; padding:5px; color:red;" id="no_record_msg"> No Bid Evaluation form submitted. Press [Add new contractor] button. </h4>
                                <?php } ?>
                            </tbody>
                        </table>

                        <?php $acct_type = $this->session->userdata('acct_type');
                        if ($acct_type != "admin_super") { ?>
                            <?php if ($acct_type != "admin_north") { ?>
                                <?php if ($acct_type != "admin_south") { ?>
                                    <div class="form-group row" style="padding:30px; display:none" id="recommendation_input">
                                        <h6 style="margin-bottom:5px">&nbsp;Final Recommendations:</h6>
                                        <input type="text" class="form-control form-control-user rounded-pill" name="txt_recommendation" id="txt_recommendation" placeholder="Final Recommendations" value="<?php if (isset($recommendation['recommendations'])) {
                                                                                                                                                                                                                echo $recommendation['recommendations'];
                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                '';
                                                                                                                                                                                                            } ?>">
                                    </div>
                                    <div class="form-group row my-2 justify-content-center" style="display:none" id="save_eval_button">
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn">
                                                <!-- <i class="fas fa-plus"></i> -->
                                                Save Evaluation Data
                                            </button>
                                            <span id="show_error_update" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                                            <span id="show_error_radio" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please select radio button*</span>
                                            <span id="show_error_same_contractor" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Two contractors cannot be same*</span>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </form>

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

    $(document).ready(function() {
        row_count = parseInt(document.getElementById('table_rows_bid_evaluation').childNodes.length - 1);
        if (row_count > 0) {
            $('#table_header').show();
            $('#recommendation_input').show();
            $('#save_eval_button').show();
            $('#no_record_msg').hide();
        }
    });

    $("#add_new_row").click(function() {
        $('#table_header').show();
        $('#recommendation_input').show();
        $('#save_eval_button').show();
        $('#no_record_msg').hide();

        loop = parseInt(document.getElementById('table_rows_bid_evaluation').rows.length + 1);

        $("#table_rows_bid_evaluation").append(`<tr>
                                <td style="padding:25px">${loop} </td>
                                <td scope="row">
                                    <div class="form-group row">
                                        <select class="form-control rounded-pill" name="contractor_id${loop}" id="contractor_id${loop}" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px; padding:10px !important">
                                            <option class="form-control form-control-user" style="font-size: 0.8rem; " value="">Select Contractor</option>
                                            <?php foreach ($contractor_name as $contractor) { ?>
                                                <option class="form-control form-control-user" style="font-size: 0.8rem;" value="<?= $contractor['ID'] ?>"><?= $contractor['Name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <input type="number" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem;" onchange="update_total_score(${loop})" name="txt_tech_score${loop}" id="txt_tech_score${loop}" placeholder="Technical Score">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <input type="number" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem;" onchange="update_total_score(${loop})" name="txt_fin_score${loop}" id="txt_fin_score${loop}" placeholder="Financial Score">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <input type="number" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem;" name="txt_total_score${loop}" id="txt_total_score${loop}" placeholder="Total Score">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <input type="number" class="form-control form-control-user rounded-pill" style="font-size: 0.8rem;" name="txt_bid_amount${loop}" id="txt_bid_amount${loop}" placeholder="Bid Amount">
                                    </div>
                                </td>
                                
                                <td style="padding:20px">
                                    <div class="form-check" style="text-align:center">
                                        <input class="form-check-input" type="radio" value="${loop}" name="flexRadioDefault" id="Radio">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                        </label>
                                    </div>
                                </td>
                            </tr>`);

    });

    function update_total_score(row) {
        var txt_tech_score = $('#txt_tech_score' + row).val();
        var txt_fin_score = $('#txt_fin_score' + row).val();
        $('#txt_total_score' + row).val(parseFloat(txt_tech_score) + parseFloat(txt_fin_score));
    }

    $('#add_btn').on('click', function() {
        $('#edit_btn').attr('disabled', true);
        var validate = 0;

        var rowCount = $('#table_rows_bid_evaluation tr').length;

        var contractor_id;
        var txt_tech_score;
        var txt_fin_score;
        var txt_total_score;
        var txt_bid_amount;

        var prev_contractor = '';

        for (let i = 1; i <= rowCount; i++) {
            contractor_id = $('#contractor_id' + i).val();
            txt_tech_score = $('#txt_tech_score' + i).val();
            txt_fin_score = $('#txt_fin_score' + i).val();
            txt_total_score = $('#txt_total_score' + i).val();
            txt_bid_amount = $('#txt_bid_amount' + i).val();

            if (contractor_id == prev_contractor) {
                validate = 3;
            }

            if (contractor_id == '') {
                validate = 1;
                $('#contractor_id' + i).addClass('red-border');
            }
            if (txt_tech_score == '') {
                validate = 1;
                $('#txt_tech_score' + i).addClass('red-border');
            }
            if (txt_fin_score == '') {
                validate = 1;
                $('#txt_fin_score' + i).addClass('red-border');
            }
            if (txt_total_score == '') {
                validate = 1;
                $('#txt_total_score' + i).addClass('red-border');
            }
            if (txt_bid_amount == '') {
                validate = 1;
                $('#txt_bid_amount' + i).addClass('red-border');
            }

            prev_contractor = contractor_id;
        }

        var txt_recommendation = $('#txt_recommendation').val();

        if (txt_recommendation == '') {
            validate = 1;
            $('#txt_recommendation').addClass('red-border');
        }

        if (validate == 0) {
            var radio_val = $("input[name='flexRadioDefault']:checked").val();
            if (typeof radio_val == 'undefined') {
                validate = 2;
            }
        }

        if (validate == 0) {
            $('#add_form')[0].submit();
            $('#show_error_update').hide();
            $('#show_error_same_contractor').hide();
            $('#show_error_radio').hide();
        } else if (validate == 2) {
            $('#add_btn').removeAttr('disabled');
            $('#show_error_update').hide();
            $('#show_error_same_contractor').hide();
            $('#show_error_radio').show();
        } else if (validate == 3) {
            $('#add_btn').removeAttr('disabled');
            $('#show_error_radio').hide();
            $('#show_error_update').hide();
            $('#show_error_same_contractor').show();
        } else {
            $('#add_btn').removeAttr('disabled');
            $('#show_error_same_contractor').hide();
            $('#show_error_radio').hide();
            $('#show_error_update').show();
        }
    });
</script>