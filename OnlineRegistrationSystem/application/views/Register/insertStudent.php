<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register Section</title>
        <?php $this->load->view('commonCSS');?>
        <?=link_tag('css/register.css')?>
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
                
                <?php $attributes = array('class' => 'form_fields', 'id' => 'insertStudentInfo', 'name' =>'insertStudentInfo', 'method' =>'post');
                echo form_open('register/ValidedStudentInformation',$attributes); ?>
                
                <?php
                $userType = $this->session->userdata('userType');
                if($userType == 'Student'){
                    $requestStudent = TRUE;
                }
                else if($userType == 'Register'){
                    $requestStudent = FALSE;
                }
                else{
                    $error = 'You are Loged Out. Please Login.';
                    redirect("login/index/$error");
                }
                
                if(isset($stdInfo[0])){$databaseData = TRUE;}else{$databaseData = FALSE;}
                
                $studentId = '<span class="grid_7 alpha">';
                $studentId .= form_label('Student ID :','txtId');	
                $data = array(
                    'name'        => 'txtId',
                    'id'          => 'txtId',
                    'value'       => set_value('txtId',($requestStudent && $databaseData)? $stdInfo[0]->StudentId : ''),
                    'maxlength'   => '6', //specify the maximum number of characters allowed in the <input> element
                    'tabindex'    => '0'  //Define a tabindex
                );
                if($requestStudent){
                    $data['readonly'] = 'readonly';
                    $data['style']    = 'background-color: rgb(221,221,221)';
                }
                else{
                    $data['onMouseOver'] = 'tooltip.show(\'Enter student ID within 6 character\');';
                    $data['onMouseOut']  = 'tooltip.hide();';
                    $data['onFocus']     = 'tooltip.hide(); this.value=\'\';';
                    $data['onClick']     = 'tooltip.hide();';
                }
                $studentId .= form_input($data);
                $studentId .= '<span style="color:red">*</span></span>';
                $studentId .= form_error('txtId', '<span class="grid_5 omega error">', '</span>');
                echo $studentId;
                ?>   
                
                <?php
                $firstName = '<span class="grid_7 alpha">';
                $firstName .= form_label('First Name :','txtFName');	
                $data = array(
                    'name'        => 'txtFName',
                    'id'          => 'txtFName',
                    'value'       => set_value('txtFName', ($requestStudent && $databaseData) ? $dbfirstName :''),
                    'maxlength'   => '30', //specify the maximum number of characters allowed in the <input> element
                    'tabindex'    => '1',  //Define a tabindex
                    'onMouseOver' => 'tooltip.show(\'Enter First name\');',
                    'onMouseOut'  => 'tooltip.hide();',
                    'onFocus'     => 'tooltip.hide(); this.value=\'\';',
                    'onClick'     => 'tooltip.hide();',
                );
                $firstName .= form_input($data);
                $firstName .= '<span style="color:red">*</span></span>';
                $firstName .= form_error('txtFName', '<span class="grid_5 omega error">', '</span>');
                echo $firstName;
                ?>
                
                <?php
                $lastName = '<span class="grid_7 alpha">';
                $lastName .= form_label('Last Name :','txtLName');	
                $data = array(
                    'name'        => 'txtLName',
                    'id'          => 'txtLName',
                    'value'       => set_value('txtLName',($requestStudent && $databaseData) ? $dblastName :''),
                    'maxlength'   => '30', //specify the maximum number of characters allowed in the <input> element
                    'tabindex'    => '2',  //Define a tabindex
                    'onMouseOver' => 'tooltip.show(\'Enter Last name\');',
                    'onMouseOut'  => 'tooltip.hide();',
                    'onFocus'     => 'tooltip.hide(); this.value=\'\';',
                    'onClick'     => 'tooltip.hide();',
                );
                $lastName .= form_input($data);
                $lastName .= '<span style="color:red">*</span></span>';
                $lastName .= form_error('txtLName', '<span class="grid_5 omega error">', '</span>');
                echo $lastName;
                ?>
                
                <?php
                $fathersName = '<span class="grid_7 alpha">';
                $fathersName .= form_label('Father\'s Name :','txtFathersName');	
                $data = array(
                    'name'        => 'txtFathersName',
                    'id'          => 'txtFathersName',
                    'value'       => set_value('txtFathersName',($requestStudent && $databaseData)?$stdInfo[0]->FathersName : ''),
                    'maxlength'   => '60', //specify the maximum number of characters allowed in the <input> element
                    'tabindex'    => '2',  //Define a tabindex
                    'onMouseOver' => 'tooltip.show(\'Enter a correct name within 60 character\');',
                    'onMouseOut'  => 'tooltip.hide();',
                    'onFocus'     => 'tooltip.hide(); this.value=\'\';',
                    'onClick'     => 'tooltip.hide();',
                );
                $fathersName .= form_input($data);
                $fathersName .= '<span style="color:red">*</span></span>';
                $fathersName .= form_error('txtFathersName', '<span class="grid_5 omega error">', '</span>');
                echo $fathersName;
                ?>
                   
                <?php
                $mothersName = '<span class="grid_7 alpha">';
                $mothersName .= form_label('Mother\'s Name :','txtMothersName');	
                $data = array(
                    'name'        => 'txtMothersName',
                    'id'          => 'txtMothersName',
                    'value'       => set_value('txtMothersName', ($requestStudent && $databaseData)?$stdInfo[0]->MothersName : ''),
                    'maxlength'   => '60', //specify the maximum number of characters allowed in the <input> element
                    'tabindex'    => '3',  //Define a tabindex
                    'onMouseOver' => 'tooltip.show(\'Enter a correct name within 60 character\');',
                    'onMouseOut'  => 'tooltip.hide();',
                    'onFocus'     => 'tooltip.hide(); this.value=\'\';',
                    'onClick'     => 'tooltip.hide();',
                );
                $mothersName .= form_input($data);
                $mothersName .= '<span style="color:red">*</span></span>';
                $mothersName .= form_error('txtMothersName', '<span class="grid_5 omega error">', '</span>');
                echo $mothersName;
                ?>
                
                <?php
                $presentAddress = '<span class="grid_7 alpha">';
                $presentAddress .= form_label('Present Address :','txtPresentAddress');	
                $data = array(
                    'name'        => 'txtPresentAddress',
                    'id'          => 'txtPresentAddress',
                    'value'       => set_value('txtPresentAddress',($requestStudent && $databaseData)? $stdInfo[0]->PresentAddress : ''),
                    'rows'        => '4', //specify the maximum number of characters allowed in the <input> element
                    'cols'        => '19',
                    'tabindex'    => '4',  //Define a tabindex
                    'onFocus'     => 'this.value=\'\'',
                );
                $presentAddress .= form_textarea($data);
                $presentAddress .= form_error('txtPresentAddress', '<span class="grid_5 omega error">', '</span>');
                echo $presentAddress;
                ?>
                
                <?php
                $permanentAddress = '<span class="grid_7 alpha">';
                $permanentAddress .= form_label('Permanent Address :','txtPermanentAddress');	
                $data = array(
                    'name'        => 'txtPermanentAddress',
                    'id'          => 'txtPermanentAddress',
                    'value'       => set_value('txtPermanentAddress', ($requestStudent && $databaseData)? $stdInfo[0]->ParmanentAddress : ''),
                    'rows'         => '4', //specify the maximum number of characters allowed in the <input> element
                    'cols'         => '19',
                    'tabindex'    => '5',  //Define a tabindex
                    'onFocus'     => 'this.value=\'\'',
                );
                $permanentAddress .= form_textarea($data);
                $permanentAddress .= form_error('txtPermanentAddress', '<span class="grid_5 omega error">', '</span>');
                echo $permanentAddress;
                ?>
                    
                <?php
                $email = '<span class="grid_7 alpha">';
                $email .= form_label('Email :','txtEmail');	
                $data = array(
                    'name'        => 'txtEmail',
                    'id'          => 'txtEmail',
                    'value'       => set_value('txtEmail', ($requestStudent && $databaseData)? $stdInfo[0]->Email : ''),
                    'maxlength'   => '60', //specify the maximum number of characters allowed in the <input> element
                    'tabindex'    => '6',  //Define a tabindex
                    'onMouseOver' => 'tooltip.show(\'Enter a correct E-mail address within 50 character\');',
                    'onMouseOut'  => 'tooltip.hide();',
                    'onFocus'     => 'tooltip.hide(); this.value=\'\'',
                    'onClick'     => 'tooltip.hide();',
                );
                $email .= form_input($data);
                $email .= '<span style="color:red">*</span></span>';
                $email .= form_error('txtEmail', '<span class="grid_5 omega error">', '</span>');
                echo $email;
                ?>
                
                <?php
                $contractNumber = '<span class="grid_7 alpha">';
                $contractNumber .= form_label('Contract Number :','txtContractNumber');	
                $data = array(
                    'name'        => 'txtContractNumber',
                    'id'          => 'txtContractNumber',
                    'value'       => set_value('txtContractNumber', ($requestStudent && $databaseData)? $stdInfo[0]->ContractNumber : ''),
                    'maxlength'   => '60', //specify the maximum number of characters allowed in the <input> element
                    'tabindex'    => '7',  //Define a tabindex
                    'onMouseOver' => 'tooltip.show(\'Enter a correct contract number\');',
                    'onMouseOut'  => 'tooltip.hide();',
                    'onFocus'     => 'tooltip.hide(); this.value=\'\'',
                    'onClick'     => 'tooltip.hide();',
                );
                $contractNumber .= form_input($data);
                $contractNumber .= '<span style="color:red">*</span></span>';
                $contractNumber .= form_error('txtContractNumber', '<span class="grid_5 omega error">', '</span>');
                echo $contractNumber;
                ?>
                
                <?php
                $department = '<span class="grid_7 alpha">';
                $department .= form_label('Department Name :','drpDepartmentName');
                $options = array('default'  => 'Select Department');
                
                $CI = &get_instance();
                $CI->load->model('Register/dataViewRM');
                $departmentTable = $CI->dataViewRM->GetAllDepartment();
                foreach ($departmentTable as $row) {
                    $options[$row->DepartmentId] = $row->DepartmentName;
                }
                
                $js = 'id="drpDepartmentName" class="deptSelect" tabindex = "8" onChange="some_function();"';
                $department .= form_dropdown('drpDepartmentName', $options, set_value('drpDepartmentName', ($requestStudent && $databaseData)? $stdInfo[0]->DepartmentId : ''),$js);
                $department .= '<span style="color:red">*</span></span>';
                $department .= '</span>';
                $department .= form_error('drpDepartmentName', '<span class="grid_5 omega error">', '</span>');
                echo $department;
                ?>

                <?php
                $sex = '<span class="grid_7 alpha">';
                $sex .= form_label('Sex :','drpSex');
                $options = array('male'  => 'Male',
                                 'female'=> 'Female',
                                 'others'=> 'Others');
                $js = 'id="drpSex" class="deptSelect" tabindex = "9" onChange="some_function();"';
                $sex .= form_dropdown('drpSex', $options, set_value('drpSex', ($requestStudent && $databaseData)? $stdInfo[0]->Sex : ''),$js);
                $sex .= '<span style="color:red">*</span></span>';
                $sex .= '</span>';
                $sex .= form_error('drpSex', '<span class="grid_5 omega error">', '</span>');
                echo $sex;
                ?>
            
                <?php
                if(!$requestStudent){
                    $date = '<span class="grid_7 alpha">';
                    $date .= form_label('Admit Date :','datePicler');
                    $data = array(
                        'name'        => 'datePicler',
                        'id'          => 'datePicler',
                        'value'       => set_value('datePicler'),
                        'style'       => 'width:190px',
                        'maxlength'   => '60', //specify the maximum number of characters allowed in the <input> element
                        'tabindex'    => '10',  //Define a tabindex
                    );
                    $date .= form_input($data);
                    $date .= '<span class="grid_1 alpha" style="margin-top:8px">';
                    $image_properties = array(
                        'src'       => 'images/datetimepicker/cal.gif',
                        'alt'       => 'Calender image not found',
                        'style'     => 'cursor:pointer; height: 24px',
                        'onClick'   => "javascript:tooltip.hide();NewCssCal('datePicler','YYYYMMDD')",
                        'onMouseOver' => 'tooltip.show(\'Select admited date of a student\');',
                        'onMouseOut'  => 'tooltip.hide();',
                        'onFocus'     => 'tooltip.hide();',
                    );
                    $date .= img($image_properties);
                    $date .= '<span style="color:red">*</span></span>';
                    $date .= '</span></span>';
                    $date .= form_error('datePicler', '<span class="grid_5 omega error">', '</span>');
                    echo $date;
                }
                ?>
                 
                <?php
                if($requestStudent){$ok = 'Update';$cancel= 'Default';}else{$ok = 'Submit';$cancel= 'Reset';}
                
                $button = '<span class="grid_7" style="margin-left:180px">';
                $dataOk = array(
                            'name'      => 'submit',
                            'id'        => 'submit',
                            'class'     => 'sexybutton',
                            'type'      => 'submit',
                            'value'     => 'true',
                            'content'   => '<span><span><span class="ok">'.$ok.'</span></span></span>'
                    );
                $dataCancel = array(
                            'name'      => 'cancel',
                            'id'        => 'cancel',
                            'class'     => 'sexybutton',
                            'type'      => 'reset',
                            //'onClick'   => 'ResetInsertStudentForm()',
                            'value'     => 'true',
                            'content'   => '<span><span><span class="cancel">'.$cancel.'</span></span></span>'
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