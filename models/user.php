<?php
class User {

  public $userID;
  public $userName;

  public function __construct($uname) {
    $this->userID = uniqid('usr_');
    $this->userName = $uname;
  }
  
}
?>
