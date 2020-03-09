<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_Nota_Model extends CI_Model{

	private $_table = "tb_jenis_nota";
	var $select_column = array("id_nota","jenis_nota","deskripsi_nota","gambar_nota");
	var $order_column = array(null,"jenis_nota");
	var $column_search = array("jenis_nota");

	function make_query_jNota_adm(){
        $this->db->select($this->select_column);
        $this->db->from($this->_table);
        $i = 0;
        foreach ($this->column_search as $item){
            if($_POST['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }else{
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
            $this->db->order_by('id_nota','DESC');
        }
    }
    function make_datatables_jNota_adm(){
        $this->make_query_jNota_adm();
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_jNota_adm(){
        $this->make_query_jNota_adm();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_jNota_adm(){
        $this->db->select("*");
        $this->db->from($this->_table);
        return $this->db->count_all_results();
    }
    function add_jNota_adm($jenis, $deskripsi, $gambar){
        $data = array(
            'jenis_nota' => $jenis,
            'deskripsi_nota' => $deskripsi,
            'gambar_nota' => $gambar
        );
        if(!$this->db->insert($this->_table, $data)){
            return false;
        }return true;
    }
    function update_jNota_adm($id, $jenis, $deskripsi, $gambar){
        $data = array(
            'jenis_nota' => $jenis,
            'deskripsi_nota' => $deskripsi,
            'gambar_nota' => $gambar
        );
        if(!$this->db->update($this->_table, $data, array('id_nota'=>$id))){
            return false;
        }return true;
    }
    function delete_jNota_adm($id){
        if(!$this->db->delete($this->_table, array('id_nota'=>$id))){
            return false;
        }return true;
    }


    //LANDING
    public function getAll_jNota_ldg(){
        return $this->db->get($this->_table);
    }
    public function countAll_jNota_ldg(){
        return $this->db->get($this->_table)->num_rows();
    }
}