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
        <div class="clearfix main">
            <div class="primary grid_12"> 
                
            <fieldset>
                <legend id="first-legend"><?=$legend?></legend>
                <table>
                  <?php
                    $CI = &get_instance();
                    $CI->load->model('Register/dataViewRM');
                    $departmentTable = $CI->dataViewRM->GetAllDepartment();
                    if($type == 'adviser'){
                        foreach ($departmentTable as $row) {
                                echo '<tr><td>'.$row->DepartmentName.'</td><td>'.anchor('createPDF/AdviserIdPassword/'.$row->DepartmentId, 'Download', array('class' => 'submit')).'</td></tr>';
                        }
                    }
                    else{
                        foreach ($departmentTable as $row) {
                                echo '<tr><td>'.$row->DepartmentName.'</td><td>'.anchor('createPDF/StudentIdPassword/'.$row->DepartmentId, 'Download', array('class' => 'submit')).'</td></tr>';
                        }
                    }
                  ?>
                </table>
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
