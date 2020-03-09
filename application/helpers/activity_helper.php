<?php

function activity_log($tipe, $aksi, $item){
    $CI =& get_instance();

    if($CI->session->userdata('id_role') == "1"){
        $role = "admin";
    }elseif($CI->session->userdata('id_role') == "2"){
        $role = "perusahaan";
    }elseif($CI->session->userdata('id_role') == "3"){
        $role = "karyawan";
    }
    $param['log_user'] = $CI->session->userdata('username');
    $param['log_role'] = $role;
    $param['log_tipe'] = $tipe; //asset, asesoris, komponen, inventori
    $param['log_aksi'] = $aksi; //membuat, menambah, menghapus, mengubah,
    $param['log_item'] = $item; //nama item

    //load model log
    $CI->load->model('log_model');

    //save to database
    $CI->log_model->save_log($param);

}
?> 