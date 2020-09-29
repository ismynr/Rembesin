<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_bank_model extends CI_Model{

	private $_table = "tb_jenis_bank";
	var $select_column = array("id_bank","jenis_bank");
	var $order_column = array(null,"jenis_bank");
	var $column_search = array("jenis_bank");

	function make_query_jBank_adm(){
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
            $this->db->order_by('id_bank','DESC');
        }
    }
    function make_datatables_jBank_adm(){
        $this->make_query_jBank_adm();
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_jBank_adm(){
        $this->make_query_jBank_adm();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_jBank_adm(){
        $this->db->select("*");
        $this->db->from($this->_table);
        return $this->db->count_all_results();
    }
    function add_jBank_adm($jenis){
        $data = array(
            'jenis_bank' => $jenis
        );
        if(!$this->db->insert($this->_table, $data)){
            return false;
        }return true;
    }
    function update_jBank_adm($id, $jenis){
        $data = array(
            'jenis_bank' => $jenis
        );
        if(!$this->db->update($this->_table, $data, array('id_bank'=>$id))){
            return false;
        }return true;
    }
    function delete_jBank_adm($id){
        if(!$this->db->delete($this->_table, array('id_bank'=>$id))){
            return false;
        }return true;
    }
}