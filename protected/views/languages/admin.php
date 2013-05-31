<?php
/* @var $this Languagescontroller */
/* @var $model Languages */

$this->breadcrumbs=array(
	'Languages'=>array('index'),
	'Довідник ',
);

$this->menu=array(
/*array('label'=>'List Languages', 'url'=>array('index')),*/
array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('languages-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Довідник "Мови"</h1>

<p>
    Можна додати оператор порівняння (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) перед значенням пошуку
</p>

<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
'id'=>'languages-grid',
'type'=>'striped bordered condensed',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'idLanguages',
		'LanguagesCode',
		'LanguagesName',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
