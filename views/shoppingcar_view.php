.......<?php	//Crud que represental al carrito de compras
/*session_start();
include ("class\sales.php");
include ("class\products.php");
if (@!$_SESSION['username'] || $_SESSION['rol'] == '2') {
		echo '<script>alert("Debes registrarte para poder comprar")</script> ';
		echo "<script>location.href='../index.php'</script>";	
	}
extract($_GET);
$oSale = new sales();
$oProduct = new products();
$customer = $oSale->customer();
$cart 	  = $oSale->cart('');
$products = $oSale->products_cart($cart['id_sale']);
$action	    = isset($_GET["action"])     ? $_GET["action"] : "";
$sum	    = isset($_GET["sum"])     ? $_GET["sum"] : "";
if ($action == 'new') {
	$oSale->check_cart();
} elseif ($action == 'add') {
	$sum++;
	$oSale->change_sum($cart['id_sale'], $sku, $sum);
	echo "<script>location.href='../shopping_car.php'</script>";		
} elseif ($action == 'less') {
	$sum--;
	$oSale->change_sum($cart['id_sale'], $sku, $sum);
	echo "<script>location.href='../shopping_car.php'</script>";		
} elseif ($action == 'drop') {
	$oSale->drop_product($id);
	echo "<script>location.href='../shopping_car.php'</script>";		
} elseif ($action == 'to_buy') {
	$oSale->to_buy($cart['id_sale'],$products);
}
*/
?>
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
				<?php 	$mod = isset($mod) ? $mod : false;
                    if ($mod == true) {
                        include ('product_details.php');
                    }
				?>
				<table>
					<tr>
						<td colspan="4"><h2>Tienda Electronica KAJQ S.A.</h2></td>
					</tr>
					<tr>
						<td colspan="4"><h4>www.e-shop_2.0.cpm</h4></td>
					</tr>
					<tr>
                        <form action="" method="post">
                        <?php foreach($person as $customer){ ?>
						<td><label>Nombre Cliente:</label></td>
						<td><input type="text" readonly value="<?php echo $customer->name . " " . $customer->last_name; ?>"></td>
						<td><label>Fecha:</label></td>
						<td><input type="text" readonly data-date='' data-date-format="DD MMMM YYYY" value="<?php echo $customer->date; ?>"></td>
						<td rowspan="1"> <input class="btn btn-danger" type="submit" name="submit" value="Confirmar Compra" onclick="return confirm('¿Esta seguro de realizar la compra?')"></td>
					</tr>
					<tr>
						<td><label>Correo Electronico</label></td>
						<td><input type="email" readonly value="<?php echo $customer->email; ?>"></td>
						<td><label>Teléfono</label></td>
                        <td><input type="number" readonly value="<?php echo $customer->phone; ?>"></td>
                        <?php } ?>
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
					<td>Eliminar</td>
				</tr>
                <?php 
                $total = 0;
                foreach($products as $product){ ?>
				<tr>
					<td> <a href='<?php echo base_url("IndexController/mod/$product->sku_product")?>'> <?php echo $product->sku_product ?></a> <br/></td>
					<td><?php echo $product->description; ?></td>
                    <td><?php echo $product->sum;

					if ($product->sum < $product->in_stock) {
						echo "<a href='" . base_url("SalesController/change_sum/add/$product->id_sale/$product->sku_product/$product->sum") . "'> <img src='\images\\new.png' width='20' title='Agregar'> </a>";
					}
					if ($product->sum > 1) {
					 	echo "<a href='" . base_url("SalesController/change_sum/less/$product->id_sale/$product->sku_product/$product->sum") . "'> <img src='\images\minus.png' width='20' title='Disminuir'> </a>";
					 }
					 if ($product->sum > $product->in_stock) {
					 	if ($product->in_stock == 0) {
					 		$msj = "Disculpa, pero ya no quedan ejemplares de este producto \n Favor eliminar este registro";
					 	} else {
					 		$msj = "Disculpa, pero solo quedan ".$product->in_stock . " ejemplares de este producto \n Favor disminuir la cantidad";
					 	}
					   	echo "<img src='/images/alert.png' width='20' title='".$msj."'>";
					   }  
					 ?>
                         
					</td>
					<td><?php echo "₡".$product->price; ?></td>
					<td><?php echo "₡".$product->total; ?></td>
					<td><a href=' <?php echo base_url("SalesController/eliminar/$product->id") ?>' onclick="return confirm('¿Esta seguro de eliminar este producto?')">
                        <img src="\images\delete.png" width="30" title="Eliminar"> 
                    	</a>
                	</td>
				</tr>
				<?php 
					$total = $total + $product->total;
				}
				if (count($products) == 0) {
					echo "<tr><td colspan='6'><label>No hay productos en lista de deseos</label></td></tr>";
				}
				 ?>
				 <tr>	
				 	<td colspan="3"></td>
				 	<td><h4>Total</h4></td>
				 	<td colspan="2"><h4><?php echo "₡".$total ?></h4></td>
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