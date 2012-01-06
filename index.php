<?php
define('BASE_PATH',  dirname(__FILE__) . "/");
define('HOME_URL', "http://vm142-26.iplantcollaborative.org/nagiosmonitor/");
function home_url($url) {
	return HOME_URL . $url;
}
error_reporting(E_ALL);
require_once BASE_PATH . 'api.php';

if (count($_GET) > 0) {
	$get_keys = array_keys($_GET);
	$path = $get_keys[0];
	if (substr($path, 0, 1) == "/") {
		$path = substr($path, 1);
	}
	$data = explode('/', $path);
	//pr($data);
	if (array_key_exists(0, $data)) {
		$controller = $data[0];
	} else {
		$controller = 'pages';
	}

	if (array_key_exists(1, $data)) {
		$action = $data[1];
	} else {
		$action = 'index';
	}
	
	if (array_key_exists(2, $data)) {
		$params = array_slice($data, 2);
	} else {
		$params = array();
	}

} else {
	$controller = 'pages';
	$action = 'view';
	$params = array('welcome');
}
pr($controller, $action, $params);

include BASE_PATH . 'controller.php';
include BASE_PATH . "controllers/{$controller}_controller.php";
$controller_name = ucfirst($controller) . "Controller";
$controller_instance = new $controller_name;
$controller_instance->set_request(array('controller' => $controller, 'action' => $action, 'params' => $params));
call_user_func_array(array($controller_instance, $action), $params);
call_user_func(array($controller_instance, 'render'));
//	include(BASE_PATH . "welcome.php");
$host_group_request = new NagiosRequest();
$host_group_request->set_host('http://nemo.iplantcollaborative.org/nagiosapi_beta/');
$host_group_request->set_command('hostgroups');
$host_group_data = $host_group_request->get_response();
$host_group_list = array_keys($host_group_data);
?>
