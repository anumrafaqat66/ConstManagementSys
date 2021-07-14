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

 <div class="container">
     <div class="card o-hidden my-4 border-0 shadow-lg">
         <div class="card-body bg-custom3">
             <div class="card bg-custom3">
                 <div class="card-header bg-custom1">
                     <h1 class="h4">Drawings Uploaded</h1>
                 </div>
                 <div class="card-body">
                     <form class="user" role="form" enctype="multipart/form-data" method="post" id="add_drawing_form" action="<?= base_url(); ?>Project_Officer/upload_drawing">
                         <div class="form-group row">
                             <div class="col-sm-12">
                                 <input type="file" style="height:65px;" multiple="multiple" id="project_drawing" name="project_drawing[]">
                                 <input type="hidden" name="project_id" id="project_id" value="<?= $project; ?>" />
                             </div>

                             <div class="col-sm-12">
                                 <h6>&nbsp;Enter Drawing Description:</h6>
                             </div>

                             <div class="col-sm-12">
                                 <textarea class="form-control form-control-user" style="border-radius:10px" name="drawing_desc" id="drawing_desc" placeholder="Enter Description"></textarea>
                             </div>
                         </div>
                         <div class="form-group row justify-content-center">
                             <div class="col-sm-6">
                                 <button type="button" class="btn btn-primary btn-user" id="file_upload" style="width: 100%;" name="file_upload">
                                     Upload
                                 </button>
                             </div>
                         </div>
                         <div class="form-group row justify-content-center">
                             <div class="col-sm-6">
                                 <span id="show_error_new" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                             </div>
                         </div>

                         <!-- <div class="col-sm-4 row justify-content-center my-3">
                                 <button type="button" class="btn btn-primary btn-user btn-block" id="file_upload" style="  margin: auto; width: 50%;" name="file_upload">
                                     Upload
                                 </button>
                                 <span id="show_error_new" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                             </div> -->
                         <!-- </div> -->

                     </form>
                 </div>
             </div>
         </div>

         <div class="card-body bg-custom3">
             <!-- Nested Row within Card Body -->
             <div class="row">
                 <div class="col-lg-12">

                     <div class="card bg-custom3" style="">
                         <div class="card-header bg-custom1">
                             <h1 class="h4">Uploaded Drawings</h1>
                         </div>

                         <div class="card-body">
                             <div id="table_div">
                                 <?php if (count($drawing) > 0) { ?>
                                     <table id="datatable" class="table table-striped" style="color:black">
                                         <thead>
                                             <tr>
                                                 <th scope="col">ID</th>
                                                 <th scope="col">File</th>
                                                 <th scope="col">Date Added</th>
                                                 <th scope="col">Drawing Description</th>
                                                 <th scope="col">Actions</th>

                                                 <th scope="col" style="display:none">Bid ID</th>
                                             </tr>
                                         </thead>
                                         <tbody id="table_rows_project">
                                             <?php $count = 1;
                                                foreach ($drawing as $data) { ?>
                                                 <tr>
                                                     <!-- <a style="color:black; font-weight:800;" href="<?= base_url() ?>Project_Officer/overview/<?= $data['ID'] ?>"> -->
                                                     <td scope="row" id="cont<?= $count; ?>"><?= $count; ?></td>
                                                     <td style="width:150px;" scope="row"><b><?= $data['name']; ?></b></td>
                                                     <td scope="row"><?= $data['date_added']; ?></td>
                                                     <td scope="row"><?= $data['description']; ?></td>

                                                     <td style="width:120px" type="button" class="edit" scope="row"><a style="color:black;" href="<?= base_url(); ?>uploads/project_drawing/<?= $data['name']; ?>"><i style="margin-left: 20px;" class="fas fa-eye"></i></a></td>


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

     $('#file_upload').on('click', function() {
         //alert('javascript working');
         $('#file_upload').attr('disabled', true);
         var validate = 0;

         var name = $('#drawing_desc').val();


         if (name == '') {
             validate = 1;
             $('#drawing_desc').addClass('red-border');
         }

         if (validate == 0) {
             $('#add_drawing_form')[0].submit();
             $('#show_error_new').hide();
         } else {
             $('#file_upload').removeAttr('disabled');
             $('#show_error_new').show();
         }
     });
 </script>