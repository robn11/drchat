<?php
class DoctorInfo {
    public $drId;
    public $data;
    
    function __construct($drId) {
        $this->drId = $drId;
    }

    function set($key, $value) {
        $this->$key = $value;
        return $this;
    }

    function save($database, $action) {
        $params = array(
            "doctorId"=>$this->doctorid,
            "officeName"=>$this->officeName,
            "officeType"=>$this->officeType,
            "officeAddress"=>$this->officeAddress,
            "officeZip"=>$this->officeZip,
            "officeCity"=>$this->officeCity,
            "officePhone"=>$this->officePhone,
            "patients"=>$this->patients
        );
        $sql = get_sql($action . "DoctorInfo");
        $statement = $database->prepare($sql);
        $statement->execute($params);
    }

    function getDoctorInfo($database) {

        $sql = get_sql('getDoctorInfoByUserId');
        $params = array("doctorid"=>$this->drId);
        $statement = $database->prepare($sql);
        $statement->execute($params);
        $drInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $drInfo[0];
    }
}

?>