<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Public_Controller {

	public function index(){
		if(isset($_POST["username"]) && isset($_POST["pw"])){
			$this->load->model("Users");
			$authData = $this->Users->checkLogin($_POST["username"], $_POST["pw"]);
			if(!empty($authData)){
				$_SESSION["UserId"] = $authData->UserId;
				$_SESSION["UserRole"] = $authData->UserRole;
				redirect("Dashboard/index");
			}else{
				$this->errors[] = $this->lang->line("incorrectLogin");
			}
		}

		$this->load->view("header");
		$this->load->view('auth');
		$this->load->view("footer");
	}

	public function logout(){
		session_destroy();
		redirect("Dashboard/index");
	}
}
