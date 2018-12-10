<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Usuarios</title>
    </head>
    <body>
        <h2>Administrar Usuarios</h2>
        <?php
        //Si existen las sesiones flasdata que se muestren
            if($this->session->flashdata('correcto'))
                echo $this->session->flashdata('correcto');
             
            if($this->session->flashdata('incorrecto'))
                echo $this->session->flashdata('incorrecto');
        ?>
<table border="1">
    <form action="<?=base_url("usuarios_controller/add");?>" method="post">
        <tr>
            <td><label>Usuario</label></td>
            <td><label>Rol</label></td>
            <td><label>Acción</label></td>
        </tr>
        <tr>
            <td>
               <input type="user" name="user"/>
            </td>
            <td>
                <input type="text" name="rol"/>
            </td>
            <td>
                <input type="submit" name="submit" value="Añadir" />
            </td>
        
        </tr>
    </form>
<?php
foreach($ver as $fila){
?>
    <tr>
        <td>
            <?=$fila->user;?>
        </td>
        <td>
            <?=$fila->rol;?>
        </td>
        <td>
            <a href="<?=base_url("usuarios_controller/mod/$fila->user")?>">Modificar</a>
            <a href="<?=base_url("usuarios_controller/eliminar/$fila->user")?>">Eliminar</a>
        </td>
    </tr>
    <a href="<?=base_url()?>">Volver</a>
<?php
    
}
?>
</table>
    </body>
</html>¿w