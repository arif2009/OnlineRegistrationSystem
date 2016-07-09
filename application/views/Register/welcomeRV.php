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
                <legend id="first-legend"><?=$legend?></legend>
                <?=form_fieldset($legend_text = 'NUMBER OF ADVISER')?> 
                <table class="calculationTable">
                <tbody>
                <?php  
                foreach($tableAdv['advPerDept'] as $row){
                    echo '<tr>';
                    echo '<td>'.$row->DepartmentName.' : </td><td>'.$row->NumOfAdv.'</td>';
                    echo '</tr>';
                }
                ?>
                <tr><td>TOTAL</td><td id="last-td"><?=$tableAdv['advAll']?></td></tr>
                </tbody> 
                </table> 
                <?=form_fieldset_close()?>
                    
                <?=form_fieldset($legend_text = 'NUMBER OF STUDENT')?>
                <table class="calculationTable">
                <tbody>
                <?php  
                foreach($tableStd['stdPerDept'] as $row){
                    echo '<tr>';
                    echo '<td>'.$row->DepartmentName.' : </td><td>'.$row->NumOfStd.'</td>';
                    echo '</tr>';
                }
                ?>
                <tr><td>TOTAL</td><td id="last-td"><?=$tableStd['stdAll']?></td></tr>
                </tbody> 
                </table>
                <?=form_fieldset_close()?>
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
