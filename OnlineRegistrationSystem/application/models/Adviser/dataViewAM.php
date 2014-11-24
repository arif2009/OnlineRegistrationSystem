<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');
class DataViewAM extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function GetaAdviserInfo($id){
        $query = $this->db->get_where('adviser',array('AdviserId' => $id));
        $result = $query->result();
        return($result);
    }
    function GetAllRequestedStudent($advId){
        $this->db->select('s.StudentId, s.StudentName, r.YearSemister, r.RegistrationStatus')
                 ->from('student_info s, registration_info r')
                 ->where("s.StudentId = r.StudentId AND s.AdviserId = '{$advId}'");
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result();
            return($result);
        }
        else{
            return FALSE;
        }
    }
    function GetAllStudentUnderAadviser($advId){
        $query = $this->db->select('StudentId, StudentName')
                          ->get_where('student_info', array('AdviserId' => $advId));
        if($query->num_rows() > 0){
            $result = $query->result();
            return($result);
        }
        else{
            return FALSE;
        }
    }
    function CheckRegistrationStatus($stdId){
        $query = $this->db->select('RegistrationStatus')
                          ->get_where('registration_info', array('StudentId' => $stdId));
        if($query->num_rows() > 0){
            $result = $query->result();
            $status = $result[0]->RegistrationStatus;
            return($status);
        }
        else{
            return FALSE;
        }
    }
    function GetRegistrationInfo($stdId){
        $query = $this->db->select('ReceiveNo, RequiredSubject, TakenSubject')
                          ->get_where('registration_info', array('StudentId' => $stdId));
        $result = $query->result();
        return($result);
    }
    function GetRequiredSubjectDetails($subjectCode){
        $this->db->select('SubjectCode, SubjectTitle, Cardit, SubjectOfYear, SubjectOfSemister')
                 ->from('total_subject')
                 ->where_in('SubjectCode', $subjectCode);
        $query = $this->db->get();
        $result = $query->result();
        return($result);
    }
    function GetSubjectForEnterMark($array, $subjectType){
	$this->db->select('SubjectCode, SubjectTitle')
                 ->from('total_subject')
                 ->where($array)
                 ->where("mod(substring(SubjectCode,-1,1),2) = {$subjectType}",null,false);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return($query->result());
        }
        else {
            return FALSE;
        }
    }
    function GetStudentToGiveMark($array){
        $query = $this->db->select('StudentId')
                          ->get_where('marks_info', $array);
        if($query->num_rows() > 0){
            return($query->result());
        }else{
            return FALSE;
        }
    }
    function GetStudentCTandAttendanceMark($stdId, $subjectCode){
        $query = $this->db->select('ClassTest_1, ClassTest_2, ClassTest_3, ClassTest_4, ClassTest_5, Attendance')
                          ->get_where('theory', array('StudentId'=>$stdId, 'SubjectCode'=>$subjectCode));
        if($query->num_rows() > 0){
            return($query->result());
        }else{
            return(0);
        }
    }
    function GetSumOfCTandAttendanceAndOthers($stdId,$subjectCode){
        $query = $this->db->query("SELECT FinalExam, ClassTest_1, ClassTest_2, ClassTest_3, ClassTest_4, ClassTest_5, Attendance, GPA, GradeLetter
                                   FROM theory
                                   WHERE `StudentId` = '{$stdId}' AND `SubjectCode` = '{$subjectCode}'");
        if($query->num_rows() > 0){
            $result = $query->result();
            $ct[] = $result[0]->ClassTest_1;
            $ct[] = $result[0]->ClassTest_2;
            $ct[] = $result[0]->ClassTest_3;
            $ct[] = $result[0]->ClassTest_4;
            $ct[] = $result[0]->ClassTest_5;
            $attendance = $result[0]->Attendance;
            rsort($ct);
            $data['finalExam']  = $result[0]->FinalExam;
            $data['bestOf4Att'] = $ct[0]+$ct[1]+$ct[2]+$ct[3]+$attendance;
            $data['GPA']        = $result[0]->GPA;
            $data['GradeLetter']= $result[0]->GradeLetter;
            return($data);
        }else{
            return(0);
        }
    }
    function GetSumOfCEAndAttFinalGPA($stdId,$subjectCode){
        $query = $this->db->query("SELECT ifnull(`Assesment_1` , 0) + ifnull(`Assesment_2`, 0 ) + ifnull(`Assesment_3`, 0 ) + ifnull(`Assesment_4`, 0 ) AS ContineousAss,
                                   Quize, Attendance, GPA, GradeLetter
                                   FROM sessional
                                   WHERE `StudentId` = '{$stdId}' AND `SubjectCode` = '{$subjectCode}'");
        if($query->num_rows() > 0){
            $result = $query->result();
            $data['quize']      = $result[0]->Quize;
            $data['attendance'] = $result[0]->Attendance;
            $data['contEva']    = $result[0]->ContineousAss;
            $data['gpa']        = $result[0]->GPA;
            $data['gradeLetter']= $result[0]->GradeLetter;
            return($data);
        }else{
            $data['quize']=$data['attendance']=$data['contEva']=$data['gpa']=$data['gradeLetter']=0;
            return($data);
        }
    }
    function GetStudentLabAssesmentMark($id, $subCode){
        $query = $this->db->select('Assesment_1, Assesment_2, Assesment_3, Assesment_4')
                          ->get_where('sessional',array('StudentId'=>$id, 'SubjectCode'=>$subCode));
        if($query->num_rows() > 0){
            $result = $query->result();
            $data['Assesment_1'] = $result[0]->Assesment_1;
            $data['Assesment_2'] = $result[0]->Assesment_2;
            $data['Assesment_3'] = $result[0]->Assesment_3;
            $data['Assesment_4'] = $result[0]->Assesment_4;
            return($data);
        }else{
            $data['Assesment_1']=$data['Assesment_2']=$data['Assesment_3']=$data['Assesment_4']=0;
            return($data);
        }
    }
    function GetAdviserDetails($advId){
        $query = $this->db->select('a.AdviserId pictureId, a.AdviserName \'Adviser Name\', d.DepartmentName Department, a.ContractNumber \'Contract Number\', a.Email')
                          ->from('adviser a')
                          ->join('department d', 'a.DepartmentId = d.DepartmentId', 'left')
                          ->where("a.AdviserId ='{$advId}'");
        $query = $query->get();
        $result= $query->result();
        return($result);
    }
}
