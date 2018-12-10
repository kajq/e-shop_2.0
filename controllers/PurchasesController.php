<?php
                        //extendemos CI_Controller
class PurchasesController extends CI_Controller{

    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();
         
        //llamo al helper url
        $this->load->helper("url"); 
         
        //llamo o incluyo el modelo
        $this->load->model("SalesModel");
        $this->load->model("PurchasesModel");
         
        //cargo la libreria de sesiones
        $this->load->library("session");
    }
     
    //controlador por defecto
    public function index(){ 
        //valido rol de usuario
        if (@!$_SESSION['user'] ) {
            echo '<script>alert("Usuario no autorizado!!")</script> ';
            redirect('http://www.e-shop_2.0.com/index.php');	
        }
        $purchases["ver"]=$this->PurchasesModel->ver($_SESSION['user']);    
        $purchases["all_users"]=$this->PurchasesModel->total_users();  
        $purchases["all_products"]=$this->PurchasesModel->total_products('admin');  
        $purchases["all_sales"]=$this->PurchasesModel->total_sales('admin');  
        $purchases["total_products"]=$this->PurchasesModel->total_products($_SESSION['user']);  
        $purchases["total_sales"]=$this->PurchasesModel->total_sales($_SESSION['user']);
        //cargo la vista y le paso los datos 
        $this->load->view("purchases_view",$purchases);          
    }

    public function details($id_sale){
        $datos["cart"]    = $this->SalesModel->cart($id_sale,$_SESSION['user']);
        $datos["person"]  = $this->SalesModel->Customer($_SESSION['user']);    
        $datos["products"]=$this->SalesModel->ProductsCart($id_sale);    
        //cargo la vista y le paso los datos
        $this->load->view("purchases_details_view",$datos); 
    }
}
?>