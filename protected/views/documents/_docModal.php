<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
            'id'=>'docModal',
            'htmlOptions'=>array('style'=>'width: 1000px; margin-left: -500px;'),
            )
        ); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4><?php echo $model->isNewRecord ? "Новий документ":"Редагування документу"; ?></h4>
    Поля з <span class ="required">*</span> необхідно заповнити.
</div>
 
<div class="modal-body" id="doc-modal-body">
    <?php $this->renderPartial("_formfull",array('model'=>$model)); ?>
</div>
 
<div class="modal-footer">
       
    <?php  //if (empty($model->edboID) || Yii::app()->user->checkAccess("updateAllPost")  ){
          
                $url = $model->isNewRecord ? Yii::app()->createUrl("documents/create",array("personid"=>$model->PersonID)): Yii::app()->createUrl("documents/update",array("id"=>$model->idDocuments)) ;
                $this->widget('bootstrap.widgets.TbButton', array(
                  'type'=>'primary',
                  'label'=>'Зберегти',
                  'htmlOptions'=>array('onclick'=>"PSN.appendDoc(this, '$url')"),
              )); 
         //}?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Скасувати',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>