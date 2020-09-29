<?php 

class Perusahaan_model extends CI_Model{

	private $_table = "tb_perusahaan";
	var $select_column = array("id_perusahaan","id_user","nama_perusahaan","alamat_perusahaan","no_telepon","email_perusahaan","approvment","trash","created_at","updated_at");
    var $order_column = array(null,null, "nama_perusahaan", "alamat_perusahaan","no_telepon","email_perusahaan", null, null,null,null);
    var $column_search = array("nama_perusahaan", "alamat_perusahaan","no_telepon","email_perusahaan");

    //DATATABLES FOR ADMIN PAGE
    function make_query_newRegist_adm(){
        $this->db->select($this->select_column);
        $this->db->from($this->_table);
        $this->db->like("approvment", "0");
        $this->db->like("trash", "0");
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
            $this->db->order_by('id_perusahaan','DESC');
        }
    }
    function make_datatables_newRegist_adm(){
        $this->make_query_newRegist_adm();
        
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_newRegist_adm(){
        $this->make_query_newRegist_adm();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_newRegist_adm(){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where(['approvment'=>'0','trash'=>'0']);
        return $this->db->count_all_results();
    }
    function approve_newRegist_adm($id){
        $data = [
            'approvment' => "1"
        ];
        if(!$this->db->update($this->_table, $data, array('id_perusahaan' => $id))){
            return false;
        }return true;
    }
    function deleteTrash_newRegist_adm($id){
        $data = [
            'trash' => "1"
        ];
        if(!$this->db->update($this->_table, $data, array('id_perusahaan' => $id))){
            return false;
        }return true;   
    }

    //MENU PERUSAHAAN
    function make_query_perusahaan_adm(){
        $this->db->select($this->select_column);
        $this->db->from($this->_table);
        $this->db->like("approvment", "1");
        $this->db->like("trash", "0");
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
            $this->db->order_by('id_perusahaan','DESC');
        }
    }
    function make_datatables_perusahaan_adm(){
        $this->make_query_perusahaan_adm();
        
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_perusahaan_adm(){
        $this->make_query_perusahaan_adm();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_perusahaan_adm(){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where(['approvment'=>'1','trash'=>'0']);
        return $this->db->count_all_results();
    }
    function disapprove_perusahaan_adm($id){
        $data = [
            'approvment' => "0"
        ];
        if(!$this->db->update($this->_table, $data, array('id_perusahaan' => $id))){
            return false;
        }else{
            return true;
        }
    }
    function deleteTrash_perusahaan_adm($id){
        $data = [
            'trash' => "1"  
        ];
        if(!$this->db->update($this->_table, $data, array('id_perusahaan' => $id))){
            return false;
        }
        return true;
    }

    //MENU TRASH
    function make_query_trash_adm(){
        $this->db->select($this->select_column);
        $this->db->from($this->_table);
        $this->db->like("trash", "1");
        $i = 0;
        foreach ($this->column_search as $item){
            if($_POST['search']['value']){
                 
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else{
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
            $this->db->order_by('id_perusahaan','DESC');
        }
    }
    function make_datatables_trash_adm(){
        $this->make_query_trash_adm();
        
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_trash_adm(){
        $this->make_query_trash_adm();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_trash_adm(){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where(['trash'=>'1']);
        return $this->db->count_all_results();
    }
    function restore_trash_adm($id){
        $data = [
            'trash' => "0"  
        ];
        if(!$this->db->update($this->_table, $data, array('id_perusahaan' => $id))){
            return false;
        }return true;
    }
    function delete_trash_adm($id){
        if(!$this->db->delete($this->_table, array('id_perusahaan' => $id))){
            return false;
        }return true;
    }


    public function update_profile_prs($id, $nama, $alamat, $no_telepon, $email, $updated_at){
        $data = [
            'nama_perusahaan' => $nama,
            'alamat_perusahaan' => $alamat,
            'no_telepon' => $no_telepon,
            'email_perusahaan' => $email,
            'updated_at' => $updated_at
        ];
        if(!$this->db->update($this->_table, $data, ['id_user'=>$id])){
            return false;
        }return true;
    }
}