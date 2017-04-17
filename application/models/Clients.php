<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class Clients extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	public function update($data, $id){
		unset($data["ClientId"]);
		$this->db->where("ClientId",$id);
		$this->db->update("Clients", $data);
		$data["ClientId"] = $id;
	}

	public function add($data){
		unset($data["ClientId"]);
		$this->db->insert("Clients", $data);
	}

	public function getClient($id){
		$this->db->select("*")
		->where("ClientId", $id);
		return $this->db->get("Clients")->row_array();
	}

	public function getAll(){
		$this->db->select("*");
		$query = $this->db->get("Clients");

		return $query->result();
	}

	public function search($term){
		$this->db->select("ClientId as id, concat(ClientName, ' ', ClientSurname) as title")
		->like("ClientSurname",$term)
		->or_like("ClientName",$term)
		->or_like("ClientPersonCode",$term)
		->or_like("ClientPhoneNumber",$term)
		->or_like("ClientAddress",$term);

		return $this->db->get("Clients")->result_array();
	}

	function inputStructure(){
		return 
			[
				[
					"field"			=> "ClientId",
					"label"			=> $this->lang->line("ClientId"),
					"rules"			=> "",
					"type"			=> "hidden",
					"extraClass"	=> ""
				],
				[
					"field"			=> "ClientName",
					"label"			=> $this->lang->line("ClientName"),
					"rules"			=> "required",
					"type"			=> "text",
					"extraClass"	=> ""
				],
				[
					"field"			=> "ClientSurname",
					"label"			=> $this->lang->line("ClientSurname"),
					"rules"			=> "required",
					"type"			=> "text",
					"extraClass"	=> "datePicker"
				],
				[
					"field"			=> "ClientPersonCode",
					"label"			=> $this->lang->line("ClientPersonCode"),
					"rules"			=> "required",
					"type"			=> "text",
					"extraClass"	=> "datePicker"
				],
				[
					"field"			=> "ClientPhoneNumber",
					"label"			=> $this->lang->line("ClientPhoneNumber"),
					"rules"			=> "required",
					"type"			=> "text",
					"extraClass"	=> "select2"
				],
				[
					"field"			=> "ClientEmail",
					"label"			=> $this->lang->line("ClientEmail"),
					"rules"			=> "required",
					"type"			=> "text",
					"extraClass"	=> ""
				],
				[
					"field"			=> "ClientAddress",
					"label"			=> $this->lang->line("ClientAddress"),
					"rules"			=> "required",
					"type"			=> "text",
					"extraClass"	=> ""
				]

			];
	}
}


?>