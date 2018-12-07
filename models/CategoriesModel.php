<?php
               //extendemos CI_Model
class CategoriesModel extends CI_Model{
    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();
         
        //cargamos la base de datos
        $this->load->database();
    }
     
    public function ver(){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT cat.*, sup.description supercategory FROM categories cat 
        LEFT JOIN categories sup
        ON sup.id = cat.id_supercategory;");
         
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
     
    public function mod($id, $modificar="NULL", $description="NULL", $id_supercategory="NULL", $state="NULL"){
        if($modificar=="NULL"){
            $consulta=$this->db->query("SELECT cat.*, sup.description supercategory FROM categories cat 
            LEFT JOIN categories sup
            ON sup.id = cat.id_supercategory
            WHERE cat.id = $id;");
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
