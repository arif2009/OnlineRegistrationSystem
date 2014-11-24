<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register Section</title>
        <?php $this->load->view('commonCSS');?>
        <?=link_tag('css/student.css')?>
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
                
                <div id="main">
                <?php
                $image_properties = array(
                          'src' => 'images/others/beta.png',
                          'alt' => 'Logo not found',
                          'id'  => 'beta',
                );
                echo img($image_properties);
                ?>
                <div id="top"></div>
                <div id="middle">
                <?php
                $image = array(
                         'src' => 'images/others/logo.png',
                         'id'  => 'logo'
                );
                echo img($image).'<span id="logoText">:Upload</span>';
                ?>
                    
                <?php $attributes = array('id' => 'imageUpload', 'name' =>'imageUpload', 'method' =>'post', 'onSubmit' => 'return CheckImageType()');
                echo form_open_multipart($action.'/Upload',$attributes); ?>
                    <div id="boxtop"></div>
                    <div id="boxmid">
                        <div class="section">
                            <span>File:</span>
                            <?php
                            $upload = array(
                                    'name'    => 'file',
                                    'id'      => 'file',
                                    'onChange' => 'ImageValidation()'
                            );
                            echo form_upload($upload);
                            ?>
                        </div>
                    </div><div id="boxbot"></div>
                 <div class="text" style="float: right;">
                     <?php
                     $button = array(
                             'name' => 'upload',
                             'value'=> 'Upload',
                             'class'=> 'submit'
                     );
                     echo form_submit($button);
                     ?>
                 </div>
                 <br style="clear:both; height: 0px;" />

                 <?=form_close()?>
                </div>
                <div id="bottom"></div>
                </div>
                
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
    <script type="text/javascript" src="<?=base_url("script/script.js")?>"></script>
</body>