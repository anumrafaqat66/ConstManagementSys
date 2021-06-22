 <?php $this->load->view('so_store/common/header'); ?>

 <style>
     .red-border {
         border: 1px solid red !important;
     }
 </style>

 <div class="container">

     <h2 class="my-4">Welcome, SO Store!</h2>

     <form class="user" role="form" method="post" id="add_form">

         <div class="form-group row justify-content-center" style="margin-top:50px;">
             <div class="col-sm-6">
                 <button type="button" class="btn btn-primary btn-user btn-block" id="btn_inventory" onclick="location.href='<?php echo base_url(); ?>SO_STORE/add_inventory'">
                     Inventory
                 </button>
             </div>

             <div class="col-sm-6">
                 <button type="button" class="btn btn-primary btn-user btn-block" id="btn_material" onclick="location.href='<?php echo base_url(); ?>SO_STORE/view_projects'">
                     Material Used by Project
                 </button>
             </div>


         </div>
     </form>
 </div>

 </div>


 <?php $this->load->view('common/footer'); ?>
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
 </script>