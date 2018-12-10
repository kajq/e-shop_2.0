<?php
               //extendemos CI_Model
class SalesModel extends CI_Model{
    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();
         
        //cargamos la base de datos
        $this->load->database();
    }
    //Retorna los productos en el carrito de una venta 
    public function ProductsCart($id_sale){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT sp.*, p.in_stock, (sp.price * sp.sum) total 
		FROM sold_products sp
		LEFT JOIN products p
		ON sp.sku_product = p.sku
		WHERE id_sale = '$id_sale'");
         
        //Devolvemos el resultado de la consulta
        return $consulta->result();
    }

    //Retrona los datos de la cabecera de la proforma
    public function Customer($user){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT *, curdate() date FROM person WHERE user = '$user'");
         
        //Devolvemos el resultado de la consulta
        return $consulta->result();
    }
    //Inserta un nuevo carrito 
    public function add_cart($user){  
        $consulta=$this->db->query("INSERT INTO `sales` (`id_sale`, `user`, `sale_date`, `state`) VALUES (NULL, '$user', now(), '0');");
        if($consulta==true){
            return true;
        }else{
            return false;
        }
    }
    //actualiza la fecha del carrito
    public function update_cart($id_sale, $state){   
        $consulta=$this->db->query("UPDATE sales SET sale_date = now(), state = '$state'
        WHERE id_sale = '$id_sale';");
        if($consulta==true){
            return true;
        }else{
            return false;
        }
    }

    //Retrona si ya tiene el producto en el carrito
    public function productExist($id_sale, $sku){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT * FROM sold_products WHERE sku_product = '$sku' AND id_sale = '$id_sale'");
        //Devolvemos el resultado de la consulta
        if($consulta==true){
            return $consulta->result();
        }else{
            return false;
        }
    }

    //cambia la cantidad de productos en carrito
    public function change_sum($id_sale, $sku, $new_sum){   
        $consulta=$this->db->query("UPDATE sold_products SET sum = '$new_sum' WHERE id_sale = '$id_sale' 
		AND sku_product = '$sku';");
        if($consulta==true){
            return true;
        }else{
            return false;
        }
    }

    //disminuye la cantidad de productos en stock
    public function lower_stock( $sku, $new_sum){   
        $consulta=$this->db->query("UPDATE products SET in_stock = '$new_sum' WHERE sku = '$sku';");
        if($consulta==true){
            return true;
        }else{
            return false;
        }
    }
    //inserta producto al carrito
    public function add_product($id_sale, $sku, $description, $price){  
        $consulta=$this->db->query("INSERT INTO sold_products
		(id, id_Sale, sku_product, description, price, sum)
		VALUES (NULL, '$id_sale', '$sku', '$description', '$price', 1);");
        if($consulta==true){
            return true;
        }else{
            return false;
        }
    }
    //obtiene la información de la ventas
    public function cart($id_sale, $user){
        $where = " state = 0;";
		if ($id_sale <> '') {
			$where = " id_sale = '$id_sale';";
		}
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT * FROM sales WHERE user = '$user' AND " . $where );
        //Devolvemos el resultado de la consulta
        if($consulta==true){
            return $consulta->result();
        }else{
            return false;
        }
    }

    public function drop_product($id){  
        $consulta=$this->db->query("DELETE FROM sold_products WHERE id = '$id';");
        if($consulta==true){
            return true;
        }else{
            return false;
        }
    }
    //retorna los datos de un producto 
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
 
}
?>
