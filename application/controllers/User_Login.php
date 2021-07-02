<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class User_Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->session->has_userdata('user_id')) {
			$id = $this->session->userdata('user_id');
			$acct_type = $this->session->userdata('acct_type');
			
			if ($acct_type == "SO_STORE") {
				redirect('SO_STORE');
			} elseif ($acct_type == "PO") {
				redirect('Project_Officer');
			} elseif ($acct_type == "SO_CW") {
				redirect('SO_CW');
			} elseif ($acct_type == "SO_RECORD") {
				redirect('SO_RECORD');
			}
			elseif($acct_type == "admin"){
				redirect('Admin');
			} else {
				$this->load->view('login');
			}
		} else {
			$this->load->view('login');
		}
	}

	public function dashboard()
	{
		$this->load->view('dashboard');
	}

	public function login_process()
	{
		if ($this->input->post()) {
			$postedData = $this->security->xss_clean($this->input->post());
			//To create encrypted password use
			$username = $postedData['username'];
			$password = $postedData['password'];
			$status = $postedData['optradio'];
			$query = $this->db->where('username', $username)->where('acct_type', $status)->get('security_info')->row_array();
			$hash = $query['password'];

			if (!empty($query)) {
				if (password_verify($password, $hash)) {
					$this->session->set_userdata('user_id', $query['id']);
					$this->session->set_userdata('acct_type', $query['acct_type']);
					$this->session->set_userdata('username', $query['username']);
					$this->session->set_flashdata('success', 'Login successfully');

					$this->db->set('status', 'online');
					$this->db->where('id', $query['id']);
					$this->db->update('security_info');

					redirect('User_Login');
				} else {
					$this->session->set_flashdata('failure', 'No such user exist. Kindly create New User using Admin panel');
					redirect('User_Login');
				}
				//print_r($query); exit; 
			} else {
				$this->session->set_flashdata('failure', 'Login failed');
				redirect('User_Login');
			}
		}
	}

	public function edit_profile(){
		$data['userdata']=$this->db->where('id',$this->session->userdata('user_id'))->get('security_info')->row_array();
		$this->load->view('edit_profile',$data);
	}
	public function edit_profile_process(){
        $username =  $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $acct_type = $_POST['status'];
        $id=$this->session->userdata('user_id');

        $cond  = ['ID' => $id];
        $data_update = [
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'acct_type'=>$acct_type
        ];

        $this->db->where($cond);
       $update= $this->db->update('security_info', $data_update);

if($update){
         $this->session->set_flashdata('success', 'Profile Updated successfully');
            redirect('User_Login/edit_profile');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            redirect('User_Login/edit_profile');
        }
	}

	public function change_password(){
		$this->load->view('change_password');
	}
	public function change_password_process(){
		 if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $new_password = password_hash($postData['new_password'], PASSWORD_DEFAULT);
           // $confirm_password = password_hash($postData['confirm_password'], PASSWORD_DEFAULT);
            $id=$this->session->userdata('user_id');

 			$cond  = ['ID' => $id];
            $insert_array = array(
                //'username' => $username,
                'password' => $new_password,
       
            );
            
             $this->db->where($cond);
            $update= $this->db->update('security_info', $insert_array);
            
            if (!empty($update)) {
                $this->session->set_flashdata('success', 'password Changed successfully');
                redirect('User_Login/change_password');
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
                 redirect('User_Login/change_password');
            }
	}
}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->db->set('status', 'offline');
		$this->db->where('id', $this->session->userdata('user_id'));
		$this->db->update('security_info');
		redirect('User_Login');
	}
}
