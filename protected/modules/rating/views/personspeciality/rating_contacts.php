<?php
/* @var $data array */
/* @var $Speciality string */
/* @var $Faculty string */
/* @var $license_info array */
/* @var $toexcel integer */
/* @var $contacts integer */
$k = 1;
?>

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
        <TD class="contacts">
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
<?php } // end foreach $data ?>

  <TR>
  <TD colspan='7' class="fatal_line">
  <center>
    ###
  </center>
  </TD>
  </TR>
  <TR>
  <TD colspan='7' class="fatal_line">
  <center>
    ###
  </center>
  </TD>
  </TR>
