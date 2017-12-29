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
        $_POST['auth'] = 12345;
        $_POST['request_type'] = "SELECT";
        $_POST['table'] = "test";
        $_SERVER["REQUEST_METHOD"] = "POST";
        $this->auth();
    }

//Please refactor this shit.
    private function auth()
    {
        if (!isset($_POST['auth'])) {
            die("Not Authorized");
        } else {
            if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                if ($_POST['auth'] !== 12345) {
                    die("Incorrect Credentials");
                } else {
                    $this->request($_POST);
                }
            } else {
                die("Something went wrong");
                exit;
            }
        }
    }

    private function request($data)
    {
        $model = new Model;
        $result = $this->conn->query($model->CreateQuery($data));

        if ($result->num_rows > 0) {
            $this->result($result->fetch_object());
        } else {
            $this->result("No results returned");
        }
    }

    public function result($row)
    {
        $row = json_encode($row);
        print_r($row);
        $this->clean();
        exit;
    }

    public function clean()
    {
        $this->conn->close();
        unset($this->conn);
    }

}
