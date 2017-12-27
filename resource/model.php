<?php
namespace pipeline\model;
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
        if (!isset($data['condition'])) {
            if ($data['request_type'] == "SELECT") {
                return $data['request_type'] . " * FROM " . $data['table'];
            } else {
                return $data['request_type'] . " * FROM " . $data['table'] . " WHERE " . $data['condition'];
            }
        } elseif ($data['request_type'] == "INSERT") {
            return $data['request_type'] . " INTO " . $data['table'] . " VALUES('" . $data['values'] . "')";
        }
    }
}
