<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

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

            if ($acct_type == "SO_STORE" || $acct_type == "admin_super" || $acct_type == "admin_north" || $acct_type == "admin_south") {
                $this->load->view('so_store/dashboard');
            } else {
                $this->load->view('login');
            }
        } else {
            $this->load->view('login');
        }
    }

    public function add_inventory($region = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['inventory_records'] = $this->db->where('region', $this->session->userdata('region'))->get('inventory')->result_array();
            } else {
                $data['inventory_records'] = $this->db->where('region', $region)->get('inventory')->result_array();
            }
            $data['selected_region'] = $region;
            $this->load->view('so_store/inventory', $data);
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
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('inventory_used.region', $this->session->userdata('region'));
            }
            $data['material_detail_records'] = $this->db->get()->result_array();

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['project_data'] = $this->db->where('ID', $id)->where('region', $this->session->userdata('region'))->get('projects')->row_array();
            } else {
                $data['project_data'] = $this->db->where('ID', $id)->get('projects')->row_array();
            }
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
                'region' => $this->session->userdata('region')
            );

            $insert = $this->db->insert('inventory', $insert_array);
            $last_id = $this->db->insert_id();

            $insert_array_detail = array(
                'Material_ID' => $last_id,
                'Quantity' => $quantity,
                'Price' => $price,
                'cost_per_unit' => $per_unit_cost,
                'stock_date' => date('Y-m-d'),
                'Status' => 'Delivered',
                'region' => $this->session->userdata('region')
            );

            $insert_detail = $this->db->insert('inventory_detail', $insert_array_detail);

            if (!empty($insert) && !empty($insert_detail)) {

                $insert_activity = array(
                    'activity_module' => $this->session->userdata('acct_type'),
                    'activity_action' => 'add',
                    'activity_detail' => "An inventory has been added by " . $this->session->userdata('username'),
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
                'status' => 'Delivered',
                'region' => $this->session->userdata('region')
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
        $getQty = $this->db->select('Material_Total_Quantity')->where('ID', $material_id)->where('region', $this->session->userdata('region'))->get('inventory')->row_array();
        $getPrice = $this->db->select('Material_Total_Price')->where('ID', $material_id)->where('region', $this->session->userdata('region'))->get('inventory')->row_array();

        $total_quantity = $getQty['Material_Total_Quantity'] + $material_qty;
        $total_price = $getPrice['Material_Total_Price'] + $material_price;

        $cond  = [
            'ID' => $material_id,
            'region' => $this->session->userdata('region')
        ];
        $data_update = [
            'Material_Total_Quantity' => $total_quantity,
            'Material_Total_Price' => $total_price,
        ];

        $this->db->where($cond);
        $this->db->update('inventory', $data_update);
    }

    public function update_inventory_detail()
    {
        $detail_id = $_POST['material_detail_id'];
        $qty_used = $_POST['qty_used'];
        $price_used = $_POST['price_used'];

        $getQty = $this->db->select('Quantity')->where('ID', $detail_id)->where('region', $this->session->userdata('region'))->get('inventory_detail')->row_array();
        $getPrice = $this->db->select('Price')->where('ID', $detail_id)->where('region', $this->session->userdata('region'))->get('inventory_detail')->row_array();

        $total_quantity = $getQty['Quantity'] - $qty_used;
        $total_price = $getPrice['Price'] - $price_used;

        $cond  = [
            'ID' => $detail_id,
            'region' => $this->session->userdata('region')
        ];
        $data_update = [
            'Quantity' => $total_quantity,
            'Price' => $total_price
        ];

        $this->db->where($cond);
        $this->db->update('inventory_detail', $data_update);
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
            'cost_per_unit' => $per_unit,
            'region' => $this->session->userdata('region')
        );

        $insert_detail = $this->db->insert('inventory_detail', $insert_array_detail);
        
        $this->update_inventory($id, $quantity, $price);

        if (!empty($insert_detail)) {
            $insert_activity = array(
                'activity_module' => $this->session->userdata('acct_type'),
                'activity_action' => 'update',
                'activity_detail' => "An inventory has been updated by " . $this->session->userdata('username'),
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

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $getQty = $this->db->select('Material_Total_Quantity')->where('ID', $id)->where('region', $this->session->userdata('region'))->get('inventory')->row_array();
            } else {
                $getQty = $this->db->select('Material_Total_Quantity')->where('ID', $id)->get('inventory')->row_array();
            }
            echo $getQty['Material_Total_Quantity'];
        }
    }

    public function get_material_price()
    {

        if ($this->session->has_userdata('user_id')) {
            $id = $_POST['material_id'];

            $this->db->select('ID, cost_per_unit, quantity');
            $this->db->from('inventory_detail');
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('region', $this->session->userdata('region'));
            }
            $this->db->where('Material_ID', $id);
            $this->db->order_by('ID', 'asc');

            // $getQty = $this->db->select('cost_per_unit')->where('ID', $id)->where('region',$this->session->userdata('region'))->get('inventory_detail')->row_array();
            $getCostPerUnit = $this->db->get()->result_array();
            // echo $getQty['Material_Total_Quantity'];
            echo json_encode($getCostPerUnit);
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

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['activity_log'] = $this->db->where('region', $this->session->userdata('region'))->get('activity_log')->result_array();
            } else {
                $data['activity_log'] = $this->db->get('activity_log')->result_array();
            }
            $this->load->view('so_store/activity_log', $data);
        }
    }

    public function report_inventory($selected_region = NULL)
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
            $this->db->from('inventory');
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('region', $this->session->userdata('region'));
            } else {
                $this->db->where('region', $selected_region);
            }
            $data['inventory_record'] = $this->db->get()->result_array();

            $html = $this->load->view('SO_STORE/inventory_report', $data, TRUE); //$graph, TRUE);

            $dompdf->loadHtml($html);
            $dompdf->render();

            $output = $dompdf->output();
            $doc_name = 'Inventory Report.pdf';
            file_put_contents($doc_name, $output);
            redirect($doc_name);
            //exit;
        } else {
            $this->load->view('userpanel/login');
        }
    }

    public function report_inventory_used($project_id = NULL)
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

            $this->db->select('iu.delivery_date, iu.Quantity_used, iu.Price, iu.Status ,p.Name,i.Material_Name ');
            $this->db->from('inventory_used iu');
            $this->db->join('projects p', 'iu.Material_used_by_Project = p.ID');
            $this->db->join('inventory i', 'i.ID = iu.material_id');
            $this->db->where('Material_used_by_Project', $project_id);
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('p.region', $this->session->userdata('region'));
            }
            $data['inventory_record'] = $this->db->get()->result_array();

            $this->db->select('Name');
            $this->db->from('projects');
            $this->db->where('ID', $project_id);
            $data['project_name'] = $this->db->get()->row_array();

            $html = $this->load->view('SO_STORE/inventory_used_report', $data, TRUE); //$graph, TRUE);
            $dompdf->loadHtml($html);

            $dompdf->render();

            $output = $dompdf->output();
            $doc_name = 'Inventory Used Report.pdf';
            file_put_contents($doc_name, $output);
            redirect($doc_name);
            //exit;
        } else {
            $this->load->view('userpanel/login');
        }
    }
}
