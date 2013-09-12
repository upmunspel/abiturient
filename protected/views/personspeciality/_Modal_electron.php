<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
            'id'=>'spec_electronModal',
            'htmlOptions'=>array('style'=>'width: 1200px; margin-left: -600px;'),
            )
        ); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4><?php echo $model->isNewRecord ? "Нова спеціальність":"Редагування спеціальності"; ?></h4>
    <div style="float: right; font-weight: bold">
        Статус: <span style=" color: red;"><?php echo $model->status->PersonRequestStatusTypeName; ?></span>
    </div>
    <div style="float: right; color: red; font-weight: bold; margin-right: 20px;">
       <?php echo $model->RequestFromEB == 1 ? "Електронна заява":"Заява створена оператором ЗНУ"; ?>
    </div>
    
    <?php if (!$model->isNewRecord): ?>
    <div style="float: right; font-weight: bold; margin-right: 20px;">
        Номер справи: <span><?php echo str_pad($model->RequestNumber, 5, '0', STR_PAD_LEFT); ?></span>
    </div>
    <?php endif; ?>
    Поля з <span class ="required">*</span> необхідно заповнити.
</div>
 
<div class="modal-body <?php echo Yii::app()->user->isShortForm() ? " short":"";?>" id="spec-modal-body">
  
   <?php 
        if($spec==""||!is_numeric($spec)||$spec==0){
        $this->renderPartial("_form_electron_error",array('model'=>$model));
        }
        else{
        $this->renderPartial("_form_electron",array('model'=>$model)); 
        }
    ?>
    
    
</div>
 
<div class="modal-footer">
    <?php 
    if($spec==""||!is_numeric($spec)||$spec==0){
        $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Okay',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    ));
    }
    else{
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
    ));
    } ?>
</div>
 
<?php $this->endWidget(); ?>