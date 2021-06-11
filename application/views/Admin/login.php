<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Login</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<style>
  .red-border {
    border: 1px solid red !important;
  }
</style>


<body class="bg-custom1">

    <div class="container bg-custom1">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card bg-custom3 o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Admin Login Panel</h1>
                                    </div>
                                    <form class="user" role="form" id="login_form" method="post" action="<?php echo base_url();?>Admin/login_process">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" id="username"  placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password"  name="password" class="form-control form-control-user" id="password" placeholder="Password">
                                        </div>
                                      
                                        <hr>
                                        <button type="button"  class="btn btn-primary btn-user btn-block" id="login_btn">
                                            <!-- <i class="fab fa-google fa-fw"></i>  -->
                                            Login
                                        </button>

                                    </form>
                                   <hr>
                                   <br><br><br>
                                   <!--   <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <script>
$('#login_btn').on('click', function() {
   // alert('javascript working');
    $('#login_btn').attr('disabled', true);
    var validate = 0;

    var user_type = document.getElementsByName("optradio");
               
    var username = $('#username').val();
    var password = $('#password').val();

    if (username == '') {
      validate = 1;
      $('#username').addClass('red-border');
    }
     if (password == '') {
      validate = 1;
      $('#password').addClass('red-border');
    }
    
    //  if (user_type[0].checked != true && user_type[1].checked != true && user_type[2].checked != true && user_type[3].checked != true && user_type[4].checked != true ) {
    //                validate=1;
    //                $('#Account_error').show();
    //             } 

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