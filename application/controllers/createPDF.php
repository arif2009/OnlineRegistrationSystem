<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CreatePDF extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('Register/dataViewRM');
        $this->load->model('Register/dataInsertRM');
        $this->load->model('Register/dataUpdateRM');
        $this->load->model('Student/dataViewSM');
        $this->load->library('fpdf');
        $this->load->library('PdfTemplateForIdPassword');
        $this->load->library('PdfTemplateForResult');
        //$this->output->enable_profiler(TRUE);
    }
    function GetStudentInfoToCreatePDF($year, $semister, $stdId){
        $dataViewSM = new DataViewSM;
        if($year == '1st' && $semister == '2nd'){
           $data = $dataViewSM->GetInfoToCreatePDFwhen1st2nd($year, $semister, $stdId);
           $data['year']    = $year;
           $data['semister']= $semister;
           return($data);
        }else{
           $data = $dataViewSM->GetInfoToCreatePDFwhenNot1st2nd($year, $semister, $stdId);
           $data['year']    = $year;
           $data['semister']= $semister;
           return($data);
        }
    }
    function AdviserIdPassword($deptId = 'C06'){

        $pdfTemplate = new PdfTemplateForIdPassword; //Create an object
        $pdfTemplate->category = 'Adviser Password List'; //Set the Title for Adviser
        $deptName = $this->dataViewRM->GetDepartmentName($deptId);//Get department name by department Id
        $pdfTemplate->SetTitle($deptName); //Set title for Department
        
        $data = $this->dataViewRM->GetAdviserIdPasswordPerDept($deptId);//Get all adviser id,name and password
        $pdfTemplate->GenerateAdviserPDF($data); //Print Adviser id,name and password in a table
        
        $pdfTemplate->Output(); //At last create pdf or to send browser $pdfTemplate->Output($deptName, 'I')
    }
    function StudentIdPassword($deptId = 'C06'){
        $pdfTemplate = new PdfTemplateForIdPassword;//Create an Object
        $pdfTemplate->category = 'Student Password List';//Set the title for Student
        $deptName = $this->dataViewRM->GetDepartmentName($deptId);//Get department name by Department Id
        $pdfTemplate->SetTitle($deptName);//Set the title for department
        
        $data = $this->dataViewRM->GetStudentIdPasswordPerDept($deptId);//Get all Student id,name and password
        $pdfTemplate->GenerateStudentPDF($data);//Print Adviser id,name and password in a table
        
        $pdfTemplate->Output();//At last create pdf or to send browser $pdfTemplate->Output($deptName, 'I')
    }
    function CreateGradeSheet($year, $semister, $stdId, $deptName){
        $data = $this->GetStudentInfoToCreatePDF($year, $semister, $stdId);
        $pdf  = new PdfTemplateForResult;
        $pdf->year = $year; $pdf->semister = $semister; $pdf->stdName = $data['stdName'];
        $pdf->stdId = $stdId;$pdf->deptName = urldecode($deptName);
        $pdf->GenerateResultSheetPDF($data);
        $pdf->Output($stdId,'I');
    }
}