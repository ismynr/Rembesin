<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_identitas_model extends CI_Model{

	private $_table = "tb_jenis_identitas";
	var $select_column = array("id_identitas","jenis_identitas");
	var $order_column = array(null,"jenis_identitas");
	var $column_search = array("jenis_identitas");

	function make_query_jIdentitas_adm(){
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
            $this->db->order_by('id_identitas','DESC');
        }
    }
    function make_datatables_jIdentitas_adm(){
        $this->make_query_jIdentitas_adm();
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_jIdentitas_adm(){
        $this->make_query_jIdentitas_adm();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_jIdentitas_adm(){
        $this->db->select("*");
        $this->db->from($this->_table);
        return $this->db->count_all_results();
    }
    function add_jIdentitas_adm($jenis){
        $data = array(
            'jenis_identitas' => $jenis
        );
        if(!$this->db->insert($this->_table, $data)) {
            return false;
        }return true;
    }
    function update_jIdentitas_adm($id, $jenis){
        $data = array(
            'jenis_identitas' => $jenis
        );
        if(!$this->db->update($this->_table, $data, array('id_identitas'=>$id))){
            return false;
        }return true;
    }
    function delete_jIdentitas_adm($id){
        if(!$this->db->delete($this->_table, array('id_identitas'=>$id))){
            return false;
        }return true;
    }
}