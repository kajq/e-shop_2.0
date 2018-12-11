<form  action='' method='post'>
	<label style="font-size: 10pt">  
		<b>Categoria Padre</b>
		<select name="id_supercategory" style="border-radius:15px;"> 
			<option value='<?php echo isset($mod[0]->id_supercategory) ? $mod[0]->id_supercategory : ""; ?>' >
			<?php echo isset($mod[0]->supercategory) ? $mod[0]->supercategory : "";?></option>
			<option value="">Ninguna</option>
			<?php 
				foreach($ver as $supcategory){ 
					echo '<option value=' . $supcategory->id . '> ' . $supcategory->description . '</option>';
				}
			?>	
		</select>
		<b>Descripción</b>	
		<input style="border-radius:15px;" type="text" name="description" required value="<?php echo isset($mod[0]->description) ? $mod[0]->description : ""; ?>">
        <b>Activo</b>
        <input class="form-check-input" type="checkbox" name="state" 
        <?php echo isset($mod[0]->state) ? $mod[0]->state : ""; ?>>
        
        <input type='submit' class='btn btn-danger' value='Guardar' name='submit' >
        <input type="boton" class="btn btn-danger" value="Cancelar" onclick = "window.location.href='/index.php/CategoriesController'">
	</label>
</form>