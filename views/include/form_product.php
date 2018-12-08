<form  action='' method='post' enctype='multipart/form-data'> 
	<table >
		<tr>
			<td>
				<b>SKU</b>	
			</td>
			<td>
				<input style="border-radius:15px;" type="text" name="sku" placeholder="Automático SKU-CATE-#" maxlength="15" value="<?php echo isset($mod[0]->sku) ? $mod[0]->sku : ""; ?>">
			</td>
			<td>
				<b>Detalle</b>			
			</td>
			<td>
				<input style="border-radius:15px;" type="text" name="description" required value="<?php echo isset($mod[0]->description) ? $mod[0]->description : ""; ?>">
			</td>
			<td>
				<b>Precio</b>			
			</td>
			<td>
				<input style="border-radius:15px;" type="number" name="price" required value="<?php echo isset($mod[0]->price) ? $mod[0]->price : ""; ?>">
			</td>
		</tr>	
		<tr>
			<td>
				<b>Categoría</b>
			</td>
			<td>
			<select name="id_category" style="border-radius:15px;"> 
				<option value='<?php echo isset($mod[0]->id_category) ? $mod[0]->id_category : ""; ?>' >
				<?php echo isset($mod[0]->category) ? $mod[0]->category : "";?></option>
				<?php 
					foreach($verCat as $category){ 
						echo '<option value=' . $category->id . '> ' . $category->description . '</option>';
					}
				?>	
			</select>	
			</td>
			<td>	
				<b>Cantidad</b>	
			</td>
			<td>	
				<input style="border-radius:15px;" type="number" name="in_stock" required value="<?php echo isset($mod[0]->in_stock) ? $mod[0]->in_stock : ""; ?>">
			</td>
			<td>	
			</td>
			<td>
				<input type='submit' name='submit' class='btn btn-danger' value='Guardar'>
				<input type="submit" class="btn btn-danger" value="Cancelar" onclick = "window.location.href='../admin_products.php'">	
			</td>
		</tr>
		<tr>
			<td>
				<b>Imagen</b>
			</td>
			<td colspan="6">
				<input id="image_file" name="image_file" size="30" type="file">	
			</td>
		</tr>
	</table>
</form>