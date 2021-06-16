 <?php $this->load->view('project_officer/common/header'); ?>

 <style>
     .img {
         background: url('<?= base_url() ?>assets/img/project-overview-banner.jpg');
         background-size: cover;
         height: 200px;
         filter: blur(1px);
         border-radius: 25px;
         margin-top: 30px;
     }

     .bg-text {
         color: black;
         font-weight: bold;
         position: absolute;
         top: 28%;
         left: 80%;
         transform: translate(-50%, -50%);
         z-index: 2;
         width: 30%;
         height: 0%;
         text-align: center;
         font-size: 45px;
     }

     .red-border {
         border: 1px solid red !important;
     }
 </style>

 <div class="container">

     <!-- <h2 class="my-4">Welcome, Project officer!</h2> -->

     <div class="col-md-12 img">
     </div>
     <div class="bg-text">Project Overview</div>


     <div class="modal fade" id="project_name">
         <!-- <div class="row"> -->
         <div class="modal-dialog modal-dialog-centered " style="margin-left: 370px;" role="document">
             <div class="modal-content bg-custom3" style="width:1000px;">
                 <div class="modal-header" style="width:1000px;">

                 </div>
                 <div class="card-body bg-custom3">
                     <!-- Nested Row within Card Body -->
                     <div class="row">
                         <div class="col-lg-12">

                             <div class="card">
                                 <div class="card-header bg-custom1">
                                     <h1 class="h4">Project Name</h1>
                                 </div>

                                 <div class="card-body bg-custom3">
                                     <form class="user" role="form" method="post" id="add_form_bids" action="">

                                         <div class="form-group row">
                                             <div class="col-sm-12">
                                                 <h1><strong><?php echo $project_records['Name'] ?></strong></h1>
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
     <div class="modal fade" id="project_bids">
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
                                     <h1 class="h4">Project Bids</h1>
                                 </div>

                                 <div class="card-body bg-custom3">
                                     <form class="user" role="form" method="post" id="add_form_bids" action="">

                                         <div class="card-body">
                                             <div id="table_div">
                                                 <?php if (count($project_bids) > 0) { ?>
                                                     <table id="datatable" class="table table-striped" style="color:black">
                                                         <thead>
                                                             <tr>
                                                                 <th scope="col">ID</th>
                                                                 <th scope="col">Contactor Name</th>
                                                                 <th scope="col">Bid Amount</th>
                                                             </tr>
                                                         </thead>
                                                         <tbody id="table_rows_project">
                                                             <?php $count = 0;
                                                                foreach ($project_bids as $data) { ?>
                                                                 <tr>
                                                                     <td scope="row"><?= ++$count; ?></td>
                                                                     <td scope="row"><?= $data['Name']; ?></td>
                                                                     <td scope="row"><?= $data['bid_amount']; ?></td>
                                                                 </tr>
                                                             <?php
                                                                } ?>
                                                         </tbody>
                                                     </table>
                                                 <?php } else { ?>
                                                     <a> No Data Available yet </a>
                                                 <?php } ?>
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
     <div class="modal fade" id="project_contractor">
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
                                     <h1 class="h4">Project Assigned Contractor</h1>
                                 </div>

                                 <div class="card-body bg-custom3">
                                     <form class="user" role="form" method="post" id="add_form_bids" action="">

                                         <div class="card-body">
                                             <div id="table_div">
                                                 <?php if (count($project_contractor) > 0) { ?>
                                                     <table id="datatable" class="table table-striped" style="color:black">
                                                         <thead>
                                                             <tr>
                                                                 <th scope="col">ID</th>
                                                                 <th scope="col">Contactor Name</th>
                                                                 <th scope="col">Contact No</th>
                                                                 <th scope="col">Email</th>
                                                                 <th scope="col">Description</th>
                                                                 <th scope="col">Status</th>
                                                             </tr>
                                                         </thead>
                                                         <tbody id="table_rows_project">
                                                             <?php $count = 0;
                                                                foreach ($project_contractor as $data) { ?>
                                                                 <tr>
                                                                     <td scope="row"><?= ++$count; ?></td>
                                                                     <td scope="row"><?= $data['contractor_name']; ?></td>
                                                                     <td scope="row"><?= $data['Contact_no']; ?></td>
                                                                     <td scope="row"><?= $data['Email_id']; ?></td>
                                                                     <td scope="row"><?= $data['Description']; ?></td>
                                                                     <td scope="row"><?= $data['Status']; ?></td>
                                                                 </tr>
                                                             <?php
                                                                } ?>
                                                         </tbody>
                                                     </table>
                                                 <?php } else { ?>
                                                     <a> No Data Available yet </a>
                                                 <?php } ?>
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

         <div class="form-group row justify-content-center" style="margin-top:50px;">
             <div class="col-sm-4">
                 <button type="button" class="btn btn-primary btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_inventory" data-toggle="modal" data-target="#project_name">
                     <h4 style="font-weight: bold;">Project Name</h4>
                 </button>
             </div>

             <div class="col-sm-4">
                 <button type="button" class="btn btn-primary btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_material" data-toggle="modal" data-target="#project_bids">
                     <h4 style="font-weight: bold;">Project Bids</h4>
                 </button>
             </div>

             <div class="col-sm-4">
                 <button type="button" class="btn btn-primary btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_material" data-toggle="modal" data-target="#project_contractor">
                     <h4 style="font-weight: bold;">Project Contractor</h4>
                 </button>
             </div>

         </div>


         <div class="form-group row justify-content-center" style="margin-top:50px;">
             <div class="col-sm-4">
                 <button type="button" class="btn btn-primary btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_inventory" onclick="location.href='<?php echo base_url(); ?>Project_Officer/add_projects'">
                     <h4 style="font-weight: bold;">Project Drawings</h4>
                 </button>
             </div>

             <div class="col-sm-4">
                 <button type="button" class="btn btn-primary btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_material" onclick="location.href='<?php echo base_url(); ?>Project_Officer/add_contractors'">
                     <h4 style="font-weight: bold;">Work Breakdown Structure</h4>
                 </button>
             </div>

             <div class="col-sm-4">
                 <button type="button" class="btn btn-primary btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_material" onclick="location.href='<?php echo base_url(); ?>Project_Officer/add_contractors'">
                     <h4 style="font-weight: bold;">Project Progress</h4>
                 </button>
             </div>

         </div>

         <div class="form-group row justify-content-center" style="margin-top:50px; margin-bottom:50px">
             <div class="col-sm-4">
                 <button type="button" class="btn btn-primary btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_inventory" onclick="location.href='<?php echo base_url(); ?>Project_Officer/add_projects'">
                     <h4 style="font-weight: bold;">Project Schedule</h4>
                 </button>
             </div>

             <div class="col-sm-4">
                 <button type="button" class="btn btn-primary btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_material" onclick="location.href='<?php echo base_url(); ?>Project_Officer/add_contractors'">
                     <h4 style="font-weight: bold;">Project Chart</h4>
                 </button>
             </div>

             <div class="col-sm-4">
                 <button type="button" class="btn btn-primary btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_material" onclick="location.href='<?php echo base_url(); ?>Project_Officer/add_contractors'">
                     <h4 style="font-weight: bold;">Project Report</h4>
                 </button>
             </div>

         </div>

     </form>


 </div>

 </div>


 <?php $this->load->view('common/footer'); ?>