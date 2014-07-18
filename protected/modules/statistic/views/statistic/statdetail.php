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
	font-size: 13pt;
  font-family: Tahoma;
	/* border: 1px solid black; */
  padding: 5px;
}
TH {
	font-size: 14pt;
	/* border: 1px solid black; */
  font-family: Tahoma;  
}
H1 {
	font-size: 16pt;
}

TABLE {
  width: 800px;
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
<table border=1 cellspacing=0 >
<tr>
  <th rowspan="1" align='center'>Факультети</th>
  <th rowspan="1" align='center'>Спеціальності</th>
  <th align='center' style="font-size:10pt;">Денна<br/>кількість</th>
  <?php if ($cbudget){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">На бюджет</th>
  <?php } if ($ccontract){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">На контракт</th>
  <?php } if ($cpv){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">Першочергово</th>
  <?php } if ($cpzk){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">Поза <br/> конкурсом</th>
  <?php } if ($celectro){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">Ел. заявки</th>
  <?php } if ($coriginals){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">Оригінали</th>
  <?php } if ($cDonetsk){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">Донецька <br/> обл.</th>
  <?php } if ($cLugansk){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">Луганська <br/> обл.</th>
  <?php } if ($cCrimea){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">Крим</th>
  <?php } ?>
  
  
  <th align='center' style="font-size:10pt;">Заочна<br/>кількість</th>
  <?php if ($cbudget){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">На бюджет</th>
  <?php } if ($ccontract){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">На контракт</th>
  <?php } if ($cpv){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">Першочергово</th>
  <?php } if ($cpzk){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">Поза <br/> конкурсом</th>
  <?php } if ($celectro){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">Ел. заявки</th>
  <?php } if ($coriginals){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">Оригінали</th>
  <?php } if ($cDonetsk){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">Донецька <br/> обл.</th>
  <?php } if ($cLugansk){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">Луганська <br/> обл.</th>
  <?php } if ($cCrimea){ ?>
  <th colspan="1" align='center' style="font-size:10pt;">Крим</th>
  <?php } ?>
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
    echo "<td style=' font-weight: bold;'>".((isset($data[1]))? 
            $data[1]['cnt_requests'] : '0') ."</td>";
    if ($cbudget){
      echo "<td>".((isset($data[1]))? 
              $data[1]['cnt_req_budget'] : '0') ."</td>";
    } if ($ccontract){
      echo "<td>".((isset($data[1]))? 
              $data[1]['cnt_req_contract'] : '0') ."</td>";
    } if ($cpv){
      echo "<td>".((isset($data[1]))? 
              $data[1]['cnt_req_pv'] : '0') ."</td>";
    } if ($cpzk){
      echo "<td>".((isset($data[1]))? 
              $data[1]['cnt_req_pzk'] : '0') ."</td>";
    } if ($celectro){
      echo "<td>".((isset($data[1]))? 
              $data[1]['cnt_req_electro'] : '0') ."</td>";
    } if ($coriginals){
      echo "<td>".((isset($data[1]))? 
              $data[1]['cnt_req_originals'] : '0') ."</td>";
    } if ($cDonetsk){
      echo "<td>".((isset($data[1]))? 
              $data[1]['cnt_req_Donetsk'] : '0') ."</td>";
    } if ($cLugansk){
      echo "<td>".((isset($data[1]))? 
              $data[1]['cnt_req_Lugansk'] : '0') ."</td>";
    } if ($cCrimea){
      echo "<td> ".((isset($data[1]))? 
              $data[1]['cnt_req_Crimea'] : '0') ."</td>";
    }
    
    
    echo "<td style='border-left: 3px solid grey; font-weight: bold;'> ".((isset($data[2]))? 
            $data[2]['cnt_requests'] : '0') ."</td>";
    if ($cbudget){
      echo "<td>".((isset($data[2]))? 
              $data[2]['cnt_req_budget'] : '0') ."</td>";
    } if ($ccontract){
      echo "<td>".((isset($data[2]))? 
              $data[2]['cnt_req_contract'] : '0') ."</td>";
    } if ($cpv){
      echo "<td>".((isset($data[2]))? 
              $data[2]['cnt_req_pv'] : '0') ."</td>";
    } if ($cpzk){
      echo "<td>".((isset($data[2]))? 
              $data[2]['cnt_req_pzk'] : '0') ."</td>";
    } if ($celectro){
      echo "<td>".((isset($data[2]))? 
              $data[2]['cnt_req_electro'] : '0') ."</td>";
    } if ($coriginals){
      echo "<td>".((isset($data[2]))? 
              $data[2]['cnt_req_originals'] : '0') ."</td>";
    } if ($cDonetsk){
      echo "<td>".((isset($data[2]))? 
              $data[2]['cnt_req_Donetsk'] : '0') ."</td>";
    } if ($cLugansk){
      echo "<td>".((isset($data[2]))? 
              $data[2]['cnt_req_Lugansk'] : '0') ."</td>";
    } if ($cCrimea){
      echo "<td>".((isset($data[2]))? 
              $data[2]['cnt_req_Crimea'] : '0') ."</td>";
    }
    
    echo "</tr>";
    $i++;
  }  
}
?>
<tr>
    <td colspan="2"><p>Всього заявок</p></td>
<?php
    echo "<td>".((isset($cnt_atall[1]))? 
            $cnt_atall[1]['cnt_requests'] : '0') ."</td>";
    if ($cbudget){
      echo "<td>".((isset($cnt_atall[1]))? 
              $cnt_atall[1]['cnt_req_budget'] : '0') ."</td>";
    } if ($ccontract){
      echo "<td>".((isset($cnt_atall[1]))? 
              $cnt_atall[1]['cnt_req_contract'] : '0') ."</td>";
    } if ($cpv){
      echo "<td>".((isset($cnt_atall[1]))? 
              $cnt_atall[1]['cnt_req_pv'] : '0') ."</td>";
    } if ($cpzk){
      echo "<td>".((isset($cnt_atall[1]))? 
              $cnt_atall[1]['cnt_req_pzk'] : '0') ."</td>";
    } if ($celectro){
      echo "<td>".((isset($cnt_atall[1]))? 
              $cnt_atall[1]['cnt_req_electro'] : '0') ."</td>";
    } if ($coriginals){
      echo "<td>".((isset($cnt_atall[1]))? 
              $cnt_atall[1]['cnt_req_originals'] : '0') ."</td>";
    } if ($cDonetsk){
      echo "<td>".((isset($cnt_atall[1]))? 
              $cnt_atall[1]['cnt_req_Donetsk'] : '0') ."</td>";
    } if ($cLugansk){
      echo "<td>".((isset($cnt_atall[1]))? 
              $cnt_atall[1]['cnt_req_Lugansk'] : '0') ."</td>";
    } if ($cCrimea){
      echo "<td> ".((isset($cnt_atall[1]))? 
              $cnt_atall[1]['cnt_req_Crimea'] : '0') ."</td>";
    }
    
    
    echo "<td style='border-left: 3px solid grey;'> ".((isset($cnt_atall[2]))? 
            $cnt_atall[2]['cnt_requests'] : '0') ."</td>";
    if ($cbudget){
      echo "<td>".((isset($cnt_atall[2]))? 
              $cnt_atall[2]['cnt_req_budget'] : '0') ."</td>";
    } if ($ccontract){
      echo "<td>".((isset($cnt_atall[2]))? 
              $cnt_atall[2]['cnt_req_contract'] : '0') ."</td>";
    } if ($cpv){
      echo "<td>".((isset($cnt_atall[2]))? 
              $cnt_atall[2]['cnt_req_pv'] : '0') ."</td>";
    } if ($cpzk){
      echo "<td>".((isset($cnt_atall[2]))? 
              $cnt_atall[2]['cnt_req_pzk'] : '0') ."</td>";
    } if ($celectro){
      echo "<td>".((isset($cnt_atall[2]))? 
              $cnt_atall[2]['cnt_req_electro'] : '0') ."</td>";
    } if ($coriginals){
      echo "<td>".((isset($cnt_atall[2]))? 
              $cnt_atall[2]['cnt_req_originals'] : '0') ."</td>";
    } if ($cDonetsk){
      echo "<td>".((isset($cnt_atall[2]))? 
              $cnt_atall[2]['cnt_req_Donetsk'] : '0') ."</td>";
    } if ($cLugansk){
      echo "<td>".((isset($cnt_atall[2]))? 
              $cnt_atall[2]['cnt_req_Lugansk'] : '0') ."</td>";
    } if ($cCrimea){
      echo "<td>".((isset($cnt_atall[2]))? 
              $cnt_atall[2]['cnt_req_Crimea'] : '0') ."</td>";
    }
?>
</tr>
<tr>
<td colspan="2">
    <p>
        Всього абітурієнтів
    </p>
</td>
<?php
    $colspan = 2;
    if ($cbudget){
      $colspan+=2;
    } if ($ccontract){
      $colspan+=2;
    } if ($cpv){
      $colspan+=2;
    } if ($cpzk){
      $colspan+=2;
    } if ($celectro){
      $colspan+=2;
    } if ($coriginals){
      $colspan+=2;
    } if ($cDonetsk){
      $colspan+=2;
    } if ($cLugansk){
      $colspan+=2;
    } if ($cCrimea){
      $colspan+=2;
    }
?>  
  <td style="text-align: center;" colspan="<?php echo $colspan; ?>"><?php echo $cnt_person; ?></td>
</tr>
</table>
</center>


</body>
</html>
