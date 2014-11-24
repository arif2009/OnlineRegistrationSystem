<?php
class DataViewRM extends CI_Model{
    function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
    }
    function GetNumberOfAllAdviser(){
        //Query for number of Adviser per Department
        $queryDept = $this->db->query("SELECT d.DepartmentName, count( a.AdviserId ) 'NumOfAdv'
                                   FROM adviser a, department d
                                   WHERE a.DepartmentId = d.DepartmentId
                                   GROUP BY d.DepartmentName;");
        $data['advPerDept'] = $queryDept->result();
        //Query for number of Total Adviser
        $queryAll = $this->db->query("SELECT count( AdviserId ) 'NumOfAdv'
                                   FROM adviser;");
        $result = $queryAll->result();
        $allAdv = $result[0]->NumOfAdv;
        $data['advAll'] = $allAdv;
        return($data);
    }
    
    function GetNumberOfAllStudent(){
        //Query for number of Student per Department
        $query = $this->db->query("SELECT d.DepartmentName, count( s.StudentId ) 'NumOfStd'
                                   FROM student_info s, department d
                                   WHERE s.DepartmentId = d.DepartmentId
                                   GROUP BY d.DepartmentName;");
        $data['stdPerDept'] = $query->result();
        //Query for number of Total Adviser
        $queryAll = $this->db->query("SELECT count( StudentId ) 'NumOfStd'
                                   FROM student_info;");
        $result = $queryAll->result();
        $data['stdAll'] = $result[0]->NumOfStd;
        return($data);
    }
    
    function GetAllDepartment(){
        //Qurey for select all department in department table
        $query = $this->db->select('DepartmentId, DepartmentName')
                          ->get_where('department',array('DegreeAward' => 'yes'));
        $table = $query->result();
        return($table);
    }
    
    function GetAllFaculty(){
        //Qurey for select all faculty in faculty table
        $query = $this->db->select('FacultyId, FacultyName')
                          ->from('faculty')
                          ->get();
        $table = $query->result();
        return($table);
    }
    
    function GetAdviserInADepartment($deptId){
        //Query for getting all adviser in a individual department
        $query = $this->db->select('AdviserId, AdviserName')
                          ->get_where('adviser',array('DepartmentId' => $deptId));
        $table = $query->result();
        return($table);
    }
    function GetAdviserIdPasswordPerDept($deptId){
        $query = $this->db->select('a.AdviserId, a.AdviserName, p.Password')
                          ->from('adviser a')
                          ->join('password p', 'a.AdviserId = p.Id', 'left')
                          ->where('a.DepartmentId', $deptId);
        $query = $this->db->get();
        $table = $query->result();
        return($table);
    }
    function GetStudentIdPasswordPerDept($deptId){
        $query = $this->db->select('s.StudentId, s.StudentName, p.Password')
                          ->from('student_info s')
                          ->join('password p', 's.StudentId = p.Id', 'left')
                          ->where('s.DepartmentId', $deptId);
        $query = $this->db->get();
        $table = $query->result();
        return($table);
    }
    function CheckEmailId($email, $id, $tableName){
        //Query for checking Email and Id exist in database
        if($tableName == 'student_info'){
            $attribute1 = 'StudentId';
            $attribute2 = 'Email';
        }
        else if($tableName == 'adviser'){
            $attribute1 = 'AdviserId';
            $attribute2 = 'Email';
        }
        $query = $this->db->select($attribute1.','.$attribute2)
                          ->from($tableName)
                          ->where($attribute1, $id)
                          ->or_where($attribute2, $email)
                          ->get();
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return($result);
        }
        else {return(FALSE);}  
    }
    
    function CheckDepartmentId($id){
        $query = $this->db->select('DepartmentId')
                          ->get_where('department', array('DepartmentId' => $id));
        if($query->num_rows() > 0){
            return TRUE;
        }
        else {return FALSE;}
    }
    

    function GenerateId() {
        $query = $this->db->select('AdviserId')
                          ->from('adviser')
                          ->get();
        $row = $query->last_row();
        if($row){
            $idPostfix = (int)substr($row->AdviserId,1)+1;
            $nextId = 'A'.STR_PAD((string)$idPostfix,5,"0",STR_PAD_LEFT);
        }
        else{$nextId = 'A00001';}
    return $nextId;
    }
    
    function GetDepartmentName($deptId){
        $query = $this->db->select('DepartmentName')
                          ->get_where('department', array('DepartmentId' =>$deptId));
        $table = $query->result();
        $deptName = $table[0]->DepartmentName;
        return $deptName;
    }
    function RetrieveTitleNotice(){
        $query = $this->db->from("notice")
                          ->order_by("id","desc")
                          ->limit(1)
                          ->get();
        $result = $query->result();
        return $result;
    }
}