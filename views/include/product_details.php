<div class='row'>
	<div class='span6'>
		<div class='thumbnail'>
			<label style="font-size: 12pt">Imagen del Producto</label>
			<img src="/images/uploads/<?php echo isset($mod[0]->image_file) ? $mod[0]->image_file : ""; ?>" width='250'/>
		</div>
	</div>
	<div class='span6'>
		<div class='thumbnail'>
			<table valign="middle">
				<form action="" method="post">
				<tr>
					<td colspan="2"> 
						<label style="font-size: 14pt">Detalles del Producto</label>
					</td>
				</tr>
				<tr>
					<td><label style="font-size: 14pt"><b>Código: </b></label></td>
					<td><input readonly style="border-radius:15px;" type="text" name="sku" value="<?php echo isset($mod[0]->sku) ? $mod[0]->sku : ""; ?>"></td>
				</tr>
				<tr>
					<td><label style="font-size: 14pt"><b>Descripción: </b></label></td>
					<td><input readonly style="border-radius:15px;" type="text" name="description" value="<?php echo isset($mod[0]->description) ? $mod[0]->description : ""; ?>"></td>
				</tr>
				<tr>
					<td><label style="font-size: 14pt"><b>Precio: </b></label></td>
					<td><input readonly style="border-radius:15px;" type="text" name="price" value="<?php echo isset($mod[0]->price) ? $mod[0]->price : ""; ?>"></td>
				</tr>
				<tr>
					<td><label style="font-size: 14pt"><b>Existencias: </b></label></td>
					<td><input readonly style="border-radius:15px;" type="text" name="in_stock" value="<?php echo isset($mod[0]->in_stock) ? $mod[0]->in_stock : ""; ?>"></td>
				</tr>
				<tr>
					<td height="30" colspan="2">
						<input class="btn btn-danger" type="submit" name="submit" value="Lo quiero">
						<a href="index.php">Cancelar</a>			
					</td>
	          	</tr> 
	          	</form>
			</table>
		</div>
	</div>
</div>
<br>
<hr class='soften'/>";