<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Student extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('Student/dataViewSM');
        $this->load->model('Student/dataInsertSM');
        $this->load->model('Student/dataUpdateSM');
        $this->load->model('Register/dataViewRM');
        $this->load->library(array('MyTemplate', 'upload'));
        //$this->output->enable_profiler(TRUE);
    }
    
    function ViewStudentInfo($msg = '',$err = 0){ //0 means no error
        $myTemplate      = new MyTemplate;
        if($this->session->userdata('name')){
            $name            = strtoupper($this->session->userdata('name'));
            $data['header']  = $myTemplate->Header();
            $data['footer']  = $myTemplate->Footer();
            $data['aside']   = $myTemplate->Aside('Student');
            $data['legend']  = $name.'\'S DETAILS';
            $data['message'] = $msg;
            $data['error']   = $err;
            $data['stdTable']= $this->dataViewSM->GetaStudentDetails($this->session->userdata('id'));

            $this->load->view('Student/viewStudentInfo',$data);
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
            $result = $this->dataUpdateSM->InsertImgIfNotExistOrUpdate('student_image', $image);
            if($result){
                $this->ViewStudentInfo();
            }
            else{
                $this->ViewStudentInfo('Error in upload Image',1);
            }
        }
        else {
            $data['header'] = $myTemplate->Header();
            $data['footer'] = $myTemplate->Footer();
            $data['aside']  = $myTemplate->Aside('Student');
            $data['legend'] = 'UPLOAD IMAGE';
            $data['action'] = 'student';
            $this->load->view('imageUpload', $data);
        }
    }
    //End For file Upload
    function UpdateStudentInfo(){
        if($this->session->userdata('id')){
            $myTemplate = new MyTemplate;
            $id = $this->session->userdata('id');
            $data['stdInfo']  = $this->dataViewSM->GetaStudentInfo($id);
            $name = explode(' ', $data['stdInfo'][0]->StudentName, 2);
            $data['dbfirstName']= $name[0];
            $data['dblastName'] = $name[1];
            $data['header']   = $myTemplate->Header();
            $data['footer']   = $myTemplate->Footer();
            $data['aside']    = $myTemplate->Aside('Student');
            $data['legend']   = 'UPDATE INFORMATION';
            $this->load->view('Register/insertStudent',$data);
        }
        else{
            $error = 'You are Loged Out. Please Login.';
            redirect("login/index/$error");
        }
    }
    function ShowAdviserInfoForStudent(){
        $myTemplate = new MyTemplate;
        $stdId = $this->session->userdata('id');
        if($stdId){
            $data['adviserInfo'] = $this->dataViewSM->GetAdviserInfoToShowStudent($stdId);
            $data['header']   = $myTemplate->Header();
            $data['footer']   = $myTemplate->Footer();
            $data['aside']    = $myTemplate->Aside('Student');
            $data['legend']   = 'ADVISER INFORMATION';
            $this->load->view('Student/viewAdviserInfo',$data);
        }
        else{
            $error = 'You are loged out. Please Login.';
            redirect("login/index/{$error}");
        }
    }
    //Start coding For course registration
    function CourseRegistration(){
        if($id = $this->session->userdata('id')){
            $myTemplate = new MyTemplate;
            $data['header']   = $myTemplate->Header();
            $data['footer']   = $myTemplate->Footer();
            $data['aside']    = $myTemplate->Aside('Student');
            
            $status = $this->dataViewSM->GetRegistrationStatus($id);
            if($status == 'requested'){
                $data['legend']  = 'ERROR';
                $data['color']   = 'red';
                $data['message'] = 'You already request for registration, Still waiting For Adviser Approval.';
                $this->load->view('Student/approveMessage', $data);
            }
            elseif($status == 'registered'){
                $data['legend']  = 'CONGRATULATION';
                $data['color']   = 'blue'; 
                $data['message'] = 'You registration successfully complete.';
                $this->load->view('Student/approveMessage', $data);
            }
            elseif($status == 'deny'){
                $data['legend'] = 'UNSUCCESSFUL';
                $data['color']  = 'red';
                $data['message'] = 'Your registration unsuccessful, Contract your adviser.';
                $this->load->view('Student/approveMessage', $data);
            }
            else{
                $data['legend']   = 'COURCE REGISTRATION';
                $data['stdId']    = $id;

                //Searching for Failed subject
                $failedSubject = $this->dataViewSM->GetFailedSubject($id);


                //Searching uncompleted semister
                //$uncompleteYS means uncompleted Year Semister
                //$uncompleteDYS means uncompleted DepartmentId Year Semister
                $uncompleteYS = $this->dataViewSM->GetFirstUncompleteSemister($id);
                if($uncompleteYS){
                    //False means there are no uncompleted semister.
                    //else get first uncomplete Semister.
                    $uncompleteYS['DepartmentId'] = $this->session->userdata('deptId'); //Adding Department in $uncompleteYS array
                    $uncompleteDYS                = $uncompleteYS;
                    $newSemisterSubject           = $this->dataViewSM->GetNewSemisterSubject($uncompleteDYS);   
                }


                //Merge failedSubject subject and newSemisterSubject array.
                if($failedSubject && $uncompleteYS){
                    $data['requiredSubject'] = array_merge($failedSubject, $newSemisterSubject);
                }
                elseif ($uncompleteYS) {
                    $data['requiredSubject'] = $newSemisterSubject;    
                }
                elseif ($failedSubject) {
                    $data['requiredSubject'] = $failedSubject;
                }
                $this->load->view('Student/courseRegistration',$data);
            }
        }
        else{
             $error = 'You are Loged Out. Please Login';
             redirect("login/index/{$error}");
        }
    }
    
    //When press submit Button
    function ApplyForRegistration(){
        $myTemplate = new MyTemplate;
        $data['header'] = $myTemplate->Header();
        $data['footer'] = $myTemplate->Footer();
        $data['aside']  = $myTemplate->Aside('Student');
        $stdId          = $this->session->userdata('id');
        
            //Insert all data that are selected by a student into mark_info table
            //and Make an array that subject are checked by a student
            foreach ($_POST as $key => $value) {
                if($key != 'txtReceiveNo' && $key != 'btnSubmit' && $key != 'totalSubject'){
                    $checkedSubjectArray[] = $key; //Making array

                    //Data insert
                    $value      = $this->input->post($key);
                    $valueArray = explode(',', $value);
                    $this->dataUpdateSM->InsertSubjectIfNotExistOrUpdate($value, $valueArray);
                    
                    //It replace all time, but exist only last subject year/semister
                    $lastYearSemister = substr($valueArray[2], 1,3).'/'.substr($valueArray[3], 1,3);
                }
            }

            //Data insert in registration_info table
            $checkedSubject = implode(',', $checkedSubjectArray);
            $totalSubject   = $this->input->post('totalSubject'); 

            $reginfo['StudentId']          = $stdId;
            $reginfo['AdviserId']          = $this->dataViewSM->GetAdviserIdByStudentId($stdId);
            $reginfo['RegistrationStatus'] = 'requested';
            $reginfo['ReceiveNo']          = $this->input->post('txtReceiveNo');
            $reginfo['RequiredSubject']    = $totalSubject;
            $reginfo['TakenSubject']       = $checkedSubject;
            $reginfo['YearSemister']       = $lastYearSemister;
            $result = $this->dataInsertSM->InsertRegistrationInfo($reginfo);
            if($result == TRUE){
                $data['legend']  = 'Success Request';
                $data['color']   = 'blue';
                $data['message'] = 'Your request is successfully Approved. Waiting For Adviser Approval.';
                $this->load->view('Student/approveMessage', $data);
            }
            else{
                echo $result;die();
            }
    }
    //End Coding For course registration
    
    //Start Coding For Download Result
    function SuccessOrUnsuccessMessage($legend,$color,$msg){
        $myTemplate = new MyTemplate;
        $data['header'] = $myTemplate->Header();
        $data['footer'] = $myTemplate->Footer();
        $data['aside']  = $myTemplate->Aside('Student');
        $data['legend']  = $legend;
        $data['color']   = $color;
        $data['message'] = $msg;
        $this->load->view('Student/approveMessage', $data);
    }
     
    function DownloadCriteria(){
        $myTemplare = new MyTemplate;
        $data['header'] = $myTemplare->Header();
        $data['footer'] = $myTemplare->Footer();
        $data['aside']  = $myTemplare->Aside('Student');
        $data['legend'] = 'Download Result';
        $this->load->view('Student/downloadResult',$data);
    }
    
    function DownloadResult(){
        //$this->output->enable_profiler(TRUE);
        $dataViewSM = new DataViewSM;
        $dataViewRM = new DataViewRM;
        $year     = $this->input->post('drpYear');
        $semister = $this->input->post('drpSemister');
        $stdId    = $this->session->userdata('id');
        $stdName  = $this->session->userdata('name');
        $deptId   = $this->session->userdata('deptId');
        $deptName = $dataViewRM->GetDepartmentName($deptId);
        
        //Searching failed subject if not found update completed_semister table
        if($table = $dataViewSM->GetFaildSubject($year, $semister, $stdId)){
            $legend = 'UNSUCCESSFUL';
            $color  = 'red';
            $msg    = $table;
            $this->SuccessOrUnsuccessMessage($legend,$color,$msg);
        }elseif(!$dataViewSM->GetSubjectStatus($year, $semister, $stdId)){
            $legend = 'ALERT !';
            $color  = 'red';
            if($year == 'default' || $semister == 'default')
                $msg    = 'Unnecessairy selection';
            else
                $msg    = 'You are not complete this semister';
            $this->SuccessOrUnsuccessMessage($legend,$color,$msg);
        }else{
            $this->dataUpdateSM->UpdateCompletedSemister($year, $semister, $stdId);
            //Redirect to create pdf
            redirect('createPDF/CreateGradeSheet/'.$year.'/'.$semister.'/'.$stdId.'/'.$deptName);
        }
    }
    //End Coding For Download Result
}