 <?php $this->load->view('so_store/common/header'); ?>

 <style>
     .red-border {
         border: 1px solid red !important;
     }
 </style>

 <div class="container">
     <div class="card o-hidden my-4 border-0 shadow-lg">
         <div class="modal fade" id="new_material">
             <!-- <div class="row"> -->
             <div class="modal-dialog modal-dialog-centered " style="margin-left: 370px;" role="document">
                 <div class="modal-content bg-custom3" style="width:1000px;">
                     <div class="modal-header" style="width:1000px;">
                         <!-- <h5 class="modal-title" id="exampleModalLongTitle">Reason</h5> -->
                         <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button> -->
                     </div>
                     <div class="card-body bg-custom3">
                         <!-- Nested Row within Card Body -->
                         <div class="row">
                             <div class="col-lg-12">

                                 <div class="card">
                                     <div class="card-header bg-custom1">
                                         <h1 class="h4">Add New Material</h1>
                                     </div>

                                     <div class="card-body bg-custom3">
                                         <form class="user" role="form" method="post" id="add_form" action="<?= base_url(); ?>SO_STORE/insert_inventory">
                                             <div class="form-group row">
                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Material:</h6>
                                                 </div>

                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Quantity:</h6>
                                                 </div>

                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Price:</h6>
                                                 </div>

                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Unit:</h6>
                                                 </div>

                                             </div>

                                             <div class="form-group row">
                                                 <div class="col-sm-3 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="material_name" id="material_name" placeholder="Material">
                                                 </div>

                                                 <div class="col-sm-3 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="quantity" id="quantity" placeholder="Quantity">
                                                 </div>

                                                 <div class="col-sm-3 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="price" id="price" placeholder="Price">
                                                 </div>

                                                 <div class="col-sm-3 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="unit" id="unit" placeholder="Unit">
                                                 </div>
                                             </div>


                                             <div class="form-group row justify-content-center">
                                                 <div class="col-sm-4">
                                                     <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn">
                                                         <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                         Submit Data
                                                     </button>
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

         <div class="modal fade" id="edit_material">
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
                                                     <button type="submit" class="btn btn-primary btn-user btn-block" id="edit_btn">
                                                         <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                         Update Material
                                                     </button>
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
                             <h1 class="h4">Inventory</h1>
                         </div>

                         <div class="card-body">
                             <div id="table_div">
                                 <?php if (count($inventory_records) > 0) { ?>
                                     <table id="datatable" class="table table-striped" style="color:black">
                                         <thead>
                                             <tr>
                                                 <th scope="col">ID</th>
                                                 <th scope="col">Material Name</th>
                                                 <th scope="col">Quantity</th>
                                                 <th scope="col">Price</th>
                                                 <th scope="col">Unit</th>
                                                 <th scope="col">Edit/Update Quantity</th>
                                                 <th scope="col">View Details</th>
                                                 
                                             </tr>
                                         </thead>
                                         <tbody id="table_rows">
                                             <?php $count = 0;
                                                foreach ($inventory_records as $data) { ?>
                                                 <tr>
                                                     <td scope="row"><?= $data['ID']; ?></td>
                                                     <td id="material<?= $data['ID']; ?>" scope="row"><?= $data['Material_Name']; ?></td>
                                                     <td id="quant<?= $data['ID']; ?>" class="quant" scope="row"><?= $data['Material_Total_Quantity']; ?></td>
                                                     <td scope="row">PKR. <?= $data['Material_Total_Price']; ?></td>
                                                     <td scope="row"><?= $data['Unit']; ?></td>
                                                     <td type="button" id="edit<?= $data['ID']; ?>" class="edit" scope="row" data-toggle="modal" data-target="#edit_material"><i style="margin-left: 70px;" class="fas fa-edit"></i></td>
                                                     <td id="view" class="view" scope="row"><a href="<?= base_url(); ?>SO_STORE/view_inventory_detail/<?= $data['ID']; ?>" style="color:black"><i style="margin-left: 40px;" class="fas fa-eye"></i></a></td>
                                                     
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
                     <form class="user" role="form" method="post" id="add_form" action="">
                         <div class="form-group row my-2 justify-content-center">
                             <div class="col-sm-4">
                                 <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn" data-toggle="modal" data-target="#new_material">
                                     <i class="fas fa-plus"></i>
                                     Add new Material
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