<html>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
<?php
  include"config.php";
  include"$base_path/common/css.htm";
  $db = mysql_connect("localhost", " ", " ");
  mysql_select_db("paloma",$db);


  ////// ��������� ���� � �������� ���������
  $result_img1 = mysql_query("SELECT ID, PARENT_ID FROM records WHERE id=$r_id",$db)
   or die("Invalid query: " . mysql_error());

  $myrow_img1 = mysql_fetch_array($result_img1) ;
  $s_id1 = $myrow_img1["ID"];
  $s_parent_id1 = $myrow_img1["PARENT_ID"];
  $result_img2 = mysql_query("SELECT ID, PARENT_ID FROM records WHERE id=$s_parent_id1",$db)
   or die("Invalid query: " . mysql_error());

  if (mysql_num_rows($result_img2) ) 
  { 
   $myrow_img2 = mysql_fetch_array($result_img2) ;
   $s_id2 = $myrow_img2["ID"];
   $s_parent_id2 = $myrow_img2["PARENT_ID"];

   $result_img3 = mysql_query("SELECT ID, PARENT_ID FROM records WHERE id=$s_parent_id2",$db)
    or die("Invalid query: " . mysql_error());

   if( mysql_num_rows($result_img3) )
   {
    $myrow_img3 = mysql_fetch_array($result_img3) ;
    $s_id3 = $myrow_img3["ID"];
    $s_parent_id3 = $myrow_img3["PARENT_ID"];
 
    $result_img4 = mysql_query("SELECT ID, PARENT_ID FROM records WHERE id=$s_parent_id3",$db)
    or die("Invalid query: " . mysql_error());

    if( mysql_num_rows($result_img4) )
    {
     $myrow_img4 = mysql_fetch_array($result_img4) ;
     $s_id4 = $myrow_img4["ID"];
     $s_parent_id4 = $myrow_img4["PARENT_ID"];

     //������ ���������� ������. ��������� ����
     $record_path = "$dir/$s_id4/$s_id3/$s_id2/$s_id1"; 
     $record_site_path = "$s_id4/$s_id3/$s_id2/$s_id1"; 
    }
    else
    {
     //������ �������� ������. ��������� ����
     $record_path = "$dir/$s_id3/$s_id2/$s_id1"; 
     $record_site_path = "$s_id3/$s_id2/$s_id1"; 
    }
   }
   else
   {
    //������ ������� ������. ��������� ����
    $record_path = "$dir/$s_id2/$s_id1"; 
    $record_site_path = "$s_id2/$s_id1"; 
   }
  }
  else
  {
   //������ ������� ������. ��������� ����
   $record_path = "$dir/$s_id1";
   $record_site_path = "$s_id1"; 
  }
//////////////////////////////////////////// ��������� 8-)
  $ext_record_path=str_replace("/home/vir/paloma","",$record_path);

  ///������ �������� � ��� �������� ���� � �������� ��������� Tiny
  print"<form name='base' method='POST' action=''>
        <input type='hidden' name='dual' value='$ext_record_path'>
        </form>";

  include('editor.php');
?>

<?php error_reporting(E_ALL & ~E_NOTICE);?>


<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
</head>

<?php

if($delete_page)
{
 //���������, ���� �� �������

 $result = mysql_query("SELECT * FROM records WHERE parent_id=$r_id",$db);
 if( mysql_num_rows($result) )
 {
  echo("������ ������� ��� ������, ��� ��� ��� �������� ��������� ������");
 }
 else
 {
  //����� �������� ������� � ��� ��������

  $droot = opendir("$record_path");
  if(!$droot)
  {
   echo("Can not open directory to delete");
  }
  else
  {
   while($root_entry = readdir($droot)) 
   {
    if( $root_entry != '.' &&
        $root_entry != '..')
    {
     unlink("$record_path/$root_entry");
    }
   }
  }
  closedir($droot);

//��������� �������� ��������� ��������

  if( ($r_id!=2) && ($r_id!=3) )
  {
   rmdir("$record_path");

   $result = mysql_query("DELETE FROM records WHERE id=$r_id");
   echo("<center>�������� ���� �������.</center>") ;
  }
  else
  {
   echo("������ ������� ���� ������ ����� web-���������. ���������� � ������������.");
  }
 }
} 
else
{
?>

<body topmargin=0 marginwidth=4 leftmargin=4 marginheight=0 bgcolor=#E1E1E1 class=text_common>
<?php

/*----------------------------------------��������� �����-------------------------------------------*/

 if($text_name || $text_content || $text_menu_title || $priority || $text_date )
 {
  if( $lang =="ru")
  {
   $result = mysql_query("UPDATE records SET ENTRY_DATE='$text_date', PRIORITY='$priority', NAME='$text_name', CONTENT='$text_content', PHP_MENU_NAME='$text_menu_title', EDIT_DATE = NOW() WHERE id=$r_id");
  }

  if( $lang == "en")
  {
   $result = mysql_query("UPDATE records SET ENTRY_DATE='$text_date', PRIORITY='$priority', NAME_EN='$text_name', CONTENT_EN='$text_content', PHP_MENU_NAME_EN='$text_menu_title', EDIT_DATE = NOW() WHERE id=$r_id");
  }

}
/*--------------------------------------------------------------------------------------------------*/
  $result = mysql_query("SELECT ID, PARENT_ID, IS_CONTAINER, PRIORITY, PHP_MENU_STATUS, PHP_MENU_NAME, PHP_MENU_NAME_EN, ENTRY_DATE, EDIT_DATE, LINK_MENU_FLAG, NAME, NAME_EN, CONTENT, CONTENT_EN, MENU_PIC_PATH FROM records WHERE id=$r_id ORDER BY priority",$db)
   or die("Invalid query: " . mysql_error());

  $myrow = mysql_fetch_array($result) ;
  $s_id = $myrow["ID"];
  $s_parent_id = $myrow["PARENT_ID"];
  $s_is_container = $myrow["IS_CONTAINER"];
  $s_priority = $myrow["PRIORITY"];
  $s_php_menu_status = $myrow["PHP_MENU_STATUS"];
  $s_php_menu_name;
  $s_entry_date = $myrow["ENTRY_DATE"];
  $s_edit_date = $myrow["EDIT_DATE"];
  $s_link_menu_flag = $myrow["LINK_MENU_FLAG"];
  $s_name;
  $s_content;
  $s_menu_pic_path = $myrow["MENU_PIC_PATH"];

  if( $lang == "ru")
  {
   $s_php_menu_name = $myrow["PHP_MENU_NAME"];
   $s_name = $myrow["NAME"];
   $s_content = $myrow["CONTENT"];
  }

  if( $lang == "en")
  {
   $s_php_menu_name = $myrow["PHP_MENU_NAME_EN"];
   $s_name = $myrow["NAME_EN"];
   $s_content = $myrow["CONTENT_EN"];
  }


/*������ ������������ ������.*/
  $checkbox_status;
  if( $IS_CONTAINER_CHECKBOX_POSITIVE )
{
   $checkbox_status = 1;
}
  else
{
   $checkbox_status = 0;
}
  
  if( ($data_sent) && ( $s_is_container != $checkbox_status) && ($edit_type == 1) )
  {
   //���������, ��� �� � ������ ��������
   $test_children = mysql_query("SELECT ID FROM records WHERE parent_id=$r_id",$db)
    or die("Invalid query: " . mysql_error());

   if ( mysql_num_rows($test_children) ) 
   {
    echo("<b><font color=red>�������� �������� ��������� ��������, ��������� ������� ��������.</font></b>");
   }
   else
   {
    $result = mysql_query("UPDATE records SET IS_CONTAINER=$checkbox_status, PHP_MENU_STATUS=0  WHERE id=$r_id");
    $s_is_container = $checkbox_status;
   }
  }

?>
<table border=0 cellpadding=0 cellspacing=0>
<tr height=5><td></td></tr>
<!--<tr><td align=center>�������:<?php echo" $s_entry_date" ?>, ��������:<?php echo" $s_edit_date" ?></td></tr>-->
<tr height=5><td></td></tr>
<tr><td align=center>
<a href="<?php echo"$PHP_SELF?edit_type=1&r_id=$s_id&dir=$dir&lang=$lang" ?>">
[������������� �����]
</a>&nbsp;&nbsp;
<a href="<?php echo"$PHP_SELF?edit_type=2&r_id=$s_id&dir=$dir&lang=$lang" ?>">
[������������� �����������]
</a>&nbsp;&nbsp;

<form MARGINHEIGHT=0 enctype="multipart/form-data" method="post" action="<?php echo"$PHP_SELF?edit_type=$edit_type&r_id=$s_id&data_sent=1&dir=$dir&lang=$lang" ?>" >

<?php if( $s_is_container ) $checkbox_status = "checked"; else $checkbox_status = "unchecked"; ?>
<INPUT TYPE=CHECKBOX NAME="IS_CONTAINER_CHECKBOX_POSITIVE" <?php echo"$checkbox_status";?> >
&nbsp;�������� ����������&nbsp;&nbsp;
<a href="<?php echo"$PHP_SELF?edit_type=1&r_id=$s_id&dir=$dir&lang=ru" ?>">
<img src="img/rus.gif" border=0></a>
&nbsp;&nbsp;
<a href="<?php echo"$PHP_SELF?edit_type=1&r_id=$s_id&dir=$dir&lang=en" ?>">
<img src="img/eng.gif" border=0></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo("ask_delete.php?dir=$dir&edit_type=$edit_type&r_id=$r_id");?>"><font color=red>������� ��������</font></a>
</td></tr>
<tr><td align=left>
<!--<b>��������� �������� <?php echo"\"$s_php_menu_name\"" ?></b>-->
</td></tr>

<tr height=5><td></td></tr></table>
<!--<form MARGINHEIGHT=0 enctype="multipart/form-data" method="post" action="<?php echo"$PHP_SELF?edit_type=$edit_type&r_id=$s_id&data_sent=1&dir=$dir&lang=$lang" ?>" >-->
<?php

/*----------------------------------------�������� �����-------------------------------------------*/

 if($text_name || $text_content || $text_menu_title || $priority || $text_date)
 {
  echo("<center>���������� ��������</center>");
 }

/*-------------------------------������������ ���������� ��������-----------------------------------*/
//��������� ���������� � ���� � �������� ���������.
 if($menu_pic)
 { 
  $result = mysql_query("UPDATE records SET MENU_PIC_PATH='$menu_pic' WHERE id=$s_id");
  $s_menu_pic_path = $menu_pic;
 }
// ���������� ��������
 if(is_uploaded_file($new_picture))
 {
  $file_extension = substr($new_picture_name, -3);
  if( ($file_extension == "jpg") || ($file_extension == "JPG") )
  {
//���� ��������� ��� ���� ����� ���� ������������...

   $FileNoExtension = substr($new_picture_name, 0, -4);
   //��������� _large � ����� �����
   //������ ������ ��������� ������
   $filename_large = join("", array($record_path, '/', $FileNoExtension, "_large.jpg") );
   copy($new_picture, $filename_large);
   //������ ���� ���� �� �������, ����� � ��� ��������

   // �������� ������ ��������� �����������
   list($width, $height) = GetImageSize($filename_large);

   if( ($width > 520) )
   {
    //������ ������� ��������, ���� ������!
    $new_width = 520;
    $new_height= round(520*$height/$width);
    $image_large = ImageCreate($new_width, $new_height);//ImageCreateTrueColor - ����� ���������
    $image_old = ImageCreateFromJpeg($filename_large);

    //ImageCopyResampled - ����� ���������
    ImageCopyResized($image_large, $image_old, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    unlink($filename_large);
    ImageJpeg($image_large, $filename_large, 80);
   }

   // ��������� ����������� ����� �����������
   list($width, $height) = GetImageSize($filename_large);
   $new_width = 133;
   $new_height= round(133*$height/$width);


   $FileNoExtension = substr($filename_large, 0, -10);
   $filename_small = join("", array( $FileNoExtension, "_small.jpg") );

   $image_small = ImageCreate($new_width, $new_height);//ImageCreateTrueColor - ����� ���������
   $image_old = ImageCreateFromJpeg($filename_large);
   ImageCopyResized($image_small, $image_old, 0, 0, 0, 0, $new_width, $new_height, $width, $height);  
   ImageJpeg($image_small, $filename_small, 80);
   echo("<center>����������� ���������</center>");
  }

//����������� ����� ������
  if( ($file_extension == "wmv") || ($file_extension == "avi") || ($file_extension == "mpg")
   || ($file_extension == "WMV") || ($file_extension == "AVI") || ($file_extension == "MPG") )
  {
   $video_name = join("", array($record_path, '/', $new_picture_name) );
   copy($new_picture, $video_name);
  }

 }

// �������� ��������

 if($delete_picture)
 {
  if(file_exists("$delete_picture"))
  {
   unlink("$delete_picture");
   $delete_picture_begin = substr($delete_picture, 0, (strlen($delete_picture)-10) ); 
   $delete_picture_construst = join("", array($delete_picture_begin, "_large.jpg") );
   unlink("$delete_picture_construst");
  }
  echo("<center>����������� �������</center>"); ///???DIR
 }
?>

<table border=0 cellspacing=0 cellpadding=0 class=text_common>

<?php
 if($edit_type == 1)
 {
/*----------------------------------------����������� �����-----------------------------------------*/
?>

<tr>
<td width=137>���������</td>
<td>
<textarea cols=100 name=text_menu_title rows=1 maxlength=1000 class=text_common><?php echo("$s_php_menu_name");?></textarea>
<!--<input type=text name=text_menu_title size=97 value="<?php echo("$s_php_menu_name"); ?>" maxlength=300 class=text_common>-->
</td>
</tr>

<?php// if( $s_is_container ){?>
<tr>        
<td width=137>��������� � ������</td>
<td><input type=text cols=5 name=priority value="<?php echo("$s_priority"); ?>" maxlength=5 class=text_common></td>
</tr>
<?php// } ?>

<?php
/*
 if( $s_is_container )
  {
   $checkbox_status = "checked";
  }
  else
  {
   $checkbox_status = "unchecked";
  }
*/
?>

<tr>
<td width=137>�����</td>
<td>
<textarea cols=100 name=text_name rows=2 maxlength=1000 class=text_common><?php echo("$s_name");?></textarea>
</td>
</tr>

<tr>
<td width=137>���� ���������</td>
<td><input type=text size=97 name=text_date value="<?php echo("$s_entry_date");?>" maxlength=300 class=text_common></td>
</tr>

<tr>
<td colspan=2>
<textarea cols=130 name=text_content rows=27 maxlength=10000 class=text_edit><?php echo("$s_content");?></textarea>
</td>
</tr>

<?php
}
if($edit_type == 2)
{
?>

<?php
/*-------------------------------------����������� �����������--------------------------------------*/
$droot = opendir("$record_path");
$radio_number=1;

 while($root_entry = readdir($droot)) 
 {
  if( $root_entry != '.' &&
      $root_entry != '..')
   {
    if( !is_dir("$record_path/$root_entry") )
    {
     /*����� ����*/
     $file_extension = substr($root_entry, -10); 
     $vid_ext = substr($root_entry, -3); 
     if( ($file_extension == "_small.jpg") || ($vid_ext == "avi") || ($vid_ext == "mpg")
      || ($vid_ext == "wmv") || ($vid_ext == "AVI") || ($vid_ext == "MPG") || ($vid_ext == "WMV") )
     {

?>
<tr> 
<td width=137><?php echo("/$record_site_path/$root_entry") ?>
<br>
<a href="<?php echo("$PHP_SELF?dir=$dir&r_id=$r_id&edit_type=$edit_type&delete_picture=$base_path/$record_site_path/$root_entry");?>">�������</a>
</td>
<td> 
<br>
<img src="
<?php
      if($file_extension == "_small.jpg")
       echo("/$record_site_path/$root_entry"); 
      else
       echo("/img/video_file.jpg"); 
?>">

<?php
      if($file_extension == "_small.jpg")
      {
?>
<input type=radio Name="menu_pic" value="<?php echo("$record_site_path/$root_entry"); ?>" id="menupic"
<?php
 if($s_menu_pic_path == "$record_site_path/$root_entry" ) echo("checked"); else echo("unchecked"); ?>>&nbsp;<label for="menupic">��������� � ���������</label>
<?php }?>
</td>
</tr>
<?php
     }

    }
   }	
 }
closedir($droot);

?>
 
<tr> 
<td width=137><br>�������� ����������� ��� �����.<br>����� .jpg .avi .mpg .wmv</td>
<td> 
<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
<input type="file" size=50 name="new_picture" maxlength=255 class=text_common>
</td></tr>
<tr height=5><td colspan=2></td></tr>
<?php
}
?>
<tr height=5><td colspan=2></td></tr>

<?php if($edit_type != 1)
  {     ?>

<tr>
<td width=137></td>
<td>
 <table border=0 cellspacing=0 cellpadding=0 class=text_common>
 <tr>
 <td width=180>

<input type="Submit" name="submit_page" value="��������/��������" class=text_common>

 </td>
 </tr>
 </table>

</td>
</tr>
<?php } ?>

</table>
  </form>

<?php }//after delete page ?>

</body>
</html>
