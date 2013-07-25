<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
            'id'=>'studpriceModal',
            'htmlOptions'=>array('style'=>'width: 1200px; margin-left: -600px;'),
            )
        ); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
        <h1>Оновлення інформації про абітурієнта (<?php echo $model->PersonID; ?>)
        </h1><h3>Код спеціальності(<?php echo $model->SepcialityID;?> )
        </h3>
</div>
 
<div class="modal-body  "id="studprice-modal-body">
<?php $this->renderPartial("_personpriceform",array('model'=>$model)); ?> 
<div class="modal-footer">
    <?php 
$url = Yii::app()->createUrl("Personspeciality/studupdate",array("id"=>$model->idPersonSpeciality));
$this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Зберегти',
        'htmlOptions'=>array('onclick'=>"PSN.appendStudprice(this, '$url')"),
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Скасувати',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>