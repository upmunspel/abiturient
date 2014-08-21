<?php
/* @var $data array */
/* @var $Speciality string */
/* @var $Faculty string */
/* @var $license_info array */
/* @var $toexcel integer */

  ?>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $Speciality; ?></title>
    <link rel="stylesheet" href="<?php echo Yii::app()->CreateUrl('css/vinfo1.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo Yii::app()->CreateUrl('css/vinfo2.css'); ?>" type="text/css" media="screen">

  </head>
<?php
?>
<body>

<div class="row"><div class="col"><center>
  <h1>Інформація про подані абітурієнтами заяви</h1>
  <TABLE cellspacing="0" border="0"
         class="striped" width='73%'>
    <TR>
      <TD colspan='1' class="faculty">
        <?php echo 'Факультет:'; ?>
        <?php echo $Faculty; ?>
      </TD>
    </TR>
    <TR>
      <TD colspan='1' class="direction">
        <?php 'Напрям підготовки: '; ?>
        <?php
        echo $Speciality;
        ?>
      </TD>
    </TR>
    <TR>
      <TD colspan='1' class="license_count">
        <?php echo 'Ліцензійний обсяг: ';
        echo ($license_info[2][1] + $license_info[1][1]);
        ?>
      </TD>
    </TR>
    <TR>
      <TD colspan='1' class="budget_count">
        <?php echo 'Обсяг державного замовлення: ';
        echo $license_info[2][1]; ?>
      </TD>
    </TR>
    <TR>
      <TD colspan='1' class="quota_count">
        <?php echo 'з них квота пільговиків: '; ?>
        <?php echo $license_info[3][1]; ?>
        <?php echo ', квота цільовиків: '; ?>
        <?php $count_q = 0; 
        foreach ($license_info as $key => $info){
          if ($key > 3){
            echo '<br/>' . $info[0] . ' : '. $info[1];
            $count_q++;
          }
        }     
        if (!$count_q){
          echo '0';
        } 
       ?>
      </TD>
    </TR>
  </TABLE>
<table class="striped" border="0" cellpadding="0" cellspacing="0" width="73%"><thead><tr>
<td><div><b>#</b></div></td>
<td title="Прізвище, ім&#39;я, по-батькові абітурієнта"><div><b>ПІБ</b></div></td>
<td title="Сума всіх балів"><div><b>&#931;</b></div></td>
<td title="Середній бал документа про освіту"><div><b>С</b></div></td>
<td title="Бали сертифікатів ЗНО"><div><b>ЗНО</b></div></td>
<td title="Бали екзаменів"><div><b>Е</b></div></td>
<td title="Додаткові бали за диплом Всеукраїнської олімпіади або за диплом конкурсу МАН"><div><b>О</b></div></td>
<td title="Додаткові бали для випускника підготовчого відділення"><div><b>П</b></div></td>
<?php if (mb_substr($Speciality,0,1) == '8'){ ?>
<td title="Додаткові бали"><div><b>ДБ</b></div></td>
<?php } ?>
<td title="Право на позаконкурсний вступ"><div><b>ПК</b></div></td>
<td title="Право на першочерговий вступ"><div><b>ПЧ</b></div></td>
<td title="Цільове направлення"><div><b>Ц</b></div></td>
<td title="Оригінали документів на цю спеціальність"><div><b>Д</b></div></td>
<td title="Оригінали документів на іншій спеціальності"><div><b>ІД</b></div></td>
</tr></thead>
  <tbody>
  <?php if (!empty($data)){ ?>
  
<?php $counter = 1; foreach ($data as $key => $list) { if (!count($list)){continue;} ?>
<?php for ($i = 0; $i < count($list); $i++) { ?>
      <TR data-id="<?php echo $list[$i]['idPersonSpeciality']; ?>">
        <TD>
  <?php echo ($counter++); ?>
        </TD>
        <TD>
  <?php echo $list[$i]['PIB']; ?>
        </TD>
        <TD>
  <?php echo $list[$i]['Points']; ?>
        </TD>
        <TD>
  <?php echo $list[$i]['DocPoints']; ?>
        </TD>
        <TD>
  <?php echo $list[$i]['ZNO']; ?>
        </TD>
        <TD>
  <?php echo $list[$i]['ExamsPoints']; ?>
        </TD>
        <TD>
  <?php echo $list[$i]['OlympsPoints']; ?>
        </TD>
        <TD>
  <?php echo $list[$i]['CoursesPoints']; ?>
        </TD>
<?php if (mb_substr($Speciality,0,1) == '8'){ ?>
        <TD>
  <?php echo $list[$i]['AdditionalBall']; ?>
        </TD>
<?php } ?>
        <TD>
  <?php echo $list[$i]['isPZK']; ?>
        </TD>
        <TD>
  <?php echo $list[$i]['isExtra']; ?>
        </TD>
        <TD>
  <?php echo $list[$i]['isQuota']; ?>
        </TD>
        <TD>
  <?php echo $list[$i]['isOriginal']; ?>
        </TD>
        <TD>
  <?php echo $list[$i]['AnyOriginal']; ?>
        </TD>
      </TR>
<?php } // end for $list ?>
<?php } // end foreach $data  ?>

<?php } else { ?>
  <tr><td colspan=13>Немає даних</td></tr>
<?php } ?>
  </tbody>
</table>
</center></div></div>
<br/>
<center>
<table  cellspacing="0" border="0"
         class="striped" width='73%'>
<tr><td>ПІБ</td><td title="">Прізвище, ім&#39;я, по-батькові абітурієнта</td></tr>
<tr><td>&#931;</td><td title="">Сума всіх балів</td></tr>
<tr><td>С</td><td title="">Середній бал документа про освіту</td></tr>
<tr><td>ЗНО</td><td title="">Бали сертифікатів ЗНО</td></tr>
<tr><td>Е</td><td title="">Бали екзаменів</td></tr>
<tr><td>О</td><td title="">Додаткові бали за диплом Всеукраїнської олімпіади або за диплом конкурсу МАН</td></tr>
<tr><td>П</td><td title="">Додаткові бали для випускника підготовчого відділення</td></tr>
<?php if (mb_substr($Speciality,0,1) == '8'){ ?>
<tr><td>ДБ</td><td title="">Додаткові бали</td></tr>
<?php } ?>
<tr><td>ПК</td><td title="">Право на позаконкурсний вступ</td></tr>
<tr><td>ПЧ</td><td title="">Право на першочерговий вступ</td></tr>
<tr><td>Ц</td><td title="">Цільове направлення</td></tr>
<tr><td>Д</td><td title="">Оригінали документів на цю спеціальність</td></tr>
<tr><td>ІД</td><td title="">Оригінали документів на іншій спеціальності</td></tr>
</table></center>
<footer style="font-size: 8pt;">Сторінку створено <?php echo date('d.m.Y H:i:s'); ?> в ІС "Абітурієнт". <br/>
  Дизайн : <a href="http://vstup.info/">vstup.info</a>
</footer>
</body>
</html>