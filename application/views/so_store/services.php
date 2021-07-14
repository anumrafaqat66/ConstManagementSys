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
     .img {
         background: url('<?= base_url() ?>assets/img/project-banner.jpg');
         background-position: center;
         background-size: cover;
         height: 250px;
         filter: blur(1px);
         border-radius: 25px;
     }

     .red-border {
         border: 1px solid red !important;
     }
 </style>

 <div class="container">
     <!-- <h2 class="my-4">Welcome, Project officer!</h2> -->
     <div style="padding:50px">
         <h1><strong> Services by NHS PMS </strong></h1>
         <p style="text-align:justify"> The Pakistan Navy (romanized: Pākistān Bāhrí'a; pronounced [ˈpaːkɪstaːn baɦɽiːa]) is the naval warfare branch of the Pakistan Armed Forces. It came into existence by transfer of personnel and equipment from the Royal Indian Navy that ceased to exist following the partition of British India through a parliamentary act that established the independence of Pakistan and India from the United Kingdom on 14 August 1947.[12]

             Its primary objective is to ensure the defence of the sea lines of communication of Pakistan and safeguarding Pakistan's maritime interests by executing national policies through the exercise of military effect, diplomatic and humanitarian activities in support of these objectives.[13][14] In addition to its war services, the Navy has mobilized its war assets to conduct humanitarian rescue operations at home as well as participating in multinational task forces mandated by the United Nations to prevent seaborne terrorism and privacy off the coasts.
         </p>
     </div>
 </div>

 </div>

 <?php $this->load->view('common/footer'); ?>
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