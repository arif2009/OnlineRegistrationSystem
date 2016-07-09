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
                <?php $attributes = array('id' => 'notice', 'name' =>'notice', 'method' =>'post');
                echo form_open_multipart('register/NoticeValidation',$attributes); ?>
                
                <div id="title"><?=$notice[0]->title?></div>
                <div id="description"><?=$notice[0]->description?></div>
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