<?php
class SQLiteDB extends SQlite3 {

  function __construct() {
    try {
      $this->open("chatAppDB.db");
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }

}
?>