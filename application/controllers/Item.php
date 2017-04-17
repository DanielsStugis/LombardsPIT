<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends MY_Controller {

	public function index($id=false){
		$this->currentPage = "addItem";
		$this->load->model("Items");
		$data = [];

		$inputs = $this->Items->inputStructure();
		$data["inputs"] = $inputs;

		if(isset($_POST["submitted"])){
			$serialzed = $this->serializePost($inputs);
			if(!empty($serialzed["errors"])){
				foreach($serialzed["errors"] as $errorField){
					$this->errors[] = $this->lang->line("requiredFieldEmpty")." - ".$this->lang->line($errorField);
				}
			}else{
				if(isset($id) && is_numeric($id)){
					$this->Items->update($serialzed["data"], $id);
				}else{
					$this->Items->add($serialzed["data"]);
				}
				$this->success[] = $this->lang->line("dataSaved");
			}
		}

		if($id){
			$data["data"] = $this->Items->getItem($id);
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

		$this->load->view("header");
		$this->load->view('addItem', $data);
		$this->load->view("footer");
	}

	public function search(){
		$this->load->model("Items");
		$this->currentPage = "searchItems";
		$data["results"] = $this->Items->search($this->input->get("term"));
		$this->load->library("table");

		$this->load->view("header");
		$this->load->view("search",$data);	
		$this->load->view("footer");
	}

	public function uploadImage($id){
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10000;

		$this->load->library('upload', $config);

		if(isset($_POST["upload"])){
			if (!$this->upload->do_upload('image')){
				$this->errors[] = $this->upload->display_errors();
			}
			else{
				$this->success[] = "Attēls pievienots";
				$this->load->model("Items");
				$this->Items->addImage($id, $this->upload->data('file_name'));
			}
		}

		$this->load->view("upload");
	}

	public function images($id){
		$this->load->model("Items");
		$data["images"] = $this->Items->getImages($id);
		$this->load->view("images",$data);
	}
}
