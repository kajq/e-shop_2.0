<?php
                        //extendemos CI_Controller
class usuarios_controller extends CI_Controller{
    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();
         
        //llamo al helper url
        $this->load->helper("url"); 
         
        //llamo o incluyo el modelo
        $this->load->model("usuarios_model");
         
        //cargo la libreria de sesiones
        //$this->load->library("session");
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
        $usuarios=$this->usuarios_model->login(
            $this->input->post("user"),
            $this->input->post("password")
        );
            if (count($usuarios) > 0 ) {
                //array asociativo con la llamada al metodo
                //del modelo
                ///$products["/ver"]=$this->usuarios_model->ver();    
                //cargo la vista y le paso los datos
                //$this->load->view("usuarios_view",$usuarios);
                //print_r($usuarios["login"]);
                $_SESSION =	$usuarios;
                //print_r($_SESSION);
                //echo "usuario = " . $_SESSION[0]->user;
                /*$_SESSION['rol']	  =	$user['rol'];
                $_SESSION['name']	  =	$user['name'];
                $_SESSION['last_name']= $user['last_name'];
                $_SESSION['email']	  = $user['email'];
                $_SESSION['phone']	  = $user['phone'];	*/
                $this->load->view("index");

            }elseif ($this->user == 'admin' && $this->pass == '123456789') {
            //de no encontrarse en la base datos tambien valida este usuario admin predeterminado
                /*$_SESSION['username'] =	$this->user;
                $_SESSION['rol']	  =	2;*/
            }	else{
                //si el admin tampoco coincide da mensaje de error de usuario
                echo '<script>alert("Usuario o Contraseña incorrecto!")</script> ';
                $this->load->view("login_view");
            }
        }
    }
     
    //controlador para añadir
    public function add(){
         
        //compruebo si se a enviado submit
        if($this->input->post("submit")){
         
        //llamo al metodo add
        $add=$this->usuarios_model->add(
                $this->input->post("email"),
                $this->input->post("password"),
                $this->input->post("nombre"),
                $this->input->post("apellido")
                );
        }
        if($add==true){
            //Sesion de una sola ejecución
            $this->session->set_flashdata('correcto', 'Usuario añadido correctamente');
        }else{
            $this->session->set_flashdata('incorrecto', 'Usuario añadido correctamente');
        }
         
        //redirecciono la pagina a la url por defecto
        redirect(base_url());
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
     
    //Controlador para eliminar
    public function eliminar($id_usuario){
        if(is_numeric($id_usuario)){
          $eliminar=$this->usuarios_model->eliminar($id_usuario);
          if($eliminar==true){
              $this->session->set_flashdata('correcto', 'Usuario eliminado correctamente');
          }else{
              $this->session->set_flashdata('incorrecto', 'Usuario eliminado correctamente');
          }
          redirect(base_url());
        }else{
          redirect(base_url());
        }
    }
}
?>