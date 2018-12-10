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
        $this->load->model("SalesModel");
         
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

    public function logoff(){
        session_destroy();
        redirect('http://www.e-shop_2.0.com/index.php/IndexController');
    }

    public function mod($id){
        if($id <> null){
          $datos["products"]=$this->ProductsModel->ver();    
          $datos["categories"]=$this->CategoriesModel->ver(); 
          $datos["mod"]=$this->ProductsModel->mod($id);
          $this->load->view("index",$datos); 
          if($this->input->post("submit")){
                $cart = $this->SalesModel->cart('', $_SESSION['user']);
                if ($cart <> null) { 
                    //si existe actualiza la fecha
                    $this->SalesModel->update_cart($cart[0]->id_sale,0);
                } else {
                    //Si no existe inserta un carrito de compras nuevo para el usuario
                    $this->SalesModel->add_cart($_SESSION['user']);
                    //luego vuelve a consultar para obtener los datos
                    $cart = $this->SalesModel->cart('', $_SESSION['user']);	
                }
                //verifico si ya el producto esta en stock
                $product = $this->SalesModel->productExist($cart[0]->id_sale, $this->input->post("sku"));
                //validación por si no hay del producto en el carrito
                $sum  = isset($product[0]->sum) ? $product[0]->sum : 0;
                //verifica que existan productos en bodega
                if ($this->input->post("in_stock") > 0 && $sum < $this->input->post("in_stock")) {
                    if ($sum > 0) {
                        //si ya hay un producto se suma 1 a la cantidad 
                        $new_sum = $sum + 1;
                        $this->SalesModel->change_sum($cart[0]->id_sale, $this->input->post("sku"), $new_sum);
                    } else {
                        //si no existe, se agrega el producto al carrito
                        $this->SalesModel->add_product(
                            $cart[0]->id_sale, 
                            $this->input->post("sku"), 
                            $this->input->post("description"), 
                            $this->input->post("price"));	
                            redirect('http://www.e-shop_2.0.com/index.php/SalesController');
                    }
                } else	{//validación cuando detecta que no quedan productos
                    echo '<script>alert("Lo sentimos, no quedan '.$this->input->post("description").' en bodega")</script> ';
                    //redirect('http://www.e-shop_2.0.com/index.php/IndexController');
                } 
                
            }
        }
    }
}
?>