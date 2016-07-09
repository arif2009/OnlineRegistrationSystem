<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register Section</title>
        <?php $this->load->view('commonCSS');?>
        <?=link_tag('css/adviser.css')?>
        <script type="text/javascript" src="<?=base_url("sdmenu/sdmenu.js")?>"></script>
        <script type="text/javascript" src="<?=base_url("script/jquery-1.7.1.js")?>"></script>
        <script type="text/javascript">
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.init();
	};
	</script>
</head>
<body>
    <div class="wrap container_16">
        <header class="clearfix">
        <?=$header?>
        </header>
        <div id="message" class="hide"></div><!--For showing Message-->
        <div class="clearfix main">
            <div class="primary grid_12"> 
                
                <fieldset>
                <legend id="first-legend"><?=$legend?></legend>
                
                <?php $attributes = array('class' => 'form_fields_enterMark', 'id' => 'insertMark', 'name' =>'insertMark', 'method' =>'post');
                echo form_open('adviser/InsertStudentMark',$attributes); ?>
                
                <?php
                $department = '<span class="grid_11">';
                $department .= form_label('Subject Department :','drpDepartmentName',array('class' => 'grid_3'));
                $options = array('default'  => 'Select Department');
                
                $CI = &get_instance();
                $CI->load->model('Register/dataViewRM');
                $departmentTable = $CI->dataViewRM->GetAllDepartment();
                foreach ($departmentTable as $row) {
                    $options[$row->DepartmentId] = $row->DepartmentName;
                }
                
                $js = 'id="drpDepartmentName" class="grid_5 deptSelect"';
                $department .= form_dropdown('drpDepartmentName', $options, set_value('drpDepartmentName', 'default'),$js);
                $department .= '<span style="color:red" class="grid_1 alpha">*</span><span class="grid_2"></span>';
                $department .= '</span>';
                echo $department;
                ?>   
                
                <?php
                $drpYear = '<span class="grid_11">';
                $drpYear .= form_label('Subject Year :','drpYear',array('class'=>'grid_3'));
                $options = array(
                            'default' => 'Select Subject Year',
                            '1st'     => 'First',
                            '2nd'     => 'Second',
                            '3rd'     => 'Third',
                            '4th'     => 'Fourth'
                           );
                $js = 'id="drpYear" class="deptSelect grid_5"';
                $drpYear .= form_dropdown('drpYear', $options, set_value('drpYear', 'default'),$js);
                $drpYear .= '<span style="color:red" class="grid_1 alpha">*</span><span class="grid_2"></span>';
                $drpYear .= '</span>';
                echo $drpYear;
                ?>

                <?php
                $semister = '<span class="grid_11">';
                $semister .= form_label('Subject Semister :','subSemister',array('class'=>'grid_3'));
                $options = array('default'  => 'Select Subject Semister');
                $js = 'id="subSemister" class="deptSelect grid_5"';
                $semister .= '<div id="semisterDiv">'.form_dropdown('subSemister', $options, 'default',$js).'</div>';
                $semister .= '<span style="color:red" class="grid_1 alpha">*</span><span class="grid_2"></span>';
                $semister .= '</span>';
                echo $semister;
                ?> 
                
                <?php
                $rdoSubjectType  = '<span class="grid_11">';
                $rdoSubjectType .= '<span class="radio grid_7">';
                $theory = array(
                           'id'     => 'rdoSubjectType',
                           'name'   => 'rdoSubjectType',
                           'value'  => 'theory');
                $rdoSubjectType .= form_radio($theory).'Theory ';
                
                $sessional = array(
                           'id'     => 'rdoSubjectType',
                           'name'   => 'rdoSubjectType',
                           'value'  => 'sessional');
                $rdoSubjectType .= form_radio($sessional).'Sessional';
                $rdoSubjectType .= '</span>';
                $rdoSubjectType .= '<span style="color:red;" class="grid_1 alpha">*</span><span class="grid_3"></span>';
                $rdoSubjectType .= '</span>';
                echo $rdoSubjectType;
                ?>
                    
                <?php
                $drpSubject= '<span class="grid_11">';
                $drpSubject .= form_label('Select Subject :','drpSubject',array('class'=>'grid_3'));
                $options = array('default' => 'Select Subject');
                $js = 'id="drpSubject" class="deptSelect grid_5"';
                $drpSubject .= '<div id="subjectDiv">'.form_dropdown('drpSubject', $options, set_value('drpSubject', 'default'),$js).'</div>';
                $drpSubject .= '<span style="color:red" class="grid_1 alpha">*</span><span class="grid_2"></span>';
                $drpSubject .= '</span>';
                echo $drpSubject;
                ?>
                
                <?php
                echo '<span id="exam" class="grid_11"></span>';
                ?>
                <?php
                echo '<span id="markTable" class="grid_11"></span>';
                ?>
                <?php
                $okButton = '<span class="grid_11">';
                $submit = array(
                            'name'    => 'ok',
                            'id'      => 'ok',
                            'value'   => 'ok',
                            'disabled'=> 'disabled',
                            'class'   => 'submit'    
                            );
                $okButton .= form_submit($submit);
                $okButton .= '</span>';
                echo $okButton;
                ?>
                <?=form_close()?>
                
         </fieldset>
            </div>
            
            <aside class="grid_4">
                <?=$aside?>
            </aside>
        </div>
        
        <footer>
        <?=$footer?>
        </footer>
    </div>
    <!--Ajax-->
    <?php $this->load->view('Adviser/scriptForEnterMark');?>
    <!--For showing Message-->
    <?php $this->load->view('message'); ?>
</body>