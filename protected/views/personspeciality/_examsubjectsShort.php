<?php
if (Yii::app()->user->checkAccess("SpecGosSlugba")) {
    //$res[$record->idSubjects] = $record->SubjectName;
    $cr = new CDbCriteria();
    $cr->addCondition("idSubjects = 40");

    $data1 = CHtml::listData(Subjects::model()->findAll($cr), "idSubjects", "SubjectName");
    $data2 = CHtml::listData(Subjects::model()->findAll($cr), "idSubjects", "SubjectName");
    $data3 = CHtml::listData(Subjects::model()->findAll($cr), "idSubjects", "SubjectName");
    $model->Exam1ID = 40;
    $model->Exam2ID = 40;
    $model->Exam3ID = 40;
} else {
    //$res[$record->idSubjects] = $record->SubjectName;
    if (empty($model->QualificationID)) {
        $cr = new CDbCriteria();
        $cr->addCondition("idSubjects = 40");
        $data1 = CHtml::listData(Subjects::model()->findAll($cr), "idSubjects", "SubjectName");

        $cr = new CDbCriteria();
        $cr->addCondition("idSubjects = 3");
        //$cr->addCondition("idSubjects = 4", "OR");
        $data2 = CHtml::listData(Subjects::model()->findAll($cr), "idSubjects", "SubjectName");

        $data3 = array(); //CHtml::listData(Subjects::model()->findAll(), "idSubjects", "SubjectName");  
        $model->Exam1ID = 40;
        $model->Exam2ID = 3;
    
    }
    if (!empty($model->QualificationID) && $model->QualificationID == 3) { //spec
        $cr = new CDbCriteria();
        $cr->addCondition("idSubjects = 40");
        $data1 = CHtml::listData(Subjects::model()->findAll($cr), "idSubjects", "SubjectName");

        $cr = new CDbCriteria();
        $cr->addCondition("idSubjects = 3");
        //$cr->addCondition("idSubjects = 4", "OR");
        $data2 = CHtml::listData(Subjects::model()->findAll($cr), "idSubjects", "SubjectName");

        $data3 = array(); //CHtml::listData(Subjects::model()->findAll(), "idSubjects", "SubjectName");
        $model->Exam1ID = 40;
        $model->Exam2ID = 3;
    
    }
    if (!empty($model->QualificationID) && $model->QualificationID == 2) { //mag
        $cr = new CDbCriteria();
        $cr->addCondition("idSubjects = 40");

        $data1 = CHtml::listData(Subjects::model()->findAll($cr), "idSubjects", "SubjectName");

        $cr = new CDbCriteria();
        $cr->addCondition("idSubjects = 40");

        $data2 = CHtml::listData(Subjects::model()->findAll($cr), "idSubjects", "SubjectName");

        $cr = new CDbCriteria();
        $cr->addCondition("idSubjects = 3");

        $data3 = CHtml::listData(Subjects::model()->findAll($cr), "idSubjects", "SubjectName");
        $model->Exam1ID = 40;
        $model->Exam2ID = 40;
        $model->Exam3ID = 3;
    }
}
?>

<div class="row-fluid">
    <div class="span6">
        <?php echo CHtml::activeLabelEx($model, 'Exam1ID'); ?>qwererwt

    </div>
    <div class="span6">
        <?php echo CHtml::activeLabelEx($model, 'Exam1Ball'); ?>

    </div>
</div>
<div class="row-fluid">
    <div class="span6">
        <?php //echo $form->labelEx($model,'Exam1ID');   ?>
        <?php echo CHtml::activeDropDownList($model, 'Exam1ID', $data1, array('empty' => '', "disabled" => $model->EntranceTypeID == 1 ? "disabled" : "", 'class' => "span12")); ?>
        <?php //echo $form->error($model,'Exam1ID');  ?>
    </div>

    <div class="span6">
        <?php //echo $form->labelEx($model,'Exam1Ball');   ?>
        <?php echo CHtml::activeTextField($model, 'Exam1Ball', array('class' => "span12", "disabled" => $model->EntranceTypeID == 1 ? "disabled" : "")); ?>
        <?php //echo $form->error($model,'Exam1Ball');  ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span6">
        <?php //echo $form->labelEx($model,'Exam2ID');   ?>
        <?php echo CHtml::activeDropDownList($model, 'Exam2ID', $data2, array('empty' => '', 'class' => "span12", "disabled" => $model->EntranceTypeID == 1 ? "disabled" : "")); ?>
        <?php //echo $form->error($model,'Exam2ID');  ?>
    </div>

    <div class="span6">
        <?php //echo $form->labelEx($model,'Exam2Ball');   ?>
        <?php echo CHtml::activeTextField($model, 'Exam2Ball', array('class' => "span12", "disabled" => $model->EntranceTypeID == 1 ? "disabled" : "")); ?>
        <?php //echo $form->error($model,'Exam2Ball');  ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span6">
        <?php //echo $form->labelEx($model,'Exam2ID');   ?>
        <?php echo CHtml::activeDropDownList($model, 'Exam3ID', $data3, array('empty' => '', 'class' => "span12",
            "disabled" => empty($data3) ? "disabled" : ""));
        ?>
<?php //echo $form->error($model,'Exam2ID');   ?>
    </div>

    <div class="span6">
        <?php //echo $form->labelEx($model,'Exam2Ball');   ?>
        <?php echo CHtml::activeTextField($model, 'Exam3Ball', array('class' => "span12", "disabled" => empty($data3)  ? "disabled" : "")); ?>
<?php //echo $form->error($model,'Exam2Ball');   ?>
    </div>
</div>
