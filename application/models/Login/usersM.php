<?php
class UsersM extends CI_Model{
    
    function GetNameDeptById($attribute1, $attribute2, $tableName, $condition, $id){
        $query = $this->db->select("{$attribute1},{$attribute2}")
                          ->get_where($tableName, array($condition =>$id));
        $result = $query->result();
        return($result);
    }
    
    function Validity() {
        $query = $this->db->where('Id', $this->input->post('userId'))
                          ->get('password');
        if($query->num_rows() > 0){
            $row = $query->result();
            $dbPassword = $this->encrypt->decode($row[0]->Password);
        }else {
            return FALSE;
        }
        
        $givenPassword = $this->input->post('password');
        if($dbPassword == $givenPassword){
            $id = $row[0]->Id;
            $firstChar = substr($id, 0, 1);
            if($firstChar == 'A'){
                $userType = 'Adviser';
                $result   = $this->GetNameDeptById('AdviserName', 'DepartmentId', 'adviser', 'AdviserId', $id);
                $name     = $result[0]->AdviserName;
                $dept     = $result[0]->DepartmentId;
            }
            else if($firstChar == 'R'){
                $userType = 'Register';
                $name     = $userType;
                $dept     = 'All';
            }
            else {
                $userType = 'Student';
                $result   = $this->GetNameDeptById('StudentName', 'DepartmentId', 'student_info', 'StudentId', $id);
                $name     = $result[0]->StudentName;
                $dept     = $result[0]->DepartmentId;
            }
            $sessionData = array('id'         => $id,
                                 'name'       => $name,
                                 'deptId'     => $dept,
                                 'userType'   => $userType,
                                 'password'   => $givenPassword,
                                 'isLoggedIn' => TRUE);
            $this->session->set_userdata($sessionData);
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
}
?>
