<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


use Dompdf\Dompdf;
use Dompdf\Options;

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

            if ($acct_type == "PO" || $acct_type == "admin_super" || $acct_type == "admin_north" || $acct_type == "admin_south") {
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
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['contractor_records'] = $this->db->where('region', $this->session->userdata('region'))->get('contractors')->result_array();
            } else {
                $data['contractor_records'] = $this->db->get('contractors')->result_array();
            }
            $this->load->view('project_officer/contractor', $data);
        }
    }

    public function about()
    {
        if ($this->session->has_userdata('user_id')) {
            $this->load->view('project_officer/about');
        }
    }

    public function services()
    {
        if ($this->session->has_userdata('user_id')) {
            $this->load->view('project_officer/services');
        }
    }

    public function add_projects($project_name = null)
    {
        if ($this->session->has_userdata('user_id')) {

            if ($this->session->userdata('acct_type') == 'admin_super') {
                $data['project_records'] = $this->db->get('projects')->result_array();
            } else if ($this->session->userdata('acct_type') == 'admin_north' || $this->session->userdata('acct_type') == 'admin_south') {
                $data['project_records'] = $this->db->where('region', $this->session->userdata('region'))->get('projects')->result_array();
            } else {
                $data['project_records'] = $this->db->where('region', $this->session->userdata('region'))->where('Created_by', $this->session->userdata('username'))->get('projects')->result_array();
            }

            if ($this->session->userdata('acct_type') == 'admin_super') {
                $data['contractor_name'] = $this->db->get('contractors')->result_array();
            } else {
                $data['contractor_name'] = $this->db->where('region', $this->session->userdata('region'))->get('contractors')->result_array();
            }

            $this->db->select('pb.*,c.*');
            $this->db->from('project_bids pb');
            $this->db->join('contractors c', 'c.ID = pb.contractor_id');
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('pb.region', $this->session->userdata('region'));
            }
            $data['bids'] = $this->db->get()->result_array();
            $this->load->view('project_officer/projects', $data);
        }
    }

    public function view_projects()
    {

        if ($this->session->has_userdata('user_id')) {
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['project_records'] = $this->db->where('region', $this->session->userdata('region'))->get('projects')->result_array();
            } else {
                $data['project_records'] = $this->db->get('projects')->result_array();
            }
            $this->load->view('so_store/projects', $data);
        }
    }

    public function view_project_ganttchart($project_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            // $data['project_schedule'] = $this->db->where('project_id',$project_id)->get('project_schedule')->result_array();
            $this->db->select('pp.*,ps.*');
            $this->db->from('project_progress pp');
            $this->db->join('project_schedule ps', 'pp.task_id = ps.id');
            $this->db->where('pp.project_id = ps.project_id');
            $this->db->where('pp.project_id', $project_id);
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('pp.region', $this->session->userdata('region'));
            }
            $data['project_schedule'] = $this->db->get()->result_array();

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['project_records'] = $this->db->where('ID', $project_id)->where('region', $this->session->userdata('region'))->get('projects')->row_array();
            } else {
                $data['project_records'] = $this->db->where('ID', $project_id)->get('projects')->row_array();
            }
            $this->load->view('project_officer/project_ganttchart', $data);
        }
    }

    public function view_project_breakdown($project_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            // $data['project_schedule'] = $this->db->where('project_id',$project_id)->get('project_schedule')->result_array();
            $this->db->select('pp.*,ps.*');
            $this->db->from('project_progress pp');
            $this->db->join('project_schedule ps', 'pp.task_id = ps.id');
            $this->db->where('pp.project_id = ps.project_id');
            $this->db->where('pp.project_id', $project_id);
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('pp.region', $this->session->userdata('region'));
            }
            $data['project_schedule'] = $this->db->get()->result_array();

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['project_records'] = $this->db->where('ID', $project_id)->where('region', $this->session->userdata('region'))->get('projects')->row_array();
            } else {
                $data['project_records'] = $this->db->where('ID', $project_id)->get('projects')->row_array();
            }
            $this->load->view('project_officer/project_breakdown', $data);
        }
    }


    public function overview($project_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            $data['project_records'] = $this->db->where('ID', $project_id)->get('projects')->row_array();

            $this->db->select('pb.*,c.*');
            $this->db->from('project_bids pb');
            $this->db->join('contractors c', 'c.ID = pb.contractor_ID');
            $this->db->where('pb.project_id', $project_id);
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('pb.region', $this->session->userdata('region'));
            }
            $data['project_bids'] = $this->db->get()->result_array();

            $this->db->select('p.Name as project_name, c.Name as contractor_name,p.*,c.*');
            $this->db->from('projects p');
            $this->db->join('contractors c', 'p.contractor_id = c.ID');
            $this->db->where('p.ID', $project_id);
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('p.region', $this->session->userdata('region'));
            }
            $data['project_contractor'] = $this->db->get()->result_array();
            $data['id'] = $project_id;

            //print_r( $data['project_contractor']);exit;
            $this->load->view('project_officer/project_overview', $data);
        }
    }

    public function drawing($project_id = NULL)
    {

        if ($this->session->has_userdata('user_id')) {
            $data['project'] = $project_id;
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['drawing'] = $this->db->where('region', $this->session->userdata('region'))->where('project_id', $project_id)->get('project_drawing')->result_array();
            } else {
                $data['drawing'] = $this->db->where('project_id', $project_id)->get('project_drawing')->result_array();
            }
            $this->load->view('project_officer/project_drawing', $data);
        }
    }

    public function bids_evaluation($project_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            $data['project'] = $project_id;

            if ($this->session->userdata('acct_type') == 'admin_super') {
                $data['contractor_name'] = $this->db->get('contractors')->result_array();
            } else {
                $data['contractor_name'] = $this->db->where('region', $this->session->userdata('region'))->get('contractors')->result_array();

                $this->db->select('eval.*,c.*, eval.Status as eval_Status');
                $this->db->from('project_bids_evaluation eval');
                $this->db->join('contractors c', 'c.ID = eval.contractor_id');
                $this->db->where('eval.project_id', $project_id);
                if ($this->session->userdata('acct_type') != 'admin_super') {
                    $this->db->where('eval.region', $this->session->userdata('region'));
                }
                $data['project_bid_eval_data'] = $this->db->order_by("eval.id", "asc")->get()->result_array();

                $data['recommendation'] = $this->db->where('region', $this->session->userdata('region'))->where('project_id', $project_id)->select('recommendations')->distinct()->get('project_bids_evaluation')->row_array();
            }

            $this->load->view('project_officer/project_bid_eval', $data);
        }
    }

    public function upload_drawing()
    {
        $postData = $this->security->xss_clean($this->input->post());

        $project_id = $postData['project_id'];
        $desc = $postData['drawing_desc'];
        // echo $desc;
        $upload1 = $this->upload_reg($_FILES['project_drawing']);

        if (count($upload1) >= 1) {

            for ($i = 0; $i < count($upload1); $i++) {
                $insert_array = array(
                    'name' => $upload1[$i],
                    'project_id' => $project_id,
                    'description' => $desc,
                    'date_added' => date('Y-m-d'),
                    'region' => $this->session->userdata('region')
                );
                $insert = $this->db->insert('project_drawing', $insert_array);
            }
        }

        if (!empty($insert)) {
            $this->session->set_flashdata('success', 'Data Submitted successfully');
            redirect('Project_Officer/drawing/' . $project_id);
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            redirect('Project_Officer/drawing/' . $project_id);
        }
    }

    public function view_inventory_detail($id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            $this->db->select('id.id, i.Material_Name, id.Quantity, id.Price,i.Unit, id.stock_date, id.Status');
            $this->db->from('inventory i');
            $this->db->join('inventory_detail id', 'i.ID = id.Material_ID');
            $this->db->where('Material_id', $id);
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('i.region', $this->session->userdata('region'));
            }

            $data['inventory_detail_records'] = $this->db->get()->result_array();
            $this->load->view('so_store/inventory_detail', $data);
        }
    }

    public function view_activity_log()
    {
        if ($this->session->has_userdata('user_id')) {
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['activity_log'] = $this->db->where('region', $this->session->userdata('region'))->get('activity_log')->result_array();
            } else {
                $data['activity_log'] = $this->db->get('activity_log')->result_array();
            }

            $this->load->view('project_officer/activity_log', $data);
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
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('projects.region', $this->session->userdata('region'));
            }
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
                'description' => $desc,
                'region' => $this->session->userdata('region')
            );

            $insert = $this->db->insert('contractors', $insert_array);
            //$last_id = $this->db->insert_id();

            if (!empty($insert)) {

                $insert_activity = array(
                    'activity_module' => $this->session->userdata('acct_type'),
                    'activity_action' => 'add',
                    'activity_detail' => "Contractor named " . $contractor_name . "  has been added",
                    'activity_by' => $this->session->userdata('username'),
                    'activity_date' => date('Y-m-d H:i:s'),
                    'region' => $this->session->userdata('region')
                );

                $insert = $this->db->insert('activity_log', $insert_activity);
                $last_id = $this->db->insert_id();
                if ($this->session->userdata('acct_type') != 'admin_super') {
                    $query = $this->db->where('username !=', $this->session->userdata('username'))->where('region', $this->session->userdata('region'))->get('security_info')->result_array();
                } else {
                    $query = $this->db->where('username !=', $this->session->userdata('username'))->where('region', $this->session->userdata('region'))->get('security_info')->result_array();
                }

                for ($i = 0; $i < count($query); $i++) {
                    $insert_activity_seen = array(
                        'activity_id' => $last_id,
                        'user_id' => $query[$i]['id'],
                        'seen' => 'no',
                        'region' => $this->session->userdata('region')
                    );
                    $insert = $this->db->insert('activity_log_seen', $insert_activity_seen);
                }

                $query_both = $this->db->where('username !=', $this->session->userdata('username'))->where('region', 'both')->get('security_info')->result_array();

                for ($i = 0; $i < count($query_both); $i++) {
                    $insert_activity_seen_both = array(
                        'activity_id' => $last_id,
                        'user_id' => $query_both[$i]['id'],
                        'seen' => 'no',
                        'region' => 'both'
                    );
                    $insert = $this->db->insert('activity_log_seen', $insert_activity_seen_both);
                }

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

    public function delete_project_id()
    {
        $id = $_POST['id'];
        $this->db->where('ID', $id);
        $this->db->where('region', $this->session->userdata('region'));
        $this->db->delete('projects');

        $this->db->where('project_id', $id);
        $this->db->delete('project_bids');
    }
    public function delete_project_code()
    {
        $project_code = $_POST['code'];
        $this->db->where('Code', $project_code);
        $this->db->where('region', $this->session->userdata('region'));
        $this->db->delete('projects');
    }
    public function delete_project_by_name()
    {
        $project_name = $_POST['name'];
        $this->db->where('Name', $project_name);
        $this->db->where('region', $this->session->userdata('region'));
        $this->db->delete('projects');
    }

    public function add_bids_values()
    {
        $id = $_POST['id'];
        // echo $id;
        $this->db->select('project_bids.*,contractors.Name');
        $this->db->from('project_bids');
        $this->db->join('contractors', 'contractors.ID = project_bids.contractor_id');
        $this->db->where('project_bids.project_id', $id);
        if ($this->session->userdata('acct_type') != 'admin_super') {
            $this->db->where('project_bids.region', $this->session->userdata('region'));
        }
        $bids = $this->db->get()->result_array();

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

        $cond  = [
            'ID' => $id,
            'region' => $this->session->userdata('region')
        ];
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

        $created_by = $_POST['created_by'];
        $name = $_POST['project_name'];

        if (!empty($id)) {

            $insert_activity = array(
                'activity_module' => $this->session->userdata('acct_type'),
                'activity_action' => 'update',
                'activity_detail' => "'" . $created_by . "' has made updated a project named: " . $name,
                'activity_by' => $created_by,
                'activity_date' => date('Y-m-d H:i:s'),
                'region' => $this->session->userdata('region')
            );

            $insert = $this->db->insert('activity_log', $insert_activity);
            $last_id = $this->db->insert_id();
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $query = $this->db->where('username !=', $this->session->userdata('username'))->where('region', $this->session->userdata('region'))->get('security_info')->result_array();
            } else {
                $query = $this->db->where('username !=', $this->session->userdata('username'))->get('security_info')->result_array();
            }

            for ($i = 0; $i < count($query); $i++) {
                $insert_activity_seen = array(
                    'activity_id' => $last_id,
                    'user_id' => $query[$i]['id'],
                    'seen' => 'no',
                    'region' => $this->session->userdata('region')
                );
                $insert = $this->db->insert('activity_log_seen', $insert_activity_seen);
            }

            $query_both = $this->db->where('username !=', $this->session->userdata('username'))->where('region', 'both')->get('security_info')->result_array();

            for ($i = 0; $i < count($query_both); $i++) {
                $insert_activity_seen_both = array(
                    'activity_id' => $last_id,
                    'user_id' => $query_both[$i]['id'],
                    'seen' => 'no',
                    'region' => 'both'
                );
                $insert = $this->db->insert('activity_log_seen', $insert_activity_seen_both);
            }

            $this->session->set_flashdata('success', 'Record Updated successfully');
            redirect('Project_Officer/add_projects');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, try again.');
        }
    }

    public function edit_contractor()
    {
        $id =  $_POST['id_edit'];
        $contact_edit = $_POST['contact_edit'];
        $email_edit = $_POST['email_edit'];
        $reg_date_edit = $_POST['reg_date_edit'];
        $contractor_name = $_POST['contractor_name_edit'];

        $cond  = [
            'ID' => $id,
            'region' => $this->session->userdata('region')
        ];
        $data_update = [
            'Contact_no' => $contact_edit,
            'Email_id' => $email_edit,
            'Start_date' => $reg_date_edit,
        ];

        $this->db->where($cond);
        $this->db->update('contractors', $data_update);

        if (!empty($id)) {
            $insert_activity = array(
                'activity_module' => $this->session->userdata('acct_type'),
                'activity_action' => 'update',
                'activity_detail' => "Contractor named " . $contractor_name . " has been updated",
                'activity_by' => $this->session->userdata('username'),
                'activity_date' => date('Y-m-d H:i:s'),
                'region' => $this->session->userdata('region')
            );

            $insert = $this->db->insert('activity_log', $insert_activity);
            $last_id = $this->db->insert_id();
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $query = $this->db->where('username !=', $this->session->userdata('username'))->where('region', $this->session->userdata('region'))->get('security_info')->result_array();
            } else {
                $query = $this->db->where('username !=', $this->session->userdata('username'))->get('security_info')->result_array();
            }

            for ($i = 0; $i < count($query); $i++) {
                $insert_activity_seen = array(
                    'activity_id' => $last_id,
                    'user_id' => $query[$i]['id'],
                    'seen' => 'no',
                    'region' => $this->session->userdata('region')
                );
                $insert = $this->db->insert('activity_log_seen', $insert_activity_seen);
            }

            $query_both = $this->db->where('username !=', $this->session->userdata('username'))->where('region', 'both')->get('security_info')->result_array();

            for ($i = 0; $i < count($query_both); $i++) {
                $insert_activity_seen_both = array(
                    'activity_id' => $last_id,
                    'user_id' => $query_both[$i]['id'],
                    'seen' => 'no',
                    'region' => 'both'
                );
                $insert = $this->db->insert('activity_log_seen', $insert_activity_seen_both);
            }

            $this->session->set_flashdata('success', 'Record Updated successfully');
            redirect('Project_Officer/add_contractors');
        } else {
            $this->session->set_flashdata('failure', 'Something went delete, try again.');
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
            $assigned_bid = $postData['assign_bid'];
            $total_cost = $postData['total_cost'];

            if ($assigned_bid == '') {
                $assigned_bid = 0;
            }

            if ($assigned_bid != '') {
                $data = $this->db->where('id', $assigned_bid)->where('region', $this->session->userdata('region'))->get('project_bids')->row_array();
                $contractor = $this->db->where('region', $this->session->userdata('region'))->where('ID', $data['contractor_id'])->get('contractors')->row_array();
            } else {
                $contractor['ID'] = 0;
            }

            $created_by = $postData['created_by'];
            $status = $postData['status'];

            $project = $this->db->where('Name', $name)->where('region', $this->session->userdata('region'))->get('projects')->row_array();

            $cond  = [
                'ID' => $project['ID'],
                'region' => $this->session->userdata('region')
            ];

            $update_array = array(
                'Name' => $name,
                'Code' => $code,
                'Start_date' => $start_date,
                'End_date' => $end_date,
                'Total_Cost' => $total_cost,
                'Created_by' => $created_by,
                'contractor_id' => $contractor['ID'],
                'bid_id' => $assigned_bid,
                'status' => $status
            );
            // print_r($update_array); exit;
            $this->db->where($cond);
            $insert = $this->db->update('projects', $update_array);
            //$last_id = $this->db->insert_id();

            if (!empty($insert)) {

                //Add to activity log
                $insert_activity = array(
                    'activity_module' => $this->session->userdata('acct_type'),
                    'activity_action' => 'add',
                    'activity_detail' => $created_by . " has added a project named " . $name,
                    'activity_by' => $created_by,
                    'activity_date' => date('Y-m-d H:i:s'),
                    'region' => $this->session->userdata('region')
                );

                $insert = $this->db->insert('activity_log', $insert_activity);
                $last_id = $this->db->insert_id();
                if ($this->session->userdata('acct_type') != 'admin_super') {
                    $query = $this->db->where('username !=', $this->session->userdata('username'))->where('region', $this->session->userdata('region'))->get('security_info')->result_array();
                } else {
                    $query = $this->db->where('username !=', $this->session->userdata('username'))->get('security_info')->result_array();
                }

                for ($i = 0; $i < count($query); $i++) {
                    $insert_activity_seen = array(
                        'activity_id' => $last_id,
                        'user_id' => $query[$i]['id'],
                        'seen' => 'no',
                        'region' => $this->session->userdata('region')
                    );
                    $insert = $this->db->insert('activity_log_seen', $insert_activity_seen);
                }

                $query_both = $this->db->where('username !=', $this->session->userdata('username'))->where('region', 'both')->get('security_info')->result_array();

                for ($i = 0; $i < count($query_both); $i++) {
                    $insert_activity_seen_both = array(
                        'activity_id' => $last_id,
                        'user_id' => $query_both[$i]['id'],
                        'seen' => 'no',
                        'region' => 'both'
                    );
                    $insert = $this->db->insert('activity_log_seen', $insert_activity_seen_both);
                }

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

            //delete before inserting 
            $this->db->where('Name', $name);
            $this->db->where('Code', $code);
            $this->db->delete('projects');

            $insert_array = array(
                'Name' => $name,
                'Code' => $code,
                'region' => $this->session->userdata('region')
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

    public function submit_bid_eval_form($project_id = NULL)
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $count = count($postData) / 4.8;
            $count = (int)$count;

            $this->db->where('project_id', $project_id);
            $this->db->delete('project_bids_evaluation');

            if (isset($_POST['flexRadioDefault'])) {
                $selected_row = $_POST['flexRadioDefault'];
            }

            for ($x = 1; $x <= $count; $x++) {
                $contractor_id = $postData['contractor_id' . $x];
                $technical_score = $postData['txt_tech_score' . $x];
                $financial_score = $postData['txt_fin_score' . $x];
                $total_score = $postData['txt_total_score' . $x];
                $bid_amount = $postData['txt_bid_amount' . $x];
                $recommendations = $postData['txt_recommendation'];

                if ($x == $selected_row) {
                    $value = 'Selected';
                } else {
                    $value = 'Not Selected';
                }

                $insert_array = array(
                    'project_id' => $project_id,
                    'contractor_id' => $contractor_id,
                    'technical_score' => $technical_score,
                    'financial_score' => $financial_score,
                    'total_score' => $total_score,
                    'bid_amount' => $bid_amount,
                    'recommendations' => $recommendations,
                    'Status' => $value,
                    'region' => $this->session->userdata('region')
                );

                $insert = $this->db->insert('project_bids_evaluation', $insert_array);
                $last_id = $this->db->insert_id();

                if ($x == $selected_row) {
                    $cond  = [
                        'ID' => $project_id,
                        'region' => $this->session->userdata('region')
                    ];
                    $data_update = [
                        'contractor_id' => $contractor_id,
                        'bid_id' => $last_id
                    ];
                    $this->db->where($cond);
                    $this->db->update('projects', $data_update);
                }
            }


            if (!empty($insert)) {

                //Add to activity log
                $insert_activity = array(
                    'activity_module' => $this->session->userdata('acct_type'),
                    'activity_action' => 'add',
                    'activity_detail' => "User" . $this->session->userdata('username') . " has added project bid evaluation form against project id " . $project_id,
                    'activity_by' => $this->session->userdata('username'),
                    'activity_date' => date('Y-m-d H:i:s'),
                    'region' => $this->session->userdata('region')
                );

                $insert = $this->db->insert('activity_log', $insert_activity);
                $last_id = $this->db->insert_id();
                if ($this->session->userdata('acct_type') != 'admin_super') {
                    $query = $this->db->where('username !=', $this->session->userdata('username'))->where('region', $this->session->userdata('region'))->get('security_info')->result_array();
                } else {
                    $query = $this->db->where('username !=', $this->session->userdata('username'))->get('security_info')->result_array();
                }

                for ($i = 0; $i < count($query); $i++) {
                    $insert_activity_seen = array(
                        'activity_id' => $last_id,
                        'user_id' => $query[$i]['id'],
                        'seen' => 'no',
                        'region' => $this->session->userdata('region')
                    );
                    $insert = $this->db->insert('activity_log_seen', $insert_activity_seen);
                }

                $query_both = $this->db->where('username !=', $this->session->userdata('username'))->where('region', 'both')->get('security_info')->result_array();

                for ($i = 0; $i < count($query_both); $i++) {
                    $insert_activity_seen_both = array(
                        'activity_id' => $last_id,
                        'user_id' => $query_both[$i]['id'],
                        'seen' => 'no',
                        'region' => 'both'
                    );
                    $insert = $this->db->insert('activity_log_seen', $insert_activity_seen_both);
                }

                $this->session->set_flashdata('success', 'Bids Evaluation Data Submitted successfully');
                redirect('Project_Officer/bids_evaluation/' . $project_id);
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
                redirect('Project_Officer/bids_evaluation/' . $project_id);
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('Project_Officer/bids_evaluation/' . $project_id);
        }
    }

    public function insert_project_bids()
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());
            $project_id = $postData['id'];
            $contractor = $postData['contractor'];
            $bid_amount = $postData['bid_amount'];

            for ($d = 0; $d < count($contractor); $d++) {
                $this->db->where('project_id', $project_id - 1);
                $this->db->where('contractor_id', $contractor[$d]);
                $this->db->where('bid_amount', $bid_amount[$d]);
                $this->db->delete('project_bids');
            }

            for ($i = 0; $i < count($contractor); $i++) {
                $insert_array = array(
                    'project_id' => $project_id,
                    'contractor_id' => $contractor[$i],
                    'bid_amount' => $bid_amount[$i],
                    'Status' => 'Verified',
                    'region' => $this->session->userdata('region')
                );
                $insert = $this->db->insert('project_bids', $insert_array);
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('Project_Officer/add_projects');
        }
    }

    public function get_total_projects_assigned()
    {
        if ($this->session->has_userdata('user_id')) {
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $getQty = $this->db->select('count(*) as count, contractor_id')->where('region', $this->session->userdata('region'))->group_by('contractor_id')->get('projects')->result_array();
            } else {
                $getQty = $this->db->select('count(*) as count, contractor_id')->group_by('contractor_id')->get('projects')->result_array();
            }
            echo json_encode($getQty);
        }
    }

    public function get_total_projects_completed()
    {
        if ($this->session->has_userdata('user_id')) {
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $getQty = $this->db->select('count(*) as count, contractor_id')->where('Status', 'Completed')->where('region', $this->session->userdata('region'))->group_by('contractor_id')->get('projects')->result_array();
            } else {
                $getQty = $this->db->select('count(*) as count, contractor_id')->where('Status', 'Completed')->group_by('contractor_id')->get('projects')->result_array();
            }
            echo json_encode($getQty);
        }
    }

    public function get_list_of_projects()
    {
        $cont_id = $_POST['contractor_id'];
        $status = $_POST['status'];
        if ($this->session->has_userdata('user_id')) {

            if ($this->session->userdata('acct_type') != 'admin_super') {
                if ($status != 'ALL') {
                    $projectsList = $this->db->where('contractor_id', $cont_id)->where('status', $status)->where('region', $this->session->userdata('region'))->get('projects')->result_array();
                } else {
                    $projectsList = $this->db->where('contractor_id', $cont_id)->where('region', $this->session->userdata('region'))->get('projects')->result_array();
                }
            } else {
                if ($status != 'ALL') {
                    $projectsList = $this->db->where('contractor_id', $cont_id)->where('status', $status)->get('projects')->result_array();
                } else {
                    $projectsList = $this->db->where('contractor_id', $cont_id)->get('projects')->result_array();
                }
            }

            echo json_encode($projectsList);
        }
    }
    public function upload_reg($fieldname)
    {
        //$data = NULL;
        //echo $fieldname;exit;
        $filesCount = count($_FILES['project_drawing']['name']);
        //print_r($_FILES['reg_cert']['name']);exit;
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['file']['name']     = $_FILES['project_drawing']['name'][$i];
            $_FILES['file']['type']     = $_FILES['project_drawing']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['project_drawing']['tmp_name'][$i];
            $_FILES['file']['error']     = $_FILES['project_drawing']['error'][$i];
            $_FILES['file']['size']     = $_FILES['project_drawing']['size'][$i];

            $config['upload_path'] = 'uploads/project_drawing';
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


    public function progress_report($project_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {

            // require_once $_SERVER['DOCUMENT_ROOT'] . 'ConstManagementSys/application/third_party/dompdf/vendor/autoload.php';
            require_once APPPATH . 'third_party/dompdf/vendor/autoload.php';
            // require_once base_url().'application/third_party/dompdf/vendor/autoload.php';
            //spl_autoload_register('DOMPDF_autoload');
            $options = new Options();
            $options->set('isRemoteEnabled', TRUE);
            $options->set('enable_html5_parser', TRUE);
            $options->set('tempDir', $_SERVER['DOCUMENT_ROOT'] . '/pdf-export/tmp');
            $dompdf = new Dompdf($options);
            $dompdf->set_base_path($_SERVER['DOCUMENT_ROOT'] . '');

            $id = $this->session->userdata('user_id');

            $this->db->select('p.*,c.Name as contractor_name, IFNULL(pb.bid_amount,0.00) as bid_amount, sum(progress_percentage) as total_percentage, count(progress_percentage) as total_rows');
            $this->db->from('projects p');
            $this->db->where('p.ID', $project_id);
            $this->db->join('contractors c', 'p.contractor_id = c.ID', 'left');
            $this->db->join('project_bids pb',  'p.bid_id = pb.id', 'p.ID = pb.project_id', 'left');
            $this->db->join('project_progress pp', 'p.ID = pp.project_id', 'left');
            $this->db->join('project_schedule ps', 'pp.task_id = ps.id', 'left');
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('p.region', $this->session->userdata('region'));
            }
            $this->db->group_by('p.Name, p.Code, p.Start_date, p.status');
            // print_r($this->db);exit;
            $data['project_record'] = $this->db->get()->row_array();


            $this->db->select('pp.*,ps.schedule_name, ps.schedule_start_date, ps.schedule_end_date');
            $this->db->from('project_progress pp');
            $this->db->join('project_schedule ps', 'pp.task_id = ps.id');
            $this->db->where('pp.project_id = ps.project_id');
            $this->db->where('pp.project_id', $project_id);
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('pp.region', $this->session->userdata('region'));
            }
            $data['project_progress'] = $this->db->get()->result_array();

            $html = $this->load->view('project_officer/progress_report', $data, TRUE); //$graph, TRUE);
            /**/
            $dompdf->loadHtml($html);

            // (Optional) Setup the paper size and orientation
            //$dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();

            $output = $dompdf->output();
            $doc_name = 'Project Report.pdf';
            file_put_contents($doc_name, $output);
            redirect($doc_name);
            //exit;
        } else {
            $this->load->view('userpanel/login');
        }
    }

    public function report_projects()
    {
        if ($this->session->has_userdata('user_id')) {

            require_once APPPATH . 'third_party/dompdf/vendor/autoload.php';

            $options = new Options();
            $options->set('isRemoteEnabled', TRUE);
            $options->set('enable_html5_parser', TRUE);
            $options->set('tempDir', $_SERVER['DOCUMENT_ROOT'] . '/pdf-export/tmp');
            $dompdf = new Dompdf($options);
            $dompdf->set_base_path($_SERVER['DOCUMENT_ROOT'] . '');

            $id = $this->session->userdata('user_id');

            $this->db->select('*');
            $this->db->from('projects');
            $this->db->where('Created_by', $this->session->userdata('username'));
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('region', $this->session->userdata('region'));
            }
            $data['project_record'] = $this->db->get()->result_array();

            $html = $this->load->view('project_officer/project_report', $data, TRUE); //$graph, TRUE);

            $dompdf->loadHtml($html);
            $dompdf->render();

            $output = $dompdf->output();
            $doc_name = 'Projects Report.pdf';
            file_put_contents($doc_name, $output);
            redirect($doc_name);
            //exit;
        } else {
            $this->load->view('userpanel/login');
        }
    }

    public function report_contractor()
    {
        if ($this->session->has_userdata('user_id')) {

            require_once APPPATH . 'third_party/dompdf/vendor/autoload.php';

            $options = new Options();
            $options->set('isRemoteEnabled', TRUE);
            $options->set('enable_html5_parser', TRUE);
            $options->set('tempDir', $_SERVER['DOCUMENT_ROOT'] . '/pdf-export/tmp');
            $dompdf = new Dompdf($options);
            $dompdf->set_base_path($_SERVER['DOCUMENT_ROOT'] . '');

            $id = $this->session->userdata('user_id');

            $this->db->select('*');
            $this->db->from('contractors');
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('region', $this->session->userdata('region'));
            }
            $data['contractor_records'] = $this->db->get()->result_array();

            $html = $this->load->view('project_officer/contractor_report', $data, TRUE); //$graph, TRUE);

            $dompdf->loadHtml($html);
            $dompdf->render();

            $output = $dompdf->output();
            $doc_name = 'Contractor List Report.pdf';
            file_put_contents($doc_name, $output);
            redirect($doc_name);
            //exit;
        } else {
            $this->load->view('userpanel/login');
        }
    }
}
