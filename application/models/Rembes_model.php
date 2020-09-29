<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rembes_model extends CI_Model{

	private $_table = "tb_rembes";
	var $select_column = array("id_rembes","id_master_rembes","nama_rembes","tanggal_rembes","total_rembes","foto_nota","jenis_nota");
	var $order_column = array(null, null, "nama_rembes", "tanggal_rembes", "total_rembes", null);
	var $column_search = array("nama_rembes", "tanggal_rembes", "total_rembes");

	//PERUSAHAAN
	function make_query_klaimRembes_sub_prs($id){
        $this->db->select($this->select_column);
        $this->db->from($this->_table);
        $this->db->where(['id_master_rembes' => $id]);
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
            $this->db->order_by('id_rembes','DESC');
        }
    }
    function make_datatables_klaimRembes_sub_prs($id){
        $this->make_query_klaimRembes_sub_prs($id);
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_klaimRembes_sub_prs($id){
        $this->make_query_klaimRembes_sub_prs($id);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_klaimRembes_sub_prs($id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where(['id_master_rembes' => $id]);
        return $this->db->count_all_results();
    }

    //KARYAWAN
    function make_query_notaRembes_kry(){
        $getIdKaryawan = $this->db->get_where("tb_karyawan", ['id_user'=>$this->session->userdata('id_user')])->row();
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->join('tb_master_rembes','tb_rembes.id_master_rembes=tb_master_rembes.id_master_rembes','inner');
        $this->db->like(["status"=> "0","id_karyawan"=> $getIdKaryawan->id_karyawan, "submit"=> "0"]);
        $i = 0;
        foreach ($this->column_search as $item){
            if($_POST['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if(isset($_POST["order"])){
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else{
            $this->db->order_by('id_rembes','DESC');
        }
    }
    function make_datatables_notaRembes_kry(){
        $this->make_query_notaRembes_kry();
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_notaRembes_kry(){
        $this->make_query_notaRembes_kry();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_notaRembes_kry(){
        $getIdKaryawan = $this->db->get_where("tb_karyawan", ['id_user'=>$this->session->userdata('id_user')])->row();
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->join('tb_master_rembes','tb_rembes.id_master_rembes=tb_master_rembes.id_master_rembes','inner');
        $this->db->like(["status"=> "0","id_karyawan"=> $getIdKaryawan->id_karyawan, "submit"=> "0"]);
        return $this->db->count_all_results();
    }
    function delete_notaRembes_kry($id_rembes){
        if(!$this->db->delete($this->_table, array('id_rembes' => $id_rembes))){
            return false;
        }return true;
    }


    //LAP DATA REMBES (LIST REMBES)
    function make_query_lapDataRembes_sub_kry($id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->like(["id_master_rembes" => "$id"]);
        $i = 0;
        foreach ($this->column_search as $item){
            if($_POST['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if(isset($_POST["order"])){
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else{
            $this->db->order_by('id_rembes','DESC');
        }
    }
    function make_datatables_lapDataRembes_sub_kry($id){
        $this->make_query_lapDataRembes_sub_kry($id);
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_lapDataRembes_sub_kry($id){
        $this->make_query_lapDataRembes_sub_kry($id);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_lapDataRembes_sub_kry($id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->like(["id_master_rembes" => "$id"]);
        return $this->db->count_all_results();
    }
    function add_notaRembes_kry($id_master_rembes,$nama_rembes,$tanggal,$total,$foto_nota,$jenis_nota){
        $data = array(
                'id_master_rembes'     => $id_master_rembes,
                'nama_rembes'     => $nama_rembes,
                'tanggal_rembes'     => $tanggal,
                'total_rembes'     => $total,
                'jenis_nota'     => $jenis_nota,
                'foto_nota' => $foto_nota
        );  
        if(!$this->db->insert($this->_table, $data)){
            return false;
        }return true;
    }
    function update_notaRembes_kry($id_rembes,$nama_rembes,$total,$foto_nota,$jenis_nota){
        $data = array(
                'nama_rembes'     => $nama_rembes,
                'total_rembes'     => $total,
                'jenis_nota'     => $jenis_nota,
                'foto_nota' => $foto_nota
        );  
        if(!$this->db->update($this->_table, $data, array('id_rembes'=>$id_rembes))){
            return false;
        }return true;
    }
    function countAllDataById($id){
         return $this->db->get_where($this->_table, array('id_master_rembes' => $id))->num_rows();
    }
}