<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"),true);

$cid = $data['cate_id'];
$cname = $data['cate_name'];
$pname = $data['prod_name'];
$price = $data['prod_price'];

include "config.php";

$sql = "update products set cat_name = '{$cname}', pro_name = '{$pname}', pro_price = {$price} where id = {$cid}";

$result = mysqli_query($conn, $sql) or die("SQL Query Failed");

if(($result)){
    echo json_encode(array('message' => 'Item Record Updated', 'status' => true));
}
else{
    echo json_encode(array('message' => 'Item Record Not Updated', 'status' => false));
}

?>