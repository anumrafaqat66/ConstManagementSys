<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class SO_CW extends CI_Controller
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

            if ($acct_type == "SO_CW" || $acct_type == "admin_super" || $acct_type == "admin_north" || $acct_type == "admin_south") {
                $this->view_projects();
            } else {
                $this->load->view('login');
            }
        } else {
            $this->load->view('login');
        }
    }

    public function view_project_schedule($project_id = NULL)

    {
        if ($this->session->has_userdata('user_id')) {
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['project_schedule'] = $this->db->where('project_id', $project_id)->where('region', $this->session->userdata('region'))->get('project_schedule')->result_array();
            } else {
                $data['project_schedule'] = $this->db->where('project_id', $project_id)->get('project_schedule')->result_array();
            }

            $data['project_id'] = $project_id;
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['project_records'] = $this->db->where('ID', $project_id)->where('region', $this->session->userdata('region'))->get('projects')->row_array();
            } else {
                $data['project_records'] = $this->db->where('ID', $project_id)->get('projects')->row_array();
            }
            $this->load->view('so_cw/project_schedule', $data);
        }
    }

    public function report_project_schedule($project_id = null)
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
            $this->db->from('project_schedule');
            $this->db->where('project_id', $project_id);
            // $this->db->where('Created_by', $this->session->userdata('username'));
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('region', $this->session->userdata('region'));
            }
            $data['project_schedule'] = $this->db->get()->result_array();

            $data['project_name'] = $this->db->where('ID', $project_id)->get('projects')->row_array();

            $html = $this->load->view('SO_CW/project_schedule_report', $data, TRUE); //$graph, TRUE);

            $dompdf->loadHtml($html);
            $dompdf->render();

            $output = $dompdf->output();
            $doc_name = 'Project Schedule Report.pdf';
            file_put_contents($doc_name, $output);
            redirect($doc_name);
            //exit;
        } else {
            $this->load->view('userpanel/login');
        }
    }

    public function view_project_progress($project_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {

            $this->db->select('pp.*,ps.schedule_name, ps.schedule_start_date, ps.schedule_end_date');
            $this->db->from('project_progress pp');
            $this->db->join('project_schedule ps', 'pp.task_id = ps.id');
            $this->db->where('pp.project_id = ps.project_id');
            $this->db->where('pp.project_id', $project_id);
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('pp.region', $this->session->userdata('region'));
            }

            $data['project_progress'] = $this->db->get()->result_array();
            $data['project_id'] = $project_id;
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $data['project_records'] = $this->db->where('region', $this->session->userdata('region'))->where('ID', $project_id)->get('projects')->row_array();
            } else {
                $data['project_records'] = $this->db->where('ID', $project_id)->get('projects')->row_array();
            }
            $this->load->view('so_cw/project_progress', $data);
        }
    }


    public function report_project_progress($project_id = null)
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
            $this->db->from('project_progress');
            $this->db->where('project_id', $project_id);
            // $this->db->where('Created_by', $this->session->userdata('username'));
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('region', $this->session->userdata('region'));
            }
            $data['project_progress'] = $this->db->get()->result_array();

            $data['project_name'] = $this->db->where('ID', $project_id)->get('projects')->row_array();

            $html = $this->load->view('so_cw/project_progress_report', $data, TRUE); //$graph, TRUE);

            $dompdf->loadHtml($html);
            $dompdf->render();

            $output = $dompdf->output();
            $doc_name = 'Project Progress Report.pdf';
            file_put_contents($doc_name, $output);
            redirect($doc_name);
            //exit;
        } else {
            $this->load->view('userpanel/login');
        }
    }


    public function delete_schedule()
    {
        $id = $_POST['id'];
        $task_name = $_POST['task_name'];

        $this->db->where('ID', $id);
        $this->db->where('region', $this->session->userdata('region'));
        $success = $this->db->delete('project_schedule');

        //Activity Logging
        if (!empty($id)) {
            $insert_activity = array(
                'activity_module' => $this->session->userdata('acct_type'),
                'activity_action' => 'delete',
                'activity_detail' => $this->session->userdata('username') . " deleted a task named: " . $task_name,
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
        }

        echo $success;
    }

    public function delete_progress()
    {
        $id = $_POST['id'];
        $task_id = $_POST['task_id'];
        $task_name = $_POST['task_name'];

        $this->db->where('ID', $id);
        $this->db->where('region', $this->session->userdata('region'));
        $success = $this->db->delete('project_progress');

        $this->db->where('id', $task_id);
        $this->db->where('region', $this->session->userdata('region'));
        $success = $this->db->delete('project_schedule');

        //Activity Logging
        if (!empty($id)) {
            $insert_activity = array(
                'activity_module' => $this->session->userdata('acct_type'),
                'activity_action' => 'delete',
                'activity_detail' => $this->session->userdata('username') . " deleted a project progress named: " . $task_name,
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
        }

        echo $success;
    }

    public function view_projects($project_name = null)
    {
        if ($this->session->has_userdata('user_id')) {
            //$data['project_records'] = $this->db->get('projects')->result_array();
            $data['contractor_name'] = $this->db->get('contractors')->result_array();
            $this->db->select('pb.*,c.*');
            $this->db->from('project_bids pb');
            $this->db->join('contractors c', 'c.ID = pb.contractor_id');
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('pb.region', $this->session->userdata('region'));
            }
            $data['bids'] = $this->db->get()->result_array();

            $this->db->select('p.ID, p.Name, p.Code, p.Start_date, p.Status, sum(progress_percentage) as total_percentage, count(progress_percentage) as total_rows');
            $this->db->from('projects p');
            $this->db->join('project_progress pp', 'p.ID = pp.project_id', 'left');
            $this->db->join('project_schedule ps', 'pp.task_id = ps.id', 'left');
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('p.region', $this->session->userdata('region'));
            }
            $this->db->group_by('p.Name, p.Code, p.Start_date, p.status');
            $data['project_records'] = $this->db->get()->result_array();
            $this->load->view('so_cw/dashboard', $data);
        }
    }

    public function fetch_event()
    {
        $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : "";
        $eventArray = array();
        if ($this->session->userdata('acct_type') != 'admin_super') {
            $eventArray = $this->db->select('schedule_name as title, schedule_start_date as start, schedule_end_date as end')->where('project_id', $project_id)->where('region', $this->session->userdata('region'))->get('project_schedule')->result_array();
        } else {
            $eventArray = $this->db->select('schedule_name as title, schedule_start_date as start, schedule_end_date as end')->where('project_id', $project_id)->get('project_schedule')->result_array();
        }
        //print_r($eventArray);
        echo json_encode($eventArray);
    }

    public function add_event()
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $title = isset($_POST['title']) ? $_POST['title'] : "";
            $start = isset($_POST['start']) ? $_POST['start'] : "";
            $end = isset($_POST['end']) ? $_POST['end'] : "";
            $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : "";
            $desc = $postData['desc'];

            $insert_array = array(
                'project_id' => $project_id,
                'schedule_date' => date('y-m-d'),
                'schedule_name' => $title,
                'schedule_description' => $desc,
                'schedule_start_date' => $start,
                'schedule_end_date' => $end,
                'Status' => 'Created',
                'region' => $this->session->userdata('region')
            );

            $insert = $this->db->insert('project_schedule', $insert_array);
            $task_id = $this->db->insert_id();

            $insert_array_progress = array(
                'project_id' => $project_id,
                'task_id' => $task_id,
                'progress_date' => date('y-m-d'),
                'progress_percentage' => 0.00,
                'progress_description' => '',
                'Status' => 'Created',
                'region' => $this->session->userdata('region')
            );
            $insert = $this->db->insert('project_progress', $insert_array_progress);

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $projectdata = $this->db->where('ID', $project_id)->where('region', $this->session->userdata('region'))->get('projects')->row_array();
            } else {
                $projectdata = $this->db->where('ID', $project_id)->get('projects')->row_array();
            }

            // Activity Logging
            if (!empty($project_id)) {
                $insert_activity = array(
                    'activity_module' => $this->session->userdata('acct_type'),
                    'activity_action' => 'add',
                    'activity_detail' => $this->session->userdata('username') . " added a new task '" . $title . "' against Project: " . $projectdata['Name'],
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
            }
        }
    }

    public function insert_schedule($project_id = NULL)
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $schedule_date = $postData['schedule_date'];
            $schedule_name = $postData['schedule_name'];
            $start_date = $postData['start_date'];
            $end_date = $postData['end_date'];
            $desc = $postData['desc'];

            $insert_array = array(
                'project_id' => $project_id,
                'schedule_date' => $schedule_date,
                'schedule_name' => $schedule_name,
                'schedule_description' => $desc,
                'schedule_start_date' => $start_date,
                'schedule_end_date' => $end_date,
                'Status' => 'Created',
                'region' => $this->session->userdata('region')
            );

            $insert = $this->db->insert('project_schedule', $insert_array);

            if (!empty($insert)) {
                $this->session->set_flashdata('success', 'Project Task Created successfully');
                redirect('SO_CW/view_project_schedule/' . $project_id);
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('Project_Officer');
        }
    }


    public function insert_progress($project_id = NULL)
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $progress_percentage = $postData['progress_percentage'];
            $desc = $postData['desc'];
            $task_id = $postData['task_id'];
            $task_name = $postData['task_name_insert'];

            $insert_array = array(
                'project_id' => $project_id,
                'task_id' => $task_id,
                'progress_date' => date('y-m-d'),
                'progress_percentage' => $progress_percentage,
                'progress_description' => $desc,
                'Status' => 'Created',
                'region' => $this->session->userdata('region')
            );

            $insert = $this->db->insert('project_progress', $insert_array);

            $projectdata = $this->db->where('ID', $project_id)->get('projects')->row_array();

            //Activity Logging
            if (!empty($project_id)) {
                $insert_activity = array(
                    'activity_module' => $this->session->userdata('acct_type'),
                    'activity_action' => 'add',
                    'activity_detail' => $this->session->userdata('username') . " updated progress of task '" . $task_name . "' of project " . $projectdata['Name'],
                    'activity_by' => $this->session->userdata('username'),
                    'activity_date' => date('Y-m-d H:i:s'),
                    'region' => $this->session->userdata('region')
                );

                $insert = $this->db->insert('activity_log', $insert_activity);
                $last_id = $this->db->insert_id();
                $query = $this->db->where('username !=', $this->session->userdata('username'))->where('region', $this->session->userdata('region'))->get('security_info')->result_array();

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
            }

            if (!empty($insert)) {
                $this->session->set_flashdata('success', 'Project progress added successfully');
                redirect('SO_CW/view_project_progress/' . $project_id);
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('Project_Officer');
        }
    }

    public function update_schedule($project_id = NULL)
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $schedule_id = $postData['schedule_id'];
            // $schedule_date = $postData['schedule_date'];
            $schedule_name = $postData['schedule_name'];
            $start_date = $postData['start_date'];
            $end_date = $postData['end_date'];
            $desc = $postData['desc_update'];

            $cond  = [
                'id' => $schedule_id,
                'project_id' => $project_id,
                'region' => $this->session->userdata('region')
            ];

            $data_update = [
                'schedule_name' => $schedule_name,
                'schedule_start_date' => $start_date,
                'schedule_end_date' => $end_date,
                'schedule_description	' => $desc,
            ];

            $this->db->where($cond);
            $update = $this->db->update('project_schedule', $data_update);

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $projectdata = $this->db->where('ID', $project_id)->where('region', $this->session->userdata('region'))->get('projects')->row_array();
            } else {
                $projectdata = $this->db->where('ID', $project_id)->get('projects')->row_array();
            }

            //Activity Logging
            if (!empty($project_id)) {
                $insert_activity = array(
                    'activity_module' => $this->session->userdata('acct_type'),
                    'activity_action' => 'update',
                    'activity_detail' => $this->session->userdata('username') . " updated a task: " . $schedule_name . " of Project: " . $projectdata['Name'],
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
            }

            if (!empty($update)) {
                $this->session->set_flashdata('success', 'Task updated successfully');
                redirect('SO_CW/view_project_schedule/' . $project_id);
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('SO_CW');
        }
    }

    public function update_progress($project_id = NULL)
    {
        if ($this->input->post()) {
            $postData = $this->security->xss_clean($this->input->post());

            $progress_id = $postData['progress_id_update'];
            $progress_percentage = $postData['progress_percentage_update'];
            $desc = $postData['desc_update'];

            $cond  = [
                'id' => $progress_id,
                'project_id' => $project_id,
                'region' => $this->session->userdata('region')
            ];

            $status = '';
            if ($progress_percentage == 100) {
                $status = 'Completed';
            } else if ($progress_percentage < 100) {
                $status = 'In Progress';
            }

            $data_update = [
                'progress_percentage' => $progress_percentage,
                'progress_description' => $desc,
                'Status' => $status
            ];

            $this->db->where($cond);
            $update = $this->db->update('project_progress', $data_update);

            if ($this->session->userdata('acct_type') != 'admin_super') {
                $projectdata = $this->db->where('ID', $project_id)->where('region', $this->session->userdata('region'))->get('projects')->row_array();
            } else {
                $projectdata = $this->db->where('ID', $project_id)->get('projects')->row_array();
            }

            //Activity Logging
            if (!empty($project_id)) {
                $insert_activity = array(
                    'activity_module' => $this->session->userdata('acct_type'),
                    'activity_action' => 'add',
                    'activity_detail' => $this->session->userdata('username') . " updated progress of project " . $projectdata['Name'],
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
            }

            if (!empty($update)) {
                $this->session->set_flashdata('success', 'Task updated successfully');
                redirect('SO_CW/view_project_progress/' . $project_id);
            } else {
                $this->session->set_flashdata('failure', 'Something went wrong, try again.');
            }
        } else {
            $this->session->set_flashdata('failure', 'Something went wrong, Try again.');
            redirect('SO_CW');
        }
    }

    public function about()
    {
        if ($this->session->has_userdata('user_id')) {
            $this->load->view('so_cw/about');
        }
    }
    public function services()
    {
        if ($this->session->has_userdata('user_id')) {
            $this->load->view('so_cw/services');
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
            $this->load->view('so_cw/project_breakdown', $data);
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
            $this->load->view('so_cw/project_ganttchart', $data);
        }
    }

    public function view_activity_log()
    {
        if ($this->session->has_userdata('user_id')) {
            $this->db->select('*');
            $this->db->from('activity_log');
            if ($this->session->userdata('acct_type') != 'admin_super') {
                $this->db->where('region', $this->session->userdata('region'));
            }
            $this->db->order_by('activity_date', 'desc');
            $query = $this->db->get();
            $data['activity_log'] = $query->result_array();
            $this->load->view('so_cw/activity_log', $data);
        }
    }
}
