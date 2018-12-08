<hr class="soften"/>
<div class="row" style="text-align:left;">
<?php 
$mod	   = isset($mod) ? $mod : false;
if ($mod == true) {
	include ('product_details.php');
}

foreach($categories as $category){ 
	echo "<h3>Categoria: " . $category->description . "</h3>";
	echo "<div class='row'>";
	foreach($products as $product){
		if ($product->id_category == $category->id){ 
			echo 	"<div class='span6'>";
			echo 		"<div class='thumbnail'>";
			echo		  "<h4 style='text-align:center'>".$product->description."</h4>";
			echo		"<img src='/images/uploads/".$product->image_file."' width='250'/>";
			echo 			"<div class='caption'>";
			echo 				"<a class='pull-right' href='".base_url("IndexController/mod/$product->id")."' >".$product->sku ."</a> <br/>";
			
			echo 	"</div></div></div>";
		}  
	} 
	echo "</div> <br>";
	echo "<hr class='soften'/>";
} 

 ?>