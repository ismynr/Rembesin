<?php 
class Admin_model extends CI_Model{

	private $_table = "tb_admin";
	var $select_column = array("id_admin", "id_user", "nama_admin", "email", "created_at", "updated_at");
    var $order_column = array(null,null, "nama_admin","email",null,null);
    var $column_search = array("nama_admin", "email");

    public function update_profile_adm($id_user, $nama, $email, $updated_at){
        $data = [
            'nama_admin' => $nama,
            'email' => $email,
            'updated_at' => $updated_at
        ];
        $this->db->update($this->_table, $data, ['id_user'=>$id_user]);
    }
}
 ?>