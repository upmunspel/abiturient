<?php 
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'person-form',
        //'type'=>'horizontal',
	'enableAjaxValidation'=>true
));
?>
<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>
<?php echo $form->errorSummary($model); ?>
<?php //echo $form->errorSummary($model->personprice) ?>
<div class="form well">
<?php  //------------------------------------------------------------------------------------------------------------------------------------//?>

    <div class="row-fluid">
        <div class ="span4">
        <?php 
        $idperson=$model->idPersonSpeciality;
        $model->CustomerName=PersonSpecialityView::model()->find("idPersonSpeciality = $idperson")->FIO;           
        echo $form->labelEx($model,'CustomerName');//,array('class'=>'span3'));?>
        <?php echo $form->textField($model,'CustomerName',array('id'=>"CustomerName", 'class'=>'span12 ')); ?>
        <?php echo $form->error($model,'CustomerName');?>
        </div>
        <div class ="span8">
        <?php echo $form->labelEx($model,'DocCustumer');//,array('class'=>'span3'));?>
        <?php echo $form->textField($model,'DocCustumer',array('id'=>"DocCustumer", 'class'=>'span12')); ?>
        <?php echo $form->error($model,'DocCustumer'); ?>    
        </div>
</div>
<div class="row-fluid">
        <div class ="span4">    
        <?php 
        $idPrices=$model->SepcialityID;
        //$Set = Prices::GetPrice($idPrices); 
        
        $model->AcademicSemesterID=Prices::model()->find("SpecialityID = $idPrices")->PriceSemesterInNumbers; 

        echo $form->labelEx($model,'AcademicSemesterID',array('class'=>'span12'));?>
        <?php echo $form->textField($model,'AcademicSemesterID',array('id'=>"AcademicSemesterID", 'class'=>'span12','readonly'=>true)); ?>
        <?php echo $form->error($model,'AcademicSemesterID');
        //echo $Set = Prices::GetPrice($idPrices); ?> 
        </div>
        <div class ="span4">
        <?php echo $form->labelEx($model,'CustomerPaymentDetails');//,array('class'=>'span3'));?>
        <?php echo $form->textField($model,'CustomerPaymentDetails',array('id'=>"CustomerPaymentDetails", 'class'=>'span12')); ?>
        <?php echo $form->error($model,'CustomerPaymentDetails'); ?>    
        </div>
        <div class ="span4">
        <?php echo $form->labelEx($model,'CustomerAddress');//,array('class'=>'span3'));?>
        <?php echo $form->textField($model,'CustomerAddress',array('id'=>"CustomerAddress", 'class'=>'span12 ')); ?>
        <?php echo $form->error($model,'CustomerAddress'); ?>    
        </div>
    
</div>
    <div class="row-fluid">
        <div class ="span4">
        <?php 
        echo $form->labelEx($model,'DateОfСontract');//,array('class'=>'span3'));?>
        <?php echo $form->textField($model,'DateОfСontract',array('class'=>'span12 datepicker')); ?>
        <?php echo $form->error($model,'DateОfСontract'); ?>    
        </div>
        <div class ="span4">
        <?php echo $form->labelEx($model,'PaymentDate');//,array('class'=>'span3'));?>
        <?php echo $form->textField($model,'PaymentDate',array('id'=>"PaymentDate", 'class'=>'span12')); ?>
        <?php echo $form->error($model,'PaymentDate'); ?>    
        </div>
        
</div>
</div>
<?php $this->endWidget(); ?>
<script>
    $('#person-form .datepicker').datepicker({'format':'dd.mm.yyyy'});
    $('.datepicker').css("z-index","9999");
    $("#person-form .switch").bootstrapSwitch();
</script>