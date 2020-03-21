<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');
class DataUpdateAM extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    function InsertImgIfNotExistOrUpdate($tableName, $image){
        $sql = "INSERT INTO {$tableName} VALUES ('{$image['id']}', '{$image['fileData']}', {$image['fileSize']}, '{$image['fileType']}')
                ON DUPLICATE KEY
                UPDATE Image = '{$image['fileData']}', FileSize = {$image['fileSize']}, FileType = '{$image['fileType']}'";
        $result = $this->db->query($sql);
        return($result);
    }
    function InsertSubjectIfNotExistOrUpdate($value, $valueArray){
        try {
            $sql = "INSERT INTO marks_info (StudentId, SubjectCode, SubjectOfYear, SubjectOfSemister, Cardit, Status)
                VALUES ({$value})
                ON DUPLICATE KEY
                UPDATE SubjectOfYear = {$valueArray[2]}, SubjectOfSemister = {$valueArray[3]}, Cardit = {$valueArray[4]}, Status = {$valueArray[5]}";
            $this->db->query($sql);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    function UpdateAdviserInformation($data, $id){
        try {
           $this->db->update('adviser',$data['advInfo'],"AdviserId = '{$id}'");
           return TRUE;
        } catch (Exception $ex) {
            return $exc->getTraceAsString();
        }   
    }
    function UpdateRegistrationStatus($receiveNo, $regStatus){
        $data = array('RegistrationStatus' => $regStatus);
        $result = $this->db->update('registration_info', $data, array('ReceiveNo' => $receiveNo));
        if($result){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    function InsertOrUpdateTheoryOthers($value, $valueArray){
        try {
            //Data insert/update into theory table
            $sql = "INSERT INTO theory (StudentId, SubjectCode, ClassTest_1, ClassTest_2, ClassTest_3, ClassTest_4, ClassTest_5, Attendance)
                VALUES ({$value})
                ON DUPLICATE KEY
                UPDATE ClassTest_1 = {$valueArray[2]}, ClassTest_2 = {$valueArray[3]}, ClassTest_3 = {$valueArray[4]},
                                    ClassTest_4 = {$valueArray[5]}, ClassTest_5 = {$valueArray[6]}, Attendance = {$valueArray[7]}";
            $this->db->query($sql);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    function InsertOrUpdateTheoryFinalExam($value, $valueArray){
        try {
            //Data insert/update into theory table
            $sql = "INSERT INTO theory (StudentId, SubjectCode, FinalExam, GPA, GradeLetter)
                VALUES ({$value})
                ON DUPLICATE KEY
                UPDATE FinalExam = {$valueArray[2]}, GPA = {$valueArray[3]}, GradeLetter = {$valueArray[4]}";
            $this->db->query($sql);
            
            //Data update into marks_info table
            $sql = "UPDATE marks_info SET GPA ={$valueArray[3]}, GradeLetter = {$valueArray[4]} WHERE StudentId = {$valueArray[0]} AND SubjectCode = {$valueArray[1]}";
            $this->db->query($sql);
            //$affectedRow = $this->db->affected_rows();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    function InsertOrUpdateSessionalLabAssesment($value, $valueArray){
        try {
            //Data insert/update into sessional table
            $sql = "INSERT INTO sessional (StudentId, SubjectCode, Assesment_1, Assesment_2, Assesment_3, Assesment_4)
                VALUES ({$value})
                ON DUPLICATE KEY
                UPDATE Assesment_1 = {$valueArray[2]}, Assesment_2 = {$valueArray[3]}, Assesment_3 = {$valueArray[4]}, Assesment_4 = {$valueArray[5]}";
            $this->db->query($sql);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    function InsertOrUpdateSessionalQuizeAttendance($value, $valueArray){
        //$this->output->enable_profiler(TRUE);
        try {
            //Data insert/update into theory table
            $sql = "INSERT INTO sessional (StudentId, SubjectCode, Quize, Attendance, GPA, GradeLetter)
                VALUES ({$value})
                ON DUPLICATE KEY
                UPDATE Quize = {$valueArray[2]}, Attendance = {$valueArray[3]}, GPA = {$valueArray[4]}, GradeLetter = {$valueArray[5]}";
            $this->db->query($sql);
            
            //Data update into marks_info table
            $sql = "UPDATE marks_info SET GPA ={$valueArray[4]}, GradeLetter = {$valueArray[5]} WHERE StudentId = {$valueArray[0]} AND SubjectCode = {$valueArray[1]}";
            $this->db->query($sql);
            //$affectedRow = $this->db->affected_rows();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}