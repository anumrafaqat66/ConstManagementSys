 <footer class="sticky-footer bg-custom1 text-white">
     <div class="container my-auto">
         <div class="copyright text-center my-auto">
             <span>Copyright &copy; Your Website 2020</span>
         </div>
     </div>
 </footer>
 <!-- End of Footer -->

 </div>
 <!-- End of Content Wrapper -->

 </div>
 <!-- End of Page Wrapper -->

 <!-- Scroll to Top Button-->
 <a class="scroll-to-top rounded" href="#page-top">
     <i class="fas fa-angle-up"></i>
 </a>
 <!-- Code begins here -->

 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
             <div class="modal-footer">
                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                 <a class="btn btn-primary" href="<?= base_url(); ?>User_Login/logout">Logout</a>
             </div>
         </div>
     </div>
 </div>

 <!-- Bootstrap core JavaScript-->
 <!-- for chat / -->

  <!-- jQuery 3 -->
<!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
 <script src="<?= base_url() ?>assets/components/jquery/dist/jquery.min.js"></script>
<!--  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script> -->
 <script src="<?= base_url() ?>/assets/dist/js/adminlte.min.js"></script>
 <script src="<?= base_url() ?>/assets/dist/js/adminlte.js"></script>

 <!-- SlimScroll -->
<script src="<?=base_url()?>assets/components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>assets/components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>assets/dist/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
  <?php if($this->uri->segment(1) != 'ChatController'){?>
  $(document).ajaxStart(function () {
    Pace.restart();
  });
  <?php }?>
</script>


 <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script> 

 <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.min.js"></script> 

 <!-- Page level plugins -->
 <!-- <script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script> -->

 <!-- Page level custom scripts -->
 <!-- <script src="<?php echo base_url(); ?>assets/js/demo/chart-area-demo.js"></script> -->
 <!-- <script src="<?php echo base_url(); ?>assets/js/demo/chart-pie-demo.js"></script> -->



 </body>

 </html>