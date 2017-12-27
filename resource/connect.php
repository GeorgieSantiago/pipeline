<?php

namespace pipeline\connect;

class connect{
  protected $host;
  protected $user;
  protected $password;
  protected $database;

  public function __construct()
  {
    $this->host = 'localhost';
    $this->user = 'root';
    $this->password = '';
    $this->database = 'pipeline';
  }

  public static function Connect()
  {
      return new mysqli($this->host , $this->user , $this->password , $this->database);
  }


}
