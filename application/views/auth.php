<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<br>
	<div class="panel panel-default">
		<div class="panel-heading"><?=$this->lang->line("auth");?></div>
		<div class="panel-body">
			<form method="POST" action="">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input id="username" type="text" class="form-control" name="username">
				</div><br>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<input id="password" type="password" class="form-control" name="pw">
				</div><br>
				<input type="submit" class="btn btn-success" value="<?=$this->lang->line("continue");?>">
			</form>
		</div>		
	</div>




