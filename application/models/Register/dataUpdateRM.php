<?php
class DataUpdateRM extends CI_Model{
    function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
    }
    private $countQuery = 0;
    function SelectAdviser($data){
        if($data['start'] && $data['end']){
            $this->db->set('AdviserId', $data['adviserId'])
                    ->where('DepartmentId', $data['deptId'])
                    ->where("StudentId between {$data['start']} and {$data['end']}")
                    ->update('student_info');
            $this->countQuery++;
        }
        if($data['extraStudent'][0]){
            $this->db->set('AdviserId', $data['adviserId'])
                     ->where('DepartmentId', $data['deptId'])
                     ->where_in('StudentId',$data['extraStudent'])
                     ->update('student_info');
             $this->countQuery++;
        }
        if($this->countQuery){return TRUE;}else{return FALSE;}
    }
    function TruncateRegInfo($tableName){
        if($this->db->empty_table($tableName)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}