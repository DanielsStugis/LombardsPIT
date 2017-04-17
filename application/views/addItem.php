<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<div class="panel panel-default">
		<div class="panel-heading"><?=$this->lang->line($this->currentPage);?>
			<?php 
				echo ($this->currentPage == "addItem" && !empty($this->uri->segment(3))) ? anchor("Item/uploadImage/".$this->uri->segment(3), "Pievienot attēlus", ["class"=>"fancybox"]) : "";
			?>

		</div>
		<div class="panel-body">
			<form method="POST" action="">
				<?php
				$simpleInput = ["text", "date","hidden", "password"];
					foreach($inputs as $input){
						if($input["type"] != "hidden"){
							echo "<label for='$input[field]'>$input[label]</label>";
						}

						if(in_array($input["type"], $simpleInput)){
							echo "<input type='$input[type]' class='form-control $input[extraClass]' value='".$data[$input["field"]]."' id='$input[field]' name='$input[field]'>";
						}
						elseif($input["type"] == "select"){
							$selectOptionsStr = "<option value=''>-</option>";
							foreach($selectOptions[$input["field"]] as $selectOption){
								$selected = $data[$input["field"]] == $selectOption["value"] ? "selected" : "";
								$selectOptionsStr .= "<option value='$selectOption[value]' $selected>$selectOption[label]</option>";
							}
							echo "<select name='$input[field]' class='form-control $input[extraClass]' id='$input[field]'>$selectOptionsStr</select>";
						}elseif($input["type"] == "checkbox"){
							$checked = !empty($data[$input["field"]]) && $data[$input["field"]] ? "checked" : "";
							echo "<input type='$input[type]' $checked class='form-control $input[extraClass]' value='1' id='$input[field]' name='$input[field]'>";
						}
					}
				?><br>
				<input type="submit" class="btn btn-success" name="submitted" value="<?=$this->lang->line('save');?>">
			</form>

			<?php
				if($this->currentPage == "addItem" && !empty($this->uri->segment(3))) {
					echo "<div id='images'></div>";
					echo "<iframe style='width: 100%; border: none;' src='".site_url("Item/uploadImage/".$this->uri->segment(3))."'></iframe>";
					echo "<script>$(document).ready(function(){
						$('#images').load('".$this->config->item("base_url")."index.php/Item/images/".$this->uri->segment(3)."');
					});</script>";
				}
			?>

		</div>		
	</div>

