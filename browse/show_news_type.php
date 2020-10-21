<?php
 include"../common/start.php";
 $news_in_archive_page = 10;

//Алгоритм просто ацкий. Если нужно что-то поменять, лучше переписать все заново :)

 $db = mysql_connect("localhost", " ", " ");
 mysql_select_db("paloma",$db);

 $replaced_id = $r_id;
 $single_paged = 1;
//Проверяем, является ли кликнутый пункт родительским для кого-либо
 $result_check = mysql_query("SELECT id, parent_id, name, name_en, content, content_en, PHP_MENU_NAME, PHP_MENU_NAME_EN, entry_date FROM records WHERE parent_id=$r_id ORDER BY priority",$db)
   or die("Invalid query: " . mysql_error());


 if( $result_check )
 {
  //Пункт - родительский, нужно начинать отображение с его потомков
  //Берем любого потомка и подставляем в дальнейшую обработку его id.
  $myrow_candidate = mysql_fetch_array($result_check);
  if($myrow_candidate["id"])
   $replaced_id = 0 + $myrow_candidate["id"];
 }

//Получаем информацию о (псевдо)переданном $id
 $result1 = mysql_query("SELECT id, parent_id, name, name_en, content, content_en, PHP_MENU_NAME, PHP_MENU_NAME_EN FROM records WHERE id=$replaced_id ORDER BY priority",$db)
   or die("Invalid query: " . mysql_error());
 $myrow_clicked = mysql_fetch_array($result1);     //Чудское подворье

 $parent_clicked = $myrow_clicked["parent_id"];

 if( $parent_clicked != 0)//Если не корневая запись
 {
  //Получаем информацию о родительской записи
  $result2 = mysql_query("SELECT id, parent_id, name, name_en, content, content_en, PHP_MENU_NAME, PHP_MENU_NAME_EN FROM records WHERE id=$parent_clicked ORDER BY priority",$db)
    or die("Invalid query: " . mysql_error());  //Турбазы
  $myrow_second = mysql_fetch_array($result2);

  $parent_second = $myrow_second["parent_id"];
  $result2_1 = mysql_query("SELECT id, parent_id, name, name_en, content, content_en, PHP_MENU_NAME, PHP_MENU_NAME_EN FROM records WHERE parent_id=$parent_clicked ORDER BY priority",$db)
    or die("Invalid query: " . mysql_error()); //Список турбаз

  if( $parent_second != 0)//Если родитель - не корневая запись
  {
   //Получаем информацию о родительской записи
   $result3 = mysql_query("SELECT id, parent_id, name, name_en, content, content_en, PHP_MENU_NAME, PHP_MENU_NAME_EN FROM records WHERE id=$parent_second ORDER BY priority",$db)
     or die("Invalid query: " . mysql_error()); //Прием в Пскове
   $myrow_third = mysql_fetch_array($result3);  

   $parent_third = $myrow_third["parent_id"];
   $result3_1 = mysql_query("SELECT id, parent_id, name, name_en, content, content_en, PHP_MENU_NAME, PHP_MENU_NAME_EN FROM records WHERE parent_id=$parent_second ORDER BY priority",$db)
     or die("Invalid query: " . mysql_error()); //Список объектов в Пскове

   if( $parent_third != 0)//Если родитель - не корневая запись
   {
    //Получаем информацию о родительской записи
    $result4 = mysql_query("SELECT id, parent_id, name, name_en, content, content_en, PHP_MENU_NAME, PHP_MENU_NAME_EN FROM records WHERE id=$parent_third ORDER BY priority",$db)
      or die("Invalid query: " . mysql_error());
    $myrow_first = mysql_fetch_array($result4);  //Туры
 
    $result4_1 = mysql_query("SELECT id, parent_id, name, name_en, content, content_en, PHP_MENU_NAME, PHP_MENU_NAME_EN FROM records WHERE parent_id=$parent_third ORDER BY priority",$db)
     or die("Invalid query: " . mysql_error()); //Список возможных туров(Псков, Россия, Зарубеж)

    //Ну тут уже родитель стопудово равен нулю!
   }
  }
 }

 echo("<UL id=\"menu\" class=\"menu\">\n");

//Цикл отображения до 4 уровня вложенности
if( $result4_1 )
{
 if( $myrow_first ) //Туры
 {
  $single_paged=0;
  if( $lang == en )
   $menu_name = $myrow_first["PHP_MENU_NAME_EN"];
  else
   $menu_name = $myrow_first["PHP_MENU_NAME"];
  //Записываем самый первый пункт, типа Туры
  echo("<LI class=\"menu\"><A href=\"show_news_type.php?r_id=$parent_third&lang=$lang\" class=\"menu_text\">$menu_name</A>\n");
  echo("<UL class=\"menu\">\n");
 }
 while ( $myrow_second = mysql_fetch_array($result4_1) )
 {
  if( $lang == en )
   $menu_name = $myrow_second["PHP_MENU_NAME_EN"];
  else
   $menu_name = $myrow_second["PHP_MENU_NAME"];

  $second_id = $myrow_second["id"];
  //Записываем пункт второго уровня, типа Псков
  echo("<LI class=\"menu\"><A href=\"show_news_type.php?r_id=$second_id&lang=$lang\" class=\"menu_text\">$menu_name</A>\n");
  //Проверяем, не является ли этот пункт корневым для следующего уровня

  if( $parent_second == $second_id )
  {
   //Является корневым, отображаем вложенный список
   echo("<UL class=\"menu\">\n");
   while ( $myrow_third = mysql_fetch_array($result3_1) )
   {
    if( $lang == en )
     $menu_name = $myrow_third["PHP_MENU_NAME_EN"];
    else
     $menu_name = $myrow_third["PHP_MENU_NAME"];

    $third_id = $myrow_third["id"];
    //Записываем пункт третьего уровня, типа Гостиницы
    echo("<LI class=\"menu\"><A href=\"show_news_type.php?r_id=$third_id&lang=$lang\" class=\"menu_text\">$menu_name</A>\n");
    //Проверяем, не является ли этот пункт корневым для следующего уровня
    if( $parent_clicked == $third_id )
    {
     //Является корневым, отображаем вложенный список
     echo("<UL class=\"menu\">\n");
     while ( $myrow_fourth = mysql_fetch_array($result2_1) )
     {
      if( $lang == en )
       $menu_name = $myrow_fourth["PHP_MENU_NAME_EN"];
      else
       $menu_name = $myrow_fourth["PHP_MENU_NAME"];

      $fourth_id = $myrow_fourth["id"];
      //Записываем пункт четвертого уровня, типа Рижская Гостиница
      echo("<LI class=\"menu\"><A href=\"show_news_type.php?r_id=$fourth_id&lang=$lang\" class=\"menu_text\">$menu_name</A>\n");
     }
     //Отобразили последний уровень вложенности, закрываем списки
     echo("</UL>\n");
    }
   }
   echo("</UL>\n"); 
  }
 }  
}

//Цикл отображения до 3 уровня вложенности
if( $result3_1 )
{
 if( $myrow_third ) //Туры
 {
  $single_paged=0;
  if( $lang == en )
   $menu_name = $myrow_third["PHP_MENU_NAME_EN"];
  else
   $menu_name = $myrow_third["PHP_MENU_NAME"];
  //Записываем самый первый пункт, типа Туры
  echo("<LI class=\"menu\"><A href=\"show_news_type.php?r_id=$parent_second&lang=$lang\" class=\"menu_text\">$menu_name</A>\n");
  echo("<UL class=\"menu\">\n");
 }
 while ( $myrow_second = mysql_fetch_array($result3_1) )
 {
  if( $lang == en )
   $menu_name = $myrow_second["PHP_MENU_NAME_EN"];
  else
   $menu_name = $myrow_second["PHP_MENU_NAME"];

  $second_id = $myrow_second["id"];
  //Записываем пункт второго уровня, типа Псков
  echo("<LI class=\"menu\"><A href=\"show_news_type.php?r_id=$second_id&lang=$lang\" class=\"menu_text\">$menu_name</A>\n");
  //Проверяем, не является ли этот пункт корневым для следующего уровня
  if( $parent_clicked == $second_id )
  {
   //Является корневым, отображаем вложенный список
   echo("<UL class=\"menu\">\n");
   while ( $myrow_third = mysql_fetch_array($result2_1) )
   {
    if( $lang == en )
     $menu_name = $myrow_third["PHP_MENU_NAME_EN"];
    else
     $menu_name = $myrow_third["PHP_MENU_NAME"];

    $third_id = $myrow_third["id"];
    //Записываем пункт третьего уровня, типа Гостиницы
    echo("<LI class=\"menu\"><A href=\"show_news_type.php?r_id=$third_id&lang=$lang\" class=\"menu_text\">$menu_name</A>\n");
   }
   echo("</UL>\n"); 
  }
 }  
}

//Цикл отображения до 2 уровня вложенности
if( $result2_1 )
{
 if( $myrow_second )  //Туры
 {
  $single_paged=0;
  if( $lang == en )
   $menu_name = $myrow_second["PHP_MENU_NAME_EN"];
  else
   $menu_name = $myrow_second["PHP_MENU_NAME"];
  //Записываем самый первый пункт, типа Туры
  echo("<LI class=\"menu\"><A href=\"show_news_type.php?r_id=$parent_clicked&lang=$lang\" class=\"menu_text\">$menu_name</A>\n");
  echo("<UL class=\"menu\">\n");
 }
 while ( $myrow_second = mysql_fetch_array($result2_1) )
 {
  if( $lang == en )
   $menu_name = $myrow_second["PHP_MENU_NAME_EN"];
  else
   $menu_name = $myrow_second["PHP_MENU_NAME"];

  $second_id = $myrow_second["id"];
  //Записываем пункт второго уровня, типа Псков
  echo("<LI class=\"menu\"><A href=\"show_news_type.php?r_id=$second_id&lang=$lang\" class=\"menu_text\">$menu_name</A>\n");
 }  
}
//Цикл отображения до 1 уровня вложенности
if( $single_paged )
{
 if( $myrow_clicked )  //Туры
 {
  if( $lang == en )
   $menu_name = $myrow_clicked["PHP_MENU_NAME_EN"];
  else
   $menu_name = $myrow_clicked["PHP_MENU_NAME"];
  //Записываем самый первый пункт, типа Туры
  echo("<LI class=\"menu\"><A href=\"show_news_type.php?r_id=$r_id&lang=$lang\" class=\"menu_text\">$menu_name</A>\n");
 }
}  
echo("</UL>\n");

//Получаем контент
 $content = "Page is under construction";
 $content_request = mysql_query("SELECT id, parent_id, name, name_en, content, content_en, PHP_MENU_NAME, PHP_MENU_NAME_EN FROM records WHERE id=$r_id",$db)
   or die("Invalid query: " . mysql_error()); //Прием в Пскове
 $myrow_content = mysql_fetch_array($content_request);

 if( $lang == en )
  $content = $myrow_content["content_en"];
 else
  $content = $myrow_content["content"];
 
?>
     </td>
    </tr>

    <tr><td height=10></td></tr>
<?php 
 $result_offers = mysql_query("SELECT id, parent_id, name, name_en, content, content_en, PHP_MENU_NAME, PHP_MENU_NAME_EN FROM records WHERE parent_id=22 ORDER BY PRIORITY",$db)
   or die("Invalid query: " . mysql_error());

 while( $myrow_offer = mysql_fetch_array($result_offers) )
 {
  if( $lang == "en" )
   $offer_text = $myrow_offer["content_en"];
  else
   $offer_text = $myrow_offer["content"];   

echo("
    <tr><td>
      <table border=0 cellpadding=0 cellspacing=0 align=left valign=top width=215 style=\"margin-top: 5px;\" class=\"text_verdana\">
       <tr>
        <td width=5 bgcolor=white nowrap=true></td>
        <td height=1 background=\"../img/menu_table_up.png\"></td></tr>
       <tr>
        <td width=5 bgcolor=white nowrap=true></td>
        <td background=\"../img/menu_table_content.png\" class=\"left_helper_table\">
        $offer_text
        </td>
       </tr>
       <tr>
        <td width=5 bgcolor=white nowrap=true></td>
        <td height=2 background=\"../img/menu_table_down.png\"></td></tr>
      </table>
    </td></tr> ");  
 }
?>
   <tr><td height=15>
    <br><center> <a href="http://www.old-pskov.ru" target="_blank" title="Древний Псков"><img src="http://www.old-pskov.ru/banner/120x60.gif" width="120" height="60" alt="Древний Псков" border="0"></a></center>
   </td></tr>
   <tr><td height=15>
    <br><center> <a href="http://www.2r.ru" target="_blank" title="Гостиницы России">Гостиницы России</a></center>
   </td></tr>

   <tr><td height=15></td></tr>

   </table>
  </td>
  <td width="4" bgcolor=white nowrap=true></td>
  <td width="1" bgcolor="#114BAD" nowrap=true valign=top ><img src="../img/blue_polosa.png" valign=top></td>
  <td bgcolor="#ffffff" width="715" valign="top" align="justify" nowrap=true style="padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 20px;" class="text_verdana">
   <table border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
    <tr>
     <td height=5 bgcolor=white></td></tr>
    <tr>             
     <td bgcolor="#114BAD" height=20 class="menu_razdel_name" style="padding-left: 5px;">
      <a href="../browse/show_news_type.php?r_id=1&lang=ru" class="menu_razdel_name"><b>О компании&nbsp;</b></a>
      <a href="../browse/show_news_type.php?r_id=2&lang=ru" class="menu_razdel_name"><b>Новости&nbsp;</b></a>
      <a href="../browse/show_news_type.php?r_id=3&lang=ru" class="menu_razdel_name"><b>Туры&nbsp;</b></a>
      <a href="../browse/show_news_type.php?r_id=4&lang=ru" class="menu_razdel_name"><b>Скидки&nbsp;</b></a>
      <a href="../browse/show_news_type.php?r_id=5&lang=ru" class="menu_razdel_name"><b>Контакты&nbsp;</b></a></td>
    </tr>
    <tr>
     <td width="715" class="gs" bgcolor=white style="padding-left: 10px; padding-right: 10px; padding-top: 10px; padding-bottom: 10px;">
      <?php
        if($r_id == 2)
        {
         //Отображаем особую страничку со списком новостей
         $news_data = mysql_query("SELECT id, parent_id, name, name_en, content, content_en, PHP_MENU_NAME, PHP_MENU_NAME_EN, entry_date FROM records WHERE parent_id=$r_id ORDER BY priority",$db)
          or die("Invalid query: " . mysql_error());

         while( $news_item = mysql_fetch_array($news_data) )
         {
 	  $news_item_content = $news_item["PHP_MENU_NAME"];
 	  $news_item_id = $news_item["id"];
 	  $news_item_date = substr($news_item["entry_date"], 0, 10);
          echo("<b>$news_item_date</b><br><a href=\"?r_id=$news_item_id&lang=$lang\" color=\"orange\">$news_item_content</a>");echo("<br><br>");

         }
        }
        elseif( $parent_clicked == 2)
        {
         $news_data = mysql_query("SELECT id, parent_id, name, name_en, content, content_en, PHP_MENU_NAME, PHP_MENU_NAME_EN, entry_date FROM records WHERE id=$r_id ORDER BY id",$db)
          or die("Invalid query: " . mysql_error());

         $news_item = mysql_fetch_array($news_data);
 	 $news_item_content = $news_item["PHP_MENU_NAME"];

          $content = "<b>$news_item_content</b><br><br>$content";
         echo("$content");
        }
        else
        {
         echo("$content");
        }
mysql_close($db);
?>
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<?php include"../common/end.htm"; ?>
