<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register Section</title>
        <?php $this->load->view('commonCSS');?>
        <?=link_tag('css/welcome.css')?>
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
                    <tr><td>Student Id</td><td>Student Name</td><td>Year/Semister</td><td></td></tr>
                    <?php
                    if(is_array($studentList)){
                     foreach ($studentList as $row) {
                        $stdId   = $row->StudentId;
                        $stdName = $row->StudentName;
                        $status  = $row->RegistrationStatus;
                        if($status == 'registered'){
                            $status = 'Registered';
                            $color  = 'green';
                        }elseif($status == 'requested'){
                            $status = 'Requested';
                            $color  = 'blue';
                        }else{
                            $status = 'Deny';
                            $color  = 'red';
                        }
                        echo '<tr><td>'.$stdId.'</td><td>'.$stdName.'</td><td>'.$row->YearSemister.'</td><td>'.anchor("adviser/ShowStudentDetails/{$stdId}/{$stdName}", 'View Details', array('class' => 'submit'))."<span style='color:{$color}'> [{$status}]</span>".'</td></tr>';
                     }
                    }else{
                        echo '<tr><td>asdfdfg</td><td>dsfgdghfh</td><td>dsafcsdfdsf</td><td>sdfdsdfgfdg</td></tr>';
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