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
}
