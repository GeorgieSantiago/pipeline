<?php
require "resource/connect.php";
require "resource/model.php";
include "vendor/larapack/dd/src/helper.php";
use Larapacks\Authorization\Traits\RolePermissionsTrait as Auth;
use illuminate\database as db;

class pipeline extends Connect
{
    protected $result;
    protected $auth;
    protected $conn;
    /*
    Call all resources for pipeline
    call correct action method
    */
    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->Connect();
        $this->auth();
    }

    private function auth()
    {
        if (!isset($_POST['auth'])) {
            die("Not Authorized");
        } else {
            if ($_SERVER["REQUEST_METHOD"] == 'GET') {
                die("Not Authorized");
            } elseif ($_SERVER["REQUEST_METHOD"] == 'POST') {
                if ($_POST['auth'] !== 12345) {
                    die("Incorrect Credentials");
                } else {
                    $this->request($_POST);
                }
            }
        }
    }

    private function request($data)
    {
        $model  = new Model;
        $result = $this->conn->querty($model->CreateQuery($data));

        if ($result->affected_rows > 0) {
            $this->result($result->fetch_object);
        } else {
            $this->result("No results returned");
        }
    }

    public function result($row)
    {
        var_dump($row);
        $row = json_encode($row);
        $pipeline->clean();
        exit;
    }

    public function clean()
    {
        unset($this);
    }

}
