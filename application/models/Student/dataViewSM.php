<?php if(!defined('BASEPATH')) exit ('No direct script allowed');
class DataViewSM extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    
    function GetaStudentDetails($id){
        $query = $this->db->select('s.StudentId \'pictureId\', s.StudentId \'Student Id :\', s.StudentName \'Student Name :\', s.FathersName \'Fathers Name :\', s.MothersName \'Mothers Name :\', s.PresentAddress \'Present Address :\', s.ParmanentAddress \'Parmanent Address :\', s.ContractNumber \'Contract Number :\', s.Email \'Email :\', s.Sex \'Sex :\', d.DepartmentName \'Department Name :\', s.AdmitDate \'Admit Date :\'')
                          ->from('student_info s')
                          ->join('department d','s.DepartmentId = d.DepartmentId','left')
                          ->where("s.StudentId = $id");
        $query = $query->get();
        $result = $query->result();
        return($result);
    }
    
    function GetaStudentInfo($id){
        $query = $this->db->get_where('student_info',array('StudentId' => $id));
        $result = $query->result();
        return($result);
    }
    function GetAdviserInfoToShowStudent($stdId){
        $query = $this->db->select('a.AdviserId pictureId, a.AdviserName \'Adviser Name\', d.DepartmentName Department, a.ContractNumber \'Contract Number\', a.Email')
                          ->from('adviser a')
                          ->join('department d', 'a.DepartmentId = d.DepartmentId', 'left')
                          ->where("a.AdviserId =(select AdviserId FROM student_info WHERE StudentId = {$stdId})");
        $query = $query->get();
        $result= $query->result();
        return($result);
    }
    
    //start model coding for select subject
    function GetRegistrationStatus($stdId){
        $query  = $this->db->select('RegistrationStatus')
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
    function GetAdviserIdByStudentId($stdId){
        $query = $this->db->select('AdviserId')
                          ->get_where('student_info', array('StudentId' => $stdId));
        $result = $query->result();
        $adviserId = $result[0]->AdviserId;
        return($adviserId);
    }
    function GetFailedSubject($stdId){
        //Get failed subject of a student
        $where = "s.SubjectCode = m.SubjectCode and m.StudentId = $stdId and m.GradeLetter = 'F'";
        $query = $this->db->select('m.SubjectCode, s.SubjectTitle, m.SubjectOfYear, m.SubjectOfSemister, m.Cardit')
                          ->from('total_subject as s, marks_info as m')
                          ->where($where);
        $query = $query->get();
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return($result);
        }
        else{
            return FALSE;
        }
    }
    function GetFirstUncompleteSemister($stdId){
        //return first uncomplete Semister.
        //if there are no uncompleted semister return no.
        $query = $this->db->select('FirstYsecondS, SecondYfirstS, SecondYsecondS, ThirdYfirstS, ThirdYsecondS, FourthYfirstS, FourthYsecondS')
                          ->get_where('completed_semister', array('StudentId' => $stdId));
        $result = $query->result();
        foreach ($result[0] as $key => $value) {
            if($value == 'uncomplete'){
               $yearSemister = $key;
               break;
            }
        }
        if(isset($yearSemister)){
            if($yearSemister == 'FirstYsecondS'){
                $data['SubjectOfYear']    = '1st';
                $data['SubjectOfSemister']= '2nd';
           }
           elseif($yearSemister == 'SecondYfirstS'){
                $data['SubjectOfYear']    = '2nd';
                $data['SubjectOfSemister']= '1st';
           }
           elseif($yearSemister == 'SecondYsecondS'){
                $data['SubjectOfYear']    = '2nd';
                $data['SubjectOfSemister']= '2nd';
           }
           elseif($yearSemister == 'ThirdYfirstS'){
                $data['SubjectOfYear']    = '3rd';
                $data['SubjectOfSemister']= '1st';
           }
           elseif($yearSemister == 'ThirdYsecondS'){
                $data['SubjectOfYear']    = '3rd';
                $data['SubjectOfSemister']= '2nd';
           }
           elseif($yearSemister == 'FourthYfirstS'){
                $data['SubjectOfYear']    = '4th';
                $data['SubjectOfSemister']= '1st';
           }
           elseif($yearSemister == 'FourthYsecondS'){
                $data['SubjectOfYear']    = '4th';
                $data['SubjectOfSemister']= '2nd';
           }
           //return first uncomplete year Semister.
           return($data);
        }
        else{
            //False means there are no uncompleted semister.
            return FALSE;
        }
    }
    function GetNewSemisterSubject($data){
        $query = $this->db->select('SubjectCode, SubjectTitle, SubjectOfYear, SubjectOfSemister, Cardit')
                          ->get_where('total_subject', $data);
        
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }
        else{
            return FALSE;
        }
    }
    //end model coding for select subject
    
    function GetFaildSubject($year, $semister, $stdId){
        $array = array(
            'm.StudentId'      =>$stdId,
            'm.SubjectOfYear'  =>$year,
            'm.SubjectOfSemister'=>$semister,
            'm.GradeLetter'    =>'F'
        );
        $query = $this->db->select('m.SubjectCode, t.SubjectTitle')
                          ->from('marks_info m')
                          ->join('total_subject t','m.SubjectCode=t.SubjectCode','left')
                          ->where($array)
                          ->get();
        if($query->num_rows() > 0){
            $result = $query->result();
            return($result);
        }else{
            return(FALSE);
        }
    }
    function GetSubjectStatus($year, $semister, $stdId){
        $array = array(
            'StudentId'        =>$stdId,
            'SubjectOfYear'    =>$year,
            'SubjectOfSemister'=>$semister,
            'Status'           =>'registered',
            'GradeLetter !='   =>'' 
        );
        $query = $this->db->from('marks_info')
                          ->where($array)
                          ->get();
        if($query->num_rows() > 0){
            return(TRUE);
        }else{
            return(FALSE);
        }
    }
    function GetInfoToCreatePDFwhen1st2nd($year, $semister, $stdId){
        //GL= GradeLetter, OGP=ObtainGradePoint
        //start gatting pdf info
        $array = array(
            'm.StudentId'        => $stdId,
            'm.SubjectOfYear'    => $year,
            'm.SubjectOfSemister'=> $semister
        );
        $result = $this->db->select('m.SubjectCode, t.SubjectTitle, m.Cardit, m.GradeLetter, m.GPA')
                           ->from('marks_info m')
                           ->join('total_subject t','m.SubjectCode=t.SubjectCode','left')
                           ->where($array)
                           ->get();
        $result = $result->result();
        $data['pdfInfo'] = $result;
        //complete gatting pdf info
        
        //start gatting current and total semister cardet
        $array = array(
            'StudentId'        =>$stdId,
            'SubjectOfYear'    =>$year,
            'SubjectOfSemister'=>$semister
        );
        $query = $this->db->select_sum('Cardit')
                          ->where($array)
                          ->get('marks_info');
        $result = $query->result();
        $data['currentCredit'] = $result[0]->Cardit;
        $data['totalCredit']   = $data['currentCredit'];
        //end gatting current and total semister cardet
        
        //start gating student Name
        $query = $this->db->select('StudentName')
                          ->get_where('student_info',array('StudentId'=>$stdId));
        $result = $query->result();
        $data['stdName'] = $result[0]->StudentName;
        //End gatting student Name
        
        //start gating GPA & CGPA
        $query = $this->db->select_sum('Cardit * GPA', 'sum')
                          ->where($array)
                          ->get('marks_info');
        $result = $query->result();
        $data['GPA'] = ($result[0]->sum)/$data['currentCredit'];
        $data['CGPA'] = $data['GPA'];
        //end gating GPA & CGPA
        
        return($data);
    }
    function GetInfoToCreatePDFwhenNot1st2nd($year, $semister, $stdId){
        //GL= GradeLetter, OGP=ObtainGradePoint
        //start gatting pdf info
        $array = array(
            'm.StudentId'        => $stdId,
            'm.SubjectOfYear'    => $year,
            'm.SubjectOfSemister'=> $semister
        );
        $result = $this->db->select('m.SubjectCode, t.SubjectTitle, m.Cardit, m.GradeLetter, m.GPA')
                           ->from('marks_info m')
                           ->join('total_subject t','m.SubjectCode=t.SubjectCode','left')
                           ->where($array)
                           ->get();
        $result = $result->result();
        $data['pdfInfo'] = $result;
        //end gatting pdf info
        
        //start gatting current and total semister cardet
        $array = array(
            'StudentId'        =>$stdId,
            'SubjectOfYear'    =>$year,
            'SubjectOfSemister'=>$semister
        );
        $query = $this->db->select_sum('Cardit')
                          ->where($array)
                          ->get('marks_info');
        $result = $query->result();
        $data['currentCredit'] = $result[0]->Cardit;
        
        $array = array(
            'StudentId'      =>$stdId,
            'GradeLetter !=' =>'F'
        );
        $query = $this->db->select_sum('Cardit')
                          ->where($array)
                          ->get('marks_info');
        $result = $query->result();
        $data['totalCredit']   = $result[0]->Cardit;
        //end gatting current and total semister cardet
        
        //start gating student Name
        $query = $this->db->select('StudentName')
                          ->get_where('student_info',array('StudentId'=>$stdId));
        $result = $query->result();
        $data['stdName'] = $result[0]->StudentName;
        //End gatting student Name
        
        //start gating GPA & CGPA
        $array = array(
            'StudentId'        =>$stdId,
            'SubjectOfYear'    =>$year,
            'SubjectOfSemister'=>$semister
        );
        $query = $this->db->select_sum('Cardit * GPA', 'sum')
                          ->where($array)
                          ->get('marks_info');
        $result = $query->result();
        $data['GPA'] = ($result[0]->sum)/$data['currentCredit'];
        
        $array = array(
            'StudentId'      =>$stdId,
            'GradeLetter !=' =>'F'
        );
        $query = $this->db->select_sum('Cardit * GPA', 'sum')
                          ->where($array)
                          ->get('marks_info');
        $result = $query->result();
        $data['CGPA'] = ($result[0]->sum)/$data['totalCredit'];;
        //end gating GPA & CGPA
        
        return($data);
    }
}
