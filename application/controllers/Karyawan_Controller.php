<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan_Controller extends CI_Controller {

	function __construct(){
        parent::__construct();
        is_logged_in();
        $this->load->helper('url');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

	public function index(){
        $data['title'] = "Dashboard";
		$this->load->view('karyawan/dashboard', $data);
	}
     public function fetch_activity_log_dashboard(){
        $this->load->model('log_model');
        $fetch_data = $this->log_model->make_datatables_activityLog_kry();
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
            "recordsTotal"  => $this->log_model->get_all_data_activityLog_kry(),
            "recordsFiltered"  => $this->log_model->get_filtered_activityLog_kry(),
            "data"  =>  $data
        );
        echo json_encode($output);
    }

/*
| -------------------------------------------------------------------------
| MENU DASHBOARD
| -------------------------------------------------------------------------
*/
	public function form_ajukanKegiatan(){
        $data['title'] = "Form Tambah Kegiatan";
		$this->load->view('karyawan/ajukan_kegiatan',$data);
	}
	public function add_ajukanKegiatan(){
        $this->load->model('master_rembes_model');
        $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required|trim');
        $this->form_validation->set_rules('uang_lumpsum', 'Uang Lumpsum', 'required|trim');
        $this->form_validation->set_rules('tanggal', 'Tanggal Kegiatan', 'required|trim');
        $getKaryawan = getItemById("tb_karyawan","id_user", $this->session->userdata('id_user'));

        $nama_kegiatan = $this->input->post('nama_kegiatan');
        $uang_lumpsum = str_replace(".", "", $this->input->post('uang_lumpsum'));
        $tanggal = $this->input->post('tanggal');
        $id_karyawan = $getKaryawan->id_karyawan;

        if($this->form_validation->run() == false){
            $this->form_ajukanKegiatan();
        }else{
            if($this->master_rembes_model->add_kegiatan_kry($id_karyawan, $nama_kegiatan, $uang_lumpsum, $tanggal) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Data kegiatan gagal ditambahkan!</div>');
            }else{
                activity_log("master rembes", "tambah data", $nama_kegiatan);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Data kegiatan telah ditambahkan!</div>');
            }   
            redirect('karyawan/kegiatan');
        }
        
	}
/*
| -------------------------------------------------------------------------
| MENU KEGIATAN
| -------------------------------------------------------------------------
*/
	function list_kegiatan(){
        $data['title'] = "Data Kegiatan";
        $this->load->view('karyawan/data_kegiatan', $data);
    }
    function fetch_kegiatan(){
    	$this->load->model('master_rembes_model');
        $fetch_data = $this->master_rembes_model->make_datatables_kegiatan_kry();
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
            $countRembes = $this->db->get_where('tb_rembes', ['id_master_rembes'=>$row->id_master_rembes])->num_rows();
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $row->nama_kegiatan;
            $sub_array[] = number_format($row->uang_lumpsum,0,',','.');
            $sub_array[] = date("d M Y", strtotime($row->tanggal_kegiatan));
            $sub_array[] = $countRembes;
            $sub_array[] = '
                <a href="javascript:void(0);" class="btn btn-info addModalButton" data-id="'.$row->id_master_rembes.'" data-nama="'.$row->nama_kegiatan.'" data-toggle="tooltip modal" data-placement="bottom" title="Tambah rembes"><i class="fas fa-plus"></i></a>
                <form action="'.site_url('karyawan/kegiatan/list_rembes').'" method="POST" class="d-inline">
                    <input type="hidden" value="'.$row->nama_kegiatan.'" name="nama_kegiatan"/>
                    <input type="hidden" value="'.$row->id_master_rembes.'" name="id_master_rembes"/>
                    <button type="submit" title="List rembes" class="btn btn-secondary listModalButton"> <i class="fas fa-list-alt"></i></button>
                </form>
                <a href="javascript:void(0);" title="Ubah kegiatan" class="btn btn-success updateModalButton" data-toggle="modal" data-id="'.$row->id_master_rembes.'" data-nama_kegiatan="'.$row->nama_kegiatan.'" data-uang_lumpsum="'.$row->uang_lumpsum.'" data-tanggal_kegiatan="'.$row->tanggal_kegiatan.'"><i class="fas fa-edit"></i></a> 
                <a href="javascript:void(0);" title="Hapus kegiatan" class="btn btn-danger deleteModalButton" data-toggle="modal" data-id="'.$row->id_master_rembes.'" data-nama_kegiatan="'.$row->nama_kegiatan.'"><i class="far fa-trash-alt text-white"></i></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->master_rembes_model->get_all_data_kegiatan_kry(),
            "recordsFiltered"  => $this->master_rembes_model->get_filtered_data_kegiatan_kry(),
            "data"  =>  $data
        );
        echo json_encode($output);
    }
    function update_kegiatan(){
        $this->load->model('master_rembes_model');
        $this->form_validation->set_rules('update_id', 'id', 'required|trim');
        $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
        $this->form_validation->set_rules('uang_lumpsum', 'Uang Lumpsum', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal Kegiatan', 'required');
        $id = $this->input->post('update_id',true);
        $nama_kegiatan = $this->input->post('nama_kegiatan');
        $uang_lumpsum = str_replace(".", "", $this->input->post('uang_lumpsum'));
        $tanggal_kegiatan = $this->input->post('tanggal');

        if($this->form_validation->run() == false){ 
            $this->list_kegiatan();
        }else{
            if($this->master_rembes_model->update_kegiatan_kry($id, $nama_kegiatan, $uang_lumpsum, $tanggal_kegiatan) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-dnger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! kegiatan gagal diubah</div>');    
            }else{
                activity_log("master rembes", "ubah data", $nama_kegiatan);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Updated! kegiatan berhasil diubah</div>');    
            }
            redirect('karyawan/kegiatan');
        }
    }
    function delete_kegiatan(){
    	$this->load->model('master_rembes_model');
        $this->form_validation->set_rules('delete_id', 'id', 'required|trim');
        $id = $this->input->post('delete_id');
        $nama_kegiatan = getItemById("tb_master_rembes","id_master_rembes",$id)->nama_kegiatan;

        if($this->form_validation->run() == false){
            $this->list_kegiatan();
        }else{
            if($this->master_rembes_model->delete_kegiatan_kry($id) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! kegiatan gagal dihapus</div>');
            }else{
                activity_log("master rembes", "hapus data", $nama_kegiatan);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Deleted! kegiatan berhasil dihapus</div>');        
            }
            redirect('karyawan/kegiatan');
        }
    }
    function add_notaRembes(){
        $this->load->model('rembes_model');
        $this->form_validation->set_rules('id_master_rembes', 'id', 'required|trim');
        $this->form_validation->set_rules('kegiatan', 'Nama Kegiatan', 'required');
        $this->form_validation->set_rules('nama_rembes', 'Nama Rembes', 'required');
        $this->form_validation->set_rules('total', 'Total Rembes', 'required');
        $this->form_validation->set_rules('jenis_nota', 'Tanggal Rembes', 'required');

        $config['upload_path']="./assets/document/karyawan/images/";
        $config['allowed_types']='gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload',$config);
        $this->upload->initialize($config);

        if($this->form_validation->run() == false){
            $this->list_kegiatan();
        }else{
            if($this->upload->do_upload('file')){
                $data = array('upload_data' => $this->upload->data());

                $id_master_rembes= $this->input->post('id_master_rembes');
                $nama_rembes= $this->input->post('nama_rembes');
                $total= str_replace(".", "", $this->input->post('total'));
                $jenis_nota= $this->input->post('jenis_nota');
                $foto_nota= $data['upload_data']['file_name']; 
                
                if($this->rembes_model->add_notaRembes_kry($id_master_rembes,$nama_rembes,date('Y-m-d'),$total,$foto_nota,$jenis_nota) == false){
                    $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Data gagal ditambahkan</div>');
                }else{
                    activity_log("nota rembes", "tambah data", $nama_rembes);
                    $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Saved! Data telah ditambahkan</div>');    
                }
            }else{
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Tidak dapat upload file</div>');
            }
            redirect('karyawan/kegiatan');
        }
     }
     function list_kegiatan_sub(){
        if($this->input->post('id_master_rembes') == null){
          redirect('karyawan/kegiatan');
        }
        $data['title'] = "List Rembes Kegiatan '".$this->input->post('nama_kegiatan')."'";
        $data['id_master_rembes'] = $this->input->post('id_master_rembes');
        $this->load->view('karyawan/data_kegiatan_sub', $data);
    }
    function fetch_kegiatan_sub(){
        $id = $this->input->post('id_master_rembes');
        $this->load->model('rembes_model');
        $fetch_data = $this->rembes_model->make_datatables_lapDataRembes_sub_kry($id);
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $row->nama_rembes;
            $sub_array[] = $row->jenis_nota;
            $sub_array[] = date("d M Y", strtotime($row->tanggal_rembes));
            $sub_array[] = number_format($row->total_rembes,0,',','.');
            $sub_array[] = '<a href="'.base_url("assets/document/karyawan/images").'/'.$row->foto_nota.'" target="_blank"><img id="img_datatables" alt="Foto Nota" src="'.base_url("assets/document/karyawan/images").'/'.$row->foto_nota.'"/></a>';
            $sub_array[] = '
                <a href="'.site_url('karyawan/rembes?jn='.$row->jenis_nota).'" class="btn btn-success updateModalButton" data-toggle="modal" data-id="'.$row->id_rembes.'" data-nama="'.$row->nama_rembes.'" data-tanggal="'.$row->tanggal_rembes.'" data-total="'.$row->total_rembes.'" data-jenis_nota="'.$row->jenis_nota.'" data-foto="'.$row->foto_nota.'"><i class="fas fa-edit"></i></a> 
                <a href="javascript:void(0);" class="btn btn-danger deleteModalButton" data-toggle="modal" data-id="'.$row->id_rembes.'" data-nama="'.$row->nama_rembes.'" id="pp"><i class="far fa-trash-alt text-white"></i></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->rembes_model->get_all_data_lapDataRembes_sub_kry($id),
            "recordsFiltered"  => $this->rembes_model->get_filtered_data_lapDataRembes_sub_kry($id),
            "data"  =>  $data
        );
        echo json_encode($output);
    }
    function update_kegiatan_sub(){
        $this->load->model('rembes_model');
        $this->form_validation->set_rules('update_id', 'id', 'required|trim');
        $this->form_validation->set_rules('nama_rembes', 'Nama Rembes', 'required');
        $this->form_validation->set_rules('total_rembes', 'Total Rembes', 'required');
        $this->form_validation->set_rules('jenis_nota', 'Jenis Nota', 'required');

        $config['upload_path']="./assets/document/karyawan/images/";
        $config['allowed_types']='gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload',$config);
        $this->upload->initialize($config);

        if($this->form_validation->run() == false){
           $this->list_kegiatan_sub();
        }else{
            $id_rembes = $this->input->post('update_id');
            $nama_rembes= $this->input->post('nama_rembes');
            $total= str_replace(".", "", $this->input->post('total_rembes'));
            $jenis_nota= $this->input->post('jenis_nota');
            $last_foto_nota = $this->input->post('last_foto_nota');
            
            if($this->upload->do_upload('file')){
                $data = array('upload_data' => $this->upload->data());
                $foto_nota= $data['upload_data']['file_name'];
                unlink("./assets/document/karyawan/images/$last_foto_nota");
            }else{
                $foto_nota= $last_foto_nota;
            }

            if($this->rembes_model->update_notaRembes_kry($id_rembes,$nama_rembes,$total,$foto_nota,$jenis_nota) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Nota gagal diubah</div>');
            }else{
                activity_log("nota rembes", "update data", $nama_rembes);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Saved! Nota telah diubah</div>');
            }
            $this->list_kegiatan_sub();
        }
     }
    function delete_kegiatan_sub(){
        $this->load->model('rembes_model');
        $this->load->model('master_rembes_model');
        $this->form_validation->set_rules('delete_id', 'id', 'required|trim');
        $id = $id_rembes = $this->input->post('delete_id');
        $nama_rembes = getItemById("tb_rembes","id_rembes",$id)->nama_rembes;
        $id_master_rembes = getItemById("tb_rembes","id_rembes",$id)->id_master_rembes;

        if($this->form_validation->run() == false){
            $this->list_kegiatan_sub();
        }else{
            //jika tidak ada rembes lagi
            if($this->rembes_model->delete_notaRembes_kry($id) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Nota gagal dihapus</div>');  
            }else{
                if($this->rembes_model->countAllDataById($id_master_rembes) == 0){
                    $this->master_rembes_model->setNullSubmit_notaRembes_kry($id_master_rembes);
                }
                activity_log("nota rembes", "hapus data", $nama_rembes);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Deleted! Nota behasil dihapus</div>');    
            }
            $this->list_kegiatan_sub();
        }
    }


/*
| -------------------------------------------------------------------------
| MENU NOTA REMBES
| -------------------------------------------------------------------------
*/
    // public function list_notaRembes() {
    //     $data['title'] = "Data Rembes";
    //     $this->load->view("karyawan/data_rembes", $data);
    // }
    // function fetch_notaRembes(){
    // 	$this->load->model('rembes_model');
    //     $fetch_data = $this->rembes_model->make_datatables_notaRembes_kry();
    //     $data = array();
    //     $no = 1;
    //     foreach($fetch_data as $row){
    //         $getMasterRembes = $this->db->get_where("tb_master_rembes", ["id_master_rembes" => $row->id_master_rembes])->row();
    //         $sub_array = array();
    //         $sub_array[] = $no++;
    //         $sub_array[] = $getMasterRembes->nama_kegiatan;
    //         $sub_array[] = $row->nama_rembes;
    //         $sub_array[] = $row->jenis_nota;
    //         $sub_array[] = $row->tanggal_rembes;
    //         $sub_array[] = $row->total_rembes;
    //         $sub_array[] = '<a href="'.base_url("assets/document/karyawan/images").'/'.$row->foto_nota.'" target="_blank"><img id="img_datatables" alt="Foto Nota" src="'.base_url("assets/document/karyawan/images").'/'.$row->foto_nota.'"/></a>';
    //         $sub_array[] = '
    //             <a href="'.site_url('karyawan/rembes?jn='.$row->jenis_nota).'" class="btn btn-success updateModalButton" data-toggle="modal" data-id="'.$row->id_rembes.'" data-nama="'.$row->nama_rembes.'" data-tanggal="'.$row->tanggal_rembes.'" data-total="'.$row->total_rembes.'" data-jenis_nota="'.$row->jenis_nota.'" data-foto="'.$row->foto_nota.'"><i class="fas fa-edit"></i></a> 
    //             <a href="javascript:void(0);" class="btn btn-danger deleteModalButton" data-toggle="modal" data-id="'.$row->id_rembes.'" data-nama="'.$row->nama_rembes.'" id="pp"><i class="far fa-trash-alt text-white"></i></a>';
    //         $data[] = $sub_array;
    //     }
    //     $output = array(
    //         "draw"  => intval($_POST["draw"]),
    //         "recordsTotal"  => $this->rembes_model->get_all_data_notaRembes_kry(),
    //         "recordsFiltered"  => $this->rembes_model->get_filtered_data_notaRembes_kry(),
    //         "data"  =>  $data
    //     );
    //     echo json_encode($output);
    // }
    // function update_notaRembes(){
    //     $this->load->model('rembes_model');
    //     $this->form_validation->set_rules('nama_rembes', 'Nama Rembes', 'required|trim');
    //     $this->form_validation->set_rules('total_rembes', 'Total Rembes', 'required|trim|numeric');
    //     $this->form_validation->set_rules('jenis_nota', 'Jenis Nota', 'required|trim');

    //     $config['upload_path']="./assets/document/karyawan/images/";
    //     $config['allowed_types']='gif|jpg|png';
    //     $config['encrypt_name'] = TRUE;
    //     $this->load->library('upload',$config);
    //     $this->upload->initialize($config);

    //     if($this->form_validation->run() == false){
    //        $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Harap Mengisi data dengan benar!</div>');
    //        $this->load->view('karyawan/data_rembes');
    //     }else{
    //         $id_rembes = $this->input->post('update_id');
    //         $nama_rembes= $this->input->post('nama_rembes');
    //         $total= str_replace(".", "", $this->input->post('total_rembes'));
    //         $jenis_nota= $this->input->post('jenis_nota');
    //         $last_foto_nota = $this->input->post('last_foto_nota');
    //         if($this->upload->do_upload('file')){
    //             $data = array('upload_data' => $this->upload->data());
    //             $foto_nota= $data['upload_data']['file_name'];
    //             unlink("./assets/document/karyawan/images/$last_foto_nota");
    //         }else{
    //             $foto_nota= $last_foto_nota;
    //         }
    //         $this->rembes_model->update_notaRembes_kry($id_rembes,$nama_rembes,$total,$foto_nota,$jenis_nota);
    //         $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Saved! Nota telah diubah</div>');
    //     }
    //     $this->list_notaRembes();
    //  }
    // function delete_notaRembes(){
    // 	$this->load->model('rembes_model');
    //     $this->rembes_model->delete_notaRembes_kry();
    //     $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Deleted! Nota behasil dihapus</div>');
    //     redirect('karyawan/rembes');
    // }

/*
| -------------------------------------------------------------------------
| MENU DATA REMBES YANG BELUM DIKLAIM
| -------------------------------------------------------------------------
*/
    function list_lapDataRembes_unclaimed(){
        $data['title'] = "Data Rembesin Unclaimed";
        $this->load->view('karyawan/lap_data_rembes_unclaimed', $data);
    }
    function fetch_lapDataRembes_unclaimed(){
    	$this->load->model('master_rembes_model');
        $fetch_data = $this->master_rembes_model->make_datatables_lapDataRembes_belumDiklaim_kry();
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
            $getRembes = $this->db->query("SELECT SUM(total_rembes) as total_rembes FROM tb_rembes WHERE id_master_rembes='".$row->id_master_rembes."'")->row();
            $kategori = $getRembes->total_rembes < $row->uang_lumpsum ? 'Nota':'Pengajuan';
        	if($row->submit == "0"){
        		$submitText = "Submit";
        		$submitClass = "submitModalButton";
        		$submitColor = "success";
        	}elseif ($row->submit == "1") {
        		$submitText = "Cancel";
        		$submitClass = "cancelSubmitModalButton";
        		$submitColor = "danger";
        	}
            $noneButton = "";
            if($getRembes->total_rembes == ""){
                $noneButton = "d-none";
            }
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $getRembes->total_rembes < $row->uang_lumpsum ? '<p class="kat-purple">Nota</p>':'<p class="kat-orange">Pengajuan</p>';
            $sub_array[] = $row->nama_kegiatan;
            $sub_array[] = number_format($row->uang_lumpsum,0,',','.');
            $sub_array[] = $getRembes->total_rembes == '' ? '-':number_format($getRembes->total_rembes,0,',','.');
            $sub_array[] = $row->uang_lumpsum - $getRembes->total_rembes == '' ? '-':number_format($row->uang_lumpsum - $getRembes->total_rembes,0,',','.');
            $sub_array[] = date("d M Y", strtotime($row->tanggal_kegiatan));
            $sub_array[] = '
            	<form action="'.site_url('karyawan/lap_dataRembes/unclaimed/list_rembes').'" method="POST" class="d-inline">
            		<input type="hidden" value="'.$row->id_master_rembes.'" name="id"/>
                    <input type="hidden" value="'.$row->uang_lumpsum.'" name="uang_lumpsum"/>
                    <input type="hidden" value="'.$row->nama_kegiatan.'" name="nama_kegiatan"/>
                    <input type="hidden" value="'.$row->tanggal_kegiatan.'" name="tanggal_kegiatan"/>
                    <input type="hidden" value="'.$row->tanggal_selesai.'" name="tanggal_selesai"/>
                    <input type="hidden" value="'.$row->tanggal_submit.'" name="tanggal_submit"/>
                    <input type="hidden" value="'.$getRembes->total_rembes.'" name="total_rembes"/>
                    <input type="hidden" value="'.$row->no_rekening.'" name="no_rekening"/>
                    <input type="hidden" value="'.$kategori.'" name="kategori"/>
                	<button type="submit" class="btn btn-secondary listModalButton"> <i class="fas fa-list-alt"></i></button>
                </form>
                <button type="button" class="btn btn-'.$submitColor.' '.$submitClass.' btn-saya '.$noneButton.'" data-id="'.$row->id_master_rembes.'" data-nama="'.$row->nama_kegiatan.'" data-rekening="'.$kategori.'">'.$submitText.'</button>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->master_rembes_model->get_all_data_lapDataRembes_belumDiklaim_kry(),
            "recordsFiltered"  => $this->master_rembes_model->get_filtered_data_lapDataRembes_belumDiklaim_kry(),
            "data"  =>  $data
        );
        echo json_encode($output);
    }
    function submit_lapDataRembes_unclaimed(){
        $this->load->model('master_rembes_model');
        $this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required|trim');
        $this->form_validation->set_rules('submit_id', 'id', 'required|trim');

        $kategori = $this->input->post('kategori_rembes',true);
        if($kategori == "Nota"){

        }elseif($kategori == "Pengajuan"){
            $this->form_validation->set_rules('radio', 'Jenis Bank', 'required|trim');
            $cashTransfer = $this->input->post('radio',true);
            if($cashTransfer == 'cash'){

            }elseif($cashTransfer == 'transfer'){
                $this->form_validation->set_rules('jenis_bank', 'Jenis Bank', 'required|trim');
                $this->form_validation->set_rules('nama_rekening', 'Nama Rekening', 'required|trim');
                $this->form_validation->set_rules('no_rekening', 'Nomer Rekening', 'required|trim|numeric');
            }else{
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Failed! pilih cash atau transfer</div>');
                redirect('karyawan/lap_dataRembes/unclaimed');
            }
        }else{
            
        }
        
        if($this->form_validation->run() == false){
            $this->list_lapDataRembes_unclaimed();
        }else{
            $id = $this->input->post('submit_id');
            $jenis_bank = $this->input->post('jenis_bank');
            $nama_rekening = $this->input->post('nama_rekening');
            $no_rekening = $this->input->post('no_rekening');
            $tanggal_selesai = $this->input->post('tanggal_selesai');

            if($this->master_rembes_model->submit_kegiatan_kry($id, $jenis_bank, $nama_rekening, $no_rekening, $tanggal_selesai) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Success! Data rembes gagal disubmit ke perusahaan</div>');

            }else{
                activity_log("master rembes", "submit kegiatan", getItemById("tb_master_rembes","id_master_rembes",$id)->nama_kegiatan);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Data rembes berhasil disubmit ke perusahaan</div>');
            }
            redirect('karyawan/lap_dataRembes/unclaimed');
        }
        
    }
    function cancelSubmit_lapDataRembes_unclaimed(){
        $this->load->model('master_rembes_model');
        $this->form_validation->set_rules('submit_id', 'id', 'required|trim');
        $id = $this->input->post('submit_id');

        if($this->form_validation->run() == false){
            $this->list_lapDataRembes_unclaimed();
        }else{
            if($this->master_rembes_model->cancelSubmit_kegiatan_kry($id) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Pengajuan data rembes gagal dibatalkan</div>');
            }else{
                activity_log("master rembes", "cancel submit kegiatan", getItemById("tb_master_rembes","id_master_rembes",$id)->nama_kegiatan);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Pengajuan data rembes telah dibatalkan</div>');
            }
            redirect('karyawan/lap_dataRembes/unclaimed');
        }
    }

    function list_lapDataRembes_unclaimed_sub(){
        if($this->input->post('id') == null){
          redirect('karyawan/lap_dataRembes/unclaimed');
        }
        $data['title'] = "List Rembes Kegiatan '".$this->input->post('nama_kegiatan',true)."'";
        $data['id_master_rembes'] = $this->input->post('id',true);
        $data['nama_kegiatan'] = $this->input->post('nama_kegiatan',true);
        $data['tanggal_kegiatan'] = $this->input->post('tanggal_kegiatan',true);
        $data['tanggal_selesai'] = $this->input->post('tanggal_selesai',true);
        $data['uang_lumpsum'] = $this->input->post('uang_lumpsum',true);
        $data['tanggal_submit'] = $this->input->post('tanggal_submit',true);
        $data['total_rembes'] = $this->input->post('total_rembes',true);
        $data['kategori'] = $this->input->post('kategori',true);
        $data['norek'] = $this->input->post('no_rekening',true);
        $getMr = getItemById('tb_master_rembes', 'id_master_rembes', $this->input->post('id'));
        $data['nama_rekening'] = $getMr->nama_rekening;
        $data['jenis_bank'] = $getMr->jenis_bank;
        $data['no_rekening'] = $getMr->no_rekening;
        $this->load->view('karyawan/lap_data_rembes_unclaimed_sub', $data);
    }
    function fetch_lapDataRembes_unclaimed_sub(){
    	$id = $this->input->post('id_master_rembes',true);
    	$this->load->model('rembes_model');
        $fetch_data = $this->rembes_model->make_datatables_lapDataRembes_sub_kry($id);
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $row->nama_rembes;
            $sub_array[] = $row->jenis_nota;
            $sub_array[] = date("d M Y", strtotime($row->tanggal_rembes));
            $sub_array[] = number_format($row->total_rembes,0,',','.');
            $sub_array[] = '<a href="'.base_url("assets/document/karyawan/images").'/'.$row->foto_nota.'" target="_blank"><img id="img_datatables" alt="Foto Nota" src="'.base_url("assets/document/karyawan/images").'/'.$row->foto_nota.'"/></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->rembes_model->get_all_data_lapDataRembes_sub_kry($id),
            "recordsFiltered"  => $this->rembes_model->get_filtered_data_lapDataRembes_sub_kry($id),
            "data"  =>  $data
        );
        echo json_encode($output);
    }

/*
| -------------------------------------------------------------------------
| MENU DATA REMBES YANG SUDAH DIKLAIM
| -------------------------------------------------------------------------
*/
    function list_lapDataRembes_claimed(){
        $data['title'] = "Data Rembesin Unclaimed";
        $this->load->view('karyawan/lap_data_rembes_claimed', $data);
    }
     function fetch_lapDataRembes_claimed(){
    	$this->load->model('master_rembes_model');
        $fetch_data = $this->master_rembes_model->make_datatables_lapDataRembes_sudahDiklaim_kry();
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
            $getRembes = $this->db->query("SELECT SUM(total_rembes) as total_rembes FROM tb_rembes WHERE id_master_rembes='".$row->id_master_rembes."'")->row();
            $kategori = $getRembes->total_rembes < $row->uang_lumpsum ? 'Nota':'Pengajuan';
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $getRembes->total_rembes < $row->uang_lumpsum ? '<p class="kat-purple">Nota</p>':'<p class="kat-orange">Pengajuan</p>';
            $sub_array[] = $row->nama_kegiatan;
            $sub_array[] = number_format($row->uang_lumpsum,0,',','.');
            $sub_array[] = number_format($getRembes->total_rembes,0,',','.');
            $sub_array[] = date("d M Y", strtotime($row->tanggal_kegiatan));
            $sub_array[] = date("d M Y", strtotime($row->tanggal_selesai));
            $sub_array[] = date("d M Y", strtotime($row->tanggal_klaim));
            $sub_array[] = '
            	<form action="'.site_url('karyawan/lap_dataRembes/claimed/list_rembes').'" method="POST" class="d-inline">
                    <input type="hidden" value="'.$row->id_master_rembes.'" name="id"/>
                    <input type="hidden" value="'.$row->uang_lumpsum.'" name="uang_lumpsum"/>
                    <input type="hidden" value="'.$row->nama_kegiatan.'" name="nama_kegiatan"/>
                    <input type="hidden" value="'.$row->tanggal_kegiatan.'" name="tanggal_kegiatan"/>
                    <input type="hidden" value="'.$row->tanggal_selesai.'" name="tanggal_selesai"/>
                    <input type="hidden" value="'.$row->tanggal_submit.'" name="tanggal_submit"/>
                    <input type="hidden" value="'.$row->tanggal_klaim.'" name="tanggal_klaim"/>
                    <input type="hidden" value="'.$getRembes->total_rembes.'" name="total_rembes"/>
                    <input type="hidden" value="'.$row->no_rekening.'" name="no_rekening"/>
                    <input type="hidden" value="'.$kategori.'" name="kategori"/>
                	<button type="submit" class="btn btn-secondary listModalButton"> <i class="fas fa-list-alt"></i></button>
                </form>
                <form action="'.site_url('karyawan/lap_dataRembes/cetak').'" method="POST" class="d-inline" target="_blank">
                    <input type="hidden" value="'.$row->id_master_rembes.'" name="id_master_rembes"/>
                    <button type="submit" title="Cetak Rembes" class="btn btn-info printButton btn-saya"><i class="fas fa-print"></i></button>
                </form>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->master_rembes_model->get_all_data_lapDataRembes_sudahDiklaim_kry(),
            "recordsFiltered"  => $this->master_rembes_model->get_filtered_data_lapDataRembes_sudahDiklaim_kry(),
            "data"  =>  $data
        );
        echo json_encode($output);
    }
    function list_lapDataRembes_claimed_sub(){
        if($this->input->post('id') == null){
          redirect('karyawan/lap_dataRembes/claimed');
        }
        $data['title'] = "List Rembes Kegiatan '".$this->input->post('nama_kegiatan',true)."'";
        $data['id_master_rembes'] = $this->input->post('id',true);
        $data['nama_kegiatan'] = $this->input->post('nama_kegiatan',true);
        $data['tanggal_kegiatan'] = $this->input->post('tanggal_kegiatan',true);
        $data['tanggal_selesai'] = $this->input->post('tanggal_selesai',true);
        $data['uang_lumpsum'] = $this->input->post('uang_lumpsum',true);
        $data['tanggal_submit'] = $this->input->post('tanggal_submit',true);
        $data['tanggal_klaim'] = $this->input->post('tanggal_klaim',true);
        $data['total_rembes'] = $this->input->post('total_rembes',true);
        $data['kategori'] = $this->input->post('kategori',true);
        $data['norek'] = $this->input->post('no_rekening',true);
        $getMr = getItemById('tb_master_rembes', 'id_master_rembes', $this->input->post('id'));
        $data['nama_rekening'] = $getMr->nama_rekening;
        $data['jenis_bank'] = $getMr->jenis_bank;
        $data['no_rekening'] = $getMr->no_rekening;
        $this->load->view('karyawan/lap_data_rembes_claimed_sub', $data);
    }
    function fetch_lapDataRembes_claimed_sub(){
        $id = $this->input->post('id_master_rembes',true);
        $this->load->model('rembes_model');
        $fetch_data = $this->rembes_model->make_datatables_lapDataRembes_sub_kry($id);
        $data = array();
        $no = 1;
        foreach($fetch_data as $row){
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $row->nama_rembes;
            $sub_array[] = $row->jenis_nota;
            $sub_array[] = date("d M Y", strtotime($row->tanggal_rembes));
            $sub_array[] = number_format($row->total_rembes,0,',','.');
            $sub_array[] = '<a href="'.base_url("assets/document/karyawan/images").'/'.$row->foto_nota.'" target="_blank"><img id="img_datatables" alt="Foto Nota" src="'.base_url("assets/document/karyawan/images").'/'.$row->foto_nota.'"/></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"  => intval($_POST["draw"]),
            "recordsTotal"  => $this->rembes_model->get_all_data_lapDataRembes_sub_kry($id),
            "recordsFiltered"  => $this->rembes_model->get_filtered_data_lapDataRembes_sub_kry($id),
            "data"  =>  $data
        );
        echo json_encode($output);
    }

/*
| -------------------------------------------------------------------------
| CETAK SATU KEGIATAN YANG MEMILIKI SUB REMBES
| -------------------------------------------------------------------------
*/
    public function preview_cetak(){
        $this->load->view('karyawan/cetak/rembes_onlyOne');
    }
    public function cetak(){
        // load view yang akan digenerate atau diconvert
        // contoh kita akan membuat pdf dari halaman welcome codeigniter\
        // $data['master_rembes']= $this->input->post('id_master_rembes');
        if($this->input->post('id_master_rembes') == null){
          redirect('karyawan/lap_dataRembes/claimed');
        }
        $data['id'] = $this->input->post('id_master_rembes');
        $this->load->view('karyawan/cetak/rembes_onlyOne', $data);
        // dapatkan output html
        $html = $this->output->get_output();
        // Load/panggil library dompdfnya
        $this->load->library('dompdf_gen');
        // Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        //utk menampilkan preview pdf
        $this->dompdf->stream("Cetak_Kwitansi_Rembes.pdf", array('Attachment' => false));
        exit(0);
        
        //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
        //$this->dompdf->stream("welcome.pdf");
    }

/*
| -------------------------------------------------------------------------
| FITUR UBAH PROFILE USER
| -------------------------------------------------------------------------
*/
    public function ubahProfile(){
        $this->load->model('karyawan_model');
        $nowDateTime = date('Y-m-d H:i:s');
        $id = $this->input->post('id');
        $nama = $this->input->post('nama_karyawan');
        $email = $this->input->post('email_karyawan');
        $alamat = $this->input->post('alamat_karyawan');
        $jk = $this->input->post('radio');
        $jenis_identitas = $this->input->post('jenis_identitas');
        $no_identitas = $this->input->post('no_identitas');
        $this->form_validation->set_rules('nama_karyawan', 'Nama Karyawan', 'required|trim');
        $this->form_validation->set_rules('email_karyawan', 'Email Karyawan', 'required|trim');
        $this->form_validation->set_rules('alamat_karyawan', 'Alamat Karyawan', 'required|trim');
        $this->form_validation->set_rules('jenis_identitas', 'Jenis Identitas', 'required');
        $this->form_validation->set_rules('no_identitas', 'No Identitas', 'required|trim');
        if($this->form_validation->run() == false){
            $this->index();
        }
        else{
            if($this->karyawan_model->update_profile_kry($id, $nama, $email, $alamat, $nowDateTime, $jenis_identitas, $no_identitas, $jk) == false){
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Profile gagal diubah!</div>');
            }else{
                activity_log("karyawan", "ubah profile", $nama);
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Profile berhasil diubah!</div>');
            }
            redirect('karyawan');
        }
    }

/*
| -------------------------------------------------------------------------
| FITUR UBAH PASSWORD USER
| -------------------------------------------------------------------------
*/
    public function form_ubahPassword(){
        $data['title'] = "Ubah Password";
        $this->load->view('karyawan/ubah_password', $data);
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
                if($this->user_model->ubah_passwordKaryawan_kry($id_user, $username, password_hash($passwordBaru, PASSWORD_DEFAULT), $nowDateTime) == false){
                    $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Failed! Password gagal diubah</div>');
                }else{
                    activity_log("user", "ubah password", $username);
                    $session = ['username' => $username];
                    $this->session->set_userdata($session);
                    $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-success alert-dismissible mt-3 alertAutoClose" role="alert">Success! Password telah diubah</div>');
                }
            }else{
                $this->session->set_flashdata('successTopBar', '<div class="alert pt-2 pb-2 pl-3 pr-3 alert-danger alert-dismissible mt-3 alertAutoClose" role="alert">Success! Password lama tidak sama</div>');
            }
            redirect('karyawan/password/form');
        }
    }
}
