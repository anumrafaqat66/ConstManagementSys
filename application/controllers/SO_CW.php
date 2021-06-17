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
            $this->load->view('so_cw/project_schedule',$data);
        }
    }

    public function view_project_progress($project_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            $data['project_progress'] = $this->db->where('project_id', $project_id)->get('project_progress')->result_array();
            $this->load->view('so_cw/project_progress',$data);
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
}
