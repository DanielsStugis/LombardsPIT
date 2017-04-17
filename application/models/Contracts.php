<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class Contracts extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	public function update($data, $id){
		unset($data["ContractId"]);
		$this->db->where("ContractId",$id);
		$this->db->update("Contracts", $data);
		$data["ContractId"] = $id;
	}

	public function add($data){
		unset($data["ContractId"]);
		$this->db->insert("Contracts", $data);
	}

	public function getContract($id){
		$this->db->select("*")
		->where("ContractId", $id);
		return $this->db->get("Contracts")->row_array();
	}

	public function getAll(){
		$this->db->select("*");
		$query = $this->db->get("Contracts");

		return $query->result();
	}

	public function search($term){
		$this->db->select("ContractId as id, ContractNumber as title")
		->like("ContractNumber",$term)
		->or_like("Items.ItemTitle",$term)
		->or_like("concat(Clients.ClientName, Clients.ClientSurname)",$term)
		->join("Items","Items.ItemId = Contracts.ItemId")
		->join("Clients", "Clients.ClientId = Contracts.ClientId");

		return $this->db->get("Contracts")->result_array();
	}

	function inputStructure(){
		return 
			[
				[
					"field"			=> "ContractId",
					"label"			=> $this->lang->line("ContractId"),
					"rules"			=> "",
					"type"			=> "hidden",
					"extraClass"	=> ""
				],
				[
					"field"			=> "ContractNumber",
					"label"			=> $this->lang->line("ContractNumber"),
					"rules"			=> "required",
					"type"			=> "text",
					"extraClass"	=> ""
				],
				[
					"field"			=> "ItemId",
					"label"			=> $this->lang->line("ItemId"),
					"rules"			=> "required",
					"type"			=> "select",
					"extraClass"	=> ""
				],
				[
					"field"			=> "ClientId",
					"label"			=> $this->lang->line("ClientId"),
					"rules"			=> "required",
					"type"			=> "select",
					"extraClass"	=> ""
				]

			];
	}
}
