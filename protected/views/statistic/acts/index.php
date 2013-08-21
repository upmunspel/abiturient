<?php

	/*mysql_connect("10.1.103.26","root","ehHYAuj");
	mysql_query("set names utf8");
	mysql_query("use abiturient");
	//mysql_query("delete from edbo_data");*/
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Формування актів</title>
		<link rel="stylesheet" type="text/css" href="styles.css" />
	</head>
	<body>
   <form  action="createacts" method="post">
   Виберіть факультет:
   <p><select name="facultet">
    <option disabled>Факультет</option>
    <option selected value="Математичний">Математичний</option>
    <option value="Біологічний">Біологічний</option>
    <option value="Економічний">Економічний</option>
	<option value="Історичний">Історичний</option>
	<option value="Фізичний">Фізичний</option>
	<option value="Журналістики">Журналістики</option>
	<option value="Філологічний">Філологічний</option>
	<option value="Іноземної філології">Іноземної філології</option>
	<option value="Менеджменту">Менеджменту</option>
	<option value="Юридичний">Юридичний</option>
	<option value="Фізичного виховання">Фізичного виховання</option>
	<option value="Соціальної педагогіки та психології">СПП</option>
    <option value="Соціології та управління">Соціології та управління</option>	
   </select></p>
   Віберіть спеціальність:
   <p><select name="spec">
    <option disabled>Виберіть Спеціальність</option>
    <option selected value="Програмна інженерія">Програмна інженерія</option>
    <option value="Прикладна математика">Прикладна математика</option>
    <option value="Математика">Математика</option>
	<option value="Інформатика">Інформатика</option>
	
	<option value="Екологія, охорона навколишнього середовища та збалансоване природокористування">Екологія, охорона навколишнього...</option>
    <option value="Хімія">Хімія</option>
    <option value="Лісове і садово-паркове господарство">Лісове і садово-паркове господарство</option>
	<option value="Біологія">Біологія</option>
	
	<option value="Економічна кібернетика">Економічна кібернетика</option>
    <option value="Міжнародна економіка">Міжнародна економіка</option>
    <option value="Управління персоналом та економіка праці">Управління персоналом та економіка праці</option>
	<option value="Фінанси і кредит">Фінанси і кредит</option>
	<option value="Облік і аудит">Облік і аудит</option>
	
	<option value="Історія">Історія</option>
	<option value="Країнознавство">Країнознавство</option>
	
	<option value="Фізика">Фізика</option>
	<option value="Прикладна фізика">Прикладна фізика</option>
	
	<option value="Журналістика">Журналістика</option>
	<option value="Реклама і зв’язки з громадськістю">Реклама і зв’язки з громадськістю</option>
	<option value="Видавнича справа та редагування">Видавнича справа та редагування</option>
	<option value="Менеджмент">Менеджмент</option>
	<option value="правознавство">правознавство</option>
	
	<option value="Спорт">Спорт</option>
	<option value="Здоров’я людини">Здоров’я людини</option>
	<option value="Фізичне виховання">Фізичне виховання</option>
	<option value="Туризм">Туризм</option>
	
	<option value="Cоціальна педагогіка">Cоціальна педагогіка</option>
	<option value="Театральне мистецтво">Театральне мистецтво</option>	
	<option value="Психологія">Фізика</option>
	
	<option value="Соціальна робота">Соціальна робота</option>
	<option value="Політологія">Політологія</option>	
	<option value="Соціологія">Соціологія</option>
	<option value="Філософія">Філософія</option>
	
   </select></p>
   
   
   <p><input type="submit" value="Формування актів"></p>
  </form>
	</body>
</html>
