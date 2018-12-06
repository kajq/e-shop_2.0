<?php
                        //extendemos CI_Controller
class CategoriesController extends CI_Controller{
    public function __construct() {
        //session_start();
        //llamamos al constructor de la clase padre
        parent::__construct();
         
        //llamo al helper url
        $this->load->helper("url"); 
         
        //llamo o incluyo el modelo
        $this->load->model("CategoriesModel");
         
        //cargo la libreria de sesiones
        $this->load->library("session");
    }
     
    //controlador por defecto
    public function index(){
        //valido rol de usuario
        if (@!$_SESSION['user'] || $_SESSION['rol'] == '0') {
            echo '<script>alert("Usuario no autorizado!!")</script> ';
            echo "<script>location.href='index.php'</script>";	
        }
        $categories["ver"]=$this->CategoriesModel->ver();    
        //cargo la vista y le paso los datos
        $this->load->view("categories_view",$categories); 
         
    }
     
    //controlador para añadir
    public function add(){
         
        //compruebo si se a enviado submit
        if($this->input->post("submit")){
         
        //llamo al metodo add
        $model_add=$this->CategoriesModel->add(
                $this->input->post("description"),
                $this->input->post("id_supercategory"),
                $this->input->post("state")
                );
        }
        if($model_add==true){
            //Sesion de una sola ejecución
            echo '<script>alert("Categoria agregada correctamente")</script> ';
        }else{
            echo '<script>alert("No se pudo agregar la categoria")</script> ';
        }
         
        //redirecciono la pagina a la url por defecto
        redirect(base_url());
    }
     
    //controlador para modificar al que
    //le paso por la url un parametro
    public function mod($id){
        if(is_numeric($id)){
          $datos["mod"]=$this->CategoriesModel->mod($id);
          $this->load->view("modificarCategory_view",$datos);
          if($this->input->post("submit")){
                $mod=$this->usuarios_model->mod(
                        $id_usuario,
                        $this->input->post("submit"),
                        $this->input->post("description"),
                        $this->input->post("id_supercategory"),
                        $this->input->post("state")
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
    public function eliminar($id){
        if(is_numeric($id)){
          $eliminar=$this->CategoriesModel->eliminar($id);
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