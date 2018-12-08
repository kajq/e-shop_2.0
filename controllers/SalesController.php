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
        $datos["person"]= $this->SalesModel->Customer($_SESSION['user']);    
        $datos["products"]=$this->SalesModel->ProductsCart($cart[0]->id_sale);    
        //cargo la vista y le paso los datos
        $this->load->view("shoppingcar_view",$datos); 
    }

    //Función que llama la función de bajar productos a todos los que estan en el carrito
	/*function to_buy($id_sale, $products){
        for ($i=0; $i < count($products)/7; $i++) { 
            $new_sum = $products['in_stock='.$i] - $products['sum='.$i];
            $this->lower_stock($products['sku='.$i], $new_sum);
        }//finalmente actualiza el estado a 1, que siginica vendido
        $this->update_cart($id_sale, 1);
        echo '<script>alert("Compra completada con exito!")</script> ';
        echo "<script>location.href='../shopping_history.php'</script>";
        }//redirecciona*/
}
?>