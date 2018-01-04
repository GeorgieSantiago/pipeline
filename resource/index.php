<?php
//Testing data
/*
$_POST['auth'] = 12345;
$_POST['request_type'] = "SELECT";
$_POST['table'] = "test";
$_SERVER["REQUEST_METHOD"] = "POST";
*/
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
     *  @params
     *  @return
     *  @description: Checks Authentication and ACL for Pipeline API
     * */
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        parent::__construct();
        $this->acl();
        $this->conn = $this->Connect();
        $this->auth();
    }

//Please refactor this shit.
    private function auth()
    {
        if (!isset($_POST['auth'])) {
            die("Not Authorized");
        } else {
            if ($_POST['auth'] !== '12345') {
                die("Incorrect Credentials");
            } else {
                $this->request($_POST);
            }
        }
    }

    private function request($data)
    {
        $model = new Model;
        $sql = $model->CreateQuery($data);
        //$tmp = get_class_methods(print_r($this->conn));
//        die($tmp);
        $result = $this->conn->query($sql);
        $tmp = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tmp[] = $row;
            }
            $this->resulter($tmp);
        } else {
            $this->resulter("No results returned");
        }
    }

    public function resulter($row)
    {
        $row = json_encode($row);
        print_r($row);
        $this->clean();
        exit;
    }

    /*TODO Grant strict access through ACL*/
    protected function acl()
    {
        return false;
    }

    public function clean()
    {
        $this->conn->close();
        unset($this->conn);
    }

}
