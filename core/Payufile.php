<?php
include('DatosFile.php');
class Payufile{
	private $mysqli;
  /*
    Funcion para conectarse a al base de datos
   */
	
	
  
  /**
   * /Funcion para crear el hash ques e envia como campo signature
   * @param  [type] $ref_pago [refrencia de pago debe ser unica]
   * @param  [type] $monto    [valor a pagar]
   * @param  [type] $moneda   [moneda con que se va a cancelar]
   * @return [type]           [description]
   */
	public function crear_hash($ref_pago,$monto,$moneda){
        

          if(_API_KEY==""){
            return false;
          } 

          if(_MERCHANT_ID==""){
            return false;
          }

          if(_TYPE_ENCRIPT==""){
            return false;
          }

          $DATA=trim(_API_KEY."~"._MERCHANT_ID."~".$ref_pago."~".$monto."~".$moneda);  
          //echo $DATA;
          switch (_TYPE_ENCRIPT) {
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
        

		    
  	
	}	

	

}

