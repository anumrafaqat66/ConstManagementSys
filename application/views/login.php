<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>NHS PMS</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<style>
  .img-bg {
    background-image: url('<?= base_url() ?>assets/img/bg-image.jpg');
    background-size: cover;
    width: 100%;
  }

  .region {
    box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px !important;
    background: transparent !important;
    text-align: center !important;
    font-weight: 700 !important;
    border-radius: 20px !important;
    /* border-color: skyblue !important; */
    border-color: #000154 !important;
  }

  .red-border {
    border: 1px solid red !important;
  }
</style>

<body class="row img-bg">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
      <h1 class="h1 text-black-900 mb-4" style="margin-top:50px; padding:0%; margin-bottom:0px;"><strong> Construction Management System <?php if ($this->session->userdata('region') == 'both') {
                                                                                                                                            echo "(Admin)";
                                                                                                                                          } else if ($this->session->userdata('region') == 'north') {
                                                                                                                                            echo "(North)";
                                                                                                                                          } else if ($this->session->userdata('region') == 'south') {
                                                                                                                                            echo "(South)";
                                                                                                                                          } ?></strong></h1>
      <div class="col-xl-7">
        <div class="card o-hidden border-0 shadow-lg my-5 region" style="height:390px; background: transparent !important;">
          <!-- <div class="card-body p-0" style=""> -->
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image "></div>
            <div class="col-lg-6">
            </div>
            <div class="col-lg-6">
              <div class="p-5">
                <form class="user" role="form" id="login_form" method="post" action="<?php echo base_url(); ?>User_Login/login_process">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Enter Username...">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password">
                  </div>

                  <div class="form-group" style="display:none">
                    <select class="form-control form-control-user" name="optradio" id="optradio" style="height:50px;padding:10px">
                      <option value="">Account Type</option>
                      <option value="PO">Project Officer</option>
                      <option value="SO_STORE">SO Store</option>
                      <option value="SO_CW">SO CW</option>
                      <option value="SO_RECORD">SO Record</option>
                      <option value="admin"></option>
                    </select>
                  </div>

                  <span style="color: red; display: none;font-size: 12px" id="Account_error">
                    *Please select Account type
                  </span>

                  <hr>
                  <button type="button" class="btn btn-primary btn-user btn-block" id="login_btn">
                    <i class="fas fa-key"></i>
                    Login
                  </button>
                  <hr>
                  <button type="button" class="btn btn-primary btn-user btn-block" id="btn_back" onclick="location.href='<?php echo base_url(); ?>'">
                    <i class="fas fa-arrow-left"></i>
                    Back
                  </button>

                </form>
                <hr>
                <br><br>

              </div>
            </div>
          </div>

        </div>
        <!-- DIv 2 -->



      </div>

    </div>

  </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

  <script>
    $('#login_btn').on('click', function() {
      // alert('javascript working');
      $('#login_btn').attr('disabled', true);
      var validate = 0;

      var user_type = document.getElementsByName("optradio");

      var username = $('#username').val();
      var password = $('#password').val();
      var role = $('#optradio').val();

      if (username == '') {
        validate = 1;
        $('#username').addClass('red-border');
      }
      if (password == '') {
        validate = 1;
        $('#password').addClass('red-border');
      }
      // if (role == '') {
      //   validate = 1;
      //   $('#optradio').addClass('red-border');
      //   $('#Account_error').show();
      // }
      // if (user_type[0].checked != true && user_type[1].checked != true && user_type[2].checked != true && user_type[3].checked != true && user_type[4].checked != true && user_type[5].checked != true) {
      //   validate = 1;
      //   $('#Account_error').show();
      // }

      if (validate == 0) {
        $('#login_form')[0].submit();
      } else {
        $('#login_btn').removeAttr('disabled');
      }
    });
  </script>

  <script src="<?php echo base_url(); ?>assets/swal/swal.all.min.js"></script>
  <?php if ($this->session->flashdata('success')) : ?>
    <script>
      Swal.fire(
        '<?php echo $this->session->flashdata('success'); ?>',
        '',
        'success'
      );
    </script>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>

  <?php if ($this->session->flashdata('failure')) : ?>
    <script>
      Swal.fire(
        '<?php echo $this->session->flashdata('failure'); ?>',
        'Invalid username or password',
        'error'
      );
    </script>
    <?php unset($_SESSION['failure']); ?>
  <?php endif; ?>
</body>

</html>