<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
// My controller, for authorisation needs
Class MY_Controller extends MY_Public_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION["UserId"]) || empty($_SESSION["UserId"])){
			// redirect to auth, too lazy to rename controller
			redirect("Welcome/index");
		}else{

		}
	}
}

// public controller parent, for pages w/out auth.
Class MY_Public_Controller extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->errors = [];
		$this->success = [];
		$this->currentPage = "";
		session_start();
		// ja ir autorizējies, nav jēgas login lapu rādīt
		if((uri_string() == "Welcome/index" || uri_string() == "") && !(!isset($_SESSION["UserId"]) || empty($_SESSION["UserId"]))){
			redirect("Dashboard/index");
		}
	}

	public function serializePost($inputs){
		$errors = [];
		$data = [];
		foreach($inputs as $input){
			if($input["rules"] == "required"){
				if(empty($this->input->post($input["field"]))){
					$errors[] = $input["field"];
				}
			}
			$data[$input["field"]] = $this->input->post($input["field"]);
		}

		return ["errors" => $errors, "data" => $data];
	}
}


?>