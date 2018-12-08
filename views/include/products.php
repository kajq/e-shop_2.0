<hr class="soften"/>
<div class="row" style="text-align:left;">
<?php //include de productos que se muestran en el incio
$type 	   = isset($_GET["type"]) ? $_GET["type"] : "";
if ($type == 'prod') {
	include ('product_details.php');
}

foreach($categories as $category){ 
	echo "<h3>Categoria: " . $category->description . "</h3>";
			
	/*if (count($subcategory) > 0) {		   			
		echo "<h4>Subcategorias</h4>";
		for ($j=0; $j < (count($subcategory)/2); $j++) { 
			echo "<div class='span3'>";
			echo 	"<div class='well well-small'>";
			echo 		"<h5>" . $subcategory['description='.$j] . "</h5>";
			echo 		"<a href='Index.php?type=cat&id=".$subcategory['id='.$j]."'><small>Ver detalles</small></a>";
			echo "</div> </div>";
		}
	
	echo "<br><br><br><br><br><br>";
	}*/
	echo "<div class='row'>";
	foreach($products as $product){
		if ($product->id_category == $category->id){ 
		//if ($product['in_stock='.$k] > 0) {
			echo 	"<div class='span6'>";
			echo 		"<div class='thumbnail'>";
			echo		  "<h4 style='text-align:center'>".$product->description."</h4>";
			echo		"<img src='../images/uploads/".$product->image_file."' width='250'/>";
			echo 			"<div class='caption'>";
			echo 				"<a class='pull-right' href='Index.php?type=prod&sku=" .        $product->sku . "' >".$product->sku ."</a> <br/>";
			
			echo 	"</div></div></div>";
		}
	} if (count($products) == 0) {
		echo "<div class='span6'> <h4 style='text-align:center'> No hay productos de esta categoria</h4> </div>";
	}
	echo "</div> <br>";
	echo "<hr class='soften'/>";
} 

 ?>