<?php
                        //extendemos CI_Controller
class LoginController extends CI_Controller{
    public function __construct() {
        //session_start();
        //llamamos al constructor de la clase padre
        parent::__construct();
         
        //llamo al helper url
        $this->load->helper("url"); 
         
        //llamo o incluyo el modelo
        $this->load->model("UsersModel");
         
        //cargo la libreria de sesiones
        $this->load->library("session");
    }
     
    //controlador por defecto
    public function index(){
         
        //cargo la vista y le paso los datos
        $this->load->view("login_view"); 
         
    }

    //controlador para logiarse
    public function login(){
          //compruebo si se a enviado submit
        if($this->input->post("submit")){
         
        //llamo al metodo login
        $usuarios=$this->UsersModel->login(
            $this->input->post("user"),
            $this->input->post("password")
        );
            if (count($usuarios) > 0 ) {
                //array asociativo con la llamada al metodo del modelo
                $_SESSION['rol'] =	$usuarios[0]->rol;
                $_SESSION['user']	  =	$usuarios[0]->user;
                redirect('http://www.e-shop_2.0.com/index.php/IndexController');
            }elseif ($this->input->post("user") == 'admin' && $this->input->post("password") == '123456789') {
            //de no encontrarse en la base datos tambien valida este usuario admin predeterminado
                $_SESSION['user'] =	'admin';
                $_SESSION['rol']	  =	2;
                redirect('http://www.e-shop_2.0.com/index.php/IndexController');
            }	else{
                //si el admin tampoco coincide da mensaje de error de usuario
                echo '<script>alert("Usuario o Contraseña incorrecto!")</script> ';
                $this->index();
            }
        }
    }

    //Función que verifica las contraseñas del formulario sean iguales
	public function check_pass($pass, $repass){
		$check = true;
		if ($pass <> $repass) {     
			$check = false;
		} 
		return $check;
    }
     
    //controlador para añadir
    public function add(){
        $this->load->view("register_view");
        //compruebo si se a enviado submit
        if($this->input->post("submit")){
           if ($this->check_pass($this->input->post("password"), $this->input->post("pass_confirm")) == true) {
            $email_exist = $this->UsersModel->check_mail($this->input->post("email"));
                if ($email_exist == false) {
                   //llamo al metodo add
                   $addPerson = $this->UsersModel->addPerson(
                    $this->input->post("user"),
                    $this->input->post("name"),
                    $this->input->post("lastname"),
                    $this->input->post("phone"),
                    $this->input->post("email")
                    );
                    if ($addPerson == true){
                        $addUser=$this->UsersModel->addUser(
                        $this->input->post("user"),
                        $this->input->post("password"),
                        0, //rol
                        0 //state
                        );  
                        if ($addUser == true){
                            "Usuario Registrado"; 
                            redirect('http://www.e-shop_2.0.com/index.php/LoginController');
                        }
                    } else {
                        echo '<script>alert("El usuario ' . $this->input->post("user") . ' ya esta registrado, debe escoger otro usuario" )</script>' ; //
                    }
            
                } else {
                    echo '<script>alert("Correo electronico ya existe")</script> '; 
                }
              }  else {
                echo '<script>alert("Contraseñas no coinciden")</script> '; 
              }
                
        }
    }
     
    //controlador para modificar al que
    //le paso por la url un parametro
    public function mod($id_usuario){
        if(is_numeric($id_usuario)){
          $datos["mod"]=$this->usuarios_model->mod($id_usuario);
          $this->load->view("modificar_view",$datos);
          if($this->input->post("submit")){
                $mod=$this->usuarios_model->mod(
                        $id_usuario,
                        $this->input->post("submit"),
                        $this->input->post("email"),
                        $this->input->post("password"),
                        $this->input->post("nombre"),
                        $this->input->post("apellido")
                        );
                if($mod==true){
                    //Sesion de una sola ejecución
                    $this->session->set_flashdata('correcto', 'Usuario modificado correctamente');
                }else{
                    $this->session->set_flashdata('incorrecto', 'Usuario modificado correctamente');
                }
                redirect(base_url());
            }
        }else{
            redirect(base_url());
        }
    }
     
}
?>