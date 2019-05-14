<?php
include('Datos.php');
class Payu{
	private $mysqli;
  /*
    Funcion para conectarse a al base de datos
   */
	private function conectar(){
		$this->mysqli = new mysqli(_HOST, _USUARIO, _CLAVE, _BASEDEDATOS);
		if ($this->mysqli->connect_errno) {
		  $this->mysqli=false; 
    }else{
      return true;
    }
		
	}
  /**
   * /Funcion para consulatr la tabla payu
   * @return [type] [description]
   */
  private function consultar_db(){
      if($this->conectar()){
        $q="SELECT * FROM payus  WHERE  type = '"._DEBUG."'";
        
        $res=$this->mysqli->query($q);

        while($d = $res->fetch_object()){
          $data[]=$d;
        }
        $res->close();
        return $data[0];
      }else{
        return false;
      }

  }
  /**
   * /Funcion para crear el hash ques e envia como campo signature
   * @param  [type] $ref_pago [refrencia de pago debe ser unica]
   * @param  [type] $monto    [valor a pagar]
   * @param  [type] $moneda   [moneda con que se va a cancelar]
   * @return [type]           [description]
   */
	public function crear_hash($ref_pago,$monto,$moneda){
        $datos=$this->consultar_db();
        if($datos!=false){

          
          $DATA=trim($datos->API_KEY."~".$datos->merchantId."~".$ref_pago."~".$monto."~".$moneda);  
          //echo $DATA;
          switch ($datos->type_encrypt) {
            case 'MD5':
              $val = md5($DATA);
              break;
            case 'SHA1':
              $val = sha1($DATA);
              break;
            case 'SHA256':
              $val = hash("sha256",$DATA);
              break;
            default:
              # code...
              break;
          }
          
          

          return  $val;
        }else{
          return false;
        }

		    
  	
	}	

	

}

