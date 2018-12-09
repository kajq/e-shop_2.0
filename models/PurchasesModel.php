<?php
               //extendemos CI_Model
class CategoriesModel extends CI_Model{
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
}
?>
