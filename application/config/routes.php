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
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/
$route['default_controller'] = 'Landing_Controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = true;

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8

/*
| -------------------------------------------------------------------------
| Route Landing Page
| -------------------------------------------------------------------------
*/
$route['auth'] = 'Auth_Controller';
$route['auth/login'] = 'Auth_Controller';
$route['auth/registrasi'] = 'Auth_Controller/registrasi';
$route['blocked'] = 'Auth_Controller/blocked';
$route['auth/logout'] = 'Auth_Controller/logout';
$route['auth/forgot_password'] = 'Auth_Controller/forgotPassword';
$route['auth/resetPassword'] = 'Auth_Controller/resetPassword';
$route['auth/resetPassword/change'] = 'Auth_Controller/changePassword';
$route['contact_us/send'] = 'landing_controller/contact_us';

/*
| -------------------------------------------------------------------------
| Route Admin Page
| -------------------------------------------------------------------------
*/
$route['admin'] = 'Admin_Controller';
//MENU NEW REGIST
$route['admin/new_regist'] = 'Admin_Controller/list_newRegist';
$route['admin/new_regist/fetch'] = 'Admin_Controller/fetch_newRegist';
$route['admin/new_regist/accept'] = 'Admin_Controller/approve_newRegist';
$route['admin/new_regist/delete'] = 'Admin_Controller/delete_newRegist';
//MENU PERUSAHAAN
$route['admin/perusahaan'] = 'Admin_Controller/list_perusahaan';
$route['admin/perusahaan/fetch'] = 'Admin_Controller/fetch_perusahaan';
$route['admin/perusahaan/disapprove'] = 'Admin_Controller/disapprove_perusahaan';
$route['admin/perusahaan/deleteTrash'] = 'Admin_Controller/deleteTrash_perusahaan';
//MENU MASTER DATA
$route['admin/jenis_identitas'] = 'Admin_Controller/list_jenisIdentitas';
$route['admin/jenis_identitas/fetch'] = 'Admin_Controller/fetch_jenisIdentitas';
$route['admin/jenis_identitas/add'] = 'Admin_Controller/add_jenisIdentitas';
$route['admin/jenis_identitas/update'] = 'Admin_Controller/update_jenisIdentitas';
$route['admin/jenis_identitas/delete'] = 'Admin_Controller/delete_jenisIdentitas';
$route['admin/jenis_nota'] = 'Admin_Controller/list_jenisNota';
$route['admin/jenis_nota/fetch'] = 'Admin_Controller/fetch_jenisNota';
$route['admin/jenis_nota/add'] = 'Admin_Controller/add_jenisNota';
$route['admin/jenis_nota/update'] = 'Admin_Controller/update_jenisNota';
$route['admin/jenis_nota/delete'] = 'Admin_Controller/delete_jenisNota';
$route['admin/jenis_bank'] = 'Admin_Controller/list_jenisBank';
$route['admin/jenis_bank/fetch'] = 'Admin_Controller/fetch_jenisBank';
$route['admin/jenis_bank/add'] = 'Admin_Controller/add_jenisBank';
$route['admin/jenis_bank/update'] = 'Admin_Controller/update_jenisBank';
$route['admin/jenis_bank/delete'] = 'Admin_Controller/delete_jenisBank';
//MENU TRASH
$route['admin/trash'] = 'Admin_Controller/list_trash';
$route['admin/trash/fetch'] = 'Admin_Controller/fetch_trash';
$route['admin/trash/delete'] = 'Admin_Controller/delete_trash';
$route['admin/trash/restore'] = 'Admin_Controller/restore_trash';

$route['admin/ubahProfile'] = 'Admin_Controller/ubahProfile';
$route['admin/password/form'] = 'Admin_Controller/form_ubahPassword';
$route['admin/password/update'] = 'Admin_Controller/ubahPassword';
$route['admin/dashboard/actifity_log/fetch'] = 'Admin_Controller/fetch_actifity_log_dashboard';

$route['admin/pengaturan/general'] = 'Admin_Controller/form_general';
$route['admin/pengaturan/general/save'] = 'Admin_Controller/save_general';
$route['admin/pengaturan/email_kontak'] = 'Admin_Controller/form_emailKontak';
$route['admin/pengaturan/email_kontak/save'] = 'Admin_Controller/save_emailKontak';

/*
| -------------------------------------------------------------------------
| Route Perusahaan Page
| -------------------------------------------------------------------------
*/
$route['perusahaan'] = 'Perusahaan_Controller';
//MENU TAMBAH KARYAWAN
$route['perusahaan/form_tambah_karyawan'] = 'Perusahaan_Controller/form_tambahKaryawan';
$route['perusahaan/form_tambah_karyawan/add'] = 'Perusahaan_Controller/add_formTambahKaryawan';
//MENU DATA KARYAWAN
$route['perusahaan/data_karyawan'] = 'Perusahaan_Controller/list_dataKaryawan';
$route['perusahaan/data_karyawan/fetch'] = 'Perusahaan_Controller/fetch_dataKaryawan';
$route['perusahaan/data_karyawan/update'] = 'Perusahaan_Controller/update_dataKaryawan';
$route['perusahaan/data_karyawan/delete'] = 'Perusahaan_Controller/delete_dataKaryawan';
$route['perusahaan/data_karyawan/activity/fetch'] = 'Perusahaan_Controller/fetch_activity_dataKaryawan';
$route['perusahaan/data_karyawan/password'] = 'Perusahaan_Controller/password_dataKaryawan';
$route['perusahaan/data_karyawan/password/reset'] = 'Perusahaan_Controller/reset_password_dataKaryawan';
//MENU DATA KLAIM REMBES
$route['perusahaan/klaim_rembes'] = 'Perusahaan_Controller/list_klaimRembes';
$route['perusahaan/klaim_rembes/fetch'] = 'Perusahaan_Controller/fetch_klaimRembes';
$route['perusahaan/klaim_rembes/klaim'] = 'Perusahaan_Controller/klaim_klaimRembes';
$route['perusahaan/klaim_rembes/delete'] = 'Perusahaan_Controller/delete_klaimRembes';
$route['perusahaan/klaim_rembes/list_rembes'] = 'Perusahaan_Controller/list_klaimRembes_sub';
$route['perusahaan/klaim_rembes/list_rembes/fetch'] = 'Perusahaan_Controller/fetch_klaimRembes_sub';
//MENU DATA REMBES
$route['perusahaan/data_rembes'] = 'Perusahaan_Controller/list_dataRembes';
$route['perusahaan/data_rembes/fetch'] = 'Perusahaan_Controller/fetch_dataRembes';
$route['perusahaan/data_rembes/list_rembes'] = 'Perusahaan_Controller/list_dataRembes_sub';
$route['perusahaan/data_rembes/list_rembes/fetch'] = 'Perusahaan_Controller/fetch_dataRembes_sub';
//MENU URGENT 
$route['perusahaan/urgent'] = 'Perusahaan_Controller/list_urgent';
$route['perusahaan/urgent/fetch'] = 'Perusahaan_Controller/fetch_urgent';
$route['perusahaan/urgent/list_rembes'] = 'Perusahaan_Controller/list_urgent_sub';
$route['perusahaan/urgent/list_rembes/fetch'] = 'Perusahaan_Controller/fetch_urgent_sub';

$route['perusahaan/ubahProfile'] = 'Perusahaan_Controller/ubahProfile';
$route['perusahaan/password/form'] = 'Perusahaan_Controller/form_ubahPassword';
$route['perusahaan/password/update'] = 'Perusahaan_Controller/ubahPassword';

$route['perusahaan/data_rembes/report'] = 'Perusahaan_Controller/report';

$route['perusahaan/dashboard/activity_log/fetch'] = 'Perusahaan_Controller/fetch_activity_log_dashboard';

/*
| -------------------------------------------------------------------------
| Route Karyawan Page
| -------------------------------------------------------------------------
*/
$route['karyawan'] = 'Karyawan_Controller';
//MENU AJUKAN KEGIATAN
$route['karyawan/kegiatan/ajukan'] = 'Karyawan_Controller/form_ajukanKegiatan';
$route['karyawan/kegiatan/add'] = 'Karyawan_Controller/add_ajukanKegiatan';
//MENU DATA KEGIATAN
$route['karyawan/kegiatan'] = 'Karyawan_Controller/list_kegiatan';
$route['karyawan/kegiatan/fetch'] = 'Karyawan_Controller/fetch_kegiatan';
$route['karyawan/kegiatan/update'] = 'Karyawan_Controller/update_kegiatan';
$route['karyawan/kegiatan/delete'] = 'Karyawan_Controller/delete_kegiatan';
$route['karyawan/kegiatan/list_rembes'] = 'Karyawan_Controller/list_kegiatan_sub';
$route['karyawan/kegiatan/list_rembes/fetch'] = 'Karyawan_Controller/fetch_kegiatan_sub';
$route['karyawan/kegiatan/list_rembes/update'] = 'Karyawan_Controller/update_kegiatan_sub';
$route['karyawan/kegiatan/list_rembes/delete'] = 'Karyawan_Controller/delete_kegiatan_sub';
//MENU NOTA REMBES
$route['karyawan/rembes'] = 'Karyawan_Controller/list_notaRembes';
$route['karyawan/rembes/add'] = 'Karyawan_Controller/add_notaRembes';
$route['karyawan/rembes/fetch'] = 'Karyawan_Controller/fetch_notaRembes';
$route['karyawan/rembes/update'] = 'Karyawan_Controller/update_notaRembes';
$route['karyawan/rembes/delete'] = 'Karyawan_Controller/delete_notaRembes';
//LAPORAN DATA REMBESIN
$route['karyawan/lap_dataRembes/list_rembes'] = 'Karyawan_Controller/list_lapDataRembes_sub';
$route['karyawan/lap_dataRembes/list_rembes/fetch'] = 'Karyawan_Controller/fetch_lapDataRembes_sub';
//LAPORAN DATA REMBESIN
$route['karyawan/lap_dataRembes/unclaimed'] = 'Karyawan_Controller/list_lapDataRembes_unclaimed';
$route['karyawan/lap_dataRembes/unclaimed/fetch'] = 'Karyawan_Controller/fetch_lapDataRembes_unclaimed';
$route['karyawan/lap_dataRembes/unclaimed/submit'] = 'Karyawan_Controller/submit_lapDataRembes_unclaimed';
$route['karyawan/lap_dataRembes/unclaimed/cancel_submit'] = 'Karyawan_Controller/cancelSubmit_lapDataRembes_unclaimed';
$route['karyawan/lap_dataRembes/unclaimed/list_rembes'] = 'Karyawan_Controller/list_lapDataRembes_unclaimed_sub';
$route['karyawan/lap_dataRembes/unclaimed/list_rembes/fetch'] = 'Karyawan_Controller/fetch_lapDataRembes_unclaimed_sub';
$route['karyawan/lap_dataRembes/claimed'] = 'Karyawan_Controller/list_lapDataRembes_claimed';
$route['karyawan/lap_dataRembes/claimed/fetch'] = 'Karyawan_Controller/fetch_lapDataRembes_claimed';
$route['karyawan/lap_dataRembes/claimed/list_rembes'] = 'Karyawan_Controller/list_lapDataRembes_claimed_sub';
$route['karyawan/lap_dataRembes/claimed/list_rembes/fetch'] = 'Karyawan_Controller/fetch_lapDataRembes_claimed_sub';

$route['karyawan/lap_dataRembes/cetak'] = 'Karyawan_Controller/cetak';
$route['karyawan/lap_dataRembes/cetak/preview'] = 'Karyawan_Controller/preview_cetak';

$route['karyawan/ubahProfile'] = 'Karyawan_Controller/ubahProfile';
$route['karyawan/password/form'] = 'Karyawan_Controller/form_ubahPassword';
$route['karyawan/password/update'] = 'Karyawan_Controller/ubahPassword';

$route['karyawan/dashboard/activity_log/fetch'] = 'Karyawan_Controller/fetch_activity_log_dashboard';

/*
| -------------------------------------------------------------------------
| API
| -------------------------------------------------------------------------
*/
$route['api/karyawan'] = 'Api_Controller';