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
    <div class="modal fade" id="all_inventory">
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
                                    <h1 class="h4">Select Inventory:</h1>
                                </div>

                                <div class="card-body">
                                    <div id="table_div">
                                        <?php if (count($inventory_records) > 0) { ?>
                                            <table id="datatable" class="table table-striped" style="color:black">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Material Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_rows_project">
                                                    <?php $count = 1;
                                                    foreach ($inventory_records as $data) { ?>
                                                        <tr>
                                                            <td scope="row" id="cont<?= $count; ?>"><?= $count; ?></td>
                                                            <td scope="row"><a style="color:black; font-weight:800;" type="button" onclick="location.href='<?php echo base_url(); ?>SO_STORE/report_inventory/<?= $data['ID']; ?>'"><?= $data['Material_Name']; ?></a></td>
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
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button> -->
                </div>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4 my-2">
        <h1 class="h3 mb-0 text-black-800"></h1>
        <a onclick="location.href='<?php echo base_url(); ?>SO_STORE/report_inventory/<?php echo $selected_region; ?>'" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-print text-white-50"></i> Print Page</a>
    </div>

    <div class="card o-hidden my-4 border-0 shadow-lg">
        <div class="modal fade" id="new_material">
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
                                        <h1 class="h4">Add New Material</h1>
                                    </div>

                                    <div class="card-body bg-custom3">
                                        <form class="user" role="form" method="post" id="add_form" action="<?= base_url(); ?>SO_STORE/insert_inventory">
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <h6>&nbsp;Material:</h6>
                                                </div>

                                                <div class="col-sm-2">
                                                    <h6>&nbsp;Price Per Unit:</h6>
                                                </div>

                                                <div class="col-sm-2">
                                                    <h6>&nbsp;Quantity:</h6>
                                                </div>

                                                <div class="col-sm-3">
                                                    <h6>&nbsp;Total Price:</h6>
                                                </div>

                                                <div class="col-sm-2">
                                                    <h6>&nbsp;Unit:</h6>
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-3 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="material_name" id="material_name" placeholder="Material">
                                                </div>

                                                <div class="col-sm-2 mb-1">
                                                    <input type="number" class="form-control form-control-user" name="per_unit" id="per_unit" placeholder="Per Unit Price">
                                                </div>

                                                <div class="col-sm-2 mb-1">
                                                    <input type="number" class="form-control form-control-user" name="quantity" id="quantity" placeholder="Quantity">
                                                </div>

                                                <div class="col-sm-3 mb-1">
                                                    <input type="number" class="form-control form-control-user" name="price" id="price" placeholder="Price" readonly>
                                                </div>

                                                <div class="col-sm-2 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="unit" id="unit" placeholder="Unit">
                                                </div>
                                            </div>


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
                                                <div class="col-sm-3">
                                                    <h6>&nbsp;Material:</h6>
                                                </div>

                                                <div class="col-sm-3">
                                                    <h6>&nbsp;Price Per Unit:</h6>
                                                </div>

                                                <div class="col-sm-3">
                                                    <h6>&nbsp;Add Quantity:</h6>
                                                </div>

                                                <div class="col-sm-3">
                                                    <h6>&nbsp;Total Price:</h6>
                                                </div>

                                            </div>

                                            <div class="form-group row">

                                                <div class="col-sm-3 mb-1" style="display:none">
                                                    <input type="text" class="form-control form-control-user" name="id_edit" id="id_edit" placeholder="id" readonly="readonly" style="color:black; font-size:medium; background-color:lightgray; border:1px solid black;">
                                                </div>

                                                <div class="col-sm-3 mb-1">
                                                    <input type="text" class="form-control form-control-user" name="material_name_edit" id="material_name_edit" placeholder="Material" readonly="readonly" style="color:black; font-size:medium; background-color:lightgray; border:1px solid black;">
                                                </div>

                                                <div class="col-sm-3 mb-1">
                                                    <input type="number" class="form-control form-control-user" name="new_per_unit" id="new_per_unit" placeholder="Per Unit Price">
                                                </div>

                                                <div class="col-sm-3 mb-1">
                                                    <input type="number" class="form-control form-control-user" name="new_quantity" id="new_quantity" placeholder="Add Quantity">
                                                </div>

                                                <div class="col-sm-3 mb-1">
                                                    <input type="number" class="form-control form-control-user" name="new_price" id="new_price" placeholder="Total Price" readonly>
                                                </div>

                                            </div>

                                            <div class="form-group row justify-content-center">
                                                <div class="col-sm-4">
                                                    <button type="button" class="btn btn-primary btn-user btn-block" id="edit_btn">
                                                        <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                        Update Material
                                                    </button>
                                                    <span id="show_error_update" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
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
                                                <th scope="col" style="text-align:center">Available Quantity</th>
                                                <th scope="col">Remaining Price</th>
                                                <th scope="col">Unit</th>
                                                <?php $acct_type = $this->session->userdata('acct_type');
                                                if ($acct_type != "admin_super") {
                                                    if ($acct_type != "admin_north") {
                                                        if ($acct_type != "admin_south") { ?>
                                                            <th scope="col">Edit/Update Quantity</th>
                                                <?php }
                                                    }
                                                } ?>
                                                <th scope="col">View Details</th>
                                                <?php if ($acct_type == "admin_super") { ?>
                                                    <th scope="col">Region</th>
                                                <?php } ?>

                                            </tr>
                                        </thead>
                                        <tbody id="table_rows">
                                            <?php $count = 0;
                                            foreach ($inventory_records as $data) { ?>
                                                <tr>
                                                    <td scope="row"><?= ++$count; ?></td>
                                                    <td id="material<?= $data['ID']; ?>" scope="row"><?= $data['Material_Name']; ?></td>
                                                    <td id="quant<?= $data['ID']; ?>" class="quant" scope="row" style="text-align:center"><?= $data['Material_Total_Quantity']; ?></td>
                                                    <td scope="row">PKR. <?= $data['Material_Total_Price']; ?></td>
                                                    <td scope="row"><?= $data['Unit']; ?></td>
                                                    <?php $acct_type = $this->session->userdata('acct_type');
                                                    if ($acct_type != "admin_super") {
                                                        if ($acct_type != "admin_north") {
                                                            if ($acct_type != "admin_south") { ?>
                                                                <td type="button" id="edit<?= $data['ID']; ?>" class="edit" scope="row" data-toggle="modal" data-target="#edit_material"><i style="margin-left: 70px;" class="fas fa-edit"></i></td>
                                                    <?php }
                                                        }
                                                    } ?>
                                                    <td id="view" class="view" scope="row"><a href="<?= base_url(); ?>SO_STORE/view_inventory_detail/<?= $data['ID']; ?>" style="color:black"><i style="margin-left: 40px;" class="fas fa-eye"></i></a></td>
                                                    <?php if ($acct_type == "admin_super") { ?>
                                                        <td scope="row"><?= $data['region']; ?></td>
                                                    <?php } ?>
                                                    <td scope="row" style="display:none"><?= $data['ID']; ?></td>

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
                    <?php $acct_type = $this->session->userdata('acct_type');
                    if ($acct_type != "admin_super") {
                        if ($acct_type != "admin_north") {
                            if ($acct_type != "admin_south") { ?>

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
                    <?php }
                        }
                    } ?>
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
        var per_unit = $('#per_unit').val();

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
        if (per_unit == '') {
            validate = 1;
            $('#per_unit').addClass('red-border');
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

        if (price == 0) {
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

    $('#quantity').on('keyup focusout', function() {
        var quantity = $(this).val();
        var per_unit_cost = $('#per_unit').val();
        $('#price').val(quantity * per_unit_cost);
    });

    $('#per_unit').on('keyup focusout', function() {
        var quantity = $('#quantity').val();
        var per_unit_cost = $('#per_unit').val();
        $('#price').val(quantity * per_unit_cost);
    });

    $('#new_quantity').on('keyup focusout', function() {
        var quantity = $(this).val();
        var per_unit_cost = $('#new_per_unit').val();
        $('#new_price').val(quantity * per_unit_cost);
    });

    $('#new_per_unit').on('keyup focusout', function() {
        var quantity = $('#new_quantity').val();
        var per_unit_cost = $('#new_per_unit').val();
        $('#new_price').val(quantity * per_unit_cost);
    });

    $('#edit_btn').on('click', function() {
        //alert('javascript working');
        $('#edit_btn').attr('disabled', true);
        var validate = 0;

        var material_name = $('#material_name_edit').val();
        var quantity = $('#new_quantity').val();
        var price = $('#new_price').val();
        var new_per_unit = $('#new_per_unit').val();

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
        if (new_per_unit == '') {
            validate = 1;
            $('#new_per_unit').addClass('red-border');
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
        $('#id_edit').val($columns[7].innerHTML);
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