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



    public function show_bills()
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
            $this->load->view('so_record/billing_list', $data);
        }
    }

    public function view_bill_detail()
    {
        if ($this->session->has_userdata('user_id')) {
            $id = $_POST['id'];

            $data['bill_detail'] =$this->db->where('id',$id)->get('project_bills')->row_array();
           
             $data['bill_uploaded']= explode("," ,  $data['bill_detail']['bill_file_attach_1']);
            // print_r($data['bill_uploaded']);exit;
            echo json_encode($data['bill_uploaded']);
        }
    }

    public function get_running_bills_detail(){
        $project_id = $_POST['project_id'];
        $this->session->set_userdata('project_id',$project_id);

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

            $data['project_id'] = $_POST['project_id_selected'];
            $this->load->view('so_record/add_new_bill', $data);
        }
    }

       public function edit_bill($project_id = null)
    {
        if ($this->session->has_userdata('user_id')) {

            //$data['project_id'] = $_POST['project_id_selected'];
             if ($this->session->userdata('acct_type') != 'admin_super') {
            $data['project_bills'] = $this->db->where('region', $this->session->userdata('region'))->where('project_id', $project_id)->get('project_bills')->row_array();
        } else {
            $data['project_bills'] = $this->db->where('project_id', $project_id)->get('project_bills')->row_array();
        }
        //print_r($data['project_bills']);exit;
            $this->load->view('so_record/edit_bill', $data);
        }
    }

    public function insert_project_bill()
    {
        $postData = $this->security->xss_clean($this->input->post());


        $project_id = $postData['project_id_selected'];
        $bill_no = $postData['bill_no'];
        $gross_work_done = $postData['gross_work'];
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
        //print_r($insert_array);exit;
        $insert = $this->db->insert('project_bills', $insert_array);

        if (!empty($insert)) {
            $this->session->set_flashdata('success', 'Project Billing added successfully');
            redirect('SO_RECORD/show_bills');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            redirect('SO_RECORD/show_bills');
        }
    }

     public function edit_project_bill()
    {
        $postData = $this->security->xss_clean($this->input->post());


        $project_id = $postData['project_id_selected'];
        $bill_no = $postData['bill_no'];
        $gross_work_done = $postData['gross_work'];
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
       if($_FILES['project_billing']['name'][0] !=null){
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
    }else{
 $update_array = array(

           // 'project_id' => $project_id,
            'bill_name' => $bill_no,
            'gross_work_done' => $gross_work_done,
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

       

        $cond=['project_id'=>
        $project_id];

       
        //print_r($insert_array);exit;
        $this->db->where($cond);
        $insert = $this->db->update('project_bills', $update_array);

        if (!empty($insert)) {
            $this->session->set_flashdata('success', 'Project Billing updated successfully');
            redirect('SO_RECORD/show_bills');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            redirect('SO_RECORD/show_bills');
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
            $_FILES['file']['error']     = $_FILES['project_billing']['error'][$i];
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

            $this->db->select('id.id, i.Material_Name, id.Quantity, id.Price,i.Unit, id.stock_date, id.Status, id.cost_per_unit');
            $this->db->from('inventory i');
            $this->db->join('inventory_detail id', 'i.ID = id.Material_ID');
            $this->db->where('Material_id', $id);
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('i.region', $this->session->userdata('region'));
            }

            $data['inventory_detail_records'] = $this->db->get()->result_array();
            $this->load->view('so_record/inventory_detail', $data);
        }
    }

    
     public function bills_print($project_id=null)
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


            $html = $this->load->view('so_record/bill_report', $data, TRUE); //$graph, TRUE);

            $dompdf->loadHtml($html);
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

}
