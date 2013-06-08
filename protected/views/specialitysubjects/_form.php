<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'specialitysubjects-form',
	'enableAjaxValidation'=>false,
)); 

$form = new TbActiveForm();
?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php if (empty($SpecialityID)) $SpecialityID = 0;
        echo CHtml::dropDownList("SpecialityID", $SpecialityID , Specialities::DropDown(), array('empty'=>"",'class'=>'span5'));
        $c = new CDbCriteria();
        $c->order = 'SubjectName';
        $c->compare('idZNOSubject', '>0');
        $data = CHtml::listData(Subjects::model()->findAll($c), "idSubjects", "SubjectName");
        $dataCount  = count($data);
        ?>
        <div class ="row-fluid">
            <?php echo $form->error($models[0],"SpecialityID"); ?>
        </div>
        
        <div class ="row-fluid">
            <?php foreach ($models as $i=>$model): ?>
            <div class="span4">
                <?php echo $form->error($model,"[$i]SubjectID"); ?>
                <?php echo $form->textFieldRow($model,"[$i]LevelID",array('class'=>'span12',"readonly"=>"readonly")); ?>
                <?php echo $form->dropDownListRow($model,"[$i]SubjectID",$data, array('class'=>'span12','multiple'=>true,"size"=>"$dataCount")); ?>
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
