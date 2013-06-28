<?php
/*
    @var $model Documents  
*/
?>
<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
            'id'=>'znoModal',
            'htmlOptions'=>array('style'=>'width: 700px; margin-left: -350px;'),
            )
        ); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Cертифікат ЗНО</h4>
    Поля з <span class ="required">*</span> необхідно заповнити.
</div>
 
<div class="modal-body" id="zno-modal-body">
  
    <?php 
         $this->renderPartial("_form",array('model'=>$model,'subjects'=>$subjects)); ?>
</div>
 
<div class="modal-footer">
    <?php 
        $url = Yii::app()->createUrl("documents/newznosubject");
            $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Додати предмет',
            'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => null, // null, 'large', 'small' or 'mini'
            'loadingText'=>'Зачекайте...',
            'htmlOptions'=>array('id'=>'addBenefits',
                'onclick'=>"PSN.addZnoSubject(this,'$url');",
                'style'=>"float: left;"),
        )); ?>
    
    <?php 
     
            $url = Yii::app()->createUrl("documents/appendzno");
            $this->widget('bootstrap.widgets.TbButton', array(
              'type'=>'primary',
              'label'=>'Зберегти',
              'htmlOptions'=>array('onclick'=>"PSN.appendZno(this, '$url')"),
            ));
       ?>
    
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Скасувати',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>