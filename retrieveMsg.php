<?php
require 'include/controllers/msgController.php';

$msgController = new MessageController();
$msg = $msgController->msg;
$result = $msg->retrieveMsg($_GET['receiverID'], $_GET['senderID'], $_GET['rowID']);
$response = array();
while($res = $result->fetchArray()) {
  array_push($response, $res);
}
$row = $msg->getLastRowID();
array_push($response, $row);
echo json_encode($response);
?>