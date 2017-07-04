<?php
require 'controllers/msgController.php';

$msgController = new MessageController();
$result = $msgController->retrieve($_GET['receiverID'], $_GET['senderID'], $_GET['rowID']);
$response = array();
while($res = $result->fetchArray()) {
  array_push($response, $res);
}
$row = $msgController->getMaxRow();
array_push($response, $row);
echo json_encode($response);
?>