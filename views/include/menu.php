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
		$this->rol = isset($_SESSION[0]->rol)? $_SESSION[0]->rol : null ;
	}

	function show_menu()
	{
		if ($this->rol == null) {
			echo "<div class='navbar'>
					<ul class='nav pull-right'>
						<li><a href='login.php'>Iniciar Sesión</a></li>			 
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
							<li><a href='admin_categories.php'>Categorias</a></li>		 
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
							<li><a href='Index.php'>Inicio</a></li>		 
						</ul>
					  </div>";
			echo "<div class='navbar'>
					<h4>Usuario: ". $_SESSION[0]->user ."</h4>
				</div>";
		}
	}
}
?>