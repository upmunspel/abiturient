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
	color: black;
}
</style>
<style media="screen">
TD {
	font-size: 14pt;
	/* border: 1px solid black; */
        padding: 5px;
}
TH {
	font-size: 14pt;
	/* border: 1px solid black; */
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

$connect_status = mysql_connect("10.1.10.26","edbo","eU7InIl","abiturient");
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

//Конвертація дати у формат дд.мм.рррр --> рррр-мм-дд
//DEFAULT: поточна дата
$cday_from = '1';
$date_from = '2013-07-01';
$cday_to = date("d");
$date_to = date("Y-m-d");

if (isset($_GET['date_from']) && !empty($_GET['date_from'])){
	if (preg_match("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/",$_GET['date_from'])){
		$cday_from = preg_replace("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/","$1",$_GET['date_from']);
		$date_from = preg_replace("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/","$3-$2-$1",$_GET['date_from']);
	} else {
		$date_from = mysql_real_escape_string($_GET['date_from']);
		$mcday = explode("-",$_GET['date_from']);
		$cday_from = $mcday[2];
	}
}
if (isset($_GET['date_to'])  && !empty($_GET['date_to'])){
	if (preg_match("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/",$_GET['date_to'])){
		$cday_to = preg_replace("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/","$1",$_GET['date_to']);
		$date_to = preg_replace("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/","$3-$2-$1",$_GET['date_to']);
	} else {
		$date_to = mysql_real_escape_string($_GET['date_to']);
		$mcday = explode("-",$_GET['date_to']);
		$cday_to = $mcday[2];
	}
}
$OKR = 6;
if (isset($_GET['okr']) && is_numeric($_GET['okr'])){
	$OKR = $_GET['okr'];
}

$spec_name = "SpecialityName";
if ($OKR == 6) {
	$spec_name = "SpecialityDirectionName";
}


$query_dates = "SELECT DISTINCT MID(  `CreateDate` , 1, 10 ) AS `dt` FROM  `personspeciality` WHERE  `CreateDate` 
BETWEEN STR_TO_DATE(  '".$date_from." 00:00:00',  '%Y-%m-%d %H:%i:%s' ) 
AND STR_TO_DATE(  '".$date_to." 23:59:59',  '%Y-%m-%d %H:%i:%s' )";

$query = "select 
facultets.idFacultet,facultets.FacultetFullName, 
count(distinct specialities.SpecialityClasifierCode) as 'cnt' 
FROM facultets JOIN specialities 
ON facultets.idFacultet=specialities.FacultetID 
WHERE 
MID(specialities.SpecialityClasifierCode,1,1)='".$OKR."' 
GROUP BY specialities.FacultetID 
ORDER BY FacultetFullName;";

$query_specs = "select 
distinct specialities.SpecialityClasifierCode, 
CONCAT_WS(' ',specialities.SpecialityClasifierCode,specialities.".$spec_name.") AS `spec` 
from specialities 
WHERE FacultetID=__FacultetID__ AND 
MID(specialities.SpecialityClasifierCode,1,1)='".$OKR."';";

$query_counts = "select 

(SELECT COUNT(DISTINCT CONCAT_WS(' ',person.FirstName,person.MiddleName,person.LastName)) FROM specialities 
JOIN personspeciality ON 
personspeciality.SepcialityID=specialities.idSpeciality
JOIN person ON
personspeciality.PersonID=person.idPerson 
WHERE specialities.SpecialityClasifierCode ='__CODE__' AND 
specialities.FacultetID=__FacultetID__  AND specialities.PersonEducationFormID=1 AND 
MID(personspeciality.CreateDate,1,10) = MID(__DATE__,1,10) AND 1 /**/) AS B_dnevn_per_day, 


(SELECT COUNT(DISTINCT CONCAT_WS(' ',person.FirstName,person.MiddleName,person.LastName)) FROM specialities 
JOIN personspeciality ON 
personspeciality.SepcialityID=specialities.idSpeciality
JOIN person ON
personspeciality.PersonID=person.idPerson 
LEFT JOIN personbenefits
ON personspeciality.PersonID=personbenefits.PersonID
LEFT JOIN benefit
ON benefit.idBenefit=personbenefits.BenefitID
WHERE specialities.SpecialityClasifierCode ='__CODE__' AND 
specialities.FacultetID=__FacultetID__  AND specialities.PersonEducationFormID=1 AND 
MID(personspeciality.CreateDate,1,10) = MID(__DATE__,1,10)
AND benefit.isPZK=1 
AND 1 /**/) AS B_dnevn_pzk_per_day, 

(SELECT COUNT(DISTINCT CONCAT_WS(' ',person.FirstName,person.MiddleName,person.LastName)) FROM specialities 
JOIN personspeciality ON 
personspeciality.SepcialityID=specialities.idSpeciality
JOIN person ON
personspeciality.PersonID=person.idPerson 
LEFT JOIN personbenefits
ON personspeciality.PersonID=personbenefits.PersonID
LEFT JOIN benefit
ON benefit.idBenefit=personbenefits.BenefitID
WHERE specialities.SpecialityClasifierCode ='__CODE__' AND 
specialities.FacultetID=__FacultetID__  AND specialities.PersonEducationFormID=1 AND 
MID(personspeciality.CreateDate,1,10) = MID(__DATE__,1,10)
AND benefit.isPV=1 
AND 1 /**/) AS B_dnevn_pv_per_day, 

(SELECT COUNT(DISTINCT CONCAT_WS(' ',person.FirstName,person.MiddleName,person.LastName)) FROM specialities 
JOIN personspeciality ON 
personspeciality.SepcialityID=specialities.idSpeciality
JOIN person ON
personspeciality.PersonID=person.idPerson 
WHERE specialities.SpecialityClasifierCode ='__CODE__' AND 
specialities.FacultetID=__FacultetID__  AND specialities.PersonEducationFormID=2 AND 
MID(personspeciality.CreateDate,1,10) = MID(__DATE__,1,10) AND 1 /**/) AS B_zaoch_per_day,

(SELECT COUNT(DISTINCT CONCAT_WS(' ',person.FirstName,person.MiddleName,person.LastName)) FROM specialities 
JOIN personspeciality ON 
personspeciality.SepcialityID=specialities.idSpeciality
JOIN person ON
personspeciality.PersonID=person.idPerson 
LEFT JOIN personbenefits
ON personspeciality.PersonID=personbenefits.PersonID
LEFT JOIN benefit
ON benefit.idBenefit=personbenefits.BenefitID
WHERE specialities.SpecialityClasifierCode ='__CODE__' AND 
specialities.FacultetID=__FacultetID__  AND specialities.PersonEducationFormID=2 AND 
MID(personspeciality.CreateDate,1,10) = MID(__DATE__,1,10)
AND benefit.isPZK=1 
AND 1 /**/) AS B_zaoch_pzk_per_day, 

(SELECT COUNT(DISTINCT CONCAT_WS(' ',person.FirstName,person.MiddleName,person.LastName)) FROM specialities 
JOIN personspeciality ON 
personspeciality.SepcialityID=specialities.idSpeciality
JOIN person ON
personspeciality.PersonID=person.idPerson 
LEFT JOIN personbenefits
ON personspeciality.PersonID=personbenefits.PersonID
LEFT JOIN benefit
ON benefit.idBenefit=personbenefits.BenefitID
WHERE specialities.SpecialityClasifierCode ='__CODE__' AND 
specialities.FacultetID=__FacultetID__  AND specialities.PersonEducationFormID=2 AND 
MID(personspeciality.CreateDate,1,10) = MID(__DATE__,1,10)
AND benefit.isPV=1 
AND 1 /**/) AS B_zaoch_pv_per_day


FROM specialities 
JOIN personspeciality ON 
personspeciality.SepcialityID=specialities.idSpeciality
LEFT JOIN personbenefits
ON personspeciality.PersonID=personbenefits.PersonID
LEFT JOIN benefit
ON benefit.idBenefit=personbenefits.BenefitID
WHERE specialities.SpecialityClasifierCode ='__CODE__' AND 
specialities.FacultetID=__FacultetID__  ";

$query_specializationsCodes = "
SELECT DISTINCT  `SpecialityClasifierCode` 
FROM  `specialities` 
WHERE  `SpecialitySpecializationName` <>  \"\" AND FacultetID=__FacultetID__
";

$gen_counts_query = "
SELECT (SELECT COUNT(DISTINCT idPersonSpeciality) FROM specialities 
JOIN personspeciality ON 
personspeciality.SepcialityID=specialities.idSpeciality
JOIN person ON
personspeciality.PersonID=person.idPerson 
WHERE MID(specialities.SpecialityClasifierCode,1,1) ='".$OKR."' AND 
 specialities.PersonEducationFormID=1 AND 
MID(personspeciality.CreateDate,1,10) = MID(__DATE__,1,10) AND 1 /**/) as `all-dnevn-XX.07.2013`,

(SELECT COUNT(DISTINCT idPersonSpeciality) FROM specialities 
JOIN personspeciality ON 
personspeciality.SepcialityID=specialities.idSpeciality
LEFT JOIN personbenefits
ON personspeciality.PersonID=personbenefits.PersonID
LEFT JOIN benefit
ON benefit.idBenefit=personbenefits.BenefitID
JOIN person ON
personspeciality.PersonID=person.idPerson 
WHERE MID(specialities.SpecialityClasifierCode,1,1) ='".$OKR."' AND 
 specialities.PersonEducationFormID=1 AND 
MID(personspeciality.CreateDate,1,10) = MID(__DATE__,1,10) AND 1 /**/ 
AND benefit.isPZK=1) as `all-dnevn-pzk-XX.07.2013`,

(SELECT COUNT(DISTINCT idPersonSpeciality) FROM specialities 
JOIN personspeciality ON 
personspeciality.SepcialityID=specialities.idSpeciality
LEFT JOIN personbenefits
ON personspeciality.PersonID=personbenefits.PersonID
LEFT JOIN benefit
ON benefit.idBenefit=personbenefits.BenefitID
JOIN person ON
personspeciality.PersonID=person.idPerson 
WHERE MID(specialities.SpecialityClasifierCode,1,1) ='".$OKR."' AND 
 specialities.PersonEducationFormID=1 AND 
MID(personspeciality.CreateDate,1,10) = MID(__DATE__,1,10) AND 1 /**/  
AND benefit.isPV=1) as `all-dnevn-pv-XX.07.2013`,

(SELECT COUNT(DISTINCT idPersonSpeciality) FROM specialities 
JOIN personspeciality ON 
personspeciality.SepcialityID=specialities.idSpeciality
JOIN person ON
personspeciality.PersonID=person.idPerson 
WHERE MID(specialities.SpecialityClasifierCode,1,1) ='".$OKR."' AND 
 specialities.PersonEducationFormID=2 AND 
MID(personspeciality.CreateDate,1,10) = MID(__DATE__,1,10) AND 1 /**/) as `all-zaochn-XX.07.2013`,

(SELECT COUNT(DISTINCT idPersonSpeciality) FROM specialities 
JOIN personspeciality ON 
personspeciality.SepcialityID=specialities.idSpeciality
LEFT JOIN personbenefits
ON personspeciality.PersonID=personbenefits.PersonID
LEFT JOIN benefit
ON benefit.idBenefit=personbenefits.BenefitID
JOIN person ON
personspeciality.PersonID=person.idPerson 
WHERE MID(specialities.SpecialityClasifierCode,1,1) ='".$OKR."' AND 
 specialities.PersonEducationFormID=2 AND 
MID(personspeciality.CreateDate,1,10) = MID(__DATE__,1,10) AND 1 /**/  
AND benefit.isPZK=1) as `all-zaochn-pzk-XX.07.2013`,

(SELECT COUNT(DISTINCT idPersonSpeciality) FROM specialities 
JOIN personspeciality ON 
personspeciality.SepcialityID=specialities.idSpeciality
LEFT JOIN personbenefits
ON personspeciality.PersonID=personbenefits.PersonID
LEFT JOIN benefit
ON benefit.idBenefit=personbenefits.BenefitID
JOIN person ON
personspeciality.PersonID=person.idPerson 
WHERE MID(specialities.SpecialityClasifierCode,1,1) ='".$OKR."' AND 
 specialities.PersonEducationFormID=2 AND 
MID(personspeciality.CreateDate,1,10) = MID(__DATE__,1,10) AND 1 /**/  
AND benefit.isPV=1) as `all-zaochn-pv-XX.07.2013`

FROM

specialities JOIN facultets
ON facultets.idFacultet = specialities.FacultetID
LEFT JOIN personspeciality
ON specialities.idSpeciality=personspeciality.SepcialityID
LEFT JOIN personbenefits
ON personspeciality.PersonID=personbenefits.PersonID
LEFT JOIN benefit
ON benefit.idBenefit=personbenefits.BenefitID;";


$query_specializations ="
SELECT DISTINCT SpecialitySpecializationName AS `s_name` FROM `specialities` WHERE `SpecialityClasifierCode`='__CODE__' AND FacultetID = __FacultetID__;
";


$res_dates = mysql_query($query_dates);$QUERY_COUNT++;
$dates_count = mysql_num_rows($res_dates);
echo mysql_error();
for ($i = 0; $i < $dates_count; $i++){
    $dates[$i] = mysql_fetch_assoc($res_dates);
    $mcday = explode("-",$dates[$i]['dt']);
    $dates[$i]['dt'] = "'".$dates[$i]['dt']."'";
    $cday[$i] = $mcday[2];
}


$table = array();
$res = mysql_query($query);$QUERY_COUNT++;
$s = 0;
	$PEREVIRKA = 0;
	
for ($i = 0; $i < mysql_num_rows($res); $i++){
	$row[$i] = mysql_fetch_assoc($res);
	$rowspan = $row[$i]['cnt'];
	if ($row[$i]['FacultetFullName'] == "Соціальної педагогіки та психології"){
		$row[$i]['FacultetFullName'] = "Соціальної педагогіки <br/> та психології";
	}
	
	$q = str_replace("__FacultetID__",$row[$i]['idFacultet'],$query_specializationsCodes);
	$res_specializationsCodes = mysql_query($q);$QUERY_COUNT++;
	$facultet_count_specializations = 0;
	$count_specializations = 0;
	$facultet_count_specializations = mysql_num_rows($res_specializationsCodes);

	
	for ($j = 0; $j < $facultet_count_specializations; $j++){
		$t = mysql_fetch_assoc($res_specializationsCodes);
		$specializationsCodes[$t['SpecialityClasifierCode']] = $t['SpecialityClasifierCode'];
	}
	
	if ($facultet_count_specializations){
		$q = str_replace("`SpecialityClasifierCode`='__CODE__' AND","MID(`SpecialityClasifierCode`,1,1)='".$OKR."' AND",$query_specializations);
		$q = str_replace("__FacultetID__",$row[$i]['idFacultet'],$q);
		$rowspan = mysql_num_rows(mysql_query($q)) + mysql_num_rows(mysql_query("SELECT DISTINCT `SpecialityClasifierCode` AS `s_cc` FROM `specialities` WHERE SpecialitySpecializationName = '' AND FacultetID =".$row[$i]['FacultetID']));$QUERY_COUNT+=2;
	}
	$table[$s] = "<tr><td rowspan='".$rowspan."'><p title='".$row[$i]['idFacultet']."'>".$row[$i]['FacultetFullName']."</p></td>";
	
	
	$q = str_replace("__FacultetID__",$row[$i]['idFacultet'],$query_specs);
	$res_specs = mysql_query($q);$QUERY_COUNT++;

	$N = $row[$i]['cnt'];
	
	for ($j = 0; $j < $N; $j++){
		$spec = mysql_fetch_assoc($res_specs);
		if ($facultet_count_specializations){
			if (isset($specializationsCodes[$spec['SpecialityClasifierCode']])){
				$q = str_replace("__CODE__",$spec['SpecialityClasifierCode'],$query_specializations);
				$q = str_replace("__FacultetID__",$row[$i]['idFacultet'],$q);
				$res_specializations = mysql_query($q);$QUERY_COUNT++;
				$count_specializations = mysql_num_rows($res_specializations);
			}
		}
		if ($spec['SpecialityClasifierCode'] == "6.040106" || 
                    $spec['SpecialityClasifierCode'] == "7.04010601" || 
                    $spec['SpecialityClasifierCode'] == "8.04010601"){
			$spec['spec'] = str_replace("навколишнього середовища","навколишнього<br/>середовища",$spec['spec']);
		}
		if ($count_specializations){
			for ($l = 0; $l < $count_specializations; $l++){
				$specialization = mysql_fetch_assoc($res_specializations);
				if (mb_strlen($specialization['s_name']) > 56) $Xspec .= "<br/>";
				$Xspec = $spec['spec'];
				$Xspec.="(".$specialization['s_name'].")";            
				if (!($j ==0 && $l == 0)){
						$table[$s] .= "<tr>";
				}
				$table[$s] .= "<td>".$Xspec."</td>";
				$general_count_dnevn = 0;
				$general_count_dnevn_pzk = 0;
				$general_count_dnevn_pv = 0;
				
				$general_count_zaoch = 0;
				$general_count_zaoch_pzk = 0;
				$general_count_zaoch_pv = 0;
				for ($date_index = 0; $date_index < $dates_count; $date_index++){
					$q = str_replace("__DATE__",$dates[$date_index]['dt'],$query_counts);
					$q = str_replace("__CODE__",$spec['SpecialityClasifierCode'],$q);
					$q = str_replace("__FacultetID__",$row[$i]['idFacultet'],$q);
					$q = str_replace("/**/"," AND specialities.SpecialitySpecializationName='".$specialization['s_name']."'",$q);
					$q .= " AND specialities.SpecialitySpecializationName='".$specialization['s_name']."'";
					$res_counts = mysql_query($q);$QUERY_COUNT++;
					//echo $q."<br/>------<br/>";
					$count = mysql_fetch_assoc($res_counts);
					$PEREVIRKA += $count['B_dnevn_per_day'];
					$general_count_dnevn += $count['B_dnevn_per_day'];
					$general_count_dnevn_pzk += $count['B_dnevn_pzk_per_day'];
					$general_count_dnevn_pv += $count['B_dnevn_pv_per_day'];
					$general_count_zaoch += $count['B_zaoch_per_day'];
					$general_count_zaoch_pzk += $count['B_zaoch_pzk_per_day'];
					$general_count_zaoch_pv += $count['B_zaoch_pv_per_day'];
					foreach ($count as $key => $val){
							$PersonEducationFormID = (preg_match("/dnevn/",$key) != 0)?(1):(2);
							$count[$key] = preg_replace("/([1-9][0-9]*)/","<a href='".Yii::app()->createUrl("statistic/print").
										"?secname=".urlencode($_GET["secname"]).
										"&FacultetID=".$row[$i]['idFacultet'].
										"&SpecialityClasifierCode=".$spec['SpecialityClasifierCode'].
										"&PersonEducationFormID=".$PersonEducationFormID.
										"&date=".str_replace("'","",$dates[$date_index]['dt']).
										"&SpecialitySpecializationName=".urlencode($specialization['s_name']).
									"' target='blank'> $1 </a>",$val);

							if ($val =="") $count[$key] = "0";
					}
					if (isset($_GET['days'])){
						$table[$s] .= "<td>".$count['B_dnevn_per_day']."</td><td>".$count['B_dnevn_pzk_per_day']."</td><td style='border-right:2px solid black;'>".$count['B_dnevn_pv_per_day']."</td><td>".$count['B_zaoch_per_day']."</td><td>".$count['B_zaoch_pzk_per_day']."</td><td style='border-right:4px solid violet;'>".$count['B_zaoch_pv_per_day']."</td>";
					}
				}
				$table[$s] .= "<td style='font-weight: bold;'>".$general_count_dnevn."</td><td style='font-weight: bold;'>".$general_count_dnevn_pzk."</td><td style='border-right:2px solid black;font-weight: bold;'>".$general_count_dnevn_pv."</td><td style='font-weight: bold;'>".$general_count_zaoch."</td><td style='font-weight: bold;'>".$general_count_zaoch_pzk."</td><td style='border-right:4px solid violet;font-weight: bold;'>".$general_count_zaoch_pv."</td></tr>";
				$s++;
			}
		} else {
			if ($j > 0){
				$table[$s] .= "<tr>";
			}
                        $table[$s] .= "<td>".$spec['spec']."</td>";
						$general_count_dnevn = 0;
						$general_count_dnevn_pzk = 0;
						$general_count_dnevn_pv = 0;
						
						$general_count_zaoch = 0;
						$general_count_zaoch_pzk = 0;
						$general_count_zaoch_pv = 0;
                        for ($date_index = 0; $date_index < $dates_count; $date_index++){
                            $q = str_replace("__DATE__",$dates[$date_index]['dt'],$query_counts);
                            $q = str_replace("__CODE__",$spec['SpecialityClasifierCode'],$q);
                            $q = str_replace("__FacultetID__",$row[$i]['idFacultet'],$q);
                            $res_counts = mysql_query($q);$QUERY_COUNT++;
                            $count = mysql_fetch_assoc($res_counts);
                            $PEREVIRKA += $count['B_dnevn_per_day'];
							$general_count_dnevn += $count['B_dnevn_per_day'];
							$general_count_dnevn_pzk += $count['B_dnevn_pzk_per_day'];
							$general_count_dnevn_pv += $count['B_dnevn_pv_per_day'];
							$general_count_zaoch += $count['B_zaoch_per_day'];
							$general_count_zaoch_pzk += $count['B_zaoch_pzk_per_day'];
							$general_count_zaoch_pv += $count['B_zaoch_pv_per_day'];
                            foreach ($count as $key => $val){
                                            $PersonEducationFormID = (preg_match("/dnevn/",$key) != 0)?(1):(2);
                                            $count[$key] = preg_replace("/([1-9][0-9]*)/","<a href='".Yii::app()->createUrl("statistic/print").
                                                    "?secname=".urlencode($_GET["secname"]).
                                                    "&FacultetID=".$row[$i]['idFacultet'].
                                                    "&SpecialityClasifierCode=".$spec['SpecialityClasifierCode'].
                                                    "&PersonEducationFormID=".$PersonEducationFormID.
                                                    "&date=".str_replace("'","",$dates[$date_index]['dt']).
                                               "' target='blank'> $1 </a>",$val);
                                            if ($val =="") $count[$key] = "0"; 
                            }
							if (isset($_GET['days'])){
								$table[$s] .= "<td>".$count['B_dnevn_per_day']."</td><td>".$count['B_dnevn_pzk_per_day']."</td><td style='border-right:2px solid black;'>".$count['B_dnevn_pv_per_day']."</td><td>".$count['B_zaoch_per_day']."</td><td>".$count['B_zaoch_pzk_per_day']."</td><td style='border-right:4px solid violet;'>".$count['B_zaoch_pv_per_day']."</td>";
							}
                        }
                        $table[$s] .= "<td style='font-weight: bold;'>".$general_count_dnevn."</td><td style='font-weight: bold;'>".$general_count_dnevn_pzk."</td><td style='border-right:2px solid black;font-weight: bold;'>".$general_count_dnevn_pv."</td><td style='font-weight: bold;'>".$general_count_zaoch."</td><td style='font-weight: bold;'>".$general_count_zaoch_pzk."</td><td style='border-right:4px solid violet;font-weight: bold;'>".$general_count_zaoch_pv."</td></tr>";
                        $s++;
		}
	}
	
}


for ($date_index = 0; $date_index < $dates_count; $date_index++){
    $q = str_replace("__DATE__",$dates[$date_index]['dt'],$gen_counts_query);
    $gen_counts_res = mysql_query($q);$QUERY_COUNT++;
	//echo $q;echo "<br/>";
	//var_dump($gen_counts_res);echo "<br/>";
    $gen_counts[$date_index] = mysql_fetch_assoc($gen_counts_res);
}

?>
<center>
<h1>
Кількість заявок абітурієнтів<br/>
Освітньо-кваліфікаційний рівень "<?php
switch ($OKR) {
case 6: echo "Бакалавр";break;
case 7: echo "Спеціаліст";break;
case 8: echo "Магістр";break;
}
?>"
</h1>
<table border=1 cellspacing=0>
<tr>
<th rowspan="2" align='center'>Факультети</th>
<th rowspan="2" align='center'>Спеціальності</th>
<?php
for ($date_index = 0; ($date_index < $dates_count && isset($_GET['days'])); $date_index++){
?>
    <th colspan="6" align='center' style="font-size:10pt;border-right:2px solid black;">За <br/><?php echo $cday[$date_index];?>.07.2013</th>
<?php } ?>
    <th colspan="6">Загалом</th>
</tr>
<tr>
    <th align='center' style="font-size:10pt;">Денна<br/>кількість</th>
	<th align='center' style="font-size:7pt;">Із них<br/>поза конкурсом</th>
	<th align='center' style="font-size:7pt;border-right:2px solid black;">Із них<br/>першочергово</th>
	<th align='center' style="font-size:10pt;">Заочна<br/>кількість</th>
	<th align='center' style="font-size:7pt;">Із них<br/>поза конкурсом</th>
	<th align='center' style="font-size:7pt;border-right:3px solid violet;">Із них<br/>першочергово</th>
<?php
for ($date_index = 0; ($date_index < $dates_count && isset($_GET['days'])); $date_index++){
?>
    <th align='center' style="font-size:10pt;">Денна<br/>кількість</th>
	<th align='center' style="font-size:7pt;">Із них<br/>поза конкурсом</th>
	<th align='center' style="font-size:7pt;border-right:2px solid black;">Із них<br/>першочергово</th>
	<th align='center' style="font-size:10pt;">Заочна<br/>кількість</th>
	<th align='center' style="font-size:7pt;">Із них<br/>поза конкурсом</th>
	<th align='center' style="font-size:7pt;border-right:3px solid violet;">Із них<br/>першочергово</th>
<?php } ?>
</tr>
<?php for ($i = 0; $i < count($table); $i++){echo $table[$i];}?>
<tr>
<td colspan="2"><p title='кількість запитів (mysql_query): <?php echo $QUERY_COUNT;?>'>Всього</p></td>
<?php
$GCount_d = 0;
$GCount_d_pzk = 0;
$GCount_d_pv = 0;
$GCount_z = 0;
$GCount_z_pzk = 0;
$GCount_z_pv = 0;
for ($date_index = 0; $date_index < $dates_count; $date_index++){
?>
    <<?php if (!isset($_GET['days'])) { echo "!--";}?>td style="font-weight:bold;font-style:italic;">
        <?php echo $gen_counts[$date_index]['all-dnevn-XX.07.2013'];
        $GCount_d+=$gen_counts[$date_index]['all-dnevn-XX.07.2013'];?>
    </td>
    <td style="font-weight:bold;font-style:italic;">
        <?php echo $gen_counts[$date_index]['all-dnevn-pzk-XX.07.2013'];
        $GCount_d_pzk+=$gen_counts[$date_index]['all-dnevn-pzk-XX.07.2013'];?>
    </td>
    <td style="border-right:2px solid black;font-weight:bold;font-style:italic;">
        <?php echo $gen_counts[$date_index]['all-dnevn-pv-XX.07.2013'];
        $GCount_d_pv+=$gen_counts[$date_index]['all-dnevn-pv-XX.07.2013'];?>
    </td>
    <td style="font-weight:bold;font-style:italic;">
        <?php echo $gen_counts[$date_index]['all-zaochn-XX.07.2013'];
        $GCount_z+=$gen_counts[$date_index]['all-zaochn-XX.07.2013'];?>
    </td>
    <td style="font-weight:bold;font-style:italic;">
        <?php echo $gen_counts[$date_index]['all-zaochn-pzk-XX.07.2013'];
        $GCount_z_pzk+=$gen_counts[$date_index]['all-zaochn-pzk-XX.07.2013'];?>
    </td>
    <td style="border-right:4px solid violet;font-weight:bold;font-style:italic;">
        <?php echo $gen_counts[$date_index]['all-zaochn-pv-XX.07.2013'];
        $GCount_z_pv+=$gen_counts[$date_index]['all-zaochn-pv-XX.07.2013'];?>
    </td<?php if (!isset($_GET['days'])) { echo "--";}?>>
<?php
}
?>
<td style="font-weight:900;">
    <?php echo $GCount_d;?>
</td>
<td style="font-weight:900;">
    <?php echo $GCount_d_pzk;?>
</td>
<td style="font-weight:900;">
    <?php echo $GCount_d_pv;?>
</td>
<td style="font-weight:900;">
    <?php echo $GCount_z;?>
</td>
<td style="font-weight:900;">
    <?php echo $GCount_z_pzk;?>
</td>
<td style="font-weight:900;">
    <?php echo $GCount_z_pv;?>
</td>
</tr>
</table>
</center>


</body>
</html>

<?php mysql_close(); ?>