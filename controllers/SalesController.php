<?php
//extendemos CI_Controller
class SalesController extends CI_Controller{
    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();
         
        //llamo al helper url
        $this->load->helper("url"); 
         
        //llamo o incluyo el modelo
        $this->load->model("ProductsModel");
        //$this->load->model("CategoriesModel");
        $this->load->model("SalesModel");
         
        //cargo la libreria de sesiones
        $this->load->library("session");
    }
     
    //controlador por defecto
    public function index(){
        $cart=$this->SalesModel->cart('',$_SESSION['user']);
        if($cart <> false){
            $datos["cart"]    = $cart[0]->id_sale;
            $datos["products"]=$this->SalesModel->ProductsCart($cart[0]->id_sale);    
        }    
        $datos["person"]  = $this->SalesModel->Customer($_SESSION['user']);    
        
        //cargo la vista y le paso los datos
        $this->load->view("shoppingcar_view",$datos); 
    }
    //controlador para cantidad productos en carrito
    public function change_sum($action, $id_sale, $sku, $sum){
        if ($action == 'add') {
            $sum++;
        } elseif ($action == 'less') {
            $sum--;
        }		
        $this->SalesModel->change_sum($id_sale, $sku, $sum);
        redirect('http://www.e-shop_2.0.com/index.php/SalesController');
    }

    //Controlador para eliminar
    public function eliminar($id){ 
        if(is_numeric($id)){
          $eliminar=$this->SalesModel->drop_product($id);
          if($eliminar==true){
              $this->session->set_flashdata('correcto', 'Usuario eliminado correctamente');
          }else{
              $this->session->set_flashdata('incorrecto', 'Usuario eliminado correctamente');
          }
        }
        redirect('http://www.e-shop_2.0.com/index.php/SalesController');
    }

    //Función que llama la función de bajar productos a todos los que estan en el carrito
	public function to_buy($id_sale){
        $cart     =     $this->SalesModel->cart('',$_SESSION['user']);    
        $products =     $this->SalesModel->ProductsCart($cart[0]->id_sale);
        if (count($products) > 0){
        foreach($products as $product){
            $new_sum = $product->in_stock - $product->sum;
            $this->SalesModel->lower_stock($product->sku_product, $new_sum);
        }//finalmente actualiza el estado a 1, que siginica vendido
        $this->SalesModel->update_cart($id_sale, 1);
        echo '<script>alert("Compra completada con exito!")</script> ';
        redirect('http://www.e-shop_2.0.com/index.php/PurchasesController');
        } else {
            echo '<script>alert("No puedes comprar por que no tienes productos en carrito")</script> ';
            $this->index(); 
        }
    }
}
?>