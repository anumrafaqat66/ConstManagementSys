<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class SO_CW extends CI_Controller
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

            if ($acct_type == "SO_CW" || $acct_type == "admin") {
                $this->view_projects();
            } else {
                $this->load->view('login');
            }
        } else {
            $this->load->view('login');
        }
    }

    public function view_project_schedule($project_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            $data['project_schedule'] = $this->db->where('project_id', $project_id)->get('project_schedule')->result_array();
            $data['project_id'] = $project_id;
            $this->load->view('so_cw/project_schedule', $data);
        }
    }

    public function view_project_progress($project_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            $data['project_progress'] = $this->db->where('project_id', $project_id)->get('project_progress')->result_array();
            $this->load->view('so_cw/project_progress', $data);
        }
    }

    public function view_projects($project_name = null)
    {
        if ($this->session->has_userdata('user_id')) {
            $data['project_records'] = $this->db->get('projects')->result_array();
            $data['contractor_name'] = $this->db->get('contractors')->result_array();
            $this->db->select('pb.*,c.*');
            $this->db->from('project_bids pb');
            $this->db->join('contractors c', 'c.ID = pb.contractor_id');
            $data['bids'] = $this->db->get()->result_array();
            $this->load->view('so_cw/dashboard', $data);
        }
    }

    public function insert_schedule($project_id = NULL)
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $schedule_date = $postData['schedule_date'];
            $schedule_name = $postData['schedule_name'];
            $start_date = $postData['start_date'];
            $end_date = $postData['end_date'];
            $desc = $postData['desc'];

            $insert_array = array(
                'project_id' => $project_id,
                'schedule_date' => $schedule_date,
                'schedule_name' => $schedule_name,
                'schedule_description' => $desc,
                'schedule_start_date' => $start_date,
                'schedule_end_date' => $end_date,
                'Status' => 'Created'
            );

            $insert = $this->db->insert('project_schedule', $insert_array);
            
            if (!empty($insert)) {
                $this->session->set_flashdata('success', 'Project Schedule Created successfully');
                redirect('SO_CW/view_project_schedule/'.$project_id);
                
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('Project_Officer');
        }
    }
}
