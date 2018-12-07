<?php
               //extendemos CI_Model
class ProductsModel extends CI_Model{
    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();
         
        //cargamos la base de datos
        $this->load->database();
    }
     
    public function ver(){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT prod.*, cat.description category FROM products prod 
        LEFT JOIN categories cat
        ON prod.id_category = cat.id
        ORDER BY prod.id_category;");
         
        //Devolvemos el resultado de la consulta
        return $consulta->result();
    }
     
    public function add($description,$id_supercategory, $state){
        
        $consulta=$this->db->query("INSERT INTO categories VALUES('','$description','$id_supercategory','$state');");
        if($consulta==true){
            return true;
        }else{
            return false;
        }
    }
     
    public function mod($id, $modificar="NULL", $sku="NULL", $description="NULL", $price="NULL", $in_stock="NULL", $image_file="NULL",$id_category="NULL"){
        if($modificar=="NULL"){
            $consulta=$this->db->query("SELECT prod.*, cat.description category FROM products prod 
            LEFT JOIN categories cat
            ON cat.id = prod.id_category
            WHERE prod.id = $id;");
            return $consulta->result();
        }else{
          $consulta=$this->db->query("
              UPDATE categories SET description='$description', id_supercategory='$id_supercategory', state='$state' WHERE id=$id;");
          if($consulta==true){
              return true;
          }else{
              return false;
          }
        }
    }
     
    public function eliminar($id){
       $consulta=$this->db->query("DELETE FROM categories WHERE id = $id");
       if($consulta==true){
           return true;
       }else{
           return false;
       }
    }
 
 
}
?>
