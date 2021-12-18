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
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<style>
  .img-bg {
    background-image: url('<?= base_url() ?>assets/img/bg-image.jpg');
    background-size: cover;
  }

  .img-logo {
    background: url('<?= base_url() ?>assets/img/navy_logo2.png');
    /* background-position: center; */
    background-size: cover;
    height: 170px;
    width: 133px;
    /* filter: blur(1px); */
    /* border-radius: 25px; */
  }

  .red-border {
    border: 1px solid red !important;
  }

  .region {
    box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
    background: transparent !important;
    text-align: center;
    font-weight: 700 !important;
    border-radius: 20px;
    /* border-color: skyblue !important; */
    border-color: #000154 !important;
  }

  p:hover,
  h2:hover,
  a:hover,
  .region:hover {
    background-color: #000154 !important;
    color: white;
    cursor: pointer;
  }
</style>


<body class="row img-bg" style="overflow: hidden;">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
      <h1 class="h1 text-black-900 mb-4" style="padding:1%;"><strong> NHS PMS Management System </strong></h1>
    </div>

    <div class="row justify-content-center">
      <div class="img-logo"></div>
    </div>

    <div class="row justify-content-center">
      <h2 class="h2 text-black-900 mb-4" style="padding:0%; text-decoration:underline"><strong> Select Region </strong></h2>
    </div>

    <div class="row my-3">

      <div class="col-lg-6">
        <div class="card region">
          <div class="card-body bg-custom3 region" onclick="location.href='<?php echo base_url(); ?>User_Login/login_page_north'">
            <h2><strong> North </strong></h2>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card region">
          <div class="card-body bg-custom3 region" onclick="location.href='<?php echo base_url(); ?>User_Login/login_page_south'">
            <h2><strong> South </strong></h2>
          </div>
        </div>
      </div>

      <!-- <div class="col-lg-4">
        <div class="card region" >
          <div class="card-body bg-custom3 region" onclick="location.href='<?php echo base_url(); ?>User_Login/login_page_super_admin'">
            <h2><strong> Admin </strong></h2>
          </div>
        </div>

      </div> -->
    </div>

    <div class="row my-2">
      <div class="col-lg-12">
        <div class="card region">
          <div class="card-body bg-custom3 region" onclick="location.href='<?php echo base_url(); ?>User_Login/login_page_super_admin'">
            <h2><strong> Admins </strong></h2>
          </div>
        </div>

      </div>
    </div>
    <a id="btn_officer_record" style="cursor: pointer; color:white; padding-top: 10px; display: block; text-decoration:underline; text-align:center" onclick="location.href='<?php echo base_url(); ?>SO_RECORD/search_officer_record'">
      Check NHS Officer Record
    </a>



  </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

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