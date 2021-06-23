<a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-envelope fa-fw"></i>
    <!-- Counter - Messages -->
    <?php if (count($chat_data) != 0) { ?>
        <span id="badge_count" class="badge badge-danger badge-counter"><?= count($chat_data) ?></span>
    <?php } ?>
</a>
<!-- Dropdown - Messages -->
<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
    <h6 class="dropdown-header">
        Chat Corner
    </h6>
    <?php if (count($chat_data) > 0) { ?>
        <?php foreach ($chat_data as $data) { ?>
            <!-- <a class="dropdown-item d-flex align-items-center" onclick="seen(<?= $data['sender_id'] ?>)" href="<?= base_url(); ?>ChatController"> -->
            <a class="dropdown-item d-flex align-items-center" onclick="seen(<?= $data['sender_id'] ?>)" href="<?= base_url(); ?>ChatController?sender_id=<?= $data['sender_id'] ?>">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="<?= base_url(); ?>assets/img/user1.png" alt="">
                    <!--  <div class="status-indicator bg-success"></div> -->
                </div>
                <div>
                    <div><b><?php $user = $this->db->where('id', $data['sender_id'])->get('security_info')->row_array();
                            echo $user['username']; ?>
                        </b></div>
                    <div class="text-truncate"><?= $data['message']; ?></div>
                    <div class="small text-gray-500"><?= date("D-H:i", strtotime($data['message_date_time'])); ?></div>
                </div>
            </a>
        <?php }
    } else { ?>
        <div>
            <div style="padding:10px">
                <b>No New Messages </b>
            </div>
        </div>
    <?php } ?>
    <a class="dropdown-item text-center small text-gray-500" href="<?= base_url(); ?>ChatController">Read More Messages</a>
</div>
<!-- <script src="<?= base_url('assets/js/chat/chat.js'); ?>"></script> -->