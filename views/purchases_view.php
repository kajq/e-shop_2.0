<?php //historias de compras del usuario y datos estadisticos
/*session_start();
include ("class\purchases.php");
if (@!$_SESSION['username']) {
		echo '<script>alert("Debes registrarte para poder acceder aqui")</script> ';
		echo "<script>location.href='../index.php'</script>";	
	}
$user = $_SESSION['username'];
$rol  = $_SESSION['rol'];
$oPurchase = new purchases();
$purchases = $oPurchase->select_purchases($user);*/
 ?>
<html>
<head>
	<meta charset="utf-8">
	<title>E-Shop</title>
	<meta name="viewport" ient="width=device-width, initial-scale=1.0">
    <meta name="description" ient="">
    <meta name="author" ient="Keilor Jiménez">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="/bootstrap/css/bootstrap.css" rel="stylesheet" />
    <script src="/bootstrap/js/jquery-1.8.3.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>

</head>
	<body background="/images/fondotot.jpg" style="background-attachment: fixed">
		<div class="Container">
			<header class="header">
				<?php //include ('include/cabecera.php');?>
			</header>
			<div>
				<?php include ('include/menu.php'); ?>
			</div>
			<?php if ($_SESSION['rol'] > 0) { ?>
				<div class = "nav-collapse">
					<h3>Estadisticas del Administrativas</h3>
					<table>
						<tr>
							<td>Usuarios Registrados</td>
							<td><input type="number" readonly value="<?php echo $total_users[0]->total; ?>"></td>
						</tr>
						<tr>
							<td>Productos Vendidos</td>
							<td><input type="number" readonly value="<?php echo $total_products[0]->total;?>"></td>
						</tr>
						<tr>
							<td>Total de Ventas</td>
							<td><input type="text" readonly value="<?php echo '₡'.$total_sales[0]->total; ?>"></td>
						</tr>
					</table>
				</div>
			<?php 	} ?>
			<div class = "nav-collapse">
				<h3>Historial de compras del usuario</h3>
			</div>
			<table class='table table-hover'>
				<tr class='warning'>
					<td>#Factura</td>
					<td>Fecha</td>
					<td>Cliente</td>
					<td>Cantidad <br>Productos</td>
					<td>Total</td>
					<td>Detalles</td>
				</tr>
				<?php 
				if (count($ver) == 0) {
					echo "<td>No hay compras registras por el usuario</td>";
				}{
				foreach($ver as $purchases){ ?>
				<tr>
					<td><?php echo $purchases->id_sale; ?></td>
					<td><?php echo $purchases->sale_date; ?></td>
					<td><?php echo $purchases->name . " " . $purchases->last_name; ?></td>
					<td><?php echo $purchases->sum ?></td>
					<td><?php echo '₡'.$purchases->total ?></td>
					<td><a href='<?php echo base_url("PurchasesController/details/$purchases->id_sale");?>' >
                        <img src="\images\search.png" width="30" title="Detalles"> 
                    	</a></td>
				</tr>
				<?php }} ?>
				<tr>
					<td colspan="2"></td>
					<td><h4>Total</h4></td>
					<td><h4><?php echo $total_products[0]->total?></h4></td>
					<td><h4><?php echo $total_sales[0]->total;	 ?></h4></td>
				</tr>
			</table>
			<hr/>
			<footer>
				<p>&copy; Copyright Keilor Jiménez</p>
				<hr class="soften"/>
			</footer>
			</div>
	</body>
</html>