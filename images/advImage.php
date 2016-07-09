<?php
  # database info
  $mysql_server = 'localhost';
  $mysql_user = 'arif';
  $mysql_password = 'arif';
  $mysql_database = 'dbonlineregistration';
  
  # connect to db
  $link = mysql_connect($mysql_server,$mysql_user,$mysql_password) or die('Failed connecting database!');
  mysql_select_db($mysql_database,$link) or die("Database <b>{$mysql_database}</b> not found!");
  
  #set unicode charecter set
  mysql_query('set names=utf-8;');
  
  $file_id = isset($_GET['file_id'])? $_GET['file_id']:0;
  $query = 
  "
    select 
    	Image,FileSize,FileType
    from
      adviser_image
    where
      AdviserId = '{$file_id}'
  ";
  $result = mysql_query($query,$link);
  
  if(mysql_num_rows($result) > 0){
      
    $row = mysql_fetch_assoc($result);
    mysql_free_result($result);
    
    $file_data = $row['Image'];
    $file_size = $row['FileSize'];
    $file_type = $row['FileType'];
    
    header('Content-Type: '.$file_type);
    header('Content-Length: '.$file_size);
    
    echo $file_data;
    
    exit();
  }
  