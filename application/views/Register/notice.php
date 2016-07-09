<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register Section</title>
        <?php $this->load->view('commonCSS');?>
        <?=link_tag('css/welcome.css')?>
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
        
        <div class="clearfix main">
            <div class="primary grid_12"> 
                
                <fieldset>
                <legend id="notice-legend"><?=$legend?></legend>
                <?=validation_errors('<div class="error">', '</div>')?>
                <?php $attributes = array('id' => 'notice', 'name' =>'notice', 'method' =>'post');
                echo form_open_multipart('register/NoticeValidation',$attributes); ?>
                <div id="notice" align="center">
                <table>
                <?php
                if(is_array($notice)){
                    $noticeTitle  = '<tr><td>'.form_label('Notice Title :', 'txtNotice').'</td></tr>';
                    $data = array(
                        'name'      => 'txtNotice',
                        'id'        => 'txtNotice',
                        'value'     => set_value('txtNotice', $notice[0]->title),
                        'size'      => '63',
                        'tabindex'  => '0'
                    );
                    $noticeTitle  .= '<tr><td>'.form_input($data).'</td></tr>';
                    echo $noticeTitle;

                    $noticeBody = '<tr><td>'.form_label('Notice :', 'noticeBody').'</td></tr>';
                    $data = array(
                        'name'      => 'noticeBody',
                        'id'        => 'noticeBody',
                        'value'     => set_value('noticeBody', $notice[0]->description),
                        'rows'      => '15',
                        'cols'      => '60',
                        'tabindex'  => '1'
                    );
                    $noticeBody .= '<tr><td>'.form_textarea($data).'</td></tr>';
                    echo $noticeBody;

                    $save = array(
                        'name'      => 'btnSave',
                        'id'        => 'btnSave',
                        'value'     => 'Save',
                        'class'     => 'save'
                    );
                    $cancel = array(
                        'name'      => 'btnCancel',
                        'id'        => 'btnCancel',
                        'value'     => 'Cancel',
                        'class'     => 'cancel'
                    );
                    echo '<tr><td>'.form_reset($cancel).''.form_submit($save).'</td></tr>';
                }else{
                    echo '<tr id="title"><td>'.$notice.'</td></tr>';
                }
                ?>
                </table>
                </div>
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
</body>