<hr class="soften"/>
<div class="row" style="text-align:left;">
<?php 
$mod	   = isset($mod) ? $mod : false;
if ($mod == true) {
	include ('product_details.php');
}

foreach($categories as $category){ ?>
	<h3>Categoria: <?php echo $category->description; ?> </h3>
	<div class='row'>
	<?php foreach($products as $product){
		if ($product->id_category == $category->id){ ?>
			<div class='span6'>
				<div class='thumbnail'>
				  <h4 style='text-align:center'> <?php echo $product->description ?> </h4>
					<img src='/images/uploads/<?php echo $product->image_file ?>' width='250'/>
			 			<div class='caption'>
							<a class='pull-right' href='<?php echo base_url("IndexController/mod/$product->id")?>' ><?php echo $product->sku ?></a> <br/>
						 </div>
				</div>
			</div>
	
	</div> <br>
	<hr class='soften'/>
 <?php	}  
	}
} ?>

 