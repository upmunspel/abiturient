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
        <div class="span2">
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
        <div class="span2">
                <?php
                    $url = Yii::app()->createUrl("personbenefits/edboupdate",array('personid'=>$personid));
                    $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Синхронізувати',
                    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => null, // null, 'large', 'small' or 'mini'
                    'loadingText'=>'Зачекайте...',
                    'htmlOptions'=>array('onclick'=>"PSN.edboBenefitsUpdate(this,'$url');",),
                )); ?>
        </div>
        <div class="span8">    
            <p> Синхронізація завантажує існуючи пільги з бази ЄДБО та зберігає додані оператором пільги до бази ЄДБО.</p>
        </div>
    </div>
    <hr>   
    
    <?php if (Yii::app()->user->hasFlash("message")): ?>
        <div class="row-fluid" ><h3 style="color: red;"><?php echo  Yii::app()->user->getFlash("message"); ?></h3></div>
    <?php endif; ?>
        
    <?php  //$arr = PersonDocumentTypes::DropDown(1);
    foreach($models as $i=>$model): ?>       
    <div class="row-fluid">    
         <div class="span11">
            <?php echo $form->hiddenField($model,"[$i]idPersonBenefits"); ?>
            <?php echo $form->dropDownList($model,"[$i]BenefitID", Benefit::DropDown(), array('class'=>"span12", 'disabled'=>"disabled",
                "style"=>!empty($model->edboID)? "color: green;":"" )); ?>
            
              <div class="row-fluid">
               
                  <div class="span11" style="padding-left: 30px;">
                      <?php echo  !empty($model->Series) ? " Серія:".$model->Series:""; ?>
                      <?php echo  !empty($model->Numbers) ? " №".$model->Numbers:""; ?>
                      <?php echo  !empty($model->Issued) ? " Виданий: ".$model->Issued:""; ?>
                  </div>
              </div>    
         
         </div>
        
         <div class ="span1"align="right">
            <?php 
            if (empty($model->edboID) || Yii::app()->user->checkAccess("updateAllPost")  ){
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
            }
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
