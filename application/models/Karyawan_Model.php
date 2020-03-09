<?php 

class Karyawan_Model extends CI_Model{

	private $_table = "tb_karyawan";
	var $select_column = array("id_karyawan","id_user","id_perusahaan","kode_karyawan","nama_karyawan","jk_karyawan","email_karyawan","alamat_karyawan","jabatan_karyawan","identitas_karyawan","no_identitas_karyawan","created_at","updated_at");
    var $order_column = array(null,null,null,"nama_karyawan", "email_karyawan","alamat_karyawan","jabatan_karyawan", null, null);
    var $column_search = array("nama_karyawan", "email_karyawan","alamat_karyawan","jabatan_karyawan");

    //DATATABLES FOR PERUSAHAAN PAGE
    function make_query_dataKaryawan_prs(){
        $get_id_perusahaan=$this->db->get_where("tb_perusahaan", ["id_user" => $this->session->userdata('id_user')])->row();
        $this->db->select($this->select_column);
        $this->db->from($this->_table);
        $this->db->where(['id_perusahaan'=>$get_id_perusahaan->id_perusahaan]);
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
            $this->db->order_by('id_karyawan','DESC');
        }
    }
    function make_datatables_dataKaryawan_prs(){
        $this->make_query_dataKaryawan_prs();
        if(isset($_POST['length']) && $_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_dataKaryawan_prs(){
        $this->make_query_dataKaryawan_prs();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_dataKaryawan_prs(){
        $get_id_perusahaan=$this->db->get_where("tb_perusahaan", ["id_user" => $this->session->userdata('id_user')])->row();
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where(['id_perusahaan'=>$get_id_perusahaan->id_perusahaan]);
        return $this->db->count_all_results();
    }
    public function add_formTambahKaryawan_prs(){
    	$get_id_perusahaan=$this->db->get_where("tb_perusahaan", ["id_user" => $this->session->userdata('id_user')])->row();
    	date_default_timezone_get('Asia/Karachi');
		$nowDateTime = date('Y-m-d H:i:s');
    	
		$data_user = [
				'username' => htmlspecialchars($this->input->post('username')),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'id_role' => '3',
				'created_at' => $nowDateTime,
				'updated_at' => $nowDateTime
			];
		if(!$this->db->insert("tb_user", $data_user)){
            return false;
        }

		$u = htmlspecialchars($this->input->post('username'));
		$get_id_user = $this->db->get_where('tb_user',array('username' => $u))->row();
		$data = [
			'id_user' => $get_id_user->id_user,
			'id_perusahaan' => $get_id_perusahaan->id_perusahaan,
            'kode_karyawan' => htmlspecialchars($this->input->post('kode_karyawan')),
            'jk_karyawan' => $this->input->post('radio'),
            'identitas_karyawan' => htmlspecialchars($this->input->post('jenis_identitas')),
            'no_identitas_karyawan' => htmlspecialchars($this->input->post('no_identitas')),
			'nama_karyawan' => htmlspecialchars($this->input->post('nama_karyawan')),
			'jabatan_karyawan' => htmlspecialchars($this->input->post('jabatan')),
			'email_karyawan' => htmlspecialchars($this->input->post('email')),
			'alamat_karyawan' => htmlspecialchars($this->input->post('alamat')),
			'created_at' => $nowDateTime,
			'updated_at' => $nowDateTime
		];
        if(!$this->db->insert($this->_table, $data)){
            $this->db->delete("tb_user", ['id_user' => $get_id_user->id_user]);
            return false;
        }return true;
    }
    public function update_dataKaryawan_prs($id, $jabatan){
        $data = [
            'jabatan_karyawan' => $jabatan
        ];
        if(!$this->db->update($this->_table, $data, ['id_karyawan'=>$id])){
            return false;
        }return true;
    }
    public function delete_dataKaryawan_prs($id){
        $get_id_user = $this->db->get_where('tb_karyawan',array('id_karyawan' => $id))->row();

        $query = $this->db->query('SELECT * FROM tb_master_rembes INNER JOIN tb_rembes ON tb_master_rembes.id_master_rembes=tb_rembes.id_master_rembes WHERE tb_master_rembes.id_karyawan='.$id);

        foreach ($query->result() as $row)
        {
            unlink("./assets/document/karyawan/images/$row->foto_nota");
        }

        $query2 = 'DELETE tb_master_rembes FROM tb_master_rembes INNER JOIN tb_rembes ON tb_master_rembes.id_master_rembes=tb_rembes.id_master_rembes WHERE tb_master_rembes.id_karyawan='.$id;

        if(!$this->db->delete($this->_table, array('id_karyawan' => $id)) || !$this->db->delete("tb_user", array('id_user' => $get_id_user->id_user)) || !$this->db->query($query2)){
            return false;
        }return true;
    }


    public function update_profile_kry($id, $nama, $email, $alamat, $nowDateTime, $jenis_identitas, $no_identitas,$jk){
        $data = [
            'nama_karyawan' => $nama,
            'alamat_karyawan' => $alamat,
            'email_karyawan' => $email,
            'jk_karyawan'=>$jk,
            'updated_at' => $nowDateTime,
            'identitas_karyawan' => $jenis_identitas,
            'no_identitas_karyawan' => $no_identitas
        ];
        if(!$this->db->update($this->_table, $data, ['id_user'=>$id])){
            return false;
        }return true;
    }
}