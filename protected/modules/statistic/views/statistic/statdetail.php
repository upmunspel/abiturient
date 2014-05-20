<?php
/* @var $cnt_data array */
/* @var $spec_ident string */
/* @var $date_from string */
/* @var $date_to string */
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
	font-size: 12pt;
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

<center>
<h1>
Кількість заявок абітурієнтів<br/>
Освітньо-кваліфікаційний рівень "<?php
switch ($spec_ident) {
case 6: echo "Бакалавр";break;
case 7: echo "Спеціаліст";break;
case 8: echo "Магістр";break;
}
?>"
<br/>
<?php echo $date_from . ' - ' . $date_to; ?>
</h1>
<table border=1 cellspacing=0 style='width:18cm;'>
<tr>
  <th rowspan="2" align='center'>Факультети</th>
  <th rowspan="2" align='center'>Спеціальності</th>
  <th colspan="2" align='center' style="font-size:10pt;">Вього заявок</th>
  <th colspan="2" align='center' style="font-size:10pt;">На бюджет</th>
  <th colspan="2" align='center' style="font-size:10pt;">На контракт</th>
  <th colspan="1" align='center' style="font-size:10pt;">Електронні заявки</th>
  <th colspan="1" align='center' style="font-size:10pt;">Оригінали</th>
</tr>
<tr>

  <th align='center' style="font-size:10pt;">Денна<br/>кількість</th>
  <th align='center' style="font-size:10pt;">Заочна<br/>кількість</th>

  <th align='center' style="font-size:10pt;">Денна<br/>кількість</th>
  <th align='center' style="font-size:10pt;">Заочна<br/>кількість</th>

  <th align='center' style="font-size:10pt;">Денна<br/>кількість</th>
  <th align='center' style="font-size:10pt;">Заочна<br/>кількість</th>

  <th align='center' style="font-size:10pt;">Денна<br/>кількість</th>

  <th align='center' style="font-size:10pt;">Денна<br/>кількість</th>

</tr>
<?php 
foreach ($cnt_data as $row){
  $i = 0;
  foreach ($row as $key => $data){
    echo "<tr>";
    if ($key == 'name' && $i == 0){
      echo "<td rowspan=".(count($row)).">".$data."</td>";
      $i++;
      continue;
    }
    echo "<td>".$key."</td>";
    echo "<td>".((isset($data[1]))? 
            $data[1]['cnt_requests'] : '0') ."</td>";
    echo "<td>".((isset($data[2]))? 
            $data[2]['cnt_requests'] : '0') ."</td>";
    
    echo "<td>".((isset($data[1]))? 
            $data[1]['cnt_req_budget'] : '0') ."</td>";
    echo "<td>".((isset($data[2]))? 
            $data[2]['cnt_req_budget'] : '0') ."</td>";

    echo "<td>".((isset($data[1]))? 
            $data[1]['cnt_req_contract'] : '0') ."</td>";
    echo "<td>".((isset($data[2]))? 
            $data[2]['cnt_req_contract'] : '0') ."</td>";
    
    echo "<td>".((isset($data[1]))? 
            $data[1]['cnt_req_electro'] : '0') ."</td>";
    
    echo "<td>".((isset($data[1]))? 
            $data[1]['cnt_req_originals'] : '0') ."</td>";
    
    echo "</tr>";
    $i++;
  }  
}
?>

</table>
</center>


</body>
</html>
