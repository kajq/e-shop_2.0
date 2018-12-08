<?php
//extendemos CI_Controller
class IndexController extends CI_Controller{
    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();
         
        //llamo al helper url
        $this->load->helper("url"); 
         
        //llamo o incluyo el modelo
        $this->load->model("ProductsModel");
        $this->load->model("CategoriesModel");
         
        //cargo la libreria de sesiones
        $this->load->library("session");
    }
     
    //controlador por defecto
    public function index(){
         
        $datos["products"]=$this->ProductsModel->ver();    
        $datos["categories"]=$this->CategoriesModel->ver();    
        //cargo la vista y le paso los datos
        $this->load->view("index",$datos); 
         
    }

    public function mod($id){
        if($id <> null){
          $datos["products"]=$this->ProductsModel->ver();    
          $datos["categories"]=$this->CategoriesModel->ver(); 
          $datos["mod"]=$this->ProductsModel->mod($id);
          $this->load->view("index",$datos);
          if($this->input->post("submit")){
                //llamo a metodo que valida y respalda al imagen
                //$image = ;
                $this->validate_image($this->input->post("image_file"));        
                
                //llamo a funcion del modelo para modificar
                $mod=$this->ProductsModel->mod(
                        $id,
                        $this->input->post("submit"),
                        $this->input->post("sku"),
                        $this->input->post("description"),
                        $this->input->post("price"),
                        $this->input->post("in_stock"),
                        $this->image,
                        $this->input->post("id_category")
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
}
?>