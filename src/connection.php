<?php

  class Connection{
    public function __construct(){
      $conn = mysql_connect('localhost', 'root', '');
      return $conn;
    }
  }

?>