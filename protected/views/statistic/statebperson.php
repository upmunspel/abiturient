<?php
    /*
     * GET-parameters:
     * date_from - початкова дата інтервалу виведення статистики числа заяв
     * date_to - кінцева дата інтервалу виведення статистики числа заяв
     * okr - перша цифра коду спеціальності (
     *   6 - бакалавр, 
     *   7 - спеціаліст,
     *   8 - магістр)
     * 
     */
?>

<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<title>СТАТИСТИКА ВСТУПУ</title>
<style media="print">
TD {
	font-size: 7pt;
	border: 1px solid black;
}
TH {
	font-size: 10pt;
	border: 1px solid black;
}
H1 {
	font-size: 8pt;
}

A {
	text-decoration: none;
	color: blue;
}

</style>
<style media="screen">
TD {
	font-size: 14pt;
	 border: 1px solid black;
        padding: 5px;
}
TH {
	font-size: 14pt;
	border: 1px solid black;
        padding: 5px;
        
}
H1 {
	font-size: 16pt;
}

</style>
</head>
<body>
<?php

error_reporting(E_STRICT);
$idSpec = $_GET['idSpec'];
$eduForm = $_GET['eduForm'];
$electro=$_GET['electro'];
$connect_status = mysql_connect(/*"localhost","root","","abiturient"*/"10.1.103.26","edbo","eU7InIl","abiturient");
if (!$connect_status){
	echo "<center>
	<h1 style='color:red;font-size:18pt;font-family:Monotype Corsiva'>
	Немає зв'язку з сервером. 
	Зараз ви можете піти випити кофе або просто почекати. 
	Влаштовуйтесь позручніше.</h1></center>";
	exit();
}
mysql_query("USE `abiturient`");
mysql_query("SET NAMES utf8");
$OKR = 6;

if (isset($_GET['okr']) && is_numeric($_GET['okr'])){
	$OKR = $_GET['okr'];
}

if($electro==1){
     $electronic='personspeciality.RequestFromEB=1';
}
else $electronic='1';
//$electronic = "personspeciality.RequestFromEB = $electro";
//}$electronic = "1";
//echo $electronic;


$spec_name = "SpecialityName";
if ($OKR == 6) {
	$spec_name = "SpecialityDirectionName";
}
$query ="
    SELECT person.LastName AS surname, person.FirstName AS name , person.MiddleName AS fartherName, person.EdboID AS edbo
FROM personspeciality
LEFT JOIN person ON person.idPerson = personspeciality.PersonID
WHERE personspeciality.SepcialityID = $idSpec  AND 1 AND personspeciality.EducationFormID = $eduForm AND ".$electronic;
$res = mysql_query($query);
$counter = 0;
echo "<table align=center cellspacing = 0>";
echo "<tr><th>№</th><th>ПІБ</th><th>ЕДЕБО</th></tr>";
for($i=0; $i<mysql_num_rows($res); $i++){
       $row[$i] = mysql_fetch_assoc($res);
    echo "<tr><td>".++$counter."</td><td>".$row[$i]['surname']." ".$row[$i]['name']." ".$row[$i]['fartherName']."</td><td>".$row[$i]['edbo']."</td></tr>";
}
echo "</table>";
?>

</body>
</html>

<?php mysql_close(); ?>