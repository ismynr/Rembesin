<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_model extends CI_Model {

	private $_table = "tb_log";
	var $select_column = array("log_id","log_time","log_user","log_role","log_tipe","log_aksi","log_item");
    var $order_column = array(null,"log_time", "log_user","log_role","log_tipe", "log_aksi", "log_item");
    var $column_search = array("log_time", "log_user","log_role","log_tipe", "log_aksi", "log_item");

    public function save_log($param){
        $sql        = $this->db->insert_string('tb_log',$param);
        $ex         = $this->db->query($sql);
        return $this->db->affected_rows($sql);
    }

    function make_query_actifityLog_adm(){
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
            $this->db->order_by('log_id','DESC');
        }
    }
    function make_datatables_actifityLog_adm(){
        $this->make_query_actifityLog_adm();
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_actifityLog_adm(){
        $this->make_query_actifityLog_adm();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_actifityLog_adm(){
        $this->db->select("*");
        $this->db->from($this->_table);
        return $this->db->count_all_results();
    }

    function make_query_activityLog_prs(){
        $this->db->select($this->select_column);
        $this->db->from($this->_table);
        $this->db->where(['log_user'=>$this->session->userdata('username')]);
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
            $this->db->order_by('log_id','DESC');
        }
    }
    function make_datatables_activityLog_prs(){
        $this->make_query_activityLog_prs();
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_activityLog_prs(){
        $this->make_query_activityLog_prs();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_activityLog_prs(){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where(['log_user'=>$this->session->userdata('username')]);
        return $this->db->count_all_results();
    }

    function make_query_activityLog_dataKaryawan_prs(){
        $getUserPerusahaan = getItemById('tb_user', 'username', $this->session->userdata('username'));
        $getPerusahaan = getItemById('tb_perusahaan', 'id_user', $getUserPerusahaan->id_user);
        $this->db->select($this->select_column);
        $this->db->from($this->_table);
        $this->db->join('tb_user', 'tb_user.username=tb_log.log_user');
        $this->db->join('tb_karyawan', 'tb_karyawan.id_user=tb_user.id_user');
        $this->db->where(['tb_karyawan.id_perusahaan'=>$getPerusahaan->id_perusahaan]);
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
            $this->db->order_by('log_id','DESC');
        }
    }
    function make_datatables_activityLog_dataKaryawan_prs(){
        $this->make_query_activityLog_dataKaryawan_prs();
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_activityLog_dataKaryawan_prs(){
        $this->make_query_activityLog_dataKaryawan_prs();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_activityLog_dataKaryawan_prs(){
        $getUserPerusahaan = getItemById('tb_user', 'username', $this->session->userdata('username'));
        $getPerusahaan = getItemById('tb_perusahaan', 'id_user', $getUserPerusahaan->id_user);
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->join('tb_user', 'tb_user.username=tb_log.log_user');
        $this->db->join('tb_karyawan', 'tb_karyawan.id_user=tb_user.id_user');
        $this->db->where(['tb_karyawan.id_perusahaan'=>$getPerusahaan->id_perusahaan]);
        return $this->db->count_all_results();
    }

    function make_query_activityLog_kry(){
        $this->db->select($this->select_column);
        $this->db->from($this->_table);
        $this->db->where(['log_user'=>$this->session->userdata('username')]);
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
            $this->db->order_by('log_id','DESC');
        }
    }
    function make_datatables_activityLog_kry(){
        $this->make_query_activityLog_kry();
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_activityLog_kry(){
        $this->make_query_activityLog_kry();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_activityLog_kry(){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where(['log_user'=>$this->session->userdata('username')]);
        return $this->db->count_all_results();
    }
}
