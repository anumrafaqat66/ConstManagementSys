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

 <div class="form-group row my-4 mx-5">
     <div class="col-sm-12">
         <h1 style="font-weight: bold;text-align: center;">Project Gantt Chart</h1>
         <h1 style="font-weight: bold;text-align: center;"><?= $project_records['Name'] ?></h1>
     </div>
 </div>

 <div class="container">
     <div class="card o-hidden my-4 border-0 shadow-lg">
         <div class="card-body bg-custom3">
             <div class="card bg-custom3">
                 <div class="card-header bg-custom1">
                     <h1 class="h4">Project Gantt Chart</h1>
                 </div>

                 <div class="card-body">
                     <div style="position:relative" class="gantt" id="GanttChartDIV"></div>
                     <div id="nodata" style="display:none"> There are no tasks scheduled yet.</div>
                 </div>
             </div>
         </div>


         <div class="card-body bg-custom3" style="display:none">
             <!-- Nested Row within Card Body -->
             <div class="row">
                 <div class="col-lg-12">

                     <div class="card bg-custom3">
                         <div class="card-header bg-custom1">
                             <h1 class="h4">Projects</h1>
                         </div>

                         <div class="card-body">
                             <div id="table_div">
                                 <?php if (count($project_schedule) > 0) { ?>
                                     <table id="datatable" class="table table-striped" style="color:black">
                                         <thead>
                                             <tr>
                                                 <th scope="col">ID</th>
                                                 <th scope="col">Schedule Name</th>
                                                 <th scope="col">schedule Start Date</th>
                                                 <th scope="col">schedule End Date</th>
                                                 <th scope="col">progress percentage</th>
                                                 <th scope="col">Schedule Description</th>

                                             </tr>
                                         </thead>
                                         <tbody id="table_rows_project">
                                             <?php $count = 1;
                                                foreach ($project_schedule as $data) { ?>
                                                 <tr>
                                                     <td scope="row" id="cont<?= $count; ?>"><?= $count; ?></td>
                                                     <td scope="row"><?= $data['schedule_name']; ?></a></td>
                                                     <td scope="row"><?= $data['schedule_start_date']; ?></td>
                                                     <td scope="row"><?= $data['schedule_end_date']; ?></td>
                                                     <td scope="row"><?= $data['progress_percentage']; ?></td>
                                                     <td scope="row"><?= $data['schedule_description']; ?></td>
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
                     <form class="user" role="form" method="post" id="add_form" action="">
                         <div class="form-group row my-2 justify-content-center">
                             <div class="col-sm-4">
                                 <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn" data-toggle="modal" data-target="#new_project">
                                     <i class="fas fa-plus"></i>
                                     Add new Project
                                 </button>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>

     </div>
 </div>

 </div>

 <?php $this->load->view('common/footer'); ?>

 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/jsgantt/jsgantt.css" />
 <script language="javascript" src="<?php echo base_url(); ?>assets/jsgantt/jsgantt.js"></script>

 <script>
     function toDate(dateStr) {
         var parts = dateStr.split("-")
         return parts[1] + "/" + parts[2] + "/" + parts[0];
     }

     var g = new JSGantt.GanttChart('g', document.getElementById('GanttChartDIV'), 'day');
     g.setShowRes(1); // Show/Hide Responsible (0/1)
     g.setShowDur(1); // Show/Hide Duration (0/1)
     g.setShowComp(1); // Show/Hide % Complete(0/1)
     g.setCaptionType('Resource'); // Set to Show Caption

     var count = 1;
     $('#table_rows_project').find('tr').each(function(i, el) {
         var $tds = $(this).find('td');

         if (g) {
             g.AddTaskItem(new JSGantt.TaskItem(31, $tds.eq(1).text(), toDate($tds.eq(2).text()), toDate($tds.eq(3).text()), 'ff00ff', '', 0, $tds.eq(5).text(), $tds.eq(4).text(), 0, 3, 1, 'Caption 1'));
         } else {
             alert("not defined");
         }

     });

     g.Draw();
     g.DrawDependencies();

     if ($('#table_rows_project').find('tr').length === 0) {
         $('#nodata').show();
     }
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

     $('#notifications').focusout(function(){
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