<?php
/* @var $cnt_data array */
/* @var $cnt_atall array */
/* @var $DateFrom string */
/* @var $DateTo string */
/* @var $Qualification string */
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<title>СТАТИСТИКА ВСТУПУ ВИПУСКНИКІВ</title>
<style media="print">
TD {
  font-size: 15pt;
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
Кількість заявок абітурієнтів,<br/>
на ОКР  "<?php echo $Qualification; ?>" проміжком <?php echo $DateFrom . ' - ' . $DateTo; ?>
</h1>
<table border=1 cellspacing=0 style='width:18cm;'>
  <tr>
  <th rowspan="2" align='center'>Факультети</th> <!-- 1 -->
  <th rowspan="2" align='center'>Напрями</th>    <!-- 2 -->
  <th colspan="6" align='center' style="font-size:10pt;">Денна<br/>кількість</th>
  <th colspan="6" align='center' style="font-size:10pt;">Заочна<br/>кількість</th>
  </tr>
  <tr>
  <th align='center' style="font-size:10pt;">Ліцензія, місць</th> <!-- 3 -->
  <th align='center' style="font-size:10pt;">ЗНУ</th>       <!-- 4 -->
  <th align='center' style="font-size:10pt;">Інші</th>      <!-- 5 -->
  <th align='center' style="font-size:10pt;">Всього</th>    <!-- 6 -->
  <th align='center' style="font-size:10pt;">Бюдж. місця</th><!-- 7 -->
  <th align='center' style="font-size:10pt;">Оригінали</th><!-- 8 -->
  <th align='center' style="font-size:10pt;">Ліцензія, місць</th><!-- 9 -->
  <th align='center' style="font-size:10pt;">ЗНУ</th><!-- 10 -->
  <th align='center' style="font-size:10pt;">Інші</th><!-- 11 -->
  <th align='center' style="font-size:10pt;">Всього</th><!-- 12 -->
  <th align='center' style="font-size:10pt;">Бюдж. місця</th><!-- 13 -->
  <th align='center' style="font-size:10pt;">Оригінали</th><!-- 14 -->

  </tr>
<?php 
foreach ($cnt_data as $row){
  $i = 0;
  foreach ($row as $key => $data){
    echo "<tr>";
    if ($key == 'name' && $i == 0){
      // col1
      echo "<td rowspan=".(count($row)).">".$data."</td>"; 
      $i++;
      continue;
    }
    // col2
    echo "<td style='font-size: 10pt;'>".$key."</td>";
    
    // col3
    // echo "<td style='color: grey;'>".((isset($data[1]))? $data[1]['graduated'] : '0') ."</td>";
    echo "<td style='color: grey;'>".((isset($data[1]))? $data[1]['licensedPlaces'] : '0') ."</td>";

    // col4
    echo "<td>".((isset($data[1]))? 
            $data[1]['cnt_requests_from_us'] : '0') ."</td>";

    // col5
    echo "<td>".((isset($data[1]))? 
            (($data[1]['cnt_requests_from_aliens'])? "<a href='".Yii::app()->request->baseUrl."/statistic/rept/index?fields=0%2C7%2C13%2C12%2C18%2C24&cond%5B0%5D=0&cond%5B1%5D=0&acondval%5B1%5D=&cond%5B2%5D=0&acondval%5B2%5D=&cond%5B3%5D=0&cond%5B4%5D=0&cond%5B5%5D=0&cond%5B6%5D=0&cond%5B7%5D=1&condval%5B7%5D=&acondval%5B7%5D=".$data[1]['idSpec']."&cond%5B8%5D=0&cond%5B9%5D=0&cond%5B10%5D=0&cond%5B11%5D=0&cond%5B12%5D=0&cond%5B13%5D=5&condval%5B13%5D=".$DateFrom."&acondval%5B13%5D=".$DateTo."&cond%5B14%5D=0&cond%5B15%5D=0&cond%5B16%5D=0&cond%5B17%5D=0&cond%5B18%5D=3&condval%5B18%5D=%D0%97%D0%B0%D0%BF%D0%BE%D1%80%D1%96%D0%B7%D1%8C%D0%BA%D0%B8%D0%B9+%D0%BD%D0%B0%D1%86%D1%96%D0%BE%D0%BD%D0%B0%D0%BB%D1%8C%D0%BD%D0%B8%D0%B9+%D1%83%D0%BD%D1%96%D0%B2%D0%B5%D1%80%D1%81%D0%B8%D1%82%D0%B5%D1%82&cond%5B19%5D=0&cond%5B20%5D=0&cond%5B21%5D=0&cond%5B22%5D=0&cond%5B23%5D=0&cond%5B24%5D=2&condval%5B24%5D=%D0%94%D0%B8%D0%BF%D0%BB%D0%BE%D0%BC&yt2='>".$data[1]['cnt_requests_from_aliens'] . '</a>' : '0') : '0') ."</td>";

    // col6
    echo "<td>".((isset($data[1]))? 
            ($data[1]['cnt_requests_from_us']+$data[1]['cnt_requests_from_aliens']) : '0') ."</td>";

    // col7
    echo "<td style='font-style: italic;'>".((isset($data[1]))? 
            0+$data[1]['cnt_req_budget'] : '0') ."</td>";

    // col8
    echo "<td style='border-right: 5px solid grey;'>".((isset($data[1]))? 
            $data[1]['cnt_req_originals'] : '0') ."</td>";

    // col9
    // echo "<td style='color: grey;'>".((isset($data[2]))? $data[2]['graduated'] : '0') ."</td>";
    echo "<td style='color: grey;'>".((isset($data[2]))? $data[2]['licensedPlaces'] : '0') ."</td>";

    // col10
    echo "<td>".((isset($data[2]))? 
            $data[2]['cnt_requests_from_us'] : '0') ."</td>";

    // col11
    echo "<td>".((isset($data[2]))? 
            (($data[2]['cnt_requests_from_aliens'])? "<a href='".Yii::app()->request->baseUrl."/statistic/rept/index?fields=0%2C7%2C13%2C12%2C18%2C24&cond%5B0%5D=0&cond%5B1%5D=0&acondval%5B1%5D=&cond%5B2%5D=0&acondval%5B2%5D=&cond%5B3%5D=0&cond%5B4%5D=0&cond%5B5%5D=0&cond%5B6%5D=0&cond%5B7%5D=1&condval%5B7%5D=&acondval%5B7%5D=".$data[2]['idSpec']."&cond%5B8%5D=0&cond%5B9%5D=0&cond%5B10%5D=0&cond%5B11%5D=0&cond%5B12%5D=0&cond%5B13%5D=5&condval%5B13%5D=".$DateFrom."&acondval%5B13%5D=".$DateTo."&cond%5B14%5D=0&cond%5B15%5D=0&cond%5B16%5D=0&cond%5B17%5D=0&cond%5B18%5D=3&condval%5B18%5D=%D0%97%D0%B0%D0%BF%D0%BE%D1%80%D1%96%D0%B7%D1%8C%D0%BA%D0%B8%D0%B9+%D0%BD%D0%B0%D1%86%D1%96%D0%BE%D0%BD%D0%B0%D0%BB%D1%8C%D0%BD%D0%B8%D0%B9+%D1%83%D0%BD%D1%96%D0%B2%D0%B5%D1%80%D1%81%D0%B8%D1%82%D0%B5%D1%82&cond%5B19%5D=0&cond%5B20%5D=0&cond%5B21%5D=0&cond%5B22%5D=0&cond%5B23%5D=0&cond%5B24%5D=2&condval%5B24%5D=%D0%94%D0%B8%D0%BF%D0%BB%D0%BE%D0%BC&yt2='>".$data[2]['cnt_requests_from_aliens'] . '</a>' : '0') : '0') ."</td>";

    // col12
    echo "<td>".((isset($data[2]))? 
            ($data[2]['cnt_requests_from_us']+$data[2]['cnt_requests_from_aliens']) : '0') ."</td>";
    
    // col13
    echo "<td style='font-style: italic;'>".((isset($data[2]))? 
            0+$data[2]['cnt_req_budget'] : '0') ."</td>";
    
    // col14
    echo "<td>".((isset($data[2]))? 
            $data[2]['cnt_req_originals'] : '0') ."</td>";
    
    echo "</tr>";
    $i++;
  }  
}
?>
<tr>
  <th colspan=2>
    Всього заявок
  </th>
  <th>
  </th>
  <th>
    <?php echo $cnt_atall[1][0]; ?>
  </th>
  <th>
    <?php echo $cnt_atall[1][1]; ?>
  </th>
  <th>
    <?php echo $cnt_atall[1][2]; ?>
  </th>
  <th>
    <?php echo $cnt_atall[1][3]; ?>
  </th>
  <th style='border-right: 5px solid grey;'>
    <?php echo $cnt_atall[1][4]; ?>
  </th>
  <th>
  </th>
  <th>
    <?php echo $cnt_atall[2][0]; ?>
  </th>
  <th>
    <?php echo $cnt_atall[2][1]; ?>
  </th>
  <th>
    <?php echo $cnt_atall[2][2]; ?>
  </th>
  <th>
    <?php echo $cnt_atall[2][3]; ?>
  </th>
  <th>
    <?php echo $cnt_atall[2][4]; ?>
  </th>
</tr>
</table>
</center>


</body>
</html>
