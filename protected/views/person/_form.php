<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'person-form',
    //'type'=>'horizontal',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array("class"=>"well"),
)); 

$form=new TbActiveForm();?>
<p class="help-block"><strong>Особисті дані</strong></p>
        <hr>
        <?php echo $form->errorSummary($model); ?>
        <div class="row-fluid">
            <div class ="span4">
            <?php echo $form->label($model,'FirstName');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'FirstName',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
            <div class ="span4">
            <?php echo $form->label($model,'MiddleName');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'MiddleName',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
            <div class ="span4">
            <?php echo $form->label($model,'FirstName');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'LastName',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
        </div>
        <div class="row-fluid">
            <div class ="span4">
            <?php echo $form->label($model,'FirstName');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'FirstName',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
            <div class ="span4">
            <?php echo $form->label($model,'MiddleName');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'MiddleName',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
            <div class ="span4">
            <?php echo $form->label($model,'FirstName');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'LastName',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
        </div>
        
        <div class="row-fluid">
            <div class ="span3">
                <?php echo $form->labelEx($model,'Birthday'); ?>
                <?php echo $form->textField($model,'Birthday', array('class'=>'span12 datepicker')); ?>
                <script type="text/javascript">
                    $(".datepicker").datepicker({'format':"mm.dd.yyyy"});
                </script>
            </div>
            <div class ="span3">
                <?php echo $form->labelEx($model,'PersonSexID'); ?>
                <?php echo $form->dropDownList($model,'PersonSexID', PersonSexTypes::DropDown(), array('class'=>'span12')); ?>
            </div>
            <div class ="span3">
                
            </div>
            <div class ="span3">
                <?php echo $form->labelEx($model,'IsResident'); ?>
                <?php echo $form->dropDownList($model,'IsResident', array("Ні", "Так"), array('class'=>'span12')); ?>
                              
            </div>
        </div>
        <p class="help-block"><strong>Контакти</strong></p>
        <hr>
         <div class="row-fluid">
            <div class ="span12">
            
            <?php echo CHtml::label("Область або велике місто","KOATUU1");//,array('class'=>'span3'));?>
            <?php 
            
            if (empty($model->KOATUUCode)) {$model->KOATUUCode = '2310100000';}
            if (empty($model->idKOATUU)) {$model->idKOATUU = 105574;}
            $KL1 = KoatuuLevel1::getKoatuuLevelID($model->KOATUUCode);
            $KL2 = KoatuuLevel2::getKoatuuLevelID($model->KOATUUCode);
            $KL3 = KoatuuLevel3::getKoatuuLevelID($model->KOATUUCode);
            if ($KL3 == 0){
                if ($KL2 == 0) {
                    $KL1= $model->idKOATUU;
                } else {
                    $KL2= $model->idKOATUU; 
                }
            } else {
                $KL3=$model->idKOATUU; 
            }
            
            echo $form->hiddenField($model, 'KOATUUCode');
            echo $form->hiddenField($model, 'idKOATUU');
            echo CHtml::dropDownList("KOATUU1", $KL1,  KoatuuLevel1::DropDown(), 
                    array('class'=>'span12', 
                            'onchange'=>"PSN.KOATUUChange(this,'".CController::createUrl('directory/koatuu')."',1)"));
                     ?>
            </div>
          
        </div>
        <div class="row-fluid" <?php echo $KL2 == "0" ? "style='display:none;'":""; ?>>
           
            <div class ="span12"  > 
            <?php echo CHtml::label("Район або місто","KOATUU2");?>
            <?php echo CHtml::dropDownList("KOATUU2",  $KL2,  KoatuuLevel2::DropDown($KL1), 
                    array('class'=>'span12', 
                            'onchange'=>"PSN.KOATUUChange(this,'".CController::createUrl('directory/koatuu')."',2)"));
                     ?>
            </div>
            
        </div>
         <div class="row-fluid" <?php echo $KL3 == "0" ? "style='display:none;'":""; ?> >
           
            <div class ="span12" >
            <?php echo CHtml::label("Місто / ПГТ / Село","KOATUU3");//,array('class'=>'span3'));?>
            <?php echo CHtml::dropDownList("KOATUU3",  $KL3,  KoatuuLevel3::DropDown($KL2), 
                    array('class'=>'span12', 
                            'onchange'=>"PSN.KOATUUChange(this,'".CController::createUrl('directory/koatuu')."',3)"));
                     ?>
            </div>
            
        </div>
       
        <div class="row-fluid">
           <div class ="span2">
            <?php echo $form->label($model,'PostIndex');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'PostIndex',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
            <div class ="span3">
            <?php echo $form->labelEx($model,'StreetTypeID'); ?>
            <?php echo $form->dropDownList($model,'StreetTypeID', StreetTypes::DropDown(), array('class'=>'span12')); ?>
            </div>
            <div class ="span5">
            <?php echo $form->label($model,'Address');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'Address',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
             <div class ="span2">
            <?php echo $form->label($model,'HomeNumber');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'HomeNumber',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
        </div>
            
        <?php //echo $form->textFieldRow($model,'StreetTypeID',array('class'=>'span5')); ?>

	<?php // echo $form->textFieldRow($model,'Address',array('class'=>'span5','maxlength'=>250)); ?>

	<?php //echo $form->textFieldRow($model,'HomeNumber',array('class'=>'span5','maxlength'=>10)); ?>

	<?php //echo $form->textFieldRow($model,'PostIndex',array('class'=>'span5','maxlength'=>10)); ?>
      

	
	<?php //echo $form->textFieldRow($model,'IsResident',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'KOATUUCode',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'PersonEducationTypeID',array('class'=>'span5')); ?>

	
        <p class="help-block">ields with <span class="required">*</span> are required.</p>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>
<?php $this->endWidget(); ?>
