<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contract extends MY_Controller {

	public function index($id=false){
		$this->currentPage = "addContract";
		$this->load->model("Contracts");
		$data = [];

		$inputs = $this->Contracts->inputStructure();
		$data["inputs"] = $inputs;

		if(isset($_POST["submitted"])){
			$serialzed = $this->serializePost($inputs);
			if(!empty($serialzed["errors"])){
				foreach($serialzed["errors"] as $errorField){
					$this->errors[] = $this->lang->line("requiredFieldEmpty")." - ".$this->lang->line($errorField);
				}
			}else{
				if(isset($id) && is_numeric($id)){
					$this->Contracts->update($serialzed["data"], $id);
				}else{
					$this->Contracts->add($serialzed["data"]);
				}
				$this->success[] = $this->lang->line("dataSaved");
			}
		}

		if($id){
			$data["data"] = $this->Contracts->getContract($id);
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

		$this->load->model("Clients");
		$clients =  $this->Clients->getAll();
		$data["selectOptions"]["ClientId"] = [];

		foreach($clients as $client){
			$data["selectOptions"]["ClientId"][] = 
				[
					"value" => $client->ClientId,
					"label" => $client->ClientName . " " . $client->ClientSurname
				];
		}

		$this->load->model("Items");
		$items =  $this->Items->getAll();
		$data["selectOptions"]["ItemId"] = [];

		foreach($items as $item){
			$data["selectOptions"]["ItemId"][] = 
				[
					"value" => $item->ItemId,
					"label" => $item->ItemTitle
				];
		}

		$this->load->view("header");
		$this->load->view('addItem', $data);
		$this->load->view("footer");
	}

	public function search(){
		$this->load->model("Contracts");
		$this->currentPage = "searchContracts";
		$data["results"] = $this->Contracts->search($this->input->get("term"));
		$this->load->library("table");

		$this->load->view("header");
		$this->load->view("search",$data);	
		$this->load->view("footer");
	}
}
