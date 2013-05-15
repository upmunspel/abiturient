<?php $form = new CActiveForm(); ?>
<?php foreach($models as $model): ?>
<div class="row-fluid">
     <?php echo $form->dropDownList($model, "[]BenefitID", Benefit::DropDown(), array('class'=>"span12"));?>
</div>
<?php endforeach; ?>