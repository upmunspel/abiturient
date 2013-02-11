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
                $url = Yii::app()->createUrl("personbenefits/create",array('personid'=>$personid));
                    $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Додати пільгу',
                    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => null, // null, 'large', 'small' or 'mini'
                    'loadingText'=>'Зачекайте...',
                    'htmlOptions'=>array('id'=>'addBenefits',
                        'onclick'=>"PSN.addBenefit(this,'$url');"),
                )); ?>
        </div>
        <div class="span9" align="right">
             <?php 
                $url = Yii::app()->createUrl("personbenefits/create",array('personid'=>$personid));
                    $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Оновити',
                    'type'=>'', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => null, // null, 'large', 'small' or 'mini'
                    'loadingText'=>'Зачекайте...',
                    'icon'=>'icon-refresh',    
                    'htmlOptions'=>array('id'=>'reloadBenefits',
                        'onclick'=>"PSN.reloadBenefit(this,'$url');",
                        'title'=>'Оновити до останньго збереженого стану'),
                )); ?>
           
        </div>
    </div>
    <hr>    
    <?php foreach($models as $i=>$model): ?>       
    <div class="row-fluid">    
         <div class="span10">
             
            <?php echo $form->hiddenField($model,"[$i]idPersonBenefits"); ?> 
            <?php echo $form->hiddenField($model,"[$i]PersonID"); ?> 
            <?php echo $form->dropDownList($model,"[$i]BenefitID", Benefit::DropDown(), array('class'=>"span12")); ?>
            <?php echo CHtml::hiddenField("deleted", 0, array("class"=>"deleted")); ?>
            <?php foreach($model->documents as $i=>$document): ?>
              <div class="row-fluid">
                  
              </div>    
            <?php endforeach; ?> 
         </div>
         <div class="span2"  align="right">
                <?php $this->widget("bootstrap.widgets.TbButton", array(
			'buttonType'=>'ajaxLink',
			//'type'=>'inverse',
                        'label'=>'',
                        'icon'=>"icon-plus-sign",
                        'htmlOptions'=>array("style"=>"margin-top: 4px;",'title'=>"Додати документ"), 
                        )); 
                ?>
              <?php $this->widget("bootstrap.widgets.TbButton", array(
			'buttonType'=>'ajaxLink',
			'type'=>'danger',
                        'label'=>'',
                        'size' => null,
                        'icon'=>"icon-trash",
                        'htmlOptions'=>array("style"=>"margin-top: 4px;",'title'=>"Видалити пільгу"), 
                        )); 
                ?>
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