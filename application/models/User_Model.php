<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model{
	private $_table = "tb_user";

	function reset_passwordKaryawan_prs($username, $passnew){
                $data = array(
                	'password' => $passnew
                );
                if(!$this->db->update($this->_table, $data, array('username'=>$username))){
                        return false;
                }return true;
	}

        function ubah_passwordPerusahaan_prs($id, $username, $passnew, $nowDateTime){
                $data = array(
                        'username' => $username,
                        'password' => $passnew,
                        'updated_at' => $nowDateTime
                );
                if(!$this->db->update($this->_table, $data, array('id_user'=>$id))){
                        return false;
                }return true;
        }

	function ubah_passwordKaryawan_kry($id, $username, $passnew, $nowDateTime){
                $data = array(
                	'username' => $username,
                	'password' => $passnew,
                        'updated_at' => $nowDateTime
                );
                if(!$this->db->update($this->_table, $data, array('id_user'=>$id))){
                        return false;
                }return true;
	}

        function ubah_passwordKaryawan_adm($id, $username, $passnew, $updated_at){
                $data = array(
                        'username' => $username,
                        'password' => $passnew,
                        'updated_at' => $updated_at
                );
                if(!$this->db->update($this->_table, $data, array('id_user'=>$id))){
                        return false;
                }return true;
        }

	

}