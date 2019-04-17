<?php

class User {
    public $customerid;
    public $data;
    private $database;
    
    function __construct($customerid, $database) {
        $this->customerid = $customerid;
        $this->database = $database;

        $sql = get_sql('getCustomer');
        $params = array("customerid"=>$customerid);
        $statement = $database->prepare($sql);
        $statement->execute($params);
        $customer = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->data = $customer[0];
    }
}

?>