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
		
			$data['strTitle'] = '';
		$data['strsubTitle'] = '';
		$data['list'] = $this->ClientsListCs();
		$data['strTitle'] = 'All Connected Clients';
		$data['strsubTitle'] = 'Clients';
		$data['chatTitle'] = 'Select Client with Chat';
		$data['list_count']=count($data['list']);
		$data['whole_list']= $this->ClientsList();

         //Fupdateprint_r($data['whole_list']);exit;
		$this->load->view('chat/chat_template', $data);
}

		
public function seen(){
       $id =$_POST['id'];
       // echo $id;exit;
        $this->db->set('seen','yes');
        $this->db->where('sender_id',$id);
        $this->db->where('receiver_id',$this->session->userdata('user_id'));
        $this->db->update('chat');

        $data['chat_data']= $this->db->where('receiver_id',$this->session->userdata('user_id'))->where('sender_id',$id)->where('seen','no')->group_by('receiver_id')->get('chat')->result_array();
        //print_r($chat_data);
        $view_array=$this->load->view('chat/notification_ajax',$data,TRUE);
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
			$config['upload_path']          = './uploads/attachment';
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

	public function get_chat_history_by_vendor()
	{
		//echo '1213';exit;
		$receiver_id =  $this->input->get('receiver_id');

		$Logged_sender_id = $this->session->userdata['user_id'];

		$sender_id = $this->session->userdata['user_id'];

		//SELECT * FROM `chat` WHERE `sender_id`= 197 AND `receiver_id` = 184 OR `sender_id`= 184 AND `receiver_id` = 197
		$condition = "`sender_id`= '$sender_id' AND `receiver_id` = '$receiver_id' OR `sender_id`= '$receiver_id' AND `receiver_id` = '$sender_id'";

		$this->db->select('*');
		$this->db->from('chat');
		$this->db->where($condition);
		$history = $this->db->get()->result_array();


		//$history = $this->ChatModel->GetReciverChatHistory($receiver_id);
		//print_r($history);exit;
		foreach ($history as $chat) :

			$message_id = $chat['id'];
			$sender_id = $chat['sender_id'];

			$this->db->select('id,username');
			$this->db->from('security_info');
			$this->db->where("id", $chat['sender_id']);
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

				$document_url = base_url('uploads/attachment/' . $attachment_name);

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
					$messageBody .= '<a download href="' . $document_url . '"><button type="button" id="' . $message_id . '" class="btn btn-primary btn-sm btn-flat btnFileOpen">Open</button></a>';
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
		$this->db->where_not_in('username', 'admin');
		$query = $this->db->get();
		$r = $query->result_array();
		return $r;
	}

	
}
