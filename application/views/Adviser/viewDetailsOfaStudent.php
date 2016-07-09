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
                <?php
                    $receiveNo = form_label('Receive No :','txtReceiveNo');	
                    $data = array(
                        'name'        => 'txtReceiveNo',
                        'id'          => 'txtReceiveNo',
                        'value'       => set_value('txtReceiveNo',$receiveId),
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
                    echo form_open('adviser/AcceptOrDenyRegistration',$attributes); ?>
                    <tr><td style="float: left">Subject List :</td><td style="float: right"><?=$receiveNo?></td></tr>
                    <?php
                     foreach ($requiredSubjectDetails as $row) {
                         $subjectCode = $row->SubjectCode;
                         $checked = in_array($subjectCode, $takenSubject)? TRUE : FALSE;
                         $chkProperties = array( 
                                'name'    => $subjectCode,
                                'id'      => 'chkBox',
                                'value'   => "'{$stdId}','{$row->SubjectCode}','{$row->SubjectOfYear}','{$row->SubjectOfSemister}',{$row->Cardit}",
                                'checked' => $checked
                          );
                         $chkAttribute = $row->SubjectTitle.' (Cardit:'.$row->Cardit.$row->SubjectOfYear.'/'.$row->SubjectOfSemister.')';
                         echo '<tr><td>'.form_checkbox($chkProperties).$chkAttribute.'</td></tr>';
                     }
                     
                     //Hidden field for submit studentId and studentName as string
                     echo form_hidden('id', $stdId);
                     echo form_hidden('name', $stdName);
                     $deny = array(
                        'name'      => 'btnDeny',
                        'id'        => 'btnDeny',
                        'value'     => 'Deny',
                        'class'     => 'deny'
                    );
                    $accept = array(
                        'name'      => 'btnAccept',
                        'id'        => 'btnAccept',
                        'value'     => 'Accept',
                        'class'     => 'submit'
                    );
                    echo '<tr><td>'.form_submit($deny).form_submit($accept).anchor('Login/TeacherHome', '<< Go Back', array('class' => 'back')).'</td></tr>';
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