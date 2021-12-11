<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ChatController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('string');
	}

	public function index()
	{
		$input_params = $this->input->get(); // this will give you all parameters

		$data['strTitle'] = '';
		$data['strsubTitle'] = '';
		$data['list'] = $this->ClientsListCs();
		$data['strTitle'] = 'All Connected Clients';
		$data['strsubTitle'] = 'Clients';
		$data['chatTitle'] = 'Select Client with Chat';
		$data['list_count'] = count($data['list']);
		$data['whole_list'] = $this->ClientsList();
		$data['selectedSender'] = $input_params['sender_id'];
		$data['user_name'] = $this->db->where('id', $input_params['sender_id'])->get('security_info')->row_array();
		//Fupdateprint_r($data['whole_list']);exit;
		$this->load->view('chat/chat_template', $data);
	}


	public function seen()
	{
		$id = $_POST['id'];
		// echo $id;exit;
		$this->db->set('seen', 'yes');
		$this->db->where('sender_id', $id);
		$this->db->where('receiver_id', $this->session->userdata('user_id'));
		$this->db->update('chat');

		if ($this->session->userdata('acct_type') != 'admin_super') {
			$data['chat_data'] = $this->db->where('receiver_id', $this->session->userdata('user_id'))->where('sender_id', $id)->where('region', $this->session->userdata('region'))->where('seen', 'no')->group_by('receiver_id')->get('chat')->result_array();
		} else {
			$data['chat_data'] = $this->db->where('receiver_id', $this->session->userdata('user_id'))->where('sender_id', $id)->where('seen', 'no')->group_by('receiver_id')->get('chat')->result_array();
		}
		//print_r($chat_data);
		$view_array = $this->load->view('chat/notification_ajax', $data, TRUE);
		echo $view_array;
		json_encode($view_array);
	}

	public function send_text_message()
	{
		$post = $this->input->post();
		//print_r($post);exit;
		$messageTxt = 'NULL';
		$attachment_name = '';
		$file_ext = '';
		$mime_type = '';

		if (isset($post['type']) == 'Attachment') {
			$AttachmentData = $this->ChatAttachmentUpload();
			//print_r($AttachmentData);
			$attachment_name = $AttachmentData['file_name'];
			$file_ext = $AttachmentData['file_ext'];
			$mime_type = $AttachmentData['file_type'];
		} else {
			$messageTxt = reduce_multiples($post['messageTxt'], ' ');
		}

		$data = [
			'sender_id' => $this->session->userdata['user_id'],
			'receiver_id' => $post['receiver_id'],
			'message' =>   $messageTxt,
			'attachment_name' => $attachment_name,
			'file_ext' => $file_ext,
			'mime_type' => $mime_type,
			'message_date_time' => date('Y-m-d H:i:s'), //23 Jan 2:05 pm
			'ip_address' => $this->input->ip_address(),
			'region' => $this->session->userdata('region')
		];

		$query = $this->db->insert('chat', $data);
		$response = '';
		if ($query == true) {
			$response = ['status' => 1, 'message' => ''];
		} else {
			$response = ['status' => 0, 'message' => 'sorry we re having some technical problems. please try again !'];
		}

		echo json_encode($response);
	}
	public function ChatAttachmentUpload()
	{


		$file_data = '';
		if (isset($_FILES['attachmentfile']['name']) && !empty($_FILES['attachmentfile']['name'])) {
			$config['upload_path']          = './uploads/attachments';
			$config['allowed_types']        = 'jpeg|jpg|png|txt|pdf|docx|xlsx|pptx|rtf';
			//$config['max_size']             = 500;
			//$config['max_width']            = 1024;
			//$config['max_height']           = 768;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('attachmentfile')) {
				echo json_encode([
					'status' => 0,
					'message' => '<span style="color:#900;">' . $this->upload->display_errors() . '<span>'
				]);
				die;
			} else {
				$file_data = $this->upload->data();
				//$filePath = $file_data['file_name'];
				return $file_data;
			}
		}
	}
	public function update_activity()
	{
		$name = $this->session->userdata('username');

		$this->db->select('activity_log.*,activity_log_seen.*');
		$this->db->from('activity_log');
		$this->db->JOIN('activity_log_seen', 'activity_log.id = activity_log_seen.activity_id');
		$this->db->where('activity_log.activity_by !=', $name);
		$this->db->where('activity_log_seen.user_id', $this->session->userdata('user_id'));
		$this->db->where('activity_log_seen.seen', 'no');
		if ($this->session->userdata('acct_type') != 'admin_super') {
			$this->db->where('activity_log.region', $this->session->userdata('region'));
		}
		$this->db->group_by('activity_id');
		$data['notification_data'] = $this->db->get()->result_array();

		// print_r($data['notification_data']); exit;
		$view_array = $this->load->view('notification_ajax1', $data, TRUE);
		echo $view_array;
		json_encode($view_array);
	}

	public function check_activity()
	{
		if ($this->session->userdata('acct_type') != 'admin_super') {
			$data['notification_data'] = $this->db->where('user_id', $this->session->userdata('user_id'))->where('region', $this->session->userdata('region'))->where('seen', 'no')->get('activity_log_seen')->result_array();
		} else {
			$data['notification_data'] = $this->db->where('user_id', $this->session->userdata('user_id'))->where('seen', 'no')->get('activity_log_seen')->result_array();
		}
		echo count($data['notification_data']);
	}

	public function activity_seen()
	{
		if ($this->session->userdata('acct_type') != 'admin_super') {
			$notification = $this->db->where('user_id', $this->session->userdata('user_id'))->where('region', $this->session->userdata('region'))->where('seen', 'no')->get('activity_log_seen')->result_array();
		} else {
			$notification = $this->db->where('user_id', $this->session->userdata('user_id'))->where('seen', 'no')->get('activity_log_seen')->result_array();
		}

		//print_r($notification);exit;
		for ($i = 0; $i < count($notification); $i++) {
			$this->db->set('seen', 'yes');
			$this->db->where('user_id', $this->session->userdata('user_id'));
			$this->db->where('activity_id', $notification[$i]['activity_id']);
			$this->db->update('activity_log_seen');
		}

		if ($this->session->userdata('acct_type') != 'admin_super') {
			$data['notification_data'] = $this->db->where('user_id', $this->session->userdata('user_id'))->where('region', $this->session->userdata('region'))->where('seen', 'no')->get('activity_log_seen')->result_array();
		} else {
			$data['notification_data'] = $this->db->where('user_id', $this->session->userdata('user_id'))->where('seen', 'no')->get('activity_log_seen')->result_array();
		}
		$view_array = $this->load->view('notification_ajax1', $data, TRUE);
		echo $view_array;
		json_encode($view_array);
	}


	public function check_notification()
	{
		$id = $_POST['id'];
		if ($this->session->userdata('acct_type') != 'admin_super') {
			$data['chat_data'] = $this->db->where('receiver_id', $id)->where('region', $this->session->userdata('region'))->where('seen', 'no')->group_by('receiver_id')->get('chat')->result_array();
		} else {
			$data['chat_data'] = $this->db->where('receiver_id', $id)->where('seen', 'no')->group_by('receiver_id')->get('chat')->result_array();
		}
		// $view_array = $this->load->view('chat/notification_ajax', $data, TRUE);
		echo count($data['chat_data']);
		// json_encode($view_array);
	}


	public function update_notification()
	{
		$id = $_POST['id'];
		// echo $id;exit;
		if ($this->session->userdata('acct_type') != 'admin_super') {
			$data['chat_data'] = $this->db->where('receiver_id', $id)->where('region', $this->session->userdata('region'))->where('seen', 'no')->group_by('receiver_id')->get('chat')->result_array();
		} else {
			$data['chat_data'] = $this->db->where('receiver_id', $id)->where('seen', 'no')->group_by('receiver_id')->get('chat')->result_array();
		}
		//print_r($chat_data);
		$view_array = $this->load->view('chat/notification_ajax', $data, TRUE);
		echo $view_array;
		json_encode($view_array);
	}

	public function get_chat_history_by_vendor()
	{
		// echo '1213';exit;
		$receiver_id =  $this->input->get('receiver_id');
		$Logged_sender_id = $this->session->userdata['user_id'];
		$sender_id = $this->session->userdata['user_id'];

		//SELECT * FROM `chat` WHERE `sender_id`= 197 AND `receiver_id` = 184 OR `sender_id`= 184 AND `receiver_id` = 197
		$condition = "`sender_id`= '$sender_id' AND `receiver_id` = '$receiver_id' OR `sender_id`= '$receiver_id' AND `receiver_id` = '$sender_id'";

		$this->db->select('*');
		$this->db->from('chat');
		$this->db->where($condition);
		if ($this->session->userdata('acct_type') != 'admin_super') {
			$this->db->where('region', $this->session->userdata('region'));
		}
		$history = $this->db->get()->result_array();


		//$history = $this->ChatModel->GetReciverChatHistory($receiver_id);
		//print_r($history);exit;
		foreach ($history as $chat) :

			$message_id = $chat['id'];
			$sender_id = $chat['sender_id'];

			$this->db->select('id,username');
			$this->db->from('security_info');
			$this->db->where("id", $chat['sender_id']);
			if ($this->session->userdata('acct_type') != 'admin_super') {
				$this->db->where('region', $this->session->userdata('region'));
			}
			$this->db->limit(1);
			$query = $this->db->get();
			$userName  = $query->row_array();
			//$userPic = $this->UserModel->PictureUrlById($chat['sender_id']);
			$message = $chat['message'];
			$messagedatetime = date('d M H:i A', strtotime($chat['message_date_time']));

			$messageBody = '';
			if ($message == 'NULL') { //fetach media objects like images,pdf,documents etc
				$classBtn = 'right';
				if ($Logged_sender_id == $sender_id) {
					$classBtn = 'left';
				}

				$attachment_name = $chat['attachment_name'];
				$file_ext = $chat['file_ext'];
				$mime_type = explode('/', $chat['mime_type']);

				$document_url = base_url('uploads/attachments/' . $attachment_name);

				if ($mime_type[0] == 'image') {
					$messageBody .= '<img src="' . $document_url . '" onClick="ViewAttachmentImage(' . "'" . $document_url . "'" . ',' . "'" . $attachment_name . "'" . ');" class="attachmentImgCls">';
				} else {
					$messageBody = '';
					$messageBody .= '<div class="attachment">';
					$messageBody .= '<h4>Attachments:</h4>';
					$messageBody .= '<p class="filename">';
					$messageBody .= $attachment_name;
					$messageBody .= '</p>';

					$messageBody .= '<div class="pull-' . $classBtn . '">';
					$messageBody .= '<a download href="' . $document_url . '"><button style="margin-top:2px" type="button" id="' . $message_id . '" class="btn btn-primary btn-sm btn-flat btnFileOpen">Open</button></a>';
					$messageBody .= '</div>';
					$messageBody .= '</div>';
				}
			} else {
				$messageBody = $message;
			}
?>



			<?php if ($Logged_sender_id != $sender_id) { ?>
				<!-- Message. Default to the left -->
				<div class="direct-chat-msg">
					<div class="direct-chat-info clearfix">
						<span class="direct-chat-name pull-left"><?= $userName['username']; ?></span>
						<span class="direct-chat-timestamp pull-right"><?= $messagedatetime; ?></span>
					</div>
					<!-- /.direct-chat-info -->
					<img class="direct-chat-img" src="<?= base_url(); ?>assets/img/user1.png" alt="<?= $userName['username']; ?>">
					<!-- /.direct-chat-img -->
					<div class="direct-chat-text">
						<?= $messageBody; ?>
					</div>
					<!-- /.direct-chat-text -->

				</div>
				<!-- /.direct-chat-msg -->
			<?php } else { ?>
				<!-- Message to the right -->
				<div class="direct-chat-msg right">
					<div class="direct-chat-info clearfix">
						<span class="direct-chat-name pull-right"><?= $userName['username']; ?></span>
						<span class="direct-chat-timestamp pull-left"><?= $messagedatetime; ?></span>
					</div>
					<!-- /.direct-chat-info -->
					<img class="direct-chat-img" src="<?= base_url(); ?>assets/img/user1.png" alt="<?= $userName['username']; ?>">
					<!-- /.direct-chat-img -->
					<div class="direct-chat-text">
						<?= $messageBody; ?>
						<!--<div class="spiner">
                             	<i class="fa fa-circle-o-notch fa-spin"></i>
                            </div>-->
					</div>
					<!-- /.direct-chat-text -->
				</div>
				<!-- /.direct-chat-msg -->
			<?php } ?>

<?php
		endforeach;
	}
	public function chat_clear_client_cs()
	{
		$receiver_id = $this->input->get('receiver_id');
		$messagelist = $this->ChatModel->GetReciverMessageList($receiver_id);

		foreach ($messagelist as $row) {
			if ($row['message'] == 'NULL') {
				$attachment_name = unlink('uploads/attachment/' . $row['attachment_name']);
			}
		}

		$this->ChatModel->TrashById($receiver_id);
	}

	public function ClientsListCs()
	{
		$this->db->select('*');
		$this->db->from('security_info');
		$this->db->where("status", "online");
		if ($this->session->userdata('acct_type') != 'admin_super') {
			$this->db->where('region', $this->session->userdata('region'));
		}
		$this->db->where_not_in('id', $this->session->userdata('user_id'));
		$query = $this->db->get();
		$r = $query->result_array();
		return $r;
	}

	public function ClientsList()
	{
		$this->db->select('*');
		$this->db->from('security_info');
		$this->db->where_not_in('id', $this->session->userdata('user_id'));

		if ($this->session->userdata('acct_type') != 'admin_super') {
			$this->db->where('region', $this->session->userdata('region'));
			$this->db->or_where('region', 'both'); //added by awais dated: 11 Dec 2021
		}
		
		$query = $this->db->get();
		$r = $query->result_array();
		return $r;
	}
}
