<?php

function pr() {
	$args = func_get_args();
	foreach ($args as $arg) {
		echo "<pre>";
		var_dump($arg);
		echo "</pre>";
	}
}

class NagiosRequest {

	private $host = "http://nemo.iplantcollaborative.org/nagiosapi_beta/";
	private $command;

	public function set_host($host) {
		$this->host = $host;
	}

	public function set_command($command) {
		$this->command = $command;
	}

	public function get_response() {
		$url = $this->host . $this->command;
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		
		$json_data = json_decode($data, TRUE);
		return $json_data;
	}

}
