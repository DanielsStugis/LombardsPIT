<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class Items extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	public function update($data, $id){
		unset($data["ItemId"]);
		$this->db->where("ItemId",$id);
		$this->db->update("Items", $data);
		$data["ItemId"] = $id;
	}

	public function add($data){
		unset($data["ItemId"]);
		$this->db->insert("Items", $data);
	}

	public function getItem($id){
		$this->db->select("*")
		->where("ItemId", $id);
		return $this->db->get("Items")->row_array();
	}

	public function getAll(){
		$this->db->select("*");
		$query = $this->db->get("Items");

		return $query->result();
	}

	public function search($term){
		$this->db->select("ItemId as id, ItemTitle as title")
		->like("ItemTitle",$term)
		->or_like("cast(ItemReceivedAt as char)",$term)
		->or_like("cast(ItemKeepTill as char)",$term)
		->or_like("concat(ClientName,ClientSurname)",$term)
		->or_like("ItemIdentificationNumber",$term)
		->or_like("cast(ItemPrice as char)",$term)
		->or_like("cast(ItemPercentPerMonth as char)",$term)
		->join("Clients", "Items.ClientId = Clients.ClientId");

		return $this->db->get("Items")->result_array();
	}

	public function addImage($id, $file){
		$this->db->insert("Photos", ["ItemId" => $id, "PhotoFileName" => $file]);
	}

	public function getImages($id){
		return $this->db->select("*")
		->where("ItemId", $id)
		->get("Photos")->result_array();
	}

	function inputStructure(){
		return 
			[
				[
					"field"			=> "ItemId",
					"label"			=> $this->lang->line("ItemId"),
					"rules"			=> "",
					"type"			=> "hidden",
					"extraClass"	=> ""
				],
				[
					"field"			=> "ItemTitle",
					"label"			=> $this->lang->line("ItemTitle"),
					"rules"			=> "required",
					"type"			=> "text",
					"extraClass"	=> ""
				],
				[
					"field"			=> "ItemReceivedAt",
					"label"			=> $this->lang->line("ItemReceivedAt"),
					"rules"			=> "required",
					"type"			=> "date",
					"extraClass"	=> "datePicker"
				],
				[
					"field"			=> "ItemKeepTill",
					"label"			=> $this->lang->line("ItemKeepTill"),
					"rules"			=> "required",
					"type"			=> "date",
					"extraClass"	=> "datePicker"
				],
				[
					"field"			=> "ClientId",
					"label"			=> $this->lang->line("Client"),
					"rules"			=> "required",
					"type"			=> "select",
					"extraClass"	=> "select2"
				],
				[
					"field"			=> "ItemIdentificationNumber",
					"label"			=> $this->lang->line("ItemIdentificationNumber"),
					"rules"			=> "required",
					"type"			=> "text",
					"extraClass"	=> ""
				],
				[
					"field"			=> "ItemPrice",
					"label"			=> $this->lang->line("ItemPrice"),
					"rules"			=> "required",
					"type"			=> "text",
					"extraClass"	=> ""
				],
				[
					"field"			=> "ItemPercentPerMonth",
					"label"			=> $this->lang->line("ItemPercentPerMonth"),
					"rules"			=> "required",
					"type"			=> "text",
					"extraClass"	=> ""
				],
				[
					"field"			=> "ItemInStock",
					"label"			=> $this->lang->line("ItemInStock"),
					"rules"			=> "",
					"type"			=> "checkbox",
					"extraClass"	=> ""
				],


			];
	}

}


?>