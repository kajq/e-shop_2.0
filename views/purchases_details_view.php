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
				<?php //include ('include/cabecera.php');?>
			</header>
			<div>
				<?php include ('include/menu.php'); ?>
			</div>
			<br><br>
			<div class = "nav-collapse">
				<table>
					<tr>
						<td colspan="4"><h2>Tienda Electronica KAJQ S.A.</h2></td>
					</tr>
					<tr>
						<td>
							<h4>
								Reimpresión de Factura
							</h4>
						</td>
						<td colspan="4"><h4> www.e-shop.com</h4></td>
					</tr>
					<tr>
						<form action="" method="post">
						<td><label>Nombre Cliente:</label></td>
						<td><input type="text" readonly value="<?php echo $person[0]->name . " " . $person[0]->last_name; ?>"></td>
						<td><label>Fecha:</label></td>
						<td><input type="text" readonly data-date='' data-date-format="DD MMMM YYYY" value="<?php echo $cart[0]->sale_date; ?>"></td>
					</tr>
					<tr>
						<td><label>Correo Electronico</label></td>
						<td><input type="email" readonly value="<?php echo $person[0]->email; ?>"></td>
						<td><label>Teléfono</label></td>
						<td><input type="number" readonly value="<?php echo $person[0]->phone; ?>"></td>
						</form>
					</tr>
				</table>
			</div>
			<table class='table table-hover'>
				<tr class='warning'>
					<td>SKU</td>
					<td>Detalle</td>
					<td>Cantidad</td>
					<td>Precio</td>
					<td>Sub Total</td>
				</tr>
				<?php 
                $total = 0; 
                foreach($products as $product){ ?>
				<tr>
                    <td> <a href='<?php echo base_url("IndexController/mod/$product->sku_product")?>'> <?php echo $product->sku_product ?></a> <br/></td>
					<td><?php echo $product->description; ?></td>
					<td><?php echo $product->sum; ?>		</td>
					<td><?php echo "₡".$product->price; ?></td>
					<td><?php echo "₡".$product->total; ?></td>
					</tr>
				<?php 
					$total = $total + $product->total;
				}
				 ?>
				 <tr>	
				 	<td colspan="3"></td>
				 	<td><h4>Total</h4></td>
				 	<td colspan="2"><h4><?php echo "₡".$total ?></h4></td>
				 </tr>
			</table>
			<h5><a href='<?php echo base_url("PurchasesController")?>'> <img src='\images\return.jpg' width='30' title='Volver'>Volver</a></h5>
			<hr/>
			<footer>
				<p>&copy; Copyright Keilor Jiménez</p>
				<hr class="soften"/>
			</footer>
			</div>
			</style>
	</body>
</html>