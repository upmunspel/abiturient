<?php
/* @var $this PersoncontacttypesController */
/* @var $model Personcontacttypes */

$this->breadcrumbs=array(
	'Personcontacttypes'=>array('index'),
	'Довідник ',
);

$this->menu=array(
/*array('label'=>'List Personcontacttypes', 'url'=>array('index')),*/
array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('personcontacttypes-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Довідник "Тип контакту з особою"</h1>

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
'id'=>'personcontacttypes-grid',
'type'=>'striped bordered condensed',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'idPersonContactType',
		'PersonContactTypeName',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
