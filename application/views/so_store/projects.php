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
    <div class="modal fade" id="all_projects">
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
                                    <h1 class="h4">Select Project:</h1>
                                </div>

                                <div class="card-body">
                                    <div id="table_div">
                                        <?php if (count($project_records) > 0) { ?>
                                            <table id="datatable" class="table table-striped" style="color:black">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Project Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_rows_project">
                                                    <?php $count = 1;
                                                    foreach ($project_records as $data) { ?>
                                                        <tr>
                                                            <td scope="row" id="cont<?= $count; ?>"><?= $count; ?></td>
                                                            <td scope="row"><a style="color:black; font-weight:800;" type="button" onclick="location.href='<?php echo base_url(); ?>SO_STORE/report_inventory_used/<?= $data['ID']; ?>'"><?= $data['Name']; ?></a></td>
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

    <div class="card o-hidden my-4 border-0 shadow-lg">

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
                                        <form class="user" role="form" method="post" id="edit_form" action="<?= base_url(); ?>SO_STORE/project_material">
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
                                                    <h6>&nbsp;Quantity Used:</h6>
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
                                                        <?php $material_data = $this->db->where('region', $this->session->userdata('region'))->get('inventory')->result_array(); ?>
                                                        <?php foreach ($material_data as $data) { ?>
                                                            <option class="form-control form-control-user small" value="<?= $data['ID'] ?>"><?= $data['Material_Name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span id="show_material" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Select Material First:</span>
                                                </div>

                                                <div class="col-sm-2 mb-1">
                                                    <input type="number" class="form-control form-control-user" pattern="[0-9]{11}" name="quantity" id="quantity" placeholder="Quantity">
                                                    <span id="show_quantity" style="font-size:10px; color:red; display:none">Available Quantity:</span>
                                                </div>

                                                <div class="col-sm-2 mb-1">
                                                    <input type="number" class="form-control form-control-user" name="price" id="price" placeholder="Price" readonly>
                                                </div>

                                            </div>

                                            <div class="form-group row justify-content-center">
                                                <div class="col-sm-4">
                                                    <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn">
                                                        <!-- <i class="fab fa-google fa-fw"></i>  -->
                                                        Add Record
                                                    </button>
                                                    <span id="show_error" style="font-size:10px; color:red; display:none">&nbsp;&nbsp;Please check errors*</span>
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
                                                <!-- <th scope="col">Total Cost</th> -->
                                                <th scope="col">Status</th>
                                                <?php $acct_type = $this->session->userdata('acct_type');
                                                if ($acct_type != "admin_super") {
                                                    if ($acct_type != "admin_north") {
                                                        if ($acct_type != "admin_south") { ?>
                                                            <th scope="col">Add Material Record</th>
                                                <?php }
                                                    }
                                                } ?>
                                                <th scope="col">View Material Details</th>
                                                <?php if ($acct_type == "admin_super") { ?>
                                                    <th scope="col">Region</th>
                                                <?php } ?>

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
                                                    <!-- <td scope="row">PKR. <?= $data['Total_Cost']; ?></td> -->
                                                    <td scope="row"><?= $data['Status']; ?></td>
                                                    <?php $acct_type = $this->session->userdata('acct_type');
                                                    if ($acct_type != "admin_super") {
                                                        if ($acct_type != "admin_north") {
                                                            if ($acct_type != "admin_south") { ?>
                                                                <td type="button" id="edit<?= $data['ID']; ?>" class="edit" scope="row" data-toggle="modal" data-target="#edit_material"><i style="margin-left: 75px;" class="fas fa-edit"></i></td>
                                                    <?php }
                                                        }
                                                    } ?>
                                                    <td id="view" class="view" scope="row"><a href="<?= base_url(); ?>SO_STORE/view_material_detail/<?= $data['ID'] ?>" style="color:black"><i style="margin-left: 65px;" class="fas fa-eye"></i></a></td>
                                                    <?php if ($acct_type == "admin_super") { ?>
                                                        <td scope="row"><?= $data['region']; ?></td>
                                                    <?php } ?>
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

        var delivery_date = $('#delivery_date').val();
        var material = $('#material').val();
        var quantity = $('#quantity').val();
        var price = $('#price').val();


        if (delivery_date == '') {
            validate = 1;
            $('#delivery_date').addClass('red-border');
        }
        if (material == '') {
            validate = 1;
            $('#material').addClass('red-border');
        }
        if (quantity == '') {
            validate = 1;
            $('#quantity').addClass('red-border');
        }
        if (price == '') {
            validate = 1;
            $('#price').addClass('red-border');
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

            $.ajax({
                url: '<?= base_url(); ?>SO_STORE/get_material_price',
                method: 'POST',
                data: {
                    'material_id': $('#material').val(),
                },
                success: function(data) {

                    var result = jQuery.parseJSON(data);
                    var len = result.length;

                    var remaining_qty = $('#quantity').val();
                    var total_value = 0;
                    for (var i = 0; i < len; i++) {
                        var cost_per_unit = result[i]['cost_per_unit'];
                        var quantity = result[i]['quantity'];
                        var material_dtl_id = result[i]['ID'];

                        if (remaining_qty > 0) {
                            if (remaining_qty - quantity <= 0) {
                                total_value = total_value + (remaining_qty * cost_per_unit);

                                $.ajax({
                                    url: '<?= base_url(); ?>SO_STORE/update_inventory_detail',
                                    method: 'POST',
                                    data: {
                                        'material_detail_id': material_dtl_id,
                                        'qty_used': remaining_qty,
                                        'price_used': (remaining_qty * cost_per_unit)
                                    },
                                    success: function(data) {},
                                    async: false
                                });

                                remaining_qty = 0;

                            } else {
                                total_value = total_value + (quantity * cost_per_unit);
                                remaining_qty = remaining_qty - quantity;

                                $.ajax({
                                    url: '<?= base_url(); ?>SO_STORE/update_inventory_detail',
                                    method: 'POST',
                                    data: {
                                        'material_detail_id': material_dtl_id,
                                        'qty_used': quantity,
                                        'price_used': (quantity * cost_per_unit)
                                    },
                                    success: function(data) {},
                                    async: false
                                });
                            }
                        }


                    }

                },
                async: false
            });


            $('#edit_form')[0].submit();
            $('#show_error').hide();
        } else {
            $('#add_btn').removeAttr('disabled');
            $('#show_error').show();
        }
    });

    $('#quantity').on('keyup focusout', function() {
        if (!$.isNumeric($('#quantity').val())) {
            $('#quantity').addClass('red-border');
            $('#quantity').focus();
        }
    });

    $('#quantity').on('focusout', function() {
        //alert('abc');

        var cur_val = $(this).val();
        var id = $('#material').val();
        if (id == '') {
            //  alert('Please select material first');
            $("#material").focus();
            $("#material").addClass('red-border');
            $("#show_material").show();
            $('#quantity').val('');
            return;
        } else {
            $("#material").removeClass('red-border');
            $("#show_material").hide();
        }

        $.ajax({
            url: '<?= base_url(); ?>SO_STORE/get_total_material_available',
            method: 'POST',
            data: {
                'material_id': id,
            },
            success: function(data) {

                if (parseInt(cur_val) > parseInt(data)) {
                    $('#show_quantity').html('&nbsp;Available quantity: ' + data);
                    $('#show_quantity').show();
                    $('#quantity').addClass('red-border');
                } else {
                    $('#quantity').removeClass('red-border');
                    $('#show_quantity').hide();
                }

            },
            async: false
        });

        $.ajax({
            url: '<?= base_url(); ?>SO_STORE/get_material_price',
            method: 'POST',
            data: {
                'material_id': id,
            },
            success: function(data) {

                var result = jQuery.parseJSON(data);
                var len = result.length;

                var remaining_qty = cur_val;
                var total_value = 0;
                for (var i = 0; i < len; i++) {
                    var cost_per_unit = result[i]['cost_per_unit'];
                    var quantity = result[i]['quantity'];
                    var material_dtl_id = result[i]['ID'];

                    if (remaining_qty > 0) {
                        if (remaining_qty - quantity <= 0) {
                            total_value = total_value + (remaining_qty * cost_per_unit);
                            $('#price').val(total_value);
                            remaining_qty = 0;
                        } else {
                            total_value = total_value + (quantity * cost_per_unit);
                            remaining_qty = remaining_qty - quantity;
                        }
                    }


                }

            },
            async: false
        });

    })

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