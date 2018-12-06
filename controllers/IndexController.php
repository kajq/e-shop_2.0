<?php
//extendemos CI_Controller
class IndexController extends CI_Controller{
    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();
         
        //llamo al helper url
        $this->load->helper("url"); 
         
        //llamo o incluyo el modelo
        //$this->load->model("products_model");
         
        //cargo la libreria de sesiones
        $this->load->library("session");
    }
     
    //controlador por defecto
    public function index(){
         
        //cargo la vista y le paso los datos
        $this->load->view("index"); 
         
    }
}
?>