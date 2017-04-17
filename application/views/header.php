<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$this->lang->line("appName");?></title>
	<!-- 
		Too lazy to set thos up with project
	-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</head>
<body>
<?php 
if(isset($_SESSION["UserId"]) && !empty($_SESSION["UserId"])){ 
$itemsForAdd = ["addItem", "addClient", "addContract", "addUser"];
$itemsForSearch = ["searchItems", "searchClients", "searchContracts", "searchUsers"];

?>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="<?=$this->config->item("base_url");?>"><?=$this->lang->line("appName");?></a>
	    </div>
	    <ul class="nav navbar-nav">

			<li class="dropdown <?=(in_array($this->currentPage, $itemsForAdd)) ? "active" : ""?>">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Pievienošana
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						 <li <?=($this->currentPage == "addItem") ? "class='active'" : "" ?>><?=anchor("Item/index", $this->lang->line("addItem"));?></li>
						 <li <?=($this->currentPage == "addClient") ? "class='active'" : "" ?>><?=anchor("Client/index", $this->lang->line("addClient"));?></li>
						 <li <?=($this->currentPage == "addContract") ? "class='active'" : "" ?>><?=anchor("Contract/index", $this->lang->line("addContract"));?></li>
						 <?php
						 if(isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] == 1){
						 ?>
						 	<li <?=($this->currentPage == "addUser") ? "class='active'" : "" ?>><?=anchor("User/index", $this->lang->line("addUser"));?></li>
					 	<?php } ?>
					</ul>
				</li>


			<li class="dropdown <?=(in_array($this->currentPage, $itemsForSearch)) ? "active" : ""?>">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Meklēšana
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li <?=($this->currentPage == "searchItems") ? "class='active'" : "" ?>><?=anchor("Item/search", $this->lang->line("searchItems"));?></li>
						<li <?=($this->currentPage == "searchClients") ? "class='active'" : "" ?>><?=anchor("Client/search", $this->lang->line("searchClients"));?></li>
						<li <?=($this->currentPage == "searchContracts") ? "class='active'" : "" ?>><?=anchor("Contract/search", $this->lang->line("searchContracts"));?></li>
						<?php
						if(isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] == 1){
							?>
							<li <?=($this->currentPage == "searchUsers") ? "class='active'" : "" ?>><?=anchor("User/search", $this->lang->line("searchUsers"));?></li>
						<?php } ?>
					</ul>
				</li>
		    </ul>
			<ul class="nav navbar-nav navbar-right">
				<li><?=anchor("Welcome/logout", "<span class=\"glyphicon glyphicon-log-out\"> Iziet</span></a>")?></li>
			</ul>
	  </div>
	</nav>
<?php } ?>
	<div class="container">
	<?php 
		foreach($this->errors as $error){
			echo "<div class=\"alert alert-danger\">
			  <strong>Kļūda!</strong> ".$error."
			</div>";
		}

		foreach($this->success as $error){
			echo "<div class=\"alert alert-success\">
			  <strong>OK!</strong> ".$error."
			</div>";
		}
	?>