<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
            'id'=>'benefitModal',
            'htmlOptions'=>array('style'=>'width: 900px; margin-left: -450px;'),
            )
        ); ?>
 
<div class="modal-header" style="wi">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Нова пільта та підтверджуючі документи</h4>
    Поля з <span class ="required">*</span> необхідно заповнити.
</div>
 
<div class="modal-body">
    <div id="new-benefit"></div>
</div>
 
<div class="modal-footer">
    <?php 
        $url = Yii::app()->createUrl("personbenefits/newbenefitdoc");
            $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Додати документ',
            'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => null, // null, 'large', 'small' or 'mini'
            'loadingText'=>'Зачекайте...',
            'htmlOptions'=>array('id'=>'addBenefits',
                'onclick'=>"PSN.addBenefitDoc(this,'$url');",
                'style'=>"float: left;"),
        )); ?>
    
    <?php 
      $url = Yii::app()->createUrl("personbenefits/appendbenefit");
      $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Зберегти',
        'htmlOptions'=>array('onclick'=>"PSN.appendBenefit(this, '$url')"),
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Скасувати',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>