<?php
class Message {
  
  public $msgID;
  public $senderID;
  public $receiverID;
  public $content;
  public $dtime;

  public function __construct($senderID, $receiverID, $content, $dtime) {
    $this->msgID = uniqid('msg_');
    $this->senderID = $senderID;
    $this->receiverID = $receiverID;
    $this->content = $content;
    $this->dtime = $dtime;
  }

}
?>