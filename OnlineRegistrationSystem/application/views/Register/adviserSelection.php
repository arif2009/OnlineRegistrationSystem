<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register Section</title>
        <?php $this->load->view('commonCSS');?>
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
            
            <?php $attributes = array('id' => 'adviserSelection', 'name' =>'adviserSelection', 'method' =>'post');
                echo form_open('register/SelectAdviser',$attributes); ?>
            
            <?php
            $table = '<div align="center">';
            $table .= '<table class="table">';
            $table .= '<tbody>';
            ?>
            
            <?php
            $table .= '<tr>';
            $table .= '<td width="140px" align="right">Department:</td>';
            $table .= '<td width="366px" align="left">';
            
            $options = array('default'  => 'Select Department');
            $CI = &get_instance();
            $CI->load->model('Register/dataViewRM');
            $departmentTable = $CI->dataViewRM->GetAllDepartment();
            foreach ($departmentTable as $row) {
                $options[$row->DepartmentId] = $row->DepartmentName;
            }
                
            $js = 'id="optdept" tabindex = "0"';
            $table .= form_dropdown('optdept', $options, 'default',$js);
            $table .= '</td>';
            $table .= '</tr>';
            ?>
            
            <?php
            /*$table .= '<tr>';
            $table .= '<td >Year:</td>';
            $table .= '<td >';
            $options = array('first' => 'First',
                             'second' => 'Second',
                             'third'  => 'Third',
                             'fourth' => 'Fourth');
            $js = 'id="optyear" tabindex = "1"';
            $table .= form_dropdown('optyear', $options, 'first',$js);
            $table .= '</td>';
            $table .= '</tr>';
            ?>
            
            <?php
            $table .= '<tr>';
            $table .= '<td align="right">Semester:</td>';
            $table .= '<td align="left">';
            $options = array('first' => 'First',
                             'second' => 'Second');
            $js = 'id="optsemester" tabindex = "2"';
            $table .= form_dropdown('optsemester', $options, 'first',$js);
            $table .= '</td>';
            $table .= '</tr>';*/
            ?>
            
            <?php
            $table .= '<tr>';
            $table .= '<td align="right">Adviser Name: </td>';
            $table .= '<td align="left">';
            $options = array('default'  => 'Select Adviser');
            $table .= '<div id="txtHint">'.form_dropdown('optAdviser', $options, 'default').'</div>';
            $table .= '</td>';
            $table .= '</tr>';
            ?>
            
            <?php
            $table .= '<tr>'; 
            $table .= '<td align="right">Student Range: </td>';  
            $table .= '<td align="left">';
            $startId = array(
                        'name'    => 'txtstart',
                        'id'      => 'txtstart',
                        'minlength'   => '6',
                        'maxlength'   => '6');
            $endId = array(
                        'name'    => 'txtend',
                        'id'      => 'txtend',
                        'minlength'   => '6',
                        'maxlength'   => '6');
            $table .= form_input($startId).' - '.form_input($endId);
            $table .= '</td>';
            $table .= '</tr>';
            ?> 
            
            <?php
            $table .= '<tr>';
            $table .= '<td align="right">Extra Student: </td>';
            $table .= '<td align="left">';
            $data = array(
                        'name'    => 'txtextra',
                        'id'      => 'txtextra');
            $table .= form_input($data).'(Seperating by coma)';
            $table .= '</td>';
            $table .= '</tr>';
            ?>
            
            <?php
            $table .= '<tr>';
            $table .= '<td align="right">&nbsp;</td>';
            $table .= '<td align="right">';
            $submit = array(
                        'name'        => 'select',
                        'id'          => 'select',
                        'value'       => 'Select'
                        );
            $reset = array(
                        'name'        => 'reset',
                        'id'          => 'reset',
                        'value'       => 'Reset'
                        );
            $table .= form_submit($submit).' '.form_reset($reset);
            $table .= '<td>';
            $table .= '</tr>';
            ?>
 
            <?php
            $table .= '</tbody>';
            $table .= '</table>';
            $table .= '</div>';
            echo $table;
            ?>
             
            <script type="text/javascript">
            $("select[name='optdept']").change(function() {
                var deptId = $(this).val();
                if (!deptId || deptId == 'default') {
                        alert('Please Select Department');
                        return false;
                }

                var form_data = {
                        deptId: $(this).val(),
                        ajax: '1'		
                };

                $.ajax({
                        url: "<?php echo site_url('register/GetAllAdviser'); ?>",
                        type: 'POST',
                        data: form_data,
                        success: function(msg) {
                              $('#txtHint').html(msg);
                        }
                });
                return false;
            });
            </script>
            
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
    
    <!--For showing Message-->
    <?php $this->load->view('message'); ?>
</body>