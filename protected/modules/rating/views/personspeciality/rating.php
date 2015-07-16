<?php

/* @var $model Personspeciality */
/* @var $data CActiveDataProvider */
/* @var $model ConvertAttestat*/
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');

?>
<style>
@font-face {
    font-family: Oreos;
    src: url("<?php echo Yii::app()->CreateUrl("/css/oreos.ttf"); ?>") format('truetype');
    font-weight:100;
}
  
  .ui-autocomplete {
    max-height: 200px;
    width: 400px;
    overflow-y: auto;
    font-size: 8pt;
    font-family: Verdana;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
/* IE 6 doesn't support max-height
* we use height instead, but this forces the menu to always be this tall
*/
  * html .ui-autocomplete {
    height: 200px;
  }
  
/* Request status styling */
  .req-status-0 {
    color: red;
    background-color: #DDDDEE;
    font-size: 8pt;
    font-family: Tahoma;
    font-weight: normal;
  }
  .req-status-1 {
    color: black;
    background-color: #DDDDEE;
    font-size: 8pt;
    font-family: Tahoma;
    font-weight: normal;
  }
  .req-status-2 {
    color: #EE5f5B;
    background-color: #DDDDEE;
    font-size: 8pt;
    font-family: Tahoma;
    font-weight: normal;
  }
  .req-status-3 {
    color: #800000;
    background-color: #DDDDEE;
    font-size: 8pt;
    font-family: Tahoma;
    font-weight: normal;
  }
  .req-status-4 {
    color: black;
    background-color: #DDDDEE;
    font-size: 8pt;
    font-family: Tahoma;
    font-weight: normal;
  }
  .req-status-5 {
    color: #298dcd;
    background-color: #DDDDEE;
    font-size: 8pt;
    font-family: Tahoma;
    font-weight: normal;
  }
  .req-status-6 {
    color: #c09853;
    background-color: #DDDDEE;
    font-size: 8pt;
    font-family: Tahoma;
    font-weight: normal;
  }
  .req-status-7 {
    color: green;
    background-color: #DDDDEE;
    font-size: 8pt;
    font-family: Tahoma;
    font-weight: normal;
  }
  .req-status-8 {
    color: black;
    background-color: #DDDDEE;
    font-size: 8pt;
    font-family: Tahoma;
    font-weight: normal;
  }
  .req-status-9 {
    color: #EE5f5B;
    background-color: #DDDDEE;
    font-size: 8pt;
    font-family: Tahoma;
    font-weight: normal;
  }
  .req-status-10 {
    color: red;
    background-color: #DDDDEE;
    font-size: 8pt;
    font-family: Tahoma;
    font-weight: normal;
  }
</style>
<script type="text/javascript">
$(function (){
  $('#rating-params-form').submit(function(){
    var is_excel = ($(this).attr('action') === '<?php echo Yii::app()->CreateUrl('/rating/rating/excelrating'); ?>');
    var spec_id = $('#hidden_spec_id').val();
    if ($('#Personspeciality_rating_order_mode').is(':checked') && !spec_id){
      alert('Спеціальність не обрана');
      return false;
    }
    if ($('#Personspeciality_rating_order_mode').is(':checked') && spec_id && is_excel){
      return true;
    }
    if ($('#Personspeciality_rating_order_mode').is(':checked') && spec_id && !is_excel){
      $.fn.yiiGridView.update('rating-grid', {
        data: $('#rating-params-form').serialize()
      });
      return false;
    }
    if (!$('#Personspeciality_rating_order_mode').is(':checked')){
      $.fn.yiiGridView.update('rating-grid', {
        data: $(this).serialize()
      });
    }
    return false;
  });
});

$(function (){
  $("#Personspeciality_SPEC").keydown(function (){
    $('#hidden_spec_id').val('');
    if ($('#Personspeciality_rating_order_mode').is(':checked')){
        $('#RatingButton').slideUp();
    }
    $('#RatingExcel').slideUp();
  });
  $("#Personspeciality_SPEC").autocomplete(
    {delay:1000, minLength:3, "showAnim":"fold",
      "source":"<?php echo Yii::app()->CreateUrl("/rating/specialities/autocomplete"); ?>",
      "select": function(event,ui){ 
        $('#hidden_spec_id').val(ui.item.spec_id);
        if ($('#Personspeciality_rating_order_mode').is(':checked')){
          $('#RatingExcel').slideDown();
        }
          $('#RatingButton').slideDown();
      } });
});

$(function (){
  $('#Personspeciality_rating_order_mode').change(function (){
    if ($('#Personspeciality_rating_order_mode').is(':checked')){
      $('#Personspeciality_page_size').val('автоматично');
      $('#Personspeciality_page_size').attr('readonly',true);
      
      $('#Personspeciality_searchID').val("");
      $('#Personspeciality_searchID').attr('readonly',true);
      $('#Facultets_FacultetFullName').val('');
      $('#Facultets_FacultetFullName').attr('readonly',true);
      $('#Personspeciality_NAME').val('');
      $('#Personspeciality_NAME').attr('readonly',true);
      $('#Benefit_BenefitName').val('');
      $('#Benefit_BenefitName').attr('readonly',true);
      $('#Personspeciality_ext_param').val('');
      $('#Personspeciality_ext_param').attr('readonly',true);
      $('#Personspeciality_QualificationID').val('');
      $('#Personspeciality_QualificationID').attr('readonly',true);
      $('#Personspeciality_CourseID').val('');
      $('#Personspeciality_CourseID').attr('readonly',true);
      $('#Personspeciality_DateFrom').val('');
      $('#Personspeciality_DateFrom').attr('readonly',true);
      $('#Personspeciality_DateTo').val('');
      $('#Personspeciality_DateTo').attr('readonly',true);
      
      
      $('#statuses').slideDown();
      if (!$('#hidden_spec_id').val()){
        $('#RatingExcel').slideUp();
        $('#RatingButton').slideUp();
      } else {
        $('#RatingButton').slideDown();
        $('#RatingExcel').slideDown();
      }
    } else {
      $('#Personspeciality_page_size').val('5000');
      $('#Personspeciality_page_size').attr('readonly',false);
      
      $('#Personspeciality_searchID').attr('readonly',false);
      $('#Facultets_FacultetFullName').attr('readonly',false);
      $('#Personspeciality_NAME').attr('readonly',false);
      $('#Benefit_BenefitName').attr('readonly',false);
      $('#Personspeciality_ext_param').attr('readonly',false);
      $('#Personspeciality_QualificationID').attr('readonly',false);
      $('#Personspeciality_CourseID').attr('readonly',false);
      $('#Personspeciality_DateFrom').attr('readonly',false);
      $('#Personspeciality_DateTo').attr('readonly',false);
      
      $('#statuses').slideUp();
      $('#RatingButton').slideDown();
      $('#RatingExcel').slideUp();
    }
  });
});

</script>

    <?php
    /* @var $form CActiveForm */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
        'id' => 'rating-params-form',
        'htmlOptions' => array(
          'target' => "_blank",
        )
    ));
    ?>
  <?php echo CHtml::link('Завантажити дані із ЄДЕБО --->',
          Yii::app()->CreateUrl('/rating/edbodata/datauploader'),array(
              'target' => '_blank', 'style' => 'float: right;'
          )); ?>

<div class="well well-small row-fluid" style="width: 50%; margin: 0 auto;">
  <div class="span7">
    <span class="label label-info">нейтрально</span>
    <span class="label label-success">добре</span>
    <span class="label label-important">погано</span>
  </div>
  <div class="span5">
    <span style="font-size: 8pt; font-family: Tahoma; color: 0; padding: 4px;">
      нейтрально
    </span>
    <span style="font-size: 8pt; font-family: Tahoma; color: green; padding: 4px;">
      добре
    </span>
    <span style="font-size: 8pt; font-family: Tahoma; color: red; padding: 4px;">
      погано
    </span>
  </div>
  <div class="clear"></div>
  
<?php echo $form->checkBox($model, 'rating_order_mode', array(
    'style' => 'float:left;margin-right: 10px;'
)); ?>
<?php echo $form->label($model, 'rating_order_mode', array(
    'style' => 'font-size: 8pt; font-family: Tahoma; text-align: left;'
)); ?>
  
  <div id="statuses" style='display: none;'>
<?php echo $form->checkBox($model, 'status_confirmed', array(
    'style' => 'float:left;margin-right: 10px;',
)); ?>
<?php echo $form->label($model, 'status_confirmed', array(
    'style' => 'font-size: 8pt; font-family: Tahoma; text-align: left;'
)); ?>
<?php echo $form->checkBox($model, 'status_committed', array(
    'style' => 'float:left;margin-right: 10px;',
)); ?>
<?php echo $form->label($model, 'status_committed', array(
    'style' => 'font-size: 8pt; font-family: Tahoma; text-align: left;'
)); ?>
<?php echo $form->checkBox($model, 'status_submitted', array(
    'style' => 'float:left;margin-right: 10px;',
)); ?>
<?php echo $form->label($model, 'status_submitted', array(
    'style' => 'font-size: 8pt; font-family: Tahoma; text-align: left;'
)); ?>
<?php if (in_array('Root',Yii::app()->user->getUserRoles())) {
  echo CHtml::checkBox('contacts', true, array(
    'id' => 'ch_contacts',
    'style' => 'float:left;margin-right: 10px;'
  )); ?>
  <?php echo CHtml::label('Відобразити контакти', 'ch_contacts', array(
    'style' => 'font-size: 8pt; font-family: Tahoma; text-align: left;'
  )); 
} ?>
    
    
  </div>
<?php echo $form->checkBox($model, 'ForeignOnly', array(
    'style' => 'float:left;margin-right: 10px;'
)); ?>
<?php echo $form->label($model, 'ForeignOnly', array(
    'style' => 'font-size: 8pt; font-family: Tahoma; text-align: left;'
)); ?>
  <div class="span12">
    <div class="span6">
      <?php
      echo $form->label($model, 'page_size', array(
          'style' => 'font-size: 8pt; font-family: Tahoma; text-align: left;'
      ));
      ?>
      <?php
      echo $form->textField($model, 'page_size', array(
          'style' => 'font-size: 8pt; font-family: Tahoma; height: 12px;',
          'value' => '5000',
      ));
      ?>
    </div>

    <div class="span6">
      <?php
      echo $form->label($model, 'SPEC', array(
          'style' => 'font-size: 8pt; font-family: Tahoma; text-align: left;'
      ));
      ?>
<?php
echo $form->textField($model, 'SPEC', array(
    'style' => 'font-size: 7pt; font-family: Tahoma; height: 12px;',
));
echo $form->hiddenField($model, 'SepcialityID', array(
    'id' => 'hidden_spec_id',
));
?>
    </div>
  </div>
  
  <div class="span12">
    <center>
      <?php echo CHtml::link('інші параметри','#',
              array('onclick'=>'$("#another_parameters").slideToggle();return false;')); ?>
    </center>
    
  </div>
  <div class='row-fluid' style='display: none;' id='another_parameters'>
  <div class='span12'></div>
  <div class='span12'>
    <?php
      echo $form->dropDownListRow($model,'ext_param',
        array('0'=>"",
          '1'=>"МАЙЖЕ усі неспівпадання з даними ЄДЕБО",
          '2'=>"Немає в даних ЄДЕБО, але є в даних 'Абітурієнта'",
          '3'=>"Є в даних 'Абітурієнта' і є в даних ЄДЕБО",
          '4'=>"Неспівпадання з даними ЄДЕБО : лише копія/оригінал",
          '5'=>"Неспівпадання з даними ЄДЕБО : лише бали (зн. документа)",
          '6'=>"Неспівпадання з даними ЄДЕБО : лише відмітки пільгового вступу",
          '7'=>"Неспівпадання з даними ЄДЕБО : лише сума балів ЗНО",
          '8'=>"Неспівпадання з даними ЄДЕБО : лише країна громадянства",
        ),
        array('class' => 'span11'));
    ?>
  </div>
    <!-- ----- -->
  <div class='span12'>  
    <div class="span6">
      <?php
      echo $form->label($model, 'QualificationID', array(
          'style' => 'font-size: 8pt; font-family: Tahoma; text-align: left;'
      ));
      ?>
      <?php
      echo $form->dropDownList($model, 'QualificationID', 
        array(""=>"", "1" => "Бакалавр", "2" => "Магістр", "3" => "Спеціаліст"), 
        array(
          'style' => 'font-family: Tahoma; '
      ));
      ?>
    </div>

    <div class="span6">
      <?php
      echo $form->label($model, 'CourseID', array(
          'style' => 'font-size: 8pt; font-family: Tahoma; text-align: left;'
      ));
      ?>
      <?php
      echo $form->dropDownList($model, 'CourseID', 
        array_merge(array(0=>""),CHtml::listData(Courses::model()->findAll(),'idCourse','CourseName')), 
        array(
          'style' => 'font-family: Tahoma;'
      ));
      ?>
    </div>
  </div>
  <div class="span12">
    <div class="span6">
      <?php
      echo $form->label($model, 'searchID', array(
          'style' => 'font-size: 8pt; font-family: Tahoma; text-align: left;'
      ));
      ?>
      <?php
      echo $form->textField($model, 'searchID', array(
          'style' => 'font-size: 8pt; font-family: Tahoma; height: 12px;'
      ));
      ?>
    </div>

    <div class="span6">
      <?php
      echo CHtml::label('Пошук по частині назви факультету', 
              CHtml::activeId($model->searchFaculty, 'FacultetFullName'), array(
          'style' => 'font-size: 8pt; font-family: Tahoma; text-align: left;'
      ));
      ?>
      <?php
      echo $form->textField($model->searchFaculty, 'FacultetFullName', array(
          'style' => 'font-size: 8pt; font-family: Tahoma; height: 12px;',
      ));
      ?>
    </div>
  </div>
    <!-- ----- -->
  <div class='span12'>  
    <div class="span6">
      <?php
      echo $form->label($model, 'NAME', array(
          'style' => 'font-size: 8pt; font-family: Tahoma; text-align: left;'
      ));
      ?>
      <?php
      echo $form->textField($model, 'NAME', array(
          'style' => 'font-size: 8pt; font-family: Tahoma; height: 12px;'
      ));
      ?>
    </div>

    <div class="span6">
      <?php
      echo CHtml::label('Пошук по частині назви пільги або їх число', 
              CHtml::activeId($model->searchBenefit, 'BenefitName'), array(
          'style' => 'font-size: 8pt; font-family: Tahoma; text-align: left;'
      ));
      ?>
      <?php
      echo $form->textField($model->searchBenefit, 'BenefitName', array(
          'style' => 'font-size: 8pt; font-family: Tahoma; height: 12px;',
      ));
      ?>
    </div>
  </div>
    <!-- ----- -->
  <div class='span12'>  
    <div class="span6">
      <?php
      echo $form->label($model, 'DateFrom', array(
          'style' => 'font-size: 8pt; font-family: Tahoma; text-align: left;'
      ));
      ?>
      <?php
      echo $form->textField($model, 'DateFrom', array(
          'style' => 'font-size: 8pt; font-family: Tahoma; height: 12px;',
          'class' => 'datepicker',
      ));
      ?>
    </div>

    <div class="span6">
      <?php
      echo $form->label($model, 'DateTo', array(
          'style' => 'font-size: 8pt; font-family: Tahoma; text-align: left;'
      ));
      ?>
      <?php
      echo $form->textField($model, 'DateTo', array(
          'style' => 'font-size: 8pt; font-family: Tahoma; height: 12px;',
          'class' => 'datepicker',
      ));
      ?>
    </div>
  </div>
  </div>
  
  <div class="span12">
    <div class="span6">
    <?php
    $this->widget("bootstrap.widgets.TbButton", array(
      'buttonType'=>'submit',
      'type'=>'primary',
      "size"=>"small",
      "icon" => "eye-open white",
      'htmlOptions' => array(
        'id' => 'RatingButton',
        'class' => 'span9',
        'onclick' => '$(\'#rating-params-form\').attr(\'action\',\''.Yii::app()->createUrl($this->route).'\');'
          . 'if(($("#Personspeciality_DateFrom").val().length > 0 '
            .'&& $("#Personspeciality_DateTo").val().length > 0) '
            .'|| ($("#Personspeciality_rating_order_mode").is(":checked")))'
        . '{$(\'#rating-params-form\').submit();}else{alert("Вкажіть проміжок часу (дати).");}'
        . 'return false;',
       ),
      'label'=>'Створити вибірку',
    )); ?>
    </div>
    <div class="span6">
    <?php
    $this->widget("bootstrap.widgets.TbButton", array(
      'buttonType'=>'sumbit',
      'type'=>'primary',
      "size"=>"small",
      "icon"=>"file white",
      'htmlOptions' => array(
        'id' => 'RatingExcel',
        'class' => 'span9',
        'onclick' => '$(\'#rating-params-form\').attr(\'action\',\''.Yii::app()->CreateUrl('/rating/rating/excelrating').'\');'
          . '$(\'#rating-params-form\').submit();return false;',
        'style' => 'display: none;',  
       ),
      'label'=>'Сформувати Excel-файл',
    )); ?>
    </div>
  </div>
</div>

<?php $this->endWidget(); ?>

<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'rating-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $data,
    'filter' => $model,
    'columns' => array(
        array(
            'header' => 'ID',
            //'name' => 'searchID',
            'filter' => false,
            'htmlOptions' => array(
                'style' => 'width: 80px;'
            ),
            'headerHtmlOptions' => array(
                'style' => 'width: 80px;'
            ),
            'value' => function($data,$row){
              /* @var $data Personspeciality */
              if (!$row && Personspeciality::$is_rating_order){
                $_contract_counter = $data->sepciality->SpecialityContractCount;
                $_budget_counter = $data->sepciality->SpecialityBudgetCount;
                $_pzk_counter = $data->sepciality->Quota1;
                $_quota_counter = $data->sepciality->Quota2;
                Personspeciality::setCounters($_contract_counter, $_budget_counter, 
                  $_pzk_counter, $_quota_counter);
              } ?> 
              <a href='#'  
                 onclick="$('#row_<?php echo $row; ?>').slideToggle();return false;">
                <i class="icon-white icon-info-sign" 
                style="background-color: #05B2D2; border-radius: 10px;"></i>
             <?php 
             $local_counter = 0;
              if ((Personspeciality::$is_rating_order) && $data->Quota1){
                //цільовики
                $was = Personspeciality::decrementCounter(Personspeciality::$C_QUOTA);
                if ($was){
                  Personspeciality::decrementCounter(Personspeciality::$C_BUDGET);
                  $local_counter = 1 + $data->sepciality->Quota2 - $was;
                  echo '<span '
                  . ' title="Місце у рейтингу цільового прийому за попередньою інформацією." '
                  . ' style="color: #F89406; font-size: 14pt; font-family: Oreos;"> '
                  . $local_counter
                  . '</span>';
                } else {
                  echo '<span '
                  . ' title="Має право приймати участь у конкурсі, але не за цільовим прийомом." '
                  . ' style="color: #CA0EE3;">'
                  . 'Не проходить'
                  . '</span>';
                }
              }
              if ((Personspeciality::$is_rating_order) && $data->isOutOfComp && !$data->Quota1){
                //поза конкурсом
                $was = Personspeciality::decrementCounter(Personspeciality::$C_OUTOFCOMPETITION);
                if ($was){
                 Personspeciality::decrementCounter(Personspeciality::$C_BUDGET);
                 $local_counter = 1 + $data->sepciality->Quota1 - $was;
                 echo '<span '
                 . ' title="Місце у рейтингу прийому поза конкурсом за попередньою інформацією." '
                 . ' style="color: #05B2D2; font-size: 14pt; font-family: Oreos;"> '
                 . $local_counter
                 . '</span>';
                } else {
                 echo '<span '
                 . ' title="Має право приймати участь у конкурсі, 
                    але без права на позаконкурсний прийом." '
                 . ' style="color: #CA0EE3;">'
                 . 'Не проходить'
                 . '</span>';
                }
              }
              if ((Personspeciality::$is_rating_order) 
                && $data->isBudget && !$data->isOutOfComp && !$data->Quota1){
                //на бюджет
                $was = Personspeciality::decrementCounter(Personspeciality::$C_BUDGET);
                if ($was){
                 $local_counter = 1 + $data->sepciality->SpecialityBudgetCount - $was;
                 echo '<span '
                 . ' title="Місце у рейтингу прийому за кошти держ. бюджету за попередньою інформацією." '
                 . ' style="color: lightgreen; font-size: 14pt; font-family: Oreos;"> '
                 . $local_counter
                 . '</span>';
                }
              }
              if ((Personspeciality::$is_rating_order) && 
                     ((!$data->isBudget && !$data->isOutOfComp && !$data->Quota1) || 
                     (!$was && $data->isBudget && !$data->isOutOfComp && !$data->Quota1) )){
                //на контракт
                $was = Personspeciality::decrementCounter(Personspeciality::$C_CONTRACT);
                if ($was){
                 $local_counter = 1 + $data->sepciality->SpecialityContractCount - $was;
                 echo '<span '
                 . ' title="Місце у рейтингу на контракт за попередньою інформацією." '
                 . ' style="color: #ad6704; font-size: 14pt; font-family: Oreos;"> '
                 . $local_counter
                 . '</span>';
                } else {
                 echo '<span '
                 . ' title="...за попередньою інформацією." '
                 . ' style="color: red;">'
                 . 'Не проходить'
                 . '</span>';
                }
              }
              //var_dump($data->rating_order_mode);
              if (!Personspeciality::$is_rating_order){
                echo $data->edboID;
              }
              ?></a> <?php
              $doc_orig = 'Копія';
              $is_orig = 0;
              if (!$data->isCopyEntrantDoc){
                $doc_orig = 'Оригінал';
                $is_orig = 1;
              }
              $span_class = 'label-info';
              if (($data->edbo)? ($data->edbo->OD == $is_orig): false){
                $span_class = 'label-success';
              }
              if (($data->edbo)? ($data->edbo->OD != $is_orig): false){
                $span_class = 'label-important';
              } ?>
              <!-- Виведення інформації про оригінальність вступних документів -->
              <span class="label <?php echo $span_class; ?>"> <?php echo $doc_orig; ?>
              </span><br/>
              <!-- Виведення статусу заявки -->
              статус заявки: 
              <span 
                title = "<?php echo ($data->edbo)? 'У ЄДЕБО: '.$data->edbo->Status:''; ?>"
                class="label badge req-status-<?php echo $data->StatusID; ?>"
                style="border: 3px solid <?php echo ($data->edbo)? 
                  ((mb_substr($data->edbo->Status,0,6,'utf-8') == 
                    mb_substr($data->status->PersonRequestStatusTypeName,0,6,'utf-8'))? 
                  'green':'red')
                  :'white'; ?>">
               <?php echo $data->status->PersonRequestStatusTypeName; ?>
              </span><hr style="margin: 3px !important;"/>
              <!-- Виведення системних ідентифікаторів -->
              <div id='row_<?php echo $row; ?>' style='display:none; font-size:8pt;'> <?php
                    echo 'id_заявки: <span class=\'label label-info\'>'.$data->idPersonSpeciality.
                            '</span><hr style=\'margin: 3px !important;\'/>';
                    echo 'id_персони: <span class=\'label label-info\'>'.$data->PersonID.
                            '</span><hr style=\'margin: 3px !important;\'/>';
                    echo 'id_ЄДЕБО: <span class=\'label label-info\'>'.$data->edboID.
                            '</span><hr style=\'margin: 3px !important;\'/>';
              ?> 
              </div> 
              <div id='r_<?php echo $row; ?>' style='font-size:8pt;'>
                <!-- Виведення дати заяви -->
                Дата заяви: 
                <span class="label label-red">
                  <?php echo date('d.m.Y',strtotime($data->CreateDate)); ?>
                </span>
                <hr style="margin: 2px !important;"/>
                <?php
                $edbo_case = (($data->edbo)? $data->edbo->PersonCase:'');
                $our_case = str_pad($data->RequestNumber, 5, "0", STR_PAD_LEFT);
                ?>
                <!-- Виведення № заяви -->
                № заяви: 
                <span 
                  class="label label-<?php echo ($data->edbo)?(($edbo_case != $our_case)? 'important':'success'):'red'; ?>"
                  title="<?php echo $edbo_case; ?>">
                  <?php echo trim($our_case); ?>
                </span>
                <hr style="margin: 3px !important;"/>
              </div> <?php
            }
        ),

        array(
            'name' => 'facultet.FacultetFullName',
            'filter' => false,
            'header' => 'Факультет',
            'htmlOptions' => array(
                'style' => 'width: 90px;'
            ),
            'headerHtmlOptions' => array(
                'style' => 'width: 90px;'
            ),
            'value' => '$data->sepciality->facultet->FacultetFullName'
        ),
        
        array(
            'name' => 'SPEC',
            'header' => 'Спеціальність',
            'filter' => false,
            'htmlOptions' => array(
                'style' => 'width: 150px;'
            ),
            'headerHtmlOptions' => array(
                'style' => 'width: 150px;'
            ),
            'value' => function ($data){
              /* @var $data Personspeciality */
              if (!$data->edbo && $data->edboID){
                $data->edbo = EdboData::model()->findByPk($data->edboID);
              }
              if ($data->edbo){
                $direction_ok = (
                  ($data->QualificationID > 1)? true:$data->sepciality->SpecialityDirectionName == $data->edbo->Direction
                );
                $speciality_ok = (
                  ($data->QualificationID == 1)? true:$data->sepciality->SpecialityName == $data->edbo->Speciality
                );
                $specialization_ok = ((!$data->edbo->Specialization)? true:
                  (strstr($data->sepciality->SpecialitySpecializationName, $data->edbo->Specialization) !== FALSE)
                );
                $edu_form_ok = ($data->educationForm->PersonEducationFormName == $data->edbo->EduForm);
                $spec_title = "";
                $spec_style = "";
                if ($direction_ok && $speciality_ok && $specialization_ok && $edu_form_ok){
                  $spec_title = 'співпадає';
                  $spec_style= 'color: green;';
                } else if (!$direction_ok){
                  $spec_title = 'В ЄДЕБО напрям: "'.$data->edbo->Direction .'",
                     а в Абітурієнті: "'.$data->sepciality->SpecialityDirectionName.'"';
                  $spec_style='color: red;';
                } else if (!$speciality_ok){
                  $spec_title = 'В ЄДЕБО спеціальність: "'.$data->edbo->Speciality .'",
                     а в Абітурієнті: "'.$data->sepciality->SpecialityName.'"';
                  $spec_style='color: red;';
                } else if (!$specialization_ok){
                  $spec_title = 'В ЄДЕБО спеціалізація: "'.$data->edbo->Specialization .'",
                     а в Абітурієнті: "'.$data->sepciality->SpecialitySpecializationName.'"';
                  $spec_style='color: red;';
                } else if (!$edu_form_ok){
                  $spec_title = 'В ЄДЕБО форма навчання: "'.$data->edbo->EduForm .'",
                     а в Абітурієнті: "'.$data->educationForm->PersonEducationFormName.'"';
                  $spec_style='color: red;';
                } ?>
                <span 
                  title='<?php echo $spec_title; ?>'
                  style='<?php echo $spec_style; ?>'>
                <?php echo $data->SPEC; ?>
                </span> <?php
              } else {
                echo $data->SPEC;
              }
            }
        ),
        
        array(
          'name' => 'NAME',
          'header' => 'ПІБ',
          'filter' => false,
          'htmlOptions' => array(
              'style' => 'font-size: 10pt;'
          ),
          'value' => function ($data){
            /* @var $data Personspeciality */
            if (!$data->edbo && $data->edboID){
              $data->edbo = EdboData::model()->findByPk($data->edboID);
            }
            $color = 'black';
            if ($data->edbo){
              $name_parts = array_diff(explode(' ', $data->NAME),array(''));
              $edbo_name_parts = array_diff(explode(' ', $data->edbo->PIB),array(''));
              $name_ok = true;
              if (count($edbo_name_parts) != count($name_parts)){
                $name_ok = false;
              } else {
                foreach ($edbo_name_parts as $nm_part){
                  if (!in_array($nm_part,$name_parts)){
                    $name_ok = false;
                    break;
                  }
                }
              }
              $color = ($name_ok) ? 'green' : 'red';
              if (!($data->edbo->PIB == $data->NAME)){ ?>
                <div 
                  style='color: #BBDDBB; font-size: 8pt;'
                  title='Такі дані в ЄДЕБО.'> <?php echo $data->edbo->PIB; ?>
                </div> <?php
              }
            } ?>
            <A HREF='<?php echo Yii::app()->createUrl('/person/'.$data->PersonID) ;?>'
              TARGET="_blank">
              <div style='color: <?php echo $color; ?>;'>
                <?php echo $data->NAME; ?>
              </div>
            </A>
            <ul>
            <li>Номер справи: <span 
                  class="label label-info"
                  title="">
                  <?php echo $data->PersonCase; ?>
                </span></li>
            </ul><?php
          }
        ),
        
        array(
          'header' => 'Пільги',
          'name' => 'benefit.BenefitName',
          'filter' => false,
          'htmlOptions' => array(
              'style' => 'width: 130px;'
          ),
          'headerHtmlOptions' => array(
              'style' => 'width: 130px;'
          ),
          'value' => function ($data){
            /* @var $data Personspeciality */
            $_benefits =  explode(';;',$data->BenefitList);
            $id_benefits =  explode(';;',$data->idBenefitList);
            $is_out_of_comp_list = explode(';;', $data->isOutOfCompList);
            $is_extra_entry_list = explode(';;', $data->isExtraEntryList);
            $benefits = array();
            foreach ($_benefits as $id => $benefit){
              if (!$benefit){
                continue;
              }
              $benefits[$id_benefits[$id]]['name'] = $benefit;
              $benefits[$id_benefits[$id]]['isPV'] = $is_extra_entry_list[$id];
              $benefits[$id_benefits[$id]]['isPZK'] = $is_out_of_comp_list[$id];
            }
            $cnt_benefits = count($benefits);
            if ($cnt_benefits == 1 && $benefits[$id_benefits[0]] == ''){
              return ;
            }
            if ($cnt_benefits > 0){
              $active_text = "";
              switch ($cnt_benefits){
                case 1:
                  $active_text = "Є одна пільга";
                  break;
                case 2:
                  $active_text = "Є дві пільги";
                  break;
                case 3:
                  $active_text = "Є три пільги";
                  break;
                default :
                  $active_text = "Кількість пільг : " . $cnt_benefits;
                  break;
              }
              ?> 
              <a href="#" 
                onclick="$('#benefit_<?php 
                  echo $data->idPersonSpeciality; ?>').slideToggle(); return false;">
                  <span class="label label-info">
                    <i class="icon-white icon-info-sign"></i>
                    <?php echo $active_text; ?>
                  </span></a>
              <div style="display:none;" 
                id="benefit_<?php echo $data->idPersonSpeciality; ?>"> <?php
                foreach ($benefits as $id => $benefit){
                  /* @var $benefit Personbenefits */
                  $bgcolor = 'white';
                  $title = '';
                  if ($benefit['isPV']){
                    $bgcolor = '#FFFFCC';
                    $title .= '(абітурієнт має право на ПЕРШОЧЕРГОВИЙ вступ)';
                  }
                  if ($benefit['isPZK']){
                    $bgcolor = '#CCDDCC';
                    $title .= '(абітурієнт має право на вступ ПОЗА КОНКУРСОМ)';
                  } ?>
                  <div class='well well-small'
                    style='margin-bottom: 3px; width: 125px !important;
                           height: 140px !important;
                           font-size: 7pt;
                           overflow-wrap: break-word;
                           overflow-y: auto;
                           background-color: <?php echo $bgcolor; ?> ;'
                    title='<?php echo $title; ?>' >
                    <?php echo $benefit['name']; ?>
                  </div> <?php
                } ?> 
              </div> <?php
            }
          }
        ),

        array(
            'header' => 'Рейтингові відмітки',
            'htmlOptions' => array(
              'style' => 'width: 200px;'  
            ),
            'value' => function ($data,$row){
              /* @var $data Personspeciality */
              $Total = 0.0;
              $doc_val = 0;
              $doc_val_zno = 0;
              if (!$data->edbo && $data->edboID){
                $data->edbo = EdboData::model()->findByPk($data->edboID);
              }
              // 123
              $ConverAttestat = new ConvertAttestat;
              $doc_val = round($data->PointDocValue,2);
              //var_dump($doc_val);
              $post = ConvertAttestat::model()->findall('twelve_p=:twelve_p', array(':twelve_p'=> $doc_val));
              $doc_val = $post[0]['two_hundred_p'];
              /*$post=ConvertAttestat::model()->find(array(
                    'select'=>'two_hundred_p',
                    'condition'=>'twelve_p=:twelve_p',
                    'params'=>array(':twelve_p'=>'9.4'),
                ));*/
              $doc_val_zno = round($data->ZnoDocValue,2);
              $doc_name = 'Документ';
              $doc_desc = ($data->entrantdoc)? $data->entrantdoc->type->PersonDocumentTypesName : "Відсутній";
              $Total += (float)$doc_val*0.1;
              $Total += (($data->documentSubject1)? (float)$data->documentSubject1->SubjectValue* $data->sepciality->ZnoKoef1 : 0.0);
              $Total += (($data->documentSubject2)? (float)$data->documentSubject2->SubjectValue* $data->sepciality->ZnoKoef2 : 0.0);
              $Total += (($data->documentSubject3)? (float)$data->documentSubject3->SubjectValue* $data->sepciality->ZnoKoef3 : 0.0);
              $Total += (float)$data->AdditionalBall;
              $Total += (float)$data->CoursedpBall;
              $Total += ($data->olymp? (float)$data->olymp->OlympiadAwardBonus : 0.0);
              $Total += (float)$data->Exam1Ball;
              $Total += (float)$data->Exam2Ball;
              $Total += (float)$data->Exam3Ball;
              //виведення відмітки цільового вступу
              if ($data->QuotaID){
                $span_class = 'label-info';
                $info_title = '';
                if ($data->edbo){
                  $span_class = ($data->QuotaID > 0 && $data->edbo->Quota == '1')? 
                          'label-success' : 'label-important';
                  $info_title = ($data->QuotaID > 0 && $data->edbo->Quota == '1')?
                          "" : 'В даних ЄДЕБО цей параметр ВІДСУТНІЙ';
                } ?>
                <span class='label <?php echo $span_class; ?>' 
                  style='margin-bottom: 3px;
                         font-size: 8pt; font-family: Tahoma; padding: 4px;'
                  title='<?php echo $info_title; ?>' >
                  Цільовий вступ
                </span>
                <div class="clear"></div> <?php            
              } else if ((isset($data->edbo->Quota)? ($data->edbo->Quota == '1') : false)){ ?>
                <div style="color:red;" title='У Абітурієнті відсутня'>
                  В ЄДЕБО є відмітка цільового вступу
                </div> <?php
              }
              //виведення відмітки вступу поза куонкурсом
              if ($data->isOutOfComp){
                $span_class = 'label-info';
                $info_title = '';
                if ($data->edbo){
                  $span_class = ($data->isOutOfComp != '0' && $data->edbo->Benefit == '1')? 
                          'label-success' : 'label-important';
                  $info_title = ($data->isOutOfComp != '0' && $data->edbo->Benefit == '1')?
                          "" : 'В даних ЄДЕБО цей параметр ВІДСУТНІЙ';
                } ?>
                <span class='label <?php echo $span_class; ?>' 
                  style='margin-bottom: 3px; font-size: 8pt; font-family: Tahoma; padding: 4px;'
                  title='<?php echo $info_title; ?>'>
                  Поза конкурсом
                </span>
                <div class="clear"></div> <?php
              } else if ((isset($data->edbo->Benefit)? ($data->edbo->Benefit == '1') : false)){ ?>
                <div style="color:red;" title='У Абітурієнті відсутня'>
                  В ЄДЕБО є відмітка вступу поза куонкурсом
                </div> <?php
              }
              //виведення відмітки першочергового вступу
              if ($data->isExtraEntry){
                $span_class = 'label-info';
                $info_title = '';
                if ($data->edbo){
                  $span_class = ($data->isExtraEntry != '0' && $data->edbo->PriorityEntry == '1')? 
                          'label-success' : 'label-important';
                  $info_title = ($data->isExtraEntry != '0' && $data->edbo->PriorityEntry == '1')?
                          '' : 'В даних ЄДЕБО цей параметр ВІДСУТНІЙ';
                } ?>
                <span class='label <?php echo $span_class; ?>' 
                  style='margin-bottom: 3px; font-size: 8pt; font-family: Tahoma; padding: 4px;'
                  title='<?php echo $info_title; ?>'>
                  Першочерговий вступ
                </span>
                <div class="clear"></div> <?php           
              } else if ((isset($data->edbo->PriorityEntry)? 
                  ($data->edbo->PriorityEntry == '1') : false)){ ?>
                <div style="color:red;" title='У Абітурієнті відсутня'>
                  В ЄДЕБО є відмітка першочергового вступу
                </div> <?php
              }
              //виведення балів
              $span_class = 'label-info';
              $add_string = '';
              if ($data->edbo){
                $span_class = (sprintf("%.3f", $data->edbo->RatingPoints) == sprintf("%.3f", $Total))? 
                    'label-success' : 'label-important';
                $add_string = ' В даних ЄДЕБО: '. $data->edbo->RatingPoints;
              }
              $add_string .= ' Сomputed: '. $Total; /* $data->ComputedPoints */?>
              <div style='width: 70px !important;float:left;'>Разом : </div>
              <a href='#'
                style='margin-left: 5px;'
                onclick='$("#id_<?php echo $data->idPersonSpeciality; ?>").slideToggle(); return false;'
                title='<?php echo $add_string; ?>'>
                <span class='label <?php echo $span_class; ?>' 
                  style='margin-bottom: 3px;
                    font-size: 10pt; font-family: Tahoma; padding: 4px;'>
                  <i class='icon-white icon-info-sign'></i>
                  <?php echo $Total; ?>
                </span>
              </a>
              <div class="clear"></div>
              <div id="id_<?php echo $data->idPersonSpeciality; ?>">  <?php
              $span_class = 'label-info';
              $country_span_class = 'label-info';
              $docnum_span_class = 'label-info';
              $docseria_span_class = 'label-info';
              $priority_span_class = 'label-info';
              $add_string = '';
              if ($data->edbo){
                $span_class = (sprintf("%.2f",$data->edbo->DocPoint) == sprintf("%.2f",(float)$doc_val*0.1))?
                        'label-success' : 'label-important';
                $country_span_class = ($data->edbo->Country == $data->person->country->CountryName)?
                        'label-success' : 'label-important';
                $priority_span_class = ($data->edbo->Priority == $data->priority)?
                        'label-success' : 'label-important';
                if (!empty($data->entrantdoc)){
                  $docnum_span_class = ($data->edbo->DocNumber == $data->entrantdoc->Numbers)?
                        'label-success' : 'label-important';
                } else {
                  $docnum_span_class = ($data->edbo->DocNumber == "")?
                        'label-success' : 'label-important';
                }
                // $docseria_span_class = ($data->tDocSeria == $data->tDocSeries)?
                        // 'label-success' : 'label-important';
                $add_string = '<span class=\'label label-info\' 
                  title="'.(($data->edbo)? 'В даних ЄДЕБО:'.$data->edbo->DocPoint : '').'"
                  style=\'margin-bottom: 3px; font-size: 8pt; margin-left: 2px;\'>' 
                  . $data->edbo->DocPoint . '</span>';
                $c = preg_match('/ЗНО:([0-9\.]+)\+/',$data->edbo->DetailPoints,$matches);
                $edboZNO = (isset($matches[1]))? $matches[1] : 0.0;
              }
              $ZNOSum_local=$data->documentSubject1->SubjectValue*$data->sepciality->ZnoKoef1+$data->documentSubject2->SubjectValue*$data->sepciality->ZnoKoef2+$data->documentSubject3->SubjectValue *  $data->sepciality->ZnoKoef3;
              echo '<div style=\'width: 70px !important;float:left;\' title=\''.$doc_desc.'\'>'.$doc_name.' : </div>' . (($doc_val*0.1)? 
                      '<span class=\'label label-info\' style=\'margin-bottom: 3px;font-size: 8pt;\''
                      . ' title="Значення в документі : '.$doc_val*0.1.'">'.
                      $doc_val*0.1 . '</span>' . (($data->edbo)? $add_string : '') . '<div class="clear"></div>' : 
                
                      '<span class=\'label label-red\' style=\'margin-bottom: 3px;font-size: 8pt;\'>'.
                      'н/з' . '</span><div class="clear"></div>');
              
              echo '<div style=\'width: 70px !important;float:left;\' title=\''.$doc_desc.'\'>серія,№ : </div>' .
                '<span class=\'label '.$docseria_span_class.'\' style=\'margin-bottom: 3px;font-size: 8pt;\''
                . ' title="'.(($data->edbo)? 'Значення в ЄДЕБО: '.$data->edbo->DocSeria . "; $data->tDocSeries <=> $data->tDocSeria" : '').'">'.
                (($data->entrantdoc) ? $data->entrantdoc->Series : 'н/з') . '</span>' 
                .'<span class=\'label '.$docnum_span_class.'\' style=\'margin-left: 4px; '
                    . ' margin-bottom: 3px;font-size: 8pt;\''
                . ' title="'.(($data->edbo)? 'Значення в ЄДЕБО: '.$data->edbo->DocNumber : '').'">'.
                (($data->entrantdoc) ? $data->entrantdoc->Numbers : 'н/з') . '</span>' 
                . '<div class="clear"></div>';
              
              echo '<div style=\'width: 70px !important;float:left;color:'.(($data->edbo)? 
                ((
                $ZNOSum_local!= $edboZNO)? 'red': 'green') :'black')
              .'\' title="Сума: '.$ZNOSum_local.(($data->edbo)? ', у ЄДЕБО : '.$edboZNO : '').'">ЗНО : </div>' . (($data->documentSubject1)? 
                      '<span class=\'label label-info\' '
                      . 'style=\'margin-bottom: 3px; font-size: 8pt; font-family: Tahoma;\' '
                      . 'title=\''.(($data->documentSubject1->subject1) ? $data->documentSubject1->subject1->SubjectName : '').'\'>'.
                      // Бал ЗНО с учетом коофициента
                      $data->documentSubject1->SubjectValue *  $data->sepciality->ZnoKoef1 . '</span>' : 
                
                      '<span class=\'label label-red\' style=\'margin-bottom: 3px; font-size: 8pt; font-family: Tahoma;\'>'.
                      'н/з' . '</span>');
              
              echo (($data->documentSubject2)? 
                      '<span class=\'label label-info\' '
                      . 'style=\'margin-bottom: 3px;margin-right: 2px;margin-left:2px; font-size: 8pt; font-family: Tahoma;\' '
                      . 'title=\''.(($data->documentSubject2->subject2) ? $data->documentSubject2->subject2->SubjectName : '').'\'>'.
                      $data->documentSubject2->SubjectValue * $data->sepciality->ZnoKoef2 . '</span>' : 
                
                      '<span class=\'label label-red\' style=\'margin-bottom: 3px;margin-right: 2px;margin-left:2px; font-size: 8pt; font-family: Tahoma;\'>'.
                      'н/з' . '</span>');
              
              echo (($data->documentSubject3)? 
                      '<span class=\'label label-info\' '
                      . 'style=\'margin-bottom: 3px; font-size: 8pt; font-family: Tahoma;\' '
                      . 'title=\''.(($data->documentSubject3->subject3) ? $data->documentSubject3->subject3->SubjectName : '').'\'>'.
                      $data->documentSubject3->SubjectValue *  $data->sepciality->ZnoKoef3. '</span><div class="clear"></div>' : 
                
                      '<span class=\'label label-red\' style=\'margin-bottom: 3px; font-size: 8pt; font-family: Tahoma;\'>'.
                      'н/з' . '</span><div class="clear"></div>');
              // Пріорітети
              //echo $data->priority;
              //echo $data->edbo->Priority;
              echo '<div style=\'width: 70px !important;float:left;\'>Пріорітет : </div>' .
                      '<span class=\'label '.$priority_span_class.'\' style=\'margin-bottom: 3px;font-size: 8pt;\''
                      . ' title="'.(($data->edbo)? 'Значення в ЄДЕБО: '. $data->edbo->Priority : '').'">'.
                      $data->priority . '</span>' . '<div class="clear"></div>';
              
              
              echo '<div style=\'width: 70px !important;float:left;\'>Додатково : </div>' . (($data->AdditionalBall)? 
                      '<span class=\'label label-info\' style=\'margin-bottom: 3px; font-size: 8pt; font-family: Tahoma;\'>'.
                      $data->AdditionalBall . '</span><div class="clear"></div>' : 
                
                      '<span class=\'label label-red\' style=\'margin-bottom: 3px; font-size: 8pt; font-family: Tahoma;\'>'.
                      'н/з' . '</span><div class="clear"></div>');
              
              echo '<div style=\'width: 70px !important;float:left;\'>Курси : </div>' . (($data->CoursedpBall)? 
                      '<span class=\'label label-info\' style=\'margin-bottom: 3px; font-size: 8pt; font-family: Tahoma;\'>'.
                      $data->CoursedpBall . '</span><div class="clear"></div>' : 
                
                      '<span class=\'label label-red\' style=\'margin-bottom: 3px; font-size: 8pt; font-family: Tahoma;\'>'.
                      'н/з' . '</span><div class="clear"></div>');
              
              echo '<div style=\'width: 70px !important;float:left;\'>Олімпіади : </div>' . (($data->olymp)? 
                      '<span class=\'label label-info\' style=\'margin-bottom: 3px; font-size: 8pt; font-family: Tahoma;\'>'.
                      $data->olymp->OlympiadAwardBonus . '</span><div class="clear"></div>' : 
                
                      '<span class=\'label label-red\' style=\'margin-bottom: 3px; font-size: 8pt; font-family: Tahoma;\'>'.
                      'н/з' . '</span><div class="clear"></div>');

              echo '<div style=\'width: 70px !important;float:left;\'>Вступні ісп. : </div>' . (($data->Exam1Ball)? 
                      '<span class=\'label label-info\' style=\'margin-bottom: 3px; font-size: 8pt; font-family: Tahoma;\'>'.
                      $data->Exam1Ball . '</span>' : 
                
                      '<span class=\'label label-red\' style=\'margin-bottom: 3px; font-size: 8pt; font-family: Tahoma;\'>'.
                      'н/з' . '</span>');
              echo (($data->Exam2Ball)? 
                      '<span class=\'label label-info\' style=\'margin-bottom: 3px;margin-right: 2px;margin-left:2px; font-size: 8pt; font-family: Tahoma;\'>'.
                      $data->Exam2Ball . '</span>' : 
                
                      '<span class=\'label label-red\' style=\'margin-bottom: 3px;margin-right: 2px;margin-left:2px; font-size: 8pt; font-family: Tahoma;\'>'.
                      'н/з' . '</span>');
              echo (($data->Exam3Ball)? 
                      '<span class=\'label label-info\' style=\'margin-bottom: 3px; font-size: 8pt; font-family: Tahoma;\'>'.
                      $data->Exam3Ball . '</span><div class="clear"></div>' : 
                
                      '<span class=\'label label-red\' style=\'margin-bottom: 3px; font-size: 8pt; font-family: Tahoma;\'>'.
                      'н/з' . '</span><div class="clear"></div>');
              echo '<div style=\'width: 70px !important;float:left;\'>Країна : </div>' .
                      '<span class=\'label '.$country_span_class.'\' style=\'margin-bottom: 3px;font-size: 8pt;\''
                      . ' title="'.(($data->edbo)? 'Значення в ЄДЕБО: '.$data->edbo->Country : '').'">'.
                      $data->person->country->CountryName . '</span>' . '<div class="clear"></div>'; ?> 
              </div><div clas='clear'></div>  <?php
            }
        ),


    ),
    'htmlOptions' => array(
        'style' => 'font-size : 8pt;'
    )
));

echo CHtml::link('Рейтинг у стилі ВступІнфо',Yii::app()->CreateUrl('/rating/rating/ratinginfolinks'),array(
   'target' => '_blank'
)); echo '<hr/>';      
echo CHtml::link('Усі посилання',Yii::app()->CreateUrl('/rating/rating/ratinglinks'),array(
   'target' => '_blank'
)); echo '<hr/>';
echo CHtml::link('Рейтинги ЄДЕБО (перед формуванням - завантажити CSV-файл)',Yii::app()->CreateUrl('/rating/rating/edboratinglinks'),array(
   'target' => '_blank'
)); echo '<hr/>';
echo CHtml::link('Є в ЄДЕБО, немає в БД "Абітурієнт"',Yii::app()->CreateUrl('/rating/edbodata/admin'),array(
   'target' => '_blank'
));

?>

<script>
    $(document).ready(function(){
        
       $(".datepicker").datepicker({'format':"dd.mm.yyyy"});
    });
</script>
