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
                                         <h1 class="h4">Add Record</h1>
                                     </div>

                                     <div class="card-body bg-custom3">
                                         <form class="user" role="form" method="post" id="edit_form" action="<?= base_url(); ?>SO_STORE/edit_inventory">
                                             <div class="form-group row">
                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Project Name:</h6>
                                                 </div>

                                                 <div class="col-sm-3">
                                                     <h6>&nbsp;Date:</h6>
                                                 </div>

                                                 <div class="col-sm-2">
                                                     <h6>&nbsp;Material:</h6>
                                                 </div>

                                                 <div class="col-sm-2">
                                                     <h6>&nbsp;Quantity:</h6>
                                                 </div>

                                                 <div class="col-sm-2">
                                                     <h6>&nbsp;Price:</h6>
                                                 </div>

                                             </div>

                                             <div class="form-group row">

                                                 <div class="col-sm-2 mb-1" style="display:none">
                                                     <input type="text" class="form-control form-control-user" name="project_id" id="project_id" placeholder="id" readonly="readonly" style="color:black; font-size:medium; background-color:lightgray; border:1px solid black;">
                                                 </div>

                                                 <div class="col-sm-3 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="project_name" id="project_name" readonly="readonly" style="color:black; font-size:medium; background-color:lightgray; border:1px solid black;">
                                                 </div>

                                                 <div class="col-sm-3 mb-1">
                                                     <input type="date" class="form-control form-control-user" name="delivery_date" id="delivery_date" placeholder="Select Date*" value="">
                                                 </div>

                                                 <div class="col-sm-2 mb-1">
                                                     <select class="form-control rounded-pill" name="material" id="material" data-placeholder="Select Material" style="font-size: 0.8rem; height:50px;">
                                                         <option class="form-control form-control-user small" value="">Select Material</option>
                                                         <?php $material_data = $this->db->get('inventory')->result_array(); ?>
                                                         <?php foreach ($material_data as $data) { ?>
                                                             <option class="form-control form-control-user small"  value="<?= $data['Material_Name'] ?>"><?= $data['Material_Name']; ?></option>
                                                         <?php } ?>
                                                     </select>
                                                 </div>

                                                 <div class="col-sm-2 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="quantity" id="quantity" placeholder="Quantity">
                                                 </div>

                                                 <div class="col-sm-2 mb-1">
                                                     <input type="text" class="form-control form-control-user" name="price" id="price" placeholder="Price">
                                                 </div>

                                             </div>

                                             <div class="form-group row justify-content-center">
                                                 <div class="col-sm-4">
                                                     <button type="submit" class="btn btn-primary btn-user btn-block" id="edit_btn">
                                                         <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                         Add Record
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
                             <h1 class="h4">Material Used by Projects</h1>
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
                                                 <th scope="col">Total Cost</th>
                                                 <th scope="col">Status</th>
                                                 <th scope="col">Add Material Record</th>
                                                 <th scope="col">View Material Details</th>

                                             </tr>
                                         </thead>
                                         <tbody id="table_rows">
                                             <?php $count = 0;
                                                foreach ($project_records as $data) { ?>
                                                 <tr>
                                                     <td scope="row"><?= $data['ID']; ?></td>
                                                     <td id="project<?= $data['ID']; ?>" scope="row"><?= $data['Name']; ?></td>
                                                     <td scope="row"><?= $data['Start_date']; ?></td>
                                                     <td scope="row"><?= $data['End_date']; ?></td>
                                                     <td scope="row">PKR. <?= $data['Total_Cost']; ?></td>
                                                     <td scope="row"><?= $data['Status']; ?></td>
                                                     <td type="button" id="edit<?= $data['ID']; ?>" class="edit" scope="row" data-toggle="modal" data-target="#edit_material"><i style="margin-left: 75px;" class="fas fa-edit"></i></td>
                                                     <td id="view" class="view" scope="row"><a href="<?= base_url(); ?>SO_STORE/view_inventory_detail/<?= $data['ID']; ?>" style="color:black"><i style="margin-left: 65px;" class="fas fa-eye"></i></a></td>

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
         $('#project_name').val($columns[1].innerHTML);
         $('#project_id').val($columns[0].innerHTML);
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