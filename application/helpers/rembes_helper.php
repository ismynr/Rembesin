<?php 

function is_logged_in(){
	$ci = get_instance();
	if (! $ci->session->userdata('username')){
		redirect('auth');
	} else {
		$role_id = $ci->session->userdata('id_role');
		$user = $ci->uri->segment(1);
		$query_role = $ci->db->get_where('tb_role',['id_role' => $role_id]) -> row();
		
		if($query_role->role != $user){
			redirect('auth/blocked');
		}
	}
}
function getItemById($table, $column, $id){
    $CI =& get_instance();
    $nama = $CI->db->query("SELECT * FROM $table WHERE $column = '$id'")->row();
    return $nama;
}
function getUserRole(){
	$ci = get_instance();
	$userRole = $ci->session->userdata('id_role');
	if (! $userRole){
		redirect('auth');
	} else {
		if($userRole == '1'){
		  $userRole = "Admin";
		}elseif($userRole == '2'){
		  $userRole = "Perusahaan";
		}elseif($userRole == '3'){
		  $userRole = "Karyawan";
		}else{
			$userRole = "";
		}
	}
	return $userRole;
}
function getById($table, $where){
    $CI =& get_instance();
    $nama = $CI->db->query("SELECT * FROM $table $where")->row();
    return $nama;
}

function timeAgo($time_ago){
	date_default_timezone_set('Asia/Jakarta');
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "baru saja";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "satu menit yang lalu";
        }
        else{
            return "$minutes menit yang lalu";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "satu jam yang lalu";
        }else{
            return "$hours jam yang lalu";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "kemarin";
        }else{
            return "$days hari yang lalu";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "minggu lalu";
        }else{
            return "$weeks minggu yang lalu";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "bulan lalu";
        }else{
            return "$months bulan yang lalu";
        }
    }
    else if($years >= 49){
        return "belum pernah login";
    }
    //Years
    else{
        if($years==1){
            return "tahun lalu";
        }else{
            return "$years tahun yang lalu";
        }
    }
}

 ?>
