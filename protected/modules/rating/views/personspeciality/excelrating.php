<?php
/* @var $data array */
/* @var $Speciality string */
/* @var $Faculty string */
/* @var $license_info array */
/* @var $toexcel integer */
/* @var $contacts integer */
  header('Content-Type: text/html; charset=windows-1251');
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Cache-Control: post-check=0, pre-check=0', FALSE);
  header('Pragma: no-cache');
if ($toexcel) {
  header('Content-transfer-encoding: binary');
  header('Content-Disposition: attachment; filename=' . str_replace(array(' ', ':', '.', ',_', '__'), '_', $Speciality) . '.xls');
  header('Content-Type: application/x-unknown');
}
  ?>
<html>
  <head>
    <meta charset="windows-1251">
    <title><?php echo iconv("utf-8", "windows-1251",$Speciality); ?></title>
    <style id="rating_style">
  .faculty {
    font-size: 8pt;
    padding: 3px;
    font-family: 'Tahoma';
    vertical-align: middle;
    border-left:solid 1px black;
    border-right:solid 1px black;
    border-top:solid 1px black;
  }
  
  .direction, .license_count, .budget_count, .quota_count {
    font-size: 8pt;
    padding: 3px;
    font-family: 'Tahoma';
    vertical-align: middle;
    border-left:solid 1px black;
    border-right:solid 1px black;
  }
  
  
  .number_header , .original_header , .original_header , .contacts_header {
    font-size: 8pt;
    font-weight: bold;
    padding: 3px;
    font-family: 'Tahoma';
    vertical-align: middle;
    border:solid 1px black;
  }
  
  .person_header , .points_header {
    font-size: 10pt;
    font-weight: bold;
    padding: 3px;
    font-family: 'Tahoma';
    vertical-align: middle;
    border:solid 1px black;
  }
  
  .pzk_header , .pv_header {
    font-size: 7pt;
    padding: 3px;
    font-family: 'Tahoma';
    vertical-align: middle;
    border:solid 1px black;
  }
  .wave_header {
    font-size: 6pt;
    padding: 3px;
    font-family: 'Tahoma';
    vertical-align: middle;
    border:solid 1px black;
  }
  
  .target_committee , .pzk_committee , .budget_committee , .contract_committee, .fatal_line{
    font-size: 10pt;
    font-weight: bold;
    padding: 5px;
    font-family: 'Tahoma';
    border-left:solid 1px black;
    border-right:solid 1px black;
  }
  
  .num , .pzk , .pv , .original , .wave {
    font-size: 8pt;
    padding: 3px;
    font-family: 'Tahoma';
    vertical-align: middle;
    border:solid 1px black;
    text-align: center;
  }
  
  .person , .points {
    font-size: 10pt;
    padding: 3px;
    font-family: 'Tahoma';
    vertical-align: middle;
    border:solid 1px black;
  }
    </style>
  </head>
<?php
?>
<body>
  <TABLE cellspacing="0" border="0"
         style="border-collapse:collapse;" >
    <TR>
      <TD colspan='7' class="faculty">
        <?php echo iconv("utf-8", "windows-1251", 'Факультет:'); ?> 
        <?php echo iconv("utf-8", "windows-1251",$Faculty); ?>
      </TD>
    </TR>
    <TR>
      <TD colspan='7' class="direction">
        <?php echo iconv("utf-8", "windows-1251", 'Напрям підготовки: '); ?>
        <?php
        echo iconv("utf-8", "windows-1251",$Speciality);
        ?>
      </TD>
    </TR>
    <TR>
      <TD colspan='7' class="license_count">
        <?php echo iconv("utf-8", "windows-1251", 'Ліцензійний обсяг: ');
        echo ($license_info[2][1] + $license_info[1][1]);
        ?>
      </TD>
    </TR>
    <TR>
      <TD colspan='7' class="budget_count">
        <?php echo iconv("utf-8", "windows-1251", 'Обсяг державного замовлення: ');
        echo $license_info[2][1]; ?>
      </TD>
    </TR>
    <TR>
      <TD colspan='7' class="quota_count">
        <?php echo iconv("utf-8", "windows-1251", 'з них квота пільговиків: '); ?>
        <?php echo $license_info[3][1]; ?>
        <?php echo iconv("utf-8", "windows-1251", ', квота цільовиків: '); ?>
<?php $count_q = 0; foreach ($license_info as $key => $info){
    if ($key > 3){
      echo iconv("utf-8", "windows-1251", '<br/>' . $info[0] . ' : '. $info[1]);
      $count_q++;
    }
}     
if (!$count_q){
      echo '0';
} 
 ?>
      </TD>
    </TR>
    <TR>
      <TD class="number_header">
<?php echo iconv("utf-8", "windows-1251", '№ п/п'); ?>
      </TD>
      <TD class="person_header">
<?php echo iconv("utf-8", "windows-1251", 'ПІБ'); ?>
      </TD>
      <TD class="points_header">
<?php echo iconv("utf-8", "windows-1251", 'Бал'); ?>
      </TD>
      <TD class="pzk_header">
<?php echo iconv("utf-8", "windows-1251", 'Поза конкурс.'); ?>
      </TD>
      <TD class="pv_header">
<?php echo iconv("utf-8", "windows-1251", 'Першочерг.'); ?>
      </TD>
      <TD class="original_header">
<?php echo iconv("utf-8", "windows-1251", 'Оригінал'); ?>
      </TD>
<?php if (!$contacts){ ?>
      <TD class="wave_header">
<?php echo iconv("utf-8", "windows-1251", 'Зарах за хвилею'); ?>
      </TD>
<?php } else { ?>
      <TD class="contacts_header">
<?php echo iconv("utf-8", "windows-1251", 'Контакти'); ?>
      </TD>

<?php } ?>
    </TR>


<?php $counter = 1; foreach ($data as $key => $list) { if (!count($list)){continue;} ?>
      <TR>
        <TD colspan='7' class="target_committee">
  <?php echo iconv("utf-8", "windows-1251", $key); ?>
        </TD>
      </TR>
<?php for ($i = 0; $i < count($list); $i++) { ?>
      <TR data-id="<?php echo $list[$i]['idPersonSpeciality']; ?>" class="target_row">
        <TD class="num">
  <?php echo ($counter++); ?>
        </TD>
        <TD class="person">
  <?php echo iconv("utf-8", "windows-1251",$list[$i]['PIB']); ?>
        </TD>
        <TD class="points">
  <?php echo $list[$i]['Points']; ?>
        </TD>
        <TD class="pzk">
  <?php echo iconv("utf-8", "windows-1251",$list[$i]['isPZK']); ?>
        </TD>
        <TD class="pv">
  <?php echo iconv("utf-8", "windows-1251",$list[$i]['isExtra']); ?>
        </TD>
        <TD class="original">
  <?php echo iconv("utf-8", "windows-1251",$list[$i]['isOriginal']); ?>
        </TD>
        <TD class="wave">
          <?php if ($contacts){
            $model = Personspeciality::model()->findByPk($list[$i]['idPersonSpeciality']);
            $array_contacts = array();
            foreach ($model->person->contacts as $mcontact){
              $array_contacts[] = iconv("utf-8", "windows-1251", 'т:'.$mcontact->Value);
            }
            echo implode(';<br/>',$array_contacts);
          } 
          ?>
        </TD>
      </TR>
<?php } // end for $list ?>
<?php } // end foreach $data  ?>

</TABLE>


<?php ?>

</body>
</html>