<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<title>Login</title>
</head>
<body>
	<table>
		<form action="<?=base_url("usuarios_controller/login");?>" method="POST">
		<tr>
			<td>
				<label>Login</label>
			</td>
			<td>
				<input type="text" name="user">
			</td>
		</tr>
		<tr>
			<td>
				<label>Contraseña</label>
			</td>
			<td>
				<input type="password" name="password">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" name="submit" value="login">
			</td>
		</tr>
		</form>
	</table>
</body>
</html>