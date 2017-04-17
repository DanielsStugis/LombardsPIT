<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends MY_Controller {

	public function index($id=false){
		$this->currentPage = "addClient";
		$this->load->model("Clients");
		$data = [];

		$inputs = $this->Clients->inputStructure();
		$data["inputs"] = $inputs;

		if(isset($_POST["submitted"])){
			$serialzed = $this->serializePost($inputs);
			if(!empty($serialzed["errors"])){
				foreach($serialzed["errors"] as $errorField){
					$this->errors[] = $this->lang->line("requiredFieldEmpty")." - ".$this->lang->line($errorField);
				}
			}else{
				if(isset($id) && is_numeric($id)){
					$this->Clients->update($serialzed["data"], $id);
				}else{
					$this->Clients->add($serialzed["data"]);
				}
				$this->success[] = $this->lang->line("dataSaved");
			}
		}

		if($id){
			$data["data"] = $this->Clients->getClient($id);
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

		$this->load->view("header");
		$this->load->view('addItem', $data);
		$this->load->view("footer");
	}

	public function search(){
		$this->load->model("Clients");
		$this->currentPage = "searchClients";
		$data["results"] = $this->Clients->search($this->input->get("term"));
		$this->load->library("table");

		$this->load->view("header");
		$this->load->view("search",$data);	
		$this->load->view("footer");
	}
}
