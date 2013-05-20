<?php
/* @var $this PersonSexTypesController */
/* @var $model Person */

//$this->breadcrumbs=array(
//	'Person Sex Types'=>array('index'),
//	$model->idPersonSexTypes=>array('view','id'=>$model->idPersonSexTypes),
//	'Зміна запису довідника',
//);

//$this->menu=array(
//	/*array('label'=>'List Facultets', 'url'=>array('index')),*/
//	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
//	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idPersonSexTypes),'icon'=>"icon-eye-open"),
//	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
//);
?>

<h1>Змінити фото абітуріента <?php echo $model->idPerson; ?></h1>
<? 
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'person-photo-form',
    //'type'=>'horizontal',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array("class"=>"well form",'enctype'=>'multipart/form-data'),
        
));

?>
        <div class="row-fluid">
           
            <div class ="span5">
                <?php echo $form->fileField($model, "PhotoName"); ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit',  'type'=>'primary', 'label'=>'Зберегти')); ?>
            </div>
            <div class ="span7">
                <?php echo $form->errorSummary($model) ?>
            </div>
        </div>
<!--        <div class="row-fluid" style="margin-top:10px;">
            <div class ="span10">
                <?php //echo $form->errorSummary($model) ?>
            </div>
        </div>-->
<?php $this->endWidget(); ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>