<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
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
<form action="" method="POST" enctype="multipart/form-data">
	<input type="file" name="image" class="form-control"><br>
	<input type="submit" value="Augšupielādēt" name="upload" class="btn btn-success btn-sm">
</form>
</body>
</html>