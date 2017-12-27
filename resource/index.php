<?php

namespace pipeline;
use pipeline\connect;
use pipeline\model;

class pipeline {
  protected $result;
  protected $auth;
/*
  Call all resources for pipeline
  call correct action method
*/
  public function __construct()
  {
    echo "Running<br>";
    $_GET['auth'] = 12345;
    $this->auth();
  }

  private function auth()
  {
    if($_SERVER["REQUEST_METHOD"] == 'GET') {
      if($_GET['auth'] !== 12345)
      {
        die("Incorrect Credentials");
      } else {
        $this->request($_GET);
      }
    } elseif($_SERVER["REQUEST_METHOD"] == 'POST') {
      if($_POST['auth'] !== 12345)
      {
        die("Incorrect Credentials");
      } else {
        $this->request($_POST);
      }
    }

    echo "<br>Auth running";
  }

  private function datetime()
  {

  }

  private function request($data)
  {
      print_r($data);
  }

  public function result()
  {

  }

}

$pipeline = new pipeline;

?>
