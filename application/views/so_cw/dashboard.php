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
 </style>

 <div class="container">

     <h2 class="my-4">Welcome, SO CW!</h2>

     <div class="col-md-12 img">
     </div>

     <form class="user" role="form" method="post" id="add_form">

         <div class="card-body bg-custom3 my-4">

             <div class="row">
                 <div class="col-lg-12">

                     <div class="card bg-custom3">
                         <div class="card-header bg-custom1">
                             <h1 class="h4">Projects</h1>
                         </div>

                         <div class="card-body">
                             <div id="table_div">
                                 <?php if (count($project_records) > 0) { ?>
                                     <table id="datatable" class="table table-striped" style="color:black;white-space: nowrap;text-align:center">
                                         <thead>
                                             <tr>
                                                 <th scope="col">ID</th>
                                                 <th scope="col">Name</th>
                                                 <th scope="col">Project Code</th>
                                                 <th scope="col">Start Date</th>
                                                 <th scope="col">Status</th>
                                                 <th scope="col">Overall Progress</th>
                                                 <th scope="col">Schedule</th>
                                                 <th scope="col">Progress</th>
                                                 <th scope="col">WBS</th>
                                                 <th scope="col">Gantt chart</th>
                                                 <th scope="col" style="display:none">Contractor ID</th>
                                                 <th scope="col" style="display:none">Bid ID</th>
                                             </tr>
                                         </thead>
                                         <tbody id="table_rows_project">
                                             <?php $count = 1;
                                                foreach ($project_records as $data) { ?>
                                                 <tr>
                                                     <td scope="row" id="cont<?= $count; ?>"><?= $count; ?></td>
                                                     <td style="white-space: nowrap;color:black; font-weight:800;" scope="row"><?= $data['Name']; ?></td>
                                                     <td id="quant<?= $data['ID']; ?>" class="quant" scope="row"><?= $data['Code']; ?></td>
                                                     <td scope="row" style="white-space: nowrap;"><?= $data['Start_date']; ?></td>
                                                     <td style="white-space: nowrap;" scope="row"><?= $data['Status']; ?></td>
                                                     <?php if($data['total_rows'] == 0) { $num = 1;} else {$num = $data['total_rows']; } ?>
                                                     <td scope="row" style="text-align:center; color:black; font-weight:800"><?= round($data['total_percentage']/$num,2); ?>%</td>
                                                     <td style="" scope="row"><a href="<?= base_url(); ?>SO_CW/view_project_schedule/<?= $data['ID']; ?>" style="color:black"><i style="font-size:30px" class="fas fa-calendar-alt"></i></a></td>
                                                     <!-- <td style="width:150px" scope="row"><a href="<?= base_url(); ?>SO_CW/view_project_progress/<?= $data['ID']; ?>" style="color:black"><i style="margin-left: 50px; font-size:30px" class="fas fa-chart-line"></i></a></td> -->
                                                     <td style="" scope="row"><a type="button" onclick="location.href='<?php echo base_url(); ?>SO_CW/view_project_progress/<?= $data['ID']; ?>'" style="color:black"><i style="font-size:30px" class="fas fa-chart-line"></i></a></td>
                                                     <td style="" scope="row"><a type="button" onclick="location.href='<?php echo base_url(); ?>SO_CW/view_project_breakdown/<?= $data['ID']; ?>'" style="color:black"><i style="font-size:30px" class="fas fa-project-diagram"></i></a></td>
                                                     <td style="" scope="row"><a type="button" onclick="location.href='<?php echo base_url(); ?>SO_CW/view_project_ganttchart/<?= $data['ID']; ?>'" style="color:black"><i style="font-size:30px" class="fas fa-chart-bar"></i></a></td>
                                                     
                                                     <td scope="row" style="display:none;"><?= $data['contractor_id']; ?></td>
                                                     <td scope="row" style="display:none;"><?= $data['bid_id']; ?></td>
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

                 </div>
             </div>
         </div>
     </form>


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
 </script>