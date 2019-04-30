<?php
class NurseInfo {
    public $nurseId;
    public $infoEntered;
    
    function __construct($nurseId) {
        $this->nurseId = $nurseId;
    }

    function set($key, $value) {
        $this->$key = $value;
        return $this;
    }

    function save($database, $action) {
        $this->infoEntered = 1;
        $params = array(
            "nurseid"=>$this->nurseId,
            "schoolName"=>$this->schoolName,
            "schoolType"=>$this->schoolType,
            "schoolAddress"=>$this->schoolAddress,
            "schoolCity"=>$this->schoolCity,
            "schoolZip"=>$this->schoolZip,
            "schoolPhone"=>$this->schoolPhone,
            "students"=>$this->students
        );
        $sql = get_sql($action . "NurseInfo");
        $statement = $database->prepare($sql);
        $statement->execute($params);
    }

    function getNurseInfo($database) {

        $sql = get_sql('getNurseInfoByUserId');
        $params = array("nurseid"=>$this->nurseId);
        $statement = $database->prepare($sql);
        $statement->execute($params);
        $drInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $drInfo[0];
    }
}

?>