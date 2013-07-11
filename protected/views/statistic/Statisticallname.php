<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<title>Статистика по спеціальностям</title>
<style>
TD {
	font-size: 14pt;
	border: 1px solid black;
       
}

TH {
	font-size: 14pt;
	border: 1px solid black;
        
}

H1 {
	font-size: 20pt;
}

A {
	text-decoration: none;
	color: black;
}

</style>
</head>
<body>
<?php
error_reporting(E_STRICT);
$connect_status = mysql_connect("10.1.103.26","edbo","eU7InIl","abiturient");
if (!$connect_status){
	echo "<center>
	<h1 style='color:red;font-size:18pt;font-family:Monotype Corsiva'>
	Немає зв'язку з сервером. 
	Зараз ви можете піти випити кофе або просто почекати. 
	Влаштовуйтесь позручніше.</h1></center>";
	exit();
}

$QUERY_COUNT = 0;

mysql_query("USE `abiturient`");$QUERY_COUNT++;
mysql_query("SET NAMES utf8");$QUERY_COUNT++;

//текущий день(число)
$cday = date("d");
//парсинг даты в формат гггг-мм-дд
$date_begin = "'".$_GET['date_begin']."'";
$date_end = "'".$_GET['date_end']."'";
//$date_begin = "'".date("Y-m-d")."'";
//$date_end = "'".date("Y-m-d")."'";


	if (preg_match("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/",$_GET['date_begin'])){
		$cday = preg_replace("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/","$1",$_GET['date_begin']);
		$date_begin = "'".preg_replace("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/","$3-$2-$1",$_GET['date_begin'])."'";
	} else {
		$date_begin = "'".mysql_real_escape_string($_GET['date_begin'])."'";
		$mcday = explode("-",$_GET['date_begin']);
		$cday = $mcday[2]; //выделение числа из пришедшей даты
	}



	if (preg_match("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/",$_GET['date_end'])){
		$cday = preg_replace("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/","$1",$_GET['date_end']);
		$date_end = "'".preg_replace("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/","$3-$2-$1",$_GET['date_end'])."'";
	} else {
		$date_end = "'".mysql_real_escape_string($_GET['date_end'])."'";
		$mcday = explode("-",$_GET['date_end']);
		$cday = $mcday[2]; //выделение числа из пришедшей даты
	}

//----------------------------------------------
$OKR = 6; //по умолчанию - бакалавр
if (isset($_GET['okr']) && is_numeric($_GET['okr'])){
	$OKR = $_GET['okr']; //если есть параметр ОКР - присваиваем это значение
}

$spec_name = "SpecialityName";
if ($OKR == 6) {
	$spec_name = "SpecialityDirectionName";
	
}
else{
    $spec_name = "SpecialityName";
}

//----------------------------------------------

$query_idspec = "SELECT idSpeciality as SpecialityID 
FROM specialities WHERE
FacultetID=".$_GET['FacultetID']." 
AND
SpecialityClasifierCode='".$_GET['SpecialityClasifierCode']."' 
AND
PersonEducationFormID=".$_GET['PersonEducationFormID']."
";

if (!empty($_GET['SpecialitySpecializationName'])){
$query_idspec .=
"and SpecialitySpecializationName='".$_GET['SpecialitySpecializationName']."'";
}else{
    $query_idspec.="and 1";
}
$res = mysql_query($query_idspec);
$row[1] = mysql_fetch_assoc($res);
$idSpec = $row[1]['SpecialityID'];
$query_MainQuestion = "
    SELECT personspeciality.RequestNumber as number,
    CONCAT_WS(' ',person.lastname,person.firstname,person.middlename) as name
FROM personspeciality
LEFT JOIN person ON person.idPerson = personspeciality.PersonID 
where 
personspeciality.StatusID<>3 and
personspeciality.SepcialityID = ".$idSpec;
if(isset($_GET['isContract']))
{
    $query_MainQuestion.=" AND personspeciality.isContract = 1";
}
if(isset($_GET['isBudget']))
{
    $query_MainQuestion.=" AND personspeciality.isBudget = 1";
}
echo "<table align=center cellspacing=0>";
?>

<center>
<h1>
Список абітуріентів,що подали документи<br/>
Освітньо-кваліфікаційний рівень "<?php
switch ($OKR) {
case 6: echo "Бакалавр";break;
case 7: echo "Спеціаліст";break;
case 8: echo "Магістр";break;
}
?>" 
</h1>

<?php 
$AllUsers = mysql_query($query_MainQuestion);
//echo $query_MainQuestion."<br/>";
//var_dump($AllUsers);

echo "<tr >"."<td>Номер Заявки"."</td>"."<td>"."ФИО"."</td></t r>";
   for($i=0; $i<mysql_num_rows($AllUsers); $i++){
$ShowInfo[$i] = mysql_fetch_assoc($AllUsers);
       echo "<tr><td>".$ShowInfo[$i]['number']."</td><td>".$ShowInfo[$i]['name']."</td></tr>";
    }

echo "</table>";
?>

</body>
</html>
<?php mysql_close(); ?>
