<?php
class DataInsertRM extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function InsertStudentInformation($data){
        try {
           $this->db->insert('student_info',$data['stdInfo']);
           $this->db->insert('password',$data['password']);
           $this->db->insert('completed_semister', $data['completedSemister']);
           return TRUE;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }
    
    function InsertAdviserInformation($data){
        try {
           $this->db->insert('adviser',$data['advInfo']);
           $this->db->insert('password',$data['password']);
           return TRUE;
        } catch (Exception $ex) {
            return $exc->getTraceAsString();
        }   
    }
    
    function InsertDepartmentInformation($data){
        try {
           $this->db->insert('department',$data);
           return TRUE;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }
    function SavaNotice(){ 
        $data = array(
               'title' => $this->input->post('txtNotice'),
               'description' => $this->input->post('noticeBody')
            );
        $result = $this->db->insert('notice', $data);
        if($result){return TRUE;}
        else {return FALSE;}
    }
}