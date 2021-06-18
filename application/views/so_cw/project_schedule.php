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
         background-color: white ;
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
                                     <h1 class="h4">Add New Schedule</h1>
                                 </div>

                                 <div class="card-body bg-custom3">
                                     <form class="user" role="form" method="post" id="add_form" action="<?= base_url(); ?>SO_CW/insert_schedule/<?= $project_id ?>">
                                         <div class="form-group row">
                                             <div class="col-sm-3">
                                                 <h6>&nbsp;Schedule Date:</h6>
                                             </div>

                                             <div class="col-sm-3">
                                                 <h6>&nbsp;Schedule Name:</h6>
                                             </div>
                                             <div class="col-sm-3">
                                                 <h6>&nbsp;Expected Start Date:</h6>
                                             </div>

                                             <div class="col-sm-3">
                                                 <h6>&nbsp;Expected Completion Date:</h6>
                                             </div>

                                         </div>


                                         <div class="form-group row">
                                             <div class="col-sm-3 mb-1">
                                                 <input type="date" class="form-control form-control-user" name="schedule_date" id="schedule_date" placeholder="Select Date" value="">
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
                                                 <h6>&nbsp;Enter Schedule Tasks Details:</h6>
                                             </div>
                                         </div>

                                         <div class="form-group row">
                                             <div class="col-sm-12 mb-1">
                                                 <textarea class="form-control" style="height:120px" name="desc" id="desc" placeholder="Enter schedule details"></textarea>
                                             </div>
                                         </div>

                                         <div class="form-group row justify-content-center">
                                             <div class="col-sm-4">
                                                 <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn">
                                                     <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                     Create Project Schedule
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

     <h1 class="my-4"><strong>Project Schedule</strong></h1>

     <!-- <div class="col-md-12 img">
     </div> -->

     <!-- <div class="response"></div> -->
     <div id='calendar'></div>


     <form class="user" role="form" method="post" id="add_form">

         <div class="card-body bg-custom3 my-4">

             <div class="row">
                 <div class="col-lg-12">

                     <div class="card bg-custom3">
                         <div class="card-header bg-custom1">
                             <h1 class="h4">Existing Schedules</h1>
                         </div>

                         <div class="card-body">
                             <div id="table_div">
                                 <?php if (count($project_schedule) > 0) { ?>
                                     <table id="datatable" class="table table-striped" style="color:black">
                                         <thead>
                                             <tr>
                                                 <th scope="col">ID</th>
                                                 <th scope="col">Schedule Creation Date</th>
                                                 <th scope="col">Schedule Name</th>
                                                 <th scope="col">Schedule Start Date</th>
                                                 <th scope="col">Status</th>

                                             </tr>
                                         </thead>
                                         <tbody id="table_rows_project">
                                             <?php $count = 1;
                                                foreach ($project_schedule as $data) { ?>
                                                 <tr>
                                                     <td scope="row" id="cont<?= $count; ?>"><?= $count; ?></td>
                                                     <td scope="row"><?= $data['schedule_date']; ?></td>
                                                     <td scope="row"><?= $data['schedule_name']; ?></td>
                                                     <td scope="row"><?= $data['schedule_start_date']; ?></td>
                                                     <td scope="row"><?= $data['Status']; ?></td>
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
     $(document).ready(function() {
         var calendar = $('#calendar').fullCalendar({
             editable: true,
             plugins: ['interaction', 'dayGrid'],
             //  defaultDate: '2020-02-12',
             editable: true,
             eventLimit: true, // allow "more" link when too many events
             events: {
                 url: '<?= base_url(); ?>SO_CW/fetch_event',
                 color: '#ca9e0c', 
                 textColor: '#3c3d3d' 
             }, 
             displayEventTime: false,
             async: false,
             eventRender: function(event, element, view) {
                 if (event.allDay === 'true') {
                     event.allDay = true;
                 } else {
                     event.allDay = false;
                 }
             },
             selectable: true,
             selectHelper: true,
             select: function(start, end, allDay) {
                 var title = prompt('Event Title:');
                 //  var desc = prompt('Add Event Details:');
                 //  $('#new_schedule').modal('show');

                 if (title) {
                     var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                     var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                     $.ajax({
                         url: '<?= base_url(); ?>SO_CW/add_event',
                         data: 'title=' + title + '&start=' + start + '&end=' + end + '&project_id=' + <?php echo json_encode($project_id, JSON_NUMERIC_CHECK); ?> + '&desc=' + desc,
                         type: "POST",
                         success: function(data) {
                             displayMessage("Added Successfully");
                         }
                     });
                     calendar.fullCalendar('renderEvent', {
                             title: title,
                             start: start,
                             end: end,
                             allDay: allDay
                         },
                         true
                     );
                 }
                 calendar.fullCalendar('unselect');
             },

             editable: true,
             eventDrop: function(event, delta) {
                 var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                 var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                 $.ajax({
                     url: 'edit-event.php',
                     data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                     type: "POST",
                     success: function(response) {
                         displayMessage("Updated Successfully");
                     }
                 });
             },
             eventClick: function(event) {
                 var deleteMsg = confirm("Do you really want to delete?");
                 if (deleteMsg) {
                     $.ajax({
                         type: "POST",
                         url: "delete-event.php",
                         data: "&id=" + event.id,
                         success: function(response) {
                             if (parseInt(response) > 0) {
                                 $('#calendar').fullCalendar('removeEvents', event.id);
                                 displayMessage("Deleted Successfully");
                             }
                         }
                     });
                 }
             }

         });
     });

     function displayMessage(message) {
         $(".response").html("<div class='success'>" + message + "</div>");
         setInterval(function() {
             $(".success").fadeOut();
         }, 3000);
     }


     $('#add_btn').on('click', function() {
         //alert('javascript working');
         $('#add_btn').attr('disabled', true);
         var validate = 0;

         var schedule_date = $('#schedule_date').val();
         var schedule_name = $('#schedule_name').val();
         var start_date = $('#start_date').val();
         var end_date = $('#end_date').val();
         var desc = $('#desc').val();

         if (schedule_date == '') {
             validate = 1;
             $('#schedule_date').addClass('red-border');
         }
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