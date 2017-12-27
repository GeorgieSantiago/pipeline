<?php

class Connect{
  protected $host;
  protected $user;
  protected $password;
  protected $database;
  public $connection;

  public function __construct()
  {
    $this->host = DB_HOST;
    $this->user = DB_USER;
    $this->password = DB_PASSWORD;
    $this->database = DB_TABLE;

    $this->Connect();
  }

  public function Connect()
  {
      $this->connection =  new mysqli($this->host , $this->user , $this->password , $this->database);
  }
}

$db = new Connect;
