<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Perusahaan_Controller extends CI_Controller {
    function __construct()
    {
		parent::__construct();
		is_logged_in();
		$this->load->helper('url');
		$this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
        $data['title'] = "Dashboard";
        $this->load->view("perusahaan/dashboard", $data);
	}
    public function fetch_activity_log_dashboard(){
        $this->load->model('log_model');
        $fetch_data = $this->log_model->make_datatables_activityLog_prs();
        $data = array();
        foreach($fetch_data as $row){
            $sub_array = array();
            $sub_array[] = $row->log_time;
            // $sub_array[] = $row->log_user;
            // $sub_array[] = $row->log_role;
            $sub_array[] = $row->log_tipe;
            $sub_array[] = $row->log_aksi;
            $sub_array[] = $row->log_item;
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->log_model->get_all_data_activityLog_prs(),
            "recordsFiltered"  => $this->log_model->get_filtered_activityLog_prs(),
            "data"  =>  $data
        );
        echo json_encode($output);
    }

	public function form_tambahKaryawan(){
        $data['title'] = "Form Tambah Karyawan";
        $this->load->view("perusahaan/tambah_karyawan", $data);
	}

    /*
    | -------------------------------------------------------------------------
    | MENU LIST DATA KARYAWAN
    | -------------------------------------------------------------------------
    */
	function list_dataKaryawan(){
		$data["title"] = "Data Karyawan";
		$this->load->view('perusahaan/data_karyawan', $data);
	}
    function fetch_dataKaryawan(){
    	$this->load->model('karyawan_model');
        $fetch_data = $this->karyawan_model->make_datatables_dataKaryawan_prs();
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
            $getUserKaryawan = getById('tb_user', 'WHERE id_user="'.$row->id_user.'"');
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $row->kode_karyawan;
            $sub_array[] = $row->nama_karyawan;
            $sub_array[] = $row->jk_karyawan;
            $sub_array[] = $row->email_karyawan;
            $sub_array[] = $row->jabatan_karyawan;
            $sub_array[] = $row->alamat_karyawan;
            $sub_array[] = '
                <a href="javascript:void(0);" title="Info karyawan" class="btn btn-info infoModalButton btn-saya" data-toggle="modal" data-target="#detailModal" data-info_id="'.$row->id_karyawan.'" data-info_nama_karyawan="'.$row->nama_karyawan.'" data-info_created_at="'.date("d, M Y H:i:s", strtotime($row->created_at)).'" data-info_updated_at="'.date("d, M Y H:i:s", strtotime($row->updated_at)).'" data-info_username="'.$getUserKaryawan->username.'" data-info_jabatan="'.$row->jabatan_karyawan.'" data-info_jenis_identitas="'.$row->identitas_karyawan.'" data-info_no_identitas="'.$row->no_identitas_karyawan.'" data-info_logged_at="'.timeAgo($getUserKaryawan->logged_at).'"><i class="fas fa-info-circle"></i></a>
                 <a href="javascript:void(0);" title="Hapus karyawan" class="btn btn-danger deleteModalButton btn-saya" data-toggle="modal" data-target="#deleteModal" data-delete_id="'.$row->id_karyawan.'" data-delete_nama_karyawan="'.$row->nama_karyawan.'"> <i class="fas fa-trash-alt text-white"></i></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->karyawan_model->get_all_data_dataKaryawan_prs(),
            "recordsFiltered"  => $this->karyawan_model->get_filtered_data_dataKaryawan_prs(),
            "data"  =>  $data
        );
        echo json_encode($output);
    }
    function add_formTambahKaryawan(){
    	$this->load->model('karyawan_model');

        $this->form_validation->set_rules('nama_karyawan', 'Nama karyawan', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[tb_karyawan.email_karyawan]');
        $this->form_validation->set_rules('alamat', 'Alamat karyawan', 'required|trim');
        $this->form_validation->set_rules('kode_karyawan', 'Kode karyawan', 'required|trim|is_unique[tb_karyawan.kode_karyawan]');
        $this->form_validation->set_rules('jenis_identitas', 'Jenis Identitas', 'required');
        $this->form_validation->set_rules('no_identitas', 'No Identitas', 'required|is_unique[tb_karyawan.no_identitas_karyawan]');
        $this->form_validation->set_rules('username', 'username', 'required|trim|is_unique[tb_user.username]',['is_unique' => 'This username has already registered!']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]', ['matches' => 'Password dont match !', 
            'min_length' => 'Password to sort !']);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password]');

        if($this->form_validation->run() == false){
            $this->form_tambahKaryawan();
        }else{
            if($this->karyawan_model->add_formTambahKaryawan_prs() == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Data karyawan gagal ditambahkan</div>');
                $this->form_tambahKaryawan();
            }else{
                activity_log("karyawan", "tambah data", $this->input->post('nama_karyawan'));
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Saved! Data karyawan telah ditambahkan</div>');
            }
            redirect('perusahaan/form_tambah_karyawan');
        }
    }
    function update_dataKaryawan(){
        $this->load->model('karyawan_model');
        $this->form_validation->set_rules('update_id', 'id', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'Jabatan karyawan', 'required');
        $id = $this->input->post('update_id');
        $jabatan = $this->input->post('jabatan');

        if($this->form_validation->run() == false){
            $this->list_dataKaryawan();
        }else{
            if($this->karyawan_model->update_dataKaryawan_prs($id, $jabatan) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Jabatan Karyawan gagal diubah!</div>');
            }else{
                activity_log("karyawan", "ubah data", $jabatan);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Jabatan Karyawan berhasil diubah!</div>');
            }
            redirect('perusahaan/data_karyawan');
        }
    }
    function delete_dataKaryawan(){
    	$this->load->model('karyawan_model');
        $this->form_validation->set_rules('id', 'id', 'required|trim');
        $id = $this->input->post('id');
        $nama_karyawan = getItemById('tb_karyawan', 'id_karyawan', $id)->nama_karyawan;

        if($this->form_validation->run() == false){
            $this->list_dataKaryawan();
        }else{
            if($this->karyawan_model->delete_dataKaryawan_prs($id) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Data karyawan gagal dihapus!</div>');   
            }else{
                activity_log("karyawan", "hapus data", $nama_karyawan);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Data karyawan berhasil dihapus!</div>');   
            }
            redirect('perusahaan/data_karyawan');
        }
    }
    public function fetch_activity_dataKaryawan(){
        $this->load->model('log_model');
        $fetch_data = $this->log_model->make_datatables_activityLog_dataKaryawan_prs();
        $data = array();
        foreach($fetch_data as $row){
            $sub_array = array();
            $sub_array[] = $row->log_time;
            $sub_array[] = $row->log_user;
            $sub_array[] = $row->log_tipe;
            $sub_array[] = $row->log_aksi;
            $sub_array[] = $row->log_item;
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->log_model->get_all_data_activityLog_dataKaryawan_prs(),
            "recordsFiltered"  => $this->log_model->get_filtered_activityLog_dataKaryawan_prs(),
            "data"  =>  $data
        );
        echo json_encode($output);
    }
    function password_dataKaryawan(){
        $data["title"] = "Reset Password";
        $this->load->view('perusahaan/form_reset_password', $data);
    }
    function reset_password_dataKaryawan(){
        $this->load->model('user_model');
        $username = $this->input->post('username');
        $this->form_validation->set_rules('username', 'username', 'required');
        $getUser = $this->db->get_where("tb_user", ['username'=>$username])->row();
        $getKaryawan = $this->db->get_where("tb_karyawan", ['id_user'=>$getUser->id_user])->row();

        if($this->form_validation->run() == false){
            $this->password_dataKaryawan();
        }else{
            if($this->user_model->reset_passwordKaryawan_prs($username, password_hash($getKaryawan->kode_karyawan, PASSWORD_DEFAULT)) == false){    
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Password gagal direset!</div>');     
            }else{
                activity_log("karyawan", "reset password", "********");
                $this->session->set_flashdata('formPassword', '
                <label for="password">Password Baru</label>
                <input type="text" name="password" class="form-control form-control-user" id="password" value="'.$getKaryawan->kode_karyawan.'" readonly>');
                $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible mt-2" role="alert">Password telah di reset, Silahkahkan login dengan username dan password diatas</div>');    
            }
            $this->password_dataKaryawan();
        }
    }

    /*
    | -------------------------------------------------------------------------
    | MENU KLAIM REMBES
    | -------------------------------------------------------------------------
    */
    function list_klaimRembes(){
        $data['title'] = "Data Klaim Rembes";
        $this->load->view('perusahaan/klaim_rembes', $data);
    }
    function fetch_klaimRembes(){
    	$this->load->model('master_rembes_model');
        $fetch_data = $this->master_rembes_model->make_datatables_klaimRembes_prs();
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
        	$getKaryawan = $this->db->get_where("tb_karyawan", ["id_karyawan" => $row->id_karyawan])->row();
            $getRembes = $this->db->query("SELECT SUM(total_rembes) as total_rembes FROM tb_rembes WHERE id_master_rembes='".$row->id_master_rembes."'")->row();
            $kategori = $getRembes->total_rembes < $row->uang_lumpsum ? 'Nota':'Pengajuan';
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $getRembes->total_rembes < $row->uang_lumpsum ? '<p class="kat-purple">Nota</p>':'<p class="kat-orange">Pengajuan</p>';
            $sub_array[] = $row->nama_kegiatan;
            $sub_array[] = $getKaryawan->nama_karyawan;
            $sub_array[] = number_format($row->uang_lumpsum,0,',','.');
            $sub_array[] = date("d, M Y", strtotime($row->tanggal_kegiatan));
            $sub_array[] = date("d, M Y", strtotime($row->tanggal_selesai));
            $sub_array[] = date("d, M Y", strtotime($row->tanggal_submit));
            $sub_array[] = '
            	<form action="'.site_url('perusahaan/klaim_rembes/list_rembes').'" method="POST" class="d-inline">
            		<input type="hidden" value="'.$row->id_master_rembes.'" name="id"/>
                    <input type="hidden" value="'.$row->uang_lumpsum.'" name="uang_lumpsum"/>
            		<input type="hidden" value="'.$row->nama_kegiatan.'" name="nama_kegiatan"/>
            		<input type="hidden" value="'.date("d, M Y", strtotime($row->tanggal_kegiatan)).'" name="tanggal_kegiatan"/>
                    <input type="hidden" value="'.date("d, M Y", strtotime($row->tanggal_selesai)).'" name="tanggal_selesai"/>
                    <input type="hidden" value="'.date("d, M Y", strtotime($row->tanggal_submit)).'" name="tanggal_submit"/>
                    <input type="hidden" value="'.$getRembes->total_rembes.'" name="total_rembes"/>
                    <input type="hidden" value="'.$getKaryawan->nama_karyawan.'" name="nama_karyawan"/>
                    <input type="hidden" value="'.$kategori.'" name="kategori"/>
                    <input type="hidden" value="'.$row->id_master_rembes.'" name="id_master_rembes"/>
                	<button type="submit" title="List Rembes" class="btn btn-secondary listModalButton btn-saya"> <i class="fas fa-list-alt"></i></button>
                </form>
                <a href="javascript:void(0);" title="Klaim Rembes" class="btn btn-success klaimModalButton btn-saya" data-toggle="modal" data-klaim_id="'.$row->id_master_rembes.'" data-klaim_nama="'.$row->nama_kegiatan.'"><i class="fas fa-check-circle"></i></a>
                <a href="javascript:void(0);" title="Hapus Rembes" class="btn btn-danger deleteModalButton btn-saya" data-toggle="modal" data-delete_id="'.$row->id_master_rembes.'" data-delete_nama="'.$row->nama_kegiatan.'"> <i class="fas fa-trash-alt text-white"></i></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->master_rembes_model->get_all_data_klaimRembes_prs(),
            "recordsFiltered"  => $this->master_rembes_model->get_filtered_data_klaimRembes_prss(),
            "data"  =>  $data
        );
        echo json_encode($output);
    }
    function klaim_klaimRembes(){
        $this->load->model('master_rembes_model');
        $this->form_validation->set_rules('klaim_id', 'id', 'required|trim');
        $id = $this->input->post('klaim_id');
        $nama_kegiatan = getItemById('tb_master_rembes', 'id_master_rembes', $id)->nama_kegiatan;
        
        if($this->form_validation->run() == false){
            $this->list_klaimRembes();
        }else{
            if($this->master_rembes_model->klaim_klaimRembes_prs($id) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert alert-danger alert-dismissible mt-3 alertAutoClose pt-2 pb-2 pl-3 pr-3" role="alert">Failed! data rembes gagal Diklaim</div>');
            }else{
                activity_log("Master Rembes", "klaim rembes", $nama_kegiatan);
                $this->session->set_flashdata('successTopBar', '<div class="alert alert-success alert-dismissible mt-3 alertAutoClose pt-2 pb-2 pl-3 pr-3" role="alert">Claimed! data rembes telah Diklaim</div>');
            }
            redirect('perusahaan/klaim_rembes');
        }
        
    }
    function delete_klaimRembes(){
        $this->load->model('master_rembes_model');
        $this->form_validation->set_rules('delete_id', 'id', 'required|trim');
        $id = $this->input->post('delete_id');
        $nama_kegiatan = getItemById('tb_master_rembes', 'id_master_rembes', $id)->nama_kegiatan;

        if($this->form_validation->run() == false){
            $this->list_klaimRembes();
        }else{
            if($this->master_rembes_model->delete_klaimRembes_prs($id) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert alert-danger alert-dismissible mt-3 alertAutoClose pt-2 pb-2 pl-3 pr-3" role="alert">Failed! data rembes gagal dihapus</div>');
            }else{
                activity_log("Master Rembes", "hapus rembes", $nama_kegiatan);
                $this->session->set_flashdata('successTopBar', '<div class="alert alert-success alert-dismissible mt-3 alertAutoClose pt-2 pb-2 pl-3 pr-3" role="alert">Deleted! data rembes telah dihapus</div>');
            }
            redirect('perusahaan/klaim_rembes');
        }
    }
    /*
    | -------------------------------------------------------------------------
    | LIST REMBES PADA DATA KEGIATAN
    | -------------------------------------------------------------------------
    */
    function list_klaimRembes_sub(){
        $data['title'] = "List Rembes ".$this->input->post('nama_kegiatan');
        $data['id_master_rembes'] = $this->input->post('id');
        $data['nama_kegiatan'] = $this->input->post('nama_kegiatan');
        $data['tanggal_kegiatan'] = $this->input->post('tanggal_kegiatan');
        $data['nama_karyawan'] = $this->input->post('nama_karyawan');
        $data['tanggal_selesai'] = $this->input->post('tanggal_selesai');
        $data['uang_lumpsum'] = $this->input->post('uang_lumpsum');
        $data['tanggal_submit'] = $this->input->post('tanggal_submit');
        $data['total_rembes'] = $this->input->post('total_rembes');
        $data['kategori'] = $this->input->post('kategori');
        $getMr = getItemById('tb_master_rembes', 'id_master_rembes', $this->input->post('id'));
        $data['nama_rekening'] = $getMr->nama_rekening;
        $data['jenis_bank'] = $getMr->jenis_bank;
        $data['no_rekening'] = $getMr->no_rekening;
        $this->load->view('perusahaan/klaim_rembes_sub', $data);
    }
    function fetch_klaimRembes_sub(){
    	$id = $this->input->post('id_master_rembes');
    	$this->load->model('rembes_model');
        $fetch_data = $this->rembes_model->make_datatables_klaimRembes_sub_prs($id);
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $row->nama_rembes;
            $sub_array[] = date("d, M Y", strtotime($row->tanggal_rembes));
            $sub_array[] = number_format($row->total_rembes,0,',','.');
            $sub_array[] = '<a href="'.base_url("assets/document/karyawan/images").'/'.$row->foto_nota.'" target="_blank"><img id="img_datatables" alt="Foto Nota" src="'.base_url("assets/document/karyawan/images").'/'.$row->foto_nota.'"/></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->rembes_model->get_all_data_klaimRembes_sub_prs($id),
            "recordsFiltered"  => $this->rembes_model->get_filtered_data_klaimRembes_sub_prs($id),
            "data"  =>  $data
        );
        echo json_encode($output);
    }

    /*
    | -------------------------------------------------------------------------
    | MENU DATA REMBES
    | -------------------------------------------------------------------------
    */
    function list_dataRembes(){
        $data['title'] = "Data Rembes";
        $this->load->view('perusahaan/data_rembes', $data);
    }
    function fetch_dataRembes(){
    	$this->load->model('master_rembes_model');
        $fetch_data = $this->master_rembes_model->make_datatables_dataRembes_prs();
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
        	$getKaryawan = $this->db->get_where("tb_karyawan", ["id_karyawan" => $row->id_karyawan])->row();
            $getRembes = $this->db->query("SELECT SUM(total_rembes) as total_rembes FROM tb_rembes WHERE id_master_rembes='".$row->id_master_rembes."'")->row();
            $kategori = $getRembes->total_rembes < $row->uang_lumpsum ? 'Nota':'Pengajuan';
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $getRembes->total_rembes < $row->uang_lumpsum ? '<p class="kat-purple">Nota</p>':'<p class="kat-orange">Pengajuan</p>';
            $sub_array[] = $row->nama_kegiatan;
            $sub_array[] = $getKaryawan->nama_karyawan;
            $sub_array[] = number_format($row->uang_lumpsum,0,',','.');
            $sub_array[] = date("d, M Y", strtotime($row->tanggal_kegiatan));
            $sub_array[] = date("d, M Y", strtotime($row->tanggal_selesai));
            $sub_array[] = date("d, M Y", strtotime($row->tanggal_klaim));
            $sub_array[] = '
            	<form action="'.site_url('perusahaan/data_rembes/list_rembes').'" method="POST" class="d-inline">
                    <input type="hidden" value="'.$row->id_master_rembes.'" name="id"/>
                    <input type="hidden" value="'.$row->uang_lumpsum.'" name="uang_lumpsum"/>
                    <input type="hidden" value="'.$row->nama_kegiatan.'" name="nama_kegiatan"/>
                    <input type="hidden" value="'.date("d, M Y", strtotime($row->tanggal_kegiatan)).'" name="tanggal_kegiatan"/>
                    <input type="hidden" value="'.date("d, M Y", strtotime($row->tanggal_selesai)).'" name="tanggal_selesai"/>
                    <input type="hidden" value="'.date("d, M Y", strtotime($row->tanggal_klaim)).'" name="tanggal_klaim"/>
                    <input type="hidden" value="'.date("d, M Y", strtotime($row->tanggal_submit)).'" name="tanggal_submit"/>
                    <input type="hidden" value="'.$getRembes->total_rembes.'" name="total_rembes"/>
                    <input type="hidden" value="'.$getKaryawan->nama_karyawan.'" name="nama_karyawan"/>
                    <input type="hidden" value="'.$kategori.'" name="kategori"/>
                    <input type="hidden" value="'.$row->id_master_rembes.'" name="id_master_rembes"/>
                	<button type="submit" title="List Rembes" class="btn btn-secondary listModalButton btn-saya" data-id='.$row->id_master_rembes.'> <i class="fas fa-list-alt"></i></button>
                </form>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->master_rembes_model->get_all_data_dataRembes_prs(),
            "recordsFiltered"  => $this->master_rembes_model->get_filtered_data_dataRembes_prss(),
            "data"  =>  $data
        );
        echo json_encode($output);
    }
    /*
    | -------------------------------------------------------------------------
    | LIST REMBES PADA DATA KEGIATAN
    | -------------------------------------------------------------------------
    */
    function list_dataRembes_sub(){
    	$data['title'] = "List Rembes ".$this->input->post('nama_kegiatan',true);
        $data['id_master_rembes'] = $this->input->post('id',true);
        $data['nama_kegiatan'] = $this->input->post('nama_kegiatan',true);
        $data['tanggal_kegiatan'] = $this->input->post('tanggal_kegiatan',true);
        $data['nama_karyawan'] = $this->input->post('nama_karyawan',true);
        $data['tanggal_selesai'] = $this->input->post('tanggal_selesai',true);
        $data['uang_lumpsum'] = $this->input->post('uang_lumpsum',true);
        $data['tanggal_submit'] = $this->input->post('tanggal_submit',true);
        $data['tanggal_klaim'] = $this->input->post('tanggal_klaim',true);
        $data['total_rembes'] = $this->input->post('total_rembes',true);
        $data['kategori'] = $this->input->post('kategori',true);
        $getMr = getItemById('tb_master_rembes', 'id_master_rembes', $this->input->post('id'));
        $data['nama_rekening'] = $getMr->nama_rekening;
        $data['jenis_bank'] = $getMr->jenis_bank;
        $data['no_rekening'] = $getMr->no_rekening;
        $this->load->view('perusahaan/data_rembes_sub', $data);
    }
    function fetch_dataRembes_sub(){
    	$id = $this->input->post('id_master_rembes');
    	$this->load->model('rembes_model');
        $fetch_data = $this->rembes_model->make_datatables_klaimRembes_sub_prs($id);
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $row->nama_rembes;
            $sub_array[] = date("d, M Y", strtotime($row->tanggal_rembes));
            $sub_array[] = number_format($row->total_rembes,0,',','.');
            $sub_array[] = '<a href="'.base_url("assets/document/karyawan/images").'/'.$row->foto_nota.'" target="_blank"><img id="img_datatables" alt="Foto Nota" src="'.base_url("assets/document/karyawan/images").'/'.$row->foto_nota.'"/></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->rembes_model->get_all_data_klaimRembes_sub_prs($id),
            "recordsFiltered"  => $this->rembes_model->get_filtered_data_klaimRembes_sub_prs($id),
            "data"  =>  $data
        );
        echo json_encode($output);
    }

     //UBAH PROFILE
    public function ubahProfile(){
        $this->load->model('perusahaan_model');
        $nowDateTime = date('Y-m-d H:i:s');
        $id = $this->session->userdata('id_user');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $no_telepon = $this->input->post('no_telepon');
        $email = $this->input->post('email');
        $this->form_validation->set_rules('nama', 'Nama Karyawan', 'required');
        $this->form_validation->set_rules('alamat', 'Email Karyawan', 'required');
        $this->form_validation->set_rules('no_telepon', 'Alamat Karyawan', 'required|trim');
        $this->form_validation->set_rules('email', 'Alamat Karyawan', 'required|trim');

        if($this->form_validation->run() == false){
            $this->index();
        }else{
            if($this->perusahaan_model->update_profile_prs($id, $nama, $alamat, $no_telepon, $email, $nowDateTime) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger 
                alert-dismissible mt-3 alertAutoClose" role="alert">Profile gagal diubah!</div>');
            }else{
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success 
                alert-dismissible mt-3 alertAutoClose" role="alert">Profile berhasil diubah!</div>');
            }
            redirect('perusahaan');
        }
    }
    //UBAH PASSWORD
    public function form_ubahPassword(){
        $data['title'] = "Ubah Password";
        $this->load->view('perusahaan/ubah_password', $data);
    }
    public function ubahPassword(){
        $this->load->model('user_model');
        $nowDateTime = date('Y-m-d H:i:s');
        $id_user = $this->session->userdata('id_user');
        $username = $this->input->post('username');
        $passwordLama = $this->input->post('password');
        $passwordBaru = $this->input->post('passwordBaru');
        $val_user = $this->db->get_where('tb_user', ['id_user'=>$id_user])->row();
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('passwordBaru', 'Password Lama', 'required|trim|min_length[3]|matches[passwordBaru2]', ['matches' => 'Password dont match !', 'min_length' => 'Password to sort !']);
        $this->form_validation->set_rules('passwordBaru2', 'Password Baru', 'required|trim|min_length[3]|matches[passwordBaru]');

        if($this->form_validation->run() == false){ 
            $this->form_ubahPassword();
        }else{
            if(password_verify($passwordLama, $val_user->password)){
                if($this->user_model->ubah_passwordPerusahaan_prs($id_user, $username, password_hash($passwordBaru, PASSWORD_DEFAULT), $nowDateTime) == false){
                    $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Password gagal diubah</div>');    
                }else{
                    $session = ['username' => $username];
                    $this->session->set_userdata($session);
                    $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Password telah diubah</div>');    
                }
            }else{
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Success! Password lama tidak sama</div>');
            }
            redirect('perusahaan/password/form');
        }
    }


    function list_urgent(){
        $data['title'] = "Urgent Klaim";
        $this->load->view('perusahaan/urgent', $data);
    }
    function fetch_urgent(){
        $this->load->model('master_rembes_model');
        $fetch_data = $this->master_rembes_model->make_datatables_urgent_prs();
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
            $getKaryawan = $this->db->get_where("tb_karyawan", ["id_karyawan" => $row->id_karyawan])->row();
            $getRembes = $this->db->query("SELECT SUM(total_rembes) as total_rembes FROM tb_rembes WHERE id_master_rembes='".$row->id_master_rembes."'")->row();
            $kategori = $getRembes->total_rembes < $row->uang_lumpsum ? 'Nota':'Pengajuan';
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $getRembes->total_rembes < $row->uang_lumpsum ? '<p class="kat-purple">Nota</p>':'<p class="kat-orange">Pengajuan</p>';
            $sub_array[] = $row->nama_kegiatan;
            $sub_array[] = $getKaryawan->nama_karyawan;
            $sub_array[] = number_format($row->uang_lumpsum,0,',','.');
            $sub_array[] = date("d, M Y", strtotime($row->tanggal_kegiatan));
            $sub_array[] = date("d, M Y", strtotime($row->tanggal_selesai));
            $sub_array[] = date("d, M Y", strtotime($row->tanggal_submit));
            $sub_array[] = '
                <form action="'.site_url('perusahaan/urgent/list_rembes').'" method="POST" class="d-inline">
                    <input type="hidden" value="'.$row->id_master_rembes.'" name="id"/>
                    <input type="hidden" value="'.$row->uang_lumpsum.'" name="uang_lumpsum"/>
                    <input type="hidden" value="'.$row->nama_kegiatan.'" name="nama_kegiatan"/>
                    <input type="hidden" value="'.date("d, M Y", strtotime($row->tanggal_kegiatan)).'" name="tanggal_kegiatan"/>
                    <input type="hidden" value="'.date("d, M Y", strtotime($row->tanggal_selesai)).'" name="tanggal_selesai"/>
                    <input type="hidden" value="'.date("d, M Y", strtotime($row->tanggal_submit)).'" name="tanggal_submit"/>
                    <input type="hidden" value="'.$getRembes->total_rembes.'" name="total_rembes"/>
                    <input type="hidden" value="'.$getKaryawan->nama_karyawan.'" name="nama_karyawan"/>
                    <input type="hidden" value="'.$kategori.'" name="kategori"/>
                    <button type="submit" title="List Rembes" class="btn btn-secondary listModalButton btn-saya"> <i class="fas fa-list-alt"></i></button>
                </form>
                <a href="javascript:void(0);" title="Klaim Rembes" class="btn btn-success klaimModalButton btn-saya" data-toggle="modal" data-klaim_id="'.$row->id_master_rembes.'" data-klaim_nama="'.$row->nama_kegiatan.'"><i class="fas fa-check-circle"></i></a>
                <a href="javascript:void(0);" title="Hapus Rembes" class="btn btn-danger deleteModalButton btn-saya" data-toggle="modal" data-delete_id="'.$row->id_master_rembes.'" data-delete_nama="'.$row->nama_kegiatan.'"> <i class="fas fa-trash-alt text-white"></i></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->master_rembes_model->get_all_data_urgent_prs(),
            "recordsFiltered"  => $this->master_rembes_model->get_filtered_data_urgent_prss(),
            "data"  =>  $data
        );
        echo json_encode($output);
    }
    function list_urgent_sub(){
        $data['title'] = "List Rembes ".$this->input->post('nama_kegiatan');
        $data['id_master_rembes'] = $this->input->post('id');
        $data['nama_kegiatan'] = $this->input->post('nama_kegiatan');
        $data['tanggal_kegiatan'] = $this->input->post('tanggal_kegiatan');
        $data['nama_karyawan'] = $this->input->post('nama_karyawan');
        $data['tanggal_selesai'] = $this->input->post('tanggal_selesai');
        $data['uang_lumpsum'] = $this->input->post('uang_lumpsum');
        $data['tanggal_submit'] = $this->input->post('tanggal_submit');
        $data['total_rembes'] = $this->input->post('total_rembes');
        $data['kategori'] = $this->input->post('kategori');
        $getMr = getItemById('tb_master_rembes', 'id_master_rembes', $this->input->post('id'));
        $data['nama_rekening'] = $getMr->nama_rekening;
        $data['jenis_bank'] = $getMr->jenis_bank;
        $data['no_rekening'] = $getMr->no_rekening;
        $this->load->view('perusahaan/urgent_sub', $data);
    }
    function fetch_urgent_sub(){
        $id = $this->input->post('id_master_rembes');
        $this->load->model('rembes_model');
        $fetch_data = $this->rembes_model->make_datatables_klaimRembes_sub_prs($id);
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $row->nama_rembes;
            $sub_array[] = date("d, M Y", strtotime($row->tanggal_rembes));
            $sub_array[] = number_format($row->total_rembes,0,',','.');
            $sub_array[] = '<a href="'.base_url("assets/document/karyawan/images").'/'.$row->foto_nota.'" target="_blank"><img id="img_datatables" alt="Foto Nota" src="'.base_url("assets/document/karyawan/images").'/'.$row->foto_nota.'"/></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->rembes_model->get_all_data_klaimRembes_sub_prs($id),
            "recordsFiltered"  => $this->rembes_model->get_filtered_data_klaimRembes_sub_prs($id),
            "data"  =>  $data
        );
        echo json_encode($output);
    }

    public function report(){
        // load view yang akan digenerate atau diconvert
        // contoh kita akan membuat pdf dari halaman welcome codeigniter\
        // $data['master_rembes']= $this->input->post('id_master_rembes');
        if($this->session->userdata('id_user') == null || $this->input->post('startDate') == null || $this->input->post('endDate') == null){
            redirect('perusahaan/data_rembes');
        }
        $this->load->model('master_rembes_model');
        $data['title'] = "Report Data Rembes";
        $data['fetch'] = $this->master_rembes_model->getAll_byIdUserPerusahaan($this->session->userdata('id_user'), $this->input->post('startDate'), $this->input->post('endDate'));
        $this->load->view('perusahaan/report/report_master_rembes', $data);
        // dapatkan output html
        $paper_size  = 'A4'; //paper size
        $orientation = 'landscape'; //tipe format kertas
        $html = $this->output->get_output();
        // Load/panggil library dompdfnya
        $this->load->library('dompdf_gen');
        // Convert to PDF
        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        //utk menampilkan preview pdf
        $this->dompdf->stream("report_rembes.pdf", array('Attachment' => 0));
        //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
        //$this->dompdf->stream("welcome.pdf");
    }
}



