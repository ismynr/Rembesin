<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_Controller extends CI_Controller{
 
    function __construct(){
        parent::__construct();
        is_logged_in();
        $this->load->helper('url');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index() {
        $data['title'] = "Dashboard";
        $this->load->view("admin/dashboard", $data);
    }
    public function fetch_actifity_log_dashboard(){
        $this->load->model('log_model');
        $fetch_data = $this->log_model->make_datatables_actifityLog_adm();
        $data = array();
        foreach($fetch_data as $row){
            $sub_array = array();
            $sub_array[] = $row->log_time;
            $sub_array[] = $row->log_user;
            $sub_array[] = $row->log_role;
            $sub_array[] = $row->log_tipe;
            $sub_array[] = $row->log_aksi;
            $sub_array[] = $row->log_item;
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->log_model->get_all_data_actifityLog_adm(),
            "recordsFiltered"  => $this->log_model->get_filtered_actifityLog_adm(),
            "data"  =>  $data
        );
        echo json_encode($output);
    }

    //MENU NEW REGIST
    public function list_newRegist(){
    	$data['title'] = "Pendaftaran Baru Perusahaan";
        $this->load->view('admin/new_regist', $data);
    }
    public function fetch_newRegist(){
    	$this->load->model('perusahaan_model');
    	$fetch_data = $this->perusahaan_model->make_datatables_newRegist_adm();
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
            $jmlKaryawan = $this->db->query("SELECT COUNT(*) as jml FROM tb_karyawan WHERE id_perusahaan='".$row->id_perusahaan."'")->row();
            $getUserPerusahaan = getById('tb_user', 'WHERE id_user="'.$row->id_user.'"');
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $row->nama_perusahaan;
            $sub_array[] = $row->no_telepon;
            $sub_array[] = $row->email_perusahaan;
            $sub_array[] = $row->alamat_perusahaan;
            $sub_array[] = '
                <a href="javascript:void(0);" class="btn btn-info infoModalButton btn-saya" data-toggle="modal" data-target="#deleteModal" data-info_id="'.$row->id_perusahaan.'" data-info_nama_perusahaan="'.$row->nama_perusahaan.'" data-info_created_at="'.date("d, M Y H:i:s", strtotime($row->created_at)).'" data-info_updated_at="'.date("d, M Y H:i:s", strtotime($row->updated_at)).'"  data-info_jml_karyawan="'.$jmlKaryawan->jml.'" data-info_logged_at="'.timeAgo($getUserPerusahaan->logged_at).'"><i class="fas fa-info-circle"></i></a>
                <a href="javascript:void(0);" class="btn btn-success acceptModalButton btn-saya" data-toggle="modal" data-accept_id="'.$row->id_perusahaan.'"><i class="fas fa-user-check"></i></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->perusahaan_model->get_all_data_newRegist_adm(),
            "recordsFiltered"  => $this->perusahaan_model->get_filtered_data_newRegist_adm(),
            "data"  =>  $data
        );
        echo json_encode($output);
    }
    function approve_newRegist(){
        $this->form_validation->set_rules('accept_id', 'accept', 'required|trim');
        $id = $this->input->post('accept_id');
        $nama_perusahaan = getItemById('tb_perusahaan', 'id_perusahaan', $id)->nama_perusahaan;
        $this->load->model('perusahaan_model');

        if($this->form_validation->run() == false){
            $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Akun perusahaan gagal diaktifkan</div>');
            $this->list_newRegist();
        }else{
            if($this->perusahaan_model->approve_newRegist_adm($id)  == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Akun perusahaan gagal diaktifkan</div>');
            }else{
                activity_log("perusahaan", "approve", $nama_perusahaan);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Akun perusahaan telah diaktifkan</div>');
            }
            redirect('admin/new_regist');
        }
    }
    
    function delete_newRegist(){
        $this->form_validation->set_rules('del_id', 'delete', 'required|trim');
        $id = $this->input->post('del_id');
        $nama_perusahaan = getItemById('tb_perusahaan', 'id_perusahaan', $id)->nama_perusahaan;
        $this->load->model('perusahaan_model');

        if($this->form_validation->run() == false){
            $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Akun perusahaan gagal dipindahkan ke trash</div>');
            $this->list_newRegist();
        }else{
            if($this->perusahaan_model->deleteTrash_newRegist_adm($id) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Akun perusahaan gagal dipindahkan ke trash</div>');
            }else{
                activity_log("perusahaan", "dipindahkan ke trash", $nama_perusahaan);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Akun perusahaan telah dipindahkan ke trash</div>');    
            }
            redirect('admin/new_regist');
        }
    }

    //MENU DATA PERUSAHAAN
    function list_perusahaan(){
        $data['title'] = "Data Perusahaan";
        $this->load->view('admin/perusahaan', $data);
    }
    function fetch_perusahaan(){
    	$this->load->model('perusahaan_model');
        $fetch_data = $this->perusahaan_model->make_datatables_perusahaan_adm();
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
            $jmlKaryawan = $this->db->query("SELECT COUNT(*) as jml FROM tb_karyawan WHERE id_perusahaan='".$row->id_perusahaan."'")->row();
            $getUserPerusahaan = getById('tb_user', 'WHERE id_user="'.$row->id_user.'"');
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $row->nama_perusahaan;
            $sub_array[] = $row->no_telepon;
            $sub_array[] = $row->email_perusahaan;
            $sub_array[] = $row->alamat_perusahaan;
            $sub_array[] = '
                <a href="javascript:void(0);" class="btn btn-info infoModalButton btn-saya" data-toggle="modal" data-target="#deleteModal" data-info_id="'.$row->id_perusahaan.'" data-info_nama_perusahaan="'.$row->nama_perusahaan.'" data-info_created_at="'.date("d, M Y H:i:s", strtotime($row->created_at)).'" data-info_updated_at="'.date("d, M Y H:i:s", strtotime($row->updated_at)).'"  data-info_jml_karyawan="'.$jmlKaryawan->jml.'" data-info_logged_at="'.timeAgo($getUserPerusahaan->logged_at).'"><i class="fas fa-info-circle"></i></a>
                <a href="javascript:void(0);" class="btn btn-secondary undoModalButton btn-saya" data-toggle="modal" data-undo_id="'.$row->id_perusahaan.'"><i class="fas fa-undo-alt"></i></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->perusahaan_model->get_all_data_perusahaan_adm(),
            "recordsFiltered"  => $this->perusahaan_model->get_filtered_data_perusahaan_adm(),
            "data"  =>  $data
        );
        echo json_encode($output);
    }
    function disapprove_perusahaan(){
        $this->form_validation->set_rules('undo_id', 'undo', 'required|trim');
        $id = $this->input->post('undo_id');
        $nama_perusahaan = getItemById('tb_perusahaan', 'id_perusahaan', $id)->nama_perusahaan;
        $this->load->model('perusahaan_model');

        if($this->form_validation->run() == false){
            $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Akun perusahaan gagal dinonaktifkan</div>');
            $this->list_perusahaan();
        }else{
            if($this->perusahaan_model->disapprove_perusahaan_adm($id) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Akun perusahaan gagal dinonaktifkan</div>');
            }else{
                activity_log("perusahaan", "disapprove", $nama_perusahaan);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Akun perusahaan telah dinonaktifkan</div>');
            }
            redirect('admin/perusahaan');
        }
    }
    function deleteTrash_perusahaan(){
        $this->form_validation->set_rules('delTrash_id', 'delete', 'required|trim');
        $id = $this->input->post('delTrash_id');
        $nama_perusahaan = getItemById('tb_jenis_identitas', 'id_identitas', $id)->jenis_identitas;
        $this->load->model('perusahaan_model');

        if($this->form_validation->run() == false){
            $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Akun perusahaan gagal dipindahkan ke trash</div>');
            $this->list_perusahaan();   
        }else{
            if($this->perusahaan_model->deleteTrash_perusahaan_adm($id) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Akun perusahaan gagal dipindahkan ke trash</div>');
            }else{
                activity_log("perusahaan", "dipindahkan ke trash", $nama_perusahaan);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Akun perusahaan telah dipindahkan ke trash</div>');
            }
            redirect('admin/perusahaan');
        }
    }

    //MENU DATA PERUSAHAAN MASTER DATA Jenis Identitas
    function list_jenisIdentitas(){
        $data['title'] = "Jenis Identitas";
        $this->load->view('admin/master_data/jenis_identitas', $data);
    }
    function fetch_jenisIdentitas(){
        $this->load->model('jenis_identitas_model');
        $fetch_data = $this->jenis_identitas_model->make_datatables_jIdentitas_adm();
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $row->jenis_identitas;
            $sub_array[] = '
                <a href="javascript:void(0);" class="btn btn-success updateModalButton btn-saya" data-toggle="modal" data-update_id="'.$row->id_identitas.'" data-update_jenis="'.$row->jenis_identitas.'"><i class="fas fa-edit"></i></a>
                <a href="javascript:void(0);" class="btn btn-danger deleteModalButton btn-saya" data-toggle="modal" data-del_id="'.$row->id_identitas.'" data-del_jenis="'.$row->jenis_identitas.'"> <i class="fas fa-trash-alt text-white"></i></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->jenis_identitas_model->get_all_data_jIdentitas_adm(),
            "recordsFiltered"  => $this->jenis_identitas_model->get_filtered_jIdentitas_adm(),
            "data"  =>  $data
        );
        echo json_encode($output);
    }
    function add_jenisIdentitas(){
        $this->form_validation->set_rules('jenis_identitas', 'Jenis Identitas', 'required');
        $jenis = $this->input->post('jenis_identitas');
        $this->load->model('jenis_identitas_model');

        if($this->form_validation->run() == false){
            $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Identitas gagal ditambahkan</div>');
            $this->list_jenisIdentitas();
        }else{
            if($this->jenis_identitas_model->add_jIdentitas_adm($jenis) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Identitas gagal ditambahkan</div>');
            }else{
                activity_log("jenis identitas", "tambah data", $jenis);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Identitas berhasil ditambahkan</div>');
            }
            redirect('admin/jenis_identitas');
        }
        
    }
    function update_jenisIdentitas(){
        $this->form_validation->set_rules('id', 'Identitas', 'required|trim');
        $this->form_validation->set_rules('jenis_identitas', 'Jenis Identitas', 'required');
        $id = $this->input->post('id');
        $jenis = $this->input->post('jenis_identitas');
        $this->load->model('jenis_identitas_model');

        if($this->form_validation->run() == false){
            $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Identitas gagal diupdate</div>');
            $this->list_jenisIdentitas();
        }else{
            if($this->jenis_identitas_model->update_jIdentitas_adm($id, $jenis) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Identitas gagal diupdate</div>');
            }else{
                activity_log("jenis identitas", "ubah data", $jenis);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Identitas berhasil diupdate</div>');
            }
            redirect('admin/jenis_identitas');
        }
    }
    function delete_jenisIdentitas(){
        $this->form_validation->set_rules('id', 'Identitas', 'required|trim');
        $id = $this->input->post('id');
        $jenis = getItemById('tb_jenis_identitas', 'id_identitas', $id)->jenis_identitas;
        $this->load->model('jenis_identitas_model');

        if($this->form_validation->run() == false){
            $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Identitas gagal dihapus</div>');
            $this->list_jenisIdentitas();
        }else{
            if($this->jenis_identitas_model->delete_jIdentitas_adm($id) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Identitas gagal dihapus</div>');
            }else{
                activity_log("jenis identitas", "hapus data", $jenis);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Identitas berhasil dihapus</div>');
            }
            redirect('admin/jenis_identitas');
        }
    }

     //MENU DATA PERUSAHAAN MASTER DATA JENIS NOTA
    function list_jenisNota(){
        $data['title'] = "Jenis Nota";
        $this->load->view('admin/master_data/jenis_nota', $data);
    }
    function fetch_jenisNota(){
        $this->load->model('jenis_nota_model');
        $fetch_data = $this->jenis_nota_model->make_datatables_jNota_adm();
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $row->jenis_nota;
            $sub_array[] = $row->deskripsi_nota;
            $sub_array[] = '<a href="'.base_url("assets/document/admin/images").'/'.$row->gambar_nota.'" target="_blank"><img id="img_datatables" alt="Foto Nota" src="'.base_url("assets/document/admin/images").'/'.$row->gambar_nota.'"/></a>';
            $sub_array[] = '
                <a href="javascript:void(0);" class="btn btn-success updateModalButton btn-saya" data-toggle="modal" data-update_id="'.$row->id_nota.'" data-update_jenis="'.$row->jenis_nota.'" data-update_deskripsi="'.$row->deskripsi_nota.'" data-update_gambar="'.$row->gambar_nota.'"><i class="fas fa-edit"></i></a>
                <a href="javascript:void(0);" class="btn btn-danger deleteModalButton btn-saya" data-toggle="modal" data-del_id="'.$row->id_nota.'" data-del_gambar_nota="'.$row->gambar_nota.'"> <i class="fas fa-trash-alt text-white"></i></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->jenis_nota_model->get_all_data_jNota_adm(),
            "recordsFiltered"  => $this->jenis_nota_model->get_filtered_jNota_adm(),
            "data"  =>  $data
        );
        echo json_encode($output);
    }
    function add_jenisNota(){
        $this->form_validation->set_rules('jenis_nota', 'Jenis Nota', 'required|trim');
        $this->form_validation->set_rules('deskripsi_nota', 'Deskripsi Nota', 'required|max_length[70]');

        $config['upload_path']="./assets/document/admin/images/";
        $config['allowed_types']='gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload',$config);
        $this->upload->initialize($config);

        if($this->form_validation->run() == false){
            $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Harap Mengisi data dengan benar!</div>');
           $this->list_jenisNota();
        }else{
            if($this->upload->do_upload('file')){
                $data = array('upload_data' => $this->upload->data());
                $jenis = $this->input->post('jenis_nota');
                $deskripsi = $this->input->post('deskripsi_nota');
                $foto_nota= $data['upload_data']['file_name'];
                $this->load->model('jenis_nota_model');

                if($this->jenis_nota_model->add_jNota_adm($jenis, $deskripsi, $foto_nota) == false){
                    $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Nota gagal ditambahkan</div>');
                }else{
                    activity_log("jenis nota", "tambah data", $jenis);
                    $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Nota berhasil ditambahkan</div>');
                }
            }else{
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! upload photo gagal</div>');
            }
            redirect('admin/jenis_nota');
        }
    }
    function update_jenisNota(){
        $this->load->model('jenis_nota_model');
        $this->form_validation->set_rules('update_id', 'Id', 'required|trim');
        $this->form_validation->set_rules('jenis_nota', 'Jenis Nota', 'required');
        $this->form_validation->set_rules('deskripsi_nota', 'Deskripsi Nota', 'required|max_length[70]');

        $config['upload_path']="./assets/document/admin/images/";
        $config['allowed_types']='gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload',$config);
        $this->upload->initialize($config);

        if($this->form_validation->run() == false){
           $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Harap Mengisi data dengan benar!</div>');
           $this->list_jenisNota();
        }else{
            $id = $this->input->post('update_id');
            $jenis = $this->input->post('jenis_nota');
            $deskripsi = $this->input->post('deskripsi_nota');
            $last_foto_nota = $this->input->post('last_foto_nota');

            if($this->upload->do_upload('file')){
                $data = array('upload_data' => $this->upload->data());
                $foto_nota= $data['upload_data']['file_name'];
                unlink("./assets/document/admin/images/$last_foto_nota");
            }else{
                $foto_nota= $last_foto_nota;
            }
            if($this->jenis_nota_model->update_jNota_adm($id, $jenis, $deskripsi, $foto_nota) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Nota gagal diupdate</div>');
            }else{
                activity_log("jenis nota", "ubah data", $jenis);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Nota berhasil diupdate</div>');
            }
            redirect('admin/jenis_nota');
        }   
    }
    function delete_jenisNota(){
        $this->load->model('jenis_nota_model');
        $this->form_validation->set_rules('id', 'Id', 'required|trim');
        $this->form_validation->set_rules('gambar_nota', 'Gambar Nota', 'required');
        
        if($this->form_validation->run() == false){
            $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed!</div>');
            $this->list_jenisNota();
        }else{
            $id = $this->input->post('id');
            $jenis_nota = getItemById('tb_jenis_nota', 'id_nota', $id)->jenis_nota;
            $gambar_nota = $this->input->post('gambar_nota');

            if($this->jenis_nota_model->delete_jNota_adm($id) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Nota gagal dihapus</div>');
            }else{
                activity_log("jenis nota", "hapus data", $jenis_nota);
                unlink("./assets/document/admin/images/$gambar_nota");
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Nota berhasil dihapus</div>');
            }
            redirect('admin/jenis_nota');
        }
    }

    //MENU JENIS BANK
    function list_jenisBank(){
        $data['title'] = "Jenis Bank";
        $this->load->view('admin/master_data/jenis_bank', $data);
    }
    function fetch_jenisBank(){
        $this->load->model('jenis_bank_model');
        $fetch_data = $this->jenis_bank_model->make_datatables_jBank_adm();
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $row->jenis_bank;
            $sub_array[] = '
                <a href="javascript:void(0);" class="btn btn-success updateModalButton btn-saya" data-toggle="modal" data-update_id="'.$row->id_bank.'" data-update_jenis="'.$row->jenis_bank.'"><i class="fas fa-edit"></i></a>
                <a href="javascript:void(0);" class="btn btn-danger deleteModalButton btn-saya" data-toggle="modal" data-del_id="'.$row->id_bank.'" data-del_jenis="'.$row->jenis_bank.'"> <i class="fas fa-trash-alt text-white"></i></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->jenis_bank_model->get_all_data_jBank_adm(),
            "recordsFiltered"  => $this->jenis_bank_model->get_filtered_jBank_adm(),
            "data"  =>  $data
        );
        echo json_encode($output);
    }
    function add_jenisBank(){
        $this->form_validation->set_rules('jenis_bank', 'Id', 'required');
        $jenis = $this->input->post('jenis_bank');
        $this->load->model('jenis_bank_model');

        if($this->form_validation->run() == false){
            $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Jenis bank gagal ditambahkan</div>');
            $this->list_jenisBank();
        }else{
            if($this->jenis_bank_model->add_jBank_adm($jenis) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Jenis bank gagal ditambahkan</div>');
            }else{
                activity_log("jenis bank", "tambah data", $jenis);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Nota berhasil ditambahkan</div>');
            }
            redirect('admin/jenis_bank');
        }
    }
    function update_jenisBank(){
        $this->load->model('jenis_bank_model');
        $this->form_validation->set_rules('id', 'Id', 'required|trim');
        $this->form_validation->set_rules('jenis_bank', 'Jenis Bank', 'required');
        $id = $this->input->post('id');
        $jenis = $this->input->post('jenis_bank');
        if($this->form_validation->run() == false){
            $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Jenis bank gagal diupdate</div>');
            $this->list_jenisBank();
        }else{
            if($this->jenis_bank_model->update_jBank_adm($id, $jenis) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Jenis bank gagal diupdate</div>');
            }else{
                activity_log("jenis bank", "ubah data", $jenis);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Jenis bank diupdate</div>');
            }
            redirect('admin/jenis_bank');
        }
    }
    function delete_jenisBank(){
        $this->load->model('jenis_bank_model');
        $this->form_validation->set_rules('id', 'Id', 'required|trim');
        $id = $this->input->post('id');
        $jenis_bank = getItemById('tb_jenis_bank', 'id_bank', $id)->jenis_bank;
        if($this->form_validation->run() == false){
            $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Jenis bank gagal dihapus</div>');
            $this->list_jenisBank();
        }else{
            if($this->jenis_bank_model->delete_jBank_adm($id) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Jenis bank gagal dihapus</div>');
            }else{
                activity_log("jenis bank", "hapus data", $jenis_bank);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Jenis bank berhasil dihapus</div>');
            }
            redirect('admin/jenis_bank');
        }
    }

    //MENU DATA PERUSAHAAN YANG MASUK TRASH
    function list_trash(){
        $data['title'] = "Trash Data Perusahaan";
        $this->load->view('admin/trash', $data);
    }
    function fetch_trash(){
    	$this->load->model('perusahaan_model');
        $fetch_data = $this->perusahaan_model->make_datatables_trash_adm();
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $row->nama_perusahaan;
            $sub_array[] = $row->no_telepon;
            $sub_array[] = $row->email_perusahaan;
            $sub_array[] = $row->alamat_perusahaan;
            // $sub_array[] = '
            //     <a href="javascript:void(0);" class="btn btn-success restoreModalButton" data-toggle="modal" data-restore_id="'.$row->id_perusahaan.'"><i class="fas fa-trash-restore-alt"></i></a>
            //     <a href="javascript:void(0);" class="btn btn-danger deleteModalButton" data-toggle="modal" data-del_id="'.$row->id_perusahaan.'"> <i class="fas fa-trash-alt text-white"></i></a>';
            $sub_array[] = '
                <a href="javascript:void(0);" class="btn btn-success restoreModalButton btn-saya" data-toggle="modal" data-restore_id="'.$row->id_perusahaan.'"><i class="fas fa-trash-restore-alt"></i></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->perusahaan_model->get_all_data_trash_adm(),
            "recordsFiltered"  => $this->perusahaan_model->get_filtered_data_trash_adm(),
            "data"  =>  $data
        );
        echo json_encode($output);
    }
    function restore_trash(){
        $this->load->model('perusahaan_model');
        $this->form_validation->set_rules('id', 'Id', 'required|trim');
        $id = $this->input->post('id');
        $nama_perusahaan = getItemById('tb_perusahaan', 'id_perusahaan', $id)->nama_perusahaan;
        if($this->form_validation->run() == false){
            $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Akun perusahaan gagal direstore (dikeluarkan dari trash)</div>');
            $this->list_trash();
        }else{
            if($this->perusahaan_model->restore_trash_adm($id) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Akun perusahaan gagal direstore (dikeluarkan dari trash)</div>');
            }else{
                activity_log("perusahaan", "dikeluarkan dari trash", $nama_perusahaan);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Akun perusahaan telah direstore (dikeluarkan dari trash)</div>');
            }
            redirect('admin/trash');
        }
    }
    function delete_trash(){
        $this->load->model('perusahaan_model');
        $id = $this->input->post('del_id');
        $nama_perusahaan = getItemById('tb_perusahaan', 'id_perusahaan', $id)->nama_perusahaan;
        if($this->form_validation->run() == false){
            $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-dnger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Akun perusahaan gagal dihapus secara permanent</div>');
            $this->list_trash();
        }else{
            if($this->perusahaan_model->delete_trash_adm($id) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-dnger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Akun perusahaan gagal dihapus secara permanent</div>');
            }else{
                activity_log("perusahaan", "dihapus permanent", $nama_perusahaan);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Akun perusahaan berhasil dihapus secara permanent</div>');
            }
            redirect('admin/trash');
        }
    }
    public function ubahProfile(){
        $this->load->model('admin_model');
        $nowDateTime = date('Y-m-d H:i:s');
        $id = $this->session->userdata('id_user');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $this->form_validation->set_rules('nama', 'Nama Admin', 'required|trim');
        $this->form_validation->set_rules('email', 'Email Admin', 'required|trim');
        if($this->form_validation->run() == false){
            $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger 
                alert-dismissible mt-3 alertAutoClose" role="alert">Profil gagal diubah! harap isi data dengan benar</div>');
            $this->index();
        }else{
            if(!$this->admin_model->update_profile_adm($id, $nama, $email, $nowDateTime) == false){
                activity_log("admin", "ubah profil", $nama);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger 
                alert-dismissible mt-3 alertAutoClose" role="alert">Profile gagal diubah!</div>');
            }else{
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success 
                alert-dismissible mt-3 alertAutoClose" role="alert">Profile berhasil diubah!</div>');
            }redirect('admin');
        }   
    }
    public function form_ubahPassword(){
        $data['title'] = "Ubah Password";
        $this->load->view('admin/ubah_password', $data);
    }
    public function ubahPassword(){
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
            $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! isilah data yang sesuai</div>');
            $this->form_ubahPassword();
        }else{
            if(password_verify($passwordLama, $val_user->password)){
                activity_log("admin", "ubah password", "******");
                $this->load->model('user_model');
                if($this->user_model->ubah_passwordKaryawan_adm($id_user, $username, password_hash($passwordBaru, PASSWORD_DEFAULT), $nowDateTime) == false){
                    $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Password gagal diubah</div>');
                }else{
                    $session = ['username' => $username];
                    $this->session->set_userdata($session);
                    $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Password telah diubah</div>');
                }
            }else{
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Success! Password lama tidak sama</div>');
            }
            redirect('admin/password/form');
        }
    }
    public function form_emailKontak(){
        $data['title'] = "Email Kontak";
        $this->load->view('admin/pengaturan/email_kontak', $data);
    }
    public function save_emailKontak(){
        $this->form_validation->set_rules('emailKontak', 'Email', 'required|trim');
        $emailKontak = $this->input->post('emailKontak');
        $data = [
            'EMAIL_KONTAK'=>$emailKontak
        ];

        if($this->form_validation->run() == false){
            $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed!</div>');
            $this->form_emailKontak();
        }else{
            if($this->web_config_model->update_config($data) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Email Kontak gagal diubah</div>'); 
            }else{
                activity_log("web config", "ubah email kontak", $emailKontak);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Email Kontak telah diubah</div>');
            }
            redirect('admin/pengaturan/email_kontak');
        }
    }

    public function form_general(){
        $data['title'] = "Email Kontak";
        $this->load->view('admin/pengaturan/general', $data);
    }
    public function save_general(){
        $this->form_validation->set_rules('nama_website', 'Nama Website', 'required');
        $this->form_validation->set_rules('deskripsi_website', 'Deskripsi Website', 'required');
        $nama_website = $this->input->post('nama_website');
        $deskripsi_website = $this->input->post('deskripsi_website');
        $lastfavicon = $this->input->post('last_favicon');
        $lastlogo = $this->input->post('last_logo');

        $config['upload_path']="./assets/img/web_config/";
        $config['allowed_types']='gif|jpg|png';
        $config['encrypt_name'] = FALSE;
        $this->load->library('upload',$config);
        $this->upload->initialize($config);

        if($this->form_validation->run() == false){
            $this->form_emailKontak();
        }else{
            if($this->upload->do_upload('fileFavicon')){
                $data = array('upload_data' => $this->upload->data());
                $foto_favicon= $data['upload_data']['file_name'];
            }else{
                $foto_favicon= $lastfavicon;
            }
            if($this->upload->do_upload('fileLogo')){
                $data = array('upload_data' => $this->upload->data());
                $foto_logo= $data['upload_data']['file_name'];
            }else{
                $foto_logo= $lastlogo;
            }

            $data = [
                'SITE_NAME'=>$nama_website,
                'DESKRIPSI'=>$deskripsi_website,
                'FAVICON'=>$foto_favicon,
                'LOGO'=>$foto_logo
            ];

            if($this->web_config_model->update_config($data) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Pengaturan gagal diubah</div>'); 
            }else{
                activity_log("web config", "ubah pengaturan general", "");
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Pengaturan telah diubah</div>');
            }
            redirect('admin/pengaturan/general');
        }
    }
}

?>