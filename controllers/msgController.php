<?php
require 'models/message.php';

class MessageController {

  public $msg;

  public function __construct() {
    $this->msg = new Message();
  }

  public function retrieve($receiverID, $senderID, $rowID) {
    $results = $this->msg->retrieveMsg($receiverID, $senderID, $rowID);
    return $results;
  }

  public function store($senderID, $receiverID, $content, $t) {
    $this->msg->storeMsg($senderID, $receiverID, $content, $t);
  }

  public function getMaxRow() {
    return $this->msg->getLastRowID();
  }
}
?>