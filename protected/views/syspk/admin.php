<?php
$this->breadcrumbs=array(
	'Sys Pks'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'Перелік','url'=>array('index')),
	array('label'=>'Створити','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('sys-pk-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управління приймальними комісіями</h1>

<p>
    Можна додати оператор порівняння (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) перед значенням пошуку
</p>

<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none; margin-top: 20px;">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'sys-pk-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'type'=>'striped bordered condensed',
	'columns'=>array(
		array('name'=>'idPk','header'=>"№п/п", 'htmlOptions'=>array("width"=>"50")),
                array('name'=>'PkName', 'htmlOptions'=>array("width" =>"250")),
		
		array('name'=>'Department', 'value'=>'$data->Department->DepartmentName'),
                array('name'=>'Course', 'value'=>'($data->CourseID == 0)?"Довільний" :$data->Course->CourseName', 'htmlOptions'=>array("width" =>"70")),
                array('name'=>'Qualification', 'value'=>'!empty($data->Qualification)?$data->Qualification->QualificationName:"Довільний"', 'htmlOptions'=>array("width" =>"100")),
		array('name'=>'SpecMask','htmlOptions'=>array("width" =>"100")),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
