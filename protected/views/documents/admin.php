<?php
/* @var $this DocumentsController */
/* @var $model Documents */
$this->pageTitle = "Довідники";
$this->breadcrumbs=array(
	'Documents'=>array('index'),
	'Довідник ',
);

$this->menu=array(
/*array('label'=>'List Documents', 'url'=>array('index')),*/
array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('documents-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Довідник "Документи"</h1>

<p>
    Можна додати оператор порівняння (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) перед значенням пошуку
</p>
<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button btn btn-primary')); ?>
<div class="search-form" style="display:none; margin-top: 20px;">
    <?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
'id'=>'documents-grid',
'type'=>'striped bordered condensed',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'idDocuments',
		'PersonID',
        'person.FirstName',
		'TypeID',
		'Series',
		'Numbers',
		'DateGet',
		/*
		'ZNOPin',
		'AtestatValue',
		'Issued',
		'isCopy',
		*/
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
