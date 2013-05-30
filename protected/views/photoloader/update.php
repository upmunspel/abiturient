<?php
/* @var $this PersonSexTypesController */
/* @var $model Person */

Header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); //Дата в прошлом 
Header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1 
Header("Pragma: no-cache"); // HTTP/1.1 
Header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
?>
<h1>Змінити фото абітурієнта #<?php echo $model->idPerson; ?></h1>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'person-photo-form',
        //'type'=>'horizontal',
        'enableAjaxValidation' => false,
        'htmlOptions' => array("class" => "well form", 'enctype' => 'multipart/form-data'),
        ));
?>
<div class="row-fluid">
    <div class ="span12">
       Оберіть фото абітурієнта у форматі *.jpg, *.png, *.gif та загальним розмром не більше 10MB.
    </div>
</div>
<div class="row-fluid">
    <div class ="span12">
        <?php echo $form->fileField($model, "PhotoName"); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Зберегти')); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('type' => '', 'label' => 'Повернутися до пошуку абіруріента', 'url'=>Yii::app()->createUrl("photoloader"))); ?>
    </div>
 <div class="row-fluid">
    <div class ="span12">   
        <?php echo $form->errorSummary($model) ?>
    </div>
 </div>
</div>
<?php $this->endWidget(); ?>
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>