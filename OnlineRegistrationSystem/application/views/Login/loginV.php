<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
        <?=link_tag('images/others/duet.ico', 'icon', 'image/x-ico');?>
        <?=link_tag('images/others/duet.ico', 'shortcut icon', 'image/x-ico');?>
        <?=link_tag('css/login.css')?>
</head>
<body>
    <div id="main">
        <?php //For adding DUET logo
        $attributes = array(
                        'src' => 'images/login/duet.png',
                        'id' => 'beta',
                        'alt' => 'DUET logo(duet.png file) not found'
                        );
        echo img($attributes);
        ?>
	<div id="top"></div>
	<div id="middle">
	<?php
        $attributes = array(
                        'src' => 'images/login/logo.png','id' => 'logo',
                        'alt' => 'Image not found(logo.png)'
                        );
        echo img($attributes).heading(': Login', 1);
        ?>

       <?php  //Start Form
       $attributes = array('method' =>'post');
       echo form_open('login/ValidedLogin',$attributes);
       ?>
       <div id="boxtop"></div>
       <div id="boxmid">
       <div class="section">
       <?php 
       echo form_label('User ID : ','userId');	
       $data = array(
                 'name'        => 'userId',
                 'value'       => set_value('userId','User ID'),
                 'onfocus'     => 'this.value = \'\''
                  );
       echo form_input($data);
                        //echo form_error('username', '<span class="error">', '</span>');
       ?>  
       </div>
       <div class="section">
       <?php
       echo form_label('Password :','password');
       $data = array(
                 'name'        => 'password',
                 'value'       => set_value('password','Username'),
                 'onfocus'     => 'this.value = \'\''
                 );
       echo form_password($data);
       ?>
       </div>
           
        </div> 
        <div id="boxbot"></div>
        <div class="text" style="float: left;color: red;max-width: 7.1cm;">
        <?php //Here put validation
        echo $loginError;
        echo validation_errors();
        ?>
        </div>
        <div class="text" style="float: right;">
        <?php
        $data = array('name'        => 'login',
                      'value'       => 'Login',
                      'class'       => 'submit');
        echo form_submit($data);
        ?>
        </div>
        <?php //End of Form
        form_close();
        ?>
        <br style="clear:both; height: 0px;" />
	</div>
	<div id="bottom"></div>
</div>
</body>
</html>