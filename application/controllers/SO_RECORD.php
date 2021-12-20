<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

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

            if ($acct_type == "SO_RECORD" || $acct_type == "admin_super" || $acct_type == "admin_north" || $acct_type == "admin_south") {
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

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['projects'] = $this->db->where('region', $this->session->userdata('region'))->get('projects')->result_array();
            } else {
                $data['projects'] = $this->db->get('projects')->result_array();
            }

            $this->db->select('pal.*,p.Name');
            $this->db->from('project_allotment_letter pal');
            $this->db->join('projects p', 'p.ID = pal.project_id');
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('pal.region', $this->session->userdata('region'));
            }
            $data['letter_list'] = $this->db->get()->result_array();

            $this->load->view('so_record/allotment_letter_list', $data); //, $data);
        }
    }

    public function view_performance_security()
    {
        if ($this->session->has_userdata('user_id')) {

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['projects'] = $this->db->where('region', $this->session->userdata('region'))->get('projects')->result_array();
            } else {
                $data['projects'] = $this->db->get('projects')->result_array();
            }

            $this->db->select('psl.*,p.Name');
            $this->db->from('project_performance_security_letter psl');
            $this->db->join('projects p', 'p.ID = psl.project_id');
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('psl.region', $this->session->userdata('region'));
            }
            $data['letter_list'] = $this->db->get()->result_array();

            $this->load->view('so_record/performance_security', $data); //, $data);
        }
    }

    public function about_test()
    {
        //Get the value from the form.
        $search = $this->input->post('hours');

        //Put the value in an array to pass to the view. 
        $view_data['search'] = $search;

        //Pass to the value to the view. Access it as '$search' in the view.
        $this->load->view("so_record/bill_select", $view_data);
    }

    public function show_bills($project_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['projects'] = $this->db->where('region', $this->session->userdata('region'))->get('projects')->result_array();
            } else {
                $data['projects'] = $this->db->get('projects')->result_array();
            }

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['project_bills'] = $this->db->where('region', $this->session->userdata('region'))->get('project_bills')->result_array();
            } else {
                $data['project_bills'] = $this->db->get('project_bills')->result_array();
            }

            $value = $this->input->post('project_id');
            if (isset($project_id)) {
                $value = $project_id;
            }
            if (isset($value)) {
                if ($this->session->userdata('acct_type') != 'admin_super') {
                    $data['project_detail'] = $this->db->where('region', $this->session->userdata('region'))->where('ID', $value)->get('projects')->row_array();
                } else {
                    $data['project_detail'] = $this->db->where('ID', $value)->get('projects')->row_array();
                }

                $data['total_payment_made'] = $this->db->select('sum(payment_made) as total_payment')->where('project_id', $value)->get('project_bills')->row_array();
                $data['total_verified_amount'] = $this->db->select('sum(verified_amount) as total_verified')->where('project_id', $value)->get('project_bills')->row_array();
            }


            $this->load->view('so_record/bill_select', $data);
        }
    }

    public function show_officer_record($officer_id = NULL)
    {
        if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $value = $this->input->post('search_id');

            if (isset($officer_id)) {
                $value = $officer_id;
            }
            if (isset($value)) {
                $data['officer_detail'] = $this->db->where('officer_id', $value)->get('officer_record')->row_array();
                $data['isdata'] = 'Yes';

                if (is_null($data['officer_detail'])) {
                    $data['isdata'] = 'No Data Found';
                }
            }

            $this->load->view('so_record/search_officer_record', $data);
        } else {
            $data['isdata'] = 'Yes';
            $this->load->view('so_record/search_officer_record', $data);
        }
    }

    public function show_running_bills($project_id = NULL)
    {

        if ($this->session->has_userdata('user_id')) {
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['project_bills'] = $this->db->where('region', $this->session->userdata('region'))->where('project_id', $project_id)->get('project_bills')->result_array();
            } else {
                $data['project_bills'] = $this->db->where('project_id', $project_id)->get('project_bills')->result_array();
            }

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['projects'] = $this->db->where('region', $this->session->userdata('region'))->where('ID', $project_id)->get('projects')->row_array();
            } else {
                $data['projects'] = $this->db->where('ID', $project_id)->get('projects')->row_array();
            }


            $this->load->view('so_record/billing_list_running', $data);
        }
    }

    public function show_running_bill_detail($project_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['projects'] = $this->db->where('region', $this->session->userdata('region'))->get('projects')->result_array();
            } else {
                $data['projects'] = $this->db->get('projects')->result_array();
            }

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['project_bills'] = $this->db->where('region', $this->session->userdata('region'))->where('id', $project_id)->get('project_bills')->result_array();
            } else {
                $data['project_bills'] = $this->db->where('id', $project_id)->get('project_bills')->result_array();
            }

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['project_id'] = $this->db->where('region', $this->session->userdata('region'))->where('id', $project_id)->distinct()->get('project_bills')->row_array();
            } else {
                $data['project_id'] = $this->db->where('id', $project_id)->distinct()->get('project_bills')->row_array();
            }

            $data['bill_id'] = $project_id;
            $this->load->view('so_record/billing_list', $data);
        }
    }

    public function show_bills_summary($project_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['projects'] = $this->db->where('region', $this->session->userdata('region'))->where('ID', $project_id)->get('projects')->row_array();
            } else {
                $data['projects'] = $this->db->where('ID', $project_id)->get('projects')->row_array();
            }

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['project_bills'] = $this->db->where('region', $this->session->userdata('region'))->where('project_id', $project_id)->get('project_bills')->result_array();
            } else {
                $data['project_bills'] = $this->db->where('project_id', $project_id)->get('project_bills')->result_array();
            }

            $data['proj_id'] = $project_id;

            $this->load->view('so_record/billing_summary', $data);
        }
    }

    public function view_bill_detail()
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $_POST['id'];

            $data['bill_detail'] = $this->db->where('id', $id)->get('project_bills')->row_array();

            $data['bill_uploaded'] = explode(",",  $data['bill_detail']['bill_file_attach_1']);
            // print_r($data['bill_uploaded']);exit;
            echo json_encode($data['bill_uploaded']);
        }
    }

    public function get_running_bills_detail()
    {
        $project_id = $_POST['project_id'];
        $this->session->set_userdata('project_id', $project_id);
        if ($this->session->userdata('acct_type') != 'admin_super') {
            $project_bills = $this->db->where('region', $this->session->userdata('region'))->where('project_id', $project_id)->get('project_bills')->result_array();
        } else {
            $project_bills = $this->db->where('project_id', $project_id)->get('project_bills')->result_array();
        }
        echo json_encode($project_bills);
    }

    public function add_new_bill($projectid = null)
    {
        if ($this->session->has_userdata('user_id')) {
            // $data['project_id'] = $_POST['project_id_selected'];
            $data['project_id'] = $projectid;
            $data['material_cost_used'] = $this->db->select('sum(Price) as total_cost')->where('Material_used_by_Project', $data['project_id'])->get('inventory_used')->row_array();
            $data['material_cost_used_previous_bills'] = $this->db->select('sum(total_cost_material_used) as total_cost_billed')->where('project_id', $data['project_id'])->get('project_bills')->row_array();

            $total_cost =  $data['material_cost_used']['total_cost'];
            $total_cost_billed =  is_null($data['material_cost_used_previous_bills']['total_cost_billed']) ? 0 : $data['material_cost_used_previous_bills']['total_cost_billed'];

            $data['remaining_total_cost_material_used'] = $total_cost - $total_cost_billed;
            $this->load->view('so_record/add_new_bill', $data);
        }
    }

    public function add_officer_record()
    {
        if ($this->session->has_userdata('user_id')) {
            $this->load->view('so_record/add_officer_record');
        }
    }
    public function edit_officer_record($officer_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            $data['officer_record'] = $this->db->where('officer_id', $officer_id)->get('officer_record')->row_array();
            $this->load->view('so_record/edit_officer_record', $data);
        }
    }

    public function show_officer_record_list()
    {
        if ($this->session->has_userdata('user_id')) {
            $data['officer_record'] = $this->db->get('officer_record')->result_array();
            $this->load->view('so_record/officer_records_list', $data);
        }
    }

    public function search_officer_record()
    {

        $this->load->view('so_record/search_officer_record');
    }

    public function edit_bill($bill_id = null)
    {
        if ($this->session->has_userdata('user_id')) {
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['project_bills'] = $this->db->where('region', $this->session->userdata('region'))->where('id', $bill_id)->get('project_bills')->row_array();
            } else {
                $data['project_bills'] = $this->db->where('id', $bill_id)->get('project_bills')->row_array();
            }
            $this->load->view('so_record/edit_bill', $data);
        }
    }

    public function view_bill($bill_id = null)
    {
        if ($this->session->has_userdata('user_id')) {
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['project_bills'] = $this->db->where('region', $this->session->userdata('region'))->where('id', $bill_id)->get('project_bills')->row_array();
            } else {
                $data['project_bills'] = $this->db->where('id', $bill_id)->get('project_bills')->row_array();
            }
            $this->load->view('so_record/view_bill', $data);
        }
    }

    public function insert_project_bill()
    {
        $postData = $this->security->xss_clean($this->input->post());


        $project_id = $postData['project_id_selected'];
        $bill_no = $postData['bill_no'];
        $gross_work_done = $postData['gross_work'];
        $bill_desc = $postData['bill_desc'];
        $wd_in_bill = $postData['WD_bill'];
        $rm_deducted = $postData['RM_deducted'];
        $payment_made = $postData['payment_made'];
        $cheque_no = $postData['cheque_number'];
        $date = $postData['date'];

        $it_deducted = $postData['it_deducted'];
        $payment_made = $postData['payment_made'];
        $cheque_no = $postData['cheque_number'];
        $contract_amount = $postData['contract_amt'];

        $paid_till_last_bill = $postData['last_bill_paid'];
        $claim_amount = $postData['claim_amt'];
        $verified_amount = $postData['verify_amt'];
        $total_cost_of_material = $postData['material_used'];


        $upload1 = $this->upload_billing($_FILES['project_billing']);

        if (count($upload1) > 1) {
            $files = implode(',', $upload1);
        } else {
            $files = $upload1[0];
        }

        $insert_array = array(
            'project_id' => $project_id,
            'bill_name' => $bill_no,
            'gross_work_done' => $gross_work_done,
            'bill_description' => $bill_desc,
            'wd_in_bill' => $wd_in_bill,
            'rm_deducted' => $rm_deducted,
            'date_added' => $date,
            'it_deducted' => $it_deducted,
            'payment_made' => $payment_made,
            'cheque_no' => $cheque_no,
            'contract_amount' => $contract_amount,
            'paid_till_last_bill' => $paid_till_last_bill,
            'claim_amount' => $claim_amount,
            'verified_amount' => $verified_amount,
            'bill_file_attach_1' => $files,
            'total_cost_material_used' => $total_cost_of_material,
            'region' => $this->session->userdata('region')
        );
        //print_r($insert_array);exit;
        $insert = $this->db->insert('project_bills', $insert_array);


        if (!empty($insert)) {

            $project = $this->db->where('ID', $project_id)->get('projects')->row_array();
            $insert_activity = array(
                'activity_module' => $this->session->userdata('acct_type'),
                'activity_action' => 'add',
                'activity_detail' => "Bill no: " . $bill_no . "  has been added against project: " . $project['Name'],
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

            $this->session->set_flashdata('success', 'Project Billing added successfully');
            redirect('SO_RECORD/show_running_bills/' . $project_id);
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            redirect('SO_RECORD/show_running_bills/' . $project_id);
        }
    }

    public function insert_officer_record()
    {
        $postData = $this->security->xss_clean($this->input->post());


        $officer_id = $postData['officer_id'];
        $officer_name = $postData['officer_name'];
        $CNIC = $postData['CNIC'];
        $Rank = $postData['Rank'];
        $payment_last_month = $postData['payment_last_month'];
        $total_payment = $postData['total_payment'];

        if (isset($_FILES['doc_attach'])) {
            $upload1 = $this->upload_doc_attachment($_FILES['doc_attach']);
        }

        if (count($upload1) > 1) {
            $files = implode(',', $upload1);
        } else {
            $files = $upload1[0];
        }

        $insert_array = array(
            'officer_id' => $officer_id,
            'officer_name' => $officer_name,
            'officer_cnic' => $CNIC,
            'officer_rank' => $Rank,
            'payment_last_month' => $payment_last_month,
            'total_payment' => $total_payment,
            'file_attach' => $files
        );
        //print_r($insert_array);exit;
        $insert = $this->db->insert('officer_record', $insert_array);


        if (!empty($insert)) {

            // $project = $this->db->where('ID', $project_id)->get('projects')->row_array();
            $insert_activity = array(
                'activity_module' => $this->session->userdata('acct_type'),
                'activity_action' => 'add',
                'activity_detail' => "Officer : " . $officer_name . "  has been added by : " . $this->session->userdata('username'),
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

            $this->session->set_flashdata('success', 'Officer Record added successfully');
            redirect('SO_RECORD/add_officer_record');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            redirect('SO_RECORD/add_officer_record');
        }
    }

    public function update_officer_record()
    {
        $postData = $this->security->xss_clean($this->input->post());


        $officer_id = $postData['officer_id'];
        $officer_name = $postData['officer_name'];
        $CNIC = $postData['CNIC'];
        $Rank = $postData['Rank'];
        $payment_last_month = $postData['payment_last_month'];
        $total_payment = $postData['total_payment'];

        if (isset($_FILES['doc_attach'])) {
            $upload1 = $this->upload_doc_attachment($_FILES['doc_attach']);
        }

        if (count($upload1) > 1) {
            $files = implode(',', $upload1);
        } else {
            $files = $upload1[0];
        }

        $update_array = array(
            'officer_name' => $officer_name,
            'officer_cnic' => $CNIC,
            'officer_rank' => $Rank,
            'payment_last_month' => $payment_last_month,
            'total_payment' => $total_payment,
            'file_attach' => $files
        );


        $cond = [
            'officer_id' => $officer_id
        ];

        $this->db->where($cond);
        $insert = $this->db->update('officer_record', $update_array);

        if (!empty($insert)) {
            $insert_activity = array(
                'activity_module' => $this->session->userdata('acct_type'),
                'activity_action' => 'add',
                'activity_detail' => "Officer : " . $officer_name . "  has been updated by : " . $this->session->userdata('username'),
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

            $this->session->set_flashdata('success', 'Officer Record updated successfully');
            redirect('SO_RECORD/show_officer_record_list');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            redirect('SO_RECORD/show_officer_record_list');
        }
    }

    public function edit_project_bill()
    {
        $postData = $this->security->xss_clean($this->input->post());

        $project_id = $postData['project_id_selected'];
        $bill_no = $postData['bill_no'];
        $gross_work_done = $postData['gross_work'];
        $bill_desc = $postData['bill_desc'];
        $wd_in_bill = $postData['WD_bill'];
        $rm_deducted = $postData['RM_deducted'];
        $payment_made = $postData['payment_made'];
        $cheque_no = $postData['cheque_number'];
        $date = $postData['date'];

        $it_deducted = $postData['it_deducted'];
        $payment_made = $postData['payment_made'];
        $cheque_no = $postData['cheque_number'];
        $contract_amount = $postData['contract_amt'];

        $paid_till_last_bill = $postData['last_bill_paid'];
        $claim_amount = $postData['claim_amt'];
        $verified_amount = $postData['verify_amt'];

        //if($_FILES['project_billing'] != null)
        if ($_FILES['project_billing']['name'][0] != null) {
            $upload1 = $this->upload_billing($_FILES['project_billing']);
            if (count($upload1) > 1) {
                $files = implode(',', $upload1);
            } else {
                $files = $upload1[0];
            }

            $update_array = array(

                // 'project_id' => $project_id,
                'bill_name' => $bill_no,
                'gross_work_done' => $gross_work_done,
                'bill_description' => $bill_desc,
                'wd_in_bill' => $wd_in_bill,
                'rm_deducted' => $rm_deducted,
                'date_added' => $date,
                'it_deducted' => $it_deducted,
                'payment_made' => $payment_made,
                'cheque_no' => $cheque_no,
                'contract_amount' => $contract_amount,
                'paid_till_last_bill' => $paid_till_last_bill,
                'claim_amount' => $claim_amount,
                'verified_amount' => $verified_amount,
                'bill_file_attach_1' => $files,
                'region' => $this->session->userdata('region')
            );
        } else {
            $update_array = array(

                // 'project_id' => $project_id,
                'bill_name' => $bill_no,
                'gross_work_done' => $gross_work_done,
                'bill_description' => $bill_desc,
                'wd_in_bill' => $wd_in_bill,
                'rm_deducted' => $rm_deducted,
                'date_added' => $date,
                'it_deducted' => $it_deducted,
                'payment_made' => $payment_made,
                'cheque_no' => $cheque_no,
                'contract_amount' => $contract_amount,
                'paid_till_last_bill' => $paid_till_last_bill,
                'claim_amount' => $claim_amount,
                'verified_amount' => $verified_amount,
                'region' => $this->session->userdata('region')
            );
        }

        $cond = [
            'project_id' => $project_id,
            'bill_name' => $bill_no
        ];


        //print_r($insert_array);exit;
        $this->db->where($cond);
        $insert = $this->db->update('project_bills', $update_array);

        if (!empty($insert)) {

            $project = $this->db->where('ID', $project_id)->get('projects')->row_array();
            $insert_activity = array(
                'activity_module' => $this->session->userdata('acct_type'),
                'activity_action' => 'add',
                'activity_detail' => "Bill no: " . $bill_no . "  has been updated against project: " . $project['Name'],
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

            $this->session->set_flashdata('success', 'Project Billing updated successfully');
            redirect('SO_RECORD/show_running_bills/' . $project_id);
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            redirect('SO_RECORD/show_running_bills/' . $project_id);
        }
    }

    public function  upload_allotment_letter()
    {
        $postData = $this->security->xss_clean($this->input->post());

        $project_id = $postData['project_id'];
        $rcvd_date = $postData['rcvd_date'];
        $dispatch_date = $postData['dispatch_date'];
        $officer_name = $postData['officer_name'];
        $upload1 = $this->upload_letter($_FILES['project_allotment_letter']);

        if (count($upload1) >= 1) {
            for ($i = 0; $i < count($upload1); $i++) {
                $insert_array = array(

                    'project_id' => $project_id,
                    'received_date' => $rcvd_date,
                    'dispatch_date' => $dispatch_date,
                    'officer_name' => $officer_name,
                    'file_name' => $upload1[$i],
                    'date_added' => date('Y-m-d'),
                    'region' => $this->session->userdata('region')
                );
                $insert = $this->db->insert('project_allotment_letter', $insert_array);
            }
        }
        if (!empty($insert)) {

            $project = $this->db->where('ID', $project_id)->get('projects')->row_array();
            $insert_activity = array(
                'activity_module' => $this->session->userdata('acct_type'),
                'activity_action' => 'add',
                'activity_detail' => "Allotment Letter has been added against project: " . $project['Name'],
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

            $this->session->set_flashdata('success', 'Allotment Record added successfully');
            redirect('SO_RECORD/show_letter_lists');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            redirect('SO_RECORD/show_letter_lists');
        }
    }

    public function  upload_performance_security_letter()
    {
        $postData = $this->security->xss_clean($this->input->post());

        $project_id = $postData['project_id'];
        $amount = $postData['amount'];
        $valid_date = $postData['valid_date'];
        $officer_name = $postData['issued_by'];
        $upload1 = $this->upload_letter_performance_security($_FILES['project_performance_security_letter']);

        if (count($upload1) >= 1) {
            for ($i = 0; $i < count($upload1); $i++) {
                $insert_array = array(

                    'project_id' => $project_id,
                    'validity_date' => $valid_date,
                    'amount' => $amount,
                    'issued_by' => $officer_name,
                    'file_name' => $upload1[$i],
                    'date_added' => date('Y-m-d'),
                    'region' => $this->session->userdata('region')
                );
                $insert = $this->db->insert('project_performance_security_letter', $insert_array);
            }
        }
        if (!empty($insert)) {

            $project = $this->db->where('ID', $project_id)->get('projects')->row_array();
            $insert_activity = array(
                'activity_module' => $this->session->userdata('acct_type'),
                'activity_action' => 'add',
                'activity_detail' => "Performance Security Letter has been added against project: " . $project['Name'],
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

            $this->session->set_flashdata('success', 'Performance Security Record added successfully');
            redirect('SO_RECORD/view_performance_security');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            redirect('SO_RECORD/view_performance_security');
        }
    }

    public function upload_letter($fieldname)
    {
        $filesCount = count($_FILES['project_allotment_letter']['name']);
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['file']['name']     = $_FILES['project_allotment_letter']['name'][$i];
            $_FILES['file']['type']     = $_FILES['project_allotment_letter']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['project_allotment_letter']['tmp_name'][$i];
            $_FILES['file']['error']     = $_FILES['project_allotment_letter']['error'][$i];
            $_FILES['file']['size']     = $_FILES['project_allotment_letter']['size'][$i];

            $config['upload_path'] = 'uploads/project_allotment_letter';
            $config['allowed_types']        = 'gif|jpg|png|doc|xls|pdf|xlsx|docx|ppt|pptx|txt|jpeg';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                $data = array('msg' => $this->upload->display_errors());
            } else {

                $data = array('msg' => "success");
                $data['upload_data'] = $this->upload->data();
                $count[$i] = $data['upload_data']['file_name'];
            }
        }
        return $count;
    }
    public function upload_billing($fieldname)
    {
        $filesCount = count($_FILES['project_billing']['name']);
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['file']['name']     = $_FILES['project_billing']['name'][$i];
            $_FILES['file']['type']     = $_FILES['project_billing']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['project_billing']['tmp_name'][$i];
            $_FILES['file']['error']    = $_FILES['project_billing']['error'][$i];
            $_FILES['file']['size']     = $_FILES['project_billing']['size'][$i];

            $config['upload_path'] = 'uploads/project_billing';
            $config['allowed_types']        = 'gif|jpg|png|doc|xls|pdf|xlsx|docx|ppt|pptx|txt|jpeg';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                $data = array('msg' => $this->upload->display_errors());
            } else {
                $data = array('msg' => "success");
                $data['upload_data'] = $this->upload->data();
                $count[$i] = $data['upload_data']['file_name'];
            }
        }
        return $count;
    }

    public function upload_doc_attachment($fieldname)
    {
        $filesCount = count($_FILES['doc_attach']['name']);
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['file']['name']     = $_FILES['doc_attach']['name'][$i];
            $_FILES['file']['type']     = $_FILES['doc_attach']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['doc_attach']['tmp_name'][$i];
            $_FILES['file']['error']    = $_FILES['doc_attach']['error'][$i];
            $_FILES['file']['size']     = $_FILES['doc_attach']['size'][$i];

            $config['upload_path'] = 'uploads/officer_records';
            $config['allowed_types']  = 'gif|jpg|png|doc|xls|pdf|xlsx|docx|ppt|pptx|txt|jpeg';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                $data = array('msg' => $this->upload->display_errors());
            } else {
                $data = array('msg' => "success");
                $data['upload_data'] = $this->upload->data();
                $count[$i] = $data['upload_data']['file_name'];
            }
        }
        return $count;
    }

    public function upload_letter_performance_security($fieldname)
    {
        $filesCount = count($_FILES['project_performance_security_letter']['name']);
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['file']['name']     = $_FILES['project_performance_security_letter']['name'][$i];
            $_FILES['file']['type']     = $_FILES['project_performance_security_letter']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['project_performance_security_letter']['tmp_name'][$i];
            $_FILES['file']['error']     = $_FILES['project_performance_security_letter']['error'][$i];
            $_FILES['file']['size']     = $_FILES['project_performance_security_letter']['size'][$i];

            $config['upload_path'] = 'uploads/performance_security_letter';
            $config['allowed_types']        = 'gif|jpg|png|doc|xls|pdf|xlsx|docx|ppt|pptx|txt|jpeg';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                $data = array('msg' => $this->upload->display_errors());
            } else {

                $data = array('msg' => "success");
                $data['upload_data'] = $this->upload->data();
                $count[$i] = $data['upload_data']['file_name'];
            }
        }
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

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['activity_log'] = $this->db->where('region', $this->session->userdata('region'))->get('activity_log')->result_array();
            } else {
                $data['activity_log'] = $this->db->get('activity_log')->result_array();
            }

            $this->load->view('so_record/activity_log', $data);
        }
    }

    public function view_material_used()
    {
        if ($this->session->has_userdata('user_id')) {
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['project_records'] = $this->db->where('region', $this->session->userdata('region'))->get('projects')->result_array();
            } else {
                $data['project_records'] = $this->db->get('projects')->result_array();
            }
            $this->load->view('so_record/material_used_projects', $data);
        }
    }

    public function view_inventory_detail($id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            // $this->db->select('id.Material_id, i.Material_Name, id.Quantity, id.Price,i.Unit, id.stock_date, id.Status, id.cost_per_unit');
            $this->db->select('inventory_used.*,projects.*,inventory_detail.*,inventory.Material_Name, inventory_used.status as inv_used_status,inventory.Unit');
            $this->db->from('inventory_used');
            $this->db->join('projects', 'projects.ID = inventory_used.Material_used_by_Project');
            $this->db->join('inventory', 'inventory.ID = inventory_used.Material_id');
            $this->db->join('inventory_detail', 'inventory_detail.Material_ID = inventory_used.Material_id');
            $this->db->where('Material_used_by_Project', $id);
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('inventory_used.region', $this->session->userdata('region'));
            }
            $data['inventory_detail_records'] = $this->db->get()->result_array();
            $this->load->view('so_record/inventory_detail', $data);
        }
    }

    public function bills_print($bill_id = null)
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

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['project_record'] = $this->db->where('region', $this->session->userdata('region'))->where('id', $bill_id)->get('project_bills')->result_array();
            } else {
                $data['project_record'] = $this->db->where('id', $bill_id)->get('project_bills')->result_array();
            }

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['projects'] = $this->db->where('region', $this->session->userdata('region'))->where('ID', $data['project_record'][0]['project_id'])->get('projects')->row_array();
            } else {
                $data['projects'] = $this->db->where('ID', $data['project_record'][0]['project_id'])->get('projects')->row_array();
            }

            $html = $this->load->view('so_record/bill_report', $data, TRUE); //$graph, TRUE);

            $dompdf->loadHtml($html);
            $dompdf->set_paper('A4', 'landscape');
            $dompdf->render();

            $output = $dompdf->output();
            $doc_name = 'Project Bill Report.pdf';
            file_put_contents($doc_name, $output);
            redirect($doc_name);
            //exit;
        } else {
            $this->load->view('userpanel/login');
        }
    }

    public function bills_summary_print($project_id = null)
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

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['project_record'] = $this->db->where('region', $this->session->userdata('region'))->where('project_id', $project_id)->get('project_bills')->result_array();
            } else {
                $data['project_record'] = $this->db->where('project_id', $project_id)->get('project_bills')->result_array();
            }

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['projects'] = $this->db->where('region', $this->session->userdata('region'))->where('ID', $project_id)->get('projects')->row_array();
            } else {
                $data['projects'] = $this->db->where('ID', $project_id)->get('projects')->row_array();
            }

            $html = $this->load->view('so_record/bill_summary_report', $data, TRUE); //$graph, TRUE);

            $dompdf->loadHtml($html);
            $dompdf->set_paper('A4', 'landscape');
            $dompdf->render();

            $output = $dompdf->output();
            $doc_name = 'Project Bill Report.pdf';
            file_put_contents($doc_name, $output);
            redirect($doc_name);
            //exit;
        } else {
            $this->load->view('userpanel/login');
        }
    }

    public function print_performance_security()
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
            // $data['project_name'] = $this->db->select('Name')->where('ID', $project_id)->get('projects')->row_array();

            $this->db->select('psl.*,p.Name');
            $this->db->from('project_performance_security_letter psl');
            $this->db->join('projects p', 'p.ID = psl.project_id');
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('psl.region', $this->session->userdata('region'));
            }
            $data['project_record'] = $this->db->get()->result_array();
            // if ($this->session->userdata('acct_type') != 'admin_super') {
            //     $data['project_record'] = $this->db->where('region', $this->session->userdata('region'))->get('project_performance_security_letter')->result_array();
            // } else {
            //     $data['project_record'] = $this->db->get('project_performance_security_letter')->result_array();
            // }

            $html = $this->load->view('so_record/performance_security_report', $data, TRUE); //$graph, TRUE);

            $dompdf->loadHtml($html);
            // $dompdf->set_paper('A4', 'landscape');
            $dompdf->render();

            $output = $dompdf->output();
            $doc_name = 'Performance Security letters.pdf';
            file_put_contents($doc_name, $output);
            redirect($doc_name);
            //exit;
        } else {
            $this->load->view('userpanel/login');
        }
    }

    public function print_allotment_letters()
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

            $this->db->select('pal.*,p.Name');
            $this->db->from('project_allotment_letter pal');
            $this->db->join('projects p', 'p.ID = pal.project_id');
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('pal.region', $this->session->userdata('region'));
            }
            $data['project_record'] = $this->db->get()->result_array();
            $html = $this->load->view('so_record/allotment_letter_report', $data, TRUE); //$graph, TRUE);
            $dompdf->loadHtml($html);
            $dompdf->render();
            $output = $dompdf->output();
            $doc_name = 'Project Bill Report.pdf';
            file_put_contents($doc_name, $output);
            redirect($doc_name);
        } else {
            $this->load->view('userpanel/login');
        }
    }
}
