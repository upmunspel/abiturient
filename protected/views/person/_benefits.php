<?php
/*$this BenefitController 
$model = new PersonBenefits();*/
$form = new CActiveForm();
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'benefit-form',
	'enableAjaxValidation'=>false,
)); ?>
    <div class="well">
    <div class="row-fluid">
        <div class="span3">
               <?php 
                $url = Yii::app()->createUrl("personbenefits/create");
                    $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Додати пільгу',
                    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => null, // null, 'large', 'small' or 'mini'
                    'loadingText'=>'Зачекайте...',
                    'htmlOptions'=>array('id'=>'addBenefits',
                        'onclick'=>"PSN.addBenefit(this,'$url');"),
                )); ?>
           
        </div>
    </div>
    <hr>    
    <?php foreach($models as $i=>$model): ?>       
    <div class="row-fluid">    
         <div class="span12">
            <?php echo $form->dropDownList($model,'[$i]BenefitID', Benefit::DropDown(), array('class'=>"span12")); ?>
            <?php foreach($model->documents as $i=>$document): ?>
              <div class="row-fluid">
                  
              </div>    
            <?php endforeach; ?> 
             
         </div>
    </div>
    <?php endforeach; 
    if  (count($models) > 0) :
    ?> 
    <div class="row buttons">
         <hr>      
        <?php $this->widget("bootstrap.widgets.TbButton", array(
			'buttonType'=>'submit',
			'type'=>'primary',
                        'label'=>'Зберегти',
                        )); 
                ?>
    </div>
    <?php else: ?>
    <strong>Пільги відсутні</strong>
    <?php endif; ?>
    </div>    

<?php $this->endWidget(); ?>

</div><!-- form -->