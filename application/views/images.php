<h3>Attēli:</h3>
<?php 
foreach($images as $image){
	echo "<img src=\"".$this->config->item("base_url")."uploads/".$image["PhotoFilename"]."\" class='img-responsive'>";
}

?>

