<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function index($id=false){
		$this->currentPage = "addUser";
		$this->load->model("Users");
		$data = [];

		$inputs = $this->Users->inputStructure();
		$data["inputs"] = $inputs;

		if(isset($_POST["submitted"])){
			$serialzed = $this->serializePost($inputs);
			if(!empty($serialzed["errors"])){
				foreach($serialzed["errors"] as $errorField){
					$this->errors[] = $this->lang->line("requiredFieldEmpty")." - ".$this->lang->line($errorField);
				}
			}else{
				if(isset($id) && is_numeric($id)){
					$this->Users->update($serialzed["data"], $id);
				}else{
					$this->Users->add($serialzed["data"]);
				}
				$this->success[] = $this->lang->line("dataSaved");
			}
		}

		if($id){
			$data["data"] = $this->Users->getUser($id);
		}else{
			if(isset($serialzed)){
				$data["data"] = $serialzed["data"];
			}else{
				$data["data"] = [];
				foreach($inputs as $input){
					$data["data"][$input["field"]] = "";
				}
			}
		}

		$roles = 
			[
				[
					"RoleId" => 1,
					"RoleTitle" => "Administrators"
				],
				[
					"RoleId" => 2,
					"RoleTitle" => "Lietotajs"
				]
			];
		$data["selectOptions"]["UserRole"] = [];

		foreach($roles as $role){
			$data["selectOptions"]["UserRole"][] = 
				[
					"value" => $role["RoleId"],
					"label" => $role["RoleTitle"]
				];
		}

		$this->load->view("header");
		$this->load->view('addItem', $data);
		$this->load->view("footer");
	}

	public function search(){
		$this->load->model("Users");
		$this->currentPage = "searchUsers";
		$data["results"] = $this->Users->search($this->input->get("term"));
		$this->load->library("table");

		$this->load->view("header");
		$this->load->view("search",$data);	
		$this->load->view("footer");
	}
}
