<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Validate Token
$route['auth'] = 'auth/validate_token';


$route['default_controller'] = 'Dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['get_subjects_by_course'] = 'School_institutions/get_subjects_by_course';

/*exam form related*/
// $route['exam_form'] = 'Dashboard/exam_form';
// $route['preview_exam_form/(:any)'] = 'Dashboard/preview_exam_form/$1';
// $route['edit_exam_form/(:any)'] = 'Dashboard/edit_exam_form/$1';
// $route['save_exam_form'] = 'Dashboard/save_exam_form';
// $route['update_exam_form'] = 'Dashboard/update_exam_form';
// $route['success_exam_form/(:any)'] = 'Dashboard/success_exam_form/$1';
// $route['how_to_fill_form'] = 'Dashboard/how_to_fill_form';
// $route['get_admit_card'] = 'Dashboard/get_admit_card';
// $route['get_admit/(:num)'] = 'Dashboard/get_admit/$1';
// $route['get_renewal_form/(:any)'] = 'Dashboard/get_renewal_form/$1';
// $route['get_renewal_form'] = 'Dashboard/get_renewal_form';
// $route['get_admit_course/(:any)/(:any)'] = 'Dashboard/get_admit_course/$1/$2';
// $route['show_admit_card'] = 'Dashboard/show_admit_card';
// $route['submitted_exam_form'] = 'Dashboard/submitted_exam_form';
/*exam form related*/

//$route['view_form/(:any)'] = 'Dashboard/view_form/$1';

// $route['get_old_student_data'] = 'Dashboard/get_old_student_data';
// $route['send_contact_email'] = 'Dashboard/send_contact_email';
// $route['register'] = 'Dashboard/registration';

// $route['affiliation2'] = 'Dashboard/affiliation2';
// $route['inst_login'] = 'Dashboard/inst_login';
// $route['inst_after_login'] = 'Dashboard/inst_after_login';
// $route['inst_result/(:any)'] = 'Dashboard/inst_result/$1';
// $route['renew_affiliation'] = 'Dashboard/renew_affiliation';
// $route['afpdf'] = 'Dashboard/afpdf';
// $route['temp/(:any)'] = 'dashboard/invoice/$1';
// $route['pdf/(:any)'] = 'Dashboard/pdf_gen/$1';
// $route['save_inst'] = 'Dashboard/save_inst';
// $route['login_inst'] = 'Dashboard/login_inst';
// $route['logout_user'] = 'Dashboard/logout_user';
// $route['success_affl'] = 'Dashboard/success_affl';




/*
-----------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
---------------------------------------- Frontend  routes ===============================================
=====================================================================================================
=====================================================================================================
*/

$route['about_us'] = 'Dashboard/about_us';
$route['jnrc_notice'] = 'Dashboard/jnrc_notice';
$route['institution'] = 'Dashboard/institution';
$route['circulars'] = 'Dashboard/circulars';
$route['download'] = 'Dashboard/download';
$route['fees'] = 'Dashboard/fees';
$route['members'] = 'Dashboard/members';
$route['gallery'] = 'Dashboard/gallery';
$route['contact'] = 'Dashboard/contact';

$route['view_result'] = 'Dashboard/view_result';
$route['get_result'] = 'Dashboard/get_result';
$route['show_result'] = 'Dashboard/show_result';

//STUDENT RENEWAL FORM

$route['register_student'] = 'Dashboard/register_student';
$route['admission_student'] = 'Dashboard/admission_student';
$route['old_student'] = 'Dashboard/old_student';
$route['save_student'] = 'Dashboard/save_student';
$route['student_renewal'] = 'Dashboard/student_renewal';
$route['success_renewal/(:any)'] = 'Dashboard/success_renewal/$1';
$route['delete_renewal/(:any)'] = 'Admin/delete_renewal/$1';
$route['save_student_renewal'] = 'Dashboard/save_student_renewal';




/*
-----------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
---------------------------------------- Institutions  routes ===============================================
=====================================================================================================
=====================================================================================================
*/

$route['institution_login'] = 'School_institutions';
$route['institution_verification'] = 'School_institutions/institution_verification';
$route['logout_institution'] = 'School_institutions/logout_institution';
$route['institution_dashboard'] = 'School_institutions/institution_dashboard';


$route['institution_certification_details'] = 'School_institutions/institution_certification_details';

$route['fill_exam_form'] = 'School_institutions/fill_exam_form';
$route['submit_exam_form'] = 'School_institutions/submit_exam_form';
$route['view_exam_form/(:num)'] = 'School_institutions/view_exam_form/$1';
$route['pre_view_exam_form/(:num)'] = 'School_institutions/pre_view_exam_form/$1';
$route['final_update_exam_form'] = 'School_institutions/final_update_exam_form';

$route['all_exam_form_details'] = 'School_institutions/all_exam_form_details';
$route['search_exam_form_details'] = 'School_institutions/search_exam_form_details';

$route['how_to_fill_exam_form_details'] = 'School_institutions/how_to_fill_exam_form_details';


$route['edit_institution_details'] = 'School_institutions/edit_institution_details';
$route['update_institution_details'] = 'School_institutions/update_institution_details';
$route['change_password_institution_details'] = 'School_institutions/change_password_institution_details';
$route['update_password_institution_details'] = 'School_institutions/update_password_institution_details';



// affiliation routes 

$route['new-affiliation-details'] = 'Dashboard/new_affiliation_details';
$route['new-affiliation-form1'] = 'Dashboard/new_affiliation_form1';
$route['form2'] = 'Dashboard/new_affiliation_form2';
$route['form3'] = 'Dashboard/form3';
$route['form4'] = 'Dashboard/form4';
$route['save_affliation_form1'] = 'Dashboard/save_affliation_form1';
$route['affiliation_save_form2'] = 'Dashboard/affiliation_save_form2';
$route['save_form3'] = 'Dashboard/save_form3';
$route['save_form4'] = 'Dashboard/save_form4';
$route['view_institution_renewal_form'] = 'Dashboard/view_institution_renewal_form';
$route['edit_institution_renewal_form'] = 'Dashboard/edit_institution_renewal_form';
$route['update_institution_renewal_details'] = 'Dashboard/update_institution_renewal_details';




/*
-----------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
---------------------------------------- Admin routes ===============================================
=====================================================================================================
=====================================================================================================
*/

//Login routes
$route['adminjnrc'] = 'Login/admin_login';
$route['log'] = 'Login/log';
$route['logout'] = 'Login/logout';
$route['admin'] = 'Admin';

$route['keep_backup'] = 'Admin/keep_backup';

// manage query section...
$route['omprakash_testing'] = 'Admin/omprakash_testing';
$route['om_run_query'] = 'Admin/om_run_query';


// School & College Manage Routes....

$route['college_list'] = 'College/college_list';
$route['save_school'] = 'College/save_school';
$route['edit_school'] = 'College/edit_school';
$route['delete_school/(:num)'] = 'College/delete_school/$1';


// add center
$route['center'] = 'admin/add_center';  // or whatever method you want to map   
$route['save_center'] = 'admin/save_center';
$route['delete_center/(:num)'] = 'admin/delete_center/$1';
$route['update_center/(:num)'] = 'admin/update_center/$1';




// $route['college_list'] = 'College/college_list';
// $route['save_school'] = 'College/save_school';
// $route['edit_school'] = 'College/edit_school';
// $route['delete_school/(:num)'] = 'College/delete_school/$1';

// School & College Renewal Manage Routes....
$route['college_renewal'] = 'College/college_renewal';
$route['update_renewal'] = 'College/update_renewal';

/// Documents Upload routes....

$route['documents'] = 'Manage_Notification/documents';
$route['save_document'] = 'Manage_Notification/save_document';
$route['edit_document'] = 'Manage_Notification/edit_document';
$route['delete_document/(:num)'] = 'Manage_Notification/delete_document/$1';

// manage notification routes...
$route['notification'] = 'Manage_Notification/notification';
$route['save_notification'] = 'Manage_Notification/save_notification';
$route['edit_notification'] = 'Manage_Notification/edit_notification';
$route['delete_notif/(:num)'] = 'Manage_Notification/delete_notif/$1';

// manage Gallery routes...

$route['upload_gallery'] = 'Manage_Notification/upload_gallery';
$route['save_upload_gallery'] = 'Manage_Notification/save_upload_gallery';
$route['delete_gallery/(:num)'] = 'Manage_Notification/delete_gallery/$1';

// manage batch session.....
$route['admin_batch_session'] = 'Admin/admin_batch_session';
$route['update_batch_session'] = 'Admin/update_batch_session';
$route['create_table_session'] = 'Admin/create_table_session';
$route['generate_rollno_session'] = 'Admin/generate_rollno_session';

// manage View All Exam Form......
$route['admin_view_exam_form'] = 'Admin/admin_view_exam_form';
$route['get_admit_course'] = 'Admin/get_admit_course';
$route['fetch_course'] = 'Admin/fetch_course';
$route['fetch_session'] = 'Admin/fetch_session';
$route['admin_view_exam_detail/(:num)'] = 'Admin/admin_view_exam_detail/$1';
$route['edit_admin_exam_form'] = 'Admin/edit_admin_exam_form';
$route['view_roll_no'] = 'Admin/view_roll_no';
$route['resitter_student_details'] = 'Admin/resitter_student_details';
$route['admin_edit_exam_detail/(:num)'] = 'Admin/admin_edit_exam_detail/$1';
$route['admin_final_update_exam_form'] = 'Admin/admin_final_update_exam_form';
// admit card...
$route['get_admit/(:num)'] = 'Admin/get_admit/$1';

/// admin manage results routes.....
$route['upload_result'] = 'Admin/upload_result';
$route['admin_view_result'] = 'Admin/admin_view_result';
$route['admin_search_result'] = 'Admin/admin_search_result';

// admin manage renewal routes

$route['admin_view_renewal'] = 'Admin/admin_view_renewal';
$route['admin_view_registration'] = 'Admin/admin_view_registration';


// Admin Additional  routes...

$route['email'] = 'Admin/email';
$route['search_school'] = 'Admin/search_school';
$route['send_test_email'] = 'Admin/send_test_email';
$route['test_show_all'] = 'Admin/test_show_all';
$route['Pagi'] = 'Admin/Pagi';


//Affiliation routes
$route['save_affil'] = 'Affiliation/save_affil';

?>