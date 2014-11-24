<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Register/dataViewRM');
        $this->load->model('Adviser/dataViewAM');
        $this->load->library('MyTemplate');
        $this->output->enable_profiler(TRUE);
    }

    public function index($error = ''){
        if($error){
            $data['loginError'] = urldecode($error);
        }
        else{
            $data['loginError'] = '';
        }
        $this->load->view('Login/loginV',$data);
    }
    function Home(){
        //Register home page
         $data['tableAdv'] = $this->dataViewRM->GetNumberOfAllAdviser();
         $data['tableStd'] = $this->dataViewRM->GetNumberOfAllStudent();
                    
         $myTemplate = new MyTemplate;
         $data['header'] = $myTemplate->Header();
         $data['footer'] = $myTemplate->Footer();
         $data['aside'] = $myTemplate->Aside('Register');
                    
         $data['legend'] = 'BASIC INFORMATION';
         $this->load->view('Register/welcomeRV',$data);
    }
    function StudentHome(){
        //Student home page
         $myTemplate = new MyTemplate;
         $data['header'] = $myTemplate->Header();
         $data['footer'] = $myTemplate->Footer();
         $data['aside']  = $myTemplate->Aside('Student');
         
         $data['legend'] = 'NOTICE BOARD';
         $data['notice'] = $this->dataViewRM->RetrieveTitleNotice();
         $this->load->view('Student/welcomeSV', $data);
    }
    function TeacherHome(){
        //Teacher Home page
        $myTemplate = new MyTemplate;
        $data['header'] = $myTemplate->Header();
        $data['footer'] = $myTemplate->Footer();
        $data['legend'] = 'WELCOME';
        
        $advId = $this->session->userdata('id');
        //only this student, they are request for registration
        $result = $this->dataViewAM->GetAllRequestedStudent($advId);
        if($result){
            $data['aside']  = $myTemplate->Aside('Adviser');
            $data['title']      = 'Requested Student List';
            $data['studentList']= $result;
            $this->load->view('Adviser/welcomeAV', $data);
        }else{
            $this->session->set_userdata('userType', 'Teacher');
            redirect('adviser/EnterMarkHome');
        }
    }
    function ValidedLogin() {
        $this->form_validation->set_rules('userId', 'User ID', 'trim|required|min_length[6]|max_length[6]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[10]');
        if ($this->form_validation->run() == FALSE){
            $this->index();
	}
	else{
            $this->load->model('Login/usersM');
            $rightUser = $this->usersM->Validity();
            if($rightUser){
                if($this->session->userdata('userType') == 'Register'){
                    //person is Register
                    $this->Home();
                }
                else if($this->session->userdata('userType') == 'Adviser'){
                    //Person is Teacher/Adviser
                    $this->TeacherHome();
                }
                else{
                    //Person is student
                    $this->StudentHome();
                }
            }
            else{
                $error = 'Username or Password incorrect';
                $this->index($error);
            }
	}
    }
    function logout(){
	$this->session->unset_userdata($this->session->all_userdata());
	$this->index();
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */