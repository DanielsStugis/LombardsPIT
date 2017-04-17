<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	$controller = $this->uri->segment(1);
?>

	<div class="panel panel-default">
		<div class="panel-heading"><?=$this->lang->line($this->currentPage);?></div>
		<div class="panel-body">
			<form method="GET" action="">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
					<input type="text" name="term" class="form-control" value="<?=$this->input->get("term")?>">
				</div>
			</form>

			<br>
			<table class="table table-condensed table-hover table-striped">
			<thead><tr><th>ID</th><th><?=$this->lang->line("title")?></th></tr></thead>
				<?php
				foreach($results as $result){
					echo "<tr><td>$result[id]</td><td>".anchor("$controller/index/$result[id]",$result["title"])."</td></tr>";
				}
			?>

			</table>

			
		</div>		
	</div>
