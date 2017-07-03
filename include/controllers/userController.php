<?php
require 'include/models/user.php';

class UserController {

  public $usr;

  public function __construct() {
    $this->usr = new User();
  }

}
?>