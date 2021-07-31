<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $this->session->userdata('user_id');

            $region = $this->session->userdata('region');

            if ($region == 'both') {
                $data['projects'] = $this->db->select('count(*) as total_project')->get('projects')->row_array();
                $data['contractors'] = $this->db->select('count(*) as total_contractors')->get('contractors')->row_array();
                $data['quantity'] = $this->db->select('sum(Material_Total_Quantity) as sum_qty')->get('inventory')->row_array();
                $data['price'] = $this->db->select('sum(Material_Total_Price) as sum_price')->get('inventory')->row_array();
                $data['allot_letter_count'] = $this->db->select('count(*) as allotment_letter_count')->get('project_allotment_letter')->row_array();
                $data['bill_count'] = $this->db->select('count(*) as bill_count')->get('project_bills')->row_array();
                $data['perform_letter_count'] = $this->db->select('count(*) as perform_letter_count')->get('project_performance_security_letter')->row_array();
                $data['projects_records'] = $this->db->get('projects')->result_array();
            } else {
                $data['projects'] = $this->db->select('count(*) as total_project')->where('region',$region)->get('projects')->row_array();
                $data['contractors'] = $this->db->select('count(*) as total_contractors')->where('region',$region)->get('contractors')->row_array();
                $data['quantity'] = $this->db->select('sum(Material_Total_Quantity) as sum_qty')->where('region',$region)->get('inventory')->row_array();
                $data['price'] = $this->db->select('sum(Material_Total_Price) as sum_price')->where('region',$region)->get('inventory')->row_array();
                $data['allot_letter_count'] = $this->db->select('count(*) as allotment_letter_count')->where('region',$region)->get('project_allotment_letter')->row_array();
                $data['bill_count'] = $this->db->select('count(*) as bill_count')->where('region',$region)->get('project_bills')->row_array();
                $data['perform_letter_count'] = $this->db->select('count(*) as perform_letter_count')->where('region',$region)->get('project_performance_security_letter')->row_array();
                $data['projects_records'] = $this->db->where('region',$region)->get('projects')->result_array();
            }
            $this->load->view('Admin/admin', $data);
        } else {
            $this->load->view('Admin/login');
        }
    }

    public function add_users()
    {
        $this->load->view('Admin/create_user');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Admin');
    }

    public function add_user()
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $username = $postData['username'];
            $password = password_hash($postData['password'], PASSWORD_DEFAULT);
            $status = $postData['status'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $region = $_POST['region'];
            $name = $_POST['name'];

            $insert_array = array(
                'username' => $username,
                'password' => $password,
                'acct_type' => $status,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'region' => $region,
                'full_name' => $name,

            );

            $insert = $this->db->insert('security_info', $insert_array);

            if (!empty($insert)) {
                $this->session->set_flashdata('success', 'Data Submitted successfully');
                redirect('Admin/add_users');
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
                redirect('Admin/add_users');
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('Admin/add_users');
        }
    }

    public function view_activity_log()
    {
        if ($this->session->has_userdata('user_id')) {
            $data['activity_log'] = $this->db->get('activity_log')->result_array();
            $this->load->view('Admin/activity_log', $data);
        }
    }
}
