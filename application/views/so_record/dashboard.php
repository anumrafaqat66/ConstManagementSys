 <?php $this->load->view('so_store/common/header'); ?>

 <style>
     .img {
         background: url('<?= base_url() ?>assets/img/record-banner.jpg');
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

     <h2 class="my-4">Welcome, SO Record!</h2>

     <div class="col-md-12 img">
     </div>

     <form class="user" role="form" method="post" id="add_form">

         <div class="form-group row justify-content-center" style="margin-top:50px;">
             <div class="col-sm-6">
                 <button type="button" class="btn btn-primary btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_inventory" onclick="location.href='<?php echo base_url(); ?>SO_RECORD/show_letter_lists'">
                 <h4 style="font-weight: bold;">Allotment Letter</h4>
                 </button>
             </div>

             <div class="col-sm-6">
                 <button type="button" class="btn btn-primary btn-user btn-block" style="height:65px;  box-shadow: 5px 10px #888888;" id="btn_material" onclick="location.href='<?php echo base_url(); ?>SO_RECORD/show_bills'">
                 <h4 style="font-weight: bold;">Billing Section</h4>
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