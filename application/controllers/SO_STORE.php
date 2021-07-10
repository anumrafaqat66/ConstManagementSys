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

            $this->db->select('id.id, i.Material_Name, id.Quantity, id.Price,i.Unit, id.stock_date, id.Status, id.cost_per_unit');
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
            $per_unit_cost = $postData['per_unit'];

            $insert_array = array(
                'Material_Name' => $material,
                'Material_Total_Quantity' => $quantity,
                'Material_Total_Price' => $price,
                'Unit' => $unit,
                'cost_per_unit' => $per_unit_cost
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

                $insert_activity = array(
                    'activity_module' => $this->session->userdata('acct_type'),
                    'activity_action' => 'add',
                    'activity_detail' => "An inventory has been added by " . $this->session->userdata('username'),
                    'activity_by' => $this->session->userdata('username'),
                    'activity_date' => date('Y-m-d H:i:s')
                );

                $insert = $this->db->insert('activity_log', $insert_activity);
                $last_id = $this->db->insert_id();
                $query = $this->db->where('username !=', $this->session->userdata('username'))->get('security_info')->result_array();

                for ($i = 0; $i < count($query); $i++) {
                    $insert_activity_seen = array(
                        'activity_id' => $last_id,
                        'user_id' => $query[$i]['id'],
                        'seen' => 'no'
                    );
                    $insert = $this->db->insert('activity_log_seen', $insert_activity_seen);
                }

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

                $insert_activity = array(
                    'activity_module' => $this->session->userdata('acct_type'),
                    'activity_action' => 'add',
                    'activity_detail' => "A material has been added by " . $this->session->userdata('username') . " in " . $name,
                    'activity_by' => $this->session->userdata('username'),
                    'activity_date' => date('Y-m-d H:i:s')
                );

                $insert = $this->db->insert('activity_log', $insert_activity);
                $last_id = $this->db->insert_id();
                $query = $this->db->where('username !=', $this->session->userdata('username'))->get('security_info')->result_array();

                for ($i = 0; $i < count($query); $i++) {
                    $insert_activity_seen = array(
                        'activity_id' => $last_id,
                        'user_id' => $query[$i]['id'],
                        'seen' => 'no'
                    );
                    $insert = $this->db->insert('activity_log_seen', $insert_activity_seen);
                }


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
        $per_unit = $_POST['new_per_unit'];

        $insert_array_detail = array(
            'Material_ID' => $id,
            'Quantity' => $quantity,
            'Price' => $price,
            'stock_date' => date('Y-m-d'),
            'Status' => 'Delivered',
            'cost_per_unit' => $per_unit
        );

        $insert_detail = $this->db->insert('inventory_detail', $insert_array_detail);

        $this->update_inventory($id, $quantity, $price);

        if (!empty($insert_detail)) {
            $insert_activity = array(
                'activity_module' => $this->session->userdata('acct_type'),
                'activity_action' => 'update',
                'activity_detail' => "An inventory has been updated by " . $this->session->userdata('username'),
                'activity_by' => $this->session->userdata('username'),
                'activity_date' => date('Y-m-d H:i:s')
            );

            $insert = $this->db->insert('activity_log', $insert_activity);
            $last_id = $this->db->insert_id();
            $query = $this->db->where('username !=', $this->session->userdata('username'))->get('security_info')->result_array();

            for ($i = 0; $i < count($query); $i++) {
                $insert_activity_seen = array(
                    'activity_id' => $last_id,
                    'user_id' => $query[$i]['id'],
                    'seen' => 'no'
                );
                $insert = $this->db->insert('activity_log_seen', $insert_activity_seen);
            }


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

    public function about()
    {
        if ($this->session->has_userdata('user_id')) {
            $this->load->view('so_store/about');
        }
    }
    public function services()
    {
        if ($this->session->has_userdata('user_id')) {
            $this->load->view('so_store/services');
        }
    }

    public function view_activity_log()
    {
        if ($this->session->has_userdata('user_id')) {
            $data['activity_log'] = $this->db->get('activity_log')->result_array();
            $this->load->view('so_store/activity_log', $data);
        }
    }
}
