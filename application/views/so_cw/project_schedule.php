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

<?php !isset($project_records['Name']) ? $project_records['Name'] = '' : $project_records['Name']; ?>
<?php !isset($project_records['Start_date']) ? $project_records['Start_date'] = '' : $project_records['Start_date']; ?>

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
    <div class="d-sm-flex align-items-center justify-content-between mb-4 my-2">
        <h1 class="my-4"><strong>Tasks Schedule of <?php echo $project_records['Name']; ?></strong></h1>
        <a onclick="location.href='<?php echo base_url(); ?>SO_CW/report_project_schedule/<?= $project_id; ?>'" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-print text-white-50"></i> Print Page</a>
    </div>

    <div class="modal fade" id="new_schedule">
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
                                    <h1 class="h4">Add Task</h1>
                                </div>

                                <div class="card-body bg-custom3">
                                    <form class="user" role="form" method="post" id="new_form" action="">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <h3 id="schedule_name_heading"></h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <h6>&nbsp;Task Title:</h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <h6>&nbsp;Task Start Date:</h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <h6>&nbsp;Task End Date:</h6>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-4 mb-1">
                                                <input type="text" class="form-control form-control-user" name="event_title" id="event_title" placeholder="Event Title">
                                            </div>
                                            <div class="col-sm-4 mb-1">
                                                <input type="date" class="form-control form-control-user" name="event_start_date" id="event_start_date" placeholder="Start Date" readonly>
                                            </div>
                                            <div class="col-sm-4 mb-1">
                                                <input type="date" class="form-control form-control-user" name="event_end_date" id="event_end_date" placeholder="End Date">
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <h6>&nbsp;Enter Tasks Details:</h6>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12 mb-1">
                                                <textarea class="form-control" style="height:120px" name="add_event_desc" id="add_event_desc" placeholder="Enter Task details"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row justify-content-center">
                                            <div class="col-sm-4">
                                                <button type="button" class="btn btn-primary btn-user btn-block" id="add_event" name="add_event">
                                                    <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                    ADD TASK
                                                </button>
                                                <span id="show_error_add" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors</span>
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

    <div class="modal fade" id="edit_schedule">
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
                                    <h1 class="h4">Update Task</h1>
                                </div>

                                <div class="card-body bg-custom3">
                                    <form class="user" role="form" method="post" id="add_form" action="<?= base_url(); ?>SO_CW/update_schedule/<?= $project_id ?>">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <h3 id="schedule_name_heading"></h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <h6>&nbsp;Task Date:</h6>
                                            </div>

                                            <div class="col-sm-3">
                                                <h6>&nbsp;Task Name:</h6>
                                            </div>
                                            <div class="col-sm-3">
                                                <h6>&nbsp;Task Start Date:</h6>
                                            </div>

                                            <div class="col-sm-3">
                                                <h6>&nbsp;Task End Date:</h6>
                                            </div>

                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-3 mb-1">
                                                <input type="date" class="form-control form-control-user" name="schedule_date" id="schedule_date" placeholder="Select Date" value="" readonly>
                                            </div>

                                            <div class="col-sm-3 mb-1" style="display:none">
                                                <input type="text" class="form-control form-control-user" name="schedule_id" id="schedule_id" placeholder="Schedule Name">
                                            </div>
                                            <div class="col-sm-3 mb-1" style="display:none">
                                                <input type="text" class="form-control form-control-user" name="project_start_date" id="project_start_date" value="<?php echo $project_records['Start_date'] ?>">
                                            </div>

                                            <div class="col-sm-3 mb-1">
                                                <input type="text" class="form-control form-control-user" name="schedule_name" id="schedule_name" placeholder="Schedule Name">
                                            </div>

                                            <div class="col-sm-3">
                                                <input type="date" class="form-control form-control-user" name="start_date" id="start_date" placeholder="Select Date*" value="">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="date" class="form-control form-control-user" name="end_date" id="end_date" placeholder="Select Date*" value="">
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <h6>&nbsp;Enter Tasks Details:</h6>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12 mb-1">
                                                <textarea class="form-control" style="height:120px" name="desc_update" id="desc_update" placeholder="Enter Task details"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row justify-content-center">
                                            <div class="col-sm-4">
                                                <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn">
                                                    <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                    Update Task Schedule
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



    <!-- <div class="col-md-12 img">
     </div> -->

    <!-- <div class="response"></div> -->
    <div class="col-lg-12">
        <div id="event_alert" class="alert alert-success" role="alert" style="display:none">
            Task Scheduled successfully!!
        </div>
    </div>

    <div id='calendar'></div>

    <form class="user" role="form" method="post" id="add_form">

        <div class="card-body bg-custom3 my-4">
            <div class="row">
                <div class="col-lg-12">
                    <div id="delete_alert" class="alert alert-success" role="alert" style="display:none">
                        Task deleted successfully!!
                    </div>
                </div>

                <div class="col-lg-12">

                    <div class="card bg-custom3">
                        <div class="card-header bg-custom1">
                            <h1 class="h4">Existing Tasks</h1>
                        </div>

                        <div class="card-body">
                            <div id="table_div">
                                <?php if (count($project_schedule) > 0) { ?>
                                    <table id="datatable" class="table table-striped" style="color:black">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <!-- <th scope="col">Task Creation Date</th> -->
                                                <th scope="col">Task Name</th>
                                                <th scope="col">Task Details</th>
                                                <th scope="col">Start Date</th>
                                                <th scope="col">End Date</th>
                                                <th scope="col">Duration</th>
                                                <th scope="col">Status</th>
                                                <?php if ($this->session->userdata('acct_type') == 'SO_CW') { ?>
                                                    <th scope="col">Edit</th>
                                                    <th scope="col">Delete</th>
                                                <?php } ?>

                                            </tr>
                                        </thead>
                                        <tbody id="table_rows_schedule">
                                            <?php $count = 1;
                                            foreach ($project_schedule as $data) {
                                                $diff = date_diff(date_create($data['schedule_start_date']), date_create($data['schedule_end_date'])); ?>
                                                <tr>
                                                    <td scope="row" id="cont<?= $count; ?>"><?= $count; ?></td>
                                                    <td scope="row" style="display:none"><?= $data['id']; ?></td>
                                                    <td scope="row" style="display:none"><?= $data['schedule_date']; ?></td>
                                                    <td scope="row" id="taskname<?= $data['id']; ?>"><?= $data['schedule_name']; ?></td>
                                                    <td scope="row"><?= $data['schedule_description']; ?></td>
                                                    <td scope="row" style='white-space: nowrap;'><?= $data['schedule_start_date']; ?></td>
                                                    <td scope="row" style='white-space: nowrap;'><?= $data['schedule_end_date']; ?></td>
                                                    <td scope="row"><?php echo $diff->format('%d days'); ?></td>
                                                    <td scope="row"><?= $data['Status']; ?></td>
                                                    <?php if ($this->session->userdata('acct_type') == 'SO_CW') { ?>
                                                        <td style="text-align:center" id="edit<?= $data['id']; ?>" onclick="editSchedule(<?= $data['id']; ?>)" scope="row" data-toggle="modal" data-target="#edit_project"><i style="cursor:pointer;" class="fas fa-edit"></i></td>
                                                        <td style="text-align:center" id="delete<?= $data['id']; ?>" onclick="deleteSchedule(<?= $data['id']; ?>)" scope="row" data-toggle="modal" data-target="#edit_project"><i style="cursor:pointer;" class="fas fa-trash-alt"></i></td>
                                                    <?php } ?>
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
                             <button type="button" class="btn btn-primary btn-user btn-block" id="add_sch_btn" data-toggle="modal" data-target="#new_schedule">
                                 <i class="fas fa-plus"></i>
                                 Add New Schedule
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
    function editSchedule(sch_id) {
        $('#edit_schedule').modal('show');

        $('#table_rows_schedule').find('tr').click(function(e) {

            var $columns = $(this).find('td');

            $('#schedule_date').val($columns[2].innerHTML);
            $('#schedule_name').val($columns[3].innerHTML);
            $('#start_date').val($columns[5].innerHTML);
            $('#end_date').val($columns[6].innerHTML);
            $('#desc_update').val($columns[4].innerHTML);
            $('#schedule_name_heading').html('<strong>' + $columns[2].innerHTML + '</strong>');
            $('#schedule_id').val($columns[1].innerHTML);
        });
    }

    //  var global_task_name;
    //  $('#table_rows_schedule').find('tr').click(function(e) {
    //      var $columns = $(this).find('td');
    //      //  $('#schedule_name').val($columns[3].innerHTML);
    //      global_task_name = $columns[3].innerHTML;
    //     //  alert(global_task_name);
    //  });

    function deleteSchedule(sch_id) {

        var task_name = document.getElementById('taskname' + sch_id).innerText;

        var result = confirm("Are you sure you Want to delete?");
        if (result) {
            $.ajax({
                url: '<?= base_url(); ?>SO_CW/delete_schedule',
                method: 'POST',
                //  type:'json',
                data: {
                    'id': sch_id,
                    'task_name': task_name
                },
                success: function(response) {
                    if (response == 1) {
                        $('#delete_alert').show();
                        setTimeout(function() {
                            $('.alert').hide();
                        }, 2000);

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                },
                async: false
            });
        }

    }

    $('#add_event').on('click', function() {
        var validate = 0;
        elementClicked = true;

        event_name = $('#event_title').val();
        event_desc = $('#add_event_desc').val();
        event_start = $('#event_start_date').val();
        event_end = $('#event_end_date').val();

        if (event_name == '') {
            validate = 1;
            $('#event_title').addClass('red-border');
        }
        if (event_desc == '') {
            validate = 1;
            $('#add_event_desc').addClass('red-border');
        }
        if (event_end == '') {
            validate = 1;
            $('#event_end_date').addClass('red-border');
        }

        if (validate == 0) {
            $('#show_error_add').hide();
            $('#new_schedule').modal('hide');

            $.ajax({
                url: '<?= base_url(); ?>SO_CW/add_event',
                data: 'title=' + event_name + '&start=' + event_start + '&end=' + event_end + '&project_id=' + <?php echo json_encode($project_id, JSON_NUMERIC_CHECK); ?> + '&desc=' + event_desc,
                type: "POST",
                success: function(data) {
                    //  displayMessage("Added Successfully");
                    $('#event_alert').show();
                    setTimeout(function() {
                        $('.alert').hide();
                    }, 2000);

                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                },
                async: true
            });
        } else {

            $('#show_error_add').show();
        }

    });

    $(document).ready(function() {
        var user = '<?= $this->session->userdata('acct_type'); ?>';

        var calendar = $('#calendar').fullCalendar({
            editable: true,
            plugins: ['interaction', 'dayGrid'],
            //  defaultDate: '2020-02-12',
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: {
                url: '<?= base_url(); ?>SO_CW/fetch_event',
                type: 'POST',
                data: {
                    'project_id': <?php echo json_encode($project_id, JSON_NUMERIC_CHECK); ?>,
                },
                color: '#000154',
                textColor: 'white'
            },
            displayEventTime: false,
            async: false,
            //  eventRender: function(event, element, view) {
            //      if (event.allDay === 'true') {
            //          event.allDay = true;
            //      } else {
            //          event.allDay = false;
            //      }
            //  },
            selectable: true,
            selectHelper: true,

            select: function(start, end, allDay) {
                var project_start_date = $('#project_start_date').val();
                var date = new Date(start),
                    yr = date.getFullYear(),
                    month = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
                    day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
                    startDate = yr + '-' + month + '-' + day;
                var date = new Date(end),
                    yr = date.getFullYear(),
                    month = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
                    day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
                    endDate = yr + '-' + month + '-' + day;

                if (startDate > project_start_date) {
                    if (user == 'SO_CW') {
                        $('#new_schedule').modal('show');
                        $('#event_start_date').val(startDate);
                        // $('#event_end_date').val(endDate);
                    }
                }
            },
            //  select: function(start, end, allDay) {
            //      //alert('clicked calender');
            //      var project_start_date = $('#project_start_date').val();
            //      var date = new Date(start),
            //          yr = date.getFullYear(),
            //          month = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
            //          day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
            //          newDate = yr + '-' + month + '-' + day;

            //      if (newDate > project_start_date) {
            //          if (user == 'SO_CW') {
            //              //  var title = prompt('Event Title:');
            //              $('#new_schedule').modal('show');
            //              var title = global_event_name;
            //              var desc = global_event_desc;

            //              if (title) {
            //                  var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
            //                  var end = $.fullCalendar.formatDate(end, "Y-MM-DD");

            //                  //  var desc = prompt('Enter details of event ' + title + ' on date ' + start)
            //                  $.ajax({
            //                      url: '<?= base_url(); ?>SO_CW/add_event',
            //                      data: 'title=' + title + '&start=' + start + '&end=' + end + '&project_id=' + <?php echo json_encode($project_id, JSON_NUMERIC_CHECK); ?> + '&desc=' + desc,
            //                      type: "POST",
            //                      success: function(data) {
            //                          displayMessage("Added Successfully");
            //                      },
            //                      async: false
            //                  });
            //                  calendar.fullCalendar('renderEvent', {
            //                          title: title,
            //                          start: start,
            //                          end: end,
            //                          allDay: allDay
            //                      },
            //                      true
            //                  );
            //              }
            //              calendar.fullCalendar('unselect');
            //          }
            //      } else {
            //          alert('Event cannot be added less than project start Date')
            //      }
            //  },

        });
    });

    function displayMessage(message) {
        $(".response").html("<div class='success'>" + message + "</div>");
        setInterval(function() {
            $(".success").fadeOut();
        }, 3000);
    }

    $('#add_btn').on('click', function() {
        var validate = 0;
        $('#add_btn').attr('disabled', true);
        var schedule_name = $('#schedule_name').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var desc = $('#desc').val();

        if (schedule_name == '') {
            validate = 1;
            $('#schedule_name').addClass('red-border');
        }
        if (start_date == '') {
            validate = 1;
            $('#start_date').addClass('red-border');
        }
        if (end_date == '') {
            validate = 1;
            $('#end_date').addClass('red-border');
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
</script>

<script type="text/javascript">
    function seen(data) {
        // alert('in');
        // alert(data);
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