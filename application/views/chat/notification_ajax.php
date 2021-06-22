                              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter"><?= count($chat_data) ?></span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Chat Corner
                                </h6>
                                <?php foreach($chat_data as $data){ ?>
                                <a class="dropdown-item d-flex align-items-center" href="<?=base_url();?>ChatController/notification/<?= $data['sender_id'];?>">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="<?= base_url();?>assets/img/user1.png" alt="">
                                      <!--   <div class="status-indicator bg-success"></div> -->
                                    </div>
                                    <div>
                                        <div><b><?php $user= $this->db->where('id',$data['receiver_id'])->get('security_info')->row_array(); 
                                        echo $user['username']; ?>
                                        </b></div>
                                        <div class="text-truncate"><?= $data['message'];?></div>
                                        <div class="small text-gray-500"><?= date("D-H:i", strtotime($data['message_date_time']));?></div>
                                    </div>
                                </a>
                                <?php } ?>
                                <a class="dropdown-item text-center small text-gray-500" href="<?=base_url();?>ChatController">Read More Messages</a>
                            </div>