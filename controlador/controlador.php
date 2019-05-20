<?php
include('../core/Payufile.php');
$db=new Payufile();

echo json_encode(['hash'=>$db->crear_hash($_POST['referenceCode'],$_POST['amount'],$_POST['currency'])]);
