 <?php $this->load->view('Admin/common/header'); ?>

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
         <div class="card-body bg-custom3">
             <!-- Nested Row within Card Body -->
             <div class="row">
                 <div class="col-lg-12">

                     <div class="card bg-custom3">
                         <div class="card-header bg-custom1">
                             <h1 class="h4">Activity Log Detail</h1>
                         </div>

                         <div class="card-body">
                             <div id="table_div">
                                 <?php if (count($activity_log) > 0) { ?>
                                     <table id="datatable" class="table table-striped" style="color:black">
                                         <thead>
                                             <tr>
                                                 <th scope="col">Activity Date & Time</th>
                                                 <th scope="col">User ID</th>
                                                 <th scope="col">Description</th>
                                                 <th scope="col">Action</th>
                                                 <!-- <th scope="col">Module</th> -->
                                             </tr>
                                         </thead>
                                         <tbody id="table_rows_project">
                                             <?php $count = 1;
                                                foreach ($activity_log as $data) { ?>
                                                 <tr>
                                                     <td scope="row"><?= $data['activity_date']; ?></td>
                                                     <td scope="row"><?= $data['activity_by']; ?></td>
                                                     <td scope="row"><?= $data['activity_detail']; ?></td>
                                                     <td scope="row"><?= $data['activity_action']; ?></td>
                                                     <!-- <td scope="row"><?= $data['activity_module']; ?></td> -->
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
     </div>
 </div>

 </div>


 <?php $this->load->view('common/footer'); ?>
 <script src="<?= base_url('assets/js/chat/chat.js'); ?>"></script>
 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
 <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
 <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
 <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">

 <script>
     window.onload = function() {

     }
     $(document).ready(function() {
         $('#datatable').DataTable();
     });
 </script>
 <script type="text/javascript">
     function seen(data) {
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