<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method


*/

$route['chat'] = 'ChatController/index';
$route['send-message'] = 'ChatController/send_text_message';
$route['chat-attachment/upload'] = 'ChatController/send_text_message';
$route['get-chat-history-vendor'] = 'ChatController/get_chat_history_by_vendor';

$route['update-notification'] = 'ChatController/update_notification';
$route['Project_Officer/update-notification'] = 'ChatController/update_notification';
$route['SO_CW/update-notification'] = 'ChatController/update_notification';
$route['SO_STORE/update-notification'] = 'ChatController/update_notification';
$route['SO_RECORD/update-notification'] = 'ChatController/update_notification';

$route['update-activity'] = 'ChatController/update_activity';
$route['Project_Officer/update-activity'] = 'ChatController/update_activity';
$route['SO_CW/update-activity'] = 'ChatController/update_activity';
$route['SO_RECORD/update-activity'] = 'ChatController/update_activity';

$route['SO_RECORD/check-notification'] = 'ChatController/check_notification';
$route['SO_RECORD/check-activity'] = 'ChatController/check_activity';


$route['SO_CW/view_project_progress/update-activity'] = 'ChatController/update_activity';
$route['SO_CW/view_project_progress/update-notification'] = 'ChatController/update_notification';
$route['SO_CW/view_project_progress/check-notification'] = 'ChatController/check_notification';
$route['SO_CW/view_project_progress/check-activity'] = 'ChatController/check_activity';

$route['SO_CW/view_project_schedule/update-activity'] = 'ChatController/update_activity';
$route['SO_CW/view_project_schedule/update-notification'] = 'ChatController/update_notification';
$route['SO_CW/view_project_schedule/check-notification'] = 'ChatController/check_notification';
$route['SO_CW/view_project_schedule/check-activity'] = 'ChatController/check_activity';

$route['Project_Officer/overview/update-activity'] = 'ChatController/update_activity';
$route['Project_Officer/overview/update-notification'] = 'ChatController/update_notification';
$route['Project_Officer/overview/check-activity'] = 'ChatController/check_activity';
$route['Project_Officer/overview/check-notification'] = 'ChatController/check_notification';

$route['Project_Officer/drawing/update-activity'] = 'ChatController/update_activity';
$route['Project_Officer/drawing/update-notification'] = 'ChatController/update_notification';
$route['Project_Officer/drawing/check-activity'] = 'ChatController/check_activity';
$route['Project_Officer/drawing/check-notification'] = 'ChatController/check_notification';

$route['Project_Officer/view_project_ganttchart/update-activity'] = 'ChatController/update_activity';
$route['Project_Officer/view_project_ganttchart/update-notification'] = 'ChatController/update_notification';
$route['Project_Officer/view_project_ganttchart/check-activity'] = 'ChatController/check_activity';
$route['Project_Officer/view_project_ganttchart/check-notification'] = 'ChatController/check_notification';

$route['Project_Officer/bids_evaluation/update-activity'] = 'ChatController/update_activity';
$route['Project_Officer/bids_evaluation/update-notification'] = 'ChatController/update_notification';
$route['Project_Officer/bids_evaluation/check-activity'] = 'ChatController/check_activity';
$route['Project_Officer/bids_evaluation/check-notification'] = 'ChatController/check_notification';

$route['Project_Officer/view_project_breakdown/update-activity'] = 'ChatController/update_activity';
$route['Project_Officer/view_project_breakdown/update-notification'] = 'ChatController/update_notification';
$route['Project_Officer/view_project_breakdown/check-activity'] = 'ChatController/check_activity';
$route['Project_Officer/view_project_breakdown/check-notification'] = 'ChatController/check_notification';

$route['SO_STORE/view_inventory_detail/update-activity'] = 'ChatController/update_activity';
$route['SO_STORE/view_inventory_detail/update-notification'] = 'ChatController/update_notification';
$route['SO_STORE/view_inventory_detail/check-activity'] = 'ChatController/check_activity';
$route['SO_STORE/view_inventory_detail/check-notification'] = 'ChatController/check_notification';

$route['SO_STORE/view_material_detail/update-activity'] = 'ChatController/update_activity';
$route['SO_STORE/view_material_detail/update-notification'] = 'ChatController/update_notification';
$route['SO_STORE/view_material_detail/check-activity'] = 'ChatController/check_activity';
$route['SO_STORE/view_material_detail/check-notification'] = 'ChatController/check_notification';

$route['SO_CW/view_project_breakdown/update-activity'] = 'ChatController/update_activity';
$route['SO_CW/view_project_breakdown/update-notification'] = 'ChatController/update_notification';
$route['SO_CW/view_project_breakdown/check-activity'] = 'ChatController/check_activity';
$route['SO_CW/view_project_breakdown/check-notification'] = 'ChatController/check_notification';

$route['SO_CW/view_project_ganttchart/update-activity'] = 'ChatController/update_activity';
$route['SO_CW/view_project_ganttchart/update-notification'] = 'ChatController/update_notification';
$route['SO_CW/view_project_ganttchart/check-activity'] = 'ChatController/check_activity';
$route['SO_CW/view_project_ganttchart/check-notification'] = 'ChatController/check_notification';

$route['SO_RECORD/show_letter_lists/update-activity'] = 'ChatController/update_activity';
$route['SO_RECORD/show_letter_lists/update-notification'] = 'ChatController/update_notification';
$route['SO_RECORD/show_letter_lists/check-activity'] = 'ChatController/check_activity';
$route['SO_RECORD/show_letter_lists/check-notification'] = 'ChatController/check_notification';

$route['SO_RECORD/view_inventory_detail/update-activity'] = 'ChatController/update_activity';
$route['SO_RECORD/view_inventory_detail/update-notification'] = 'ChatController/update_notification';
$route['SO_RECORD/view_inventory_detail/check-activity'] = 'ChatController/check_activity';
$route['SO_RECORD/view_inventory_detail/check-notification'] = 'ChatController/check_notification';

$route['SO_RECORD/show_bills/update-activity'] = 'ChatController/update_activity';
$route['SO_RECORD/show_bills/update-notification'] = 'ChatController/update_notification';
$route['SO_RECORD/show_bills/check-activity'] = 'ChatController/check_activity';
$route['SO_RECORD/show_bills/check-notification'] = 'ChatController/check_notification';

$route['SO_RECORD/edit_bill/update-activity'] = 'ChatController/update_activity';
$route['SO_RECORD/edit_bill/update-notification'] = 'ChatController/update_notification';
$route['SO_RECORD/edit_bill/check-activity'] = 'ChatController/check_activity';
$route['SO_RECORD/edit_bill/check-notification'] = 'ChatController/check_notification';

$route['SO_RECORD/view_bill/update-activity'] = 'ChatController/update_activity';
$route['SO_RECORD/view_bill/update-notification'] = 'ChatController/update_notification';
$route['SO_RECORD/view_bill/check-activity'] = 'ChatController/check_activity';
$route['SO_RECORD/view_bill/check-notification'] = 'ChatController/check_notification';

$route['SO_RECORD/show_running_bills/update-activity'] = 'ChatController/update_activity';
$route['SO_RECORD/show_running_bills/update-notification'] = 'ChatController/update_notification';
$route['SO_RECORD/show_running_bills/check-activity'] = 'ChatController/check_activity';
$route['SO_RECORD/show_running_bills/check-notification'] = 'ChatController/check_notification';

$route['SO_RECORD/show_running_bill_detail/update-activity'] = 'ChatController/update_activity';
$route['SO_RECORD/show_running_bill_detail/update-notification'] = 'ChatController/update_notification';
$route['SO_RECORD/show_running_bill_detail/check-activity'] = 'ChatController/check_activity';
$route['SO_RECORD/show_running_bill_detail/check-notification'] = 'ChatController/check_notification';

$route['SO_RECORD/add_new_bill/update-activity'] = 'ChatController/update_activity';
$route['SO_RECORD/add_new_bill/update-notification'] = 'ChatController/update_notification';
$route['SO_RECORD/add_new_bill/check-activity'] = 'ChatController/check_activity';
$route['SO_RECORD/add_new_bill/check-notification'] = 'ChatController/check_notification';

$route['SO_RECORD/show_bills_summary/update-activity'] = 'ChatController/update_activity';
$route['SO_RECORD/show_bills_summary/update-notification'] = 'ChatController/update_notification';
$route['SO_RECORD/show_bills_summary/check-activity'] = 'ChatController/check_activity';
$route['SO_RECORD/show_bills_summary/check-notification'] = 'ChatController/check_notification';

$route['SO_RECORD/edit_officer_record/update-activity'] = 'ChatController/update_activity';
$route['SO_RECORD/edit_officer_record/update-notification'] = 'ChatController/update_notification';
$route['SO_RECORD/edit_officer_record/check-activity'] = 'ChatController/check_activity';
$route['SO_RECORD/edit_officer_record/check-notification'] = 'ChatController/check_notification';

$route['SO_STORE/add_inventory/update-activity'] = 'ChatController/update_activity';
$route['SO_STORE/add_inventory/update-notification'] = 'ChatController/update_notification';
$route['SO_STORE/add_inventory/check-activity'] = 'ChatController/check_activity';
$route['SO_STORE/add_inventory/north/check-notification'] = 'ChatController/check_notification';

$route['SO_STORE/add_inventory/north/update-activity'] = 'ChatController/update_activity';
$route['SO_STORE/add_inventory/north/update-notification'] = 'ChatController/update_notification';
$route['SO_STORE/add_inventory/north/check-activity'] = 'ChatController/check_activity';
$route['SO_STORE/add_inventory/north/check-notification'] = 'ChatController/check_notification';

$route['SO_STORE/add_inventory/south/update-activity'] = 'ChatController/update_activity';
$route['SO_STORE/add_inventory/south/update-notification'] = 'ChatController/update_notification';
$route['SO_STORE/add_inventory/south/check-activity'] = 'ChatController/check_activity';
$route['SO_STORE/add_inventory/south/check-notification'] = 'ChatController/check_notification';

$route['SO_STORE/update-activity'] = 'ChatController/update_activity';

$route['check-notification'] = 'ChatController/check_notification';
$route['Project_Officer/check-notification'] = 'ChatController/check_notification';
$route['SO_CW/check-notification'] = 'ChatController/check_notification';
$route['SO_STORE/check-notification'] = 'ChatController/check_notification';

$route['check-activity'] = 'ChatController/check_activity';
$route['Project_Officer/check-activity'] = 'ChatController/check_activity';
$route['SO_CW/check-activity'] = 'ChatController/check_activity';
$route['SO_STORE/check-activity'] = 'ChatController/check_activity';

$route['chat-clear'] = 'ChatController/chat_clear_client_cs';

$route['mission/(:any)']='Mission/mission/$1';
$route['mission']='CO/mission';
$route['get_values/(:any)']='Manager/Get_Values/$1';
$route['show_records/(:any)']='Manager/show_records/$1';
$route['default_controller'] = 'User_Login';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
