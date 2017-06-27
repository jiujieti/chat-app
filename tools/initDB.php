<?php
// create a new database
try {
  $db = new SQLite3('../chatAppDB.db');

  // create tables for the new database
  $db->exec('CREATE TABLE IF NOT EXISTS users (userID varchar(255),
                                             userName varchar(255))');

  $db->exec('CREATE TABLE IF NOT EXISTS messages (msgID varchar(255),
                                      senderID varchar(255),
                                      receiverID varchar(255),
                                      content text,
                                      dtime date)');}

catch (Exception $e) {
  echo $e->getMessage();
}
?>
