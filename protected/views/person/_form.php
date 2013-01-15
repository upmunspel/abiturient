<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'person-form',
    //'type'=>'horizontal',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array("class"=>"well"),
)); 

$form=new TbActiveForm();?>
<p class="help-block"><strong>Особисті дані</strong></p>
        <hr>
       
        <div class="row-fluid">
            <div class ="span4">
            <?php echo $form->label($model,'FirstName');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'FirstName',array('class'=>'span12','maxlength'=>50)); ?>
            <?php echo $form->error($model,'FirstName'); ?>    
            </div>
            <div class ="span4">
            <?php echo $form->label($model,'LastName');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'LastName',array('class'=>'span12','maxlength'=>50)); ?>
            <?php echo $form->error($model,'LastName'); ?>        
            </div>
            <div class ="span4">
            <?php echo $form->label($model,'MiddleName');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'MiddleName',array('class'=>'span12','maxlength'=>50)); ?>
            <?php echo $form->error($model,'MiddleName'); ?>    
            </div>
        </div>
       <div class="row-fluid">
            <div class ="span4">
            <?php echo $form->label($model,'FirstNameR');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'FirstNameR',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
            <div class ="span4">
            <?php echo $form->label($model,'MiddleNameR');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'MiddleNameR',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
            <div class ="span4">
            <?php echo $form->label($model,'FirstNameR');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'LastNameR',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
        </div>
        
        <div class="row-fluid">
            <div class ="span3">
                <?php echo $form->labelEx($model,'Birthday'); ?>
                <?php echo $form->textField($model,'Birthday', array('class'=>'span12 datepicker')); ?>
                <script type="text/javascript">
                    $(".datepicker").datepicker({'format':"dd.mm.yyyy"});
                </script>
            </div>
            <div class ="span3">
                <?php echo $form->labelEx($model,'PersonSexID'); ?>
               
                <?php echo $form->dropDownList($model,'PersonSexID', PersonSexTypes::DropDown(), array('class'=>'span12')); ?>
               
                <?php echo $form->labelEx($model,'PersonSexID'); ?>
                <script type="text/javascript">
                    $('#togle_personsex').toggleButtons();
                </script>
            
            </div>
         
            <div class ="span3">
                <?php echo $form->labelEx($model,'IsResident'); ?>
                 <div id="togle_resident">
                    <?php echo $form->checkBox($model,'IsResident');//, array("Ні", "Так"), array('class'=>'span12')); ?>
                 </div>
                 <script type="text/javascript">
                    $('#togle_resident').toggleButtons({
                        //width: 100,
                        label: {
                            enabled: "Так",
                            disabled: "Ні"
                        }
                    });
                 </script>      
            </div>
        </div>
        <p class="help-block"><strong>Адреса</strong></p>
        <hr>
        <div class="row-fluid">
            <div class ="span12">
            <?php echo CHtml::label("Область або велике місто","KOATUUCodeL2ID");//,array('class'=>'span3'));?>
            <?php echo CHtml::activeDropDownList($model, "KOATUUCodeL1ID", KoatuuLevel1::DropDown(), 
                    array('class'=>'span12', 
                            'onchange'=>"PSN.KOATUUChange(this,'".CController::createUrl('directory/koatuu')."',1)"));
                     ?>
            </div>
        </div>
        <div class="row-fluid" <?php echo empty($model->KOATUUCodeL2ID) ? "style='display:none;'":""; ?>>
            <div class ="span12"  > 
            <?php echo CHtml::label("Район / місто / район міста","KOATUUCodeL2ID");?>
            <?php echo CHtml::activeDropDownList($model, "KOATUUCodeL2ID",  KoatuuLevel2::DropDown($model->KOATUUCodeL1ID), 
                    array('class'=>'span12', 
                            'onchange'=>"PSN.KOATUUChange(this,'".CController::createUrl('directory/koatuu')."',2)"));
                     ?>
            </div>
            
        </div>
        <div class="row-fluid" <?php echo empty($model->KOATUUCodeL3ID) ? "style='display:none;'":""; ?> >
           
            <div class ="span12" >
            <?php echo CHtml::label("Місто / ПГТ / Село / район міста","KOATUUCodeL3ID");//,array('class'=>'span3'));?>
            <?php echo CHtml::activeDropDownList($model, "KOATUUCodeL3ID",  KoatuuLevel3::DropDown($model->KOATUUCodeL2ID), 
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
            
        <p class="help-block"><strong>Школа</strong></p>
        <hr>
        <div class="row-fluid">
            <div class ="span5">
                <?php echo Chtml::label("Закінчив школу за місцем проживання", "sameschooladdr") ?>
            </div>
            <div class ="span1">
                 <div id="togle_sameschool">
                    <?php echo CHtml::checkBox("sameschooladdr", true);//, array("Ні", "Так"), array('class'=>'span12')); ?>
                 </div>
                 <script type="text/javascript">
                    $('#togle_sameschool').toggleButtons({
                        //width: 100,
                        label: {
                            enabled: "Так",
                            disabled: "Ні"
                        }
                    });
                 </script>      
            </div>
        </div>
	
        <p class="help-block">Fields with <span class="required">*</span> are required.</p>
         <?php echo $form->errorSummary($model); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>
<?php $this->endWidget(); ?>
