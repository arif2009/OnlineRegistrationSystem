<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register Section</title>
        <?php $this->load->view('commonCSS');?>
        <?=link_tag('css/adviser.css')?>
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
                <div align="center">
                <table class="adviserTable">
                    <th scope="colgroup" colspan="4"><?=$title?></th>
                    <tr><td>Student Id</td><td>Student Name</td><td>Status</td></tr>
                    <?php
                     $CI = &get_instance();
                     $CI->load->model('Adviser/dataViewAM');
                     $dataViewAM = new DataViewAM;
                     foreach ($studentList as $row) {
                        if(($status = $dataViewAM->CheckRegistrationStatus($row->StudentId)) != FALSE){
                            if($status == 'registered'){
                                $status = 'Registration Completed';
                                $color = 'green';
                            }elseif($status == 'requested'){
                                $status = 'Already requested for registration';
                                $color  = 'blue';
                            }else{
                                $status = 'Registration request denied';
                                $color  = 'red';
                            }
                        }else{
                            $status = 'Not yet requested for registration';
                            $color  = 'red'; 
                        }
                        echo '<tr><td>'.$row->StudentId.'</td><td>'.$row->StudentName."</td><td style='color:$color; font-weight:bold'>".$status.'</td><tr>';
                     }
                    ?>
                 </table>
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
    <!--For showing Message-->
    <?php $this->load->view('message'); ?>
    <script type="text/javascript" src="<?=base_url("script/script.js")?>"></script>
</body>