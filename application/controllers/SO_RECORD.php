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
            $data['projects'] = $this->db->get('projects')->result_array();
            $this->load->view('so_record/allotment_letter_list', $data); //, $data);
        }
    }

    public function show_bills()
    {

        if ($this->session->has_userdata('user_id')) {
            // $data['project_records'] = $this->db->get('projects')->result_array();
            $this->load->view('so_record/billing_list'); //, $data);
        }
    }

    public function  upload_allotment_letter()
    {

        $postData = $this->security->xss_clean($this->input->post());

        $project_id = $postData['project_id'];
        $upload1 = $this->upload_letter($_FILES['project_allotment_letter']);

        if (count($upload1) >= 1) {

            for ($i = 0; $i < count($upload1); $i++) {
                $insert_array = array(

                    'project_id' => $project_id,
                    'file_name' => $upload1[$i],
                    'date_added' => date('Y-m-d')
                );

                $insert = $this->db->insert('project_allotment_letter', $insert_array);
            }
            // print_r($insert_array);exit;
        }

        if (!empty($insert)) {
            $this->session->set_flashdata('success', 'File uploaded successfully');
            redirect('SO_RECORD/show_letter_lists');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            redirect('SO_RECORD/show_letter_lists');
        }
    }
    public function upload_letter($fieldname)
    {
        //$data = NULL;
        //echo $fieldname;exit;
        $filesCount = count($_FILES['project_allotment_letter']['name']);
        //print_r($_FILES['reg_cert']['name']);exit;
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['file']['name']     = $_FILES['project_allotment_letter']['name'][$i];
            $_FILES['file']['type']     = $_FILES['project_allotment_letter']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['project_allotment_letter']['tmp_name'][$i];
            $_FILES['file']['error']     = $_FILES['project_allotment_letter']['error'][$i];
            $_FILES['file']['size']     = $_FILES['project_allotment_letter']['size'][$i];

            $config['upload_path'] = 'uploads/project_allotment_letter';
            $config['allowed_types']        = 'gif|jpg|png|doc|xls|pdf|xlsx|docx|ppt|pptx';


            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            //$data['upload_data'] = '';
            if (!$this->upload->do_upload('file')) {
                $data = array('msg' => $this->upload->display_errors());
                //echo "here";exit;
            } else {
                //echo $filesCount;exit;
                $data = array('msg' => "success");
                $data['upload_data'] = $this->upload->data();
                $count[$i] = $data['upload_data']['file_name'];
            }
        } //end of for
        //print_r($count);exit();
        return $count;
    }

    public function about()
    {
        if ($this->session->has_userdata('user_id')) {
            $this->load->view('so_record/about');
        }
    }
    public function services()
    {
        if ($this->session->has_userdata('user_id')) {
            $this->load->view('so_record/services');
        }
    }

    public function view_activity_log()
    {
        if ($this->session->has_userdata('user_id')) {
            $data['activity_log'] = $this->db->get('activity_log')->result_array();
            $this->load->view('so_record/activity_log', $data);
        }
    }
}
