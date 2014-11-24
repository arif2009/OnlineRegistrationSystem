<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');
class DataUpdateSM extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function InsertImgIfNotExistOrUpdate($tableName, $image){
        $sql = "INSERT INTO {$tableName} VALUES ('{$image['id']}', '{$image['fileData']}', {$image['fileSize']}, '{$image['fileType']}')
                ON DUPLICATE KEY
                UPDATE Image = '{$image['fileData']}', FileSize = {$image['fileSize']}, FileType = '{$image['fileType']}'";
        $result = $this->db->query($sql);
        return($result);
    }
    function UpdateStudentInfo($data, $studentId){
        $result = $this->db->where('StudentId', $studentId)
                           ->update('student_info',$data);
        if($result){return TRUE;}else{return FALSE;}
    }
    function InsertSubjectIfNotExistOrUpdate($value, $valueArray){
        $sql = "INSERT INTO marks_info (StudentId, SubjectCode, SubjectOfYear, SubjectOfSemister, Cardit, Status)
                VALUES ({$value})
                ON DUPLICATE KEY
                UPDATE StudentId = {$valueArray[0]}, SubjectCode = {$valueArray[1]}, SubjectOfYear = {$valueArray[2]}, SubjectOfSemister = {$valueArray[3]}, Cardit = {$valueArray[4]}, Status = {$valueArray[5]}";
        $this->db->query($sql);
    }
    function UpdateCompletedSemister($year, $semister, $stdId){
            if($year == '1st'){
            $column = 'FirstYsecondS';
            }elseif($year == '2nd'){
                if($semister == '1st'){
                    $column = 'SecondYfirstS';
                }else{
                $column = 'SecondYsecondS'; 
                }
            }elseif($year == '3rd'){
                if($semister == '1st'){
                    $column = 'ThirdYfirstS';
                }else{
                $column = 'ThirdYsecondS'; 
                }
            }elseif($year == '4th'){
                if($semister == '1st'){
                    $column = 'FourthYfirstS';
                }else{
                $column = 'FourthYsecondS'; 
                }
            }
            $this->db->set($column, 'completed')
                     ->where('StudentId', $stdId)
                     ->update('completed_semister');
    }
}
