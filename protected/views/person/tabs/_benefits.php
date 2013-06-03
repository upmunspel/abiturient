<?php
/*$this BenefitController 
$model = new PersonBenefits();*/
//$form = new CActiveForm();
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
                        'onclick'=>"PSN.addBenefit(this,'$url');",
                        ),
                )); ?>
           
        </div>
    </div>
    <hr>    
    <?php  //$arr = PersonDocumentTypes::DropDown(1);
    foreach($models as $i=>$model): ?>       
    <div class="row-fluid">    
         <div class="span11">
            <?php echo $form->hiddenField($model,"[$i]idPersonBenefits"); ?>
            <?php echo $form->dropDownList($model,"[$i]BenefitID", Benefit::DropDown(), array('class'=>"span12", 'disabled'=>"disabled")); ?>
            
              <div class="row-fluid">
                  <div class="span11">
                      <?php echo " Серія:".$model->Series." №".$model->Numbers." Видана: ".$model->Issued; ?>
                  </div>
              </div>    
         
         </div>
        
         <div class ="span1"align="right">
            <?php 
            $url = Yii::app()->createUrl("personbenefits/delete",array('id'=>$model->idPersonBenefits, "personid"=>$personid));
            $this->widget("bootstrap.widgets.TbButton", array(
			'type'=>'danger',
                        'label'=>'',
                        'size' => null,
                        'icon'=>"icon-trash",
                        'htmlOptions'=>array(
                                "style"=>"margin-top: 2px;",
                                'title'=>"Видалити пільгу",
                                'class'=>"span12",
                                'onclick'=>"PSN.delBenefit(this,'$url');"), 
                        )); 
             ?>
        </div>
        
    </div>
    <?php endforeach; 
    if  (count($models) > 0) :
    ?> 
   
    <?php else: ?>
    <strong>Пільги відсутні</strong>
    <?php endif; ?>
    </div>    

<?php $this->endWidget(); ?>

</div><!-- form -->
