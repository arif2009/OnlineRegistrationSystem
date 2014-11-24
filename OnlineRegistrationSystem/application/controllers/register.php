<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Register extends CI_Controller{
    
    private $userType;
    
    function __construct() {
        parent::__construct();
        $this->load->model('Register/dataViewRM');
        $this->load->model('Register/dataInsertRM');
        $this->load->model('Register/dataUpdateRM');
        $this->load->model('Student/dataUpdateSM');
        $this->userType = $this->session->userdata('userType');
        //$this->output->enable_profiler(TRUE);
    }
    
    //Start code for insert & update a Student info
    // 0 for no error 1 for error
    function InsertStudent($msg = '',$err = 0){
        $this->load->library('MyTemplate');
        $myTemplate = new MyTemplate;
        $data['header']  = $myTemplate->Header();
        $data['footer']  = $myTemplate->Footer();
        if($this->userType == 'Student'){
            $data['aside']    = $myTemplate->Aside('Student');
            $data['legend']   = 'UPDATE INFORMATION';
        }
        else if($this->userType == 'Register'){
            $data['aside']   = $myTemplate->Aside();
            $data['legend']  = 'INSERT STUDENT INFORMATION';
        }
        $data['message'] = $msg;
        $data['error']   = $err;
        $this->load->view('Register/insertStudent',$data);
    }
    
     function required_dept($str){
            if ($str == 'default'){
		$this->form_validation->set_message('required_dept', 'The %s not selected');
		return FALSE;
            }
            else{return TRUE;}
     }
     
     function ValidedStudentInformation(){
        $this->form_validation->set_rules('txtId', 'Student ID', 'trim|required|min_length[6]|max_length[6]|is_natural|xss_clean');
        $this->form_validation->set_rules('txtFName', 'First Name', 'trim|required|min_length[2]|max_length[30]');
        $this->form_validation->set_rules('txtLName', 'Last Name', 'trim|required|min_length[4]|max_length[30]');
        $this->form_validation->set_rules('txtFathersName', 'Father\'s Name', 'trim|required|min_length[4]|max_length[60]|xss_clean');
        $this->form_validation->set_rules('txtMothersName', 'Mother\'s Name', 'trim|required|min_length[4]|max_length[60]|xss_clean');
        $this->form_validation->set_rules('txtPresentAddress', 'Present Address', 'trim|xss_clean');
        $this->form_validation->set_rules('txtPermanentAddress', 'Permanent Address', 'trim|xss_clean');
        $this->form_validation->set_rules('txtEmail', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('txtContractNumber', 'Contract Number', 'trim|required|min_length[4]|max_length[18]|xss_clean');
        $this->form_validation->set_rules('drpDepartmentName', 'Department name', 'trim|callback_required_dept|xss_clean');
        if($this->userType != 'Student'){
            $this->form_validation->set_rules('datePicler', 'Admit Date', 'trim|required|xss_clean');
        }
        if($this->form_validation->run() == FALSE){
            $this->InsertStudent();
        }
        else if(($this->userType == 'Register') && ($data = $this->dataViewRM->CheckEmailId($this->input->post('txtEmail'), $this->input->post('txtId'), 'student_info'))){
            if(($data[0]['StudentId'] == $this->input->post('txtId')) && ($data[0]['Email'] == $this->input->post('txtEmail'))){
                $this->InsertStudent('Email and Id already exist',1);
            }
            else if($data[0]['StudentId'] == $this->input->post('txtId')){
                $this->InsertStudent('Id already exist',1);
            }
            else if($data[0]['Email'] == $this->input->post('txtEmail')){
                $this->InsertStudent('Email already exist',1);
            }
       }
       else{
           if($this->userType == 'Register'){
                $stdId = $this->input->post('txtId');
                $data['stdInfo'] = array(
                        'StudentId'        => $stdId,
                        'StudentName'      => $this->input->post('txtFName').' '.$this->input->post('txtLName'),
                        'FathersName'      => $this->input->post('txtFathersName'),
                        'MothersName'      => $this->input->post('txtMothersName'),
                        'PresentAddress'   => $this->input->post('txtPresentAddress'),
                        'ParmanentAddress' => $this->input->post('txtPermanentAddress'),
                        'Email'            => $this->input->post('txtEmail'),
                        'ContractNumber'   => $this->input->post('txtContractNumber'),
                        'DepartmentId'     => $this->input->post('drpDepartmentName'),
                        'Sex'              => $this->input->post('drpSex'),
                        'AdmitDate'        => $this->input->post('datePicler')
                    );
                $data['password'] = array(
                        'Id' => $stdId,
                        'Password' => $this->encrypt->encode(random_string('alnum', 6))
                );
                $data['completedSemister'] = array(
                        'StudentId'     => $stdId,
                        'FirstYsecondS' => 'uncomplete',
                        'SecondYfirstS' => 'uncomplete',
                        'SecondYsecondS'=> 'uncomplete',
                        'ThirdYfirstS'  => 'uncomplete',
                        'ThirdYsecondS' => 'uncomplete',
                        'FourthYfirstS' => 'uncomplete',
                        'FourthYsecondS'=> 'uncomplete'
                );
                if($this->dataInsertRM->InsertStudentInformation($data)){
                    $this->InsertStudent('Information Successfully Added');
                }
                else {$this->InsertStudent('Error insert information!',1);}
           }
           elseif($this->userType == 'Student'){
               $data = array(
                        'StudentName'      => $this->input->post('txtFName').' '.$this->input->post('txtLName'),
                        'FathersName'      => $this->input->post('txtFathersName'),
                        'MothersName'      => $this->input->post('txtMothersName'),
                        'PresentAddress'   => $this->input->post('txtPresentAddress'),
                        'ParmanentAddress' => $this->input->post('txtPermanentAddress'),
                        'Email'            => $this->input->post('txtEmail'),
                        'ContractNumber'   => $this->input->post('txtContractNumber'),
                        'DepartmentId'     => $this->input->post('drpDepartmentName'),
                        'Sex'              => $this->input->post('drpSex')
                    );
                if($this->dataUpdateSM->UpdateStudentInfo($data, $this->input->post('txtId'))){
                    $this->InsertStudent('Information Successfully Updated');
                }
                else {$this->InsertStudent('Error When update information!',1);}
           }
       }
  }
  //End code for insert & update a Student info
  
  //Start code for insert a Adviser
  function InsertAdviser($msg = '',$err = 0){
        $this->load->library('MyTemplate');
        $myTemplate = new MyTemplate;
        $data['header']  = $myTemplate->Header();
        $data['footer']  = $myTemplate->Footer();
        $data['aside']   = $myTemplate->Aside();
        $data['nextId']  = $this->dataViewRM->GenerateId();       
        $data['legend']  = 'INSERT ADVISER INFORMATION';
        $data['message'] = $msg;
        $data['error']   = $err;
        $data['action']  = 'register';
        $this->load->view('Register/insertAdviser',$data);
    }
    
    function ValidedAdviserInformation(){
        $this->form_validation->set_rules('txtId', 'Adviser ID', 'trim|xss_clean');
        $this->form_validation->set_rules('txtFName', 'First Name', 'trim|required|min_length[2]|max_length[30]');
        $this->form_validation->set_rules('txtLName', 'Last Name', 'trim|required|min_length[4]|max_length[30]');
        $this->form_validation->set_rules('drpDepartmentName', 'Department name', 'trim|callback_required_dept|xss_clean');
        $this->form_validation->set_rules('txtContractNumber', 'Contract Number', 'trim|min_length[4]|max_length[18]|xss_clean');
        $this->form_validation->set_rules('txtEmail', 'Email', 'trim|required|valid_email|xss_clean');
        if($this->form_validation->run() == FALSE){
            $this->InsertAdviser();
        }
        else if($data = $this->dataViewRM->CheckEmailId($this->input->post('txtEmail'), $this->input->post('txtId'), 'adviser')){
            if(($data[0]['AdviserId'] == $this->input->post('txtId')) && ($data[0]['Email'] == $this->input->post('txtEmail'))){
                $this->InsertAdviser('Email and Id already exist',1);
            }
            else if($data[0]['AdviserId'] == $this->input->post('txtId')){
                $this->InsertAdviser('Id already exist',1);
            }
            else if($data[0]['Email'] == $this->input->post('txtEmail')){
                $this->InsertAdviser('Email already exist',1);
            }
       }
       else{
           $data['advInfo'] = array(
                'AdviserId'        => $this->input->post('txtId'),
                'AdviserName'      => $this->input->post('txtFName').' '.$this->input->post('txtLName'),
                'DepartmentId'     => $this->input->post('drpDepartmentName'),
                'ContractNumber'   => $this->input->post('txtContractNumber'),
                'Email'            => $this->input->post('txtEmail')
            );
           $data['password'] = array(
                'Id' => $this->input->post('txtId'),
                'Password' => $this->encrypt->encode(random_string('alnum', 6))
           );
            if($this->dataInsertRM->InsertAdviserInformation($data)){
                $this->InsertAdviser('Information Successfully Added');
            }
            else {$this->InsertAdviser('Error insert information!',1);}
       }
  }
    //End code for insert a Adviser
    
   //Start code for insert a New Department
  function InsertDepartment($msg = '',$err = 0){
        $this->load->library('MyTemplate');
        $myTemplate = new MyTemplate;
        $data['header']  = $myTemplate->Header();
        $data['footer']  = $myTemplate->Footer();
        $data['aside']   = $myTemplate->Aside();
        $data['legend']  = 'INSERT A NEW DEPARTMENT';
        $data['message'] = $msg;
        $data['error'] = $err;
        $this->load->view('Register/insertDepartment',$data);
    }
    
    function required_faculty($str){
            if ($str == 'default'){
		$this->form_validation->set_message('required_faculty', 'The %s not selected');
		return FALSE;
            }
            else{return TRUE;}
     }
     
     function required_deptType($str){
            if ($str == 'default'){
		$this->form_validation->set_message('required_deptType', 'The %s not selected');
		return FALSE;
            }
            else{return TRUE;}
     }
    
    function ValidedDepartmentInformation(){
        $this->form_validation->set_rules('txtId', 'Department ID', 'trim|required|min_length[3]|max_length[5]|xss_clean');
        $this->form_validation->set_rules('txtName', 'Department Name', 'trim|required|min_length[4]|max_length[35]');
        $this->form_validation->set_rules('drpFacultyName', 'Faculty name', 'trim|callback_required_faculty|xss_clean');
        $this->form_validation->set_rules('isDegreeAward', 'Department Type', 'trim|callback_required_deptType|xss_clean');
        if($this->form_validation->run() == FALSE){
            $this->InsertDepartment();
        }
        else if($this->dataViewRM->CheckDepartmentId($this->input->post('txtId'))){
                $this->InsertDepartment('Department ID already exist',1);
       }
       else{
           $data = array(
                'DepartmentId'      => $this->input->post('txtId'),
                'DepartmentName'    => $this->input->post('txtName'),
                'FacultyId'         => $this->input->post('drpFacultyName'),
                'DegreeAward'       => $this->input->post('isDegreeAward')
            );
            if($this->dataInsertRM->InsertDepartmentInformation($data)){
                $this->InsertDepartment('Information Successfully Added');
            }
            else {$this->InsertDepartment('Error insert information!',1);}
       }
  }
   //End code for insert a New Department
  
  //Adviser selection Section start
  function AdviserSelection($msg='',$err = 0){
      $this->load->library('MyTemplate');
      $myTemplate = new MyTemplate;
      $data['header'] = $myTemplate->Header();
      $data['footer'] = $myTemplate->Footer();
      $data['aside'] = $myTemplate->Aside('Register');
                    
      $data['legend'] = 'ADVISER SELECTION';
      $data['message'] = $msg;
      $data['error'] = $err;
      $this->load->view('Register/adviserSelection',$data);
  }
  function SelectAdviser(){
      $data['deptId'] = $this->input->post('optdept');
      $data['adviserId'] = $this->input->post('optAdviser');
      $data['start'] = $this->input->post('txtstart');
      $data['end'] = $this->input->post('txtend');
      $data['extraStudent'] = explode(",",$this->input->post('txtextra'));
      $result = $this->dataUpdateRM->SelectAdviser($data);
      if($result){
          $this->AdviserSelection('Adviser Successfully Selected');
      }
  }
  function GetAllAdviser() {
            $deptId = $this->input->post('deptId');
            if ($this->input->post('ajax')) {
                $adviserTable = $this->dataViewRM->GetAdviserInADepartment($deptId);
                $options = array('default'  => 'Select Adviser');
                foreach ($adviserTable as $row) {
                $options[$row->AdviserId] = $row->AdviserName;
                }
            $js = 'id="optAdviser" tabindex = "3"';
            $optAdviser = form_dropdown('optAdviser', $options, 'default',$js);
            echo $optAdviser;
            } else {
		echo "Error in adviser selection";
            }
  }
  //Adviser selection Section End
  
  
  //Adviser Id and Password start
  function DownloadAdviserIdPassword(){
      $this->load->library('MyTemplate');
      $myTemplate = new MyTemplate;
      $data['header'] = $myTemplate->Header();
      $data['footer'] = $myTemplate->Footer();
      $data['aside']  = $myTemplate->Aside('Register');
                    
      $data['legend'] = 'DOWNLOAD ADVISER ID AND PASSWORD';
      $data['type'] = 'adviser';
      $this->load->view('Register/downloadIdPassword',$data);
  }
  //Adviser Id and Password End
  
  //Student Id and Password start
  function DownloadStudentIdPassword(){
      $this->load->library('MyTemplate');
      $myTemplate = new MyTemplate;
      $data['header'] = $myTemplate->Header();
      $data['footer'] = $myTemplate->Footer();
      $data['aside']  = $myTemplate->Aside('Register');
      
      $data['legend'] = 'DOWNLOAD STUDENT ID AND PASSWORD';
      $data['type'] = 'student';
      $this->load->view('Register/downloadIdPassword',$data);
  }
  //Student Id and Password End
  
  //For notice start
  function Notice($go = 'Register/notice'){
      $this->load->library('MyTemplate');
      $myTemplate = new MyTemplate;
      $data['header'] = $myTemplate->Header();
      $data['footer'] = $myTemplate->Footer();
      $data['aside']  = $myTemplate->Aside('Register');
      
      $data['legend'] = 'NOTICE BOARD';
      $data['notice'] = $this->dataViewRM->RetrieveTitleNotice();
      $this->load->view($go, $data);
  }
  function NoticeValidation(){
      $this->form_validation->set_rules('txtNotice','Title','trim|required');
      $this->form_validation->set_rules('noticeBody','Notice','trim|required');
      if($this->form_validation->run()==FALSE){
          $this->Notice();
      }
      else{
          if($this->input->post('btnSave')){
              if($this->dataInsertRM->SavaNotice()){
                  $this->Notice('Student/welcomeSV');
              }
           }
      }
  }
  //For notice end
  
  function GiveRegPermission(){
      $dataUpdateRM = new DataUpdateRM;
      $result = $dataUpdateRM->TruncateRegInfo('registration_info');
      if($result){
          $this->load->library('MyTemplate');
          $myTemplate = new MyTemplate;
          $data['header'] = $myTemplate->Header();
          $data['footer'] = $myTemplate->Footer();
          $data['aside']  = $myTemplate->Aside('Register');

          $data['legend'] = 'REGISTRATION';
          $data['notice'] = 'Authority Permit For Registration.';
          $this->load->view('Register/notice', $data);
      }
  }
}
