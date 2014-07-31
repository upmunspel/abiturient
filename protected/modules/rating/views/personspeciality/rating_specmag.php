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
    font-size: 12pt;
    padding: 3px;
    font-family: 'Times New Roman';
    vertical-align: middle;
    border-left:solid 1px black;
    border-right:solid 1px black;
    border-top:solid 1px black;
  }
  
  .direction, .license_count, .budget_count, .quota_count {
    font-size: 12pt;
    padding: 3px;
    font-family: 'Times New Roman';
    vertical-align: middle;
    border-left:solid 1px black;
    border-right:solid 1px black;
  }
  
  
  .number_header, .contacts_header {
    font-size: 10pt;
    font-weight: bold;
    padding: 3px;
    font-family: 'Times New Roman';
    vertical-align: middle;
    border:solid 1px black;
  }
  
  .person_header , .points_header  , .pv_header , .original_header{
    font-size: 10pt;
    font-weight: bold;
    padding: 3px;
    font-family: 'Times New Roman';
    vertical-align: middle;
    border:solid 1px black;
    text-align: center;
  }
  
  .pzk_header{
    font-size: 10pt;
    font-weight: bold;
    padding: 3px;
    font-family: 'Times New Roman';
    vertical-align: middle;
    border:solid 1px black;
    width: 20mm;
    text-align: center;
  }
  
  .wave_header {
    font-size: 10pt;
    padding: 3px;
    font-family: 'Times New Roman';
    vertical-align: middle;
    border:solid 1px black;
  }
  
  .target_committee , .pzk_committee , .budget_committee , .contract_committee, .fatal_line{
    font-size: 12pt;
    font-weight: bold;
    padding: 5px;
    font-family: 'Times New Roman';
    border:solid 1px black;
    text-align: center;
  }
  
  .num , .pzk , .pv , .original , .wave {
    font-size: 12pt;
    padding: 3px;
    font-family: 'Times New Roman';
    vertical-align: middle;
    border:solid 1px black;
    text-align: center;
  }
  
  .person , .points {
    font-size: 12pt;
    padding: 3px;
    font-family: 'Times New Roman';
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
      <TD colspan='<?php echo ((($contacts))? '7':'6'); ?>' class="faculty">
        <h1 style="text-align: center;">
          <?php echo iconv("utf-8", "windows-1251", "ОКР ".
            ((mb_substr($Speciality,0,1,'utf-8') == '8')? "МАГІСТР":"СПЕЦІАЛІСТ")); ?> <br/>
          <?php echo iconv("utf-8", "windows-1251", 'Факультет:'); ?> 
          <?php echo iconv("utf-8", "windows-1251",$Faculty); ?>
        </h1>
        <?php echo iconv("utf-8", "windows-1251", 'Спеціальність: '); ?>
        <?php
        echo iconv("utf-8", "windows-1251",$spec_name);
        ?>
      </TD>
    </TR>
    <TR>
      <TD colspan='<?php echo ((($contacts))? '7':'6'); ?>' class="direction">
        <?php echo iconv("utf-8", "windows-1251", 'Форма навчання: '); ?>
        <?php
        echo iconv("utf-8", "windows-1251",$spec_eduform);
        ?>
      </TD>
    </TR>
    <TR>
      <TD colspan='<?php echo ((($contacts))? '7':'6'); ?>' class="license_count">
        <?php echo iconv("utf-8", "windows-1251", 'Ліцензійний обсяг: ');
        echo ($license_info[2][1] + $license_info[1][1]);
        ?>
      </TD>
    </TR>
    <TR>
      <TD colspan='<?php echo ((($contacts))? '7':'6'); ?>' class="budget_count">
        <?php echo iconv("utf-8", "windows-1251", 'Обсяг державного замовлення: ');
        echo $license_info[2][1]; ?>
      </TD>
    </TR>
    <TR>
      <TD colspan='<?php echo ((($contacts))? '7':'6'); ?>' class="quota_count">
        <?php echo iconv("utf-8", "windows-1251", 'з них квота пільговиків: '); ?>
        <?php echo $license_info[3][1]; ?>
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
<?php echo iconv("utf-8", "windows-1251", 'Поза конкурсом'); ?>
      </TD>
      <TD class="pv_header">
<?php echo iconv("utf-8", "windows-1251", 'Першочергове'); ?>
      </TD>
      <TD class="original_header">
<?php echo iconv("utf-8", "windows-1251", 'Оригінал'); ?>
      </TD>
<?php if ($contacts){ ?>
      <TD class="contacts_header">
<?php echo iconv("utf-8", "windows-1251", 'Контакти'); ?>
      </TD>
<?php } ?>
    </TR>


<?php $counter = 1; foreach ($data as $key => $list) { if (!count($list)){continue;} ?>
      <TR>
        <TD colspan='<?php echo ((($contacts))? '7':'6'); ?>' class="target_committee">
  <?php 
  if ($key == "За кошти фізичних або юридичних осіб"){
    echo iconv("utf-8", "windows-1251", "МІСЦЯ ЗА КОНКУРСОМ");
    if ($counter > 1){
      echo iconv("utf-8", "windows-1251", " (ПРОДОВЖЕННЯ)");
    }
  } else if ($key == "За кошти державного бюджету"){ 
    echo iconv("utf-8", "windows-1251", "БЮДЖЕТНІ МІСЦЯ ЗА КОНКУРСОМ");
  } else if ($key == "Поза конкурсом"){
    echo iconv("utf-8", "windows-1251", "БЮДЖЕТНІ МІСЦЯ ПОЗА КОНКУРСОМ");
  }
  ?>
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
        <?php if ($contacts){ ?>
        <TD class="wave"> <?php
          $model = Personspeciality::model()->findByPk($list[$i]['idPersonSpeciality']);
          $array_contacts = array();
          foreach ($model->person->contacts as $mcontact){
            $array_contacts[] = iconv("utf-8", "windows-1251", 'т:'.$mcontact->Value);
          }
          echo implode(';<br/>',$array_contacts); ?>
        </TD> <?php
        } 
        ?>
        
      </TR>
<?php } // end for $list ?>
<?php } // end foreach $data  ?>

</TABLE>


<?php ?>

</body>
</html>