<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
// hook for enable/disable profiling
// $hook['post_controller_constructor'][] = array(
// 	'class'    => 'ProfilerEnabler',
// 	'function' => 'enableProfiler',
// 	'filename' => 'hooks.profiler.php',
// 	'filepath' => 'hooks',
// 	'params'   => array()
// );
$hook['post_controller_constructor'] = array(
         'class'    => '',
         'function' => 'load_config',
         'filename' => 'my_config.php',
         'filepath' => 'hooks'
         );

// $hook['post_controller_constructor'] = function(){
// 	$CI = get_instance();
// 	$CI->load->model('web_config_model');
// 	$web_config = $CI->web_config_model->get_configurations();
// 	if($web_config){
// 		foreach ($web_config as $key) {
// 			$CI->config->set_item($web_config->key, $web_config->value);
// 		}
// 	}
// };
