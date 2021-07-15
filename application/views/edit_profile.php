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

    <div class="card o-hidden my-4 sborder-0 shadow-lg">
        <div class="card-body bg-custom3">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header bg-custom1">
                            <h1 class="h4 text-white">Edit User Profile</h1>
                        </div>

                        <div class="card-body bg-custom3">
                            <form class="user" role="form" method="post" id="add_form" action="<?= base_url(); ?>User_Login/edit_profile_process">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <h6>&nbsp;Username:</h6>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-1">
                                        <input type="text" class="form-control form-control-user" value="<?= $userdata['username'] ?>" id="username" name="username" placeholder="username*">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <h6>&nbsp;Full Name:</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6>&nbsp;Email ID:</h6>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-1">
                                        <input type="text" class="form-control form-control-user" value="<?= $userdata['full_name'] ?>" id="fullname" name="fullname" placeholder="Full Name">
                                    </div>
                                    <div class="col-sm-6 mb-1">
                                        <input type="email" class="form-control form-control-user" value="<?= $userdata['email'] ?>" id="email" name="email" placeholder="Email Address*">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <h6>&nbsp;Contact No:</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6>&nbsp;Address:</h6>
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-sm-6 mb-1">
                                        <input type="tel" class="form-control form-control-user" value="<?= $userdata['phone'] ?>" id="phone" name="phone" pattern="[0-9]{11}" placeholder="Phone No*">
                                    </div>
                                    <div class="col-sm-6 mb-1">
                                        <input type="text" class="form-control form-control-user" id="address" value="<?= $userdata['address'] ?>" name="address" placeholder="Address*">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <h6>&nbsp;Account Type:</h6>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 mb-1">
                                        <select class="form-control rounded-pill" name="status" id="status" value="<?= $userdata['acct_type'] ?>" data-placeholder="Select Controller" style="font-size: 0.8rem; height:50px;" readonly>
                                            <?php if ($userdata['acct_type'] == 'SO_STORE') { ?>
                                                <option class="form-control form-control-user" value="<?= $userdata['acct_type'] ?>">SO STORE</option>
                                            <?php } else if ($userdata['acct_type'] == 'PO') { ?>
                                                <option class="form-control form-control-user" value="<?= $userdata['acct_type'] ?>">Project Officer</option>
                                            <?php } else if ($userdata['acct_type'] == 'SO_CW') { ?>
                                                <option class="form-control form-control-user" value="<?= $userdata['acct_type'] ?>">SO CW</option>
                                            <?php } else if ($userdata['acct_type'] == 'SO_RECORD') { ?>
                                                <option class="form-control form-control-user" value="<?= $userdata['acct_type'] ?>">SO Record</option>
                                            <?php }
                                            else if ($userdata['acct_type'] == 'admin_super') { ?>
                                                <option class="form-control form-control-user" value="<?= $userdata['acct_type'] ?>">Admin Super</option>
                                            <?php }
                                             else if ($userdata['acct_type'] == 'admin_north') { ?>
                                                <option class="form-control form-control-user" value="<?= $userdata['acct_type'] ?>">Admin North</option>
                                            <?php } 
                                            else if ($userdata['acct_type'] == 'admin_south') { ?>
                                                <option class="form-control form-control-user" value="<?= $userdata['acct_type'] ?>">Admin South</option>
                                            <?php }     ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row justify-content-center">
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-primary btn-user btn-block" id="add_btni">
                                            <!-- <i class="fab fa-google fa-fw"></i>  -->
                                            Update
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
    $('#add_btni').on('click', function() {
        //alert('javascript working');
        $('#add_btn').attr('disabled', true);
        var validate = 0;

        var username = $('#fullname').val();
        var password = $('#password').val();
        // var status = $('#status').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var address = $('#address').val();

        if (username == '') {
            validate = 1;
            $('#fullname').addClass('red-border');
        }
        if (password == '') {
            validate = 1;
            $('#password').addClass('red-border');
        }
        // if (status == '') {
        //     validate = 1;
        //     $('#status').addClass('red-border');
        // }
        if (email == '') {
            validate = 1;
            $('#email').addClass('red-border');
        }
        if (phone == '') {
            validate = 1;
            $('#phone').addClass('red-border');
        }
        if (address == '') {
            validate = 1;
            $('#address').addClass('red-border');
        }
        if (validate == 0) {
            $('#add_form')[0].submit();
        } else {
            $('#add_btni').removeAttr('disabled');
        }
    });


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
</script>