<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class SO_RECORD extends CI_Controller
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

            if ($acct_type == "SO_RECORD" || $acct_type == "admin") {
                $this->load->view('so_record/dashboard');
            } else {
                $this->load->view('login');
            }
        } else {
            $this->load->view('login');
        }
    }

    public function show_letter_lists()
    {

        if ($this->session->has_userdata('user_id')) {
            // $data['inventory_records'] = $this->db->get('inventory')->result_array();
            $this->load->view('so_record/allotment_letter_list');//, $data);
        }
    }

    public function show_bills()
    {

        if ($this->session->has_userdata('user_id')) {
            // $data['project_records'] = $this->db->get('projects')->result_array();
            $this->load->view('so_record/billing_list');//, $data);
        }
    }

    }
