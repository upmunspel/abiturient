<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'specialitysubjects-form',
	'enableAjaxValidation'=>false,
)); 

$form = new TbActiveForm();
?>



	<?php 
//        $SpecialityID = $model->SpecialityID;
//        if (!$SpecialityID) $SpecialityID = 0;
//        echo CHtml::dropDownList("SpecialityID", $SpecialityID , Specialities::DropDown(), array('empty'=>"",'class'=>'span5'));
//        
//        $c = new CDbCriteria();
//        $c->order = 'SubjectName';
//        $c->compare('idZNOSubject', '>0');
//        $data = CHtml::listData(Subjects::model()->findAll($c), "idSubjects", "SubjectName");
//        $dataCount  = count($data);
//        
//        unset($c);
        $Specialities = new Specialities();
        $d = $Specialities->getSpecialityFullNames();
        
        ?>
        <div class ="row-fluid">

        </div>
        
        <div class ="row-fluid">
            
            <div class="span4">

                <?php echo $form->error($model,"SubjectID"); ?>
                <?php 
                
                echo $form->dropDownListRow($model,  "SpecialityID", $d,
                        array('class'=>'span12')); 
                ?>
                <?php echo $form->textFieldRow($model,"LevelID",array('class'=>'span12',"readonly"=>"readonly")); ?>
                <?php echo $form->dropDownListRow($model,  "SubjectID", CHtml::listData(Subjects::model()->findAll(), "idSubjects", "SubjectName"),
                        array('class'=>'span12')); 
                ?>
                <?php 
                    echo "Це профільний предмет?";
                    echo $form->radioButtonList($model, "isProfile", array( 0 => "ні",1 => "так" ), array('separator'=>' ') ); ?>
            </div>
           
        </div>

	

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
