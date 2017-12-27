<?php
require "resource/connect.php";
require "resource/model.php";
include "vendor/larapack/dd/src/helper.php";
use Larapacks\Authorization\Traits\RolePermissionsTrait as Auth;
use illuminate\database as db;

class pipeline
{
    protected $result;
    protected $auth;
    protected $conn;
    /*
    Call all resources for pipeline
    call correct action method
    */
    public function __construct($db)
    {
        $this->conn = $db->connection;
        $_GET['auth'] = 12345;
        $this->auth();
    }

    private function auth()
    {
        if ($_SERVER["REQUEST_METHOD"] == 'GET') {
            if ($_GET['auth'] !== 12345) {
                die("Incorrect Credentials");
            } else {
                $this->request($_GET);
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == 'POST') {
            if ($_POST['auth'] !== 12345) {
                die("Incorrect Credentials");
            } else {
                $this->request($_POST);
            }
        }
    }

    private function datetime()
    {

    }


/*Example request:  $result = $this->conn->query("SELECT * FROM test"); */
    private function request($data)
    {
        $model = new Model;
        $query = $this->conn->query($model->getTableList());
        print_r($data);
    }

    public function result()
    {
        $pipeline->clean();
    }

    public function clean()
    {
        unset($this);
    }

}

$pipeline = new pipeline($db);
