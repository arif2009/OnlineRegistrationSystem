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
                
                <?php $attributes = array('class' => 'form_fields', 'id' => 'insertAdviser', 'name' =>'insertAdviser', 'method' =>'post');
                echo form_open($action.'/ValidedAdviserInformation',$attributes); ?>
                
                <?php
                $adviserId = '<span class="grid_7 alpha">';
                $adviserId .= form_label('Adviser ID :','txtId');	
                $data = array(
                    'name'        => 'txtId',
                    'id'          => 'txtId',
                    'readonly'    => 'readonly',
                    'value'       => $nextId,
                    'style'       => 'background-color: rgb(221,221,221)',
                    'maxlength'   => '6', //specify the maximum number of characters allowed in the <input> element
                    'tabindex'    => '0',  //Define a tabindex
                );
                $adviserId .= form_input($data);
                $adviserId .= '<span style="color:red">*</span></span>';
                $adviserId .= '<span class="grid_5 omega error"></span>';
                echo $adviserId;
                ?>   
                
                <?php
                $firstName = '<span class="grid_7 alpha">';
                $firstName .= form_label('First Name :','txtFName');	
                $data = array(
                    'name'        => 'txtFName',
                    'id'          => 'txtFName',
                    'value'       => set_value('txtFName',($action == 'adviser')? $dbfirstName : ''),
                    'maxlength'   => '30', //specify the maximum number of characters allowed in the <input> element
                    'tabindex'    => '1',  //Define a tabindex
                    'onMouseOver' => 'tooltip.show(\'Enter Adviser first name within 30 character\');',
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
                    'value'       => set_value('txtLName',($action == 'adviser')? $dblastName : ''),
                    'maxlength'   => '30', //specify the maximum number of characters allowed in the <input> element
                    'tabindex'    => '1',  //Define a tabindex
                    'onMouseOver' => 'tooltip.show(\'Enter Adviser last name within 30 character\');',
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
                $department .= form_dropdown('drpDepartmentName', $options, set_value('drpDepartmentName', ($action == 'adviser')? $advInfo[0]->DepartmentId : ''),$js);
                $department .= '<span style="color:red">*</span></span>';
                $department .= '</span>';
                $department .= form_error('drpDepartmentName', '<span class="grid_5 omega error">', '</span>');
                echo $department;
                ?>
                   
                <?php
                $contractNumber = '<span class="grid_7 alpha">';
                $contractNumber .= form_label('Contract Number :','txtContractNumber');	
                $data = array(
                    'name'        => 'txtContractNumber',
                    'id'          => 'txtContractNumber',
                    'value'       => set_value('txtContractNumber',($action == 'adviser')? $advInfo[0]->ContractNumber : ''),
                    'maxlength'   => '60', //specify the maximum number of characters allowed in the <input> element
                    'tabindex'    => '7',  //Define a tabindex
                    'onMouseOver' => 'tooltip.show(\'Enter a correct contract number\');',
                    'onMouseOut'  => 'tooltip.hide();',
                    'onFocus'     => 'tooltip.hide(); this.value=\'\'',
                    'onClick'     => 'tooltip.hide();',
                );
                $contractNumber .= form_input($data);
                $contractNumber .= form_error('txtContractNumber', '<span class="grid_5 omega error">', '</span>');
                echo $contractNumber;
                ?>
                    
                <?php
                $email = '<span class="grid_7 alpha">';
                $email .= form_label('Email :','txtEmail');	
                $data = array(
                    'name'        => 'txtEmail',
                    'id'          => 'txtEmail',
                    'value'       => set_value('txtEmail',($action == 'adviser')? $advInfo[0]->Email : ''),
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