<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'specialitysubjects-form',
	'enableAjaxValidation'=>false,
)); 

$form = new TbActiveForm();
?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php if (empty($SpecialityID)) $SpecialityID = 0;
        echo CHtml::dropDownList("SpecialityID", $SpecialityID , Specialities::DropDown(), array('class'=>'span5'));
        $data = CHtml::listData(Subjects::model()->findAll(), "idSubjects", "SubjectName");
        $dataCount  = count($data);
        ?>
        
        <div class ="row-fluid">
            <?php foreach ($models as $model): ?>
            <div class="span4">
                <?php echo $form->textFieldRow($model,'[]LevelID',array('class'=>'span12',"value"=>"1","disabled"=>"disabled")); ?>
                <?php echo $form->dropDownListRow($model,'[]SubjectID',$data, array('class'=>'span12','multiple'=>true,"size"=>"$dataCount")); ?>
            </div>
           <?php endforeach; ?>
        </div>

	

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
