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
$route['default_controller'] = 'landing_controller';
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
$route['auth'] = 'auth_controller';
$route['auth/login'] = 'auth_controller';
$route['auth/registrasi'] = 'auth_controller/registrasi';
$route['blocked'] = 'auth_controller/blocked';
$route['auth/logout'] = 'auth_controller/logout';
$route['auth/forgot_password'] = 'auth_controller/forgotPassword';
$route['auth/resetPassword'] = 'auth_controller/resetPassword';
$route['auth/resetPassword/change'] = 'auth_controller/changePassword';
$route['contact_us/send'] = 'landing_controller/contact_us';

/*
| -------------------------------------------------------------------------
| Route Admin Page
| -------------------------------------------------------------------------
*/
$route['admin'] = 'admin_controller';
//MENU NEW REGIST
$route['admin/new_regist'] = 'admin_controller/list_newRegist';
$route['admin/new_regist/fetch'] = 'admin_controller/fetch_newRegist';
$route['admin/new_regist/accept'] = 'admin_controller/approve_newRegist';
$route['admin/new_regist/delete'] = 'admin_controller/delete_newRegist';
//MENU PERUSAHAAN
$route['admin/perusahaan'] = 'admin_controller/list_perusahaan';
$route['admin/perusahaan/fetch'] = 'admin_controller/fetch_perusahaan';
$route['admin/perusahaan/disapprove'] = 'admin_controller/disapprove_perusahaan';
$route['admin/perusahaan/deleteTrash'] = 'admin_controller/deleteTrash_perusahaan';
//MENU MASTER DATA
$route['admin/jenis_identitas'] = 'admin_controller/list_jenisIdentitas';
$route['admin/jenis_identitas/fetch'] = 'admin_controller/fetch_jenisIdentitas';
$route['admin/jenis_identitas/add'] = 'admin_controller/add_jenisIdentitas';
$route['admin/jenis_identitas/update'] = 'admin_controller/update_jenisIdentitas';
$route['admin/jenis_identitas/delete'] = 'admin_controller/delete_jenisIdentitas';
$route['admin/jenis_nota'] = 'admin_controller/list_jenisNota';
$route['admin/jenis_nota/fetch'] = 'admin_controller/fetch_jenisNota';
$route['admin/jenis_nota/add'] = 'admin_controller/add_jenisNota';
$route['admin/jenis_nota/update'] = 'admin_controller/update_jenisNota';
$route['admin/jenis_nota/delete'] = 'admin_controller/delete_jenisNota';
$route['admin/jenis_bank'] = 'admin_controller/list_jenisBank';
$route['admin/jenis_bank/fetch'] = 'admin_controller/fetch_jenisBank';
$route['admin/jenis_bank/add'] = 'admin_controller/add_jenisBank';
$route['admin/jenis_bank/update'] = 'admin_controller/update_jenisBank';
$route['admin/jenis_bank/delete'] = 'admin_controller/delete_jenisBank';
//MENU TRASH
$route['admin/trash'] = 'admin_controller/list_trash';
$route['admin/trash/fetch'] = 'admin_controller/fetch_trash';
$route['admin/trash/delete'] = 'admin_controller/delete_trash';
$route['admin/trash/restore'] = 'admin_controller/restore_trash';

$route['admin/ubahProfile'] = 'admin_controller/ubahProfile';
$route['admin/password/form'] = 'admin_controller/form_ubahPassword';
$route['admin/password/update'] = 'admin_controller/ubahPassword';
$route['admin/dashboard/actifity_log/fetch'] = 'admin_controller/fetch_actifity_log_dashboard';

$route['admin/pengaturan/general'] = 'admin_controller/form_general';
$route['admin/pengaturan/general/save'] = 'admin_controller/save_general';
$route['admin/pengaturan/email_kontak'] = 'admin_controller/form_emailKontak';
$route['admin/pengaturan/email_kontak/save'] = 'admin_controller/save_emailKontak';

/*
| -------------------------------------------------------------------------
| Route Perusahaan Page
| -------------------------------------------------------------------------
*/
$route['perusahaan'] = 'perusahaan_controller';
//MENU TAMBAH KARYAWAN
$route['perusahaan/form_tambah_karyawan'] = 'perusahaan_controller/form_tambahKaryawan';
$route['perusahaan/form_tambah_karyawan/add'] = 'perusahaan_controller/add_formTambahKaryawan';
//MENU DATA KARYAWAN
$route['perusahaan/data_karyawan'] = 'perusahaan_controller/list_dataKaryawan';
$route['perusahaan/data_karyawan/fetch'] = 'perusahaan_controller/fetch_dataKaryawan';
$route['perusahaan/data_karyawan/update'] = 'perusahaan_controller/update_dataKaryawan';
$route['perusahaan/data_karyawan/delete'] = 'perusahaan_controller/delete_dataKaryawan';
$route['perusahaan/data_karyawan/activity/fetch'] = 'perusahaan_controller/fetch_activity_dataKaryawan';
$route['perusahaan/data_karyawan/password'] = 'perusahaan_controller/password_dataKaryawan';
$route['perusahaan/data_karyawan/password/reset'] = 'perusahaan_controller/reset_password_dataKaryawan';
//MENU DATA KLAIM REMBES
$route['perusahaan/klaim_rembes'] = 'perusahaan_controller/list_klaimRembes';
$route['perusahaan/klaim_rembes/fetch'] = 'perusahaan_controller/fetch_klaimRembes';
$route['perusahaan/klaim_rembes/klaim'] = 'perusahaan_controller/klaim_klaimRembes';
$route['perusahaan/klaim_rembes/delete'] = 'perusahaan_controller/delete_klaimRembes';
$route['perusahaan/klaim_rembes/list_rembes'] = 'perusahaan_controller/list_klaimRembes_sub';
$route['perusahaan/klaim_rembes/list_rembes/fetch'] = 'perusahaan_controller/fetch_klaimRembes_sub';
//MENU DATA REMBES
$route['perusahaan/data_rembes'] = 'perusahaan_controller/list_dataRembes';
$route['perusahaan/data_rembes/fetch'] = 'perusahaan_controller/fetch_dataRembes';
$route['perusahaan/data_rembes/list_rembes'] = 'perusahaan_controller/list_dataRembes_sub';
$route['perusahaan/data_rembes/list_rembes/fetch'] = 'perusahaan_controller/fetch_dataRembes_sub';
//MENU URGENT 
$route['perusahaan/urgent'] = 'perusahaan_controller/list_urgent';
$route['perusahaan/urgent/fetch'] = 'perusahaan_controller/fetch_urgent';
$route['perusahaan/urgent/list_rembes'] = 'perusahaan_controller/list_urgent_sub';
$route['perusahaan/urgent/list_rembes/fetch'] = 'perusahaan_controller/fetch_urgent_sub';

$route['perusahaan/ubahProfile'] = 'perusahaan_controller/ubahProfile';
$route['perusahaan/password/form'] = 'perusahaan_controller/form_ubahPassword';
$route['perusahaan/password/update'] = 'perusahaan_controller/ubahPassword';

$route['perusahaan/data_rembes/report'] = 'perusahaan_controller/report';

$route['perusahaan/dashboard/activity_log/fetch'] = 'perusahaan_controller/fetch_activity_log_dashboard';

/*
| -------------------------------------------------------------------------
| Route Karyawan Page
| -------------------------------------------------------------------------
*/
$route['karyawan'] = 'karyawan_controller';
//MENU AJUKAN KEGIATAN
$route['karyawan/kegiatan/ajukan'] = 'karyawan_controller/form_ajukanKegiatan';
$route['karyawan/kegiatan/add'] = 'karyawan_controller/add_ajukanKegiatan';
//MENU DATA KEGIATAN
$route['karyawan/kegiatan'] = 'karyawan_controller/list_kegiatan';
$route['karyawan/kegiatan/fetch'] = 'karyawan_controller/fetch_kegiatan';
$route['karyawan/kegiatan/update'] = 'karyawan_controller/update_kegiatan';
$route['karyawan/kegiatan/delete'] = 'karyawan_controller/delete_kegiatan';
$route['karyawan/kegiatan/list_rembes'] = 'karyawan_controller/list_kegiatan_sub';
$route['karyawan/kegiatan/list_rembes/fetch'] = 'karyawan_controller/fetch_kegiatan_sub';
$route['karyawan/kegiatan/list_rembes/update'] = 'karyawan_controller/update_kegiatan_sub';
$route['karyawan/kegiatan/list_rembes/delete'] = 'karyawan_controller/delete_kegiatan_sub';
//MENU NOTA REMBES
$route['karyawan/rembes'] = 'karyawan_controller/list_notaRembes';
$route['karyawan/rembes/add'] = 'karyawan_controller/add_notaRembes';
$route['karyawan/rembes/fetch'] = 'karyawan_controller/fetch_notaRembes';
$route['karyawan/rembes/update'] = 'karyawan_controller/update_notaRembes';
$route['karyawan/rembes/delete'] = 'karyawan_controller/delete_notaRembes';
//LAPORAN DATA REMBESIN
$route['karyawan/lap_dataRembes/list_rembes'] = 'karyawan_controller/list_lapDataRembes_sub';
$route['karyawan/lap_dataRembes/list_rembes/fetch'] = 'karyawan_controller/fetch_lapDataRembes_sub';
//LAPORAN DATA REMBESIN
$route['karyawan/lap_dataRembes/unclaimed'] = 'karyawan_controller/list_lapDataRembes_unclaimed';
$route['karyawan/lap_dataRembes/unclaimed/fetch'] = 'karyawan_controller/fetch_lapDataRembes_unclaimed';
$route['karyawan/lap_dataRembes/unclaimed/submit'] = 'karyawan_controller/submit_lapDataRembes_unclaimed';
$route['karyawan/lap_dataRembes/unclaimed/cancel_submit'] = 'karyawan_controller/cancelSubmit_lapDataRembes_unclaimed';
$route['karyawan/lap_dataRembes/unclaimed/list_rembes'] = 'karyawan_controller/list_lapDataRembes_unclaimed_sub';
$route['karyawan/lap_dataRembes/unclaimed/list_rembes/fetch'] = 'karyawan_controller/fetch_lapDataRembes_unclaimed_sub';
$route['karyawan/lap_dataRembes/claimed'] = 'karyawan_controller/list_lapDataRembes_claimed';
$route['karyawan/lap_dataRembes/claimed/fetch'] = 'karyawan_controller/fetch_lapDataRembes_claimed';
$route['karyawan/lap_dataRembes/claimed/list_rembes'] = 'karyawan_controller/list_lapDataRembes_claimed_sub';
$route['karyawan/lap_dataRembes/claimed/list_rembes/fetch'] = 'karyawan_controller/fetch_lapDataRembes_claimed_sub';

$route['karyawan/lap_dataRembes/cetak'] = 'karyawan_controller/cetak';
$route['karyawan/lap_dataRembes/cetak/preview'] = 'karyawan_controller/preview_cetak';

$route['karyawan/ubahProfile'] = 'karyawan_controller/ubahProfile';
$route['karyawan/password/form'] = 'karyawan_controller/form_ubahPassword';
$route['karyawan/password/update'] = 'karyawan_controller/ubahPassword';

$route['karyawan/dashboard/activity_log/fetch'] = 'karyawan_controller/fetch_activity_log_dashboard';

/*
| -------------------------------------------------------------------------
| API
| -------------------------------------------------------------------------
*/
$route['api/karyawan'] = 'api_controller';