<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class SO_STORE extends CI_Controller
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

            if ($acct_type == "SO_STORE" || $acct_type == "admin") {
                $this->load->view('so_store/dashboard');
            } else {
                $this->load->view('login');
            }
        } else {
            $this->load->view('login');
        }
    }

    public function add_inventory()
    {

        if ($this->session->has_userdata('user_id')) {
            $data['inventory_records'] = $this->db->get('inventory')->result_array();
            $this->load->view('so_store/inventory', $data);
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
            $this->db->where('id.Material_ID', $id);
            
            $data['inventory_detail_records'] = $this->db->get()->result_array();
            $this->load->view('so_store/inventory_detail', $data);
        }
    }

    public function insert_inventory()
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $material = $postData['material_name'];
            $quantity = $postData['quantity'];
            $price = $postData['price'];
            $unit = $postData['unit'];

            $insert_array = array(
                'Material_Name' => $material,
                'Material_Total_Quantity' => $quantity,
                'Material_Total_Price' => $price,
                'Unit' => $unit
            );

            $insert = $this->db->insert('inventory', $insert_array);
            $last_id = $this->db->insert_id();

            $insert_array_detail = array(
                'Material_ID' => $last_id,
                'Quantity' => $quantity,
                'Price' => $price,
                'stock_date' => date('Y-m-d'),
                'Status' => 'Delivered'
            );

            $insert_detail = $this->db->insert('inventory_detail', $insert_array_detail);

            if (!empty($insert) && !empty($insert_detail)) {
                $this->session->set_flashdata('success', 'Data Submitted successfully');
                redirect('SO_STORE/add_inventory');
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('SO_STORE');
        }
    }

    public function update_inventory()
    {
        $id =  $_POST['id'];
        $quantity = $_POST['quantity'];
        // echo $id;
        // echo $quantity;
        $cond  = ['ID' => $id];
        $data_update = [
            'Material_Quantity' => $quantity,
        ];

        $this->db->where($cond);
        $this->db->update('inventory', $data_update);
    }

    public function edit_inventory()
    {
        $id =  $_POST['id_edit'];
        $quantity = $_POST['new_quantity'];
        $price = $_POST['new_price'];

        $insert_array_detail = array(
            'Material_ID' => $id,
            'Quantity' => $quantity,
            'Price' => $price,
            'stock_date' => date('Y-m-d'),
            'Status' => 'Delivered'
        );

        $insert_detail = $this->db->insert('inventory_detail', $insert_array_detail);

        
        $getQty = $this->db->select('Material_Total_Quantity')->where('ID',$id)->get('inventory')->row_array();
        $getPrice = $this->db->select('Material_Total_Price')->where('ID',$id)->get('inventory')->row_array();

        $total_quantity = $getQty['Material_Total_Quantity']+ $quantity;
        $total_price = $getPrice['Material_Total_Price'] + $price;

        $cond  = ['ID' => $id];
        $data_update = [
            'Material_Total_Quantity' => $total_quantity,
            'Material_Total_Price' => $total_price,
        ];

        $this->db->where($cond);
        $this->db->update('inventory', $data_update);

        if (!empty($insert_detail)) {
            $this->session->set_flashdata('success', 'Material Updated successfully');
            redirect('SO_STORE/add_inventory');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, try again.');
        }
    }
}
