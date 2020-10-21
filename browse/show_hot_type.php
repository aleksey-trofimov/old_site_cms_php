<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">

<title>Туристическая фирма Палома Турс</title>

<style type="text/css">
body{font-family:Arial,Helvetica,sans-serif;color:#006033;background:#E6EDA8; padding-top: 10px;}
.text_news_header { COLOR: #525152; FONT-SIZE: 15px; FONT-STYLE: normal; font-weight: bold; FONT-FAMILY: Helvetica; TEXT-DECORATION: none;}
.text_verdana { FONT-SIZE: 14px; FONT-STYLE: normal; FONT-FAMILY: Helvetica; TEXT-DECORATION: none}

.content_table {padding-left: 9px; padding-top: 0px; padding-bottom: 0px; padding-right: 9px;}
.menu_text { padding-left: 5px; padding-top: 3px; padding-bottom: 3px; FONT-SIZE: 15px; COLOR: #FFFFFF; font-weight: bold;}
.menu_text1 { padding-left: 0px; padding-top: 0px; padding-bottom: 0px; FONT-SIZE: 15px; COLOR: #FFFFFF; font-weight: bold;}
.menu_text2 { padding-left: 5px; padding-top: 3px; padding-bottom: 3px; FONT-SIZE: 15px; COLOR: #000000; font-weight: bold;}
.menu_link { padding-left: 0px; padding-top: 3px; padding-bottom: 3px; FONT-SIZE: 15px; COLOR: #FFFFFF; font-weight: bold; text-decoration: none;}
.menu_text_black { padding-left: 0px; padding-top: 0px; padding-bottom: 0px; FONT-SIZE: 12px; COLOR: #000000; font-weight: bold;}
.large_text { padding-left: 0px; padding-top: 3px; padding-bottom: 3px; FONT-SIZE: 22px; COLOR: #FFFFFF; font-weight: bold;}
.tour_name { padding-left: 0px; padding-top: 3px; padding-bottom: 3px; FONT-SIZE: 20px; COLOR: #ED008C; font-weight: bold; text-decoration: none;}
.tour_desc { padding-left: 0px; padding-top: 3px; padding-bottom: 3px; FONT-SIZE: 14px; COLOR: #ED008C; font-weight: bold;}
.hot_tour_name { padding-left: 0px; padding-top: 3px; padding-bottom: 3px; FONT-SIZE: 20px; COLOR: #00703B; font-weight: bold; text-decoration: none;}
.hot_tour_desc { padding-left: 0px; padding-top: 3px; padding-bottom: 3px; FONT-SIZE: 14px; COLOR: #00703B; font-weight: bold;}
.tours_down_menu_text { padding-left: 7px; padding-top: 3px; padding-bottom: 3px; padding-right: 7px; FONT-SIZE: 12px; COLOR: #ED008C; font-weight: normal;}
.hot_down_menu_text { padding-left: 7px; padding-top: 3px; padding-bottom: 3px; padding-right: 7px; FONT-SIZE: 12px; COLOR: #00703B; font-weight: normal;}

.text_menu { COLOR: #000000; FONT-SIZE: 13px; FONT-STYLE: normal; font-weight: bold; TEXT-DECORATION: none;}
.text_red_header { COLOR: #FF0000; FONT-SIZE: 13px; FONT-STYLE: normal; font-weight: bold; TEXT-DECORATION: none;}
.text_red_small_header { COLOR: #FF0000; FONT-SIZE: 11px; FONT-STYLE: normal; font-weight: bold; TEXT-DECORATION: none;}
.text_news { COLOR: #000000; FONT-SIZE: 11px; FONT-STYLE: normal; font-weight: normal; TEXT-DECORATION: none;}
.text_main_content { COLOR: #000000; FONT-SIZE: 12px; FONT-STYLE: normal; font-weight: normal; TEXT-DECORATION: none;}
.text_copyright { COLOR: #000000; FONT-SIZE: 10px; FONT-STYLE: normal; font-weight: normal; TEXT-DECORATION: none;}
A.menu_link { COLOR: #00000; TEXT-DECORATION: none}
A { COLOR: #00703B; TEXT-DECORATION: underline}

/*Стили для отображения меню*/
ul.mapps { font-size:11pt; font-weight:bold; margin: 0px; padding: 0px; width: 100%; list-style: none; background: #ffffff;}
ul li ul li.mapps { font-size:10pt; font-weight:bold; padding-bottom: 5px; margin: 0px; padding-left: 5px; TEXT-DECORATION: none; background: #FFFFFF;  }

ul li a.mapps_text { vertical-align: top; width: 100%; display: block; padding-left: 6px;}
ul li ul li a.mapps_text { width: 100%; display: block; padding: 0px; }

  
/*Раскрашиваем буковки */
ul li a:hover.mapps_text { color: #ffffff; background: #cccccc;}
ul li a:visited.mapps_text { color: #ffffff;}
ul li a:active.mapps_text { color: #ffffff; background: #4975C1;}
ul li a:link.mapps_text { color: #ffffff; background: #4975C1; }

ul li ul li a:hover.mapps_text { color: #6633cc; background: #cccccc; }
ul li ul li a:visited.mapps_text { color: #6633cc; }
ul li ul li a:active.mapps_text { color: #6633cc; background: #4975C1; }
ul li ul li a:link.mapps_text { color: #6633cc; background: #FFFFFF; }

</style>
</head>
<body leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center>

<table width="830" height="500" border=0 cellpadding=0 cellspacing=0 bgcolor="#E6EDA8">
 <tr>

 <td width="260" valign="top" border="0">
<!--  <img src="/common/img/tours_logo.jpg" width="260" height="84" border="0" style="display:block; margin:0;">-->
   <table width="260" height="550" border=0 cellpadding=0 cellspacing=0 bgcolor="#D4E27E">
  <tr height="125">
   <td colspan="3" background="/common/img/hot_logo.jpg" style="padding-left: 10px; padding-top: 0px;">
<a href="http://paloma.ellink.ru">
<div style="width: 250px; height: 70px;"></div>
</a>

    <font class="large_text">Горячие<br>ПРЕДЛОЖЕНИЯ</font></td></tr>
  <tr>   
   <td width="5" border="0" background="/common/img/hot_border_left.jpg"></td>
   <td width="250" border="0" valign="top" class="menu_text" style="background: url(../common/img/hot_gradient.jpg) repeat-x;">
<div style="height: 5px;"><!-- --></div>
<?php
 $server_path = "/home/vir/paloma";
 
 $db = mysql_connect("localhost", " ", " ");
 mysql_select_db("paloma",$db);

 $variants_list = mysql_query("SELECT id, name FROM records WHERE parent_id=163 ORDER BY priority",$db)
   or die("Invalid query: " . mysql_error());

//Отображаем список вариантов туров

 if( $variants_list )
 {
  while ( $variant = mysql_fetch_array($variants_list) )
  {
   $variant_name = $variant["name"];
   $variant_id = $variant["id"];
   echo("<a class=\"menu_link\" href=\"http://paloma.ellink.ru/browse/show_hot_type.php?var_id=$variant_id\">$variant_name</a>");
   echo("<br>");
  }
 }

?>

<div style="height: 10px;"><!-- --></div>

<img src="/common/img/hot_menu_seapic.jpg" /><br>
<div style="height: 10px;"><!-- --></div>

<a href="http://paloma.ellink.ru/browse/show_hot_type.php?var_id=227" style="text-decoration: none;"><font class="large_text">СЛОВО ДИРЕКТОРА</font><div style="height: 5px;"></a>
<br>
<a href="http://paloma.ellink.ru/browse/show_hot_type.php?var_id=228" style="text-decoration: none;"><font class="large_text">КОНТАКТЫ</font><div style="height: 5px;"></a>

<br><br><br><br><br><br><br><br><br><br>
<!--<font class="menu_text_black">
С древнейших времен славится город 
красотой. "А о Плескове-граде не обретается 
быть вспомянуто, от кого бысть создан и 
которыми людьми". Псков - один из 
древнейших городов Руси, который 
упоминается в "Повести временных лет".
</font>-->

     </td>
     <td width="5" border="0" background="/common/img/hot_border_right.jpg"></td>
    </tr>
   </table>
  <img src="/common/img/hot_menu_bottom.jpg" width="260">

<!--////////////////////////////////////////////////////////////////////////////// -->
<div style="height: 10px;"></div>

  <img class="system" src="/common/img/hot_contact_up.jpg" width="261" height="15" border="0" style="display:block; margin:0;">
   <table width="260" height="50" border=0 cellpadding=0 cellspacing=0 bgcolor="#d4e280">
    <tr>   
     <td width="5" border="0" background="/common/img/hot_border_left.jpg"></td>
     <td width="250" border="0" valign="top" class="menu_text2" bgcolor="#d4e280">
<?php
 $contacts = mysql_query("SELECT content FROM records WHERE id=103",$db)
   or die("Invalid query: " . mysql_error());

 $_contacts = mysql_fetch_array($contacts);
 $contacts_content = $_contacts["content"];

 echo($contacts_content);
?>

</td>
     <td width="5" border="0" background="/common/img/hot_border_right.jpg"></td>
    </tr>
   </table>
  <img class="system" src="/common/img/hot_contact_down.jpg" width="260">
 </td>

<!--///////////////////////////////////////////////////////////////////////////////// -->


 </td>
 <td width="10"></td>

 <td valign="top">

<div style="height: 10px;"></div>

<?php
//На входе имеем идентификатор. Отображаем его контент и потомков.
//Вычисляем путь к картинкам.

if($var_id)
{
 $var_query = mysql_query("SELECT id, parent_id, name, content, PHP_MENU_NAME FROM records WHERE id=$var_id",$db)
 or die("Invalid query: " . mysql_error());

 $var_data = mysql_fetch_array($var_query);
 $var_data_name = $var_data["PHP_MENU_NAME"];
 $var_data_content = $var_data["content"];
 $var_data_parent = $var_data["parent_id"];
 $var_web_path = "";

 //Строим путь к каталогу записи
 if($var_data_parent != 163)
 {
  //Имеем как минимум второй уровень вложенности, собираем информацию о родителе записи.
  $var_query = mysql_query("SELECT id, parent_id FROM records WHERE id=$var_data_parent",$db)
   or die("Invalid query: " . mysql_error());

  $var_parent1 = mysql_fetch_array($var_query);
  $var_parent1_parent = $var_parent1["parent_id"];   

  if($var_parent1_parent != 163)
  {
   //Имеем как минимум третий уровень вложенности, собираем информацию о родителе записи.
   $var_query = mysql_query("SELECT id, parent_id FROM records WHERE id=$var_parent1_parent",$db)
    or die("Invalid query: " . mysql_error());

   $var_parent2 = mysql_fetch_array($var_query);
   $var_parent2_parent = $var_parent2["parent_id"];

   if($var_parent2_parent != 163)
   {
    //Имеем четвертый уровень вложенности, собираем информацию о родителе записи.
    $var_query = mysql_query("SELECT id, parent_id FROM records WHERE id=$var_parent2_parent",$db)
     or die("Invalid query: " . mysql_error());

    $var_parent3 = mysql_fetch_array($var_query);
    $var_parent3_parent = $var_parent3["parent_id"];

    $var_web_path = "/163/$var_parent2_parent/$var_parent1_parent/$var_data_parent/$var_id"; 
   }
   else
   {
    $var_web_path = "/163/$var_parent1_parent/$var_data_parent/$var_id"; 
   }
  }
  else
  {
   $var_web_path = "/163/$var_data_parent/$var_id"; 
  }
 }
 else
 {
  $var_web_path = "/163/$var_id";
 }

////////////////////////////////////Отображаем заголовок, картинки и контент

 echo("<div class=\"hot_tour_name\">$var_data_name</div>");

 if($var_id != 227)
 {
 $droot = opendir("$server_path/$var_web_path");
 while($root_entry = readdir($droot)) 
 { 
  if( $root_entry != '.' &&
      $root_entry != '..')
  {
   if( !is_dir("$server_path/$var_web_path/$root_entry") )
   {
    $file_extension = substr($root_entry, -10); 
    $vid_ext = substr($root_entry, -3); 
    if( $file_extension == "_small.jpg")
    {
     //Нашли картинку
     echo("<img src=\"$var_web_path/$root_entry\" height=\"127\">&nbsp;&nbsp;&nbsp;");
    }
   }
  }
 }
 }

 echo("$var_data_content");

//Отображаем потомков///////////////////////////////////////////////////////

//Собираем информацию о потомках вызванной записи.
 $var_query = mysql_query("SELECT id, name, content, PHP_MENU_NAME FROM records WHERE parent_id=$var_id ORDER BY priority",$db)
  or die("Invalid query: " . mysql_error());

 while( $var_child = mysql_fetch_array($var_query) )
 {
  $var_child_name = $var_child["PHP_MENU_NAME"];
  $var_child_announce = $var_child["name"];
  $var_child_id = $var_child["id"];

?>
  <table width="100%" border=0 cellpadding=0 cellspacing=0>
   <tr><td width="100%" border="0" class="tour_name">
        <?php echo("<a class=\"hot_tour_name\" href=\"http://paloma.ellink.ru/browse/show_hot_type.php?var_id=$var_child_id\">$var_child_name</a>");?></td></tr>
   <tr>
    <td width="100%" border="0">
<?php
  $droot = opendir("$server_path/$var_web_path/$var_child_id");
  while($root_entry = readdir($droot)) 
  {
   if( $root_entry != '.' &&
       $root_entry != '..')
   {
    if( !is_dir("$server_path/$var_web_path/$var_child_id/$root_entry") )
    {
     $file_extension = substr($root_entry, -10); 
     $vid_ext = substr($root_entry, -3); 
     if( $file_extension == "_small.jpg")
     {
      //Нашли картинку
      echo("<img src=\"$var_web_path/$var_child_id/$root_entry\" height=\"127\">&nbsp;&nbsp;&nbsp;");
     }
    }
   }
  }
?>
    </td>
   </tr>
   <tr><td width="100%" border="0" class="hot_tour_desc">
<?php echo("$var_child_announce");?>
</tr>
  </table>

<div style="height: 10px;"></div>

<?php
 }
}
?>

 


  </td>
 </tr>
</table>
<div style="height: 12px;"></div>



<table border=0 cellpadding=0 cellspacing=0 bgcolor="#E6EDA8">
 <tr>
  <td class="hot_down_menu_text" align="center">
<a href="http://paloma.ellink.ru/browse/show_tours_type.php?var_id=151">
ВЫБОР ТУРА
</a>
</td>
  <td width="2"><img src="/common/img/down_menu_splitter.gif"></td>
  <td class="hot_down_menu_text" align="center">
<a href="http://paloma.ellink.ru/browse/show_tours_type.php?count_id=101">
СТРАНЫ
</a></td>
  <td width="2"><img src="/common/img/down_menu_splitter.gif"></td>
  <td class="hot_down_menu_text" align="center">
<a href="http://paloma.ellink.ru/browse/show_hot_type.php?var_id=164">
Горячие ПРЕДЛОЖЕНИЯ
</a>
</td>
  <td width="2"><img src="/common/img/down_menu_splitter.gif"></td>
  <td class="hot_down_menu_text" align="center">
<a href="http://paloma.ellink.ru/browse/show_pskov_type.php?var_id=6">
Добро пожаловать в Псковский регион
</a>
</td>
  <td width="2"><img src="/common/img/down_menu_splitter.gif"></td>
  <td class="hot_down_menu_text" align="center">
<a href="http://paloma.ellink.ru/browse/show_eng_type.php?var_id=243">
Welcome to Pskov
</a>
</td>
 </tr>
</table>

<?php include"../common/end_all.php"; ?>