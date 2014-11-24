<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register Section</title>
        <?php $this->load->view('commonCSS');?>
        <?=link_tag('css/register.css')?>
        <script type="text/javascript" src="<?=base_url("script/jquery-1.7.1.js")?>"></script>
        <script type="text/javascript" src="<?=base_url("script/jquery.maskedinput-1.3.js")?>"></script>
        <script type="text/javascript" src="<?=base_url("sdmenu/sdmenu.js")?>"></script>
        <script type="text/javascript">
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.init();
	};
        
        jQuery(function($){
            $("#txtId").mask("a99",{placeholder:"#"});
        });
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
                
                <?php $attributes = array('class' => 'insert_form_fields', 'id' => 'insertDepartment', 'name' =>'insertDepartment', 'method' =>'post');
                echo form_open('register/ValidedDepartmentInformation',$attributes); ?>
                
                <?php
                $adviserId = '<span class="grid_7 alpha">';
                $adviserId .= form_label('Department ID :','txtId');	
                $data = array(
                    'name'        => 'txtId',
                    'id'          => 'txtId',
                    'value'       => set_value('txtId'),
                    'maxlength'   => '5', //specify the maximum number of characters allowed in the <input> element
                    'tabindex'    => '0',  //Define a tabindex
                    'onMouseOver' => 'tooltip.show(\'First enter a alphabet then numeric value<br/>Ex: M06\');',
                    'onMouseOut'  => 'tooltip.hide();',
                    'onFocus'     => 'tooltip.hide();',
                    'onClick'     => 'tooltip.hide();',
                );
                $adviserId .= form_input($data);
                $adviserId .= '<span style="color:red">*</span></span>';
                $adviserId .= form_error('txtId', '<span class="grid_5 omega error">', '</span>');
                echo $adviserId;
                ?>   
                
                <?php
                $adviserName = '<span class="grid_7 alpha">';
                $adviserName .= form_label('Department Name :','txtName');	
                $data = array(
                    'name'        => 'txtName',
                    'id'          => 'txtName',
                    'value'       => set_value('txtName'),
                    'maxlength'   => '35', //specify the maximum number of characters allowed in the <input> element
                    'tabindex'    => '1',  //Define a tabindex
                    'onMouseOver' => 'tooltip.show(\'Enter Adviser name within 35 character\');',
                    'onMouseOut'  => 'tooltip.hide();',
                    'onFocus'     => 'tooltip.hide(); this.value=\'\';',
                    'onClick'     => 'tooltip.hide();',
                );
                $adviserName .= form_input($data);
                $adviserName .= '<span style="color:red">*</span></span>';
                $adviserName .= form_error('txtName', '<span class="grid_5 omega error">', '</span>');
                echo $adviserName;
                ?>
                
                <?php
                $department = '<span class="grid_7 alpha">';
                $department .= form_label('Faculty Name :','drpFacultyName');
                $options = array('default'  => 'Select Faclty');
                
                $CI = &get_instance();
                $CI->load->model('Register/dataViewRM');
                $facultyTable = $CI->dataViewRM->GetAllFaculty();
                foreach ($facultyTable as $row) {
                    $options[$row->FacultyId] = $row->FacultyName;
                }
                
                $js = 'id="drpFacultyName" class="Select" tabindex = "2"';
                $department .= form_dropdown('drpFacultyName', $options, set_value('drpFacultyName', 'default'),$js);
                $department .= '<span style="color:red">*</span></span>';
                $department .= '</span>';
                $department .= form_error('drpFacultyName', '<span class="grid_5 omega error">', '</span>');
                echo $department;
                ?>
                   
                <?php
                $degreeAward = '<span class="grid_7 alpha">';
                $degreeAward .= form_label('Degree Award Department?','isDegreeAward');	
                $options = array('default'  => 'Select Faclty',
                                 'yes'      => 'Yes',
                                 'no'       => 'No');
                $js = 'id="isDegreeAward" class="Select" tabindex = "3"';
                $degreeAward .= form_dropdown('isDegreeAward', $options, set_value('isDegreeAward', 'default'),$js);
                $degreeAward .= '<span style="color:red">*</span></span>';
                $degreeAward .= form_error('isDegreeAward', '<span class="grid_5 omega error">', '</span>');
                echo $degreeAward;
                ?>
               
                <?php
                $button = '<span class="grid_7" style="margin-left:180px">';
                $dataOk = array(
                            'name'      => 'submit',
                            'id'        => 'submit',
                            'class'     => 'sexybutton',
                            'type'      => 'submit',
                            'value'     => 'true',
                            'content'   => '<span><span><span class="ok">Submit</span></span></span>'
                    );
                $dataCancel = array(
                            'name'      => 'cancel',
                            'id'        => 'cancel',
                            'class'     => 'sexybutton',
                            'type'      => 'reset',
                            //'onClick'   => 'ResetInsertStudentForm()',
                            'value'     => 'true',
                            'content'   => '<span><span><span class="cancel">Reset</span></span></span>'
                    );
                $button .= form_button($dataOk);
                $button .= form_button($dataCancel);
                $button .= '</span>';
                $button .= '<span class="grid_5 error"></span>';
                echo $button;
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
    <script type="text/javascript" src="<?=base_url("script/datetimepicker_css.js")?>"></script>
    <?=link_tag('css/tool_tip_text.css')?>
    <script type="text/javascript" src="<?=base_url("script/tool_tip_text.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("script/script.js")?>"></script>
    
    <!--For showing Message-->
    <?php $this->load->view('message'); ?>
</body>