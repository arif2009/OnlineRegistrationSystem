<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');
class DataInsertSM extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function InsertRegistrationInfo($data){
        try {
            $this->db->insert('registration_info', $data);
            return TRUE;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }   
    }  
}