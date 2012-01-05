<?php
define('BASE_PATH',  dirname(__FILE__) . "/");
define('HOME_URL', "http://vm142-26.iplantcollaborative.org/nagiosmonitor/");
function home_url($url) {
	return HOME_URL . $url;
}
error_reporting(E_ALL);
require_once BASE_PATH . 'api.php';

$host_group_request = new NagiosRequest();
$host_group_request->set_host('http://nemo.iplantcollaborative.org/nagiosapi_beta/');
$host_group_request->set_command('hostgroups');
$host_group_data = $host_group_request->get_response();
//pr($host_group_data);
$host_group_list = array_keys($host_group_data);
//pr($host_group_list);

pr($_GET);
if (count($_GET) > 0) {
	$get_keys = array_keys($_GET);
	$path = $get_keys[0];
	if (substr($path, 0, 1) == "/") {
		$path = substr($path, 1);
	}
	$data = explode('/', $path);
	pr($data);
} else {
	include(BASE_PATH . "welcome.php");
}
?>
