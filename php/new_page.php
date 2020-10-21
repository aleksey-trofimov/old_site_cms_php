<html>
<head>
<?php
  include"config.php";
  include"$base_path/common/css.htm";
?>

<?php error_reporting(E_ALL & ~E_NOTICE);?>


<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
</head>

<body topmargin=0 marginwidth=4 leftmargin=4 marginheight=0 bgcolor=#E1E1E1 class=text_common>
<br>
<?php
 $db = mysql_connect("localhost", " ", " ");
 mysql_select_db("paloma",$db);

/*----------------------------------------Вносим страницу в базу-------------------------------------------*/

if($text_name || $text_content || $text_menu_title || $priority)
{
 $result = mysql_query("INSERT INTO records (PARENT_ID, PRIORITY, NAME, CONTENT, PHP_MENU_NAME, EDIT_DATE, ENTRY_DATE) VALUES ('$parent', '$priority', '$text_name', '$text_content', '$text_menu_title', NOW(), NOW() )");
 if($result)
 {
  echo("Страница внесена в базу.");
  //Формируем путь к каталогу записи
  $record_path;

  $result_img1 = mysql_query("SELECT ID, PARENT_ID FROM records ORDER BY id DESC",$db)
   or die("Invalid query: " . mysql_error());

  mysql_num_rows($result_img1);
  
  $myrow_img1 = mysql_fetch_array($result_img1) ;
  $s_id1 = $myrow_img1["ID"];
  $s_parent_id1 = $myrow_img1["PARENT_ID"];
////////////////////////////////////////////////////////////
//  echo("s_id1:$s_id1:");
  $result_img2 = mysql_query("SELECT ID, PARENT_ID FROM records WHERE id=$s_parent_id1 ORDER BY id",$db)
   or die("Invalid query: " . mysql_error());

  if( mysql_num_rows($result_img2) )
  {
   $myrow_img2 = mysql_fetch_array($result_img2) ;
   $s_id2 = $myrow_img2["ID"];
   $s_parent_id2 = $myrow_img2["PARENT_ID"];

   ///////////////////////////////////////////////////////
//   echo("s_id2:$s_id2:");

   $result_img3 = mysql_query("SELECT ID, PARENT_ID FROM records WHERE id=$s_parent_id2 ORDER BY priority",$db)
    or die("Invalid query: " . mysql_error());

   if( mysql_num_rows($result_img3) )
   {
    $myrow_img3 = mysql_fetch_array($result_img3) ;
    $s_id3 = $myrow_img3["ID"];
    $s_parent_id3 = $myrow_img3["PARENT_ID"];
   ///////////////////////////////////////////////////////
//   echo("s_id3:$s_id3:");

//////////////////////////////////////////
    $result_img4 = mysql_query("SELECT ID, PARENT_ID FROM records WHERE id=$s_parent_id3 ORDER BY priority",$db)
    or die("Invalid query: " . mysql_error());

    if( mysql_num_rows($result_img4) )
    {
     $myrow_img4 = mysql_fetch_array($result_img4) ;
     $s_id4 = $myrow_img4["ID"];
     $s_parent_id4 = $myrow_img4["PARENT_ID"];
   ///////////////////////////////////////////////////////
//   echo("s_id4:$s_id4:");

     //Запись четвертого уровня. формируем путь
     $record_path = "$dir/$s_id4/$s_id3/$s_id2/$s_id1";
//     $level = 4;
    }
    else
    {
     //Запись третьего уровня. формируем путь
     $record_path = "$dir/$s_id3/$s_id2/$s_id1"; 
//     $level = 3;
    }
   }
   else
   {
    //Запись второго уровня. формируем путь
    $record_path = "$dir/$s_id2/$s_id1"; 
//    $level = 2;
   }

  }
  else
  {
   //Запись первого уровня. формируем путь
   $record_path = "$dir/$s_id1";
//   $level = 1;
  }
  //Создаем каталог записи
  mkdir("$record_path");
 }
////////////////////////////////////////////////////

 else
  echo("Ошибка! Страница не внесена в базу.");
}
/*--------------------------------------------------------------------------------------------------*/
  
?>

<center><b>
Создание новой страницы</b>
<br><br>
</center>
<form enctype="multipart/form-data" method="post" action="<?php echo"$PHP_SELF?dir=$dir&parent=$parent" ?>" >

<table border=0 cellspacing=0 cellpadding=0 class=text_common>

<tr>
<td width=137>Заголовок</td>
<td>
<textarea cols=100 name=text_menu_title rows=3 maxlength=1000 class=text_common></textarea>
<!--<input type=text name=text_menu_title size=97 value="" maxlength=300 class=text_common>-->
</td>
</tr>

<?php // if($level != 4){?>
<tr>        
<td width=137>Приоритет в списке</td>
<td><input type=text cols=5 name=priority value="" maxlength=5 class=text_common></td>
</tr>
<?php // } ?>

<tr>
<td width=137>Анонс</td>
<td>
<textarea cols=100 name=text_name rows=5 maxlength=1000 class=text_common></textarea>
<!--<input type=text size=97 name=text_name value="" maxlength=300 class=text_common>-->
</td>
</tr>

<!-- <tr>
<td width=137>Текст страницы</td>
<td><textarea cols=100 name=text_content rows=25 maxlength=10000 class=text_common></textarea></td>
</tr>-->

<tr>
<td width=137></td>
<td><br>

 <table border=0 cellspacing=0 cellpadding=0 class=text_common>
 <tr>
 <td width=90>
 <input type="Submit" name="submit_page" value="Создать" class=text_common></form>
 </td>

 </tr>
 </table>

</td>
</tr>

</table>

</body>
</html>