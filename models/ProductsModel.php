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
     
    public function add($sku, $description,$price, $in_stock, $image_file, $id_category){
        
        $consulta=$this->db->query("INSERT INTO products VALUES('', '$sku', '$description','$price','$in_stock', '$image_file', '$id_category');");
        if($consulta==true){
            return true;
        }else{
            return false;
        }
    }
     
    public function mod($id, $modificar="NULL", $sku="NULL", $description="NULL", $price="NULL", $in_stock="NULL",
    $image_file="NULL", $id_category="NULL"){
        if($modificar=="NULL"){
            $consulta=$this->db->query("SELECT prod.*, cat.description category FROM products prod 
            LEFT JOIN categories cat
            ON cat.id = prod.id_category
            WHERE prod.id = $id;");
            return $consulta->result();
        }else{
          $consulta=$this->db->query("
              UPDATE products SET sku='$sku', description='$description', price='$price', in_stock='$in_stock', image_file='$image_file', 
              id_category='$id_category' WHERE id=$id;");
          if($consulta==true){
              return true;
          }else{
              return false;
          }
        }
    }
     
    public function eliminar($id){
       $consulta=$this->db->query("DELETE FROM products WHERE id = $id");
       if($consulta==true){
           return true;
       }else{
           return false;
       }
    }
 
 
}
?>
