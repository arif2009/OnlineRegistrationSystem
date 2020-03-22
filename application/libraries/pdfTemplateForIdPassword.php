<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PdfTemplateForIdPassword extends Fpdf{
    function __construct($orientation = 'P', $unit = 'mm', $size = 'A4') {
        parent::__construct($orientation, $unit, $size);
    }
    var $category;
    function Header(){
        
        $this->SetFont('Arial','B',15);// Arial bold 15
        $this->Cell(0,10,'Xyz University of Engineering & Technology, Gazipur',0,2,'C');
        $this->SetFont('Arial','',13);// Arial normal 13
        $this->Cell(0,8,$this->category,0,2,'C');
        $this->Ln(3);// Line break
        
        $this->SetFont('Arial','',11);// Arial normal 12
        $this->SetFillColor(200,220,255);// Background color
        $this->Cell(0,6,  $this->title,0,1,'C',true);// Department Name
        $this->Ln(4);// Line break
    }
    function Footer(){
        $this->SetY(-15);// Position at 1.5 cm from bottom
        $this->SetFont('Arial','I',8);// Arial italic 8
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');// Page number
    }
    function PageBody($header, $data)
    {
        // Header
        $cellWidth = array(40,90,60);$i=0;
        foreach($header as $col)
            $this->Cell($cellWidth[$i++],7,$col,1,0,'C');
        $this->Ln();
        // Data
        $this->SetFont('Arial','',10);// Arial italic 8
        foreach($data as $row)
        {
            $i=0;
            foreach($row as $col){
                if($i==2){$this->Cell($cellWidth[$i++],6,decrypt($col),1);}
                else{$this->Cell($cellWidth[$i++],6,$col,1);}
            }
            $this->Ln();
        }
    }
    function GenerateAdviserPDF($data){
        $this->AliasNbPages();
        $this->SetAutoPageBreak(TRUE,15);
        $this->AddPage();
        $header = array('User ID', 'Name', 'Password');// Column headings
        $this->PageBody($header, $data);   
    }
    function GenerateStudentPDF($data){
        $this->AliasNbPages();
        $this->SetAutoPageBreak(TRUE, 15);
        $this->AddPage();
        $header = array('User ID', 'Name', 'Password');// Column headings
        $this->PageBody($header, $data);
    }
}