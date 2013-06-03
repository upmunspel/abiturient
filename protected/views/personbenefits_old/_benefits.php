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
                $url = Yii::app()->createUrl("personbenefits/newbenefit",array('personid'=>$personid));
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
    <?php  $arr = PersonDocumentTypes::DropDown(1);
    foreach($models as $i=>$model): ?>       
    <div class="row-fluid">    
         <div class="span11">
             
            <?php echo $form->hiddenField($model,"[$i]idPersonBenefits"); ?>
            <?php echo $form->dropDownList($model,"[$i]BenefitID", Benefit::DropDown(4), array('class'=>"span12", 'disabled'=>"disabled")); ?>
            <?php
            
            //var_dump($arr);
            foreach($model->items as $j=>$item): ?>
              <div class="row-fluid">
                  <div class="span1" align="right"><?php echo ($j+1).".";?></div>
                  <div class="span11"><?php
                        $doc = $item->document;
                        //$doc = new Documents();
                       echo $arr[$item->document->TypeID]." Серія:".$doc->Series." №".$doc->Numbers." Видана: ".$doc->Issued." від ".$doc->DateGet;
                       ?>
                  </div>
              </div>    
            <?php endforeach; ?> 
             
         </div>
        <div class ="span1"align="right">
            <?php 
            $url = Yii::app()->createUrl("personbenefits/delbenefit",array('benefitid'=>$model->idPersonBenefits, "personid"=>$personid));
            $this->widget("bootstrap.widgets.TbButton", array(
			'type'=>'danger',
                        'label'=>'',
                        'size' => null,
                        'icon'=>"icon-trash",
                        'htmlOptions'=>array(
                                "style"=>"margin-top: 2px;",
                                'title'=>"Видалити пільгу",
                                'class'=>"span12",
                                'onclick'=>"PSN.deleteBenefit(this,'$url');"), 
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
