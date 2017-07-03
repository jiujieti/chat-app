<?php
require 'include/models/message.php';

class MessageController {

  public $msg;

  public function __construct() {
    $this->msg = new Message();
  }

}
?>