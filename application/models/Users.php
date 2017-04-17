<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class Users extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function checkLogin($username, $pw){
		$this->db->select("UserId, UserName, UserSurname, UserRole")
		->where("UserLoginName",$username)
		->where("UserPassword",md5($pw));

		$query = $this->db->get("Users");

		return $query->row();
	}

	public function update($data, $id){
		unset($data["UserId"]);
		if(empty($data["UserPassword"])){
			unset($data["UserPassword"]);
		}
		$this->db->where("UserId",$id);
		$this->db->update("Users", $data);
		$data["UserId"] = $id;
	}

	public function add($data){
		unset($data["UserId"]);
		$data["UserPassword"] = md5($data["UserPassword"]);
		$this->db->insert("Users", $data);
		unset($data["UserPassword"]);
	}

	public function getContract($id){
		$this->db->select("*")
		->where("UserId", $id);
		return $this->db->get("Users")->row_array();
	}

	public function getAll(){
		$this->db->select("*");
		$query = $this->db->get("Users");

		return $query->result();
	}

	public function getUser($id){
		$this->db->select("*")
		->where("UserId", $id);
		$user =  $this->db->get("Users")->row_array();
		$user["UserPassword"] = "";
		return $user;
	}

	public function search($term){
		$this->db->select("UserId as id, UserLoginName as title")
		->like("UserLoginName",$term)
		->or_like("UserName",$term)
		->or_like("UserSurname",$term);

		return $this->db->get("Users")->result_array();
	}

	function inputStructure(){
		return 
			[
				[
					"field"			=> "UserId",
					"label"			=> $this->lang->line("UserId"),
					"rules"			=> "",
					"type"			=> "hidden",
					"extraClass"	=> ""
				],
				[
					"field"			=> "UserName",
					"label"			=> $this->lang->line("ClientName"),
					"rules"			=> "required",
					"type"			=> "text",
					"extraClass"	=> ""
				],
				[
					"field"			=> "UserSurname",
					"label"			=> $this->lang->line("ClientSurname"),
					"rules"			=> "required",
					"type"			=> "text",
					"extraClass"	=> ""
				],
				[
					"field"			=> "UserLoginName",
					"label"			=> $this->lang->line("UserLoginName"),
					"rules"			=> "required",
					"type"			=> "text",
					"extraClass"	=> ""
				],
				[
					"field"			=> "UserPassword",
					"label"			=> $this->lang->line("UserPassword"),
					"rules"			=> "",
					"type"			=> "password",
					"extraClass"	=> ""
				],
				[
					"field"			=> "UserRole",
					"label"			=> $this->lang->line("UserRole"),
					"rules"			=> "required",
					"type"			=> "select",
					"extraClass"	=> ""
				]

			];
	}
}
