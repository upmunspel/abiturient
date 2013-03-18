<div class="row-fluid">
    <div class="span6">
            <?php echo CHtml::activeLabelEx($model,'Exam1ID'); ?>

    </div>
   <div class="span6">
            <?php echo CHtml::activeLabelEx($model,'Exam1Ball'); ?>

    </div>
</div>
<div class="row-fluid">
    <div class="span6">
            <?php //echo $form->labelEx($model,'Exam1ID'); ?>
            <?php echo CHtml::activeDropDownList($model,'Exam1ID',Subjects::DropDown(),array('empty'=>'','class'=>"span12")); ?>
            <?php //echo $form->error($model,'Exam1ID'); ?>
    </div>

    <div class="span6">
            <?php //echo $form->labelEx($model,'Exam1Ball'); ?>
            <?php echo CHtml::activeTextField($model,'Exam1Ball',array('class'=>"span12")); ?>
            <?php //echo $form->error($model,'Exam1Ball'); ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span6">
            <?php //echo $form->labelEx($model,'Exam2ID'); ?>
            <?php echo CHtml::activeDropDownList($model,'Exam2ID',Subjects::DropDown(),array('empty'=>'','class'=>"span12")); ?>
            <?php //echo $form->error($model,'Exam2ID'); ?>
    </div>

    <div class="span6">
            <?php //echo $form->labelEx($model,'Exam2Ball'); ?>
            <?php echo CHtml::activeTextField($model,'Exam2Ball',array('class'=>"span12")); ?>
            <?php //echo $form->error($model,'Exam2Ball'); ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span6">
            <?php //echo $form->labelEx($model,'Exam3ID'); ?>
            <?php echo CHtml::activeDropDownList($model,'Exam3ID',Subjects::DropDown(),array('empty'=>'','class'=>"span12")); ?>
            <?php //echo $form->error($model,'Exam3ID'); ?>
    </div>

    <div class="span6">
            <?php //echo $form->labelEx($model,'Exam3Ball'); ?>
            <?php echo CHtml::activeTextField($model,'Exam3Ball',array('class'=>"span12")); ?>
            <?php //echo $form->error($model,'Exam3Ball'); ?>
    </div>
</div>
