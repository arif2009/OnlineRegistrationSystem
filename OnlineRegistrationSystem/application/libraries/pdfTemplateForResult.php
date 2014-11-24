<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pdfTemplateForResult
 *
 * @author Arif
 */
class PdfTemplateForResult extends Fpdf{
    function __construct($orientation = 'P', $unit = 'mm', $size = 'A4') {
        parent::__construct($orientation, $unit, $size);
    }
    var $year, $semister, $stdId, $deptName,$stdName;
    function Header(){
        $this->SetFont('Arial','B',15);// Arial bold 15
        $this->Cell(0,10,'Dhaka University of Engineering & Technology, Gazipur',0,1,'C');// Title
        $this->Image(base_url('images/others/mono.gif'),90,22,22,22);// Logo
        $this->Ln(25);
        
        $this->SetFont('Arial','B',13);
        $this->Cell(0,10,'Grade Sheet(Provisional)',0,1,'C');
        $this->SetFont('Arial','',8);
        $this->Cell(0,6,$this->year.' Year '.$this->semister.' Semester,'.' B. Sc. Engineering Examination',0,1,'C');
        $this->Cell(0,6, $this->deptName, 0, 1,'C');
        $this->SetFont('Arial','',8);
        $this->Ln(2);
        $this->Cell(25,6,'Student\'s Name',0,0,'L');$this->SetFont('Arial','B',8);$this->Cell(60,6, ': '.$this->stdName,0,1,'L');
        $this->SetFont('Arial','',8);
        $this->Cell(25,6,'Student No',0,0,'L');$this->SetFont('Arial','B',8);$this->Cell(30,6, ': '.$this->stdId,0,1,'L');
    }
    function MainContent($data){
        $this->SetFont('Arial','',8);
        $header = array('Course No.', 'Course Title', 'Credit Hours', 'Letter Grade', 'Grade Point');// Column headings
        $cellWidth = array(20,105,20,20,20);// Column headings
        $i=0;
        foreach($header as $col)
            $this->Cell($cellWidth[$i++],7,$col,1,0,'C');
        foreach ($data['pdfInfo'] as $value) {
            $this->Ln(7);
            $this->Cell($cellWidth[0],7,$value->SubjectCode,1,0);
            $this->Cell($cellWidth[1],7,$value->SubjectTitle,1,0);
            $this->Cell($cellWidth[2],7,$value->Cardit,1,0,'C');
            $this->Cell($cellWidth[3],7,$value->GradeLetter,1,0);
            $this->Cell($cellWidth[4],7,$value->GPA,1,0,'C');
        }
        
        $this->Ln(7);
        $this->SetFont('Times','B',9);
        $this->Cell(179, 7, 'GPA = '.round($data['GPA'],2), 0, 1,'R');
        
        $this->Ln(5);
        $this->SetFont('Arial','',8);
        $this->Cell(60, 4, 'Caredit Hours Earned in this Semister : '.round($data['currentCredit'],2), 0, 1,'R');
        $this->Cell(60, 4, 'Total Caredit Hours Earned : '.round($data['totalCredit'],2), 0, 1,'R');
        $this->Cell(60, 4, 'CGPA : '.round($data['CGPA'],2), 0, 1,'R');
    }
    function SigniturePart(){
        $this->Ln(15);
        $this->Line(10, 193.5, 30, 193.5);$this->Line(124, 193.5, 195, 193.5);
        $this->Ln();
        $this->Cell(60, 4, 'Verified by', 0, 0,'L');$this->cell(40);
        $this->Cell(100, 4, 'Deputy Controller of Examination', 0, 1,'C');
        $this->Cell(60, 4, 'Date:', 0, 0,'L');$this->cell(40);
        $this->Cell(100, 4, 'Dhaka University of Engineering & Technology, Gazipur', 0, 1,'C');
    }
    function GradingSystem(){
        /*$this->Ln(13);
        // Array System
        $this->SetFont('Times','B',7);
        $this->Cell(20,4.5,'Grading System :',0,1,'L');
        $header = array(
            0=>array('title'=> '   Numerical Grade','border'=>'LTB','nextPosition'=>0,'width'=>40,'txtAlign'=>'L'),
            1=>array('title'=>'Letter Grade','border'=>'TB','nextPosition'=>0,'width'=>30,'txtAlign'=>'L'),
            2=>array('title'=>'Grade Point','border'=>'TBR','nextPosition'=>0,'width'=>22.5,'txtAlign'=>'C'),
            3=>array('title'=>'   Numerical Grade','border'=>'TB','nextPosition'=>0, 'width'=>40,'txtAlign'=>'L'),
            4=>array('title'=>'Letter Grade','border'=>'TB','nextPosition'=>0, 'width'=>30,'txtAlign'=>'L'),
            5=>array('title'=>'Grade Point','border'=>'TBR','nextPosition'=>1, 'width'=>22.5,'txtAlign'=>'C')
        ); // Column headings
       foreach ($header as $value) {
            $this->Cell($value['width'],4.5,$value['title'],$value['border'],$value['nextPosition'],$value['txtAlign']);
       }
       $this->SetFont('Times','',7);
       $data = array(
           //Cell 1.width, 2.text, 3.border, 4.Next row position, 5.text align
           0=>array(
               0=>array(40,'80% or above','L',0,'L'),
               1=>array(30,'A Plus',0,0,'L'),
               2=>array(22.5,'4.00','R',0,'C'),
               3=>array(40,'50% to less than 55%',0,0,'L'),
               4=>array(30,'C Plus',0,0,'L'),
               5=>array(22.5,'2.50','R',1,'C')
           ),
           //Cell 1.width, 2.text, 3.border, 4.Next row position, 5.text align
           1=>array(
               0=>array(40,'75% to less than 80%','L',0,'L'),
               1=>array(30,'A Regular',0,0,'L'),
               2=>array(22.5,'3.75','R',0,'C'),
               3=>array(40,'45% to less than 50%',0,0,'L'),
               4=>array(30,'C Regular',0,0,'L'),
               5=>array(22.5,'2.50','R',1,'C')
           ),
           //Cell 1.width, 2.text, 3.border, 4.Next row position, 5.text align
           2=>array(
               0=>array(40,'70% to less than 75%','L',0,'L'),
               1=>array(30,'A Minus',0,0,'L'),
               2=>array(22.5,'3.50','R',0,'C'),
               3=>array(40,'40% to less than 45%',0,0,'L'),
               4=>array(30,'D',0,0,'L'),
               5=>array(22.5,'2.00','R',1,'C')
           ),
           //Cell 1.width, 2.text, 3.border, 4.Next row position, 5.text align
           3=>array(
               0=>array(40,'65% to less than 70%','L',0,'L'),
               1=>array(30,'B Plus',0,0,'L'),
               2=>array(22.5,'3.25','R',0,'C'),
               3=>array(40,'Less than 40%',0,0,'L'),
               4=>array(30,'F',0,0,'L'),
               5=>array(22.5,'0.00','R',1,'C')
           ),
           //Cell 1.width, 2.text, 3.border, 4.Next row position, 5.text align
           4=>array(
               0=>array(40,'60% to less than 65%','L',0,'L'),
               1=>array(30,'B Regular',0,0,'L'),
               2=>array(22.5,'3.00','R',0,'C'),
               3=>array(40,'',0,0,'L'),
               4=>array(30,'X',0,0,'L'),
               5=>array(22.5,'Continuation','R',1,'C')
           ),
           //Cell 1.width, 2.text, 3.border, 4.Next row position, 5.text align
           5=>array(
               0=>array(40,'55% to less than 60%','LB',0,'L'),
               1=>array(30,'B Minus','B',0,'L'),
               2=>array(22.5,'2.75','RB',0,'C'),
               3=>array(40,'','B',0,'L'),
               4=>array(30,'','B',0,'L'),
               5=>array(22.5,'','BR',1,'C')
           )
       );
       foreach ($data as $row) {
           foreach ($row as $value) {
               $this->Cell($value[0],4.5,$value[1],$value[2],$value[3],$value[4]);
           }
       }*/
       $this->Image(base_url('images/others/grading.gif'),10,215,185,35);// Grading System
    }
    function GenerateResultSheetPDF($data){
        $this->AddPage();
        $this->MainContent($data);
        $this->SigniturePart();
        $this->GradingSystem();
    }
}
