<?php
               //extendemos CI_Model
class PurchasesModel extends CI_Model{
    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();
         
        //cargamos la base de datos
        $this->load->database();
    }
     
    public function ver($user){
        $where = " WHERE s.state = 1 ";
		if ($user <> 'admin') {
			$where = $where . "and s.user = '$user'";
		}
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT s.id_sale, s.sale_date, p.name, p.last_name, 
        (SELECT SUM(sum) total FROM sold_products 
        WHERE id_sale = s.id_sale GROUP by id_sale) sum, 
        (SELECT SUM(price * sum) total FROM sold_products 
        WHERE id_sale = s.id_sale GROUP by id_sale) total 
        FROM `sales` s 
         LEFT JOIN person p 
         ON p.user = s.user " . $where);
         
        //Devolvemos el resultado de la consulta
        return $consulta->result();
    }

    //función que cuenta los usuarios registrados
	public function total_users(){
		$consulta=$this->db->query("SELECT COUNT(user) total FROM users");
		//Devolvemos el resultado de la consulta
        return $consulta->result();
	}

	//función que suma la cantidad de productos
	public function total_products($user){
		$where = 'WHERE s.state = 1 ';
		if ($user <> 'admin') {
			$where = $where . " AND s.user = '$user'";
		}
		$consulta=$this->db->query("SELECT sum(sp.sum) total FROM sold_products sp
				 LEFT JOIN sales s
				 ON s.id_sale = sp.id_sale " . $where) ;
		//Devolvemos el resultado de la consulta
        return $consulta->result();
	}

	//función que suma el total de dinero vendido
	public function total_sales($user){
		$where = "WHERE s.state = 1 ";
		if ($user <> 'admin') {
			$where = $where . " AND s.user = '$user'";
		}
		$consulta=$this->db->query("SELECT sum(sp.sum * sp.price) total FROM sold_products sp 
				 LEFT JOIN sales s 
				 ON s.id_sale = sp.id_sale " . $where);
		//Devolvemos el resultado de la consulta
        return $consulta->result();	
	}
}
?>
