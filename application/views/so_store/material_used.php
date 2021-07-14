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
             <!-- Nested Row within Card Body -->
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card bg-custom3">
                         <div class="card-header bg-custom1">
                             <h1 class="h4">Material Detail Records</h1>
                         </div>

                         <div class="card-body">
                             <div id="table_div">
                                 <?php if (count($inventory_detail_records) > 0) { ?>
                                     <table id="datatable" class="table table-striped" style="color:black">
                                         <thead>
                                             <tr>
                                                 <th scope="col">ID</th>
                                                 <th scope="col">Material Name</th>
                                                 <th scope="col">Quantity</th>
                                                 <th scope="col">Price</th>
                                                 <th scope="col">Unit</th>
                                                 <th scope="col">Stock Date</th>
                                                 <th scope="col">Status</th>
                                             </tr>
                                         </thead>
                                         <tbody id="table_rows">
                                             <?php $count = 0;
                                                foreach ($inventory_detail_records as $data) { ?>
                                                 <tr>
                                                     <td scope="row"><?= ++$count ?></td>
                                                     <td id="material<?= $data['id']; ?>" scope="row"><?= $data['Material_Name']; ?></td>
                                                     <td id="quant<?= $data['id']; ?>" class="quant" scope="row"><?= $data['Quantity']; ?></td>
                                                     <td scope="row">PKR. <?= $data['Price']; ?></td>
                                                     <td scope="row"><?= $data['Unit']; ?></td>
                                                     <td scope="row"><?= $data['stock_date']; ?></td>
                                                     <td scope="row"><?= $data['Status']; ?></td>
                                                 </tr>
                                             <?php } ?>
                                         </tbody>
                                     </table>
                                 <?php } else { ?>
                                     <a> No Data Available yet </a>
                                 <?php } ?>
                             </div>
                         </div>
                     </div>
                     <form class="user" role="form" method="post" id="add_form" action="<?= base_url(); ?>SO_STORE/add_inventory">
                         <div class="form-group row my-2 justify-content-center">
                             <div class="col-sm-4">
                                 <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn">
                                     <i class="fas fa-arrow-left"></i>
                                     Go Back
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
     $('#add_btn').on('click', function() {
         //alert('javascript working');
         $('#add_btn').attr('disabled', true);
         var validate = 0;

         var controller_type = $('#controller_type').val();
         var eswb = $('#eswb').val();
         var name = $('#controller_name').val();
         var comission_date = $('#comission_date').val();
         var ship_id = $('#Ship_ID').val();
         var total_equipped = $('#Total_Equipped').val();

         if (eswb == '') {
             validate = 1;
             $('#eswb').addClass('red-border');
         }
         if (name == '') {
             validate = 1;
             $('#controller_name').addClass('red-border');
         }
         if (controller_type == '') {
             validate = 1;
             $('#controller_type').addClass('red-border');
         }
         if (comission_date == '') {
             validate = 1;
             $('#comission_date').addClass('red-border');
         }
         if (ship_id == '') {
             validate = 1;
             $('#Ship_ID').addClass('red-border');
         }
         if (total_equipped == '') {
             validate = 1;
             $('#Total_Equipped').addClass('red-border');
         }

         if (validate == 0) {
             $('#add_form')[0].submit();
         } else {
             $('#add_btn').removeAttr('disabled');
         }
     });


     $('#table_rows').find('tr').click(function() {
         var $columns = $(this).find('td');
         $('#material_name_edit').val($columns[1].innerHTML);
         $('#id_edit').val($columns[0].innerHTML);
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

     

$('#notifications').click(function(){
  alert('notification clicked');
    $.ajax({
      url: '<?= base_url(); ?>ChatController/activity_seen',
      success: function(data) {
        $('#notifications').html(data);
      },
      async: true
    });
});

 </script>