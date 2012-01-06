<?php

class PagesController extends Controller {
	
	function view($page) {
		$host_group_request = new NagiosRequest();
		$host_group_request->set_host('http://nemo.iplantcollaborative.org/nagiosapi_beta/');
		$host_group_request->set_command('hostgroups');
		$host_group_data = $host_group_request->get_response();
		$host_group_list = array_keys($host_group_data);

		$data = array('host_group_list' => $host_group_list);
		$this->set($data);
	}

}
