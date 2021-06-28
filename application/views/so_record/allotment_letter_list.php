 <?php $this->load->view('so_store/common/header'); ?>

 <style>
     .red-border {
         border: 1px solid red !important;
     }
     #your_btn {
  position: relative;
/*  top: 150px;*/
  font-family: calibri;
  width: 480px;
  padding: 10px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border: 1px dashed #BBB;
  text-align: center;
  background-color: #DDD;
  cursor: pointer;
}
 </style>

 <div class="container">
     <div class="card o-hidden my-4 border-0 shadow-lg">
<!--          <div class="modal fade" id="new_material"> -->
             <!-- <div class="row"> -->
      <!--   
         </div> -->

        <!--  <div class="modal fade" id="edit_material"> -->
             <!-- <div class="row"> -->
            <!--  <div class="modal-dialog modal-dialog-centered " style="margin-left: 370px;" role="document">
                 <div class="modal-content bg-custom3" style="width:1000px;">
                     <div class="modal-header" style="width:1000px;">

                     </div>
                     <div class="card-body bg-custom3"> -->
                         <!-- Nested Row within Card Body -->
                        <!--  <div class="row">
                             <div class="col-lg-12">

                                 <div class="card">
                                     <div class="card-header bg-custom1">
                                         <h1 class="h4">Update/Edit Material</h1>
                                     </div>

                                     <div class="card-body bg-custom3">
                                         <form class="user" role="form" method="post" id="edit_form" action="<?= base_url(); ?>SO_STORE/edit_inventory">
                                             <div class="form-group row">
                                                 <div class="col-sm-4">
                                                     <h6>&nbsp;Material:</h6>
                                                 </div>

                                                 <div class="col-sm-4">
                                                     <h6>&nbsp;Add Quantity:</h6>
                                                 </div>

                                                 <div class="col-sm-4">
                                                     <h6>&nbsp;New Price:</h6>
                                                 </div>

                                             </div>

                                             <div class="form-group row">

                                                 <div class="col-sm-4 mb-1" style="display:none">
                                                     <input type="text" class="form-control form-control-user" name="id_edit" id="id_edit" placeholder="id" readonly="readonly" style="color:black; font-size:medium; background-color:lightgray; border:1px solid black;">
                                                 </div>

                                                 <div class="col-sm-4 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="material_name_edit" id="material_name_edit" placeholder="Material" readonly="readonly" style="color:black; font-size:medium; background-color:lightgray; border:1px solid black;">
                                                 </div>

                                                 <div class="col-sm-4 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="new_quantity" id="new_quantity" placeholder="Add Quantity">
                                                 </div>

                                                 <div class="col-sm-4 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="new_price" id="new_price" placeholder="New Price">
                                                 </div>

                                             </div>

                                             <div class="form-group row justify-content-center">
                                                 <div class="col-sm-4">
                                                     <button type="button" class="btn btn-primary btn-user btn-block" id="edit_btn"> -->
                                                         <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                        <!--  Update Material
                                                     </button>
                                                     <span id="show_error_update" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
                                                 </div>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div> -->
                    <!--  <div class="modal-footer"> -->
                         <!-- <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button> -->
             <!--         </div>
                 </div>
             </div>
         </div> -->

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
                             <h1 class="h4">Allotment Letters</h1>
                         </div>

                         <div class="card-body">
                                     
                                        <form class="user" role="form" enctype="multipart/form-data" method="post" id="add_drawing_form" action="<?= base_url(); ?>SO_RECORD/upload_allotment_letter">
                                            <div class="form-group row">
                                                     <div class="col-sm-6 mb-1">
                                                    <select class="form-control rounded-pill" name="project_id" id="project_id" data-placeholder="Select Contractor" style="font-size: 0.8rem; height:50px;">
                                                             <option class="form-control form-control-user" value="">Select Project Name</option>
                                                             <?php foreach ($projects as $data) { ?> 
                                                                 <option class="form-control form-control-user" value="<?= $data['ID'] ?>"><?= $data['Name'] ?></option>
                                                             <?php } ?>
                                                         </select>
                                                     </div>

                                                     <div class="col-sm-6 mb-1">
                                                           <input type="file" style="height:65px;" id="your_btn" multiple="multiple" id="project_allotment_letter" name="project_allotment_letter[]">
                                                     </div>

                                                     <div class="col-sm-12 mb-1" class="justify-content-center" style="margin-top: 30px;">
                                                              <button type="submit" class="btn btn-primary btn-user btn-block" name="file_upload" id="file_upload" >
                                                         Upload Allotment Letter
                                                     <!--     <span><i class="fas fa-sign-in-alt"></i></span> -->
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
 </div>

 </div>


 <?php $this->load->view('common/footer'); ?>
 <script>
     $('#add_btn').on('click', function() {
         //alert('javascript working');
         $('#add_btn').attr('disabled', true);
         var validate = 0;

         var material_name = $('#material_name').val();
         var quantity = $('#quantity').val();
         var price = $('#price').val();
         var unit = $('#unit').val();

         if (material_name == '') {
             validate = 1;
             $('#material_name').addClass('red-border');
         }
         if (quantity == '') {
             validate = 1;
             $('#quantity').addClass('red-border');
         }
         if (price == '') {
             validate = 1;
             $('#price').addClass('red-border');
         }
         if (unit == '') {
             validate = 1;
             $('#unit').addClass('red-border');
         }

         if (!$.isNumeric(quantity)) {
             validate = 1;
             $('#quantity').addClass('red-border');
         }

         if (!$.isNumeric(price)) {
             validate = 1;
             $('#price').addClass('red-border');
         }

         if (validate == 0) {
             $('#add_form')[0].submit();
             $('#show_error_new').hide();
         } else {
             $('#add_btn').removeAttr('disabled');
             $('#show_error_new').show();
         }
     });

     $('#edit_btn').on('click', function() {
         //alert('javascript working');
         $('#edit_btn').attr('disabled', true);
         var validate = 0;

         var material_name = $('#material_name_edit').val();
         var quantity = $('#new_quantity').val();
         var price = $('#new_price').val();

         if (material_name == '') {
             validate = 1;
             $('#material_name_edit').addClass('red-border');
         }
         if (quantity == '') {
             validate = 1;
             $('#new_quantity').addClass('red-border');
         }
         if (price == '') {
             validate = 1;
             $('#new_price').addClass('red-border');
         }

         if (!$.isNumeric(quantity)) {
             validate = 1;
             $('#new_quantity').addClass('red-border');
         }

         if (!$.isNumeric(price)) {
             validate = 1;
             $('#new_price').addClass('red-border');
         }

         if (validate == 0) {
             $('#edit_form')[0].submit();
             $('#show_error_update').hide();
         } else {
             $('#edit_btn').removeAttr('disabled');
             $('#show_error_update').show();
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