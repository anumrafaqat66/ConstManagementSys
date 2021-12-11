<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $this->load->view('chat/common/header'); ?>
<?php !isset($selectedSender) ? $selectedSender = 0 : $selectedSender; ?>
<?php !isset($user_name) ? $user_name = 0 : $user_name; ?>
<style>
  .selectVendor {
    position: relative;
  }

  .status-indicator {
    background-color: #eaecf4;
    height: .75rem;
    width: .75rem;
    border-radius: 100%;
    position: absolute;
    bottom: 0;
    right: 0;
    border: .125rem solid #fff;
  }

  .fileDiv {
    position: relative;
    overflow: hidden;
  }

  .upload_attachmentfile {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
  }

  .btnFileOpen {
    margin-top: -50px;
  }

  .direct-chat-warning .right>.direct-chat-text {
    background: #d2d6de;
    border-color: #d2d6de;
    color: #444;
    text-align: right;
  }

  .direct-chat-primary .right>.direct-chat-text {
    background: #3c8dbc;
    border-color: #3c8dbc;
    color: #fff;
    text-align: right;
  }

  .spiner {}

  .spiner .fa-spin {
    font-size: 24px;
  }

  .attachmentImgCls {
    width: 450px;
    margin-left: -25px;
    cursor: pointer;
  }
</style>

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper" style="overflow: hidden;">

    <!-- Left side column. contains the logo and sidebar -->

    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper" style="margin: 0px;">

      <!-- Content Header (Page header) -->

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col-md-8" id="chatSection">
            <!-- DIRECT CHAT -->
            <div class="box direct-chat direct-chat-primary">
              <div class="box-header with-border" style="background-color:#000154; color:white; border-top-left-radius:5px; border-top-right-radius:5px">
                <h3 class="box-title" id="ReciverName_txt">Lets Chat</h3>

                <!--   <div class="box-tools pull-right">
                  <span data-toggle="tooltip" title="Clear Chat" class="ClearChat"><i class="fa fa-comments"></i></span>
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Clear Chat" data-widget="chat-pane-toggle">
                    <i class="fa fa-comments"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
                </div> -->
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages" id="content">
                  <!-- /.direct-chat-msg -->
                  <div id="dumppy"></div>
                </div>
                <!--/.direct-chat-messages-->

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <!--<form action="#" method="post">-->
                <div class="input-group">
                  <?php
                  //$obj=&get_instance();
                  //	$obj->load->model('UserModel');
                  //$profile_url = $obj->UserModel->PictureUrl();
                  //$user=$obj->UserModel->GetUserData();
                  ?>

                  <input type="hidden" id="Sender_Name" value="<?= $this->session->userdata('username'); ?>">
                  <input type="hidden" id="Sender_ProfilePic" value="<?= base_url(); ?>assets/img/user.png">
                  <input type="hidden" id="ReciverId_txt" value="">
                  <input type="text" name="message" placeholder="Type Message ..." class="form-control message" style="border-radius:20px !important">

                  <span class="input-group-btn">
                    <!-- <button type="button" style="height:100%;background-color:#000154 !important; border-color: #000154; color:white !important; border-radius:20px !important" id="nav_down">Send</button> -->
                    <button type="button" class="btn btn-success btn-flat btnSend" id="nav_down" style="height:100%;background-color:#000154 !important; border-color: #000154; color:white !important; border-radius:20px !important">Send</button>
                    <div class="fileDiv btn btn-info btn-flat" style="background-color:#000154; color:white; border-radius:20px; border-color: #000154;"> <i class="fa fa-upload"></i>
                      <input type="file" name="file" class="upload_attachmentfile" />
                    </div>
                  </span>
                </div>
                <!--</form>-->
              </div>
              <!-- /.box-footer-->
            </div>
            <!--/.direct-chat -->
          </div>




          <div class="col-md-4">
            <!-- USERS LIST -->
            <div class="box">
              <div class="box-header with-border" style="background-color:#000154; color:white; border-top-left-radius:5px; border-top-right-radius:5px">
                <h3 class="box-title">Chat</h3>

                <div class="box-tools pull-right">
                  <span class="label label-success"><?= 'Online Users: ' . count($list); ?></span>
                  <!--   <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                  </button> -->
                </div>
              </div>

              <!-- /.box-body -->
              <div class="box-body no-padding">
                <ul class="users-list clearfix">
                  <input type="hidden" id="selectedSender" value=<?= $selectedSender; ?>>
                  <?php if (empty($selectedSender)) {
                    if (!empty($whole_list)) {
                      foreach ($whole_list as $userdata) :
                  ?>
                        <li class="selectVendor" id="<?= $userdata['id']; ?>" title="<?= $userdata['username']; ?>">
                          <img src="<?= base_url(); ?>assets/img/user.png" alt="<?= $userdata['username']; ?>" title="<?= $userdata['username']; ?>">
                          <?php if ($userdata['status'] == "online") {
                          ?>
                            <i style="margin: 0px 25px 40px 0px;" class="status-indicator bg-success"></i>
                          <?php } ?>

                          <a class="users-list-name" href="#"><?= $userdata['username']; ?></a>
                        </li>
                      <?php endforeach; ?>
                    <?php }
                  } else if (!empty($selectedSender)) { ?>
                    <li class="selectVendor" id="<?= $selectedSender; ?>" title="<?= $user_name['username']; ?>">
                      <img src="<?= base_url(); ?>assets/img/user.png" alt="<?= $user_name['username']; ?>" title="<?= $user_name['username']; ?>">
                      <?php if ($user_name['status'] == "online") {
                      ?>
                        <i style="margin: 0px 25px 40px 0px;" class="status-indicator bg-success"></i>
                      <?php } ?>

                      <a class="users-list-name" href="#"><?= $user_name['username']; ?></a>
                    </li>

                  <?php } else { ?>

                    <li>
                      <a class="users-list-name" style="width: 35%" href="#">No User Found...</a>
                    </li>
                  <?php } ?>
                </ul>
              </div>
              <!-- /.box-footer -->
            </div>
            <!--/.box -->
          </div>
          <!-- /.col -->
        </div>

        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="myModalImg">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title" id="modelTitle">Modal Heading</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <img id="modalImgs" src="uploads/attachment/21_preview.png" class="img-thumbnail" alt="Cinque Terre">
          </div>

          <!-- Modal footer -->


        </div>
      </div>
    </div>
    <!-- Modal -->

  </div>

  </div>

  <?php $this->load->view('chat/common/footer'); ?>
  <script src="<?= base_url('assets/js/chat/chat.js'); ?>"></script>

</body>

</html>
<script type="text/javascript">
  window.onload = function exampleFunction() {

    var selected = $('#selectedSender').val();
    // alert(selected);
    if (selected != 0) {
      GetChatHistory(selected);
      $('#chatSection :input').removeAttr('disabled');
      // $('#ReciverId_txt').val(selected);
      // $('#ReciverName_txt').html($(this).attr('title'));
    }
  }

  function seen(data) {
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

  // setInterval(function() {
  //   exampleFunction(receiver_id);
  // }, 3000);
</script>