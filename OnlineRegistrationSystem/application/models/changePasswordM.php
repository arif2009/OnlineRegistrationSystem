<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');
class ChangePasswordM extends CI_Model{
    function ChangePassword(){
        $userId = $this->session->userdata('id');
        $newPassword = $this->encrypt->encode($this->input->post('txtNewPassword'));
        $result = $this->db->set('Password', $newPassword)
                       ->where('Id', $userId)
                       ->update('password');
        if($result){return TRUE;}
        else {return FALSE;}  
    }
}

