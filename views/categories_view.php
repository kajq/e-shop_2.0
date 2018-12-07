<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>E-Shop</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Keilor Jiménez">
    <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../../../bootstrap/css/bootstrap.css" rel="stylesheet" />
    <script src="../../../bootstrap/js/jquery-1.8.3.min.js"></script>
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>

</head>
	<body background="images/fondotot.jpg" style="background-attachment: fixed">
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
					<a href=<?php echo base_url("CategoriesController/add") ?>>
                        <img src='../../../images/new.png' title="Nueva Categoria" width="25" />
                    </a>
                </h3>
            <?php 
            extract($_GET);
            $action	   = isset($_GET["action"]) ? $_GET["action"] : "default";
            $add	   = isset($add) ? $add : false;
            $mod	   = isset($mod) ? $mod : array();
                if (($add == true) || (count($mod) > 0)) {
                	include ('include/form_category.php');
                } ?>		
			</div>
			<table border='0' class='table table-hover'>
				<tr class='warning'>
					<td>Categoria Padre</td>
					<td>Categoria</td>
					<td>Estado</td>
					<td>Editar</td>
					<td>Eliminar</td>
				</tr>
				<?php 
				foreach($ver as $category){ ?>
				<tr>	
					<td><?php echo $category->supercategory ?></td>
					<td><?php echo $category->description; ?></td>
					<td><?php if ($category->state == 1) { $state = 'Activo';}else {$state = 'Inactivo'; } echo $state; ?></td>
                    <td> <a href="<?=base_url("CategoriesController/mod/$category->id")?>"><img src='../../../images/update.jpg' class='img-rounded' width='1'></a>             
					</td>
                    <td> <a href="<?=base_url("CategoriesController/eliminar/$category->id")?>">
                    <img src='../../../images/delete.png' class='img-rounded' width='20' 
                        onclick="return confirm('¿Esta seguro de eliminar este producto?')"> </a>             
					</td>
				</tr>
				<?php 	} ?>
			</table>
			<hr/>
			<footer>
				<p>&copy; Copyright Keilor Jiménez</p>
				<hr class="soften"/>
			</footer>
			</div>
			</style>
	</body>
</html>