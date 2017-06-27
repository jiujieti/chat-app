<?php
require 'controllers/msgController.php';

$msg = new MessageController();
$result = $msg->getAllMsg($_GET['receiverID'], $_GET['senderID']);
$response = array();
while($res = $result->fetchArray()) {
  array_push($response, $res);
}
$row = $msg->getLastRowID();
array_push($response, $row);
echo json_encode($response);
?>