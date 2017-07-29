<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MyTemplate{
    function Header(){
        $header = '<div class="grid_3">';
                $image_properties = array('src' => 'images/others/mono.gif',
                                          'alt' => 'DUET monogram(mono.gif file) not found',
                                          'width' => '130',
                                          'height' => '130');
        $header .= img($image_properties);
        $header .= '</div>';      
        $header .= '<div class="grid_13">';   
        $header .= '<h1>Course Registraton System</h1>';
        $header .= '<h2>(With Result Processing)</h2>';
        $header .= '<h3>Dhaka University of Engineering & Technology</h3>';       
        $header .= '</div>';
        return($header);
    }
    
    function Footer(){
        $footer = '<p>';
        $footer .= anchor('http://arifur-rahman-sazal.blogspot.com', 'Different Programming Tips', array('target' => '_blunk'));
        $footer .= ' | ';
        $footer .= anchor('http://www.duet.ac.bd', 'DUET', array('target' => '_blunk'));
        $footer .= ' | ';
        $footer .= anchor('http://arifur-rahman-sazal.blogspot.com/p/blog-page_9.html', 'About Me', array('target' => '_blunk'));
        $footer .= '</p>';
        return($footer);
    }
    
    function Aside($aside = 'Register'){
        if($aside == 'Register'){
            $aside  = '<div id="my_menu" class="sdmenu">';
            
            $aside .= '<div>';
            $aside .= '<span>Data Entry</span>';
            $aside .= anchor('Login/Home', 'Home');
            $aside .= anchor('register/InsertStudent', 'Insert a student');
            $aside .= anchor('register/InsertAdviser', 'Insert a adviser');
            $aside .= anchor('register/InsertDepartment', 'Add a department');
            $aside .= anchor('register/AdviserSelection', 'Adviser Selection');
            $aside .= anchor('register/Notice', 'Edit Notice');
            $aside .= '</div>';

            $aside .= '<div>';
            $aside .= '<span>Print</span>';
            $aside .= anchor('register/DownloadAdviserIdPassword', 'Adviser Id & Password');
            $aside .= anchor('register/DownloadStudentIdPassword', 'Student Id & Password');
            $aside .= anchor('register/GiveRegPermission', 'Give Reg. Permiaaion');
            $aside .= '</div>';

            $aside .= '<div>';
            $aside .= '<span>Log Out</span>';
            $aside .= anchor('changePassword/ChangePassword', 'Change password');
            $aside .= anchor('login/logout', 'Log out');
            $aside .= '</div>';
            
            $aside .= '</div>';
        }elseif ($aside == 'Adviser') {
            $aside  = '<div id="my_menu" class="sdmenu">';
            
            $aside .= '<div>';
            $aside .= '<span>Information</span>';
            $aside .= anchor('Login/TeacherHome', 'Home');
            $aside .= anchor('adviser/ViewAdviserInfo', 'Personal Info');
            $aside .= anchor('adviser/Upload', 'Upload Image');
            $aside .= anchor('adviser/UpdateAdviser', 'Update Information');
            $aside .= '</div>';

            $aside .= '<div>';
            $aside .= '<span>Authentication</span>';
            $aside .= anchor('adviser/EnterMarkHome', 'Insert or Edit Mark');
            $aside .= anchor('adviser/ViewAllStudentUnderaAdviser', 'View All My Student');
            $aside .= '</div>';

            $aside .= '<div>';
            $aside .= '<span>Log Out</span>';
            $aside .= anchor('changePassword/ChangePassword', 'Change password');
            $aside .= anchor('login/logout', 'Log out');
            $aside .= '</div>';
            
            $aside .= '</div>';
        }elseif ($aside == 'Teacher') {
            $aside  = '<div id="my_menu" class="sdmenu">';
            
            $aside .= '<div>';
            $aside .= '<span>Information</span>';
            $aside .= anchor('Login/TeacherHome', 'Home');
            $aside .= anchor('adviser/ViewAdviserInfo', 'Personal Info');
            $aside .= anchor('adviser/Upload', 'Upload Image');
            $aside .= anchor('adviser/UpdateAdviser', 'Update Information');
            $aside .= '</div>';

            $aside .= '<div>';
            $aside .= '<span>Authentication</span>';
            $aside .= anchor('adviser/EnterMarkHome', 'Insert or Edit Mark');
            $aside .= '</div>';

            $aside .= '<div>';
            $aside .= '<span>Log Out</span>';
            $aside .= anchor('changePassword/ChangePassword', 'Change password');
            $aside .= anchor('login/logout', 'Log out');
            $aside .= '</div>';
            
            $aside .= '</div>';
        }elseif ($aside == 'Student') {
            $aside  = '<div id="my_menu" class="sdmenu">';
            
            $aside .= '<div>';
            $aside .= '<span>Information</span>';
            $aside .= anchor('Login/StudentHome', 'Home');
            $aside .= anchor('student/ViewStudentInfo', 'Personal Info');
            $aside .= anchor('student/Upload', 'Upload Image');
            $aside .= anchor('student/UpdateStudentInfo', 'Update Information');
            $aside .= anchor('student/ShowAdviserInfoForStudent', 'My Adviser');
            $aside .= '</div>';

            $aside .= '<div>';
            $aside .= '<span>Registration</span>';
            $aside .= anchor('student/CourseRegistration', 'Course Registration');
            $aside .= anchor('student/DownloadCriteria', 'Gread Sheet');
            $aside .= '</div>';

            $aside .= '<div>';
            $aside .= '<span>Log Out</span>';
            $aside .= anchor('changePassword/ChangePassword', 'Change password');
            $aside .= anchor('login/logout', 'Log out');
            $aside .= '</div>';
            
            $aside .= '</div>';
        }
        return($aside);
    }
}
