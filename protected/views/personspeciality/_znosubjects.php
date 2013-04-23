<div class="row-fluid">
   <div class="span12">
    <?php echo CHtml::activeLabelEx($model,'DocumentSubject1'); ?>
   </div>
</div>

<div class="row-fluid"> 
<div class="span12">
    
    <?php //echo $form->labelEx($model,'DocumentSubject1'); ?>
    <?php echo CHtml::activeDropDownList($model, 'DocumentSubject1',  Documents::ZNODropDown($model->PersonID, $specialityid, 1), array('empty'=>'','class'=>"span12","disabled"=>$model->EntranceTypeID == 2 ? "disabled":"")); ?>
    <?php //echo $form->error($model,'DocumentSubject1'); ?>
</div>
</div>
<div class="row-fluid">
<div class="span12">
        <?php //echo $form->labelEx($model,'DocumentSubject2'); ?>
        <?php echo CHtml::activeDropDownList($model, 'DocumentSubject2',  Documents::ZNODropDown($model->PersonID, $specialityid, 2), array('empty'=>'', 'class'=>"span12","disabled"=>$model->EntranceTypeID == 2 ? "disabled":"")); ?>
        <?php //echo $form->error($model,'DocumentSubject2'); ?>
</div>
</div>
<div class="row-fluid">
<div class="span12">
        <?php //echo $form->labelEx($model,'DocumentSubject3'); ?>
       <?php echo CHtml::activeDropDownList($model, 'DocumentSubject3',  Documents::ZNODropDown($model->PersonID, $specialityid, 3), array('empty'=>'','class'=>"span12","disabled"=>$model->EntranceTypeID == 2 ? "disabled":"")); ?>
        <?php //echo $form->error($model,'DocumentSubject3'); ?>
</div>
</div>

