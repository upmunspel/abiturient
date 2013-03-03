<?php
/*$this BenefitController 
$model = new PersonBenefits();*/
//$form = new CActiveForm();
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'benefit-form-modal',
	'enableAjaxValidation'=>false,
)); ?>
   
    <div class="row-fluid">    
         <div class="span12">
             
            <?php //echo $form->hiddenField($model,"idPersonBenefits"); ?> 
            <?php echo $form->hiddenField($model,"PersonID"); ?> 
            <?php echo $form->dropDownList($model,"BenefitID", Benefit::DropDown(4), array('class'=>"span12")); ?>
         </div>
    </div>
    
    <?php if (empty($documents)) $documents = array();
    foreach($documents as $i=>$document): ?>
        <div class="row-fluid">
         <div class="span1" align="center">
            <div class="row-fluid">
                 <div class="span12"></div>
            </div>   
             <div class="row-fluid">
                 <div class="span12"><b><?php echo ($i+1)."."; ?></b></div>
             </div>    
         </div>
         <div class="span11">
            <?php  $this->renderPartial("_document",array("model"=>$document,'form'=>$form,'i'=>$i)); ?>
         </div>
        </div>
    <?php endforeach; ?> 
    <script>
        
        $('#benefit-form-modal .datepicker').datepicker({'format':'dd.mm.yyyy'});
        $('.datepicker').css("z-index","9999");
        
       
    </script>
<?php $this->endWidget(); ?>
</div><!-- form -->
