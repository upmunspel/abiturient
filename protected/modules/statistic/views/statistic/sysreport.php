
<div class="row-fluid">


  <div class="row-fluid">
    <?php
    $act = Yii::app()->createUrl("statistic/stat/sysreport");
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'sysrept-form-modal',
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
      <div class='span6'>
        <?php
        echo $form->dropDownListRow(
                $model, 
                'compar_type',
                array('text'=>'text','dropdowntext'=>'dropdowntext',
                  'checkbox'=>'checkbox', 'date'=>'date'),
                array('class' => 'span12'));
        ?>
      </div>
      <div class='span6'>
        <?php
        echo $form->textFieldRow(
                $model, 
                'name', 
                array('class' => 'span12'));
        ?>
      </div>
      </div>
      <div class="row-fluid">
        <div class='span6'>
          <?php
          echo $form->textAreaRow(
                  $model, 
                  'db_rels',
                  array('class' => 'span12'));
          ?>
        </div>
        <div class='span6'>
          <?php
          echo $form->textAreaRow(
                  $model, 
                  'db_attr', 
                  array('class' => 'span12'));
          ?>
        </div>
        </div>
    </div>
    </div>
    <?php $this->endWidget(); ?>
  </div>
  
  <div class="row-fluid">
    <?php 
    $this->widget('bootstrap.widgets.TbGridView', array(
      'id' => 'sysrept-data-grid',
      'dataProvider'=>$data,
      'filter'=>NULL,
      'columns' => array(
        'id',
        'name',
        'db_attrname',      
        'db_alterattr',      
        'db_attr',      
        'db_group_concat',
        'view_value',
        array(
          'class'=>'bootstrap.widgets.TbButtonColumn',
          'template'=>'{delete}',
          'buttons'=>array(
            'delete' => array(
              'label'=>'Видалити',
              'icon' => 'trash',
              'click'=>"function(){
                  $.fn.yiiGridView.update('sysrept-data-grid', {
                      type:'POST',
                      url:$(this).attr('href'),
                      success:function(data) {
                            $.fn.yiiGridView.update('sysrept-data-grid');
                      }
                  })
                  return false;
                }",
              'url'=>'Yii::app()->CreateUrl("/statistic/stat/deletesysreport/",array("id"=>$data->primaryKey))',
            ),
          )
        )
      )
    ));
    ?>
  </div>

  </div>
</div>