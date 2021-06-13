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

    public function project_material()
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $name = $postData['project_name'];
            $date = $postData['delivery_date'];
            $material_id = $postData['material'];
            $quantity = $postData['quantity'];
            $price = $postData['price'];

            //$material=$this->db->where('Material_name',$material_id)->get('inventory')->row_array();
            $project = $this->db->where('Name', $name)->get('projects')->row_array();

            $insert_array = array(
                'Material_id' => $material_id,
                'Material_used_by_Project' => $project['ID'],
                'Quantity_used' => $quantity,
                'price' => $price,
                'delivery_date' => $date,
                'status' => "Delivered"
            );
            //  print_r($insert_array);exit;
            $insert = $this->db->insert('inventory_used', $insert_array);

            //Update Invetory - minus material used
            $this->update_inventory($material_id, -$quantity, -$price);

            if (!empty($insert)) {
                $this->session->set_flashdata('success', 'Data Submitted successfully');
                redirect('SO_STORE/view_projects');
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
                redirect('SO_STORE/view_projects');
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('SO_STORE/view_projects');
        }
    }

    public function update_inventory($material_id = NULL, $material_qty = NULL, $material_price = NULL)
    {
        $getQty = $this->db->select('Material_Total_Quantity')->where('ID', $material_id)->get('inventory')->row_array();
        $getPrice = $this->db->select('Material_Total_Price')->where('ID', $material_id)->get('inventory')->row_array();

        $total_quantity = $getQty['Material_Total_Quantity'] + $material_qty;
        $total_price = $getPrice['Material_Total_Price'] + $material_price;

        $cond  = ['ID' => $material_id];
        $data_update = [
            'Material_Total_Quantity' => $total_quantity,
            'Material_Total_Price' => $total_price,
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

        $this->update_inventory($id, $quantity, $price);
       
        if (!empty($insert_detail)) {
            $this->session->set_flashdata('success', 'Material Updated successfully');
            redirect('SO_STORE/add_inventory');
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, try again.');
        }
    }

    public function get_total_material_available()
    {

        if ($this->session->has_userdata('user_id')) {
            $id = $_POST['material_id'];
            $getQty = $this->db->select('Material_Total_Quantity')->where('ID', $id)->get('inventory')->row_array();
            echo $getQty['Material_Total_Quantity'];
        }
    }
}
