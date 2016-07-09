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
    <!--Start Loading Animation-->
    <?php
    $image_properties = array(
          'src' => 'images/others/progress.gif',
          'alt' => 'Loading... Please wait'
    );
    ?>
    <div id="load" style="display:none;"><?=img($image_properties)?></div>
    <!--End Loading Animation-->
    
    <div class="wrap container_16">
        <header class="clearfix">
        <?=$header?>
        </header>
        
        <div class="clearfix main">
            <div class="primary grid_12"> 
                
                <fieldset>
                <legend id="first-legend"><?=$legend?></legend>
                <?php
                 $attributes = array(
                     'class'   =>'form_fields',
                     'name'    =>'downloadResult',
                     'id'      =>'downloadResult',
                     'nethod'  =>'post',
                     //'onsubmit'=>'return ray.ajax()'
                     );
                 echo form_open('student/DownloadResult',$attributes);
                ?>
               
                <?php
                $drpYear = '<span class="grid_11">';
                $drpYear .= form_label('Result Year :','drpYear',array('class'=>'grid_3'));
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
                $semister .= form_label('Result Semister :','drpSemister',array('class'=>'grid_3'));
                $options = array('default'  => 'Select Subject Semister');
                $js = 'id="drpSemister" class="deptSelect grid_5"';
                $semister .= '<div id="semisterDiv">'.form_dropdown('drpSemister', $options, 'default',$js).'</div>';
                $semister .= '<span style="color:red" class="grid_1 alpha">*</span><span class="grid_2"></span>';
                $semister .= '</span>';
                echo $semister;
                ?>
                
                <?php
                $okButton = '<span class="grid_11">';
                $submit = array(
                      'name'    => 'ok',
                      'id'      => 'ok',
                      'value'   => 'ok',
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
    <?php $this->load->view('Student/scriptForDownloadResult');?>
</body>