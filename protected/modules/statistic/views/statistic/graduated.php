<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
?>
<script>
  
$(function (){
  $("#Graduated_Speciality").autocomplete(
    {delay:1000, minLength:3, "showAnim":"fold",
      "source":"<?php echo Yii::app()->CreateUrl("/rating/specialities/autocomplete"); ?>",
      "select": function(event,ui){ 
        $('#Graduated_SpecialityID').val(ui.item.spec_id);
      }
    });
});

</script>

<div class="row-fluid">


  <div class="row-fluid">
    <?php
    $act = Yii::app()->createUrl("statistic/stat/graduated");
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'graduated-form-modal',
        'enableAjaxValidation' => false,
        'method' => "POST",
        'action' => $act,
    ));
    ?>
    <div class="span12 well">
      <h4>Введення даних</h4>
      <?php
        echo $form->errorSummary($model);
      ?>
      <div class="row-fluid">
      <div class='span3'>
        <?php
        echo $form->textFieldRow(
                $model, 
                'Speciality', 
                array('class' => 'span12'));
        ?>
      </div>
      <div class='span3'>
        <?php
        echo $form->textFieldRow(
                $model, 
                'Year', 
                array('class' => 'span12'));
        ?>
      </div>
      <div class='span3'>
        <?php
        echo $form->textFieldRow(
                $model, 
                'Number', 
                array('class' => 'span12'));
        ?>
      </div>
      <div class='span3'>
        <?php
        $this->widget("bootstrap.widgets.TbButton", array(
            'buttonType' => 'submit',
            'type' => 'primary',
            "size" => "large",
            'label' => 'Зберегти',
        ));
        ?>
      </div>
      </div>
    </div>
    <?php $this->endWidget(); ?>
  </div>
  
  <div class="row-fluid">
    <?php 
    $this->widget('bootstrap.widgets.TbGridView', array(
      'id' => 'graduated-data-grid',
      'dataProvider'=>$data,
      'filter'=>NULL,
      'columns' => array(
        'idGraduated',
        'Year',
        'Number',      
        'Speciality',
        array(
          'class'=>'bootstrap.widgets.TbButtonColumn',
          'template'=>'{delete}',
          'buttons'=>array(
            'delete' => array(
              'label'=>'Видалити',
              'icon' => 'trash',
              'click'=>"function(){
                  $.fn.yiiGridView.update('graduated-data-grid', {
                      type:'POST',
                      url:$(this).attr('href'),
                      success:function(data) {
                            $.fn.yiiGridView.update('graduated-data-grid');
                      }
                  })
                  return false;
                }",
              'url'=>'Yii::app()->CreateUrl("/statistic/stat/deletegraduated/",array("id"=>$data->primaryKey))',
            ),
          )
        )
      )
    ));
    ?>
  </div>

  </div>
</div>