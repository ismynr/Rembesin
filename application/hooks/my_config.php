<?php
  //Loads configuration from database into global CI config
  function load_config()
  {
   $CI =& get_instance();
   foreach($CI->web_config_model->get_all()->result() as $site_config)
   {
    $CI->config->set_item($site_config->key,$site_config->value);
   }
  }

//   $hook['post_controller_constructor'] = function(){
// 	$CI = get_instance();
// 	$CI->load->model('web_config_model');
// 	$web_config = $CI->web_config_model->get_configurations();
// 	if($web_config){
// 		foreach ($web_config as $key) {
// 			$CI->config->set_item($web_config->key, $web_config->value);
// 		}
// 	}
// };
?>