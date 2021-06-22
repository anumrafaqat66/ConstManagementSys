<?php $this->load->view('so_cw/common/header'); ?>

<style>
    .img {
        background: url('<?= base_url() ?>assets/img/socw-banner.jpg');
        background-position: center;
        background-size: cover;
        height: 250px;
        /* filter: blur(1px); */
        border-radius: 25px;

    }

    .red-border {
        border: 1px solid red !important;
    }

    /* body {
        margin-top: 50px;
        text-align: center;
        font-size: 12px;
        font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
    } */

    #calendar {
        width: 800px;
        margin: 0 auto;
        background-color: white;
        padding: 20px;
        border-radius: 20px;
        box-shadow: 10px 15px #888888;
    }

    .response {
        height: 60px;
    }

    .success {
        background: #cdf3cd;
        padding: 10px 60px;
        border: #c3e6c3 1px solid;
        display: inline-block;
    }
</style>

<div class="container">

    <h1 class="my-4"><strong>Project Progress of <?php echo $project_records['Name']; ?></strong></h1>

    <div class="modal fade" id="new_progress">
        <!-- <div class="row"> -->
        <div class="modal-dialog modal-dialog-centered " style="margin-left: 370px;" role="document">
            <div class="modal-content bg-custom3" style="width:1000px;">
                <div class="modal-header" style="width:1000px;">
                </div>
                <div class="card-body bg-custom3">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card">
                                <div class="card-header bg-custom1">
                                    <h1 class="h4">Add Project Progress</h1>
                                </div>

                                <div class="card-body bg-custom3">
                                    <form class="user" role="form" method="post" id="add_form" action="<?= base_url(); ?>SO_CW/insert_progress/<?= $project_id ?>">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <h3 id="schedule_name_heading"></h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <h6>&nbsp;Progress Date:</h6>
                                            </div>

                                            <div class="col-sm-3">
                                                <h6>&nbsp;progress %:</h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <h6>&nbsp;Enter progress details:</h6>
                                            </div>

                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-3 mb-1">
                                                <input type="text" class="form-control form-control-user" name="progress_date" id="progress_date" placeholder="Select Date" readonly>
                                            </div>

                                            <div class="col-sm-3 mb-1" style="display:none">
                                                <input type="text" class="form-control form-control-user" name="progress_id" id="progress_id" placeholder="progress %">
                                            </div>

                                            <div class="col-sm-3 mb-1">
                                                <input type="number" min="1" max="100" class="form-control form-control-user" name="progress_percentage" id="progress_percentage" placeholder="progress %">
                                            </div>

                                            <div class="col-sm-6">
                                                <textarea class="form-control" style="height:100px" name="desc" id="desc" placeholder="Enter progress details"></textarea>
                                            </div>

                                        </div>

                                        <div class="form-group row justify-content-center">
                                            <div class="col-sm-4">
                                                <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn">
                                                    <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                    Add Project Progress
                                                </button>
                                                <span id="show_error" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors</span>
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


    <div class="modal fade" id="update_progress">
        <!-- <div class="row"> -->
        <div class="modal-dialog modal-dialog-centered " style="margin-left: 370px;" role="document">
            <div class="modal-content bg-custom3" style="width:1000px;">
                <div class="modal-header" style="width:1000px;">
                </div>
                <div class="card-body bg-custom3">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card">
                                <div class="card-header bg-custom1">
                                    <h1 class="h4">Update Project Progress</h1>
                                </div>

                                <div class="card-body bg-custom3">
                                    <form class="user" role="form" method="post" id="update_form" action="<?= base_url(); ?>SO_CW/update_progress/<?= $project_id ?>">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <h3 id="task_name_heading"></h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <h6>&nbsp;Progress Date:</h6>
                                            </div>

                                            <div class="col-sm-3">
                                                <h6>&nbsp;progress %:</h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <h6>&nbsp;Enter progress details:</h6>
                                            </div>

                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-3 mb-1">
                                                <input type="text" class="form-control form-control-user" name="progress_date_update" id="progress_date_update" placeholder="Select Date" readonly>
                                            </div>

                                            <div class="col-sm-3 mb-1" style="display:none">
                                                <input type="text" class="form-control form-control-user" name="progress_id_update" id="progress_id_update" placeholder="progress %">
                                            </div>
                                            <div class="col-sm-3 mb-1" style="display:none">
                                                <input type="text" class="form-control form-control-user" name="task_id" id="task_id" placeholder="progress %">
                                            </div>

                                            <div class="col-sm-3 mb-1">
                                                <input type="number" min="1" max="100" class="form-control form-control-user" name="progress_percentage_update" id="progress_percentage_update" placeholder="progress %">
                                            </div>

                                            <div class="col-sm-6">
                                                <textarea class="form-control" style="height:100px" name="desc_update" id="desc_update" placeholder="Enter progress details"></textarea>
                                            </div>

                                        </div>

                                        <div class="form-group row justify-content-center">
                                            <div class="col-sm-4">
                                                <button type="button" class="btn btn-primary btn-user btn-block" id="update_btn">
                                                    <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                    Update Project Progress
                                                </button>
                                                <span id="show_error_update" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors</span>
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

    <form class="user" role="form" method="post" id="add_form">

        <div class="card-body bg-custom3 my-4">

            <div class="row">

                <div class="col-lg-12">
                    <div id="delete_alert" class="alert alert-success" role="alert" style="display:none">
                        Project Progess deleted successfully!!
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card bg-custom3">
                        <div class="card-header bg-custom1">
                            <h1 class="h4">Progress</h1>
                        </div>

                        <div class="card-body">
                            <div id="table_div">
                                <?php if (count($project_progress) > 0) { ?>
                                    <table id="datatable" class="table table-striped" style="color:black">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col" style="width:140px">Progress Date</th>
                                                <th scope="col" style="width:140px">Task Name</th>
                                                <!-- <th scope="col" style="width:120px">Progress %</th> -->
                                                <th scope="col" style="width:250px">Progress Bar</th>
                                                <th scope="col">Details</th>
                                                <th scope="col" style="text-align:center">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_rows_project">
                                            <?php $count = 1;
                                            foreach ($project_progress as $data) { ?>
                                                <tr>
                                                    <td scope="row" id="cont<?= $count; ?>"><?= $data['id'];; ?></td>
                                                    <td scope="row"><?= $data['progress_date']; ?></td>
                                                    <td scope="row"><?= $data['schedule_name']; ?></td>
                                                    <!-- <td scope="row"><?= $data['progress_percentage']; ?>%</td> -->
                                                    <td>
                                                        <div class="progress" style="height:20px">
                                                            <div class="progress-bar" id="progress_bar<?= $count; ?>" role="progressbar" style="width: <?= $data['progress_percentage']; ?>%;" aria-valuenow="<?= $data['progress_percentage']; ?>" aria-valuemin="0" aria-valuemax="100"><?= $data['progress_percentage'] . "%" ?></div>
                                                        </div>
                                                    </td>
                                                    <td scope="row"><?= $data['progress_description']; ?></td>
                                                    <td id="edit<?= $data['id']; ?>" onclick="editProgress(<?= $data['id']; ?>)" scope="row" data-toggle="modal" data-target="#edit_project"><i style="margin-left: 10px; cursor:pointer" class="fas fa-edit"></i></td>
                                                    <td id="delete<?= $data['id']; ?>" onclick="deleteProgress(<?= $data['id']; ?>)" scope="row" data-toggle="modal" data-target="#edit_project"><i style="margin-left: 20px; cursor:pointer" class="fas fa-trash-alt"></i></td>
                                                    <td scope="row" style="display:none"><?= $data['task_id']; ?></td>
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

                    <!-- <div class="form-group row my-3 justify-content-center">
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary btn-user btn-block" id="edit_btn" data-toggle="modal" data-target="#new_progress">
                                <i class="fas fa-plus"></i>
                                Add Project Progress
                            </button>
                            <span id="show_error_update" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
    </form>


</div>

</div>



<?php $this->load->view('common/footer'); ?>

<script>
    var today = new Date();

    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd
    }

    if (mm < 10) {
        mm = '0' + mm
    }
    today = dd + '/' + mm + '/' + yyyy;
    //today = yyyy + '-' + mm + '-' + dd;

    document.getElementById("progress_date").value = today;


    function isvalidated(input, min, max) {

        if (!$.isNumeric(input)) {
            return false;
        } else {
            if (input <= max && input >= 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    function editProgress(progress_id) {
        $('#update_progress').modal('show');

        $('#table_rows_project').find('tr').click(function(e) {

            var $columns = $(this).find('td');

            $('#progress_date_update').val($columns[1].innerHTML);
            $('#progress_percentage_update').val(parseFloat($columns[3].innerHTML));
            $('#desc_update').val($columns[5].innerHTML);
             $('#task_name_heading').html('<strong>' + $columns[2].innerHTML + '</strong>');
            $('#progress_id_update').val($columns[0].innerHTML);
            $('#task_id').val($columns[8].innerHTML);
        });
    }

    function deleteProgress(progress_id) {
        var result = confirm("Are you sure you Want to delete?");
        if (result) {
            $.ajax({
                url: '<?= base_url(); ?>SO_CW/delete_progress',
                method: 'POST',
                //  type:'json',
                data: {
                    'id': progress_id
                },
                success: function(response) {
                    if (response == 1) {
                        $('#delete_alert').show();
                        setTimeout(function() {
                            $('.alert').hide();
                        }, 2000);

                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                        
                    }
                },
                async: false
            });
        }
    }

    window.onload = function() {
        var count = 1;
        $('#table_rows_project').find('tr').each(function(key, val) {
            var $columns = $(this).find('td');
            $data = $columns[3].innerText;
            $value = $data.substr(0, $data.length - 1);

            if ($value < 50) {
                $("#progress_bar" + count).addClass('bg-danger');
            } else if ($value > 50 && $value <= 75) {
                $("#progress_bar" + count).addClass('bg-warning');
            } else if ($value > 75) {
                $("#progress_bar" + count).addClass('bg-success');
            }

            count++;
        });

    }



    $('#add_btn').on('click', function() {
        //alert('javascript working');
        var validate = 0;
        $('#add_btn').attr('disabled', true);
        var schedule_name = $('#progress_percentage').val();
        var desc = $('#desc').val();

        if (progress_percentage == '') {
            validate = 1;

            $('#progress_percentage').addClass('red-border');
        } else {
            $val = isvalidated($('#progress_percentage').val(), 1, 100);

            if (!$val) {
                validate = 1;
                $('#progress_percentage').addClass('red-border');
            } else {
                $('#progress_percentage').removeClass('red-border');
            }
        }

        if (desc == '') {
            validate = 1;
            $('#desc').addClass('red-border');
        }

        if (validate == 0) {
            $('#add_form')[0].submit();
            $('#show_error').hide();
        } else {
            $('#add_btn').removeAttr('disabled');
            $('#show_error').show();
        }
    });

    $('#update_btn').on('click', function() {
        //alert('javascript working');
        var validate = 0;
        $('#add_btn').attr('disabled', true);
        var schedule_name = $('#progress_percentage_update').val();
        var desc = $('#desc_update').val();

        if (progress_percentage == '') {
            validate = 1;

            $('#progress_percentage_update').addClass('red-border');
        } else {
            $val = isvalidated($('#progress_percentage_update').val(), 1, 100);

            if (!$val) {
                validate = 1;
                $('#progress_percentage_update').addClass('red-border');
            } else {
                $('#progress_percentage_update').removeClass('red-border');
            }
        }

        if (desc == '') {
            validate = 1;
            $('#desc_update').addClass('red-border');
        }

        if (validate == 0) {
            $('#update_form')[0].submit();
            $('#show_error_update').hide();
        } else {
            $('#update_btn').removeAttr('disabled');
            $('#show_error_update').show();
        }
    });
</script>

                 <script type="text/javascript">
  window.onload = function exampleFunction() {
           //alert('HIii');
            $.ajax({
                 url: '<?= base_url(); ?>Project_Officer/update_notification',
                 method: 'POST',
                 datatype:'json',
                 data: {
                     'id': '<?php echo $this->session->userdata('user_id') ;?>' 
                 },
                 success: function(data) {
                     $('#notification').html(data);
                 },
                 async: true
             });
        }
 </script>