<?php if(!defined('BASEPATH'))exit ('No direct script acced allowed');
class Adviser extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->library('MyTemplate');
        $this->load->model('Adviser/dataViewAM');
        $this->load->model('Register/dataViewRM');
        $this->load->model('Adviser/dataUpdateAM');
        //$this->output->enable_profiler(TRUE);
    }
    function ViewAdviserInfo($msg = '',$err = 0){ //0 means no error
        $myTemplate      = new MyTemplate;
        if($this->session->userdata('name')){
            $name            = strtoupper($this->session->userdata('name'));
            $data['header']  = $myTemplate->Header();
            $data['footer']  = $myTemplate->Footer();
            if($this->session->userdata('userType') == 'Adviser')
                $data['aside']   = $myTemplate->Aside('Adviser');
            else
                $data['aside']   = $myTemplate->Aside('Teacher');
            $data['legend']  = $name.'\'S DETAILS';
            $data['message'] = $msg;
            $data['error']   = $err;
            $data['AdvTable']= $this->dataViewAM->GetAdviserDetails($this->session->userdata('id'));

            $this->load->view('Adviser/viewAdviserInfo',$data);
        }
        else{
            $error = 'You are Loged Out. Please Login.';
            redirect("login/index/$error");
        }
    }
    //start For File Upload
    function Upload(){
        $myTemplate = new MyTemplate;
        if($this->input->post('upload')){
            $imageFile = $_FILES['file'];
            $image['id']        = $this->session->userdata('id');
            $image['fileData']  = addslashes(file_get_contents($imageFile['tmp_name']));
            $image['fileSize']  = $imageFile['size'];
            $image['fileType']  = $imageFile['type'];
            $result = $this->dataUpdateAM->InsertImgIfNotExistOrUpdate('adviser_image', $image);
            if($result){
                $this->ViewAdviserInfo();
            }
            else{
                $this->ViewAdviserInfo('Error in upload Image',1);
            }
        }
        else {
            $data['header']  = $myTemplate->Header();
            $data['footer']  = $myTemplate->Footer();
            if($this->session->userdata('userType') == 'Adviser')
                $data['aside']   = $myTemplate->Aside('Adviser');
            else
                $data['aside']   = $myTemplate->Aside('Teacher');
            $data['legend']  = 'UPLOAD IMAGE';
            $data['action']  = 'adviser';
            $this->load->view('imageUpload', $data);
        }
    }
    //End For file Upload
    
    //Start code for update a Adviser info
  function UpdateAdviser($msg = '',$err = 0){
      //$this->output->enable_profiler(TRUE);
        $myTemplate = new MyTemplate;
        $data['header']  = $myTemplate->Header();
        $data['footer']  = $myTemplate->Footer();
        if($this->session->userdata('userType') == 'Adviser')
            $data['aside']   = $myTemplate->Aside('Adviser');
        else
            $data['aside']   = $myTemplate->Aside('Teacher');
        $data['nextId'] = $this->session->userdata('id');
        $data['advInfo']= $this->dataViewAM->GetaAdviserInfo($data['nextId']);
        $name = explode(' ', $data['advInfo'][0]->AdviserName, 2);
        $data['dbfirstName']= $name[0];
        $data['dblastName'] = $name[1];
        $data['legend'] = 'UPDATE INFORMATION';
        $data['message']= $msg;
        $data['error']  = $err;
        $data['action'] = 'adviser';
        $this->load->view('Register/insertAdviser',$data);
    }
    function required_dept($str){
            if ($str == 'default'){
		$this->form_validation->set_message('required_dept', 'The %s not selected');
		return FALSE;
            }
            else{return TRUE;}
     }
    function ValidedAdviserInformation(){
        $this->form_validation->set_rules('txtId', 'Adviser ID', 'trim|xss_clean');
        $this->form_validation->set_rules('txtFName', 'First Name', 'trim|required|min_length[2]|max_length[30]');
        $this->form_validation->set_rules('txtLName', 'Last Name', 'trim|required|min_length[4]|max_length[30]');
        $this->form_validation->set_rules('drpDepartmentName', 'Department name', 'trim|callback_required_dept|xss_clean');
        $this->form_validation->set_rules('txtContractNumber', 'Contract Number', 'trim|min_length[4]|max_length[18]|xss_clean');
        $this->form_validation->set_rules('txtEmail', 'Email', 'trim|required|valid_email|xss_clean');
        if($this->form_validation->run() == FALSE){
            $this->UpdateAdviser();
        }else{
           $data['advInfo'] = array(
                'AdviserName'      => $this->input->post('txtFName').' '.$this->input->post('txtLName'),
                'DepartmentId'     => $this->input->post('drpDepartmentName'),
                'ContractNumber'   => $this->input->post('txtContractNumber'),
                'Email'            => $this->input->post('txtEmail')
            );
            if($this->dataUpdateAM->UpdateAdviserInformation($data,$this->input->post('txtId'))){
                $this->UpdateAdviser('Information Successfully Updated');
            }
            else {$this->UpdateAdviser('Error insert information!',1);}
       }
  }
    //End code for update a Adviser info
  
    function ViewAllStudentUnderaAdviser(){
        $myTemplate = new MyTemplate;
        
        $data['header'] = $myTemplate->Header();
        $data['footer'] = $myTemplate->Footer();
        $data['aside']  = $myTemplate->Aside('Adviser');
        $data['legend'] = 'WELCOME';
        $data['title']  = 'All Student List';
        
        $advId = $this->session->userdata('id');
        $data['studentList'] = $this->dataViewAM->GetAllStudentUnderAadviser($advId);
        $this->load->view('Adviser/viewAllStudent', $data);
    }
    function ShowStudentDetails($stdId, $stdName, $msg = '', $error = 0){
        $myTemplate = new MyTemplate;
        $dataViewAM = new DataViewAM;
        
        $stdName = urldecode($stdName);
        $data['header']       = $myTemplate->Header();
        $data['footer']       = $myTemplate->Footer();
        $data['aside']        = $myTemplate->Aside('Adviser');
        $data['legend']       = "{$stdName}'s Registration Details";
        
        $stdRegInfo           = $dataViewAM->GetRegistrationInfo($stdId);
        $requiredSubjectArray = explode(',', $stdRegInfo[0]->RequiredSubject);
        $data['requiredSubjectDetails'] = $dataViewAM->GetRequiredSubjectDetails($requiredSubjectArray);
        
        //Subject that are ticked by student
        $data['takenSubject'] = explode(',', $stdRegInfo[0]->TakenSubject);
        $data['receiveId']    = $stdRegInfo[0]->ReceiveNo;
        $data['stdId']    = $stdId;
        $data['stdName']     = $stdName;
        $data['message'] = $msg;
        $data['error']   = $error;
        $this->load->view('Adviser/viewDetailsOfaStudent', $data); 
    }
    function AcceptOrDenyRegistration(){
        $myTemplate  = new MyTemplate;
        $dataUpdateAM= new DataUpdateAM;
        $data['header'] = $myTemplate->Header();
        $data['footer'] = $myTemplate->Footer();
        $data['aside']  = $myTemplate->Aside('Adviser');
        
        $status = isset($_POST['btnAccept'])? 'registered':'deny';
        foreach ($_POST as $key => $value) {
            if($key != 'txtReceiveNo' && $key != 'btnDeny' && $key != 'btnAccept' && $key != 'id' && $key != 'name'){
                $subject = $value.','."'{$status}'";
                $subjectArrey = explode(',', $subject);
                $dataUpdateAM->InsertSubjectIfNotExistOrUpdate($subject, $subjectArrey);
            }
        }
        $receiveNo = $this->input->post('txtReceiveNo');
        $result = $dataUpdateAM->UpdateRegistrationStatus($receiveNo, $status);
        
        $id   = $this->input->post('id');
        $name = $this->input->post('name');  
        if($result && isset($_POST['btnAccept'])){
            $msg  = $name.' Registered Successfully';
            $this->ShowStudentDetails($id, $name, $msg);
        }elseif($result && isset($_POST['btnDeny'])){
            $msg  = $name.' denied by adviser';
            $err = 1;
            $this->ShowStudentDetails($id, $name, $msg, $err);
        }
    }
    
    function EnterMarkHome($msg= '', $err= 0){// 0 means no error
        $myTemplate  = new MyTemplate;
        $data['header'] = $myTemplate->Header();
        $data['footer'] = $myTemplate->Footer();
        $data['legend'] = 'MARK INSERTION';
        if($this->session->userdata('userType') == 'Adviser')
            $data['aside']  = $myTemplate->Aside('Adviser');
        else
            $data['aside']  = $myTemplate->Aside('Teacher');
        $data['message'] = $msg;
        $data['error']   = $err;
        $this->load->view('Adviser/enterMark', $data);
    }
    function GetSubjectForEnterMark(){
        $array = array(
                    'DepartmentId'      => $this->input->post('deptId'),
                    'SubjectOfYear'     => $this->input->post('subjectYear'),
                    'SubjectOfSemister' => $this->input->post('subjectSemister')
                );
        $subjectType = ($this->input->post('subjectType') == 'theory')?1:0;
        //1 for odd subject code(theory) and 0 for even subject code(practical)
        if($this->input->post('ajax') && ($data = $this->dataViewAM->GetSubjectForEnterMark($array,$subjectType))){
            $options = array('default' => 'Select Subject');
            foreach ($data as $value) {
                $options[$value->SubjectCode] = $value->SubjectTitle;
            }
            $js = 'id = "drpSubject" class= "deptSelect grid_5"';
            $subject = form_dropdown('drpSubject', $options, 'default', $js);
            echo $subject;
        }
        else{
            $options = array('default' => 'Subject not found');
            $js = 'id = "drpSubject" class= "deptSelect"';
            echo form_dropdown('drpSubject', $options, 'default', $js);
        }
    }
    function GetStudentToGiveTheoryOthers(){
        $subjectCode = $this->input->post('subjectCode');
        $array = array(
            'SubjectCode' => $subjectCode,
            'Status'      => 'registered'
        );
        if($this->input->post('ajax')){
            if($data = $this->dataViewAM->GetStudentToGiveMark($array)){
                $table = '<table style="border:2px solid #BBBF58;">';
                $table .= "<tr><td>Student Id</td><td>CT1</td><td>CT2</td><td>CT3</td><td>CT4</td><td>CT5</td><td>Attendance</td><td>TOTAL</td></tr>";
                $i = 0;
                foreach ($data as $value) {
                   $id = $value->StudentId;
                   $ctMark = $this->dataViewAM->GetStudentCTandAttendanceMark($id, $subjectCode);
                   if($ctMark != 0){
                       $classT1    = $ctMark[0]->ClassTest_1;
                       $classT2    = $ctMark[0]->ClassTest_2;
                       $classT3    = $ctMark[0]->ClassTest_3;
                       $classT4    = $ctMark[0]->ClassTest_4;
                       $classT5    = $ctMark[0]->ClassTest_5;
                       $attendance = $ctMark[0]->Attendance;
                   }else{
                       $classT1 = $classT2 = $classT3 = $classT4 = $classT5 = $attendance= 0;
                   }
                   $stdId = form_input(array('name'=>"stdId[$i]",'value'=>$id,'readonly'=>'readonly','class'=>'grid_2 alpha'));
                   $ct1   = form_input(array('name'=>"ct1[$i]",'value'=>$classT1,'onkeyup'=>"sumOfCtAttendance($i)",'class'=>'grid_1'));
                   $ct2   = form_input(array('name'=>"ct2[$i]",'value'=>$classT2,'onkeyup'=>"sumOfCtAttendance($i)",'class'=>'grid_1'));
                   $ct3   = form_input(array('name'=>"ct3[$i]",'value'=>$classT3,'onkeyup'=>"sumOfCtAttendance($i)",'class'=>'grid_1'));
                   $ct4   = form_input(array('name'=>"ct4[$i]",'value'=>$classT4,'onkeyup'=>"sumOfCtAttendance($i)",'class'=>'grid_1'));
                   $ct5   = form_input(array('name'=>"ct5[$i]",'value'=>$classT5,'onkeyup'=>"sumOfCtAttendance($i)",'class'=>'grid_1'));
                   $att   = form_input(array('name'=>"attendance[$i]",'value'=>$attendance,'onkeyup'=>"sumOfCtAttendance($i)",'class'=>'grid_1'));
                   $total = form_input(array('name'=>"total[$i]",'readonly'=>'readonly','class'=>'grid_2 omega'));
                   $table .= "<tr><td>{$stdId}</td><td>{$ct1}</td><td>{$ct2}</td><td>{$ct3}</td><td>{$ct4}</td><td>{$ct5}</td><td>{$att}</td><td>{$total}</td></tr>";
                   $i++;
                }
                $table .= '</table>';
                echo $table;
            }else{
                $table = '<table style="border:2px solid #BBBF58;">';
                $table .= '<tr><td>No any student registered this subject</td></tr>';
                $table .= '</table>';
                echo $table;
            }
        }
    }
    function GetStudentToGiveTheoryFinal(){
        $subCode = $this->input->post('subjectCode');
        $array = array(
            'SubjectCode' => $subCode,
            'Status'      => 'registered'
        );
        if($this->input->post('ajax')){
            if($data = $this->dataViewAM->GetStudentToGiveMark($array)){
                $table = '<table style="border:2px solid #BBBF58;">';
                $table .= "<tr><td>Student Id</td><td>Mark(Final)</td><td>CT+Atten.</td><td>Total</td><td>GPA</td><td>Grade Letter</td></tr>";
                $i=0;
                foreach ($data as $value) {
                   $id          = $value->StudentId;
                   $info  = $this->dataViewAM->GetSumOfCTandAttendanceAndOthers($id, $subCode); 
                   $stdId       = form_input(array('name'=>"stdId[$i]",'value'=>$id,'readonly'=>'readonly','class'=>'grid_2 alpha'));
                   $final       = form_input(array('name'=>"final[$i]",'value'=>($info['finalExam'])?$info['finalExam']:0,'onkeyup'=>"sumOfFinalOthers($i)",'class'=>'grid_2'));
                   $ctAttend    = form_input(array('name'=>"ctAttend[$i]",'value'=>($info['bestOf4Att'])?$info['bestOf4Att']:0,'readonly'=>'readonly','class'=>'grid_1'));
                   $total       = form_input(array('name'=>"total[$i]",'value'=>($info['bestOf4Att'])?$info['bestOf4Att']:0,'readonly'=>'readonly','class'=>'grid_2'));
                   $gpa         = form_input(array('name'=>"GPA[$i]",'value'=>($info['GPA'])?$info['GPA']:0,'readonly'=>'readonly','class'=>'grid_1'));
                   $gradeLetter = form_input(array('name'=>"gradeLetter[$i]",'value'=>($info['GradeLetter'])?$info['GradeLetter']:0,'readonly'=>'readonly','class'=>'grid_2 omega'));
                   $table .= "<tr><td>{$stdId}</td><td>{$final}</td><td>{$ctAttend}</td><td>{$total}</td><td>{$gpa}</td><td>{$gradeLetter}</td></tr>";
                   $i++;
                }
                $table .= '</table>';
                echo $table;
            }else{
                $table = '<table style="border:2px solid #BBBF58;">';
                $table .= '<tr><td>No any student registered this subject</td></tr>';
                $table .= '</table>';
                echo $table;
            }
        }
    }
    function GetStudentToGiveSessionalLabAss(){
        $subCode = $this->input->post('subjectCode');
        $array = array(
            'SubjectCode' => $subCode,
            'Status'      => 'registered'
        );
        if($this->input->post('ajax')){
            if($data = $this->dataViewAM->GetStudentToGiveMark($array)){
                $table = '<table style="border:2px solid #BBBF58;">';
                $table .= "<tr><td>Student Id</td><td>Assesment_1</td><td>Assesment_2</td><td>Assesment_3</td><td>Assesment_4</td></tr>";
                $i=0;
                foreach ($data as $value) {
                   $id          = $value->StudentId;
                   $labAsses    = $this->dataViewAM->GetStudentLabAssesmentMark($id, $subCode);
                   $stdId       = form_input(array('name'=>"stdId[$i]",'value'=>$id,'readonly'=>'readonly','class'=>'grid_2 alpha'));
                   $assesment_1 = form_input(array('name'=>"assesment_1[$i]",'value'=>($labAsses['Assesment_1'])?$labAsses['Assesment_1']:0,'class'=>'grid_2'));
                   $assesment_2 = form_input(array('name'=>"assesment_2[$i]",'value'=>($labAsses['Assesment_2'])?$labAsses['Assesment_2']:0,'class'=>'grid_2'));
                   $assesment_3 = form_input(array('name'=>"assesment_3[$i]",'value'=>($labAsses['Assesment_3'])?$labAsses['Assesment_3']:0,'class'=>'grid_2'));
                   $assesment_4 = form_input(array('name'=>"assesment_4[$i]",'value'=>($labAsses['Assesment_4'])?$labAsses['Assesment_4']:0,'class'=>'grid_2 omega'));
                   $table .= "<tr><td>{$stdId}</td><td>{$assesment_1}</td><td>{$assesment_2}</td><td>{$assesment_3}</td><td>{$assesment_4}</td></tr>";
                   $i++;
                }
                $table .= '</table>';
                echo $table;
            }else{
                $table = '<table style="border:2px solid #BBBF58;">';
                $table .= '<tr><td>No any student registered this subject</td></tr>';
                $table .= '</table>';
                echo $table;
            }
        }
    }
    function GetStudentToGiveSessionalQA(){
        $subCode = $this->input->post('subjectCode');
        $array = array(
            'SubjectCode' => $subCode,
            'Status'      => 'registered'
        );
        if($this->input->post('ajax')){
            if($data = $this->dataViewAM->GetStudentToGiveMark($array)){
                $table = '<table style="border:2px solid #BBBF58;">';
                $table .= "<tr><td>Student Id</td><td>Quize</td><td>Attendance</td><td>Contineous Evaluation</td><td>Total(Quize+Att.+CE)</td><td>GPA</td><td>Grade Letter</td></tr>";
                $i=0;
                foreach ($data as $value) {
                   $id          = $value->StudentId; 
                   $data        = $this->dataViewAM->GetSumOfCEAndAttFinalGPA($id,$subCode);
                   $stdId       = form_input(array('name'=>"stdId[$i]",'value'=>$id,'readonly'=>'readonly','class'=>'grid_2 alpha'));
                   $quize       = form_input(array('name'=>"quize[$i]",'value'=>($data['quize'])?$data['quize']:0,'onkeyup'=>"sumOfCAQuizeAttendance($i)",'class'=>'grid_1'));
                   $attendance  = form_input(array('name'=>"attendance[$i]",'value'=>($data['attendance'])?$data['attendance']:0,'onkeyup'=>"sumOfCAQuizeAttendance($i)",'class'=>'grid_1'));
                   $contEva     = form_input(array('name'=>"contEva[$i]",'readonly'=>'readonly','value'=>($data['contEva'])?$data['contEva']:0,'class'=>'grid_2'));
                   $total       = form_input(array('name'=>"total[$i]",'readonly'=>'readonly','class'=>'grid_2'));
                   $gpa         = form_input(array('name'=>"gpa[$i]",'readonly'=>'readonly','value'=>($data['gpa'])?$data['gpa']:0,'class'=>'grid_1'));
                   $gradeLetter = form_input(array('name'=>"gradeLetter[$i]",'value'=>($data['gradeLetter'])?$data['gradeLetter']:0,'readonly'=>'readonly','class'=>'grid_1 omega'));
                   $table .= "<tr><td>{$stdId}</td><td>{$quize}</td><td>{$attendance}</td><td>{$contEva}</td><td>{$total}</td><td>{$gpa}</td><td>{$gradeLetter}</td></tr>";
                   $i++;
                }
                $table .= '</table>';
                echo $table;
            }else{
                $table = '<table style="border:2px solid #BBBF58;">';
                $table .= '<tr><td>No any student registered this subject</td></tr>';
                $table .= '</table>';
                echo $table;
            }
        }
    }
    function InsertStudentMark(){
        //$this->output->enable_profiler(TRUE);
        $dataUpdateAM = new DataUpdateAM;
        
        $subjectCode = $this->input->post('drpSubject');
        $subjectType = $this->input->post('rdoSubjectType');
        $examType    = $this->input->post('rdoExamType');
        
        if($subjectType == 'theory'){
            if($examType == 'others'){
                foreach ($_POST['stdId'] as $key => $value) {
                    $data = "'{$value}','{$subjectCode}',{$_POST['ct1'][$key]},{$_POST['ct2'][$key]},
                            {$_POST['ct3'][$key]},{$_POST['ct4'][$key]},{$_POST['ct5'][$key]},
                            {$_POST['attendance'][$key]}";
                    $dataArray = explode(',', $data);
                    $dataUpdateAM->InsertOrUpdateTheoryOthers($data, $dataArray);
                }
                $this->EnterMarkHome('Successfully inserted data', 0);
            }else{
                foreach ($_POST['stdId'] as $key => $value) {
                    $data = "'{$value}','{$subjectCode}',{$_POST['final'][$key]},{$_POST['GPA'][$key]},'{$_POST['gradeLetter'][$key]}'";
                    $dataArray = explode(',', $data);
                    $dataUpdateAM->InsertOrUpdateTheoryFinalExam($data, $dataArray);
                }
                $this->EnterMarkHome('Successfully inserted data', 0);
            }
        }else{
            if($examType == 'labAssessment'){
                foreach ($_POST['stdId'] as $key => $value) {
                    $data = "'{$value}','{$subjectCode}',{$_POST['assesment_1'][$key]},{$_POST['assesment_2'][$key]},
                            {$_POST['assesment_3'][$key]},{$_POST['assesment_4'][$key]}";
                    $dataArray = explode(',', $data);
                    $dataUpdateAM->InsertOrUpdateSessionalLabAssesment($data, $dataArray);
                }
                $this->EnterMarkHome('Successfully inserted data', 0);
            }else {
                foreach ($_POST['stdId'] as $key => $value) {
                    $data = "'{$value}','{$subjectCode}',{$_POST['quize'][$key]},{$_POST['attendance'][$key]},
                            {$_POST['gpa'][$key]},'{$_POST['gradeLetter'][$key]}'";
                    $dataArray = explode(',', $data);
                    $dataUpdateAM->InsertOrUpdateSessionalQuizeAttendance($data, $dataArray);
                }
                $this->EnterMarkHome('Successfully inserted data', 0);
            }
        } 
    }
}
