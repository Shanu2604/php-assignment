<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"),true);

$cname = $data['cate_name'];
$pname = $data['prod_name'];
$price = $data['prod_price'];

include "config.php";

$sql = "insert into products(cat_name, pro_name, pro_price) values ('{$cname}','{$pname}','{$price}')";

$result = mysqli_query($conn, $sql) or die("SQL Query Failed");

if(($result)){
    echo json_encode(array('message' => 'Item Record Inserted', 'status' => true));
}
else{
    echo json_encode(array('message' => 'Item Record Not Inserted', 'status' => false));
}

?>