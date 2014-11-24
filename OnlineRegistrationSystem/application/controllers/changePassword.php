<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class ChangePassword extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('changePasswordM');
        $this->load->library('MyTemplate');
    }
  
  function ChangePassword($msg='',$err = 0){
      $myTemplate = new MyTemplate;
      if(!($userType = $this->session->userdata('userType'))){
          $error = 'You are loged out. Please Login';
          redirect("login/index/{$error}");
      }else{
          $data['header']  = $myTemplate->Header();
          $data['footer']  = $myTemplate->Footer();
          $data['aside']   = $myTemplate->Aside($userType);

          $data['legend']  = 'CHANGE PASSWORD';
          $data['message'] = $msg;
          $data['error']   = $err;
          $this->load->view('changePasswordV',$data);
      }
  }
  
  function ValidedPasswordInformation(){
        $this->form_validation->set_rules('txtCurrentPassword', 'Current Password', 'trim|required|min_length[6]|max_length[10]|xss_clean');
        $this->form_validation->set_rules('txtNewPassword', 'New Password', 'trim|required|min_length[6]|max_length[10]|matches[txtConfirmPassword]|xss_clean');
        $this->form_validation->set_rules('txtConfirmPassword', 'Confirm Password', 'trim|required|min_length[6]|max_length[10]|xss_clean');
        if($this->form_validation->run() == FALSE){
            $this->ChangePassword();
        }
        else if($this->session->userdata('password') == $this->input->post('txtCurrentPassword')){
            //change password
            if($this->changePasswordM->ChangePassword()){
                $this->ChangePassword('Password Changed Successfully',0);
            }
            else{
                $this->ChangePassword('Error when changing Password',1);
            }
       }
       else{
           $this->ChangePassword('Password not exist in database.',1);
       }
  }
}
