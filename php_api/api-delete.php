<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"),true);

$pro_id = $data['pid'];

include "config.php";

$sql = "delete from products where id = {$pro_id}";

$result = mysqli_query($conn, $sql) or die("SQL Query Failed");

if($result){
    echo json_encode(array('message' => 'Item Record Deleted', 'status' => true));
}
else{
    echo json_encode(array('message' => 'Item Record Not Deleted', 'status' => false));
}

?>