<?php

class Model
{


    public function __construct($table = "")
    {
        //prepare query
    }

    public function getTableList()
    {
        return "SELECT * FROM tables";
    }

    /*Very simple request handler*/
    /*TODO -> Prepared statments
    ->Add methods for Update and Delete
    */
    public function CreateQuery($data)
    {
        /*TODO Special User Query type*/
        if ($data['request_type'] == 'User') {
            die("User Info request feature first. Login and registration next!");
            $this->authorize($data);
            exit;
        }

        if ($data['request_type'] == 'Register') {
            die("Registration");
            $this->register($data);
            exit;
        }

        if ($data['request_type'] == "SELECT") {
            if (!isset($data['condition'])) {
                return $data['request_type'] . " * FROM " . $data['table'];
            } else {
                return $data['request_type'] . " * FROM " . $data['table'] . " WHERE " . $data['condition'];
            }
        } elseif ($data['request_type'] == "INSERT") {
            return $data['request_type'] . " INTO " . $data['table'] . " VALUES('" . $data['values'] . "')";
        }
    }

    public function authorize($data)
    {
        $un = $data['username'];
        $pw = $data['password'];

        $sql = "SELECT * FROM users WHERE `username`=$un AND `pin`=$pw";

        return $sql;
    }

    protected function register($data)
    {
        $un = $data['username'];
        $pw = $data['pin'];
        $email = $data['email'];

        $sql = "INSERT INTO users VALUES($un , $pw , $email)";
        return $sql;
    }
}
