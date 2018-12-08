<?php
                        //extendemos CI_Controller
class ProductsController extends CI_Controller{

    public $image;

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
        $datos["verCat"]=$this->CategoriesModel->ver();
        $this->load->view("products_view",$datos);
        //compruebo si se a enviado submit
        if($this->input->post("submit")){
        //llamo a metodo que valida y respalda al imagen
        $this->validate_image('');    
        //llamo al metodo add
        $model_add=$this->ProductsModel->add(
            $this->input->post("sku"),
            $this->input->post("description"),
            $this->input->post("price"),
            $this->input->post("in_stock"),
            $this->input->post("image_file"),
            $this->input->post("id_category")
            );
            if($model_add==true){
                //Sesion de una sola ejecución
                echo '<script>alert("Producto agregada correctamente")</script> ';
                //redirecciono la pagina a la url por defecto
                
            }else{
                echo '<script>alert("No se pudo agregar el producto")</script> ';
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
          $datos["verCat"]=$this->CategoriesModel->ver();
          $this->load->view("products_view",$datos);
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

    //Función para el input de imagen para producto
	function validate_image($nombre_img){
        if ($nombre_img <> '') {	
            $this->image = $nombre_img;
        }
            else {
            // Recibo los datos de la imagen
            $nombre_img = $_FILES['image_file']['name'];
            $tipo = $_FILES['image_file']['type'];
            $tamano = $_FILES['image_file']['size'];
             
            //Si existe imagen y tiene un tamaño correcto
            if (($nombre_img == !NULL) && ($_FILES['image_file']['size'] <= 200000)) 
            {
               //indicamos los formatos que permitimos subir a nuestro servidor
               if (($_FILES["image_file"]["type"] == "image/gif")
               || ($_FILES["image_file"]["type"] == "image/jpeg")
               || ($_FILES["image_file"]["type"] == "image/jpg")
               || ($_FILES["image_file"]["type"] == "image/png"))
               {
                  // Ruta donde se guardarán las imágenes que subamos
                  $directorio = $_SERVER['DOCUMENT_ROOT'].'/images/uploads/';
                  // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
                  move_uploaded_file($_FILES['image_file']['tmp_name'],$directorio.$nombre_img);
                  $this->image = $nombre_img;
                } 
                else 
                {
                   //si no cumple con el formato
                   echo "No se puede subir una imagen con ese formato ";
                }
                } 
                else 
                {
                   //si existe la variable pero se pasa del tamaño permitido
                   if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
                }
            }
        }
     
    //Controlador para eliminar
    public function eliminar($id){
        if(is_numeric($id)){
          $eliminar=$this->ProductsModel->eliminar($id);
          if($eliminar==true){
              $this->session->set_flashdata('correcto', 'Usuario eliminado correctamente');
          }else{
              $this->session->set_flashdata('incorrecto', 'Usuario eliminado correctamente');
          }
        }
        redirect('http://www.e-shop_2.0.com/index.php/ProductsController');
    }

    public function plus($id, $cant){
        if(is_numeric($id)){
            $cant++;
            $plus=$this->ProductsModel->plus($id, $cant);
            if($plus==true){
                $this->session->set_flashdata('correcto', 'Usuario eliminado correctamente');
            }else{
                $this->session->set_flashdata('incorrecto', 'Usuario eliminado correctamente');
            }
          }
          redirect('http://www.e-shop_2.0.com/index.php/ProductsController');
    }
}
?>