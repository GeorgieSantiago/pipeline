<?php

class Connect{
  protected $host;
  protected $user;
  protected $password;
  protected $database;
  public $connection;

  public function __construct()
  {
    $this->host = 'localhost';
    $this->user = 'root';
    $this->password = '';
    $this->database = 'pipeline';

    $this->Connect();
  }

  public function Connect()
  {
      $this->connection =  new mysqli($this->host , $this->user , $this->password , $this->database);
  }
}

$db = new Connect;
