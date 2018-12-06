<?php
/**Menu de opciones
 * 
 */
$init = new menu();
$init->show_menu();

class menu
{
	private $connect_db;
	private $rol;

	function __construct()
	{
		$this->rol = isset($_SESSION['rol'])? $_SESSION['rol'] : null ;
	}

	function show_menu()
	{
		if ($this->rol == null) {
			echo "<div class='navbar'>
					<ul class='nav pull-right'>
						<li><a href="  . site_url('../LoginController') . ">Iniciar Sesión</a></li>			 
					</ul>
				</div>";
			echo "<div class= 'navbar'>
					<ul class= 'nav pull-right'>
						<li><a href='register.php'>Registrarme</a></li>
					</ul>
				</div>";
		} else {
			echo "<div class='navbar'>
					<ul class='nav pull-right'>
					 	<li><a href='../class/sign_off.php'>Cerrar Sesión</a></li>		 
					</ul>
				  </div>";
			if ($this->rol == '1' || $this->rol == '0') {
			echo "<div class='navbar'>
					<ul class='nav pull-right'>
						<li><a href='register.php?action=Edit'>Perfil Usuario</a></li>		 
					</ul>
				  </div>";
			echo "<div class='navbar'>
					<ul class='nav pull-right'>
					 	<li><a href='shopping_car.php'>Lista de deseos</a></li>		 
					</ul>
				  </div>";	  	    	
			}	  
			if ($this->rol == '1' || $this->rol == 2) {
				echo "<div class='navbar'>
						<ul class='nav pull-right'>
							<li><a href='admin_persons.php'>Administradores</a></li>		 
						</ul>
					  </div>";
				echo "<div class='navbar'>
						<ul class='nav pull-right'>
							<li><a href='admin_products.php'>Productos</a></li>		 
						</ul>
					  </div>";	  	  
				echo "<div class='navbar'>
						<ul class='nav pull-right'>
							<li><a href='" . site_url('../CategoriesController') . "'>Categorias</a></li>		 
						</ul>
					  </div>";	  	  
			}	  
			echo "<div class='navbar'>
					<ul class='nav pull-right'>
						<li><a href='shopping_history.php'>Historial</a></li>		 
					</ul>
		  		</div>";
			echo "<div class='navbar'>
						<ul class='nav pull-right'>
							<li><a href='" . site_url('../IndexController') . "'>Inicio</a></li>		 
						</ul>
					  </div>";
			echo "<div class='navbar'>
					<h4>Usuario: ". $_SESSION['user'] ."</h4>
				</div>";
		}
	}
}
?>