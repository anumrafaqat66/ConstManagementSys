<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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

            if ($acct_type == "SO_CW" || $acct_type == "admin") {
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
            $data['project_schedule'] = $this->db->where('project_id', $project_id)->get('project_schedule')->result_array();
            $data['project_id'] = $project_id;
            $data['project_records'] = $this->db->where('ID', $project_id)->get('projects')->row_array();
            $this->load->view('so_cw/project_schedule', $data);
        }
    }

    public function view_project_progress($project_id = NULL)
    {
        if ($this->session->has_userdata('user_id')) {
            
            $this->db->select('pp.*,ps.schedule_name');
            $this->db->from('project_progress pp');
            $this->db->join('project_schedule ps', 'pp.task_id = ps.id');
            $this->db->where('pp.project_id = ps.project_id');
            $this->db->where('pp.project_id', $project_id);

            // $data['project_progress'] = $this->db->where('project_id', $project_id)->get('project_progress')->result_array();
            $data['project_progress'] = $this->db->get()->result_array();
            $data['project_id'] = $project_id;
            $data['project_records'] = $this->db->where('ID', $project_id)->get('projects')->row_array();
            $this->load->view('so_cw/project_progress', $data);
        }
    }

    public function delete_schedule()
    {
        $id = $_POST['id'];
        $this->db->where('ID', $id);
        $success = $this->db->delete('project_schedule');

        //Activity Logging
        if (!empty($id)) {
            $insert_activity = array(
                'activity_module' => $this->session->userdata('acct_type'),
                'activity_action' => 'delete',
                'activity_detail' => $this->session->userdata('username') . " deleted a project schedule",
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
        }

        echo $success;
    }

    public function delete_progress()
    {
        $id = $_POST['id'];
        $this->db->where('ID', $id);
        $success = $this->db->delete('project_progress');

        //Activity Logging
        if (!empty($id)) {
            $insert_activity = array(
                'activity_module' => $this->session->userdata('acct_type'),
                'activity_action' => 'delete',
                'activity_detail' => $this->session->userdata('username') . " deleted a project progress",
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
        }

        echo $success;
    }

    public function view_projects($project_name = null)
    {
        if ($this->session->has_userdata('user_id')) {
            $data['project_records'] = $this->db->get('projects')->result_array();
            $data['contractor_name'] = $this->db->get('contractors')->result_array();
            $this->db->select('pb.*,c.*');
            $this->db->from('project_bids pb');
            $this->db->join('contractors c', 'c.ID = pb.contractor_id');
            $data['bids'] = $this->db->get()->result_array();
            $this->load->view('so_cw/dashboard', $data);
        }
    }

    public function fetch_event()
    {
        $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : "";
        $eventArray = array();
        $eventArray = $this->db->select('schedule_name as title, schedule_start_date as start, schedule_end_date as end')->where('project_id', $project_id)->get('project_schedule')->result_array();
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
                'Status' => 'Created'
            );

            $insert = $this->db->insert('project_schedule', $insert_array);
            $task_id = $this->db->insert_id();

            $insert_array_progress = array(
                'project_id' => $project_id,
                'task_id' => $task_id,
                'progress_date' => date('y-m-d'),
                'progress_percentage' => 0.00,
                'progress_description' => '',
                'Status' => 'Created'
            );
            $insert = $this->db->insert('project_progress', $insert_array_progress);

            // Activity Logging
            if (!empty($project_id)) {
                $insert_activity = array(
                    'activity_module' => $this->session->userdata('acct_type'),
                    'activity_action' => 'add',
                    'activity_detail' => $this->session->userdata('username') . " added a new schedule",
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
                'Status' => 'Created'
            );

            $insert = $this->db->insert('project_schedule', $insert_array);

            if (!empty($insert)) {
                $this->session->set_flashdata('success', 'Project Schedule Created successfully');
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

            $insert_array = array(
                'project_id' => $project_id,
                'task_id' => $task_id,
                'progress_date' => date('y-m-d'),
                'progress_percentage' => $progress_percentage,
                'progress_description' => $desc,
                'Status' => 'Created'
            );

            $insert = $this->db->insert('project_progress', $insert_array);

            $projectdata = $this->db->where('ID',$project_id)->get('projects')->row_array();

             //Activity Logging
             if (!empty($project_id)) {
                $insert_activity = array(
                    'activity_module' => $this->session->userdata('acct_type'),
                    'activity_action' => 'add',
                    'activity_detail' => $this->session->userdata('username') . " updated progress of project ". $projectdata['Name'],
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
                'project_id' => $project_id
            ];

            $data_update = [
                'schedule_name' => $schedule_name,
                'schedule_start_date' => $start_date,
                'schedule_end_date' => $end_date,
                'schedule_description	' => $desc,
            ];            

            $this->db->where($cond);
            $update = $this->db->update('project_schedule', $data_update);

             //Activity Logging
             if (!empty($project_id)) {
                $insert_activity = array(
                    'activity_module' => $this->session->userdata('acct_type'),
                    'activity_action' => 'update',
                    'activity_detail' => $this->session->userdata('username') . " updated a schedule: ". $schedule_name,
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
            }

            if (!empty($update)) {
                $this->session->set_flashdata('success', 'Schedule updated successfully');
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
                'project_id' => $project_id
            ];

            $status = '';
            if ($progress_percentage == 100){
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

            $projectdata = $this->db->where('ID',$project_id)->get('projects')->row_array();

            //Activity Logging
            if (!empty($project_id)) {
                $insert_activity = array(
                    'activity_module' => $this->session->userdata('acct_type'),
                    'activity_action' => 'add',
                    'activity_detail' => $this->session->userdata('username') . " updated progress of project ". $projectdata['Name'],
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
            }

            if (!empty($update)) {
                $this->session->set_flashdata('success', 'Progress updated successfully');
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
}
