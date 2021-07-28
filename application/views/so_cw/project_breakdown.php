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
         <h1 style="font-weight: bold;text-align: center;">Project Breakdown Structure</h1>
         <h1 id="project_name" style="font-weight: bold;text-align: center;"><?= $project_records['Name'] ?></h1>
     </div>
 </div>

 <div class="container">
     <div class="card o-hidden my-4 border-0 shadow-lg">
         <div class="card-body bg-custom3">
             <div class="card bg-custom3">
                 <div class="card-header bg-custom1">
                     <h1 class="h4">BreakDown Chart</h1>
                 </div>

                 <div class="card-body">
                     <div id="chart_div"></div>
                     <div id="nodata" style="display:none"> There are no tasks configured for this project yet.</div>
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

 <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/jsgantt/jsgantt.css" /> -->
 <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/charts/loader.js"></script>
 <!-- <script language="javascript" src="<?php echo base_url(); ?>assets/jsgantt/jsgantt.js"></script> -->

 <script>
     $project_name = $('#project_name').html();

     function toDate(dateStr) {
         var parts = dateStr.split("-")
         return parts[1] + "/" + parts[2] + "/" + parts[0];
     }

     if ($('#table_rows_project').find('tr').length === 0) {
         $('#nodata').show();
     } else {
         google.charts.load('current', {
             packages: ["orgchart"]
         });
         google.charts.setOnLoadCallback(drawChart);

         function drawChart() {
             var data = new google.visualization.DataTable();
             data.addColumn('string', 'Name');
             data.addColumn('string', 'Manager');
             data.addColumn('string', 'ToolTip');

             data.addRows([
                 [{
                         'v': $project_name,
                         'f': $project_name + '<div style="color:red; font-style:italic">Project Name</div>'
                     },
                     '', 'Project Name'
                 ]
             ]);

             // For each orgchart box, provide the name, manager, and tooltip to show.
             $('#table_rows_project').find('tr').each(function(i, el) {
                 var $tds = $(this).find('td');
                 data.addRows([
                     [{
                             'v': $tds.eq(1).text(),
                             'f': $tds.eq(1).text() + `<div style="color:black; font-style:italic">Start Date: ${$tds.eq(2).text()}</div>
                                                    <div style="color:black; font-style:italic">Progress: ${$tds.eq(4).text()}%</div>`
                         },
                         $project_name, $tds.eq(1).text()
                     ]
                 ]);
             });

             // Create the chart.
             var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
             // Draw the chart, setting the allowHtml option to true for the tooltips.
             chart.draw(data, {
                 'allowHtml': true
             });
         }
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