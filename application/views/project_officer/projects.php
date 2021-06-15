 <?php $this->load->view('project_officer/common/header'); ?>

 <style>
     .red-border {
         border: 1px solid red !important;
     }

     .modal {
         display: none;
         position: fixed;
         padding-top: 100px;
         left: 0;
         right: 0;
         top: 0;
         bottom: 0;
         overflow: auto;
         z-index: 9999;
     }
 </style>

 <div class="container">
     <div class="card o-hidden my-4 border-0 shadow-lg">

         <div class="modal fade" id="new_bids">
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
                                         <h1 class="h4">Enter Project Bids</h1>
                                     </div>

                                     <div class="card-body bg-custom3">
                                         <form class="user" role="form" method="post" id="add_form" action="<?= base_url(); ?>Project_Officer/insert_project">

                                             <div class="add_rows" id="add_bid_rows">
                                                 <div class="form-group row">
                                                     <div class="col-sm-3">
                                                         <h6>&nbsp;Contractor:</h6>
                                                     </div>

                                                     <div class="col-sm-3">
                                                         <h6>&nbsp;Bid Amount</h6>
                                                     </div>

                                                     <div class="col-sm-3">

                                                     </div>

                                                     <div class="col-sm-2">
                                                         Add New Row
                                                     </div>
                                                     <div class="col-sm-1">
                                                         <i id="add_row" type="button" class="far fa-plus-square" style="font-size:25px; margin-top:2px"></i>
                                                     </div>

                                                 </div>


                                                 <div class="form-group row">
                                                     <div class="col-sm-3 mb-1">
                                                         <select class="form-control rounded-pill" name="contractor" id="contractor" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                                             <option class="form-control form-control-user" value="">Select Contractor Name</option>
                                                             <?php foreach ($contractor_name as $contractor) { ?>
                                                                 <option class="form-control form-control-user" value="<?= $contractor['ID'] ?>"><?= $contractor['Name'] ?></option>
                                                             <?php } ?>
                                                         </select>
                                                     </div>

                                                     <div class="col-sm-3 mb-1">
                                                         <input type="text" class="form-control form-control-user" name="bid_amount" id="bid_amount" placeholder="Bid Amount">
                                                     </div>


                                                 </div>
                                             </div>

                                             <div class="form-group row justify-content-center">
                                                 <div class="col-sm-4">
                                                     <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn">
                                                         <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                         Submit Bids
                                                     </button>
                                                     <span id="show_error_new" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                                                 </div>
                                             </div>
                                         </form>
                                     </div>
                                 </div>


                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <!-- <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button> -->
                     </div>
                 </div>
             </div>
         </div>


         <div class="modal fade" id="new_contractor">
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
                                         <h1 class="h4">Add New Project</h1>
                                     </div>

                                     <div class="card-body bg-custom3">
                                         <form class="user" role="form" method="post" id="add_form" action="<?= base_url(); ?>Project_Officer/insert_project">
                                             <div class="form-group row">
                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Name:</h6>
                                                 </div>

                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Code:</h6>
                                                 </div>

                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Start Date:</h6>
                                                 </div>

                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Assigned Bid:</h6>
                                                 </div>

                                             </div>


                                             <div class="form-group row">
                                                 <div class="col-sm-3 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="project_name" id="project_name" placeholder="Project Name">
                                                     <span id="show_project_name_error" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please enter project name & code first</span>
                                                 </div>

                                                 <div class="col-sm-3 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="code" id="code" placeholder="Project Code.">
                                                 </div>

                                                 <div class="col-sm-3 mb-1">
                                                     <input type="date" class="form-control form-control-user" name="start_date" id="start_date" placeholder="Start Date">
                                                     <!--  <span id="show_error_email" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;not valid email id</span> -->
                                                 </div>

                                                 <div class="col-sm-2 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="code" id="code" placeholder="Select Bids">
                                                 </div>

                                                 <div class="col-sm-1 mb-1">
                                                     <span><a href="#"><i class="fas fa-folder-plus" type="" data-toggle="modal" data-target="#new_bids1" id="add_bids" style="font-size: 40px; margin-top:2px; color:black"></i></a></span>
                                                 </div>
                                             </div>

                                             <div class="form-group row">
                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Assigned Contractor:</h6>
                                                 </div>
                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Created By:</h6>
                                                 </div>
                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Total Cost:</h6>
                                                 </div>

                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Status:</h6>
                                                 </div>


                                             </div>

                                             <div class="form-group row">
                                                 <div class="col-sm-3">
                                                     <select class="form-control rounded-pill" name="contractor" id="contractor" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                                         <option class="form-control form-control-user" value="">Select Contractor Name</option>
                                                         <?php foreach ($contractor_name as $contractor) { ?>
                                                             <option class="form-control form-control-user" value="<?= $contractor['ID'] ?>"><?= $contractor['Name'] ?></option>
                                                         <?php } ?>
                                                     </select>
                                                 </div>

                                                 <div class="col-sm-3 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="created_by" id="created_by" placeholder="Created By.">
                                                 </div>

                                                 <div class="col-sm-3 mb-1">
                                                     <input type="number" class="form-control form-control-user" name="total_cost" id="total_cost" placeholder="Total Cost">
                                                     <!--  <span id="show_error_email" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;not valid email id</span> -->
                                                 </div>

                                                 <div class="col-sm-3 mb-1">
                                                     <select class="form-control rounded-pill" name="status" id="status" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                                         <option class="form-control form-control-user" value="">Select Status</option>
                                                         <option class="form-control form-control-user" value="On-going">On_going</option>
                                                         <option class="form-control form-control-user" value="Initiated">Initiated</option>
                                                         <option class="form-control form-control-user" value="Closed">Closed</option>
                                                         <option class="form-control form-control-user" value="Completed">Completed</option>
                                                     </select>
                                                 </div>

                                             </div>

                                             <!--  <div class="form-group row">
                                                  <div class="col-sm-3">
                                                     <h6>&nbsp;Status:</h6>
                                                 </div>
                                             </div> -->
                                             <!--  <div class="form-group row">
                                                 <div class="col-sm-12">
                                                  <select class="form-control rounded-pill" name="contractor" id="contractor" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                                     <option class="form-control form-control-user" value="">Select Status</option>
                                                    <option class="form-control form-control-user" value="On-going">On_going</option>
                                                      <option class="form-control form-control-user" value="Initiated">Initiated</option>
                                                        <option class="form-control form-control-user" value="closed">Closed</option>
                                                </select>
                                            </div>
                                        </div> -->

                                             <div class="form-group row justify-content-center">
                                                 <div class="col-sm-4">
                                                     <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn">
                                                         <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                         Submit Data
                                                     </button>
                                                     <span id="show_error_new" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                                                 </div>
                                             </div>
                                         </form>
                                     </div>
                                 </div>


                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <!-- <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button> -->
                     </div>
                 </div>
             </div>
         </div>

         <div class="modal fade" id="edit_project">
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
                                         <h1 class="h4">Edit Project</h1>
                                     </div>

                                     <div class="card-body bg-custom3">
                                         <form class="user" role="form" method="post" id="edit_form" action="<?= base_url(); ?>Project_Officer/edit_contractor">
                                             <div class="form-group row">
                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Name:</h6>
                                                 </div>

                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Code:</h6>
                                                 </div>

                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Start Date:</h6>
                                                 </div>

                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;End Date:</h6>
                                                 </div>

                                             </div>


                                             <div class="form-group row">
                                                 <div class="col-sm-3 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="project_name" id="project_name" placeholder="Project Name">
                                                 </div>

                                                 <div class="col-sm-3 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="code" id="code" placeholder="Project Code.">
                                                 </div>

                                                 <div class="col-sm-3 mb-1">
                                                     <input type="date" class="form-control form-control-user" name="start_date" id="start_date" placeholder="Start Date">
                                                 </div>

                                                 <div class="col-sm-3 mb-1">
                                                     <input type="date" class="form-control form-control-user" name="end_date" id="end_date" placeholder="End Date*" value="">
                                                 </div>
                                             </div>

                                             <div class="form-group row">
                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Contractor:</h6>
                                                 </div>
                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Created By:</h6>
                                                 </div>
                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Total Cost:</h6>
                                                 </div>

                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Status:</h6>
                                                 </div>


                                             </div>

                                             <div class="form-group row">
                                                 <div class="col-sm-3">
                                                     <select class="form-control rounded-pill" name="contractor" id="contractor" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                                         <option class="form-control form-control-user" value="">Select Contractor Name</option>
                                                         <?php foreach ($contractor_name as $contractor) { ?>
                                                             <option class="form-control form-control-user" value="<?= $contractor['ID'] ?>"><?= $contractor['Name'] ?></option>
                                                         <?php } ?>
                                                     </select>
                                                 </div>

                                                 <div class="col-sm-3 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="created_by" id="created_by" placeholder="Created By.">
                                                 </div>

                                                 <div class="col-sm-3 mb-1">
                                                     <input type="number" class="form-control form-control-user" name="total_cost" id="total_cost" placeholder="Total Cost">
                                                     <!--  <span id="show_error_email" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;not valid email id</span> -->
                                                 </div>

                                                 <div class="col-sm-3 mb-1">
                                                     <select class="form-control rounded-pill" name="status" id="status" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                                         <option class="form-control form-control-user" value="">Select Status</option>
                                                         <option class="form-control form-control-user" value="On-going">On_going</option>
                                                         <option class="form-control form-control-user" value="Initiated">Initiated</option>
                                                         <option class="form-control form-control-user" value="closed">Closed</option>
                                                     </select>
                                                 </div>

                                             </div>

                                             <!--  <div class="form-group row">
                                                  <div class="col-sm-3">
                                                     <h6>&nbsp;Status:</h6>
                                                 </div>
                                             </div> -->
                                             <!--  <div class="form-group row">
                                                 <div class="col-sm-12">
                                                  <select class="form-control rounded-pill" name="contractor" id="contractor" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                                     <option class="form-control form-control-user" value="">Select Status</option>
                                                    <option class="form-control form-control-user" value="On-going">On_going</option>
                                                      <option class="form-control form-control-user" value="Initiated">Initiated</option>
                                                        <option class="form-control form-control-user" value="closed">Closed</option>
                                                </select>
                                            </div>
                                        </div> -->

                                             <div class="form-group row justify-content-center">
                                                 <div class="col-sm-4">
                                                     <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn">
                                                         <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                         Submit Data
                                                     </button>
                                                     <span id="show_error_new" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                                                 </div>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <!-- <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button> -->
                     </div>
                 </div>
             </div>
         </div>

         <div class="card-body bg-custom3">
             <!-- Nested Row within Card Body -->
             <div class="row">
                 <div class="col-lg-12">

                     <div class="alert alert-success" role="alert" style="display:none">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <strong>Success!</strong> Material Quantity updated successfully!
                     </div>

                     <div class="card bg-custom3">
                         <div class="card-header bg-custom1">
                             <h1 class="h4">Projects</h1>
                         </div>

                         <div class="card-body">
                             <div id="table_div">
                                 <?php if (count($project_records) > 0) { ?>
                                     <table id="datatable" class="table table-striped" style="color:black">
                                         <thead>
                                             <tr>
                                                 <th scope="col">ID</th>
                                                 <th scope="col">Project Name</th>
                                                 <th scope="col">Start Date</th>
                                                 <th scope="col">End Date</th>
                                                 <th scope="col">Tota Cost</th>
                                                 <th scope="col">Created By</th>
                                                 <th scope="col">Status</th>
                                                 <th scope="col">Edit Project</th>

                                                 <!-- <th scope="col">View Details</th> -->

                                             </tr>
                                         </thead>
                                         <tbody id="table_rows_cont">
                                             <?php $count = 0;
                                                foreach ($project_records as $data) { ?>
                                                 <tr>
                                                     <td scope="row" id="cont<?= $count; ?>"><?= $count ?></td>
                                                     <td style="width:150px" scope="row"><?= $data['Name']; ?></td>
                                                     <td id="quant<?= $data['ID']; ?>" class="quant" scope="row"><?= $data['Start_date']; ?></td>
                                                     <td scope="row"><?= $data['End_date']; ?></td>
                                                     <td style="width:150px" scope="row"><?= $data['Total_Cost']; ?></td>
                                                     <td style="width:150px" scope="row"><?= $data['Created_by']; ?></td>
                                                     <td style="width:150px" scope="row"><?= $data['Status']; ?></td>
                                                     <td style="width:120px" type="button" id="edit<?= $data['ID']; ?>" class="edit" scope="row" data-toggle="modal" data-target="#edit_project"><i style="margin-left: 40px;" class="fas fa-edit"></i></td>

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
                                 <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn" data-toggle="modal" data-target="#new_contractor">
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
 <script>
     window.onload = function() {

         $.ajax({
             url: '<?= base_url(); ?>Project_Officer/get_total_projects_assigned',
             method: 'POST',
             success: function(data) {

                 var result = jQuery.parseJSON(data);
                 $count = 0;
                 $('#table_rows_cont > tr').each(function(index, tr) {
                     var cp = document.getElementById("assigned_project" + $count);
                     var cont_id = document.getElementById("cont" + $count);

                     for (var i in result) {
                         if (cont_id.innerHTML == result[i].contractor_id) {
                             cp.innerHTML = result[i].count;
                         }
                     }
                     $count++;
                 });
             },
             async: true
         });

         $.ajax({
             url: '<?= base_url(); ?>Project_Officer/get_total_projects_completed',
             method: 'POST',
             success: function(data) {

                 var result = jQuery.parseJSON(data);
                 $count = 0;
                 $('#table_rows_cont > tr').each(function(index, tr) {
                     var cp = document.getElementById("completed_project" + $count);
                     var cont_id = document.getElementById("cont" + $count);

                     for (var i in result) {
                         if (cont_id.innerHTML == result[i].contractor_id) {
                             cp.innerHTML = result[i].count;
                         }
                     }
                     $count++;
                 });


             },
             async: true
         });
     }

     $('#add_bids').on('click', function() {
         var name = $('#project_name').val();
         var code = $('#code').val();
         if (name == '') {
             validate = 1;
             $('#project_name').addClass('red-border');
             $('#show_project_name_error').show();
         } else {
             validate = 0;
             $('#project_name').removeClass('red-border');
             $('#show_project_name_error').hide();
         }
         if (code == '') {
             validate = 1;
             $('#code').addClass('red-border');
         } else {
             validate = 0;
             $('#code').removeClass('red-border');
         }

         if (validate == 1) {

         } else {
             var btn = document.getElementById('add_bids');
             btn.dataset.target = "#new_bids";
         }

     });

     var loop = 1;
     //  var row_count

     $("#add_row").click(function() {

         loop = parseInt(document.getElementById('add_bid_rows').childNodes.length / 3);

         $("#add_bid_rows").append(`<div class="form-group row" id="add_bid_head${loop}">
                                        <div class="col-sm-3">
                                            <h6>&nbsp;Contractor:</h6>
                                        </div>

                                        <div class="col-sm-3">
                                            <h6>&nbsp;Bid Amount</h6>
                                        </div>

                                    </div>

                                    <div class="form-group row" id="add_bid_rows${loop}">
                                        <div class="col-sm-3 mb-1">
                                            <select class="form-control rounded-pill" name="contractor" id="contractor" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                                <option class="form-control form-control-user" value="">Select Contractor Name</option>
                                                <?php foreach ($contractor_name as $contractor) { ?>
                                                    <option class="form-control form-control-user" value="<?= $contractor['ID'] ?>"><?= $contractor['Name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-sm-3 mb-1">
                                            <input type="text" class="form-control form-control-user" name="bid_amount" id="bid_amount" placeholder="Bid Amount">
                                        </div>

                                        <div class="col-sm-3 mb-1">
                                            <span><a href="#" type="button" onclick="deleteRow(${loop})" id="delete_row${loop}"><i class="fas fa-trash-alt" style="margin-top:15px; color:black"></i></a></span>
                                        </div>
                                        
                                    </div>`);
         loop++;
     });

     function deleteRow(elmnt) {
         var elh = document.getElementById('add_bid_head' + elmnt);
         var elr = document.getElementById('add_bid_rows' + elmnt);
         elh.remove();
         elr.remove();
     }

     $('#add_btn').on('click', function() {
         //alert('javascript working');
         $('#add_btn').attr('disabled', true);
         var validate = 0;

         var name = $('#project_name').val();
         var code = $('#code').val();
         var start_date = $('#start_date').val();
         var end_date = $('#end_date').val();
         var contractor_name = $('#contractor').val();
         var created_by = $('#created_by').val();
         var cost = $('#total_cost').val();
         var status = $('#status').val();

         if (name == '') {
             validate = 1;
             $('#project_name').addClass('red-border');
         }
         if (code == '') {
             validate = 1;
             $('#code').addClass('red-border');
         }
         if (start_date == '') {
             validate = 1;
             $('#start_date').addClass('red-border');
         }
         if (end_date == '') {
             validate = 1;
             $('#end_date').addClass('red-border');
         }

         if (contractor_name == '') {
             validate = 1;
             $('#contractor').addClass('red-border');
         }
         if (created_by == '') {
             validate = 1;
             $('#created_by').addClass('red-border');
         }
         if (cost == '') {
             validate = 1;
             $('#total_cost').addClass('red-border');
         }
         if (status == '') {
             validate = 1;
             $('#status').addClass('red-border');
         } else {
             validate = 0;
             $('#email').removeClass('red-border');
             $('#show_error_email').hide();
         }


         if (validate == 0) {
             $('#add_form')[0].submit();
             $('#show_error_new').hide();
         } else {
             $('#add_btn').removeAttr('disabled');
             $('#show_error_new').show();
         }
     });

     function isEmail(email) {
         var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
         return regex.test(email);
     }

     $('#edit_btn').on('click', function() {
         //alert('javascript working');
         $('#edit_btn').attr('disabled', true);
         var validate = 0;

         //  var material_name = $('#material_name_edit').val();
         var contact_edit = $('#contact_edit').val();
         var email_edit = $('#email_edit').val();
         var reg_date_edit = $('#reg_date_edit').val();

         if (contact_edit == '') {
             validate = 1;
             $('#contact_edit').addClass('red-border');
         }
         if (email_edit == '') {
             validate = 1;
             $('#email_edit').addClass('red-border');
         }
         if (reg_date_edit == '') {
             validate = 1;
             $('#reg_date_edit').addClass('red-border');
         }

         if (!isEmail(email_edit)) {
             validate = 1;
             $('#email_edit').addClass('red-border');
             $('#show_error_email_edit').show();
         } else {
             validate = 0;
             $('#email_edit').removeClass('red-border');
             $('#show_error_email_edit').hide();
         }

         if (validate == 0) {
             $('#edit_form')[0].submit();
             $('#show_error_update').hide();
         } else {
             $('#edit_btn').removeAttr('disabled');
             $('#show_error_update').show();
         }
     });


     $('#table_rows_cont').find('tr').click(function(e) {
         var $columns = $(this).find('td');

         $('#contractor_name_edit').val($columns[1].innerHTML);
         $('#contractor_name_heading').html('<strong>' + $columns[1].innerHTML + '</strong>');
         $('#id_edit').val($columns[0].innerHTML);

         if (e.target.id.substr(0, 16) == "assigned_project") {
             $.ajax({
                 url: '<?= base_url(); ?>Project_Officer/get_list_of_projects',
                 method: 'POST',
                 data: {
                     'contractor_id': $columns[0].innerHTML
                 },
                 success: function(data) {
                     var result = jQuery.parseJSON(data);
                     var plist = document.getElementById("show_list")
                     var innerhtml = "";
                     for (var i in result) {
                         innerhtml = innerhtml + "<li>" + result[i].Name + "</li>";
                     }
                     plist.innerHTML = innerhtml;
                     $('#contractor_head').html("Assigned Projects of " + $columns[1].innerHTML);
                 },
                 async: true
             });
         }
     });

     $(document).ready(function() {
         $('[data-toggle="tooltip"]').tooltip();
     });

     $(document).on('show.bs.modal', '.modal', function() {
         var zIndex = 1040 + (10 * $('.modal:visible').length);
         $(this).css('z-index', zIndex);
         setTimeout(function() {
             $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
         }, 0);
     });
 </script>
 <!-- <script type="text/javascript">
     $(function() {
         $(".edit").click(function(event) {
             var a = $(this).attr('ID');
             //alert(a);
             var id = a.substr(4, 5);
             var res = "#quant".concat(id);
             //alert(res);

             if ($(this).children("input").length > 0)
                 return false;

             var tdObj = $(res);
             var preText = tdObj.html();
             var inputObj = $("<input type='text' style='width:60px' />");
             tdObj.html("");

             inputObj.css({
                     border: "0px",
                     fontSize: "15px"
                 })
                 .val(preText)
                 .appendTo(tdObj)
                 .trigger("focus")
                 .trigger("select");

             inputObj.keyup(function(event) {
                 if (13 == event.which) { // press ENTER-key
                     var text = $(this).val(); // alert(text);

                     $.ajax({
                         url: '<?= base_url(); ?>SO_STORE/update_inventory',
                         method: 'POST',
                         data: {
                             'id': id,
                             'quantity': text
                         },
                         success: function(data) {
                             tdObj.html(text);

                             $(".alert").show();
                             window.setTimeout(function() {
                                 $(".alert").fadeTo(500, 0).slideUp(500, function() {
                                     $(this).remove();
                                 });
                             }, 2000);
                         },
                         async: false
                     });

                 } else if (27 == event.which) { // press ESC-key
                     tdObj.html(preText);
                 }
             });

             inputObj.click(function() {
                 return false;
             });
         });
     });
 </script> -->