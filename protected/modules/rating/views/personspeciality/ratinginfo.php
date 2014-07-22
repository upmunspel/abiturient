<?php
/* @var $data array */
/* @var $Speciality string */
/* @var $Faculty string */
/* @var $_contract_counter integer */
/* @var $_budget_counter integer */
/* @var $_pzk_counter integer */
/* @var $_quota_counter integer */
/* @var $toexcel integer */
  header('Content-Type: text/html; charset=utf-8');
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Cache-Control: post-check=0, pre-check=0', FALSE);
  header('Pragma: no-cache');
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
        echo $_contract_counter + $_budget_counter;
        ?>
      </TD>
    </TR>
    <TR>
      <TD colspan='1' class="budget_count">
        <?php echo 'Обсяг державного замовлення: ';
        echo (0+$_budget_counter); ?>
      </TD>
    </TR>
    <TR>
      <TD colspan='1' class="quota_count">
        <?php echo 'з них квота пільговиків: '; ?>
        <?php echo (0+$_pzk_counter); ?>
        <?php echo ', квота цільовиків: '; ?>
        <?php echo (0+$_quota_counter); ?>
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
<td title="Право на позаконкурсний вступ"><div><b>ПК</b></div></td>
<td title="Право на першочерговий вступ"><div><b>ПЧ</b></div></td>
<td title="Цільове направлення"><div><b>Ц</b></div></td>
<td title="Оригінали документів на цю спеціальність"><div><b>Д</b></div></td>
<td title="Оригінали документів на іншій спеціальності"><div><b>ІД</b></div></td>
</tr></thead>
  <tbody>
  <?php if (!empty($data)){ ?>
    <!-- Цільовики-->
<?php for ($i = 1; $i < count($data['quota']) + 1; $i++) { ?>
      <TR data-id="<?php echo $data['quota'][$i]['idPersonSpeciality']; ?>">
        <TD>
  <?php echo ($i); ?>
        </TD>
        <TD>
  <?php echo $data['quota'][$i]['PIB']; ?>
        </TD>
        <TD>
  <?php echo $data['quota'][$i]['Points']; ?>
        </TD>
        <TD>
  <?php echo $data['quota'][$i]['DocPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['quota'][$i]['ZNO']; ?>
        </TD>
        <TD>
  <?php echo $data['quota'][$i]['ExamsPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['quota'][$i]['OlympsPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['quota'][$i]['CoursesPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['quota'][$i]['isPZK']; ?>
        </TD>
        <TD>
  <?php echo $data['quota'][$i]['isExtra']; ?>
        </TD>
        <TD>
  <?php echo $data['quota'][$i]['isQuota']; ?>
        </TD>
        <TD>
  <?php echo $data['quota'][$i]['isOriginal']; ?>
        </TD>
        <TD>
  <?php echo $data['quota'][$i]['AnyOriginal']; ?>
        </TD>
      </TR>
<?php } ?>
    <!-- Поза конкурсом -->
<?php for ($i = 1; $i < count($data['pzk']) + 1; $i++) { ?>
      <TR data-id="<?php echo $data['pzk'][$i]['idPersonSpeciality']; ?>">
        <TD>
  <?php echo ($i+count($data['quota'])); ?>
        </TD>
        <TD>
  <?php echo $data['pzk'][$i]['PIB']; ?>
        </TD>
        <TD>
  <?php echo $data['pzk'][$i]['Points']; ?>
        </TD>
        <TD>
  <?php echo $data['pzk'][$i]['DocPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['pzk'][$i]['ZNO']; ?>
        </TD>
        <TD>
  <?php echo $data['pzk'][$i]['ExamsPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['pzk'][$i]['OlympsPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['pzk'][$i]['CoursesPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['pzk'][$i]['isPZK']; ?>
        </TD>
        <TD>
  <?php echo $data['pzk'][$i]['isExtra']; ?>
        </TD>
        <TD>
  <?php echo $data['pzk'][$i]['isQuota']; ?>
        </TD>
        <TD>
  <?php echo $data['pzk'][$i]['isOriginal']; ?>
        </TD>
        <TD>
  <?php echo $data['pzk'][$i]['AnyOriginal']; ?>
        </TD>
      </TR>
<?php } ?>
    <!-- За кошти держ. бюджету -->
<?php for ($i = 1; $i < count($data['budget']) + 1; $i++) { ?>
      <TR data-id="<?php echo $data['budget'][$i]['idPersonSpeciality']; ?>">
        <TD>
  <?php echo ($i+count($data['quota'])+count($data['pzk'])); ?>
        </TD>
        <TD>
  <?php echo $data['budget'][$i]['PIB']; ?>
        </TD>
        <TD>
  <?php echo $data['budget'][$i]['Points']; ?>
        </TD>
        <TD>
  <?php echo $data['budget'][$i]['DocPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['budget'][$i]['ZNO']; ?>
        </TD>
        <TD>
  <?php echo $data['budget'][$i]['ExamsPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['budget'][$i]['OlympsPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['budget'][$i]['CoursesPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['budget'][$i]['isPZK']; ?>
        </TD>
        <TD>
  <?php echo $data['budget'][$i]['isExtra']; ?>
        </TD>
        <TD>
  <?php echo $data['budget'][$i]['isQuota']; ?>
        </TD>
        <TD>
  <?php echo $data['budget'][$i]['isOriginal']; ?>
        </TD>
        <TD>
  <?php echo $data['budget'][$i]['AnyOriginal']; ?>
        </TD>
      </TR>
<?php } ?>
    <!-- На контрактній основі -->
<?php for ($i = 1; $i < count($data['contract']) + 1; $i++) { ?>
      <TR data-id="<?php echo $data['contract'][$i]['idPersonSpeciality']; ?>">
        <TD>
  <?php echo ($i+count($data['quota'])+count($data['pzk'])+count($data['budget'])); ?>
        </TD>
        <TD>
  <?php echo $data['contract'][$i]['PIB']; ?>
        </TD>
        <TD>
  <?php echo $data['contract'][$i]['Points']; ?>
        </TD>
        <TD>
  <?php echo $data['contract'][$i]['DocPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['contract'][$i]['ZNO']; ?>
        </TD>
        <TD>
  <?php echo $data['contract'][$i]['ExamsPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['contract'][$i]['OlympsPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['contract'][$i]['CoursesPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['contract'][$i]['isPZK']; ?>
        </TD>
        <TD>
  <?php echo $data['contract'][$i]['isExtra']; ?>
        </TD>
        <TD>
  <?php echo $data['contract'][$i]['isQuota']; ?>
        </TD>
        <TD>
  <?php echo $data['contract'][$i]['isOriginal']; ?>
        </TD>
        <TD>
  <?php echo $data['contract'][$i]['AnyOriginal']; ?>
        </TD>
      </TR>
<?php } ?>
    <!-- ... -->
<?php for ($i = 0; $i < count($data['below']) ; $i++) {
  // if (!isset($data['below'][$i])){
    // continue;
  // }
?>
      <TR data-id="<?php echo $data['below'][$i]['idPersonSpeciality']; ?>">
        <TD>
  <?php echo ($i+count($data['quota'])+count($data['pzk'])+count($data['budget'])+count($data['contract'])+1); ?>
        </TD>
        <TD>
  <?php echo $data['below'][$i]['PIB']; ?>
        </TD>
        <TD>
  <?php echo $data['below'][$i]['Points']; ?>
        </TD>
        <TD>
  <?php echo $data['below'][$i]['DocPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['below'][$i]['ZNO']; ?>
        </TD>
        <TD>
  <?php echo $data['below'][$i]['ExamsPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['below'][$i]['OlympsPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['below'][$i]['CoursesPoints']; ?>
        </TD>
        <TD>
  <?php echo $data['below'][$i]['isPZK']; ?>
        </TD>
        <TD>
  <?php echo $data['below'][$i]['isExtra']; ?>
        </TD>
        <TD>
  <?php echo $data['below'][$i]['isQuota']; ?>
        </TD>
        <TD>
  <?php echo $data['below'][$i]['isOriginal']; ?>
        </TD>
        <TD>
  <?php echo $data['below'][$i]['AnyOriginal']; ?>
        </TD>
      </TR>
<?php } ?>

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