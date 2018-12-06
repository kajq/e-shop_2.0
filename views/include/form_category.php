<?php  //Formulario de categorias de productos
extract($_GET);
if ($action == 'new') {
	echo "<form  action=' " . base_url("CategoriesController/add") . "' method='post'>";
}  elseif ($action == 'edit') {
	echo "<form  action=' " . base_url("CategoriesController/mod/$category->id") . "' method='post'>";
}
        ?>
	<label style="font-size: 10pt">  
		<b>Descripción</b>	
		<input style="border-radius:15px;" type="text" name="description" required value="<?php //echo $category->description; ?>">
		<b>Categoria Padre</b>
		<select name="id_supercategory" style="border-radius:15px;"> 
			<option value="<?php //echo $id_superc?>"><?php //echo $superc?></option>
			<option value="">Ninguna</option>
			<?php 
				foreach($ver as $category){ 
					echo '<option value=' . $category->id . '> ' . $category->description . '</option>';
				}
			?>	
        </select>
        <b>Activo</b>
        <input class="form-check-input" type="checkbox" name="state" 
        <?php //echo $check_state ?>>
        <b style='padding-left: 6em'></b>
        <input type='submit' class='btn btn-danger' value='Guardar' name='submit' >
        <input type="submit" class="btn btn-danger" value="Cancelar" onclick = "window.location.href='../admin_categories.php'">
	</label>
</form>