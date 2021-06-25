 <?php $this->load->view('project_officer/common/header'); ?>

 <!--  <div class="form-group row justify-content-center" style="margin-top:50px;">
             <div class="col-sm-4">
             	 <h4 style="font-weight: bold;text-align: center;">Upload Project Drawings here</h4>
             	 <br>

                 <input type="file" class="btn btn-primary btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_inventory" onclick="location.href='<?php echo base_url(); ?>Project_Officer/drawing'">

             </div>        
         </div> -->

 <div class="container">
     <div class="card o-hidden my-4 border-0 shadow-lg">
         <div class="card-body bg-custom3">
             <div class="card bg-custom3" style="">
                 <div class="card-header bg-custom1">
                     <h1 class="h4">Drawings Uploaded</h1>
                 </div>
                 <div class="card-body">
                     <form class="user" role="form" enctype="multipart/form-data" method="post" id="add_drawing_form" action="<?= base_url(); ?>Project_Officer/upload_drawing">
                         <input type="file" style="height:65px;" multiple="multiple" id="project_drawing" name="project_drawing[]">
                         <input type="hidden" name="project_id" id="project_id" value="<?= $project; ?>" />
                         <button type="submit" class="btn btn-primary btn-user btn-block col-md-8" id="file_upload" style="  margin: auto; width: 50%;" name="file_upload">
                             Upload</button>
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
                                                 <th>Date Added</th>
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

                                                     <td style="width:120px" type="button" class="edit" scope="row"><a style="color:black;" href="<?= base_url(); ?>uploads/project_drawing/<?= $data['name']; ?>"><i style="margin-left: 40px;" class="fas fa-eye"></i></a></td>


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