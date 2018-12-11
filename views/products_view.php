<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>E-Shop</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Keilor Jiménez">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="/bootstrap/css/bootstrap.css" rel="stylesheet" />
    <script src="/bootstrap/js/jquery-1.8.3.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>

</head>
	<body background="/images/fondotot.jpg" style="background-attachment: fixed">
		<div class="container">
			<header class="header">
				<?php // include ('include/cabecera.php');?>
			</header>
			<div>
				<?php include ('include/menu.php'); ?>
			</div>
			<br><br>
			<div class = "nav-collapse">
				<h3>Categorias de Productos  
					<a href=<?php echo base_url("ProductsController/add") ?>>
                        <img src='/images/new.png' title="Nueva Categoria" width="25" />
                    </a>
                </h3>
            <?php 
            extract($_GET);
            $action	   = isset($_GET["action"]) ? $_GET["action"] : "default";
            $add	   = isset($add) ? $add : false;
            $mod	   = isset($mod) ? $mod : array();
                if (($add == true) || (count($mod) > 0)) {
                	include ('include/form_product.php');
                } ?>		
			</div>
			<table border='0' class='table table-hover'>
				<tr class='warning'>
					<td>Imagen</td>
					<td>SKU</td>
					<td>Detalle</td>
					<td>Precio</td>
					<td>Cantidad</td>
					<td>Categoria</td>
					<td>Editar</td>
					<td>Eliminar</td>
				</tr>
				<?php 
				foreach($ver as $product){ ?>
				<tr class='success'>
					<td> <?php echo "<img src='/images/uploads/".$product->image_file."' class='img-rounded' width='100' alt='' />"; ?></td>
					<td> <?php echo $product->sku; ?></td>
					<td> <?php echo $product->description; ?></td>
					<td>₡<?php echo $product->price; ?></td>
					<td> <?php echo $product->in_stock . "<a href='". base_url("ProductsController/plus/$product->id/$product->in_stock") ."'><img src='/images/new.png' width='15'>" ; ?> 
					</td>
					<td> <?php echo $product->category ; ?> </td>
					<td> <a href= "<?php echo base_url("ProductsController/mod/$product->sku"); ?>"><img src='/images/update.jpg' class='img-rounded' width='25'>
					</td>
					<td> <a href= "<?php echo base_url("ProductsController/eliminar/$product->id") ?>"><img src='/images/delete.png' class='img-rounded' width='25' onclick="return 				confirm('¿Esta seguro de eliminar este producto?')" > </td>
				</tr>
				<?php 	} ?>
			</table>
			<hr/>
			<footer>
				<p>&copy; Copyright Keilor Jiménez</p>
				<hr class="soften"/>
			</footer>
			</div>
	</body>
</html>