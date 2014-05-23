<?php
/* @var $data_items array */
/* @var $model EdboData */
?>
<style>
@font-face {
    font-family: Oreos;
    src: url("<?php echo Yii::app()->CreateUrl("/css/oreos.ttf"); ?>") format('truetype');
    font-weight:100;
}
</style>
<h3 style="font-family: Oreos;">  CSV data uploader (<span style='color:red;'>edbo</span>)  </h3>
  <div class="well well-small row row-fluid" style="background-color: white;">
    Завантаження CSV-файлу з даними ЄДЕБО.
    <?php
      $this->widget('bootstrap.widgets.TbFileUpload', array(
              'url' => $this->createUrl('/rating/edbodata/upload'),
              'imageProcessing' => true,
              'name' => 'csv_file',
              'multiple' => false,
              'model' => $model,
              'attribute' => 'csv_file', // see the attribute?
              'multiple' => true,
              'options' => array(
                'maxFileSize' => 200000000,
                'acceptFileTypes' => 'js:/(\.|\/)(csv)$/i',
          )));
    ?>
  </div>
<div class="well well-small row row-fluid" style="background-color: white;">
  <center>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'link',
        'type' => 'primary',
        'size' => 'small',
        'icon' => 'info-sign white',
        'label' => 'Регулярна структура таблиці ЄДЕБО',
        'htmlOptions' => array(
            'onclick' => '$("#edbo_info_table").toggle();return false;'
        ),
        'url' => '#'
    ));
    ?>
    <TABLE 
      class='detail-view table table-bordered table-condensed table-striped'
      style="display: none; font-size: 8pt;width: 60%;" 
      border=4
      cellspacing="0"
      id="edbo_info_table">
      <TR><TD colspan=4 style="text-align: center; font-size: 10pt;">Зараз таблиця даних ЄДЕБО має таку 
          <span style="color: red;">регулярну</span> структуру</TD></TR>
      <TR><TH style='width: 5%;'>#</TH>
        <TH>Стовпець</TH>
        <TH style='width: 20%;'>Назва в базі даних</TH>
        <TH style='width: 30%;'>Тип</TH>
      </TR>
      <?php
      $i = 0;
      foreach ($data_items as $data_item) {
        $field = $data_item['Comment'];
        $db_name = $data_item['Field'];
        $type = 'Текст';
        if (strstr($data_item['Type'], 'int') !== FALSE) {
          $type = 'Ціле число';
        }
        if (strstr($data_item['Type'], 'float') !== FALSE) {
          $type = 'Число з плаваючою комою';
        }
        if (strstr($data_item['Type'], 'varchar') !== FALSE) {
          $type = 'Рядок символів';
        }
        $class = 'odd';
        if (!($i % 2)){
          $class = 'even';
        }
        echo '<TR class=\''.$class.'\'>'
                . '<TD style=\'padding:0;\'>' . ( ++$i) . '</TD>';
        echo '<TD style=\'padding:0;\'><I>' . $field . '</I></TD>'
        . '<TD style=\'padding:0;\'>' . $db_name . '</TD>'
        . '<TD style=\'padding:0;\'>' . $type . '</TD>';
        echo '</TR>';
      }
      ?>
    </TABLE>
  </center>
</div>