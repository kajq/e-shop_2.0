<?php
                        //extendemos CI_Controller
class ProductsController extends CI_Controller{
    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();
         
        //llamo al helper url
        $this->load->helper("url"); 
         
        //llamo o incluyo el modelo
        $this->load->model("ProductsModel");
         
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
        $products["ver"]=$this->ProductsModel->ver();    
        //cargo la vista y le paso los datos
        $this->load->view("products_view",$products); 
         
    }
     
    //controlador para añadir
    public function add(){
        $datos["add"]=true;
        $datos["ver"]=$this->ProductsModel->ver();
        $this->load->view("products_view",$datos);
        //compruebo si se a enviado submit
        if($this->input->post("submit")){
         
        //llamo al metodo add
        $model_add=$this->ProductsModel->add(
            $this->input->post("sku"),
            $this->input->post("description"),
            $this->input->post("price"),
            $this->input->post("id_category"),
            $this->input->post("in_stock")
            );
            if($model_add==true){
                //Sesion de una sola ejecución
                echo '<script>alert("Categoria agregada correctamente")</script> ';
                //redirecciono la pagina a la url por defecto
                
            }else{
                echo '<script>alert("No se pudo agregar la categoria")</script> ';
            }
            redirect('http://www.e-shop_2.0.com/index.php/ProductsController');
        }
        
        
    }
     
    //controlador para modificar al que
    //le paso por la url un parametro
    public function mod($id){
        if($id <> null){
          $datos["mod"]=$this->ProductsModel->mod($id);
          $datos["ver"]=$this->ProductsModel->ver();
          $this->load->view("products_view",$datos);
          if($this->input->post("submit")){
                $mod=$this->ProductsModel->mod(
                        $id,
                        $this->input->post("sku"),
                        $this->input->post("description"),
                        $this->input->post("price"),
                        $this->input->post("id_category"),
                        $this->input->post("in_stock")
                        );
                if($mod==true){
                    //Sesion de una sola ejecución
                    $this->session->set_flashdata('correcto', 'Usuario modificado correctamente');
                }else{
                    $this->session->set_flashdata('incorrecto', 'Usuario modificado correctamente');
                }
                redirect('http://www.e-shop_2.0.com/index.php/ProductsController');
            }
        }else{
            redirect('http://www.e-shop_2.0.com/index.php/ProductsController');
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
        }
        redirect('http://www.e-shop_2.0.com/index.php/ProductsController');
    }
}
?>