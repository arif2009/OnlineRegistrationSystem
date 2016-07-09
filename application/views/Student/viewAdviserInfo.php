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
                <div align="center">
                    <table class="stdInfoTable">
                        <?php
                        $bgcolor = '#FFCCCC';
                        if(isset($adviserInfo[0])){
                            foreach($adviserInfo[0] as $key => $value){
                                if($key != 'pictureId'){
                                    echo "<tr bgcolor=\"$bgcolor\"><td>".$key.'</td><td>'.$value.'</td></tr>';
                                    $bgcolor = ($bgcolor == '#FFCCCC')? '#99FF66':'#FFCCCC';
                                }
                                else{
                                    $image_properties = array(
                                            'src'   => "images/advImage.php?file_id={$value}",
                                            'alt'   => 'Image Not Uploaded',
                                            'width' => '400',
                                            'height'=> '300'
                                    );
                                    echo '<tr><td colspan="2"'.img($image_properties).'</td></tr>';
                                }
                            }
                        }
                        else{
                            echo "<tr><td bgcolor=$bgcolor style=\"text-align:center\">Your adviser not select yet.</td></tr>";
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
</body>