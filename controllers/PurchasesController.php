<?php
                        //extendemos CI_Controller
class PurchasesController extends CI_Controller{

    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();
         
        //llamo al helper url
        $this->load->helper("url"); 
         
        //llamo o incluyo el modelo
        $this->load->model("PurchasesModel");
         
        //cargo la libreria de sesiones
        $this->load->library("session");
    }
     
    //controlador por defecto
    public function index(){
        //valido rol de usuario
        if (@!$_SESSION['user'] || $_SESSION['rol'] == '0') {
            echo '<script>alert("Usuario no autorizado!!")</script> ';
            redirect('http://www.e-shop_2.0.com/index.php');	
        }
        $products["ver"]=$this->PurchasesModel->ver();    
        //cargo la vista y le paso los datos
        $this->load->view("purchases_view",$products);          
    }
}
?>