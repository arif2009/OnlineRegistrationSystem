<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register Section</title>
        <?php $this->load->view('commonCSS');?>
        <?=link_tag('css/register.css')?>
        <script type="text/javascript" src="<?=base_url("script/jquery-1.7.1.js")?>"></script>
        <script type="text/javascript" src="<?=base_url("sdmenu/sdmenu.js")?>"></script>
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
                
                <?php $attributes = array('class' => 'form_fields', 'id' => 'cangePassword', 'name' =>'cangePassword', 'method' =>'post');
                echo form_open('changePassword/ValidedPasswordInformation',$attributes); ?>
 
                <?php
                $currentPassword = '<span class="grid_7 alpha">';
                $currentPassword .= form_label('Current Password :','txtCurrentPassword');	
                $data = array(
                    'name'        => 'txtCurrentPassword',
                    'id'          => 'txtCurrentPassword',
                    'minlength'   => '6',
                    'maxlength'   => '10', //specify the maximum number of characters allowed in the <input> element
                    'tabindex'    => '0',  //Define a tabindex
                );
                $currentPassword .= form_password($data);
                $currentPassword .= '<span style="color:red">*</span></span>';
                $currentPassword .= form_error('txtCurrentPassword', '<span class="grid_5 omega error">', '</span>');
                echo $currentPassword;
                ?>
                
                <?php
                $newPassword = '<span class="grid_7 alpha">';
                $newPassword .= form_label('New Password :','txtNewPassword');
                $data = array(
                    'name'        => 'txtNewPassword',
                    'id'          => 'txtNewPassword',
                    'minlength'   => '6',
                    'maxlength'   => '10', //specify the maximum number of characters allowed in the <input> element
                    'tabindex'    => '1',
                );
                $newPassword .= form_password($data);
                $newPassword .= '<span style="color:red">*</span></span>';
                $newPassword .= form_error('txtNewPassword', '<span class="grid_5 omega error">', '</span>');
                echo $newPassword;
                ?>

                <?php
                $confirmPassword = '<span class="grid_7 alpha">';
                $confirmPassword .= form_label('Re-type password :','txtConfirmPassword');
                $data = array(
                    'name'        => 'txtConfirmPassword',
                    'id'          => 'txtConfirmPassword',
                    'minlength'   => '6',
                    'maxlength'   => '100', //specify the maximum number of characters allowed in the <input> element
                    'tabindex'    => '1',
                );
                $confirmPassword .= form_password($data);
                $confirmPassword .= '<span style="color:red">*</span></span>';
                $confirmPassword .= form_error('txtConfirmPassword', '<span class="grid_5 omega error">', '</span>');
                echo $confirmPassword;
                ?>

                <?php
                $button = '<span class="grid_7" style="margin-left:150px">';
                $change = array(
                    'name'        => 'change',
                    'id'          => 'change',
                    'value'       => 'Change',
                    'class'       => 'submit'
                );
                $reset = array(
                    'name'        => 'reset',
                    'id'          => 'reset',
                    'value'       => 'Reset',
                    'class'       => 'reset'
                );
                $button .= form_reset($reset).''.  form_submit($change);
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
   
    <!--For showing Message-->
    <?php $this->load->view('message'); ?>
</body>
