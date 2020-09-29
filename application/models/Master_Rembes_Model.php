<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_rembes_model extends CI_Model{

    private $_table = "tb_master_rembes";
    var $select_column = array("id_master_rembes","nama_kegiatan","uang_lumpsum","tanggal_kegiatan","id_karyawan","jenis_bank","nama_rekening","no_rekening","status","submit","tanggal_submit","tanggal_selesai","tanggal_klaim");
    var $order_column = array(null, "nama_kegiatan", "tanggal_kegiatan", null, null);
    var $column_search = array("nama_kegiatan", "tanggal_kegiatan");

    //PRUSAHAAN PAGE
    function make_query_klaimRembes_prs(){
        $get_id_perusahaan=$this->db->get_where("tb_perusahaan", ["id_user" => $this->session->userdata('id_user')])->row();
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('tb_karyawan', 'tb_master_rembes.id_karyawan=tb_karyawan.id_karyawan');
        $this->db->join('tb_perusahaan', 'tb_karyawan.id_perusahaan=tb_perusahaan.id_perusahaan');
        $WR = "tb_master_rembes.status = '0' AND tb_master_rembes.submit = '1' AND tb_perusahaan.id_perusahaan = '".$get_id_perusahaan->id_perusahaan."' AND tb_master_rembes.tanggal_submit > NOW() + INTERVAL -3 DAY ";
        $this->db->where($WR);
        $i = 0;
        foreach ($this->column_search as $item){
            if($_POST['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if(isset($_POST["order"])){
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else{
            $this->db->order_by('id_master_rembes','DESC');
        }
    }
    function make_datatables_klaimRembes_prs(){
        $this->make_query_klaimRembes_prs();
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_klaimRembes_prss(){
        $this->make_query_klaimRembes_prs();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_klaimRembes_prs(){
        $get_id_perusahaan=$this->db->get_where("tb_perusahaan", ["id_user" => $this->session->userdata('id_user')])->row();
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('tb_karyawan', 'tb_master_rembes.id_karyawan=tb_karyawan.id_karyawan');
        $this->db->join('tb_perusahaan', 'tb_karyawan.id_perusahaan=tb_perusahaan.id_perusahaan');
        $WR = "tb_master_rembes.status = '0' AND tb_master_rembes.submit = '1' AND tb_perusahaan.id_perusahaan = '".$get_id_perusahaan->id_perusahaan."' AND tb_master_rembes.tanggal_submit > NOW() + INTERVAL -3 DAY ";
        $this->db->where($WR);
        return $this->db->count_all_results();
    }
    public function klaim_klaimRembes_prs($id){
        $currentDate = date('Y-m-d');
        $data = [
            'status' => '1',
            'tanggal_klaim' => $currentDate
        ];
        if(!$this->db->update($this->_table, $data, array('id_master_rembes' => $id))){
            return false;
        }return true;
    }
    public function delete_klaimRembes_prs($id){
        if(!$this->db->delete("tb_rembes", array('id_master_rembes' => $id)) || !$this->db->delete($this->_table, array('id_master_rembes' => $id))){
            return false;
        }return true;
    }

    function make_query_dataRembes_prs(){
        $get_id_perusahaan=$this->db->get_where("tb_perusahaan", ["id_user" => $this->session->userdata('id_user')])->row();
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('tb_karyawan', 'tb_master_rembes.id_karyawan=tb_karyawan.id_karyawan');
        $this->db->join('tb_perusahaan', 'tb_karyawan.id_perusahaan=tb_perusahaan.id_perusahaan');
        $this->db->where(["tb_master_rembes.status" => "1", "tb_master_rembes.submit" => "1", "tb_perusahaan.id_perusahaan" => $get_id_perusahaan->id_perusahaan]);
        $i = 0;
        foreach ($this->column_search as $item){
            if($_POST['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if(isset($_POST["order"])){
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else{
            $this->db->order_by('id_master_rembes','DESC');
        }
    }
    function make_datatables_dataRembes_prs(){
        $this->make_query_dataRembes_prs();
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_dataRembes_prss(){
        $this->make_query_dataRembes_prs();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_dataRembes_prs(){
        $get_id_perusahaan=$this->db->get_where("tb_perusahaan", ["id_user" => $this->session->userdata('id_user')])->row();
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('tb_karyawan', 'tb_master_rembes.id_karyawan=tb_karyawan.id_karyawan');
        $this->db->join('tb_perusahaan', 'tb_karyawan.id_perusahaan=tb_perusahaan.id_perusahaan');
        $this->db->where(["tb_master_rembes.status" => "1", "tb_master_rembes.submit" => "1", "tb_perusahaan.id_perusahaan" => $get_id_perusahaan->id_perusahaan]);
        return $this->db->count_all_results();
    }

    //MENU URGENT
    function make_query_urgent_prs(){
        $get_id_perusahaan=$this->db->get_where("tb_perusahaan", ["id_user" => $this->session->userdata('id_user')])->row();
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('tb_karyawan', 'tb_master_rembes.id_karyawan=tb_karyawan.id_karyawan');
        $this->db->join('tb_perusahaan', 'tb_karyawan.id_perusahaan=tb_perusahaan.id_perusahaan');
        $this->db->join('(SELECT id_master_rembes, SUM(total_rembes) AS total_rembes FROM tb_rembes GROUP BY id_master_rembes) AS rmb', 'rmb.id_master_rembes = tb_master_rembes.id_master_rembes');
        $WR = "tb_master_rembes.status = '0' AND tb_master_rembes.submit = '1' AND tb_perusahaan.id_perusahaan = '".$get_id_perusahaan->id_perusahaan."' AND tb_master_rembes.tanggal_submit < NOW() + INTERVAL -3 DAY ";
        $this->db->where($WR);
        $i = 0;
        foreach ($this->column_search as $item){
            if($_POST['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if(isset($_POST["order"])){
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else{
            $this->db->order_by('tb_master_rembes.id_master_rembes','DESC');
        }
    }
    function make_datatables_urgent_prs(){
        $this->make_query_urgent_prs();
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_urgent_prss(){
        $this->make_query_urgent_prs();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_urgent_prs(){
        $get_id_perusahaan=$this->db->get_where("tb_perusahaan", ["id_user" => $this->session->userdata('id_user')])->row();
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('tb_karyawan', 'tb_master_rembes.id_karyawan=tb_karyawan.id_karyawan');
        $this->db->join('tb_perusahaan', 'tb_karyawan.id_perusahaan=tb_perusahaan.id_perusahaan');
        $this->db->join('(SELECT id_master_rembes, SUM(total_rembes) AS total_rembes FROM tb_rembes) AS rmb', 'rmb.id_master_rembes = tb_master_rembes.id_master_rembes');
        $WR = "tb_master_rembes.status = '0' AND tb_master_rembes.submit = '1' AND tb_perusahaan.id_perusahaan = '".$get_id_perusahaan->id_perusahaan."' AND tb_master_rembes.tanggal_submit < NOW() + INTERVAL -3 DAY ";
        $this->db->where($WR);
        return $this->db->count_all_results();
    }


    //KARYAWAN PAGE
    function make_query_kegiatan_kry(){
        $getIdKaryawan = $this->db->get_where("tb_karyawan", ['id_user'=>$this->session->userdata('id_user')])->row();
        $this->db->select($this->select_column);
        $this->db->from($this->_table);
        $this->db->like(["status"=> "0","id_karyawan"=> $getIdKaryawan->id_karyawan,"submit" => "0"]);
        $i = 0;
        foreach ($this->column_search as $item){
            if($_POST['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if(isset($_POST["order"])){
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else{
            $this->db->order_by('id_master_rembes','DESC');
        }
    }
    function make_datatables_kegiatan_kry(){
        $this->make_query_kegiatan_kry();

        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_kegiatan_kry(){
        $this->make_query_kegiatan_kry();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_kegiatan_kry(){
        $getIdKaryawan = $this->db->get_where("tb_karyawan", ['id_user'=>$this->session->userdata('id_user')])->row();
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where(['status' => '0','id_karyawan' => $getIdKaryawan->id_karyawan,"submit" => "0"]);
        return $this->db->count_all_results();
    }
    public function add_kegiatan_kry($id_karyawan, $nama_kegiatan, $uang_lumpsum, $tanggal_kegiatan){
        $data = [
            'nama_kegiatan' => $nama_kegiatan,
            'uang_lumpsum' => $uang_lumpsum,
            'tanggal_kegiatan' => $tanggal_kegiatan,
            'id_karyawan' => $id_karyawan,
            'status' => '0',
            'submit' => '0',
        ];
        if(!$this->db->insert($this->_table, $data)){
            return false;
        }return true;
    }
    public function delete_kegiatan_kry($id){
        $query = $this->db->query('SELECT * FROM tb_master_rembes INNER JOIN tb_rembes ON tb_master_rembes.id_master_rembes=tb_rembes.id_master_rembes WHERE tb_master_rembes.id_master_rembes='.$id);
        foreach ($query->result() as $row)
        {
            unlink("./assets/document/karyawan/images/$row->foto_nota");
        }

        if(!$this->db->delete('tb_rembes', array('id_master_rembes' => $id))){
            return false;
        }
        $this->db->delete($this->_table, array('id_master_rembes' => $id));
        return true;
    }
    public function update_kegiatan_kry($id, $nama_kegiatan, $uang_lumpsum, $tanggal_kegiatan){
        $data = [
            'nama_kegiatan' => $nama_kegiatan,
            'uang_lumpsum' => $uang_lumpsum,
            'tanggal_kegiatan' => $tanggal_kegiatan
        ];
        if(!$this->db->update($this->_table, $data, array('id_master_rembes' => $id))){
            return false;
        }return true;
    }
    public function submit_kegiatan_kry($id, $jenis_bank, $nama_rekening, $no_rekening, $tanggal_selesai){
        $currentDate = date('Y-m-d');
        $data = [
            'submit' => "1",
            'jenis_bank' => $jenis_bank,
            'nama_rekening' => $nama_rekening,
            'no_rekening' => $no_rekening,
            'tanggal_submit' => $currentDate,
            'tanggal_selesai' => $tanggal_selesai
        ];
        if(!$this->db->update($this->_table, $data, array('id_master_rembes' => $id))){
            return false;
        }return true;
    }
    public function cancelSubmit_kegiatan_kry($id){
        $data = [
            'submit' => "0",
            'jenis_bank' => "",
            'nama_rekening' => "",
            'no_rekening' => "",
            'tanggal_submit' => '0000-00-00',
            'tanggal_selesai' => '0000-00-00'
        ];
        if(!$this->db->update($this->_table, $data, array('id_master_rembes' => $id))){
            return false;
        }return true;
    }

    //DATA REMBES BELUM DIKLAIM
    function make_query_lapDataRembes_belumDiklaim_kry(){
        $getIdKaryawan = $this->db->get_where("tb_karyawan", ['id_user'=>$this->session->userdata('id_user')])->row();
        $this->db->select($this->select_column);
        $this->db->from($this->_table);
        $this->db->like(["status"=> "0","id_karyawan"=> $getIdKaryawan->id_karyawan]);
        $i = 0;
        foreach ($this->column_search as $item){
            if($_POST['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if(isset($_POST["order"])){
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else{
            $this->db->order_by('id_master_rembes','DESC');
        }
    }
    function make_datatables_lapDataRembes_belumDiklaim_kry(){
        $this->make_query_lapDataRembes_belumDiklaim_kry();

        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_lapDataRembes_belumDiklaim_kry(){
        $this->make_query_lapDataRembes_belumDiklaim_kry();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_lapDataRembes_belumDiklaim_kry(){
        $getIdKaryawan = $this->db->get_where("tb_karyawan", ['id_user'=>$this->session->userdata('id_user')])->row();
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where(['status' => '0','id_karyawan' => $getIdKaryawan->id_karyawan]);
        return $this->db->count_all_results();
    }

    //DATA REMBES SUDAH DIKLAIM
    function make_query_lapDataRembes_sudahDiklaim_kry(){
        $getIdKaryawan = $this->db->get_where("tb_karyawan", ['id_user'=>$this->session->userdata('id_user')])->row();
        $this->db->select($this->select_column);
        $this->db->from($this->_table);
        $this->db->like(["status"=> "1","id_karyawan"=> $getIdKaryawan->id_karyawan, "submit"=> "1"]);
        $i = 0;
        foreach ($this->column_search as $item){
            if($_POST['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if(isset($_POST["order"])){
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else{
            $this->db->order_by('id_master_rembes','DESC');
        }
    }
    function make_datatables_lapDataRembes_sudahDiklaim_kry(){
        $this->make_query_lapDataRembes_sudahDiklaim_kry();

        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_lapDataRembes_sudahDiklaim_kry(){
        $this->make_query_lapDataRembes_sudahDiklaim_kry();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_lapDataRembes_sudahDiklaim_kry(){
        $getIdKaryawan = $this->db->get_where("tb_karyawan", ['id_user'=>$this->session->userdata('id_user')])->row();
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where(['status' => '1','id_karyawan' => $getIdKaryawan->id_karyawan, "submit"=> "1"]);
        return $this->db->count_all_results();
    }

    function getAll_byIdUserPerusahaan($idUser_prs, $startDate, $endDate){
        $getPerusahaan = $this->db->query("SELECT * FROM tb_perusahaan WHERE id_user='".$this->session->userdata('id_user')."'")->row();
        
        return $this->db->query('SELECT * FROM tb_master_rembes INNER JOIN tb_karyawan ON tb_master_rembes.id_karyawan=tb_karyawan.id_karyawan INNER JOIN tb_perusahaan ON tb_karyawan.id_perusahaan=tb_perusahaan.id_perusahaan WHERE tb_master_rembes.status = "1" AND tb_master_rembes.submit = "1" AND tb_perusahaan.id_perusahaan = "'.$getPerusahaan->id_perusahaan.'" AND tb_master_rembes.tanggal_klaim between "'.$startDate.'" AND "'.$endDate.'" ORDER BY tb_master_rembes.id_master_rembes DESC');
    }

    function setNullSubmit_notaRembes_kry($id){
        $data = [
            'submit' => "0",
            'jenis_bank' => "",
            'nama_rekening' => "",
            'no_rekening' => "",
            'tanggal_submit' => '0000-00-00',
            'tanggal_selesai' => '0000-00-00'
        ];
        if(!$this->db->update($this->_table, $data, array('id_master_rembes' => $id))){
            return false;
        }return true;
    }
}