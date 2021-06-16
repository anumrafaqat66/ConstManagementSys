<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Project_Officer extends CI_Controller
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

            if ($acct_type == "PO" || $acct_type == "admin") {
                $this->load->view('project_officer/dashboard');
            } else {
                $this->load->view('login');
            }
        } else {
            $this->load->view('login');
        }
    }

    public function add_contractors()
    {
        if ($this->session->has_userdata('user_id')) {
            $data['contractor_records'] = $this->db->get('contractors')->result_array();
            $this->load->view('project_officer/contractor', $data);
        }
    }
    public function add_projects($project_name = null)
    {
        if ($this->session->has_userdata('user_id')) {
            $data['project_records'] = $this->db->get('projects')->result_array();
            $data['contractor_name'] = $this->db->get('contractors')->result_array();
            $this->load->view('project_officer/projects', $data);
        }
    }

    public function view_projects()
    {

        if ($this->session->has_userdata('user_id')) {
            $data['project_records'] = $this->db->get('projects')->result_array();
            $this->load->view('so_store/projects', $data);
        }
    }

    public function view_inventory_detail($id = NULL)
    {

        if ($this->session->has_userdata('user_id')) {

            $this->db->select('id.id, i.Material_Name, id.Quantity, id.Price,i.Unit, id.stock_date, id.Status');
            $this->db->from('inventory i');
            $this->db->join('inventory_detail id', 'i.ID = id.Material_ID');
            $this->db->where('Material_id', $id);

            $data['inventory_detail_records'] = $this->db->get()->result_array();
            $this->load->view('so_store/inventory_detail', $data);
        }
    }

    public function view_material_detail($id = NULL)
    {

        if ($this->session->has_userdata('user_id')) {

            $this->db->select('inventory_used.*,projects.*,inventory.Material_Name, inventory_used.status as inv_used_status');
            $this->db->from('inventory_used');
            $this->db->join('projects', 'projects.ID = inventory_used.Material_used_by_Project');
            $this->db->join('inventory', 'inventory.ID = inventory_used.Material_id');
            $this->db->where('Material_used_by_Project', $id);
            $data['material_detail_records'] = $this->db->get()->result_array();
            // print_r( $data['material_detail_records'] );
            $this->load->view('so_store/material_used_detail', $data);
        }
    }


    public function insert_contractor()
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $contractor_name = $postData['contractor_name'];
            $contact = $postData['contact'];
            $email = $postData['email'];
            $reg_date = $postData['reg_date'];
            $desc = $postData['desc'];

            $insert_array = array(
                'Name' => $contractor_name,
                'Contact_no' => $contact,
                'Email_id' => $email,
                'start_date' => $reg_date,
                'description' => $desc
            );

            $insert = $this->db->insert('contractors', $insert_array);
            //$last_id = $this->db->insert_id();

            if (!empty($insert)) {
                $this->session->set_flashdata('success', 'Data Submitted successfully');
                redirect('Project_Officer/add_contractors');
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('Project_Officer');
        }
    }

    public function add_bids_values()
    {
        $id = $_POST['id'];
       // echo $id;
         $this->db->select('project_bids.*,contractors.Name');
            $this->db->from('project_bids');
            $this->db->join('contractors', 'contractors.ID = project_bids.contractor_id');
            $this->db->where('project_bids.project_id', $id);
        $bids = $this->db->get()->result_array();
       // print_r($bids);exit;
        echo json_encode($bids);
    }
    public function edit_project()
    {
        $id =  $_POST['project_id_edit'];
        $start_date = $_POST['project_start_date_edit'];
        $end_date = $_POST['project_end_date_edit'];
        $cost = $_POST['total_cost_edit'];
        $status = $_POST['status_edit'];
        $contractor_id = $_POST['contractor_edit'];
        $bid_id = $_POST['project_bid_edit'];

        $cond  = ['ID' => $id];
        $data_update = [
            'Start_date' => $start_date,
            'End_date' => $end_date,
            'Total_Cost' => $cost,
            'Contractor_id' => $contractor_id,
            'bid_id' => $bid_id,
            'Status' => $status,
        ];

        $this->db->where($cond);
        $this->db->update('projects', $data_update);

        if (!empty($id)) {
            $this->session->set_flashdata('success', 'Record Updated successfully');
            redirect('Project_Officer/add_projects');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, try again.');
        }
    }
    public function insert_project()
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $name = $postData['project_name'];
            $code = $postData['code'];
            $start_date = $postData['start_date'];
            $end_date = $postData['end_date'];
            $assigned_bid= $postData['assign_bid'];
            $total_cost = $postData['total_cost'];

            $data=$this->db->where('id',$assigned_bid)->get('project_bids')->row_array();
            $contractor=$this->db->where('ID',$data['contractor_id'])->get('contractors')->row_array();
            //echo $contractor['ID'];exit;

            $created_by = $postData['created_by'];
            $status = $postData['status'];

            $project= $this->db->where('Name',$name)->get('projects')->row_array();

            $cond  = ['ID' => $project['ID']];
            $update_array = array(
                'Name' => $name,
                'Code' => $code,
                'Start_date' => $start_date,
                'End_date' => $end_date,
                'Total_Cost' => $total_cost,
                 'Created_by' => $created_by,
                'contractor_id' => $contractor['ID'],
                'bid_id'=>$assigned_bid,
                'status' => $status
            );
            $this->db->where($cond);
            $insert = $this->db->update('projects', $update_array);
            //$last_id = $this->db->insert_id();

            if (!empty($insert)) {
                $this->session->set_flashdata('success', 'Data Submitted successfully');
                redirect('Project_Officer/add_projects');
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
                redirect('Project_Officer/add_projects');
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('Project_Officer/add_projects');
        }
    }

    public function insert_project_initial()
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $name = $postData['project_name'];
            $code = $postData['project_code'];

            $insert_array = array(
                'Name' => $name,
                'Code' => $code
            );
            //print_r($insert_array);
            $insert = $this->db->insert('projects', $insert_array);
            $last_id = $this->db->insert_id();

            echo $last_id;
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('Project_Officer/add_projects');
        }
    }
    public function insert_project_bids()
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            // $project_name = $postData['Name_of_Project'];
            $project_id = $postData['id'];
            $contractor = $postData['contractor'];
            $bid_amount = $postData['bid_amount'];

            // $project = $this->db->where('Name', $project_name)->get('projects')->row_array();

            for ($i = 0; $i < count($contractor); $i++) {
                $insert_array = array(
                    'project_id' => $project_id,
                    'contractor_id' => $contractor[$i],
                    'bid_amount' => $bid_amount[$i]
                );
                $insert = $this->db->insert('project_bids', $insert_array);
            }
            // redirect('Project_Officer/add_projects/');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('Project_Officer/add_projects');
        }
    }

    public function get_total_projects_assigned()
    {
        if ($this->session->has_userdata('user_id')) {
            $getQty = $this->db->select('count(*) as count, contractor_id')->group_by('contractor_id')->get('projects')->result_array();
            echo json_encode($getQty);
        }
    }

    public function get_total_projects_completed()
    {
        if ($this->session->has_userdata('user_id')) {
            $getQty = $this->db->select('count(*) as count, contractor_id')->where('Status', 'Completed')->group_by('contractor_id')->get('projects')->result_array();
            echo json_encode($getQty);
        }
    }

    public function get_list_of_projects()
    {
        $cont_id = $_POST['contractor_id'];
        if ($this->session->has_userdata('user_id')) {
            $projectsList = $this->db->where('contractor_id', $cont_id)->get('projects')->result_array();
            echo json_encode($projectsList);
        }
    }
}
