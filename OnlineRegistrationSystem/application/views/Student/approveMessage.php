<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register Section</title>
        <?php $this->load->view('commonCSS');?>
        <?=link_tag('css/student.css')?>
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
                    <?php
                        if(is_array($message)){
                            $failedSubject = '<div align="center">';
                            $failedSubject .= '<table class="adviserTable">';
                            $failedSubject .= '<th scope="colgroup" colspan="2">Failed Subject</th>';
                            $failedSubject .= '<tr><td>Subject Code</td><td>Subject Name</td></tr>';
                            echo $failedSubject;
                            foreach ($message as $row) {
                                echo '<tr><td>'.$row->SubjectCode.'</td><td>'.$row->SubjectTitle.'</td><tr>';
                            }
                            $failedSubject = '</table>';
                            $failedSubject .= '</div>';
                            echo $failedSubject;
                        }else{
                            echo '<div class="description" style="color:'.$color.'">'.$message.'</div>';
                        }
                    ?>
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