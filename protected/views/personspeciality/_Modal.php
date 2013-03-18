<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
            'id'=>'specModal',
            'htmlOptions'=>array('style'=>'width: 1000px; margin-left: -500px;'),
            )
        ); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Нова спеціальність</h4>
    Поля з <span class ="required">*</span> необхідно заповнити.
</div>
 
<div class="modal-body" id="spec-modal-body">
  
    <?php $this->renderPartial("_form",array('model'=>$model)); ?>
</div>
 
<div class="modal-footer">
       
    <?php 
      $url = $model->isNewRecord ? Yii::app()->createUrl("personspeciality/create"): Yii::app()->createUrl("personspeciality/update",array("id"=>$model->idPersonSpeciality)) ;
      $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Зберегти',
        'htmlOptions'=>array('onclick'=>"PSN.appendSpec(this, '$url')"),
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Скасувати',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>