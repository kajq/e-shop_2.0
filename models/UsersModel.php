<?php
               //extendemos CI_Model
class UsersModel extends CI_Model{
    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();
         
        //cargamos la base de datos
        $this->load->database();
    }

    public function login($user, $password){
      $consulta = $this->db->query("SELECT * FROM users WHERE user = '$user' and password = '$password'");
      return $consulta->result();
    }
     
    public function ver(){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT * FROM users;");
         
        //Devolvemos el resultado de la consulta
        return $consulta->result();
    }
     
    public function add($user,$password,$rol, $state){
        $consulta=$this->db->query("SELECT user FROM users WHERE user LIKE '$user'");
        if($consulta->num_rows()==0){
            $consulta=$this->db->query("INSERT INTO users VALUES('$user','$password','$rol','$state');");
            if($consulta==true){
              return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
     
    public function mod($user, $modificar="NULL",$password="NULL",$rol="NULL",$state="NULL"){
        if($modificar=="NULL"){
            $consulta=$this->db->query("SELECT * FROM users WHERE user=$id_usuario");
            return $consulta->result();
        }else{
          $consulta=$this->db->query("
              UPDATE users SET password='$password',
              rol='$rol', state='$state' WHERE user=$user;
                  ");
          if($consulta==true){
              return true;
          }else{
              return false;
          }
        }
    }
     
    public function eliminar($user){
       $consulta=$this->db->query("DELETE FROM users WHERE user=$user");
       if($consulta==true){
           return true;
       }else{
           return false;
       }
    }
 
 
}
?>
