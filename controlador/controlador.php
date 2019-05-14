<?php
include('../core/Payu.php');
$db=new Payu();

echo json_encode(['hash'=>$db->crear_hash($_POST['referenceCode'],$_POST['amount'],$_POST['currency'])]);
