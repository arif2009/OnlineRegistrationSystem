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
                <?php
                    $receiveNo = form_label('Receive No :','txtReceiveNo');	
                    $data = array(
                        'name'        => 'txtReceiveNo',
                        'id'          => 'txtReceiveNo',
                        'value'       => set_value('txtReceiveNo',''),
                        'maxlength'   => '30', //specify the maximum number of characters allowed in the <input> element
                        'Onblur'      => "this.style.background = '#FFFFFF';",
                        'onFocus'     => "this.style.background = '#FFCCCC';",
                        'onClick'     => "this.style.background = '#FFCCCC';"
                    );
                    $receiveNo .= form_input($data);
                ?>
                <div align="center">
                <table class="subjectContainer">
                    <?php $attributes = array('OnSubmit' => 'return ReceiveRadioValidation()', 'id' => 'courseRegistration', 'name' =>'courseRegistration', 'method' =>'post');
                    echo form_open('student/ApplyForRegistration',$attributes); ?>
                    <tr><td style="float: left">Subject List :</td><td style="float: right"><?=$receiveNo?></td></tr>
                    <?php
                    $checked = FALSE;
                     foreach ($requiredSubject as $row) {
                         $chkProperties = array( 
                                'name'    => $row['SubjectCode'],
                                'id'      => 'chkBox',
                                'value'   => "'{$stdId}','{$row['SubjectCode']}','{$row['SubjectOfYear']}','{$row['SubjectOfSemister']}',{$row['Cardit']},'requested'",
                                'checked' => $checked
                          );
                         $chkAttribute = $row['SubjectTitle'].' (Cardit:'.$row['Cardit']." {$row['SubjectOfYear']}/{$row['SubjectOfSemister']})";
                         echo '<tr><td>'.form_checkbox($chkProperties).$chkAttribute.'</td></tr>';
                         
                         $totalSubjectArray[] = $row['SubjectCode']; 
                     }
                     $totalSubject = implode(',', $totalSubjectArray);
                     
                     //Hidden field for submit totalSubject as string
                     echo form_hidden('totalSubject', $totalSubject);
                     
                     $checkAll = array(
                        'name'      => 'btnCheckAll',
                        'id'        => 'btnCheckAll',
                        'value'     => 'Checked All',
                        'type'      => 'button',
                        'class'     => 'checkAll',
                        'onClick'   => 'CheckAll(document.courseRegistration.chkBox)'
                    );
                    $submit = array(
                        'name'      => 'btnSubmit',
                        'id'        => 'btnSubmit',
                        'value'     => 'Submit',
                        'class'     => 'checkAll'
                    );
                echo '<tr><td>'.form_submit($submit).''.form_input($checkAll).'</td></tr>';
                    ?>
                    <?=form_close()?>
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